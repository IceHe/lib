# Elasticsearch

## Maven

```xml
<dependency>
    <groupId>org.elasticsearch</groupId>
    <artifactId>elasticsearch</artifactId>
    <version>5.4.3</version>
</dependency>
```

## Accessor

```java
package xyz.icehe.storage;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;
import java.util.Map;
import java.util.function.Supplier;

import lombok.Getter;
import lombok.extern.slf4j.Slf4j;
import org.apache.commons.collections.CollectionUtils;
import org.elasticsearch.action.admin.indices.exists.indices.IndicesExistsRequest;
import org.elasticsearch.action.admin.indices.exists.indices.IndicesExistsResponse;
import org.elasticsearch.action.delete.DeleteResponse;
import org.elasticsearch.action.get.GetRequestBuilder;
import org.elasticsearch.action.get.GetResponse;
import org.elasticsearch.action.index.IndexResponse;
import org.elasticsearch.action.search.SearchRequestBuilder;
import org.elasticsearch.action.search.SearchResponse;
import org.elasticsearch.action.search.SearchType;
import org.elasticsearch.action.update.UpdateResponse;
import org.elasticsearch.client.transport.TransportClient;
import org.elasticsearch.common.unit.TimeValue;
import org.elasticsearch.index.query.QueryBuilder;
import org.elasticsearch.rest.RestStatus;
import org.elasticsearch.search.SearchHits;
import org.elasticsearch.search.sort.SortBuilder;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import xyz.icehe.utils.JsonUtils;

/**
 * Elasticsearch 服务
 *
 * @author st
 * @since 2020/05/01
 */
@Slf4j
@Getter
@Service
public class ElasticsearchAccessor {

    /**
     * 请求 ES 服务的超时时间 (单位: 毫秒)
     */
    private static final int ES_TIMEOUT_MILLIS = 500;

    /**
     * 1 分钟的毫秒数
     */
    private static final int MILLIS_IN_1_MIN = 60 * 1000;

    /**
     * ES Scroll 查询的 KeepAlive 时间
     */
    private static final TimeValue ES_SCROLL_KEEP_ALIVE = new TimeValue(MILLIS_IN_1_MIN);

    /**
     * ES Scroll 查询的最大出错重试次数
     */
    private static final int ES_SCROLL_MAX_TRIES = 5;

    @Autowired
    private TransportClient esClient;

    /**
     * 判断索引是否存在
     *
     * @param index
     * @return
     */
    public boolean existIndex(String index) {
        IndicesExistsResponse inExistsResponse =
            this.getEsClient()
                .admin()
                .indices()
                .exists(new IndicesExistsRequest(index))
                .actionGet(ES_TIMEOUT_MILLIS);
        return inExistsResponse.isExists();
    }

    /**
     * 指定 ID 添加文档数据, 如果已存在则完全替换原数据
     *
     * <p>To fully replace an existing document, use the index API.
     *
     * @param index 索引 (类似数据库)
     * @param type  类型 (类似表)
     * @param id    数据 ID
     * @param map   数据
     * @return
     */
    public void addOrReplaceData(String index, String type, String id, Map<String, ?> map) {
        IndexResponse indexResponse = this.getEsClient()
            .prepareIndex(index, type, id)
            .setSource(map)
            .get(TimeValue.timeValueMillis(ES_TIMEOUT_MILLIS));
        log.info("ElasticsearchAccessor.addOrReplaceData, indexResponse.status={}, indexResponse.id={}",
            indexResponse.status().getStatus(), indexResponse.getId());
    }

    /**
     * 根据 ID 更新文档数据, 合并文档的原有数据
     *
     * <p>Support passing a partial document, which will be merged into the existing document
     * (simple recursive merge, inner merging of objects, replacing core "keys/values" and arrays).
     *
     * @param index 索引 (类似数据库)
     * @param type  类型 (类似表)
     * @param id    数据 ID
     * @param map   数据
     * @return
     */
    public void updateDataById(String index, String type, String id, Map<String, ?> map) {
        UpdateResponse updateResponse = this.getEsClient()
            .prepareUpdate(index, type, id)
            .setDoc(map)
            .setRetryOnConflict(2)
            .execute()
            .actionGet(ES_TIMEOUT_MILLIS);
        log.info("ElasticsearchAccessor.updateDataById, updateResponse.status={}, updateResponse.id={}",
            updateResponse.status().getStatus(), updateResponse.getId());
    }

    /**
     * 根据 ID 删除数据
     *
     * @param index 索引 (类似数据库)
     * @param type  类型 (类似表)
     * @param id    数据 ID
     */
    public void deleteDataById(String index, String type, String id) {
        DeleteResponse deleteResponse = this.getEsClient()
            .prepareDelete(index, type, id)
            .execute()
            .actionGet(ES_TIMEOUT_MILLIS);
        log.info("ElasticsearchAccessor.deleteDataById, deleteResponse.status={}, deleteResponse.id={}",
            deleteResponse.status().getStatus(), deleteResponse.getId());
    }

    /**
     * 通过 ID 获取数据
     *
     * @param index 索引 (类似数据库)
     * @param type  类型 (类似表)
     * @param id    数据 ID
     * @return
     */
    public GetResponse searchDataById(String index, String type, String id) throws Exception {
        return searchDataById(index, type, id, null);
    }

    /**
     * 通过 ID 获取数据
     *
     * @param index  索引 (类似数据库)
     * @param type   类型 (类似表)
     * @param id     数据 ID
     * @param fields 需要显示的字段 (缺省时, 指全部字段)
     * @return
     */
    public GetResponse searchDataById(String index, String type, String id, List<String> fields) throws Exception {
        GetRequestBuilder getRequestBuilder = this.getEsClient().prepareGet(index, type, id);
        if (CollectionUtils.isNotEmpty(fields)) {
            getRequestBuilder.setFetchSource(fields.toArray(new String[0]), null);
        }
        try {
            return getRequestBuilder.execute().actionGet(ES_TIMEOUT_MILLIS);
        } catch (Exception e) {
            log.error("ElasticsearchAccessor.searchDataById failed", e);
            throw e;
        }
    }

    /**
     * 分页查询数据
     *
     * @param index                索引 (类似数据库)
     * @param type                 类型 (类似表)
     * @param offset               查询偏移
     * @param limit                查询数量
     * @param sortBuilderSupplier  排序方式
     * @param queryBuilderSupplier 查询条件
     * @return
     */
    public SearchHits searchPageData(
        String index,
        String type,
        int offset,
        int limit,
        List<? extends Supplier<? extends SortBuilder<?>>> sortBuilderSupplier,
        Supplier<QueryBuilder> queryBuilderSupplier) {

        // 依据查询索引库名称创建查询索引
        SearchRequestBuilder searchRequestBuilder = this.getEsClient().prepareSearch(index);
        // 设置查询文档, 文档类型
        searchRequestBuilder.setTypes(type);
        // 设置查询类型
        searchRequestBuilder.setSearchType(SearchType.QUERY_THEN_FETCH);
        // 设置分页信息
        searchRequestBuilder.setFrom(offset).setSize(limit);
        if (null != queryBuilderSupplier) {
            searchRequestBuilder.setQuery(queryBuilderSupplier.get());
        }
        if (CollectionUtils.isNotEmpty(sortBuilderSupplier)) {
            sortBuilderSupplier.forEach(supplier -> searchRequestBuilder.addSort(supplier.get()));
        }
        // 要求获取源内容
        searchRequestBuilder.setFetchSource(true);
        log.info("ElasticsearchAccessor.searchPageData before request, searchRequestBuilder={}",
            JsonUtils.toJsonString(searchRequestBuilder.toString()));
        SearchResponse searchResponse;
        try {
            searchResponse = searchRequestBuilder.execute().actionGet(ES_TIMEOUT_MILLIS);
            if (RestStatus.OK.getStatus() == searchResponse.status().getStatus()) {
                SearchHits searchHits = searchResponse.getHits();
                log.info("ElasticsearchAccessor.searchPageData found {} documents and processed {} documents",
                    searchHits.getTotalHits(), searchHits.getHits().length);
                return searchHits;
            } else {
                log.error("ElasticsearchAccessor.searchPageData wrong response, searchResponse={}",
                    searchResponse);
                return null;
            }
        } catch (Exception e) {
            log.error("ElasticsearchAccessor.searchPageData failed", e);
            throw e;
        }
    }

    /**
     * 滚动查询所有数据
     *
     * @param index                索引 (类似数据库)
     * @param type                 类型 (类似表)
     * @param pageSize             分页大小
     * @param totalSize            数据总条数
     * @param sortBuilderSupplier  排序方式
     * @param queryBuilderSupplier 查询条件
     * @return
     */
    public List<SearchHits> searchAllData(
        String index,
        String type,
        int pageSize,
        int totalSize,
        List<? extends Supplier<? extends SortBuilder<?>>> sortBuilderSupplier,
        Supplier<QueryBuilder> queryBuilderSupplier)
        throws Exception {

        // 依据查询索引库名称创建查询索引
        SearchRequestBuilder searchRequestBuilder = this.getEsClient().prepareSearch(index);
        // 设置滚动查询的超时时间
        searchRequestBuilder.setScroll(ES_SCROLL_KEEP_ALIVE);
        // 设置查询文档, 文档类型
        searchRequestBuilder.setTypes(type);
        // 设置查询类型
        searchRequestBuilder.setSearchType(SearchType.QUERY_THEN_FETCH);
        // 设置分页信息
        searchRequestBuilder.setSize(pageSize);
        if (null != queryBuilderSupplier) {
            searchRequestBuilder.setQuery(queryBuilderSupplier.get());
        }
        if (CollectionUtils.isNotEmpty(sortBuilderSupplier)) {
            sortBuilderSupplier.forEach(supplier -> searchRequestBuilder.addSort(supplier.get()));
        }
        // 要求获取源内容
        searchRequestBuilder.setFetchSource(true);
        log.info("ElasticsearchAccessor.searchAllData before request, searchRequestBuilder={}",
            JsonUtils.toJsonString(searchRequestBuilder.toString()));

        List<SearchHits> searchHitsList = new ArrayList<>(totalSize);

        // Prefetch
        SearchResponse searchResponse;
        try {
            searchResponse = searchRequestBuilder.get();
            if (RestStatus.OK.getStatus() == searchResponse.status().getStatus()) {
                SearchHits searchHits = searchResponse.getHits();
                log.info("ElasticsearchAccessor.searchAllData found {} documents, processed {} documents",
                    searchHits.getTotalHits(), searchHits.getHits().length);
                searchHitsList.add(searchHits);
            } else {
                log.error("ElasticsearchAccessor.searchAllData wrong response, searchResponse={}",
                    JsonUtils.toJsonString(searchResponse));
                return Collections.emptyList();
            }
        } catch (Exception e) {
            log.error("ElasticsearchAccessor.searchAllData failed, searchRequestBuilder={}",
                JsonUtils.toJsonString(searchRequestBuilder), e);
            throw e;
        }

        int maxTries = ES_SCROLL_MAX_TRIES;
        // Scroll until no hits are returned
        do {
            try {
                searchResponse = this.getEsClient()
                    .prepareSearchScroll(searchResponse.getScrollId())
                    .setScroll(ES_SCROLL_KEEP_ALIVE)
                    .get();
                if (RestStatus.OK.getStatus() == searchResponse.status().getStatus()) {
                    SearchHits searchHits = searchResponse.getHits();
                    log.info("ElasticsearchAccessor.searchAllData found {} documents, processed {} documents",
                        searchHits.getTotalHits(), searchHits.getHits().length);
                    searchHitsList.add(searchHits);
                } else {
                    log.error("ElasticsearchAccessor.searchAllData wrong response, searchResponse={}",
                        JsonUtils.toJsonString(searchResponse));
                }
            } catch (Exception e) {
                if (maxTries > 0) {
                    maxTries--;
                    log.error("ElasticsearchAccessor.searchAllData ignored es exception (allow to ignore next {} ones)",
                        maxTries, e);
                } else {
                    log.error("ElasticsearchAccessor.searchAllData failed, searchResponse={}",
                        JsonUtils.toJsonString(searchResponse), e);
                    throw e;
                }
            }
        } while (0 != searchResponse.getHits().getHits().length);
        // Zero hits mark the end of the scroll and the while loop.

        return searchHitsList;
    }
}

```