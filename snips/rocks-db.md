# RocksDB

TODO

- Home : https://rocksdb.org/
- GitHub : https://github.com/facebook/rocksdb
    - Wiki : https://github.com/facebook/rocksdb/wiki

TMP

- Google Search 'RocksDB' : https://www.google.co.jp/search?q=RocksDB&ei=tymOW6bEEsOC-Qax-6jACg&start=10&sa=N&biw=1280&bih=1320&dpr=2

## Notes

### Intro

Wikipedia : https://en.wikipedia.org/wiki/RocksDB

> RocksDB is a high performance **embedded database** for **key-value** data **written in C++**.

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

### Articles

[Comparing new RocksDB and MMFiles storage engines](https://www.arangodb.com/why-arangodb/comparing-rocksdb-mmfiles-storage-engines/)

> The “rocksdb” engine is **optimized for datasets that are bigger than main memory**.
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