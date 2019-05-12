# ls

> **list** directory contents

Reference

- Unix LS Command: 15 Practical Examples : https://www.thegeekstuff.com/2009/07/linux-ls-command-examples/

## Quickstart

```bash
# Common
ls -hl      # List with human readable sizes in long format
ls -ahl     # List all with …
ls -hl file    # List info about file
ls -hl f1 f2   # List info about files

## Range options
# -a : List all ( Do not ignore entries starting with `.` )
# -A : List all except for `.` and `..`
# -d : List dirs

## Format options
# -h : Print sizes in human readable format
# -l : List in long format
# -p : Append '/' indicator to directories ( e.g. dir/ )

# Sort by time
# - Newest first
# - With option -l to show *time sorted by
ls -lt      # Sort by mtime ( content last Modification time )
ls -ltc     # Sort by ctime ( metadata last Changed time )
ls -ltu     # Sort by atime ( last access time )
ls -ltU     # Sort by creation time ( Notice: BSD only! )

## `-r, --reverse` : In reverse order
ls -ltr
ls -ltcr
ls -ltur
ls -ltUr
```

## Options

### Filter

- `-a, --all` Do not ignore entries starting with `.`
- `-A, --almost-all` List all entries except for `.` and `..`
- `-d, --directory` List directories themselves, not their contents
- `--hide=PATTERN` Do not list implied entries matching shell PATTERN (overridden by -a or -A)
- `-I, --ignore=PATTERN` Do not list implied entries matching shell PATTERN

### Format

Description

- `-h, --human-readable` With `-l`, print sizes in human readable format (e.g., 1K 234M 2G)
    - Use unit suffixes: Byte, Kilobyte, Megabyte, Gigabyte, Terabyte and Petabyte in order to reduce the number of digits to three or less using base 2 for sizes.
- `-l` List in long format
    - If the output is to a terminal, a total sum for all the file sizes is output on a line before the long listing.

Indicators

- `--indicator-style=WORD` Append indicator with style WORD to entry names :
    - none ( default )
    - slash ( same as `-p` )
    - file-type  ( same as `--file-type` )
    - classify ( same as `-F` )
- `-F, --classify` Append indicator ( one of `*/=>@|` ) to entries
    - Indicators :
        - `*` executable
        - `/` directory
        - `@` symbolic link ( or that the file has extended attributes )
        - `|` named pipe
        - `=` socket
        - `>` door
- `--file-type` Likewise, except do not append `*`
- `-p, --indicator-style=slash` Append `/` indicator to directories

Seldom

- `-k, --kibibytes` Default to 1024-byte blocks for disk usage
- `--si` Likewise, but use powers of 1000 not 1024
- `-1` List one file per line
- `-x` List entries by lines instead of by columns
- `-m` Fill width with a comma separated list of entries
- `-L, --dereference` When showing file information for a symbolic link, show information for the file the link references rather than for the link itself.
- `--quoting-style=WORD` Use quoting style WORD for entry names :
    - literal ''
    - locale ‘’ ( ZH )
    - shell ( none )
    - shell-always ''
    - c ""
    - escape ( ? )

### Sort

> Default File Timestamp : **Last Modification Time**

- `-S` Sort by file size, largest first
- `-t` Sort by time, newest first
    - File Timestamps
        - Default : mtime
        - `-lt` mtime : last modification time (content)
        - `-ltc` ctime : last changed time (metadata)
        - `-ltu` atime : last access time
        - `-ltU` creation time ( BSD only! )
    - _See details in section "Timestamps" below_
- `-c` Sort by ctime ( (metadata) last changed time )
    - with `-lt` : sort by, and show, ctime;
    - with `-l` : show ctime and sort by name;
    - otherwise : sort by ctime.
- `-u` Sort by atime ( last access time )
    - with `-lt` : sort by, and show, atime;
    - with `-l` : show atime and sort by name;
    - otherwise : sort by atime.
- `-U` Differ on different OS
    - On Linux : Do not sort; list entries in directory order
    - On BSD : Sort by file creation time
- `-r, --reverse` Reverse order
- `-R, --recursive` List subdirectories recursively
- `-v` Natural sort of (version) numbers within text
- `-X` Sort alphabetically by entry extension

## Usage

### List

#### All

List all ( except `.` & `..` )

```bash
ls -A

# e.g.
ls -A1 | tail
Documents
Downloads
Library
Movies
Music
OneDrive - elcass
Pictures
Public
README.md
VirtualBox VMs
```

#### Details

List with details ( human-readable )

```bash
$ ls -hl
total 280
drwxr-xr-x   3 icehe  staff    96B Nov 23  2017 Applications
drwx------+ 24 icehe  staff   768B Nov  3 17:11 Desktop
drwx------+ 21 icehe  staff   672B Oct 21 18:42 Documents
……
```

List all with details

```bash
ls -Ahl
# e.g.
$ ls -Ahl | tail
drwxr-xr-x    3 icehe  staff    96B Nov 23  2017 Applications
drwx------+  24 icehe  staff   768B Nov  3 17:11 Desktop
drwx------+  21 icehe  staff   672B Oct 21 18:42 Documents
drwx------+  17 icehe  staff   544B Nov  2 16:20 Downloads
drwx------+  97 icehe  staff   3.0K Sep  2 16:00 Library
drwx------+   9 icehe  staff   288B Jun  8 13:52 Movies
drwx------+  13 icehe  staff   416B Sep 11  2017 Music
drwx------+  29 icehe  staff   928B Oct 29 16:01 Pictures
drwxr-xr-x+   5 icehe  staff   160B Oct 16  2015 Public
-rw-r--r--    1 icehe  staff    70B Aug  5 14:44 README.md
```

#### Indicators

Default

```bash
$ ls
bin   data0  dev  home  lib64       media  nonexistent  proc  run   srv  tmp  var
boot  data1  etc  lib   lost+found  mnt    opt          root  sbin  sys  usr
```

Append `/` indicator to directories

```bash
$ ls -p
bin    data0/  dev/  home/  lib64        media/  nonexistent/  proc/  run/  srv/  tmp/  var/
boot/  data1/  etc/  lib    lost+found/  mnt/    opt/          root/  sbin  sys/  usr/
```

Append indicator ( one of `*/=>@|` ) to entries

```bash
$ ls -F
bin@   data0/  dev/  home/  lib64@       media/  nonexistent/  proc/  run/   srv/  tmp/  var/
boot/  data1/  etc/  lib@   lost+found/  mnt/    opt/          root/  sbin@  sys/  usr/
```

#### Hide / Ignore

Sample

```bash
$ ls -l | head
total 208
lrwxrwxrwx    1 root   root        7 Jul 11 19:37 bin -> usr/bin
dr-xr-xr-x.   5 root   root     4096 Jul 18 14:42 boot
drwxr-xr-x    9 root   root     4096 Jul 19 03:45 data0
drwxr-xr-x    5 root   root     4096 Sep 21 17:51 data1
drwxr-xr-x   18 root   root     3180 Jul 18 14:41 dev
drwxr-xr-x. 148 root   root    12288 Oct 25 19:02 etc
drwxr-xr-x.   2 root   root     4096 Apr 11  2018 home
lrwxrwxrwx    1 root   root        7 Jul 11 19:37 lib -> usr/lib
lrwxrwxrwx    1 root   root        9 Jul 11 19:37 lib64 -> usr/lib64
```

Hide some files

- `--hide`
- `-I, --ignore`

```bash
ls --hide=<shell_pattern>

# e.g.
$ ls -l --hide=b* | head
# or
$ ls -l --ignore=b* | head
total 204
drwxr-xr-x    9 root   root     4096 Jul 19 03:45 data0
drwxr-xr-x    5 root   root     4096 Sep 21 17:51 data1
drwxr-xr-x   18 root   root     3180 Jul 18 14:41 dev
drwxr-xr-x. 148 root   root    12288 Oct 25 19:02 etc
drwxr-xr-x.   2 root   root     4096 Apr 11  2018 home
lrwxrwxrwx    1 root   root        7 Jul 11 19:37 lib -> usr/lib
lrwxrwxrwx    1 root   root        9 Jul 11 19:37 lib64 -> usr/lib64
drwx------.   2 root   root    16384 Apr 25  2018 lost+found
drwxr-xr-x.   2 root   root     4096 Apr 11  2018 media

$ ls -l --hide=[bdl]* | head
# or
$ ls -l --ignore=[bdl]* | head
total 180
drwxr-xr-x. 148 root   root    12288 Oct 25 19:02 etc
drwxr-xr-x.   2 root   root     4096 Apr 11  2018 home
drwxr-xr-x.   2 root   root     4096 Apr 11  2018 media
drwxr-xr-x.   2 root   root     4096 Apr 11  2018 mnt
drwx------.   3 sysmon sysmon   4096 Apr 25  2018 nonexistent
drwxr-xr-x.   9 root   root     4096 Jul 16 17:51 opt
dr-xr-xr-x  379 root   root        0 Jul 18 22:41 proc
dr-xr-x---.  15 root   root     4096 Nov  3 20:32 root
drwxr-xr-x   41 root   root     1200 Oct  9 19:59 run
```

#### Link

Default : Show symbolic link itself

```bash
$
ls -l
total 208
lrwxrwxrwx 1 root root 7 Jul 11 19:37 bin -> usr/bin
……
lrwxrwxrwx 1 root root 7 Jul 11 19:37 lib -> usr/lib
lrwxrwxrwx 1 root root 9 Jul 11 19:37 lib64 -> usr/lib64
……
lrwxrwxrwx 1 root root 8 Jul 11 19:37 sbin -> usr/sbin
……
```

Show real file linked to

```bash
$ ls -lL
dr-xr-xr-x.   2 root   root    61440 Oct 26 12:24 bin
……
dr-xr-xr-x.  52 root   root     4096 Aug 29 14:46 lib
dr-xr-xr-x. 118 root   root    98304 Sep 13 16:41 lib64
……
dr-xr-xr-x.   2 root   root    20480 Sep 13 16:28 sbin
……
```

### Sort By

`-r` options

- Show the largest at last ( size )
- Show the newest at last ( time )

#### Size

File Size ( largest first )

```bash
$ ls -hlS
total 280
drwx------+ 97 icehe  staff   3.0K Sep  2 16:00 Library
drwx------+ 29 icehe  staff   928B Oct 29 16:01 Pictures
drwx------+ 24 icehe  staff   768B Nov  3 17:11 Desktop
drwx------+ 21 icehe  staff   672B Oct 21 18:42 Documents
drwx------+ 17 icehe  staff   544B Nov  2 16:20 Downloads
drwx------+ 13 icehe  staff   416B Sep 11  2017 Music
drwx------+  9 icehe  staff   288B Jun  8 13:52 Movies
drwxr-xr-x+  5 icehe  staff   160B Oct 16  2015 Public
drwxr-xr-x   3 icehe  staff    96B Nov 23  2017 Applications
-rw-r--r--   1 icehe  staff    70B Aug  5 14:44 README.md
```

Size in Reverse Order ( smallest first )

```bash
$ ls -hlSr
total 280
-rw-r--r--   1 icehe  staff    70B Aug  5 14:44 README.md
drwxr-xr-x   3 icehe  staff    96B Nov 23  2017 Applications
drwxr-xr-x+  5 icehe  staff   160B Oct 16  2015 Public
drwx------+  9 icehe  staff   288B Jun  8 13:52 Movies
drwx------+ 13 icehe  staff   416B Sep 11  2017 Music
drwx------+ 17 icehe  staff   544B Nov  2 16:20 Downloads
drwx------+ 21 icehe  staff   672B Oct 21 18:42 Documents
drwx------+ 24 icehe  staff   768B Nov  3 17:11 Desktop
drwx------+ 29 icehe  staff   928B Oct 29 16:01 Pictures
drwx------+ 97 icehe  staff   3.0K Sep  2 16:00 Library
```

#### Time

##### mtime

Default : Modification Time ( newest first )

```bash
$ ls -hlt
total 280
drwx------+ 24 icehe  staff   768B Nov  3 17:11 Desktop
drwx------+ 17 icehe  staff   544B Nov  2 16:20 Downloads
drwx------+ 29 icehe  staff   928B Oct 29 16:01 Pictures
drwx------+ 21 icehe  staff   672B Oct 21 18:42 Documents
drwx------+ 97 icehe  staff   3.0K Sep  2 16:00 Library
-rw-r--r--   1 icehe  staff    70B Aug  5 14:44 README.md
drwx------+  9 icehe  staff   288B Jun  8 13:52 Movies
drwxr-xr-x   3 icehe  staff    96B Nov 23  2017 Applications
drwx------+ 13 icehe  staff   416B Sep 11  2017 Music
drwxr-xr-x+  5 icehe  staff   160B Oct 16  2015 Public
```

Modification Time in Reverse Order ( oldest first )

```bash
$ ls -hltr
total 280
drwxr-xr-x+  5 icehe  staff   160B Oct 16  2015 Public
drwx------+ 13 icehe  staff   416B Sep 11  2017 Music
drwxr-xr-x   3 icehe  staff    96B Nov 23  2017 Applications
drwx------+  9 icehe  staff   288B Jun  8 13:52 Movies
-rw-r--r--   1 icehe  staff    70B Aug  5 14:44 README.md
drwx------+ 97 icehe  staff   3.0K Sep  2 16:00 Library
drwx------+ 21 icehe  staff   672B Oct 21 18:42 Documents
drwx------+ 29 icehe  staff   928B Oct 29 16:01 Pictures
drwx------+ 17 icehe  staff   544B Nov  2 16:20 Downloads
drwx------+ 24 icehe  staff   768B Nov  3 17:11 Desktop
```

##### atime

Access Time

```bash
$ ls -hltu
total 280
drwx------+ 97 icehe  staff   3.0K Nov  4 18:18 Library
drwx------+ 21 icehe  staff   672B Nov  4 15:16 Documents
drwx------+ 17 icehe  staff   544B Nov  3 20:27 Downloads
drwx------+ 24 icehe  staff   768B Nov  3 20:27 Desktop
drwxr-xr-x   3 icehe  staff    96B Nov  3 03:16 Applications
drwx------+ 29 icehe  staff   928B Oct 29 16:10 Pictures
drwx------+ 13 icehe  staff   416B Oct 29 16:03 Music
-rw-r--r--   1 icehe  staff    70B Aug 24 16:44 README.md
drwxr-xr-x+  5 icehe  staff   160B Aug 17 15:10 Public
drwx------+  9 icehe  staff   288B Jun  8 13:52 Movies
```

##### ctime

Changed Time

```bash
$ ls -hltc
total 280
drwx------+ 24 icehe  staff   768B Nov  3 17:11 Desktop
drwx------+ 17 icehe  staff   544B Nov  2 16:20 Downloads
drwx------+ 29 icehe  staff   928B Oct 29 16:01 Pictures
drwx------+ 21 icehe  staff   672B Oct 21 18:42 Documents
drwx------+ 97 icehe  staff   3.0K Sep  2 16:00 Library
-rw-r--r--   1 icehe  staff    70B Aug  5 14:44 README.md
drwx------+  9 icehe  staff   288B Jun  8 13:52 Movies
drwxr-xr-x   3 icehe  staff    96B Nov 23  2017 Applications
drwx------+ 13 icehe  staff   416B Sep 11  2017 Music
drwxr-xr-x+  5 icehe  staff   160B Sep 12  2016 Public
```

##### creation

Creation Time

```bash
$ ls -hltU
total 280
-rw-r--r--   1 icehe  staff    70B Aug  5 14:44 README.md
drwx------+ 24 icehe  staff   768B Oct 12  2017 Desktop
drwx------+ 21 icehe  staff   672B Oct 12  2017 Documents
drwx------+  9 icehe  staff   288B Sep 12  2016 Movies
drwxr-xr-x   3 icehe  staff    96B Jun 17  2015 Applications
drwx------+ 17 icehe  staff   544B Apr 15  2015 Downloads
drwx------+ 13 icehe  staff   416B Apr 15  2015 Music
drwx------+ 29 icehe  staff   928B Apr 15  2015 Pictures
drwxr-xr-x+  5 icehe  staff   160B Apr 15  2015 Public
drwx------+ 97 icehe  staff   3.0K Mar  7  2015 Library
```

### Aliases

Confis file : https://github.com/IceHe/mac-conf/blob/master/.config/zsh/ls.zsh

```bash
######
# ls #
######

# List
# ( overwrite $ZSH/lib/directories.zsh )
alias l='ls -h'
alias la='ls -hA'
alias ll='ls -hl'
alias lla='ls -hlA'

# List & Grep
alias lg='ls | grep'
alias lag='ls -A | grep'
alias llg='ls -hl | grep'
alias llag='ls -Ahl | grep'

# Sort by Size
alias lS='ls -AhlS'

# Sort by Time
# - Modified
alias lt='ls -Ahlt'
# - Changed (metadata)
alias ltc='ls -Ahltc'
# - Access
alias ltu='ls -Ahltu'
# - Creation
alias ltU='ls -AhltU'
```

## Output Columns

References

- What does the second column in the output of 'ls -n' mean? https://askubuntu.com/questions/19510/what-does-the-second-column-in-the-output-of-ls-n-mean/19513#19513
- See `man ls`

### Description

Description of Output Columns

- 1 : Permissions ( access rights )
    - 1st character : File Type
    - Next 9 characters : File Permissions
- 2 : Count of Hard Links to the file
- 3 : Owner User : UID | username
- 4 : Owner Group : GID | group name
- 5 : Size
- 6 : Timestamps : mtime / atime / ctime ( see below )
- 7 : Name

### File Type

- `-` Regular File
- `d` Directory
- `l` Symbolic Link
- `s` Socket Link
- `b` Block Special File
- `c` Character pecial File
- `p` FIFO

### Permission Characters

- 9 characters specifies the file permissions

```bash
# e.g.
rwxrwxrwx
rwxr-xr-x
r-xr-x---
rwx------
```

- Each 3 characters refers to permissions
    - `r` read
    - `w` write
    - `x` execute
- for
    - `u` user
    - `g` group
    - `o` others

## Timestamps

Reference

- atime, ctime and mtime in Unix filesystems : https://www.unixtutorial.org/atime-ctime-mtime-in-unix-filesystems/

Notice!

- There's **no file creation timestamp** kept in most filesystems
    - None on Linux…
    - Exist on macOS!
- When a new file or directory is created, usually all three times `atime, ctime and mtime` are configured to capture the current time.

### atime

Last Access Time

- The last time the data from a file or directory was accessed.
- Read by one of the Unix processes directly or through commands and scripts.

### mtime

Last Modification Time

- The Time of the last change to file's contents.
- It does not change with owner or permission changes, and is therefore used for tracking the actual changes to data of the file itself.

### ctime  (metadata)

Last Changed Time

- When your file or directory got **metadata changes**
    - typically that's **file ownership (username and/or group) and access permissions**,
    - ctime will also get updated if the file contents got changed.
