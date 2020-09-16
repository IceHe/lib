# MemcacheQ

MemcacheQ

* ~~Home Page~~ : [http://memcachedb.org/memcacheq/](http://memcachedb.org/memcacheq/) \( Invalid link on 2018-11-13 \)

Memcached

* Offical Home : [https://memcached.org/](https://memcached.org/)
* GitHub Wiki : [https://github.com/memcached/memcached/wiki](https://github.com/memcached/memcached/wiki)
  * Commands : [https://github.com/memcached/memcached/wiki/Commands\#no-reply](https://github.com/memcached/memcached/wiki/Commands#no-reply)
* Cheat Sheet : [https://lzone.de/cheat-sheet/memcached](https://lzone.de/cheat-sheet/memcached)

## Connect

```bash
telnet <ip> <port>

# e.g.
$ telnet 192.168.1.144 11211
telnet 192.168.1.144 11211
Trying 192.168.1.144...
Connected to 192.168.1.144.
Escape character is '^]'.

# interact with MCQ
$ stats queue
STAT 0 0/0
STAT 5 0/0
STAT common_export 1/1
STAT common_export#1 1/0
STAT image_recognition 58/13
STAT image_recognition#1 58/58
STAT image_recognition#2 58/12
STAT test 4/4
……
END
```

## Set

```bash
# Usage
set key flags exptime bytes [noreply]
value

# e.g.
# interact with MCQ
$ set key 0 0 78
{"type":"test","msg_time":1542126837}
STORED
```

## Get

```bash
# interact with MCQ
$ get key
VALUE key 0 37
{"type":"test","msg_time":1542126837}
END

# interact with MCQ
$ get three_d_object
END
```

