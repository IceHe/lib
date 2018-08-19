# nc

> **netcat** : arbitrary TCP and UDP connections and listens

## References

Recommended

- [Linux Netcat 命令——网络工具中的瑞士军刀](https://www.oschina.net/translate/linux-netcat-command)

## Options

- `-4` **IPV4 Only** : Forces nc to use IPv4 addresses only.
- `-l` **Listen** for an incoming connection rather than initiate a connection to a remote host.
- `-n` **No DNS lookups** : Do not do any DNS or service lookups on any specified addresses, hostnames or ports.

## Transfer File

> Transfer file from `local` machine to `remote`

Assume

- Both of them are in the intranet.
- Host IPs
    - Local : 10.1.2.3
    - Remote : 10.4.5.6

### Remote as Server

**Remote** : Server to Listen

```bash
# Remote server listens to local machine
nc -l [port] > [file_path]

# nc -l 8888 > tmp_someday.log
```

**Local** : Client to Connect

```bash
nc -n [remote_ip] [port] < [file_path]

# nc -n 10.4.5.6 8888 < tmp_20180819.log
```

### Local as Server

**Local** : Server to Listen

```bash
nc -l [port] < [file_path]

# nc -l 8888 < tmp_20180819.log
```

**Remote** : Client to Connect

```bash
nc -n [local_ip] [port] > [file_path]

# nc -n 10.1.2.3 8888 > tmp_someday.log
```

### Trouble-shooting

Notice : Sometimes you have to transfer via **IPv4** using option `-4`

```bash
# Remote
nc -4l [port] > [file_path]
# Local
nc -4n [remote_ip] [port] < [file_path]`
```

Optional : Check **MD5** digest for security

```bash
md5sum [file_path]

# Replace `md5sum` with `md5` on macOS
```

## Transfer Directory

> Transfer files in the directory 'logs/' from `local` machine to `remote`

Assume

- Same as 'Transfer File' above

Local : Server to Listen

```bash
tar -czvf - [directory_path] | nc -l [port]

```

### Local as Server

## Scan

TODO
