# tar

> manipulate tap archives

## Options

- `c` | `-c` Create a new archive file `*.tar`
- `v` | `-v` Verbosely show progress
- `x` | `-x` Extract to disk from the archive
- `z` | `-z` Compress the resulting archive `*.gz` with `gzip`
- `f` | `-f` Read/Write the archive from/to the specified file
    - e.g.: `-f <file_name>`

## Pack

Pack

```bash
tar cvf <pacakge_name>.tar <directory_or_filenames>

# `tar cvf directory.tar directory`
```

Unpack

```bash
tar xvf <package_name>

# `tar xvf directory.tar
```

## Gzip

Pack & Gzip ( Compress )

```bash
tar czvf <archive_name>.tar.gz <directory_or_filenames>

# `tar czvf archive.tar.gz *.html`
```

Un-gzip & Unpack

```bash
tar xzvf <archive_name>.tar.gz

# `tar xzvf archive.tar.gz`
```

## Bzip2

Pack & Bzip2 ( Compress )

```bash
tar cjvf <archive>.tar.bz2 <files>
```

Un-bzip\* & Unpack

```bash
# bzip
tar xjvf <archive>.tar.bz
# bzip2
tar xjvf <archive>.tar.bz2
```
