# Redis Basics

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
        - **Redis 深度历险：核心原理与应用实践** : https://juejin.im/book/5afc2e5f6fb9a07a9b362527 ( 推荐 )
    - 容量评估
        - **Redis 容量预估** - 极数云舟 : http://www.redis.cn/redis_memory/
        - Redis 容量评估模型 - 腾讯游戏学院 : https://gameinstitute.qq.com/community/detail/114987

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
