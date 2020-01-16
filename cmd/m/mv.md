# mv

> move (rename) files

## Quickstart

```bash
mv original_name new_name           # rename file / dir

mv src_file /path/to/dest_file      # file to file path
mv src_file destination_dir/        # file to dir

mv -t dest_dir/ src_file1 src_file2 # files to dir path
```

## Synopsis

```bash
mv [OPTION]... [-T] SOURCE DEST
mv [OPTION]... SOURCE... DIRECTORY
mv [OPTION]... -t DIRECTORY SOURCE...
```

## Options

### Interact

If you specify more than one of `-i, -f, -n`, only the final one takes effect.

- `-f, --force` do not prompt before overwriting
- `-i, --interactive` prompt before overwriting
- `-n, --no-clobber` do not overwrite an existing file

### Common

- `-t, --target-directory=DIRECTORY` move all SOURCE arguments into DIRECTORY
- `-u, --update` move only when the SOURCE file is newer than the destination file or when the destination file is missing

### Others

- `--backup[=CONTROL]` make a backup of each existing destination file
- `-b` like `--backup` but does not accept an argument

See `man mv` for more.

## Usage

### Move

#### Default

```bash
mv <source_file> <destination_file>
# e.g.
mv tmp.log /tmp/tmp.log
```

```bash
mv <source_file> <destination_dir>
# e.g.
mv tmp.log /tmp/
mv *.log logs/
```

#### Files to Directory

```bash
mv -t <destination_dir> <source_file1> <source_file2> ……
# e.g.
mv -t logs/ info.log warn.log
```

### Rename

```bash
mv <source_file> <new_file_name>
# e.g.
mv tmp.log info.log
```
