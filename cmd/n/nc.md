# nc

On Linux

> **ncat** - Concatenate and redirect sockets
>
> - Ncat was written for the Nmap Project as a much-improved reimplementation of the venerable Netcat.

- https://nmap.org/ncat/

On BSD

> **netcat** - arbitrary TCP and UDP connections and listens

- [Linux Netcat 命令——网络工具中的瑞士军刀](https://www.oschina.net/translate/linux-netcat-command)

## Quickstart

```bash
# transfer file
## send
nc -l 8888 < tmp_someday.log
## receive
nc -n 10.1.2.3 8888 > tmp_someday.log

# transfer files
## send
tar czvf - logs | nc -l 8888
## receive
nc -n 10.1.2.3 | tar xzvf -
```

## Options

- `-4` Use **IPV4 only** : Forces nc to use IPv4 addresses only.
- `-6` Use **IPV6 only** : …
- `-l, --listen` **Listen** for an incoming connection rather than initiate a connection to a remote host.
- `-n, --nodns` **No DNS lookups**
    - Do not do any DNS or service lookups on any specified addresses, hostnames or ports.
- `-c, --sh-exec <command>` Executes the given command via /bin/sh
- `-e, --exec <command>` Executes the given command
- `-u, --udp` Use UDP instead of default TCP
- `--sctp` Use SCTP instead of default TCP

## Scan Ports

Single Port

```bash
nc -v <host_name> <port>

# e.g.
$ nc -v baidu.com 80
found 0 associations
found 1 connections:
     1: flags=82<CONNECTED,PREFERRED>
        outif en9
        src 10.235.64.55 port 55043
        dst 220.181.57.216 port 80
        rank info not available
        TCP aux info available

Connection to baidu.com port 80 [tcp/http] succeeded!
```

Multiple Ports ( Range )

```bash
nc -v -z -n <host_name> <min_port>-<max_port>

# e.g.
$ nc -v -z -n 10.4.5.6 87-88
nc: connectx to 10.4.5.6 port 87 (tcp) failed: Connection refused
found 0 associations
found 1 connections:
     1: flags=82<CONNECTED,PREFERRED>
        outif en9
        src 10.235.64.55 port 55089
        dst 10.4.5.6 port 88
        rank info not available
        TCP aux info available

Connection to 10.4.5.6 port 88 [tcp/kerberos] succeeded!
```

### Chat with Terminal

```bash
# One machine ( IP : 10.1.2.3 )
nc -l 8888

# Another
nc 10.1.2.3 8888
```

## Transfer File

> Transfer file from `local` machine to `remote`

Assume

- Both of them are in the same network.
- Hosts : ( IP or domain name )
    - Local IP : 10.1.2.3
    - Remote IP : 10.4.5.6

### Remote as Server

**Remote** : Server to Listen

```bash
# Remote server listens to local machine
nc -l <port> > <file_path>

# e.g.
nc -l 8888 > tmp_someday.log
```

**Local** : Client to Connect

```bash
nc <remote_host> <port> < <file_path>
```

```bash
# Notice : using ip with option `-n`
nc -n <remote_ip> <port> < <file_path>

#  e.g.
nc -n 10.4.5.6 8888 < tmp_20180819.log
```

### Local as Server

**Local** : Server to Listen

```bash
# Local machine listens to remote server
nc -l <port> < <file_path>

# e.g.
nc -l 8888 < tmp_20180819.log
```

**Remote** : Client to Connect

```bash
nc <local_host> <port> > <file_path>
```

```bash
# Notice : using ip with option `-n`
nc -n <remote_ip> <port> > <file_path>

# e.g.
nc -n 10.1.2.3 8888 > tmp_someday.log
```

### Trouble-shooting

Notice : Sometimes you have to transfer via **IPv4** using option **`-4`**

```bash
# Remote
nc -4l <port> > <file_path>
# Local
nc -4n <remote_host> <port> < <file_path>`
```

Optional : Check **MD5** digest for security

```bash
# on Linux
md5sum <file_path>
# on BSD
md5 <file_pahh>

# e.g.
$ md5sum file
a839fce6688124b38eca3c42d2d59b10  file
```

## Transfer Directory

> Transfer files in the directory 'logs/' from `local` machine to `remote`

Assume

- Same as 'Transfer File' above

### Local as Server

**Local** : Server to Listen

```bash
tar czvf - <directory_path> | nc -l <port>
# e.g.
tar czvf - logs | nc -l 8888
```

**Remote** : Client to Connect

- The last `-` means using the original directory name

```bash
nc -n <local_host> <port> | tar xzvf -
# e.g.
nc -n 10.1.2.3 8888 | tar xzvf -
```

### Better Zip

Packed by `tar` & Compressed by **`bzip2`**

- `*.tar.gz` is larger than `*.tbz2`

Local

```bash
tar cvf - <directory_path> | bzip2 -z | nc -l <port>
# e.g.
tar cvf - logs | bzip2 -z | nc -l 8888
```

Remote

```bash
nc -n <remote_host> <port> | bzip2 -d | tar cvf -
```
