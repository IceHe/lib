# netstat

On Linux

> Print network connections, routing tables, interface statistics, masquerade connections, and multicast memberships

- Here is intro to use `netstat` on Linux
- Notice : It is different between macOS (FreeBSD) & Linux !

On BSD

> show **network status**

Reference

- `man netstat`
- [netstat 的 10 个基本用法](https://linux.cn/article-2434-1.html)

## Quickstart

```bash
```

## Options

- `-a, --all` **All** sockets
    - Both listening and non-listening sockets
- `-l, --listening` Only **listening** sockets
- `-n, --numeric` **Numerical addresses**
    - Instead of trying to determine symbolic host, port or user names
- `-p, --program` **PID & name of program**
    - to which each socket belongs
- `-t, --tcp` **TCP** only
- `-u, --udp` **UDP** only

## Usage

All

```bash
$ netstat -a
Active Internet connections (servers and established)
Proto Recv-Q Send-Q Local Address        Foreign Address State
tcp        0      0 0.0.0.0:rsync        0.0.0.0:*       LISTEN
tcp        0      0 0.0.0.0:sun-sr-https 0.0.0.0:*       LISTEN
tcp        0      0 0.0.0.0:6379         0.0.0.0:*       LISTEN
tcp        0      0 0.0.0.0:ndmps        0.0.0.0:*       LISTEN
tcp        0      0 0.0.0.0:35729        0.0.0.0:*       LISTEN
tcp        0      0 0.0.0.0:ssh          0.0.0.0:*       LISTEN
tcp        0      0 0.0.0.0:30007        0.0.0.0:*       LISTEN
tcp        0      0 0.0.0.0:30008        0.0.0.0:*       LISTEN
……
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
$ netstat -anpt
Active Internet connections (servers and established)
Proto Recv-Q Send-Q Local Address           Foreign Address         State       PID/Program name
tcp        0      0 0.0.0.0:873             0.0.0.0:*               LISTEN      27010/rsync
tcp        0      0 0.0.0.0:6443            0.0.0.0:*               LISTEN      23876/nginx: master
tcp        0      0 0.0.0.0:6379            0.0.0.0:*               LISTEN      139858/redis-server
tcp        0      0 0.0.0.0:30000           0.0.0.0:*               LISTEN      207351/docker-proxy
tcp        0      0 0.0.0.0:35729           0.0.0.0:*               LISTEN      215844/node
tcp        0      0 0.0.0.0:22              0.0.0.0:*               LISTEN      1340/sshd
tcp        0      0 0.0.0.0:30007           0.0.0.0:*               LISTEN      139583/docker-proxy
tcp        0      0 0.0.0.0:30008           0.0.0.0:*               LISTEN      139601/docker-proxy
……
```

TCP **listening** sockets with PID & program name

- `-l` option

```bash
netstat -alnpt
```

Show **active** sockets

- ESTABLISHED means active.

```bash
$ netstat -anpt | grep ESTA
tcp        0      0 10.77.120.249:11782     10.55.21.239:7040       ESTABLISHED 125791/./watchagent
tcp        0      0 10.77.120.249:22        10.55.21.212:47258      ESTABLISHED 182784/sshd: zhiyua
tcp        0      0 10.77.120.249:31053     10.13.1.213:80          ESTABLISHED 73030/gitlab-runner
tcp        0      0 10.77.120.249:22        10.55.21.212:23776      ESTABLISHED 130507/sshd: zhiyua
tcp        0      0 10.77.120.249:22        10.55.21.212:40248      ESTABLISHED 169309/sshd: zhiyua
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
