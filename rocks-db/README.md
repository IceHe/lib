# RocksDB

参考

- RocksDB 官网：https://rocksdb.org/
- LevelDB from Google
- MyRocks (MySQL on RocksDB Storage Engine) 官网：http://myrocks.io/ （TODO）
    - FB 的 MySQL 分支版本，包含 MyRocks 的实现：https://github.com/facebook/mysql-5.6
    - 背景：
        - **MyRocks Deep Dive 幻灯片** https://www.slideshare.net/matsunobu/myrocks-deep-dive
        - https://github.com/facebook/mysql-5.6/wiki/MyRocks-advantages-over-InnoDB
    - MySQL 存储引擎
        - InnoDB
        - ISAM ( Indexed Sequential Access Method )

## MyRocks

MyRocks 特性

- 更小的存储空间，让存储介质有更长的寿命
    - RocksDB 目标就是充分使用 SSD，需要控制成本，当然要节省存储空间
        （微博穷，除了一定要用 SSD 扛的数据，不然不用 SDD）
- 更好的写性能
    - 更小的写入放大（write amplification）
        - 将多次输入，合并在一起，减少为少数几次输入

---

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
        - **MemTable**
        - **WAL (Write Ahead Log)**
        - Compaction
        - Column Family
    - 用 C++ 编写
    - key-value **持久化** 存储
    - 按照 key 排序，排序的函数可以由用户自定义
    - 支持任意的二进制字节流（byte stream, byte[]）
        （当然有大小限制，最大 4GB）
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

适用场景

- 大量写操作（插入操作）的场景

其它可选的产品

- Berkeley DB
- SQLite
- Kyoto TreeDB
- HBase
- LevelDB
- Cassandra

> - LevelDB、Cassandra 根据文件分层，而不是文件大小进行合并

基本结构

- MemTable（顾名思义，内存的数据结构）
- sstfile
    - **WAL (Write Ahead Log)**
- logfiles

> LSM 数据库的性能在很大程度上取决于压缩算法及其实现（为什么？）

memtable

- 具体实现
    - 默认 skiplist memtable
    - vector memtable
    - prefix-hash memtable（前缀散列）
        - 对 gets , puts , scans-within-a-key-prefix 有理

talks（演讲）

- https://github.com/facebook/rocksdb/tree/gh-pages-old/talks
- RocksDB
    https://github.com/facebook/rocksdb/blob/gh-pages-old/talks/2014-08-05-Flash-Memory-Summit-Siying-RocksDB.pdf
- RocksDB storage engine for MySQL and MongoDB
    https://www.slideshare.net/IgorCanadi/rocksdb-storage-engine-for-mysql-and-mongodb
- The Hive Think Tank: Rocking the Database World with RocksDB
    https://www.slideshare.net/HiveData/siying-dong-facebook

LSM 树对比 B+ 树 http://blog.51cto.com/9425473/1741432

- 同样支持怎删改查操作，以及顺序扫描操作（scan）
- LSM 牺牲了读性能（低一个数量级），大幅提高写性能（提高一个数量级）
- LSM 使用批量存储顺序写入，规避随机写入的问题（顺序读写比随机读写快三个数量级）
    - 将数据的修改增量保存在内存当中，然后达到指定大小（上限），在批量写入磁盘
    - 但是读取的时候，需要合并磁盘中历史数据以及最近的修改操作
    - 先访问内存，没有再去访问存储文件

LSM 树原理 http://www.open-open.com/lib/view/open1424916275249.html

- 十年前，谷歌发表了 “BigTable” 的论文，论文中很多很酷的方面之一就是它所使用的文件组织方式，这个方法更一般的名字叫 Log Structured-Merge Tree

读性能的几种方式 http://www.open-open.com/lib/view/open1424916275249.html （这些都不是 LSM 树使用的方法）

- 二分查找: 将文件数据有序保存，使用二分查找来完成特定key的查找。
- 哈希：用哈希将数据分割为不同的bucket
- B+树：使用B+树 或者 ISAM 等方法，可以减少外部文件的读取
- 外部文件： 将数据保存为日志，并创建一个hash或者查找树映射相应的文件。

> 很多树结构可以不用 update-in-place，最流行就是 append-only Btree，也称为 Copy-On-Write Tree

数据库选型 https://www.keakon.net/2018/07/13/key%20/%20value%20%E6%95%B0%E6%8D%AE%E5%BA%93%E7%9A%84%E9%80%89%E5%9E%8B

> - 3 种 compact 的方式：**leveled、universal** 和 FIFO
> - 当一层的数据文件超过该层的阈值时，就往它的下层来 compact。**L0 之间因为可能有重复的数据，因此需要全合并后写入 L1。而 L1 之后的数据文件不会有重复的 key**，因此在 key 范围不重合的情况下，可以并发地向下合并。RocksDB 默认有 L0 ~ L6 这 7 层，L1 容量是 256 MB（建议把 L0 和 L1 大小设为一样，可以减小写入放大），之后每层都是上一层容量的 10 倍。很显然，层数越高就表示写入放大倍数越高。
> - 那么可不可以不分这么多层，以减小写入放大倍数呢？Universal 这种风格就是尽量只用 L0，并将新的 SST 不断合并到老的 SST，因此数据文件的大小是不等的。
> - TiKV 和 Pika 都选择了 leveled 风格，也是 RocksDB 的默认值，应该是适合大部分情况的。但如果需要更高的写入性能，并且总数据容量不大（例如少于 100 GB），可以选择 universal。

- BadgerDB ，它的原理和 LevelDB 差不多，但是又做了个重要的优化：将 key 和 value 分开存放。因为 key 的空间占用会小很多，所以更容易放入内存中，能加快查询速度。而在合并时，合并 key 的开销很小（只是修改 value 的索引地址），合并 value 也只是删掉老的 value 即可，甚至不需要和 key 的合并同步进行，定期清理下就行了。而且因为 key 单独存放，所以遍历 key 和测试 key 是否存在也会快很多。不过如果 value 长度很小，那么分开存放反而增加了一次随机读，这是要结合实际项目来考虑的。

使用 RocksDB

- TiDB : TiKV 底层使用 RocksDB
- pika : 在使用 Redis 容量过大的一个解决方案
    - 在 RocksDB 上封装了多数据结构的库 nemo
    - 又在 nemo 上封装的网络逻辑，实现了 Redis 协议的解析

LevelDB

- SSTable : Sorted String Table
    https://www.igvita.com/2012/02/06/sstable-and-log-structured-storage-leveldb/
- LevelDB : http://web.archive.org/web/20130502222338/http://dailyjs.com/2013/04/19/leveldb-and-node-1/
- LSM Paper