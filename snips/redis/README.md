# Redis

> REmote DIctionary Server

- Redis : https://redis.io
    - Commands : https://redis.io/commands
    - Documentation : https://redis.io/documentation
    - Download : https://redis.io/download

## Prepare

### Install

```bash
# on CentOS7
yum install redis

# on macOS
brew install redis
```

### Start

service ( better )

```bash
systemctl [start|stop|restart|status] redis
```

manually

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

# TODO
```

## Commands

### Access

if `requiredpass` is on

```bash
redis -h [host] -p [port] -a [password]
# e.g. `redis -h 127.0.0.1 -p 6379 -a foobared`
```

or

```bash
redis -h [host] -p [port]
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

## Other Notes

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
