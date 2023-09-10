# Redis Basics

**RE**mote **DI**ctionary **S**erver 远程字典服务

---

References

-   Home Page : https://redis.io
    -   Introduce : https://redis.io/topics/introduction
    -   Commands : https://redis.io/commands
    -   Documentation : https://redis.io/documentation
-   Others
    -   容量评估
        -   **Redis 容量预估** - 极数云舟 : http://www.redis.cn/redis_memory/
        -   Redis 容量评估模型 - 腾讯游戏学院 : https://gameinstitute.qq.com/community/detail/114987
    -   Redis 6.0 多线程 IO 处理过程详解 - 知乎专栏 : https://zhuanlan.zhihu.com/p/144805500

## Intro

Redis is an **in-memory data structure store**, **used as a database, cache and message broker**.

-   It supports data structures such as [strings](https://redis.io/topics/data-types-intro#strings), [hashes](https://redis.io/topics/data-types-intro#hashes), [lists](https://redis.io/topics/data-types-intro#lists), [sets](https://redis.io/topics/data-types-intro#sets), [sorted sets](https://redis.io/topics/data-types-intro#sorted-sets) with range queries, [bitmaps](https://redis.io/topics/data-types-intro#bitmaps), [hyperloglogs](https://redis.io/topics/data-types-intro#hyperloglogs), [geospatial indexes](https://redis.io/commands/geoadd) with radius queries and [streams](https://redis.io/topics/streams-intro).
-   Redis has built-in [replication](https://redis.io/topics/replication), [Lua scripting](https://redis.io/commands/eval), [LRU eviction](https://redis.io/topics/lru-cache), [transactions](https://redis.io/topics/transactions) and different levels of [on-disk persistence](https://redis.io/topics/persistence), and provides high availability via [Redis Sentinel](https://redis.io/topics/sentinel) and automatic partitioning with [Redis Cluster](https://redis.io/topics/cluster-tutorial).

You can run **atomic operations** on these types. …

<!--

E.g.:
[appending to a string](https://redis.io/commands/append);
[incrementing the value in a hash](https://redis.io/commands/hincrby);
[pushing an element to a list](https://redis.io/commands/lpush);
[computing set intersection](https://redis.io/commands/sinter), [union](https://redis.io/commands/sunion) and [difference](https://redis.io/commands/sdiff);
or [getting the member with highest ranking in a sorted set](https://redis.io/commands/zrangebyscore).

-->

… Depending on your use case, you can **persist it either by** [dumping the dataset to disk](https://redis.io/topics/persistence#snapshotting) every once in a while, or by [appending each command](https://redis.io/topics/persistence#append-only-file) to a log.

<!--

Redis also supports trivial-to-setup ( 琐碎的设置 ) [master-slave asynchronous replication](https://redis.io/topics/replication), with very fast non-blocking first synchronization, auto-reconnection with partial resynchronization on net split.

Other features include:

-   [Transactions](https://redis.io/topics/transactions)
-   [Pub/Sub](https://redis.io/topics/pubsub)
-   [Lua scripting](https://redis.io/commands/eval)
-   [Keys with a limited time-to-live](https://redis.io/commands/expire)
-   [LRU eviction of keys](https://redis.io/topics/lru-cache)
-   [Automatic failover](https://redis.io/topics/sentinel)

-->

## FAQ

[Ref](https://redis.io/docs/getting-started/faq/)

How is Redis different from other key-value stores?

-   Redis data types are **closely related to fundamental data structures** and are exposed to the programmer as such, without additional abstraction layers.

    简而言之，很接近基础的数据结构，方便程序员使用。

What's the Redis memory footprint? ……

What happens if Redis runs out of memory?

-   If this limit is reached,
    Redis will start to **reply with an error to write commands (but will continue to accept read-only commands).**

## Others

-   [Redis Cheat Sheet](https://cheatography.com/tasjaevan/cheat-sheets/redis/)
-   [Redis on Flash](https://redislabs.com/redis-enterprise/technology/redis-on-flash/) by Redis Labs extends DRAM capacity with SSD and persistent memory.

Specifications

-   [Redis Design Drafts](https://redis.io/topics/rdd)
    -   Design drafts of new proposals.
-   [Redis Protocol specification](https://redis.io/topics/protocol)
    -   if you're implementing a client, or out of curiosity, learn how to communicate with Redis at a low level.
-   [Redis RDB format](https://github.com/sripathikrishnan/redis-rdb-tools/wiki/Redis-RDB-Dump-File-Format) specification, and [RDB version history](https://github.com/sripathikrishnan/redis-rdb-tools/blob/master/docs/RDB_Version_History.textile).
-   [Internals](https://redis.io/topics/internals) : Learn details about how Redis is implemented under the hood.

# Redis 6.0 多线程 IO 处理

Reference

-   Redis 6.0 多线程 IO 处理过程详解 - 知乎专栏 : https://zhuanlan.zhihu.com/p/144805500

解释暂略, 详见原文

## 单线程 IO 处理过程

![redis-single-thread-process.jpg](_image/redis-single-thread-process.jpg)

## 多线程 IO 处理过程

![redis-multiple-threads-process.jpg](_image/redis-multiple-threads-process.jpg)

todo oneday
