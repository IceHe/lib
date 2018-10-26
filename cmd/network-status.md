# netstat

On Linux

> Print network connections, routing tables, interface statistics, masquerade connections, and multicast memberships

On BSD

> show network status

- Here is intro to use `netstat` on Linux
- Notice : It is different between macOS (FreeBSD) & Linux !

References

- [netstat 的 10 个基本用法](https://linux.cn/article-2434-1.html)

## Options

Linux

- `-a, --all` **All** sockets
    - both listening and non-listening sockets
- `-l, --listening` Only **listening** sockets
- `-n, --numeric` Show **numerical addresses**
    - instead of trying to determine symbolic host, port or user names
- `-p, --program` Show **PID & name of program**
    - to which each socket belongs
- `-t, --tcp` Only **TCP**
- `-u, --udp` Only **UDP**

## Usage

All

```bash
netstat -a
```

TCP

```bash
netstat -at
# differ `netstat -t`
```

UDP

```bash
netstat -au
# differ `netstat -u`
```

TCP **with PID & program name**

- `-p` option

```bash
netstat -anpt
```

TCP **listening** sockets with PID & program name

- `-l` option

```bash
netstat -alnpt
```

Show **active** sockets

- ESTABLISHED means active.

```bash
netstat -anpt | grep ESTA
```

## Socket States

Normally this can be one of several values as follow.

|state|descript|
|:-|:-|
|ESTABLISHED|The socket has an established connection.|
|SYN_SENT|The socket is actively attempting to establish a connection.|
|SYN_RECV|A connection request has been received from the network.|
|FIN_WAIT1|The socket is closed, and the connection is shutting down.|
|FIN_WAIT2|Connection is closed, and the socket is waiting for a shutdown from the remote end.|
|TIME_WAIT|The socket is waiting after close to handle packets still in the network.|
|CLOSE|The socket is not being used.|
|CLOSE_WAIT|The remote end has shut down, waiting for the socket to close.|
|LAST_ACK|The remote end has shut down, and the socket is closed. <br/> Waiting for acknowledgement.|
|LISTEN|The socket is listening for incoming connections. <br/> Such sockets are not included in the output <br/> unless you  specify the --listening (-l) or --all (-a) option.|
|CLOSING|Both sockets are shut down but we still don't have all our data sent.|
|UNKNOWN|The state of the socket is unknown.|
