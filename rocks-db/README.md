# RocksDB

参考

- RocksDB 官网：https://rocksdb.org/
- LevelDB from Google
- MyRocks (MySQL on RocksDB Storage Engine) 官网：http://myrocks.io/ （TODO）
    - FB 的 MySQL 分支版本，包含 MyRocks 的实现：https://github.com/facebook/mysql-5.6
    - 背景：
        - **MyRocks Deep Dive 幻灯片** https://www.slideshare.net/matsunobu/myrocks-deep-dive
        - https://github.com/facebook/mysql-5.6/wiki/MyRocks-advantages-over-InnoDB
    - MySQL 存储引擎 ?
        - InnoDB
        - ISAM ?

## MyRocks

MyRocks 特性

- 更小的存储空间，让存储介质有更长的寿命
    - RocksDB 目标就是充分使用 SSD，需要控制成本，当然要节省存储空间
        （微博穷，除了一定要用 SSD 扛的数据，不然不用 SDD）
- 更好的写性能
    - 更小的写入放大（write amplification）
        - 将多次输入，合并在一起，减少为少数几次输入

---

> 简单提及一下磁盘寻道的问题，所以采用 SSD（闪存）

---

> 写入放大（英语：Write amplification，简称WA）是闪存和固态硬盘（SSD）中一种不良的现象，即实际写入的物理数据量是写入数据量的多倍。（TODO 解释待优化）
>
> 由于闪存在可重新写入数据前必须先擦除，而擦除操作的粒度与写入操作相比低得多，执行这些操作就会多次移动（或改写）用户数据和元数据。因此，要改写数据，就需要读取闪存某些已使用的部分，更新它们，并写入到新的位置，如果新位置在之前已使被用过，还需连同先擦除；由于闪存的这种工作方式，必须擦除改写的闪存部分比新数据实际需要的大得多。此倍增效应会增加请求写入的次数，缩短SSD的寿命，从而减小SSD能可靠运行的时间。增加的写入也会消耗闪存的带宽，此主要降低SSD的随机写入性能。许多因素会影响SSD的写入放大，一些可以由用户来控制，而另一些则是数据写入和SSD使用的直接结果。

LSM 的优点

- 更小的存储空间
- 更低的写放大

LSM 结合 MySQL 的优点

- SQL
- Replication 主从复制
- Connectors 连接器
- …（其它工具）

MyRocks 的性能和效率

- Single Delete（put 语句随着 delete 一起清理掉）
- Prefix bloom filter（加速方法，不去直接读取数据，而是用这个来看每个值是否存储在这个地方）

benchmark

- 从 https://www.slideshare.net/matsunobu/myrocks-deep-dive 幻灯片的 37 页附近，查看
    - 写入放大的减少效果：relateive KB written per query
    - 读取放大的减少效果
    - 存储空间减少 smaller space == better cache hit rate ?

### MyRocks advantages over InnoDB

Ref : https://github.com/facebook/mysql-5.6/wiki/MyRocks-advantages-over-InnoDB

MyRocks requires less storage space than InnoDB

> If you run databases on disks, space doesn’t matter much. But if you run on flash, reducing space is very important because per GB cost is much higher than HDD.

B+ 树

- 当 insert 的 key 不连续的时候，需要 fragmentation（节点分裂），需要更多额外的的空间

压缩的问题：闪存 4KB/page，但是默认页 16KB，压缩完是 5KB（MySQL 5.7 之前），实际上要占闪存 2 pages

> InnoDB compresses per page basis. Uncompressed page size is 16KB by default. After compression, page size is aligned to 4KB unit prior to MySQL 5.7, or OS/device sector size unit after MySQL 5.7 (if using Punch-Hole compression). On modern Flash storage device, sector size is 4KB. This means InnoDB compresses to 25%, 50% or 100% (and 75% in 5.7) only. For example, even though InnoDB compression could compress data from 16KB to 5KB (68.75% reduction), it actually uses 8KB, so compression efficiency deteriorates from 68.75% to 50%.

LSM 树比 B+ 树节省存储空间

RocksDB 在 SST（Sorted String Table）文件中存储数据

- 块（Block）大小默认为 4KB（和闪存每页标准相同）
- SST 的大小默认跟操作系统的段（sector）相同（所以没有上文提到的存储对齐开销）
    - sector 对应物理存储区域

写入放大的问题

> - On pure flash, reducing write volume (write amplification) is important because flash burns out if writing too much data. Reducing write volume also helps to improve overall throughput on flash.
> - InnoDB adopts "update in place" architecture. Even though updating just 1 record, an entire page where the row belongs becomes dirty, and the dirty page has to be written back to storage.
> - On the other hand, RocksDB (LSM) database uses "Append Only" model. Edits are written to WAL (Write Ahead Log), then periodically merged with SST files.

- InnoDB 采取更新原来的记录的方式（update-in-place），update 不会插入一条新数据，只是直接在原来的数据上改（习以为常）
- RocksDB 则是直接插入一条新的记录（append-only）

## RocksDB

用途

- 数据库引擎 MyRocks
- 嵌入式应用缓存 Netflix
    - https://medium.com/netflix-techblog/application-data-caching-using-ssds-5bf25df851ef

RocksDB 特性

- 高性能
    - 使用 log structured engine（LSM）（要和 B+ 树进行对比）
        - Leveled LSM Structure
        - MemTable
        - WAL (Write Ahead Log)
        - Compaction
        - Column Family
    - 用 C++ 编写
    - key-value **持久化** 存储
    - 支持任意大小的二进制字节流（byte stream, byte[]）
- 为快速存储而优化
    - 发掘闪存（Flash）& 内存（RAM）全部的读写潜力
        - SSD 就属于闪存
- 可适配：不同的工作负载
    - MyRocks（参照 MySQL 起的名字）
    - 应用数据缓
    - 嵌入式负载？
    - …
- 基本和高级的数据库操作
    - 基本：opening & closing
    - 高级：merging、compaction filter

其它可选的产品

- TODO

