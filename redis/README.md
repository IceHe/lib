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
