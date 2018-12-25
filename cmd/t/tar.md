# tar

> manipulate tap archives

## Options

### Operation Modes

Common

- `c` | `-c, --create` Create a new archive file `*.tar`
- `x` | `-x, --extract, --get` Extract to disk from the archive

Seldom

- `--delete` Delete from the archive
- `r` | `-r, --append` Append files to the end of an archive
- `t` | `-t, --list` List the contents of an archive
- `u` | `-u, --update` Only append files newer than copy in archive

### Compression Options

Common

- `f` | `-f, --file=ARCHIVE` Read/Write the archive from/to the specified file
    - e.g.: `-f <file_name>`
- `a` | `-a, --auto-compress` Use archive suffix to determine the compression program!
- `j` | `-j, --bzip2` Filter the archive through bzip2
- `z` | `-z, --gzip` Filter the archive through gzip
    - Compress the resulting archive `*.gz` with `gzip`

Seldom

- `J` | `-J, --xz` Filter the archive through xz
- `Z` | `-Z, --compress` Filter the archive through compress

### Seldom

#### Overwrite Control

- `-k, --kepp-old-files` Don't replace existing files when extracting, treat them as error
- `--keep-newer-files` Don't replace existing files that are newer than their archive copies
- `--no-overwrite-dir` Preserve metadata of existing directories
- `--overwrite` Overwrite existing files when extracting
- `--overwrite-dir` Overwrite metadata of existing directories when extracting **(default)**
- `--remove-files` Remove files after adding files to the archive
- `--skip-old-files` Don't replace existing files when extracting, silently skip over them

#### File Attributes

Handling of file attributes

- `--group=NAME` Force NAME as group for added files
- `--mode=CHANGES` Force (symbolic) mode CHANGES for added files
- `-m, --touch` Don't extract file modified time
- `--no-same-owner` Extract files as yourself **(default for ordinary users)**
- `--owner=NAME` Force NAME as owner for added files
- `--same-owner` Try extracting files with the same ownership as exists in the archive **(default for superuser)**

### Others

Local File Selection

- `-P, --absolute-names` Don't strip leading `/'s form file name

Infomative Output

- `v` | `-v` Verbosely show progress

## Pack

Pack

```bash
tar cvf <pacakge_name>.tar <directory_or_filenames>
# e.g.
tar cvf directory.tar directory
```

Unpack

```bash
tar xvf <package_name>.tar
# e.g.
tar xvf directory.tar
```

## List

```bash
tar tf <package_name>.tar
# e.g.
tar tf directory.tar
```

## Gzip

Pack & Gzip ( Compress )

```bash
tar czvf <archive_name>.tar.gz <directory_or_filenames>
# e.g.
tar czvf archive.tar.gz *.html
```

Un-gzip & Unpack

```bash
tar xzvf <archive_name>.tar.gz
# e.g.
tar xzvf archive.tar.gz
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
