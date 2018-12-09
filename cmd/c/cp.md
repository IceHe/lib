# cp

> copy files and directories

## Synopsis

```bash
cp [OPTION]... [-T] SOURCE DEST
cp [OPTION]... SOURCE... DIRECTORY
cp [OPTION]... -t DIRECTORY SOURCE...
```

Copy SOURCE to DEST, or multiple SOURCE(s) to DIRECTORY.

## Options

- **`-a, --archive` same as `-dR --preserve=all` ( 归档文件夹，并保留现有的属性 )**
    - for archiving directory
    - perserve links, file attributes (context, xattr) & content
- _`--backup[=CONTROL]` make a backup of each existing destination file_
- _`-b` like `--backup` but does not accept an argument_
- `-d` same as `--no-dereference --preserve=links`
    - _`-L, --dereference` always follow symbolic links in SOURCE_
    - _`-P, --no-dereference` never follow symbolic links in SOURCE_
- **`-f, --force` if  an  existing  destination file cannot be opened, remove it and try again**
    - this option is ignored when the `-n` option is also used
- `-i, --interactive` prompt before overwrite
    - overrides a previous `-n` option
- **`-l, --link` hard link files instead of copying**
- `-n, --no-clobber` do not overwrite an existing file
    - overrides a previous `-i` option
- **`-p` same as `--preserve=mode,ownership,timestamps`**
- `--preserve[=ATTR_LIST]` preserve the specified attributes (default: mode,ownership,timestamps)
    - if possible additional attributes:  context, links, xattr, all
    - _`--no-preserve=ATTR_LIST` don't preserve the specified attributes_
- **`-R, -r, --recursive` copy directories recursively**
- _`--remove-destination` remove each existing destination file before attempting to open it ( contrast with `--force` )_
- **`-s, --symbolic-link` make symbolic links instead of copying**
- **`-u, --update` copy only when the SOURCE file is newer than the destination file**
    - or when the destination file is missing
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
cp -t <destination_directory> <source_file1> <source_file2> ……

# e.g.
$ cp -t dest_dir/ file sample words
# check
$ ls dest_dir/
file  sample  words
```

#### _Backup_

```bash
cp -b <source> <destination_directory>
# cannot use option `-f` to force execution without confirmation
```

### Directory

#### Recursive

```bash
cp -r <source_directory> <destination_directory>
# same as
cp -R <source_directory> <destination_directory>
```

#### _Archive_

```bash
cp -a <source_directory> <destination_directory>
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
