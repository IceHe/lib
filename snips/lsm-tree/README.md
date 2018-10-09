# References

## LevelDB

- Official Website : http://leveldb.org/
    - [SSTable and Log Structured Storage: LevelDB](https://www.igvita.com/2012/02/06/sstable-and-log-structured-storage-leveldb/)
- GitHub : https://github.com/google/leveldb
    - Wiki : https://github.com/google/leveldb/blob/master/doc/index.md
        - Implementation notes : https://github.com/google/leveldb/blob/master/doc/impl.md
        - Immutable Table File Format : https://github.com/google/leveldb/blob/master/doc/table_format.md
        - Log File Format : https://github.com/google/leveldb/blob/master/doc/log_format.md
- Wikipedia : https://en.wikipedia.org/wiki/LevelDB
    - Benchmarks : https://web.archive.org/web/20110820001028/http://leveldb.googlecode.com/svn/trunk/doc/benchmark.html

## RocksDB

- Official Website : http://myrocks.io
- Wikipedia : https://en.wikipedia.org/wiki/RocksDB
- GitHub : https://github.com/facebook/rocksdb
    - Wiki : https://github.com/facebook/rocksdb/wiki
        - Talks : https://github.com/facebook/rocksdb/wiki/Talks
            - **2013-11-14-History-of-RocksDB** : https://www.youtube.com/watch?v=V_C-T5S-w8g
            - **2014-08-05-Embedded-Key-Value-Store-for-Flash-and-Faster-Storage** : https://github.com/facebook/rocksdb/blob/gh-pages-old/talks/2014-08-05-Flash-Memory-Summit-Siying-RocksDB.pdf
            - 2014-03-27-RocksDB-In-Memory : https://github.com/facebook/rocksdb/blob/gh-pages-old/talks/2014-03-27-RocksDB-Meetup-Haobo-RocksDB-In-Memory.pdf
            - **2015-09-29-Challenges-of-LSM-Trees-in-Practice** : https://github.com/facebook/rocksdb/blob/gh-pages-old/talks/2015-09-29-HPTS-Siying-RocksDB.pdf

[MyRocks Deep Dive](https://www.slideshare.net/matsunobu/myrocks-deep-dive)

### MyRocks

- Official Website : http://myrocks.io
- Wikipedia : https://en.wikipedia.org/wiki/MyRocks
- GitHub : https://github.com/facebook/mysql-5.6

## LSM 树

[Log Structured Merge Trees(LSM) 原理](http://www.open-open.com/lib/view/open1424916275249.html) ( Best! )

[Log Structured Merge Trees - ben stopford](http://www.benstopford.com/2015/02/14/log-structured-merge-trees/)

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

benchmark

- https://www.slideshare.net/matsunobu/myrocks-deep-dive

### MyRocks advantages over InnoDB

Ref : https://github.com/facebook/mysql-5.6/wiki/MyRocks-advantages-over-InnoDB

压缩的问题：闪存 4KB/page，但是默认页 16KB，压缩完是 5KB（MySQL 5.7 之前），实际上要占闪存 2 pages

> InnoDB compresses per page basis. Uncompressed page size is 16KB by default. After compression, page size is aligned to 4KB unit prior to MySQL 5.7, or OS/device sector size unit after MySQL 5.7 (if using Punch-Hole compression). On modern Flash storage device, sector size is 4KB. This means InnoDB compresses to 25%, 50% or 100% (and 75% in 5.7) only. For example, even though InnoDB compression could compress data from 16KB to 5KB (68.75% reduction), it actually uses 8KB, so compression efficiency deteriorates from 68.75% to 50%.

talks（演讲）

- https://github.com/facebook/rocksdb/tree/gh-pages-old/talks
- RocksDB
    https://github.com/facebook/rocksdb/blob/gh-pages-old/talks/2014-08-05-Flash-Memory-Summit-Siying-RocksDB.pdf
- RocksDB storage engine for MySQL and MongoDB
    https://www.slideshare.net/IgorCanadi/rocksdb-storage-engine-for-mysql-and-mongodb
- The Hive Think Tank: Rocking the Database World with RocksDB
    https://www.slideshare.net/HiveData/siying-dong-facebook

LSM 树原理 http://www.open-open.com/lib/view/open1424916275249.html

- 十年前，谷歌发表了 “BigTable” 的论文，论文中很多很酷的方面之一就是它所使用的文件组织方式，这个方法更一般的名字叫 Log Structured-Merge Tree

读性能的几种方式 http://www.open-open.com/lib/view/open1424916275249.html （这些都不是 LSM 树使用的方法）

> 很多树结构可以不用 update-in-place，最流行就是 append-only Btree，也称为 Copy-On-Write Tree

数据库选型 https://www.keakon.net/2018/07/13/key%20/%20value%20%E6%95%B0%E6%8D%AE%E5%BA%93%E7%9A%84%E9%80%89%E5%9E%8B

> - 3 种 compact 的方式：**leveled、universal** 和 FIFO
> - 当一层的数据文件超过该层的阈值时，就往它的下层来 compact。**L0 之间因为可能有重复的数据，因此需要全合并后写入 L1。而 L1 之后的数据文件不会有重复的 key**，因此在 key 范围不重合的情况下，可以并发地向下合并。RocksDB 默认有 L0 ~ L6 这 7 层，L1 容量是 256 MB（建议把 L0 和 L1 大小设为一样，可以减小写入放大），之后每层都是上一层容量的 10 倍。很显然，层数越高就表示写入放大倍数越高。
> - 那么可不可以不分这么多层，以减小写入放大倍数呢？Universal 这种风格就是尽量只用 L0，并将新的 SST 不断合并到老的 SST，因此数据文件的大小是不等的。
> - TiKV 和 Pika 都选择了 leveled 风格，也是 RocksDB 的默认值，应该是适合大部分情况的。但如果需要更高的写入性能，并且总数据容量不大（例如少于 100 GB），可以选择 universal。

- BadgerDB ，它的原理和 LevelDB 差不多，但是又做了个重要的优化：将 key 和 value 分开存放。因为 key 的空间占用会小很多，所以更容易放入内存中，能加快查询速度。而在合并时，合并 key 的开销很小（只是修改 value 的索引地址），合并 value 也只是删掉老的 value 即可，甚至不需要和 key 的合并同步进行，定期清理下就行了。而且因为 key 单独存放，所以遍历 key 和测试 key 是否存在也会快很多。不过如果 value 长度很小，那么分开存放反而增加了一次随机读，这是要结合实际项目来考虑的。

LevelDB

- SSTable : Sorted String Table
    https://www.igvita.com/2012/02/06/sstable-and-log-structured-storage-leveldb/
- LevelDB : http://web.archive.org/web/20130502222338/http://dailyjs.com/2013/04/19/leveldb-and-node-1/
- LSM Paper

写入放大

- 英文维基
- 中文维基

布隆过滤器 https://baike.baidu.com/item/%E5%B8%83%E9%9A%86%E8%BF%87%E6%BB%A4%E5%99%A8/5384697?fr=aladdin

跳跃表

# RocksDB

TODO

- Home : https://rocksdb.org/
- GitHub : https://github.com/facebook/rocksdb
    - Wiki : https://github.com/facebook/rocksdb/wiki

TMP

- Google Search 'RocksDB' : https://www.google.co.jp/search?q=RocksDB&ei=tymOW6bEEsOC-Qax-6jACg&start=10&sa=N&biw=1280&bih=1320&dpr=2

Others

- 吴镝：TiDB 在今日头条的实践 ( 关于 RocksDB ) : https://mp.weixin.qq.com/s?__biz=MzI3NDIxNTQyOQ==&mid=2247485726&idx=1&sn=083505292d4860585421b3b0f4484451&from=1083293010&wm=3333_2001&weiboauthoruid=1188203673
- （应该无关）TiDB 分布式数据库在转转公司的应用实践 : https://zhuanlan.zhihu.com/p/37453182

## Notes

### Intro

Wikipedia : https://en.wikipedia.org/wiki/RocksDB

> RocksDB is a high performance **embedded database** for **key-value** data **written in C++**.
> - It provides official application programming interface (API) language bindings for C++, C, and Java.

- An [**embeded database**](https://en.wikipedia.org/wiki/Embedded_database) system
    is a database management system (DBMS)
    which is tightly integrated with an application sofware
    that requires access to stored data,
    such that the database system is "hidden" from the application's end-user
    and requires little or no ongoing maintenance.

> It is **a fork of [LevelDB](https://en.wikipedia.org/wiki/LevelDB)**
> which was then optimized to exploit many central processing unit (CPU) cores,
> and make efficient use of fast storage,
> such as solid-state drives (SSD),
> for input/output (I/O) bound workloads.

RocksDB, like LevelDB, stores keys and values in arbitrary byte arrays, and data is sorted byte-wise by key or by providing a custom comparator.

RocksDB provides all of the features of LevelDB, plus:

- Transactions[15]
- Backups[16] and snapshots[17]
- Column families[18]
- Bloom filters[19]
- Time to live (TTL) support[20]
- Universal compaction[21]
- Merge operators[22]
- Statistics collection[23]
- Geospatial indexing[24]

### Articles

[Comparing new RocksDB and MMFiles storage engines](https://www.arangodb.com/why-arangodb/comparing-rocksdb-mmfiles-storage-engines/)

> The "rocksdb" engine is **optimized for datasets that are bigger than main memory**.
>
> The engine will keep a hot set of the data in main memory,
> but will happily load additional data from disk should it not be in the cached hot set.
>
> The engine will **write all index values to disk too**,
> so there is **no need for it to rebuild indexes when first accessing a collection after a restart**.
>
> This makes the engine’s startup very fast.
>
> After startup, the engine will gradually fill its caches during operations,
> therefore its performance may increase over time.

[获得PCC性能大赛背后的RocksDB引擎:5分钟全面了解其原理](https://sdk.cn/news/6686)

> RocksDB 项目最开始是在 Facebook 作为一个试验项目开发的高效的数据库软件，
> 可以实现 **在服务器负载下快速存储（特别是闪存存储）的数据存储的全部潜力**。
> 它是一个 C++ 库，可以用于存储 KV，包括任意大小的字节流。它 **支持原子读写**。
>
> RocksDB 具有高度灵活的配置设置，**可以调整为在各种生产环境（包括纯内存，闪存，硬盘或 HDFS）上运行**。
> 它支持各种压缩算法，并且有生产和调试环境的各种便利工具。
>
> RocksDB **借用** 了来自开源 LevelDB 项目的核心代码，以及 **来自 Apache HBase 的重要思想**。

- References
    - [RocksDB: Key-Value Store Optimized for Flash-Based SSD](https://www.percona.com/live/data-performance-conference-2016/sessions/rocksdb-key-value-store-optimized-flash-based-ssd)