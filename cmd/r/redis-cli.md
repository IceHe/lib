# redis-cli

> Redis Client

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
