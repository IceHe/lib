# Redis Basics ( from Juejin Book )

> **RE**mote **DI**ctionary **S**erver 远程字典服务

References

- Home Page : https://redis.io
    - Introduce : https://redis.io/topics/introduction
    - _Clients_ : https://redis.io/clients
    - Commands : https://redis.io/commands
    - Documentation : https://redis.io/documentation
    - _Download_ : https://redis.io/download
- Others
    - ZH Docs : http://redisdoc.com
    - 基本原理和方案设计
        - **Redis 深度历险 : 核心原理与应用实践** : https://juejin.im/book/5afc2e5f6fb9a07a9b362527 ( 推荐 )
    - 容量评估
        - **Redis 容量预估** - 极数云舟 : http://www.redis.cn/redis_memory/
        - Redis 容量评估模型 - 腾讯游戏学院 : https://gameinstitute.qq.com/community/detail/114987

## Basic Data Structure

- string 字符串
- list 列表
- set 集合
- zset ( sorted set ) 有序集合
- hash 字典/哈希

### String

> 字符串

Redis 的字符串是 **动态字符串**,

- 是可以修改的字符串.
- **内部结构实现上类似于 Java 的 ArrayList**
    - 采用 **预分配冗余空间的方式来减少内存的频繁分配**
- 内部为当前字符串实际分配的空间 capacity 一般要高于实际字符串长度 len.
    - **当字符串长度小于 1M 时, 扩容都是加倍现有的空间,**
    - **如果超过 1M, 扩容时一次只会多扩 1M 的空间.**
    - 注意 : **字符串最大长度为 512M.**

![string-capacity.webp](_images/string-capacity.webp)

### List

> 列表

**Redis 的列表相当于 Java 语言里面的 LinkedList.**

- 注意 : 它 **是链表而不是数组**.
    - 这意味着 list 的插入和删除操作非常快, 时间复杂度为 O(1)
    - 但是索引定位很慢, 时间复杂度为 O(n) _( icehe : 不过范围查询还行 )_
- 当列表弹出了最后一个元素之后, 该数据结构自动被删除, 内存被回收.

![list-rpush-example.gif](_images/list-rpush-example.gif)

**Redis 的列表结构常用来做异步队列使用.**

- 将需要延后处理的任务结构体序列化成字符串塞进 Redis 的列表,
- 另一个线程从这个列表中轮询数据进行处理.

#### Queue

作为 队列 使用 : 右进左出

```bash
> rpush books python java golang
(integer) 3
> llen books
(integer) 3
> lpop books
"python"
> lpop books
"java"
> lpop books
"golang"
> lpop books
(nil)
```

#### Stack

作为 栈 使用 : 右进左出

```bash
> rpush books python java golang
(integer) 3
> rpop books
"golang"
> rpop books
"java"
> rpop books
"python"
> rpop books
(nil)
```

#### Slow Query

`lindex` _( list index )_ 相当于 Java 链表的 `get(int index)` 方法

- 它需要对链表进行遍历, 性能随着参数 index 增大而变差.

`ltrim` _( list trim )_ 和字面上的含义不太一样 _( 个人觉得它叫 `lretain ` ( 保留 ) 更合适, )_

- 参数 start_index 和 end_index 定义了一个区间,
    - 在这个区间内的值, ltrim 要保留, 区间之外统统砍掉.
- 可以通过 `ltrim` 来实现一个定长的链表, _这一点非常有用._
- index 可以为负数
    - index=-1 表示倒数第一个元素,
    - index=-2 表示倒数第二个元素.

#### Quicklist, Ziplist

![zip-list-simple-structure.webp](_images/quicklist-simple-structure.webp)

Redis 底层的存储结构不是一个简单的 linkedlist,

- 而是称之为 **快速链表 quicklist** 的一个结构.
- 首先在 **列表元素较少的情况下会使用一块连续的内存存储**, 这个结构是 **ziplist 即压缩列表**.
    - 它将所有的元素紧挨着一起存储, 分配的是一块连续的内存.
- 当 **数据量比较多的时候才会改成 quicklist 快速链表**.
    - 因为普通的链表需要的附加指针空间太大, 会比较浪费空间, 而且会加重内存的碎片化.
        - 例如, 这个列表里存的只是 int 类型的数据, 结构上还需要两个额外的指针 prev 和 next.
    - 所以 Redis **将链表和 ziplist 结合起来组成了 quicklist**!
        - 也就是 **将多个 ziplist 使用双向指针串起来使用**.
        - 这样 **既满足了快速的插入删除性能, 又不会出现太大的空间冗余**.

### Hash

**Redis 的字典相当于 Java 语言里面的 HashMap**,

- 它是无序字典.
- 内部实现结构上同 Java 的 HashMap 也是一致的, 同样的 **数组 + 链表二维结构**.
- **第一维 hash 的数组位置碰撞时, 就会将碰撞的元素使用链表串接起来**.

![hash-simple-structure.webp](_images/hash-simple-structure.webp)

#### Rehash

- 与 Java 不同的是, **Redis 的字典的值只能是字符串**,
- **rehash 方式** 也不一样,
    - 因为 Java 的 HashMap 在字典很大时, rehash 是个耗时的操作, 需要一次性全部 rehash.
    - Redis 为了高性能, 不能堵塞服务, 所以采用了 **渐进式 rehash 策略**.

![progressive-rehash-strategy.webp](_images/progressive-rehash-strategy.webp)

- 渐进式 rehash 会在 rehash 的同时, 保留新旧两个 hash 结构, 查询时会同时查询两个 hash 结构,
- 然后 **在后续的定时任务中以及 hash 操作指令中, 循序渐进地将旧 hash 的内容一点点迁移到新的 hash 结构中**.
- 当搬迁完成了, 就会使用新的 hash 结构取而代之.
- 当 hash 移除了最后一个元素之后, 该数据结构自动被删除, 内存被回收.

#### String vs. Hash

![hash-sets-example.gif](_images/hash-sets-example.gif)

- hash 结构也可以用来存储用户信息, 不同于字符串一次性需要全部序列化整个对象, **hash 可以对用户结构中的每个字段单独存储.
    - 这样当需要获取用户信息时 **可以进行部分获取**.
    - 而以 **整个字符串的形式去保存用户信息的话就只能一次性全部读取, 这样就会比较浪费网络流量**.
- hash 也有缺点, **hash 结构的存储消耗要高于单个字符串**,
    - 到底该使用 hash 还是字符串, 需要根据实际情况再三权衡.

### Set

> 集合

**Redis 的集合相当于 Java 语言里面的 HashSet**,

- 它内部的键值对是无序的唯一的.
- 它的 **内部实现相当于一个特殊的字典, 字典中所有的 value 都是一个值 NULL**.

![set-simple-example.gif](_images/set-simple-example.gif)

### Zset

> 有序集合

**zset 可能是 Redis 提供的最为特色的数据结构**,

- _它也是在面试中面试官最爱问的数据结构._
- 它 **类似于 Java 的 SortedSet 和 HashMap 的结合体**,
    - **一方面它是一个 set, 保证了内部 value 的唯一性**,
    - **另一方面它可以给每个 value 赋予一个 score, 代表这个 value 的排序权重**.
- 它的内部实现用的是一种叫做「**跳跃列表**」的数据结构.
- zset 中最后一个 value 被移除后, 数据结构自动删除, 内存被回收.

![zset-simple-example.gif](_images/zset-simple-example.gif)

- _zset 可以用来存粉丝列表,_
    - _value 值是粉丝的用户 ID,_
    - _score 是关注时间._
    - _可以对粉丝列表按关注时间进行排序._
- _zset 还可以用来存储学生的成绩,_
    - _value 值是学生的 ID,_
    - _score 是他的考试成绩._
    - _可以对成绩按分数进行排序就可以得到他的名次._

#### Skiplist

> 跳跃表

- **zset 内部的排序功能是通过「跳跃列表」数据结构来实现的,
    - _它的结构非常特殊, 也比较复杂._
- 因为 **zset 要支持随机的插入和删除**, 所以它不好使用数组来表示.
- 因为 **zset 需要链表按照 score 值进行排序**,
    - 这意味着当有新元素需要插入时, 要定位到特定位置的插入点, 这样才可以继续保证链表是有序的.
    - 通常我们会通过二分查找来找到插入点, 但是二分查找的对象必须是数组, 只有数组才可以支持快速位置定位, 链表做不到

![normal-linked-list.webp](_images/normal-linked-list.webp)

- 跳跃列表就是类似于层级制,
    - 最下面一层所有的元素都会串起来.
    - 然后每隔几个元素挑选出一个代表来, 再将这几个代表使用另外一级指针串起来.
    - 然后在这些代表里再挑出二级代表, 再串起来.
    - 最终就形成了金字塔结构.

![skiplist-simple-structure-example.webp](_images/skiplist-simple-structure-example.webp)

- 「跳跃列表」之所以「跳跃」, 是因为内部的元素可能「身兼数职」,
    - 比如上图中间的这个元素, 同时处于 L0、L1 和 L2 层, 可以快速在不同层次之间进行「跳跃」.
    - 定位插入点时, 先在顶层进行定位, 然后下潜到下一级定位, 一直下潜到最底层找到合适的位置, 将新元素插进去.
- 跳跃列表 **采取一个随机策略来决定新元素可以兼职到第几层**.
    - **首先 L0 层肯定是 100% 了, L1 层只有 50% 的概率, L2 层只有 25% 的概率, L3 层只有 12.5% 的概率, 一直随机到最顶层 L31 层**.
    - _绝大多数元素都过不了几层, 只有极少数元素可以深入到顶层. 列表中的元素越多, 能够深入的层次就越深, 能进入到顶层的概率就会越大._

### 容器型数据结构的通用规则

list / hash / set / zset 这 4 种数据结构是 **容器型数据结构**, 共享下面两条通用规则 :

- 1\. **create if not exists**
    - **如果容器不存在, 那就创建一个, 再进行操作.**
    - _比如 rpush 操作刚开始是没有列表的, Redis 就会自动创建一个, 然后再 rpush 进去新元素._
- 2\. **drop if no elements**
    - **如果容器里元素没有了, 那么立即删除元素, 释放内存**.
    - _这意味着 lpop 操作到最后一个元素, 列表就消失了._

### 过期时间

Redis 所有的数据结构都可以设置过期时间, 时间到了, Redis 会自动删除相应的对象.

- **过期是以对象为单位**!
    - 例如, **一个 hash 结构的过期是整个 hash 对象的过期, 而不是其中的某个子 key**!
- 小心 string 的过期时间被移除!
    - 例如, **如果一个字符串已经设置了过期时间, 然后你调用了 set 方法修改了它, 它的过期时间会消失!**

```bash
$ redis-server &
$ redis-cli
127.0.0.1:6379> set foo bar
OK
127.0.0.1:6379> expire foo 600
(integer) 1
127.0.0.1:6379> ttl foo
(integer) 596
127.0.0.1:6379> set foo ice
OK
127.0.0.1:6379> ttl foo
(integer) -1
127.0.0.1:6379>
```

## Intro

Reference

- Introduce : https://redis.io/topics/introduction

Redis is an _open source ( BSD licensed ) ,_ **in-memory data structure store**, **used as a database, cache and message broker**.

- It supports **data structures** such as [strings](https://redis.io/topics/data-types-intro#strings), [hashes](https://redis.io/topics/data-types-intro#hashes), [lists](https://redis.io/topics/data-types-intro#lists), [sets](https://redis.io/topics/data-types-intro#sets), [sorted sets](https://redis.io/topics/data-types-intro#sorted-sets) with range queries, [bitmaps](https://redis.io/topics/data-types-intro#bitmaps), [hyperloglogs](https://redis.io/topics/data-types-intro#hyperloglogs), [geospatial indexes](https://redis.io/commands/geoadd) with radius queries and [streams](https://redis.io/topics/streams-intro).
- Redis has built-in [replication](https://redis.io/topics/replication), [Lua scripting](https://redis.io/commands/eval), [LRU eviction](https://redis.io/topics/lru-cache), [transactions](https://redis.io/topics/transactions) and different levels of [on-disk persistence](https://redis.io/topics/persistence), and provides high availability via [Redis Sentinel](https://redis.io/topics/sentinel) and automatic partitioning with [Redis Cluster](https://redis.io/topics/cluster-tutorial).

You can run **atomic operations** on these types, like

- [appending to a string](https://redis.io/commands/append);
- [incrementing the value in a hash](https://redis.io/commands/hincrby);
- [pushing an element to a list](https://redis.io/commands/lpush);
- [computing set intersection](https://redis.io/commands/sinter), [union](https://redis.io/commands/sunion) and [difference](https://redis.io/commands/sdiff);
- or [getting the member with highest ranking in a sorted set](https://redis.io/commands/zrangebyscore).

In order to achieve its outstanding performance, Redis works with an **in-memory dataset**.

- Depending on your use case, you can **persist it either by** [dumping the dataset to disk](https://redis.io/topics/persistence#snapshotting) every once in a while, or by [appending each command](https://redis.io/topics/persistence#append-only-file) to a log.
- _Persistence can be optionally disabled, if you just need a feature-rich, networked, in-memory cache._

Redis also supports trivial-to-setup ( 微不足道的设置 ) [master-slave asynchronous replication](https://redis.io/topics/replication), with very fast non-blocking first synchronization, auto-reconnection with partial resynchronization on net split.

Other features include:

- [Transactions](https://redis.io/topics/transactions)
- [Pub/Sub](https://redis.io/topics/pubsub)
- [Lua scripting](https://redis.io/commands/eval)
- [Keys with a limited time-to-live](https://redis.io/commands/expire)
- [LRU eviction of keys](https://redis.io/topics/lru-cache)
- [Automatic failover](https://redis.io/topics/sentinel)

_You can use Redis from [most programming languages](https://redis.io/clients) out there._

Redis is written in **ANSI C** _and works in most POSIX systems like Linux, \*BSD, macOS without external dependencies._

- Linux and macOS are the two operating systems where Redis is developed and tested the most, and we **recommend using Linux for deploying**.
- _Redis may work in Solaris-derived systems like SmartOS, but the support is best effort._
- _There is no official support for Windows builds._

## Documentation

Reference

- Documentation : https://redis.io/documentation

Note :

- The Redis Documentation is also available in raw (computer friendly) format in the redis-doc github repository.
    - The Redis Documentation is released under the Creative Commons Attribution-ShareAlike 4.0 International license.

### Programming with Redis

- _[The full list of commands](https://redis.io/commands)
    - implemented by Redis, along with thorough documentation for each of them._
- [Pipelining](https://redis.io/topics/pipelining)
    - Learn how to **send multiple commands at once, saving on round trip time.**
- [Redis Pub/Sub](https://redis.io/topics/pubsub)
    - Redis is a **fast and stable Publish/Subscribe messaging system!** Check it out.
- [Redis Lua scripting](https://redis.io/commands/eval)
    - Redis Lua scripting feature documentation.
- [Debugging Lua scripts](https://redis.io/topics/ldb)
    - _Redis 3.2 introduces a native Lua debugger for Redis scripts._
- [Memory optimization](https://redis.io/topics/memory-optimization)
    - Understand **how Redis uses RAM and learn some tricks to use less of it.**
- [Expires](https://redis.io/commands/expire)
    - Redis allows to **set a time to live different for every key** so that the key will be **automatically removed from the server when it expires.**
- [Redis as an LRU cache](https://redis.io/topics/lru-cache)
    - How to configure and use Redis **as a cache with a fixed amount of memory and auto eviction of keys.**
- [Redis transactions](https://redis.io/topics/transactions)
    - It is possible to **group commands together so that they are executed as a single transaction.**
- [Client side caching](https://redis.io/topics/client-side-caching)
    - Starting with version 6 Redis supports **server assisted client side caching.**
    - _This document describes how to use it._
- [Mass insertion of data](https://redis.io/topics/mass-insert)
    - How to **add a big amount of pre existing or generated data to a Redis instance in a short time.**
- [Partitioning](https://redis.io/topics/partitioning)
    - How to **distribute your data among multiple Redis instances.**
- [Distributed locks](https://redis.io/topics/distlock)
    - Implementing a **distributed lock manager** with Redis.
- [Redis keyspace notifications](https://redis.io/topics/notifications)
    - **Get notifications of keyspace events via Pub/Sub** (Redis 2.8 or greater).
- [Creating secondary indexes with Redis](https://redis.io/topics/indexes)
    - Use Redis data structures to **create secondary indexes, composed indexes and traverse graphs.**

### Redis modules API

- [Introduction to Redis modules](https://redis.io/topics/modules-intro).
    - A good place to start learing about Redis 4.0 modules programming.
- [Implementing native data types](https://redis.io/topics/modules-native-types).
    - Modules scan **implement new data types** (data structures and more) that **look like built-in data types.**
    - _This documentation covers the API to do so._
- [Blocking operations with modules](https://redis.io/topics/modules-blocking-ops).
    - _This is still an experimental API, but a very powerful one to write commands that can **block the client (without blocking Redis) and can execute tasks in other threads**._
- [Redis modules API reference](https://redis.io/topics/modules-api-ref).
    - _Directly generated from the top comments in the source code inside src/module.c._
    - _Contains many low level details about API usage._

### Tutorials & FAQ

- [Introduction to Redis data types](https://redis.io/topics/data-types-intro)
    - _This is a good starting point to learn the Redis API and data model._
- [Introduction to Redis streams](https://redis.io/topics/streams-intro)
    - _A detailed description of the Redis 5 new data type, the Stream._
- [Writing a simple Twitter clone with PHP and Redis](https://redis.io/topics/twitter-clone)
- [Auto complete with Redis](http://autocomplete.redis.io/)
- [Data types short summary](https://redis.io/topics/data-types)
    - A short summary of the different types of values that Redis supports, not as updated and info rich as the first tutorial listed in this section.
- [FAQ](https://redis.io/topics/faq)
    - Some common questions about Redis.

### Administration

- [Redis-cli](https://redis.io/topics/rediscli)
    - Learn how to master the Redis command line interface, something you'll be using a lot in order to administer, troubleshoot and experiment with Redis.
- [Configuration](https://redis.io/topics/config)
    - How to configure redis.
- [Replication](https://redis.io/topics/replication)
    - What you need to know in order to set up master-replicas replication.
- [Persistence](https://redis.io/topics/persistence)
    - Know your options when configuring Redis' durability.
- [Redis Administration](https://redis.io/topics/admin)
    - Selected administration topics.
- [Security](https://redis.io/topics/security)
    - An overview of Redis security.
- [Redis Access Control Lists](https://redis.io/topics/acl)
    - Starting with version 6 Redis supports ACLs.
    - It is possible to configure users able to run only selected commands and able to access only specific key patterns.
- [Encryption](https://redis.io/topics/encryption)
    - How to encrypt Redis client-server communication.
- [Signals Handling](https://redis.io/topics/signals)
    - How Redis handles signals.
- [Connections Handling](https://redis.io/topics/clients)
    - How Redis handles clients connections.
- [High Availability](https://redis.io/topics/sentinel)
    - Redis Sentinel is the official high availability solution for Redis.
- [Latency monitoring](https://redis.io/topics/latency-monitor)
    - Redis integrated latency monitoring and reporting capabilities are helpful to tune Redis instances for low latency workloads.
- [Benchmarks](https://redis.io/topics/benchmarks)
    - See **how fast Redis is in different platforms.**
- _[Redis Releases](https://redis.io/topics/releases)_
    - _Redis development cycle and version numbering._

### _Embedded and IoT_

- [Redis on ARM and Raspberry Pi](https://redis.io/topics/ARM)
    - _Starting with Redis 4.0 ARM and the Raspberry Pi are officially supported platforms. This page contains general information and benchmarks._
- _[A reference implementation of Redis for IoT and Edge Computing can be found here](https://redislabs.com/redis-enterprise/more/redis-edge/)._

### Troubleshooting

- [Redis problems?](https://redis.io/topics/problems)
    - Bugs? **High latency?** Other issues?
    - Use [our problems troubleshooting page](https://redis.io/topics/problems) as a starting point to find more information.

### Redis Cluster

- [Redis Cluster tutorial](https://redis.io/topics/cluster-tutorial)
    - a gentle introduction and setup guide to Redis Cluster.
- [Redis Cluster specification](https://redis.io/topics/cluster-spec)
    - the more formal description of the behavior and algorithms used in Redis Cluster.

### Other distributed systems based on Redis

- [Redis CRDTs](https://redislabs.com/redis-enterprise/technology/active-active-geo-distribution/) an **active-active geo-distribution solutions** for Redis.
- [Roshi](https://github.com/soundcloud/roshi) is a large-scale CRDT set implementation for timestamped events based on Redis and implemented in Go.
    - It was initially developed for the [SoundCloud stream](https://developers.soundcloud.com/blog/roshi-a-crdt-system-for-timestamped-events).

### Redis on SSD and persistent memory

- [Redis on Flash](https://redislabs.com/redis-enterprise/technology/redis-on-flash/) by Redis Labs extends DRAM capacity with SSD and persistent memory.

### Specifications

- [Redis Design Drafts](https://redis.io/topics/rdd)
    - Design drafts of new proposals.
- [Redis Protocol specification](https://redis.io/topics/protocol)
    - if you're implementing a client, or out of curiosity, learn how to communicate with Redis at a low level.
- [Redis RDB format](https://github.com/sripathikrishnan/redis-rdb-tools/wiki/Redis-RDB-Dump-File-Format) specification, and [RDB version history](https://github.com/sripathikrishnan/redis-rdb-tools/blob/master/docs/RDB_Version_History.textile).
- [Internals](https://redis.io/topics/internals)
    - Learn details about how Redis is implemented under the hood.

### Resources

- [Redis Cheat Sheet](https://cheatography.com/tasjaevan/cheat-sheets/redis/)
    - Online or printable function reference for Redis.

### Use cases

- [Who is using Redis](https://redis.io/topics/whos-using-redis)

### Books

The following is a list of books covering Redis that are already published. Books are ordered by release date (newer books first).

- [Mastering Redis](https://www.packtpub.com/product/mastering-redis/9781783988181) (Packt, 2016) by Jeremy Nelson.
- [Redis Essentials](https://www.amazon.com/Redis-Essentials-Maxwell-Dayvson-Silva-ebook/dp/B00ZXFCFLO) (Packt, 2015) by Maxwell Da Silva and [Hugo Tavares](https://twitter.com/hltbra)
- [Redis in Action](http://www.manning.com/carlson/) (Manning, 2013) by [Josiah L. Carlson](https://twitter.com/dr_josiah) (early access edition).
- [Instant Redis Optimization How-to](http://www.packtpub.com/redis-optimization-how-to/book) (Packt, 2013) by [Arun Chinnachamy](https://twitter.com/ArunChinnachamy).
- ~~Instant Redis Persistence (Packt, 2013) by Matt Palmer.~~
- [The Little Redis Book](https://www.openmymind.net/2012/1/23/The-Little-Redis-Book/) (Free Book, 2012) by Karl Seguin is a great free and concise book that will get you started with Redis.
- [Redis Cookbook](https://www.oreilly.com/library/view/redis-cookbook/9781449311353/) (O'Reilly Media, 2011) by [Tiago Macedo](https://twitter.com/tmacedo) and [Fred Oliveira](https://twitter.com/f).

_The following books have Redis related content but are not specifically about Redis:_

- _[Seven databases in seven weeks (The Pragmatic Bookshelf, 2012)](http://pragprog.com/book/rwdata/seven-databases-in-seven-weeks)._
- _[Mining the Social Web (O'Reilly Media, 2011)](https://www.oreilly.com/library/view/mining-the-social/9781449394752/)_
- _[Professional NoSQL (Wrox, 2011)](https://www.wiley.com/en-jp/Professional+NoSQL-p-9780470942246)_

## Commands

Reference

- Commands : https://redis.io/commands

Omited…

- See [Redis Usage](redis-usage.md)
