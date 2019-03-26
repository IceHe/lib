# Elasticsearch

> Elasticsearch is a distributed, **RESTful search** and **analytics engine** capable of solving a growing number of use cases.

- As the heart of the Elastic Stack, it centrally **stores your data**
    - so you can **discover the expected and uncover the unexpected**.

## References

### Elasticsearch

Offical

- Elasticsearch: RESTful, Distributed Search & Analytics : https://www.elastic.co/products/elasticsearch
    - Download : https://www.elastic.co/downloads/elasticsearch
        - Past Releases : https://www.elastic.co/downloads/past-releases

Recommended

Others

- 全文搜索引擎 Elasticsearch 入门教程 - 阮一峰的网络日志 : http://www.ruanyifeng.com/blog/2017/08/elasticsearch.html
    - 有点旧，数据操作的描述不太对
- ~~ES快速入门 - 简书~~ : https://www.jianshu.com/p/ddee872c69c1
- ~~Elasticsearch权威指南（中文版）~~ : https://es.xiaoleilu.com/010_Intro/05_What_is_it.html

### Tools

#### elastic-head

> a web front end for browsing and interacting with an Elastic Search cluster.

- GitHub : https://github.com/mobz/elasticsearch-head

## Official Reference 5.1

- Getting Started | Elasticsearch Reference [5.1] | Elastic : https://www.elastic.co/guide/en/elasticsearch/reference/5.1/getting-started.html
- 5.4 中文版 (对照) : http://cwiki.apachecn.org/pages/viewpage.action?pageId=4260360
    - 重大改变 - Elastic Elasticsearch - ApacheCN - 中文社区 : http://cwiki.apachecn.org/pages/viewpage.action?pageId=4260605

get

- Get API - Elastic Elasticsearch - ApacheCN - 中文社区 : http://cwiki.apachecn.org/display/Elasticsearch/Get+API

multi-get

- 多个 GET API - Elastic Elasticsearch - ApacheCN - 中文社区 : http://cwiki.apachecn.org/pages/viewpage.action?pageId=5505071

search

- Search APIs - Elastic Elasticsearch - ApacheCN - 中文社区 : http://cwiki.apachecn.org/display/Elasticsearch/Search+APIs

sort

- _doc 除了是最有效的排序顺序没有真正的用例。所以如果你不关心文档返回的顺序，那么你应该按 _doc 排序。 这特别有助于滚动。

## Jianshu QuickStart

ES快速入门 - 简书 : https://www.jianshu.com/p/ddee872c69c1

### Introduction

( 这个文档比较简略，就是先拿来随便看看的 )

> 是一种搜索引擎，也是一种 **"数据库"**

ES 与 SQL 的基础概念对照（粗浅理解）

|ES|SQL|
|-|-|
|Indices|Databases|
|Types|Tables|
|Documents|Rows|
|Fields|Columns|
|Mapping|Schema|

### Storage

#### Physical

> 物理存储

- Cluster
- Node
- Shard : 为了同时搜索海量数据，需要将它们分片，存储在不同节点上，分别进行处理，以提高查询效率
    - 分片作用
        - 高容量(?)：允许水平分割/缩放内容(?)，从而提高拓展能力
        - 高并发/性能(?)：允许在分片(可能多个)上执行并行的操作，从而提高性能/吞吐量
- Replica : Shard 的复制
    - 复制分片作用
        - 高可用：避免分片故障（单点故障）后无法提供服务
        - 高并发：允许拓展搜索量/吞吐量（对所有副本并行执行搜索!）

#### Logical

> 逻辑存储

Index (DB) 索引

- 是具有某种相似特征的文档的集合
- 索引名称必须全部小写

Type (Table) 类型

- 是索引的逻辑类别/分区
    - 注意：type 将被废弃
        - ES 6 中，Document 只能加一个 type
            - 【拓展篇】Elasticsearch 6.0 一个索引只允许有一个type - Elastic 中文社区 : https://elasticsearch.cn/article/337
        - ES 7 中，取消对 type 的支持
        - 原因
            - **Removal of mapping types** | Elasticsearch Reference : https://www.elastic.co/guide/en/elasticsearch/reference/master/removal-of-types.html
            - 为什么ElasticSearch要在7.X版本去掉type? https://blog.csdn.net/zjx546391707/article/details/78631394

Document (Row) 文档

- 以 JSON 表示（那存储呢?按行存储?推测是多种存储方案的混合?）

Field (Column) 字段

- 注意！**一个索引的所有文档类型中，对于具有相同名称的字段必须是同一种数据类型**
    - 区别：与 SQL Server 等不同，同一数据库不同表中，相同名称的列数据类型可以不一样

Mapping (Schema) 映射

- 是 **字段 到 字段类型 的 映射关系**！
    - 将每个字段匹配为一种确定的数据类型，例如
        - 字段 remark，其类型是 String
        - 字段 age，其类型是 Integer

## Definitive Guide

( 太落后了，介绍的查询语法在 ES 5 已经被废弃 )

Definitions

- 分布式的实时文件存储，每个字段都被索引并可被搜索
- 分布式的实时分析搜索引擎
- 可以扩展到上百台服务器，处理PB级结构化或非结构化数据

Install (暂略)

- Plugins
    - Marvel 是 Elasticsearch 的管理和监控工具，在开发环境下免费使用
        - 它包含了一个叫做 Sense 的交互式控制台，使用户方便的通过浏览器直接与 Elasticsearch 进行交互

### 基本概念

- Indexing 索引
    - 存储数据
- Search 搜索
- Aggregations 聚合

类比: DB vs ES

```bash
Relational DB -> Databases -> Tables -> Rows -> Columns
Elasticsearch -> Indices   -> Types  -> Documents -> Fields
```

索引 Index 的含义

- 名词：**存储 Documents (数据) 的地方**
- 动词："索引一个文档" 表示 **把一个文档存储到索引 (名词) 中**

### 基本操作

via RESTful APIs

文档操作 (documenT)

- GET 检索
- PUT 创建/修改
- DELETE 删除
- HEAD 检查是否存在

数据

- 原始JSON文档包含在_source字段中

```bash
# request
GET /megacorp/employee/1

# response
{
  "_index" :   "megacorp",
  "_type" :    "employee",
  "_id" :      "1",
  "_version" : 1,
  "found" :    true,
  "_source" :  {
      "first_name" :  "John",
      "last_name" :   "Smith",
      "age" :         25,
      "about" :       "I love to go rock climbing",
      "interests":  [ "sports", "music" ]
  }
}
```

## Usage

### Initialize

References

- 安装Elasticsearch - ES权威指南 : https://es.xiaoleilu.com/010_Intro/15_API.html
- ~~Elasticsearch，elasticsearch-head插件，Kibana插件安装 - CSDN博客~~ : https://blog.csdn.net/jiduochou963/article/details/88686315

#### Install

```bash
# latest
$ brew install elasticsearch
# or latest version of 5.x
$ brew install elasticsearch@5.6
```

or download version 5.1.2

- Elasticsearch 5.1.2 | Elastic : https://www.elastic.co/downloads/past-releases/elasticsearch-5-1-2


#### Run

Start

```bash
$ elasticsearch
```

Check

- Visit http://localhost:9200/?pretty
- Or run a command (as follow)

```bash
$ curl 'localhost:9200/?pretty'
{
  "name" : "NSEMAPo",
  "cluster_name" : "elasticsearch_mac",
  "cluster_uuid" : "wtgkEFY9Q-OJolsbVoEQNA",
  "version" : {
    "number" : "6.6.2",
    "build_flavor" : "oss",
    "build_type" : "tar",
    "build_hash" : "3bd3e59",
    "build_date" : "2019-03-06T15:16:26.864148Z",
    "build_snapshot" : false,
    "lucene_version" : "7.6.0",
    "minimum_wire_compatibility_version" : "5.6.0",
    "minimum_index_compatibility_version" : "5.0.0"
  },
  "tagline" : "You Know, for Search"
}
```

#### Plugins

References

- Elasticsearch Plugins and Integrations [6.6] | Elastic : https://www.elastic.co/guide/en/elasticsearch/plugins/6.6/index.html
    - TODO : 看看这个参考资料有没用

Locate command

- on macOS

```bash
# e.g.
/usr/local/Cellar/elasticsearch/6.6.2/bin/elasticsearch-plugin
```

Help

```bash
$ elasticsearch-plugin -h
A tool for managing installed elasticsearch plugins

Commands
--------
list - Lists installed elasticsearch plugins
install - Install a plugin
remove - removes a plugin from Elasticsearch

Non-option arguments:
command

Option         Description
------         -----------
-h, --help     show help
-s, --silent   show minimal output
-v, --verbose  show verbose output
```

Install

- List offical plugins

```bash
$ elasticsearch-plugin install -h
Install a plugin

The following official plugins may be installed by name:
  analysis-icu
  analysis-kuromoji
  analysis-nori
  analysis-phonetic
  analysis-smartcn
  analysis-stempel
  analysis-ukrainian
  discovery-azure-classic
  discovery-ec2
  discovery-file
  discovery-gce
  ingest-attachment
  ingest-geoip
  ingest-user-agent
  mapper-annotated-text
  mapper-murmur3
  mapper-size
  repository-azure
  repository-gcs
  repository-hdfs
  repository-s3
  store-smb

Non-option arguments:
plugin id

Option             Description
------             -----------
-E <KeyValuePair>  Configure a setting
-b, --batch        Enable batch mode explicitly, automatic confirmation of
                     security permission
-h, --help         show help
-s, --silent       show minimal output
-v, --verbose      show verbose output
```

- Install

```bash
$ elasticsearch-plugin install [PLUGIN_NAME]
```

### Manipulate

TODO
