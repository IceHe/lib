# wget

> The non-interactive network downloader.

* GNU Wget is a free utility for non-interactive download of files from the Web.
* It supports **HTTP**, **HTTPS**, and **FTP** protocols, as well as retrieval through HTTP proxies.

References

* `man wget`

## Options

* `-O file` \| `--output-document=file` written to "file"
* `--no-check-certificate` Don't check the server certificate

## Usage

Download as **original filename**

```bash
wget <url_to_file>

# e.g.
wget https://raw.githubusercontent.com/IceHe/mac-conf/master/.vimrc
```

Download as **specified filename**

```bash
wget -O <specified_filename> <url_to_file>

# e.g.
$ wget -O _vimrc https://raw.githubusercontent.com/IceHe/mac-conf/master/.vimrc
--2018-11-05 22:49:27--  https://raw.githubusercontent.com/IceHe/mac-conf/master/.vimrc
Resolving raw.githubusercontent.com (raw.githubusercontent.com)... 151.101.108.133
Connecting to raw.githubusercontent.com (raw.githubusercontent.com)|151.101.108.133|:443... connected.
HTTP request sent, awaiting response... 200 OK
Length: 1954 (1.9K) [text/plain]
Saving to: ‘_vimrc’

100%[========================================================================================>] 1,954       --.-K/s   in 0s

2018-11-05 22:49:27 (23.5 MB/s) - ‘_vimrc’ saved [1954/1954]
```

