# wget

The non-interactive network downloader.

---

- GNU Wget is a free utility for non-interactive download of files from the Web.
- It supports **HTTP**, **HTTPS**, and **FTP** protocols, as well as retrieval through HTTP proxies.

References

- `man wget`

## Quickstart

```bash
wget file       # Download file
wget -c file    # Continue stopped download
wget -r url     # Recursively download files from url
wget -O filename file   # Download file to specified location
```

## Options

- `-O file` | `--output-document=file` written to "file"
- `--no-check-certificate` Don't check the server certificate

## Usage

### Download as original filename

```bash
wget <file_url>

# e.g.
$ wget https://raw.githubusercontent.com/IceHe/mac-conf/master/README.md
--2021-07-17 09:42:31--  https://raw.githubusercontent.com/IceHe/mac-conf/master/README.md
Connecting to 127.0.0.1:1083... connected.
Proxy request sent, awaiting response... 200 OK
Length: 63 [text/plain]
Saving to: ‘README.md.1’

README.md.1                                  100%[=============================================================================================>]      63  --.-KB/s    in 0s

2021-07-17 09:42:33 (1.88 MB/s) - ‘README.md.1’ saved [63/63]
```

### Download as specified filename

```bash
wget -O <new_filename> <file_url>

# e.g.
$ wget -O WGET.md https://raw.githubusercontent.com/IceHe/mac-conf/master/README.md
--2021-07-17 09:45:00--  https://raw.githubusercontent.com/IceHe/mac-conf/master/README.md
Connecting to 127.0.0.1:1083... connected.
Proxy request sent, awaiting response... 200 OK
Length: 63 [text/plain]
Saving to: ‘WGET.md’

WGET.md                                      100%[=============================================================================================>]      63  --.-KB/s    in 0s

2021-07-17 09:45:00 (3.00 MB/s) - ‘WGET.md’ saved [63/63]
```

### Continue stopped download

```bash
wget -c <file_url>

# e.g.
$ wget -c -O WGET.md https://raw.githubusercontent.com/IceHe/mac-conf/master/README.md
--2021-07-17 09:45:27--  https://raw.githubusercontent.com/IceHe/mac-conf/master/README.md
Connecting to 127.0.0.1:1083... connected.
Proxy request sent, awaiting response... 416 Range Not Satisfiable

    The file is already fully retrieved; nothing to do.
```
