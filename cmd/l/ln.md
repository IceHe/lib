# ln

> make links between files

Reference

- GNU Coreutils : https://www.gnu.org/software/coreutils/manual/html_node/ln-invocation.html

## Synopsis

Create a link to TARGET with the name LINK_NAME.

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

- Create hard links by default, symbolic links with `--symbolic`.
- Each destination (name of new link) should not already exist.
- When creating hard links, each TARGET must exist.
- Symbolic links can hold arbitrary text;
    - if later resolved, a relative link is interpreted in relation to its parent directory.

## Options

### Types

- `-d, -F, --directory` Allow the superuser to attempt to hard link directories
- `-P, --physical` Make **hard links** directly to symbolic links ( default )
- `-r, --relative` Create symbolic links relative to link location
- `-s, --symbolic` Make **symbolic links** instead of hard links

Notice

- Using `-s` ignores `-L` and `-P`.
    - Otherwise, the last option specified controls behavior when a TARGET is a symbolic link, defaulting to `-P`.

### Interact

- `-f, --force` Remove existing destination files
- `-i, --interactive` Prompt whether to remove destinations
- `-L, --logical` Dereference TARGETs that are symbolic links
- `-n, --no-dereference` Treat LINK_NAME as a normal file if it is a symbolic link to a directory
- `-t, --target-directory=DIRECTORY` Specify the DIRECTORY in which to create the links
- `-T, --no-target-directory` Treat LINK_NAME as a normal file always

### Others

- `-v, --verbose` Print name of each linked file
- `--backup[=CONTROL]` _Make a backup of each existing destination file_
- `-b` _Like `--backup` but does not accept an argument_
    - _Note: will probably fail due to system restrictions, even for the superuser_
- `-S, --suffix=SUFFIX` _Override the usual backup suffix_

## Usage

### Common

- Hard Link ( Default )

```bash
ln -iv <target> <link>
```

- Symbolic Link

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

> Symbolic Link Only!

```bash
# error : hard link
$ ln -d dir/sub_dir sub_dir_hard
ln: failed to create hard link ‘sub_dir_hard’ => ‘dir/sub_dir’: Operation not permitted

# ok : symbolic link
$ ln -dsv dir/sub_dir sub_dir
‘sub_dir/sub_dir’ -> ‘dir/sub_dir’

# check
$ ls -hl sub_dir
lrwxrwxrwx 1 root root 11 Nov  5 14:47 sub_dir -> dir/sub_dir
```

## Links

### Symbolic Link

> 符号连接 / 软连接

### Hard Link

Reference : https://askubuntu.com/questions/75738/how-do-i-delete-a-hard-link

- Q : How to delete a hard link?
- A : Just `rm` it.
    - You just have two names for the same file.
    - Deleting just one of the names will not delete the other.

### Differences

链接分类
在Linux中，链接可分为两类:硬链接(Hard Link)和符号链接(Symbolic Link)，亦称软链接。默认的类型为硬链接。

硬链接(Hard Link)
硬链接就像一个文件有多个文件名，以文件副本的形式存在。硬链接主要的特性如下：

不能在不同的文件系统之间创建硬链接，即链接文件和被链接文件必须在同一文件系统中
硬链接无法引用目录
只能对已经存在的文件夹进行创建
删除硬链接文件并不影响被链接的文件
符号链接(Symbolic Link)
符号链接是为了克服硬链接的局限性而创建的。通过创建一个特殊的文件，该文件指向另一个文件的位置，所有的读写文件内容的命令被用于符号链接时，将沿着链接方向前进访问实际文件。类似于Windows中的快捷方式。

符号链接可以跨文件系统
符号链接可以对文件或目录创建
可对不存在的文件或目录创建链接
删除符号链接并不影响被指向的文件，但若被指向的原文件被删除，则相关的符号链接会成为死链接，若被指向的路径文件被重新创建，则死链接可以恢复为正常的链接
两者联系与区别
1.ln命令会保持每一处链接文件的同步性，即无论更改哪一个位置，其它的文件都会发生相同的变化
2.两者都是一种映射，硬链接映射到inode,符号链接仅是链接到一个路径。
简单的说，符号链接就像是快捷方式，而硬链接就像是备份。符号链接可以做跨分区的链接，而硬链接由于inode的缘故，只能是本分区中做链接，因此符号链接使用的频率要高一些。

简书 : https://www.jianshu.com/p/63cb33ef8ea3