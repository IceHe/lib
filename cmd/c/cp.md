# cp

> copy files and directories

## Quickstart

```bash
cp file new_file        # Copy file
cp -r dir new_dir       # Copy directory
cp -R dir new_dir
cp file dir             # Copy file to dir
cp -t dir file1 file2   # Copy files to dir
```

Notice

```bash
# All the same
cp -r dir new_dir
cp -r dir/ new_dir
cp -r dir new_dir/
cp -r dir/ new_dir/

# If `new_dir` has been existed,
# `dir` will be copied into `new_dir`.
# e.g.
$ mkdir dir
$ cp -r dir new_dir
$ ls new_dir
# output noting
$ cp -r dir new_dir
$ ls new_dir/
dir
```

## Synopsis

```bash
cp [OPTION]... [-T] SOURCE DEST
cp [OPTION]... SOURCE... DIRECTORY
cp [OPTION]... -t DIRECTORY SOURCE...
```

Copy SOURCE to DEST, or multiple SOURCE(s) to DIRECTORY.

## Options

### Interact

- `-f, --force` if an existing destination file cannot be opened, remove it and try again
    - this option is ignored when the `-n` option is also used
- `-i, --interactive` prompt before overwrite
    - overrides a previous `-n` option
- `-n, --no-clobber` do not overwrite an existing file
    - overrides a previous `-i` option

### Common

- `-p` same as `--preserve=mode,ownership,timestamps`
- `-R, -r, --recursive` copy directories recursively
- `-t, --target-directory=DIRECTORY` move all SOURCE arguments into DIRECTORY
- `-u, --update` copy only when the SOURCE file is newer than the destination file
    - or when the destination file is missing

### Link

- `-l, --link` hard link files instead of copying
- `-s, --symbolic-link` make symbolic links instead of copying

### Others

- `-a, --archive` same as `-dR --preserve=all` ( 归档文件夹，并保留现有的属性 )
    - for archiving directory
    - perserve links, file attributes (context, xattr) & content
- `-b` like `--backup` but does not accept an argument
- `--backup[=CONTROL]` make a backup of each existing destination file
- _`-d` same as `--no-dereference --preserve=links`_
    - _`-L, --dereference` always follow symbolic links in SOURCE_
    - _`-P, --no-dereference` never follow symbolic links in SOURCE_
- `--preserve[=ATTR_LIST]` preserve the specified attributes (default: mode,ownership,timestamps)
    - if possible additional attributes: context, links, xattr, all
    - _`--no-preserve=ATTR_LIST` don't preserve the specified attributes_
- _`--remove-destination` remove each existing destination file before attempting to open it ( contrast with `--force` )_
- `-x, --one-file-system` stay on this file system
- ……

## Usage

### File

#### Default

```bash
cp <source_file> <destination_file>
```

#### Force

```bash
cp -f <source_file> <destination_file>
```

#### Preserve

Include : mode, ownership & timestamps

```bash
cp -p <source_file> <destination_file>
```

#### Only When Updated

```bash
cp -u <source_file> <destination_file>
```

#### **Files To Directory**

```bash
cp -t <destination_dir> <source_file1> <source_file2> ……

# e.g.
$ cp -t dest_dir/ file sample words
# check
$ ls dest_dir/
file  sample  words
```

#### _Backup_

```bash
cp -b <source> <destination_dir>
# cannot use option `-f` to force execution without confirmation
```

### Directory

#### Recursive

```bash
cp -r <source_dir> <destination_dir>
# same as
cp -R <source_dir> <destination_dir>
```

#### _Archive_

```bash
cp -a <source_dir> <destination_dir>
```

### Link

- Use relative paths for relative links.
- Use absolute paths for absolute links.

#### Hard Link

```bash
cp -l <source> <destination>
```

#### Symbolic Link

```bash
cp -s <source> <destination>
```

### Follow Symbolic Link

```bash
cp -LR <source_dir> <destination_dir>
```
