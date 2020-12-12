# redis-dump

Backup and restore your Redis data to and from JSON.

---

**NOTE** !!!

- **This is beta software. TEST IT BEFORE RELYING ON IT.**

References

- 几种redis数据导出导入方式 : https://www.cnblogs.com/hjfeng1988/p/7146009.html
- GitHub : https://github.com/delano/redis-dump
- Redis-Dump v0.4 BETA : http://delanotes.com/redis-dump/

## Install

```bash
gem install redis-dump -V
```

## Usage

### Dump

```bash
redis-dump -u HOST:PORT > file.json
redis-dump -u :PASSWORD@HOST:PORT > file.json

# e.g.
redis-dump -u 10.2.3.4:6379 > redis-dump.json
```

### Load

```bash
cat file.json | redis-load -u HOST:PORT
cat file.json | redis-load -u :PASSWORD@HOST:PORT

# e.g.
cat redis-dump.json | redis-load -u 127.0.0.1:6379
# or
cat redis-dump.json | redis-load -u :6379
```

## Help

Help Information

### redis-dump

```bash
$ redis-dump -h
  Try: /usr/local/bin/redis-dump show-commands
Usage: /usr/local/bin/redis-dump [global options] COMMAND [command options]
    -u, --uri=S                 Redis URI (e.g. redis://hostname[:port])
    -d, --database=S            Redis database (e.g. -d 15)
    -a, --password=S            Redis password (e.g. -a 'my@pass/word')
    -s, --sleep=S               Sleep for S seconds after dumping (for debugging)
    -c, --count=S               Chunk size (default: 10000)
    -f, --filter=S              Filter selected keys (passed directly to redis' KEYS command)
    -b, --base64                Encode key values as base64 (useful for binary values)
    -O, --without_optimizations Disable run time optimizations
    -V, --version               Display version
    -D, --debug
        --nosafe
```

### redis-load

```bash
$ redis-load -h
  Try: /usr/local/bin/redis-load show-commands
Usage: /usr/local/bin/redis-load [global options] COMMAND [command options]
    -u, --uri=S         Redis URI (e.g. redis://hostname[:port])
    -d, --database=S    Redis database (e.g. -d 15)
    -a, --password=S    Redis password (e.g. -a 'my@pass/word')
    -s, --sleep=S       Sleep for S seconds after dumping (for debugging)
    -b, --base64        Decode key values from base64 (used with redis-dump -b)
    -n, --no_check_utf8
    -V, --version       Display version
    -D, --debug
        --nosafe
```
