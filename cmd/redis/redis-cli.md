# redis-cli

> Redis Client

References

- 9个提升逼格的redis命令 : http://cmsblogs.com/?p=2642

## Synopsis

```bash
redis-cli [ options ] [cmd [arg [arg ...]]]
```

It is a command line client to redis-server.

Redis is an open source (BSD licensed), in-memory data structure store, used as database, cache and message broker, found at http://redis.io/

## Options

### Connect

- `-h hostname` Server hostname (default: 127.0.0.1).
- `-p port` Server port (default: 6379).
- `-s socket` Server socket (overrides hostname and port).
- `-a password` Password to use when connecting to the server.

### Execute Command

- `-r repeat` Execute specified command N times.
- `-i interval` When -r is used, waits interval seconds per command.  It is possible to specify sub-second times like `-i 0.1`.
- `-n db` Database number.
- `-x` Read last argument from STDIN.
- `-d delimiter` Multi-bulk delimiter in for raw formatting (default: 0).
- `-c` Enable cluster mode (follow -ASK and -MOVED redirections).
- `--raw` Use raw formatting for replies (default when STDOUT is not a tty).
- `--no-raw` Force formatted output even when STDOUT is not a tty.
- `--csv` Output in CSV format.
- `--stat` Print rolling stats about server: mem, clients, ...
- `--latency` Enter a special mode continuously sampling latency.
- `--latency-history` Like `--latency` but tracking latency changes over time.
    - Default time interval is 15 sec.
    - Change it using `-i`.
- `--latency-dist` Shows latency as a spectrum, requires xterm 256 colors.
    - Default time interval is 1 sec.
    - Change it using `-i`.
- `--lru-test` Simulate a cache workload with an 80-20 distribution.
- `--slave` Simulate a slave showing commands received from the master.
- `--rdb filename` Transfer an RDB dump from remote server to local file.
- `--pipe` Transfer raw Redis protocol from stdin to server.
- `--pipe-timeout n` In `--pipe` mode,  abort  with  error if after sending all data.
    - no reply is received within n seconds.
    - Default timeout: 30.
    - Use 0 to wait forever.
- `--bigkeys` Sample Redis keys looking for big keys.
- `--scan` List all keys using the SCAN command.
- `--pattern pat` Useful with `--scan` to specify a SCAN pattern.
- `--intrinsic-latency sec` Run a test to measure intrinsic system latency.
    - The test will run for the specified amount of seconds.
- `--eval file` Send an EVAL command using the Lua script at file.
- `--ldb` Used with `--eval` enable the Redis Lua debugger.
- `--ldb-sync-mode` Like `--ldb` but uses the synchronous Lua debugger, in this mode the server is blocked and script  changes are are not rolled back from the server memory.
- `--help` Output this help and exit.
- `--version` Output version and exit.

## Usage

### Access

if `requiredpass` is on

```bash
redis-cli -h [host] -p [port] -a [password]
# e.g.
redis -h 127.0.0.1 -p 6379 -a foobared
```

or

```bash
redis-cli -h [host] -p [port]
# then
> AUTH [password]

# e.g.
$ redis -h 127.0.0.1 -p 6379
> AUTH foobared
```

### Big Keys

```bash
# e.g.
$ redis-cli -h 10.2.3.4 -p 6379 --bigkeys

# Scanning the entire keyspace to find biggest keys as well as
# average sizes per key type.  You can use -i 0.1 to sleep 0.1 sec
# per 100 SCAN commands (not usually needed).

[00.00%] Biggest list   found so far '5c1b290fd103a310dec9c496' with 1 items
[00.00%] Biggest list   found so far '5b16014d13e7b8020c58d4c6' with 6 items
[00.00%] Biggest list   found so far '5c1b57ebd103a310dec9c49b' with 5088 items
[00.00%] Biggest zset   found so far 'CACHE_SCRIPT_NAME_S' with 1 members
[41.73%] Biggest string found so far 'CACHE_NUMS' with 1 bytes
[74.02%] Biggest hash   found so far 'CACHE_SCRIPT_NAME_MAPPER' with 1 fields

-------- summary -------

Sampled 127 keys in the keyspace!
Total key length in bytes is 3000 (avg len 23.62)

Biggest string found 'CACHE_NUMS' has 1 bytes
Biggest   list found '5c1b57ebd103a310dec9c49b' has 5088 items
Biggest   hash found 'CACHE_SCRIPT_NAME_MAPPER' has 1 fields
Biggest   zset found 'CACHE_SCRIPT_NAME_S' has 1 members

1 strings with 1 bytes (00.79% of keys, avg size 1.00)
123 lists with 77739 items (96.85% of keys, avg size 632.02)
0 sets with 0 members (00.00% of keys, avg size 0.00)
1 hashs with 1 fields (00.79% of keys, avg size 1.00)
2 zsets with 2 members (01.57% of keys, avg size 1.00)
0 streams with 0 entries (00.00% of keys, avg size 0.00)
```

### Examples

From `man redis-cli`

```bash
cat /etc/passwd | redis-cli -x set mypasswd
redis-cli get mypasswd
redis-cli -r 100 lpush mylist x
redis-cli -r 100 -i 1 info | grep used_memory_human:
redis-cli --eval myscript.lua key1 key2 , arg1 arg2 arg3
redis-cli --scan --pattern '*:12345*'
```

## Commands

### info

References

- EN : https://redis.io/commands/info
- ZH : http://redisdoc.com/server/info.html

Synopsis

```bash
info [section]

# e.g.
info
info server
info clients
info memory
info persistence
info stats
info replication
info cluster
……
```

Related

```bash
# Return the number of keys
#   in the currently-selected database.
dbsize
```

#### server

```bash
> info server
# Server
redis_version:5.0.3
redis_git_sha1:00000000
redis_git_dirty:0
redis_build_id:9573a1a5353b9b70
redis_mode:standalone
os:Darwin 17.7.0 x86_64
arch_bits:64
multiplexing_api:kqueue
atomicvar_api:atomic-builtin
gcc_version:4.2.1
process_id:82973
run_id:e317fc233ce8f5702860a881f9ca81d987fb248d
tcp_port:6379
uptime_in_seconds:1581
uptime_in_days:0
hz:10
configured_hz:10
lru_clock:3940823
executable:/usr/local/opt/redis/bin/redis-server
config_file:/usr/local/etc/redis.conf
```

#### memory

```bash
> info memory
# Memory
used_memory:9366144
used_memory_human:8.93M
used_memory_rss:3596288
used_memory_rss_human:3.43M
used_memory_peak:9366144
used_memory_peak_human:8.93M
used_memory_peak_perc:100.00%
used_memory_overhead:1042822
used_memory_startup:987024
used_memory_dataset:8323322
used_memory_dataset_perc:99.33%
allocator_allocated:9332800
allocator_active:3558400
allocator_resident:3558400
total_system_memory:17179869184
total_system_memory_human:16.00G
used_memory_lua:37888
used_memory_lua_human:37.00K
used_memory_scripts:0
used_memory_scripts_human:0B
number_of_cached_scripts:0
maxmemory:0
maxmemory_human:0B
maxmemory_policy:noeviction
allocator_frag_ratio:0.38
allocator_frag_bytes:18446744073703777216
allocator_rss_ratio:1.00
allocator_rss_bytes:0
rss_overhead_ratio:1.01
rss_overhead_bytes:37888
mem_fragmentation_ratio:0.39
mem_fragmentation_bytes:-5736512
mem_not_counted_for_evict:0
mem_replication_backlog:0
mem_clients_slaves:0
mem_clients_normal:49694
mem_aof_buffer:0
mem_allocator:libc
active_defrag_running:0
lazyfree_pending_objects:0
```

### keys

References

- EN : https://redis.io/commands/keys
- ZH : http://redisdoc.com/key/keys.html

```bash
keys <pattern>

# e.g.
> keys *
# ignore output
……
> keys C*S
1) "CACHE_SCRIPT_NAME_S"
2) "CACHE_IMAGES_S"
3) "CACHE_NUMS"
4) "CACHE_IMAGES"
```

#### flush*

清除当前（单个）库的所有 key 数据

- Ref : EN : https://redis.io/commands/flushdb

```bash
flushdb
```

清除所有库的所有 key 数据

- Ref : EN : https://redis.io/commands/flushall

```bash
flushall
```

### config

#### get

References

- EN : https://redis.io/commands/config-get

Read the configuration parameters of a running Redis server.

```bash
config get <parameter>

# e.g.
> config get *
  1) "dbfilename"
  2) "dump.rdb"
  3) "requirepass"
  4) ""
  5) "masterauth"
  6) ""
  7) "cluster-announce-ip"
  8) ""
  9) "unixsocket"
 10) ""
 11) "logfile"
 12) ""
……
```

#### set

References

- EN : https://redis.io/commands/config-set
- ZH : http://redisdoc.com/server/config_set.html

Reconfigure the server at run time without the need to restart Redis.

```bash
config set <parameter> <value>
```

#### rewrite

References

- EN : https://redis.io/commands/config-rewrite
- ZH : http://redisdoc.com/server/config_rewrite.html

Rewrites the redis.conf file the server was started with.

```bash
config rewrite
```

### set

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

---

### TMP

临时

使用 scan 比 keys 更安全

```bash
scan 0
```

查询较大的 key

```bash
redis-cli -p 6380 --bigkeys
```

重命名危险命令

```bash
rename-command flushdb flushddbb
rename-command flushall flushallall
rename-command keys keysys
```

监控 `monitor`

慢日志 `slowlog`

---
