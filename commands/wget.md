# wget

> The non-interactive network downloader.

- GNU Wget is a free utility for non-interactive download of files from the Web.
- It supports **HTTP**, **HTTPS**, and **FTP** protocols, as well as retrieval through HTTP proxies.

## Options

- `-O file` | `--output-document=file` written to "file"
- `--no-check-certificate` Don't check the server certificate

## Usage

Download as **original filename**

```bash
wget [url_to_file]

# `wget https://raw.githubusercontent.com/IceHe/mac-conf/master/.vimrc`
```

Download as **specified filename**

```bash
wget -O [specified_filename] [url_to_file]

# `wget -O _vimrc https://raw.githubusercontent.com/IceHe/mac-conf/master/.vimrc`
```
