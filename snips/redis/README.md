# Redis

> REmote DIctionary Server

- Redis : https://redis.io
    - Commands : https://redis.io/commands
    - Documentation : https://redis.io/documentation
    - Download : https://redis.io/download
- ZH Docs : http://redisdoc.com

基本原理和方案设计

- Redis 深度历险：核心原理与应用实践 : https://juejin.im/book/5afc2e5f6fb9a07a9b362527

## Mode

- Redis : 单线程模型
    - 单机压测 : QPS 60k
- Memcached : 多线程模型
    - 单机压测 : QPS 300k
    - 使用 libevent 库，理论上性能比 Redis 好
    - LRU 算法比较成熟
- Nginx : 多进程模型（每个进程单线程？）

## RESP 序列化

> Redis Serialization Protocol

References

- 原理 2：交头接耳 —— 通信协议 : https://juejin.im/book/5afc2e5f6fb9a07a9b362527/section/5afc39496fb9a07ab458d0f1
- Redis Protocol specification : https://redis.io/topics/protocol

Redis 协议将传输的结构数据分为 5 种最小单元类型，单元结束时统一加上回车换行符号 `\r\n`。

- 单行字符串 以 `+` 符号开头。
- 多行字符串 以 `$` 符号开头，后跟字符串长度。
- 整数值 以 `:` 符号开头，后跟整数的字符串形式。
- 错误消息 以 `-` 符号开头。
- 数组 以 `*` 号开头，后跟数组的长度。

## Persistence

- 快照（RDB?）
    - `save` 同步保存
    - `bgsave` 异步保存
- AOF

### AOF

AOF : Append Only File?

- 先运行操作，再写日志到 AOF 文件
    - hbase / leveldb 等存储引擎都是：先写日志，再执行操作

用途

- 重放：从宕机中恢复服务
- 主从同步

#### 重写

- 理由：运行时间长之后，内容太多（有重复、有失效），需要重写
- 方法：`bgrewriteof` 命令 fork 出子进程
    - 重写 AOF 文件
    - 追加重写期间的新操作
    - 替换旧的 AOF 文件

#### fsync

强制写文件 `fsync`

- 理由：即使写到 AOF “文件”，但是文件内容其实还是可能丢失
    - 内核为该文件描述符提供了「内存缓存」，异步刷新回磁盘中
    - 如果此时宕机，仍然可能丢数据！
- 方法：Linux 的 glibc 提供 `fsync(int fd)` 函数，强制将文件内容刷新回磁盘。
    - 为了避免频繁 IO 影响性能，生产环境的 Redis 通常 1s 执行一次 fsync，尽量避免丢失数据
        - appendfsync everysec 默认
        - appendfsync always 总是
        - appendfsync no 永不：根据系统刷新输出缓冲区的时间来决定的，一般来说是 30s
            - 注意：只是「永不主动刷磁盘」而已，还是会等待操作系统来刷磁盘

运维

- 主从同步的架构：通常主节点不进行持久化，由相对空闲的从节点来做，减少主节点的压力。
    - 小心一致性：主节点宕机，还有网络不稳定的问题。

Redis 4.0 的数据恢复

- 先从 RDB 加载
- 再从 AOF 重放

Related

- OS 多进程 Copy On Write 机制（TODO）

## Pipeline 管道

- 多个请求合到一起发送，多个响应合到一起返回，减少网络的连接传输的次数。
    - 客户端改变读写顺序，带来性能提升？
        - 说的是？读写连续较多的数据，对服务端和客户端，IO 的效率都会提交比较多。

## Transaction 事务

- multi / exec / discard
    - 类似于 SQL 的 begin / commit / rollback
        - 但是只能放弃事务（discard），并不能回滚（rollback）
    - 与 Pipeline 结合使用
- watch：监视某个变量的值是否有变化
    - 属于「乐观锁」机制，不同于分布式锁服务的「悲观锁」机制（这个还要再理解理解）
    - 不能在 multi 和 exec 间使用 watch 命令

```bash
> watch books
OK
> incr books  # 被修改了
(integer) 1
> multi
OK
> incr books
QUEUED
> exec  # 事务执行失败
(nil)
```

## Codis 集群方案

- Ref : https://juejin.im/book/5afc2e5f6fb9a07a9b362527/section/5b029e5e5188254266432000

Codis 集群方案之一：Redis 的代理中间件

- slot 槽位：默认 1024，然后是 2048 / 4096 / …?
- 槽位存储在 ZooKeeper 或 etcd 等分布式配置服务中

代价

- 有些 Redis 命令不支持：例如 rename
- 迁移的卡顿较大
- 增加的网络开销
- 需要 zk 服务

Related?

- Sential 哨兵（机制的实现不太清楚，有很多不同版本的实现？）
    - TODO

## Cluster 官方集群方案

> Redis Cluster

- 分布式（不同于 Codis 的集中式）
- slots 槽位分为 1024 * 16 = 16384
- 每个 redis 实例都保存有所有节点的槽位信息
- cluster 客户端可以获得槽位信息表，直接访问数据所在的 Redis 实例

跳转：`-MOVED` 报错

- 说明数据所在的槽位，以及 HOST:PORT

```bash
> GET x
-MOVED 3999 127.0.0.1:6381
```

迁移：key 数据搬运

- 以 slot 为单位
- keywords : migrating / importing / asking
- 故障认定 PFAIL : Gossip 协议沟通各节点状态

## ziplist

Ziplist 压缩链表

- 小 HashTable : key value 分别作为 entry 连续存储在 ziplist 中
- 小 SortedSet : value score 分别作为 entry 连续存储在 ziplist 中
- 除了这两种结构，其它结构例如 set 不会用 ziplist 存储（是吧？）
    - Set 只有 int 时用 intset 结构存，否则用

## listpack

> Redis 5.0 对 ziplist 的改进

- 去掉了 `zltail_offset`
- 长度字段用 variant 来编码
- 消灭了「级联更新」（由于 entry 长度变长扩充内存占用，然后挪动后面的元素）
    - （这个一时还没想懂）
- 替代 ziplist：为时尚早，只在新的 Stream 数据结构中使用 listpack
    - 由于 ziplist 使用广泛，由于兼容性问题，暂时没有直接被 listpack 替换

## intset

```bash
# e.g.
> sadd test_set 1 2 3
(integer) 3

> smembers test_set
1) "1"
2) "2"
3) "3"

> OBJECT encoding test_set
"intset"

> sadd test_set ice
(integer) 1

> OBJECT encoding test_set
"hashtable"
```

## Others

PubSub 订阅

- TODO

快照同步（RDB 同步）

- 当增量同步（AOF 同步）的缓冲区满了之后，会丢失一些修改
- 所以这时需要先进行 RDB 同步，然后再重新用 AOF 同步
    - 问题：要是 RDB 同步太慢，会重蹈覆辙 —— 内存中的指令缓冲区会被填满，又得重新做 RDB 同步了……

---

## Tmp

### FAQ

- Redis strings vs Redis hashes to represent JSON: efficiency? - Stack Overflow :  https://stackoverflow.com/questions/16375188/redis-strings-vs-redis-hashes-to-represent-json-efficiency

### 15m Quickstart

部分基本知识：

- 任何二进制的序列都可以作为 key 使用
- 对 key-value 允许的最大长度是 512MB

应用场景：

1. 最常用的就是 __会话缓存__
2. __消息队列__，比如支付
3. 活动 __排行榜__ 或 __计数__
4. __发布、订阅__ 消息（消息通知）: pubsub?
5. 商品列表、评论列表等

Ref : https://www.itcodemonkey.com/article/3506.html

微博单台 Redis 示例能扛 5w QPS

### 源码解析

- [Zeech's Tech Blog](http://zcheng.ren/index.html)
- [ZeeCoder](https://blog.csdn.net/terence1212)
    - 以上两个博客有 Redis 源码分析的内容
- [Redis 源码分析 - huangz/note](http://note.huangz.me/storage/redis_code_analysis/index.html) 许多 Redis 书籍均由该作者翻译
- [Redis 命令参考](http://redisdoc.com/)
- 注释版源码
    - 2.6 : https://github.com/huangz1990/annotated_redis_source
    - 3.0 : https://github.com/huangz1990/redis-3.0-annotated
- 1.0 源码阅读
    - http://pein0119.github.io/2014/08/18/-Redis-10%E4%BB%A3%E7%A0%81%E9%98%85%E8%AF%BB%EF%BC%88%E4%B8%80%EF%BC%89---%E5%BC%80%E7%AF%87/