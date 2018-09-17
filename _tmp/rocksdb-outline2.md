# RocksDB

## RocksDB 是什么

- kye-value 嵌入式数据库
- …

## RocksDB 的目标

- 在服务器负载下，发挥快速存储介质的高速读写的全部潜力
- …

## 读写的流程

- Write Path（TODO）
- Read Path（TODO）

## RocksDB 的设计

基本结构

- memtable 存储内存中的数据
- sstfile 临时存储
- logfile 日志文件：持久化存储的数据

## 其它特性

- gets 批量获取、iterator 迭代器、snapshot 快照
- **多线程压缩**（TODO）
    - 通用压缩
    - 级别样式压缩
- 避免停顿
- 压缩过滤器：去掉过期数据
- **并行 memtable 插入**
- **合并操作**
- ……
