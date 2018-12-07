# zgrep

> search possibly compressed files for a regular expression

## Synopsis

```bash
zgrep [ grep_options ] [ -e ] pattern filename...
```

## Description

Zgrep invokes [grep](/cmd/g/grep.md) on compressed or gzipped files.

- All options specified are passed directly to grep.
- If no file is specified, then the standard input is decompressed if necessary and fed to grep.
- Otherwise the given files are uncompressed if necessary and fed to grep.
- If the GREP environment variable is set, zgrep uses it as the grep program to be invoked.

## Usage

```bash
zgrep <content> file.gz
# e.g.
zgrep -i exception info.log.gz
```
