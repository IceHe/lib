# RocksDB

## RocksDB 是什么

- kye-value 嵌入式数据库
    - 何为嵌入式？减少网络传输延迟，存储跟前端服务，放到一起（TODO）
- 从 LevelDB 的 1.5 版本 fork 而来
    - 借用 LevelDB 的核心代码
    - HBase 的思想（TODO）
- 由 C++ 编写，提供 C++ / Java 等语言的 API

## RocksDB 的目标

在服务器负载下，发挥快速存储介质的高速读写的全部潜力

- 特别是 Flash（闪存）和 RAM 等
- 为什么能发挥？所做的取舍（TODO）

灵活的部署和配置

- 可以运行在各种生产环境的内存、闪存、硬盘或 HDFS 等各种存储介质上

向后兼容

- RocksDB 升级后，使用其旧版本 API 的程序可以不用修改

## 适合的场景 & 同类产品

适合场景

- 大批量的写入和删除

缺点

- 更大的数据冗余

---

> 存储引擎，同类场景

LevelDB

- 占用的存储空间最小

RocksDB

- 读和删除性能最好
- 跟 LevelDB 相比，牺牲更多的存储存储空间，提升读写性能，特别是大批量的的写操作

HyperLevelDB

- 大批量的写操作最快，比 Rocks DB 还快一倍（写 100M 条 24B 的记录）
- 但是查询操作最慢，特别是大批量的查询操作，花费 RocksDB 的 4 倍以上的时间（读 100M 条 24B 的数据）

LMDB

- 只有小量数据（具体条件下，50M 条以下的 24B 大小的记录）的查询上最快
- 花费的存储空间，却是其它的一倍以上，其它指标均落后

……

Ref : https://www.influxdata.com/blog/benchmarking-leveldb-vs-rocksdb-vs-hyperleveldb-vs-lmdb-performance-for-influxdb/

2014 年的 benchmark，可供参考，需要更新的数据

## 基本使用

- 基本操作: get / put / delete / scan
- key / value 可以是任意长度的字节流

## 读写的流程

- Write Path（TODO）
- Read Path（TODO）

## RocksDB 的设计

基本结构

- memtable 存储内存中的数据
    - 满了的话，会存储到 sstfile
- sstfile 临时存储（持久化）
    - 会持久化到 log file 中
- logfile 日志文件：持久化存储的数据

多级存储的压缩

### memtable

TODO

### immutable table file

BlockBasedTable

- 默认的 SST table

PlainTable : SST 文件格式

- 为了在纯内存和低延迟介质上降低查询延迟，而作出特别的优化
- 优缺点（取舍）
- 简述实现方式
    - 目标
    - 文件格式

### 日志文件

WAL : write ahead log

- 将 memtable（内存表）的操作，持久化到日志文件上
- 优缺点（取舍）
- 实现方式：
    - 日志文件格式
        - 日志文件由一连串的可变长记录（record）组成
        - record 在存储介质上以何种方式被保存

## 其它特性

- Column Families
- gets 批量获取、iterator 迭代器、snapshot 快照
- 前缀迭代器
- 事务
- 持久化
- 容错
- **多线程压缩**（TODO）
    - 通用压缩
    - 级别样式压缩
- 避免停顿：避免持久化时的写入操作的停顿，专门的线程负责持久化
- 压缩过滤器：去掉过期数据
- 只读模式：提高性能
- 全量备份、增量备份、（主从）复制
- **并行 memtable 插入**
    - 流程（TODO）
- **合并操作**（TODO）
- ……
