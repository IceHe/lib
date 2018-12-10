# Redis

> REmote DIctionary Server

- Redis : https://redis.io
    - Commands : https://redis.io/commands
    - Documentation : https://redis.io/documentation
    - Download : https://redis.io/download

## Prepare

### Install

```bash
# on CentOS 7
yum install redis

# on macOS
brew install redis
```

### Start

Service ( recommended )

```bash
systemctl [start|stop|restart|status] redis
```

Manually

```bash
redis-server
```

## Config

Config files

- /etc/redis.conf
- /etc/redis-sentinel.conf

### redis.conf

```properties
# There are all default values below.

# bind : listen to specified interfaces
bind 127.0.0.1

# port : accept connections on specified port
port 6379

# protection-mode : it is on if
#   - not bound to specified addresses explicitly
#   - no password is configured
protection-mode yes

# requirepass : before processing any other commands
#   - `AUTH [password]`
#   - `redis-cli -h [host] -p [port] -a [password]`
# ( It is default commented out. )
requiredpass foobared
```

## Commands

### Access

if `requiredpass` is on

```bash
redis-cli -h [host] -p [port] -a [password]
# e.g. `redis -h 127.0.0.1 -p 6379 -a foobared`
```

or

```bash
redis-cli -h [host] -p [port]
# e.g. `redis -h 127.0.0.1 -p 6379

> AUTH [password]
# e.g. `AUTH foobared`
```

### SET

```bash
set key value [EX seconds] [PX milliseconds] [NX|XX]
# e.g. `set foo bar EX 180 NX`
```

Options

- EX seconds : Set the specified expire time, in seconds.
- PX milliseconds : Set the specified expire time, in milliseconds.
- NX : Only set the key if it does not already exist.
- XX : Only set the key if it already exist.

Q & A

- SET without expiry ( [ref](https://stackoverflow.com/questions/40019390/redis-set-with-option-without-expiry) )
    - Send `set` command without `EX` option

### INFO

```bash
info
dbsize
keys *
# 清除单个库所有key数据
flushdb
# 清除所有库所有key数据
flushall
```

---

## TEMP

部分基本知识：

1. 任何二进制的序列都可以作为 key 使用
2. Redis 有统一的规则来设计 key
3. 对 key-value 允许的最大长度是 512MB

应用场景：

1. 最常用的就是 __会话缓存__
2. __消息队列__，比如支付
3. 活动 __排行榜__ 或 __计数__
4. __发布、订阅__ 消息（消息通知）（pubsub？）
5. 商品列表、评论列表等

ref : https://www.itcodemonkey.com/article/3506.html

微博单台 Redis 示例能扛 5w QPS

---

### 源码解析

- [Zeech's Tech Blog](http://zcheng.ren/index.html) -
- [ZeeCoder](https://blog.csdn.net/terence1212)
    - 以上两个博客有 Redis 源码分析的内容
- [Redis 源码分析 - huangz/note](http://note.huangz.me/storage/redis_code_analysis/index.html) 许多 Redis 书籍均由该作者翻译
- [Redis 命令参考](http://redisdoc.com/)
- 注释版源码
    - 2.6 : https://github.com/huangz1990/annotated_redis_source
    - 3.0 : https://github.com/huangz1990/redis-3.0-annotated
- 1.0 源码阅读
    - http://pein0119.github.io/2014/08/18/-Redis-10%E4%BB%A3%E7%A0%81%E9%98%85%E8%AF%BB%EF%BC%88%E4%B8%80%EF%BC%89---%E5%BC%80%E7%AF%87/
