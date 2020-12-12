# stat

display file or file system status

---

Reference

- `man stat`
- stat-invocation : https://www.gnu.org/software/coreutils/manual/html_node/stat-invocation.html

## Options

- `-L, --dereference` Follow links
- `-f, --file-system` Display file system status instead of file status
- `-t, --terse` Print the information in terse form

### Format

- `-c  --format=FORMAT` Use the specified FORMAT instead of the default; output a newline after each use of FORMAT
- `--printf=FORMAT` Like `--format`, but interpret backslash escapes, and do not output a mandatory trailing newline; if you want a newline, include \n in FORMAT

Notice

- Your shell may have its own version of stat, which usually supersedes the version described here.
- Please  refer to your shell's documentation for details about the options it supports.

#### Files

**The valid format sequences for files (without --file-system)**

Type & Name

- `%F` file type
- `%n` file name
- `%N` _quoted file name with dereference if symbolic link_

Size

- `%s` total size, in bytes

Permissions

- `%a` access rights in octal
- `%A` access rights in human readable form

Owner

- `%g` group ID of owner
- `%G` group name of owner
- `%u` user ID of owner
- `%U` user name of owner

Timestamps

- `%w` time of file birth, human-readable; show '-' if unknown
- `%W` time of file birth, seconds since Epoch; show '0' if unknown
- `%x` time of last access, human-readable
- `%X` time of last access, seconds since Epoch
- `%y` time of last modification, human-readable
- `%Y` time of last modification, seconds since Epoch
- `%z` time of last change, human-readable
- `%Z` time of last change, seconds since Epoch

Seldom

- `%b` Number of blocks allocated (see %B)
- `%B` The size in bytes of each block reported by %b
- `%C` SELinux security context string
- `%d` device number in decimal
- `%D` device number in hex
- `%f` raw mode in hex
- `%h` number of hard links
- `%i` inode number
- `%m` mount point
- `%o` optimal I/O transfer size hint
- `%t` major device type in hex, for character/block device special files
- `%T` minor device type in hex, for character/block device special files

#### _File Systems_

_Valid format sequences for file systems_

- `%a` free blocks available to non-superuser
- `%b` total data blocks in file system
- `%c` total file nodes in file system
- `%d` free file nodes in file system
- `%f` free blocks in file system
- `%i` file system ID in hex
- `%l` maximum length of filenames
- `%n` file name
- `%s` block size (for faster transfers)
- `%S` fundamental block size (for block counts)
- `%t` file system type in hex
- `%T` file system type in human readable form

## Usage

### Default

File

```bash
$ stat file_name
  File: ‘file_name’
  Size: 12              Blocks: 8          IO Block: 4096   regular file
Device: 801h/2049d      Inode: 402249      Links: 1
Access: (0644/-rw-r--r--)  Uid: (    0/    root)   Gid: (    0/    root)
Access: 2018-11-04 19:55:23.692322764 +0800
Modify: 2018-11-04 19:55:06.261130511 +0800
Change: 2018-11-04 19:55:23.692322764 +0800
 Birth: -
```

Directory

```bash
$ stat dir_name
  File: ‘dir_name’
  Size: 4096            Blocks: 8          IO Block: 4096   directory
Device: 801h/2049d      Inode: 411539      Links: 20
Access: (0755/drwxr-xr-x)  Uid: (    0/    root)   Gid: (    0/    root)
Access: 2018-11-03 15:52:23.482509257 +0800
Modify: 2018-06-04 22:31:15.164792100 +0800
Change: 2018-06-04 22:31:15.164792100 +0800
 Birth: -
```

### Files

Type & Name & Size

```bash
$ stat --printf='%F \n%n \n%N \n%s \n' file_name
regular file
file_name
‘file_name’
12
```

### Permissions

```bash
$ stat -c %a\ %A file_name
# or
$ stat -c '%a %A' file_name
644 -rw-r--r--
```

### Owner

```bash
$ stat -c '%g %G %u %U' file_name
0 root 0 root
```

### Timestamps

```bash
$ stat --printf='%w %W \n%x %X \n%y %Y \n%z %Z \n' file_name
# Cartesian product 笛卡尔乘积
# = ( creation, atime, mtime, ctime ) x ( seconds, human-readable )
- 0
2018-11-05 12:43:30.974879552 +0800 1541393010
2018-11-05 12:43:30.979879607 +0800 1541393010
2018-11-05 12:43:30.979879607 +0800 1541393010
```
