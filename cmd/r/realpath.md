# realpath

> print the resolved path

Get **absolute path to file** !

## Options

- `-L, --logical` Resolve '..' components before symlinks
- `-P, --physical` Resolve symlinks as encountered (**default**)
- `--relative-to=FILE` Print the resolved path relative to FILE
- `--relative-base=FILE` Print absolute paths unless paths below FILE
- `-s, --strip, --no-symlinks` **Don't expand symlinks**

More : see `man realpath`

## Usage

Default

```bash
realpath <file>
# same as
readlink -f <file>

# e.g.
$ realpath sub_dir
# or
$ readlink -f sub_dir
/usr/home/icehe/dir/sub_dir

# check
$ ls -hl sub_dir
lrwxrwxrwx 1 root root 11 Nov  5 14:51 sub_dir -> dir/sub_dir
```
