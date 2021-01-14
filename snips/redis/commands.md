# Redis

## Commands

- [redis-cli](/cmd/redis/redis-cli.md) : Redis client
- [redis-server](/cmd/redis/redis-server.md) ( & redis-sentinel ) : Redis server
- [redis-dump](/cmd/redis/redis-dump.md) : Backup & restore Redis data to and from JSON

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

- Default port : 6379

```bash
redis-server
```

- Others

```bash
# e.g.
redis-server -p 6378
```

### Config

Config files

- /etc/redis.conf
- /etc/redis-sentinel.conf

#### redis.conf

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

### Slaveof

Reference : https://redis.io/commands/slaveof

```bash
# e.g.
$ redis-cli -p 6378
127.0.0.1:6378> slaveof 127.0.0.1 6379
OK
```

## Usage

### redis-cli

See command [redis-cli](/cmd/redis/redis-cli.md)

### redis-server

See command [redis-server](/cmd/redis/redis-server.md)

### Interactive Commands

References

- Redis 运维手册 : http://shouce.jb51.net/redis-all-about/Intro/index.html

#### debug

hstats

- 在 [美团针对Redis Rehash机制的探索和实践](https://mp.weixin.qq.com/s/ufoLJiXE0wU4Bc7ZbE9cDQ) 看到了查看 Redis 对象内部统计信息的图，由以下命令获得

```bash
> 127.0.0.1:6379> DEBUG HTSTATS 0
[Dictionary HT]
Hash table 0 stats (main hash table):
 table size: 4
 number of elements: 1
 different slots: 1
 max chain length: 1
 avg chain length (counted): 1.00
 avg chain length (computed): 1.00
 Chain length distribution:
   0: 3 (75.00%)
   1: 1 (25.00%)
[Expires HT]
No stats available for empty dictionaries
```

object

```bash
127.0.0.1:6379> DEBUG OBJECT h_test
Value at:0x7f8da6e1ca70 refcount:1 encoding:ziplist serializedlength:30 lru:5141558 lru_seconds_idle:501
```

#### info
