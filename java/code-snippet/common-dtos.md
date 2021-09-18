# Common DTOs

## PageCondition

```java
import com.fasterxml.jackson.annotation.JsonIgnore;
import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Data;
import lombok.NoArgsConstructor;

/**
 * 翻页条件
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class PageCondition {

    /**
     * 页码: 至少为 1
     */
    private Integer pageIndex;

    /**
     * 每页数据条数: 至少为 1
     */
    private Integer pageSize;

    /**
     * @return 获取查询偏移量
     */
    @JsonIgnore
    public Integer getOffset() {
        return (getPageIndex() - 1) * getPageSize();
    }

    /**
     * @return 获取查询数量
     */
    @JsonIgnore
    public Integer getLimit() {
        return getPageSize();
    }
}

```

## PageDTO

```java
import java.util.List;

import lombok.AllArgsConstructor;
import lombok.Builder;
import lombok.Data;
import lombok.NoArgsConstructor;

/**
 * 可翻页数据
 *
 * @author icehe.xyz
 * @since 2020/10/16
 */
@Data
@Builder
@NoArgsConstructor
@AllArgsConstructor
public class PageDTO<T> {

    /**
     * 总页数
     */
    private Integer pageTotal;

    /**
     * 页码
     */
    private Integer pageIndex;

    /**
     * 每页数据条数
     */
    private Integer pageSize;

    /**
     * 数据总条数
     */
    private Integer itemTotal;

    /**
     * 数据
     */
    private List<T> items;
}

```
