# Elasticsearch

> Elasticsearch is a distributed, **RESTful search** and **analytics engine** capable of solving a growing number of use cases.

- As the heart of the Elastic Stack, it centrally **stores your data**
    - so you can **discover the expected and uncover the unexpected**.

## References

- Elasticsearch: RESTful, Distributed Search & Analytics : https://www.elastic.co/products/elasticsearch
- ES快速入门 - 简书 : https://www.jianshu.com/p/ddee872c69c1

## Jianshu QuickStart

ES快速入门 - 简书 : https://www.jianshu.com/p/ddee872c69c1

### Intro

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
    - 注意：据说 ES 6 之后没有 type 了？

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

Definitions

- 分布式的实时文件存储，每个字段都被索引并可被搜索
- 分布式的实时分析搜索引擎
- 可以扩展到上百台服务器，处理PB级结构化或非结构化数据

Console ( GUI )

- Marvel 是 Elasticsearch 的管理和监控工具，在开发环境下免费使用
    - 它包含了一个叫做 Sense 的交互式控制台，使用户方便的通过浏览器直接与 Elasticsearch 进行交互
-
