# rm

> remove files or directories

References

* `man rm`

## Notice

### Remove Directory

By default, it does not remove directories.

Use the `--recursive` \(`-r` or `-R`\) option to remove each listed directory, too, along with all of its contents.

### Filename with prefix `-`

To remove a file whose name starts with a '-', for example '-foo', use one of these commands:

```bash
rm -- -foo
rm ./-foo
```

### Shard

Note that if you use rm to remove a file, it might be possible to recover some of its contents, given sufficient expertise and/or time.

For greater assurance that the contents are truly unrecoverable, consider using `shred`.

## Options

### Directory

* `-r, -R, --recursive` Remove directories and their contents recursively
* `-d, --dir` _Remove empty directories_

### Prompt

* `-f, --force` Ignore nonexistent files and arguments, never prompt
* `-i` Prompt before every removal
* `-I` _Prompt once before removing more than three files, or when removing recursively;_
  * _less intrusive than `-i`, while still giving protection against most mistakes_
* `--interactive[=WHEN]` _Prompt according to WHEN: never, once \(`-I`\), or always \(`-i`\); without WHEN, prompt always_

### Protection

* `--preserve-root` Do not remove '/' \(default\)
* `--no-preserve-root` _Do not treat '/' specially_
* `--one-file-system` \_When removing a hierarchy recursively, skip any directory that is on a file system different from that of the corresponding command line argument

## Usage

### Default

```bash
rm <file>
# e.g.
rm -rf path/to/file
```

### Prompt

i for interactive

```bash
rm -i <file>

# e.g.
$ rm -i txt
rm: remove regular file ‘txt’? y
```

### Directory

Forcedly & Recursively

* It can applied to directory.

```bash
rm -rf <file_or_dir>
# e.g.
rm -rf path/to/directory
```

