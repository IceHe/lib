# Redis

## Mode

- Redis : 单线程模型
    - 单机压测 : QPS 60k
- Memcached : 多线程模型
    - 单机压测 : QPS 300k
    - 使用 libevent 库，理论上性能比 Redis 好
    - LRU 算法比较成熟
- Nginx : 多进程模型（每个进程单线程？）

## RESP

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

重写

- 理由：运行时间长之后，内容太多（有重复、有失效），需要重写
- 方法：`bgrewriteof` 命令 fork 出子进程
    - 重写 AOF 文件
    - 追加重写期间的新操作
    - 替换旧的 AOF 文件

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
