# redis-server

> redis-server, redis-sentinel - Redis server

## Synopsis

```bash
redis-server [configuration_file] [options] [--sentinel]
redis-sentinel [configuration_file] [options]
```

- The `redis-server` command is a command line to launch a Redis server.
- The `redis-sentinel` command is a symbolic link to the `redis-server` command which imply the `--sentionel` option.

Redis is an open source (BSD licensed), in-memory data structure store, used as database, cache and message broker, found at http://redis.io/

## Options

- `-` Read configuration from stdin.
- `--sentinel` Run in sentinel mode
- `--test-memory megabytes` Run a memory check and exit.
- `--help, -h` Output this help and exit.
- `--version, -v` Output version and exit.

All parameters described in redis.conf file can be passed as command line option, e.g. `--port port`

## Usage

### Default

Run the server with default conf

```bash
redis-server
```

### Sentinel

Run in sentinel mode

```bash
redis-server /etc/sentinel.conf --sentinel
```

### With Config File

Run the server with a configuration file

```bash
redis-server /etc/redis/6379.conf
```

### With Options

Run the server changing some default options

```bash
redis-server --port 7777 --slaveof 127.0.0.1 8888
```

### With Both

Run the server with a configuration file and changing some options

```bash
redis-server /etc/myredis.conf --loglevel verbose
```
