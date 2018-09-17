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
