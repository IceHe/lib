# ln

> make links between files

References

* `man ln`
* GNU Coreutils : [https://www.gnu.org/software/coreutils/manual/html\_node/ln-invocation.html](https://www.gnu.org/software/coreutils/manual/html_node/ln-invocation.html)

## Quickstart

```bash
# File
ln file link        # Create hard (physical) link to file
ln -s file link     # Create soft (symbolic) link …

# Directory
# macOS : Symbolic link only!
# Linux : Maybe allow superuser to attempt to hard link dirs
# ( will probably fail due to system restrictions, even for superuser )
ln -s dir link      # Create soft link to dir

# Recommended : with options -iv
# -i, --interactive : Prompt whether to rm destinations
# -v, --verbose     : Print names of each linked file
ln -iv file link
ln -siv file link
ln -siv dir link

# Check Link ( via `ls` )
ls -hl link     # Check link
ls -hl          # Check current working dir
# -h, --human-readable : Print human readable sizes
# -l : Use a long listing format
```

## Synopsis

Create a link to TARGET with the name LINK\_NAME.

```bash
ln [OPTION]... [-T] TARGET LINK_NAME
```

Create a link to TARGET in the current directory.

```bash
ln [OPTION]... TARGET
```

_Create links to each TARGET in DIRECTORY._

```bash
ln [OPTION]... TARGET... DIRECTORY
ln [OPTION]... -t DIRECTORY TARGET...
```

Default

* Create hard links by default, symbolic links with `--symbolic`.
* Each destination \(name of new link\) should not already exist.
* When creating hard links, each TARGET must exist.
* Symbolic links can hold arbitrary text;
  * if later resolved, a relative link is interpreted in relation to its parent directory.

Aliases for link types

* hard link : physical link
* soft link : symbolic link

## Options

### Types

* `-d, -F, --directory` Allow the superuser to attempt to hard link directories
* `-P, --physical` Make **hard links** directly to symbolic links \( default \)
* `-r, --relative` Create symbolic links relative to link location
* `-s, --symbolic` Make **symbolic links** instead of hard links

Notice

* Using `-s` ignores `-L` and `-P`.
  * Otherwise, the last option specified controls behavior when a TARGET is a symbolic link, defaulting to `-P`.

### Interact

* `-f, --force` Remove existing destination files
* `-i, --interactive` Prompt whether to remove destinations
* `-L, --logical` Dereference TARGETs that are symbolic links
* `-n, --no-dereference` Treat LINK\_NAME as a normal file if it is a symbolic link to a directory
* `-t, --target-directory=DIRECTORY` Specify the DIRECTORY in which to create the links
* `-T, --no-target-directory` Treat LINK\_NAME as a normal file always

### Others

* `-v, --verbose` Print name of each linked file
* `--backup[=CONTROL]` _Make a backup of each existing destination file_
* `-b` _Like `--backup` but does not accept an argument_
  * _Note: will probably fail due to system restrictions, even for the superuser_
* `-S, --suffix=SUFFIX` _Override the usual backup suffix_

## Usage

### Common

* Hard Link \( Default \)

```bash
ln -iv <target> <link>
```

* Soft Link

```bash
ln -isv <target> <link>
```

```bash
$ ln -sv file link
‘link’ -> ‘file’

# check
$ ls -hl link
lrwxrwxrwx 1 root root 4 Nov  5 14:22 link -> file
```

```bash
$ ln -s ../file

# check
$ ls -l file
lrwxrwxrwx 1 root root 7 Nov  5 14:33 file -> ../file
```

### Directory

> Soft Link Only!

```bash
# error : hard link
$ ln -d dir/sub_dir sub_dir_hard
ln: failed to create hard link ‘sub_dir_hard’ => ‘dir/sub_dir’: Operation not permitted

# ok : soft link
$ ln -dsv dir/sub_dir sub_dir
‘sub_dir/sub_dir’ -> ‘dir/sub_dir’

# check
$ ls -hl sub_dir
lrwxrwxrwx 1 root root 11 Nov  5 14:47 sub_dir -> dir/sub_dir
```

## Links

References

* What is the difference between a hard link and a symbolic link? [https://medium.com/@wendymayorgasegura/what-is-the-difference-between-a-hard-link-and-a-symbolic-link-8c0493041b62](https://medium.com/@wendymayorgasegura/what-is-the-difference-between-a-hard-link-and-a-symbolic-link-8c0493041b62)
* Wikipedia
  * Symbolic link : [https://en.wikipedia.org/wiki/Symbolic\_link](https://en.wikipedia.org/wiki/Symbolic_link)
  * Hard link : [https://en.wikipedia.org/wiki/Hard\_link](https://en.wikipedia.org/wiki/Hard_link)

### Intro

> **本质** 是映射

Categories

* Hard Link : 硬链接
  * 映射到 **inode**
* Symbolic Link : 符号链接 / 软链接
  * 映射到 **路径** 值

链接会保持每一处被链接文件的同步性

* 即无论从哪个位置的链接修改文件内容，文件都会发生相同的变化

Symbolic link 比较常用

### Hard Link

* 以文件副本的形式存在，但不占用实际空间
  * 就像一个文件有多个文件名（alias 别名）
* 不允许给「目录」创建链接
* 只有在同一个「文件系统」或「分区」中才能创建链接

### Symbolic Link

* 保存的是「路径」的值
  * 类似于 Windows 操作系统中的快捷方式
* 可以给「目录」创建链接
* 可以跨「文件系统、分区」进行链接
* 可以对一个不存在的文件进行链接

删除 symbolic link 并不影响被指向的文件

* 但若被链接的原文件被删除，则相关的 symbolic link 会成为死链接
* 若被指向的路径文件被重新创建，则死链接可以恢复为正常的链接

### Delete Hard Link

* Q : How to delete a hard link?
* A : Just `rm` it.
  * You just have two names for the same file.
  * Deleting just one of the names will not delete the other.
* Reference : [https://askubuntu.com/questions/75738/how-do-i-delete-a-hard-link](https://askubuntu.com/questions/75738/how-do-i-delete-a-hard-link)

