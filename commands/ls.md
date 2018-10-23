# ls

> list directory contents

## Options

Common

- `-A` List all entries except for `.` and `..`
- `-h` Use unit suffixes: Byte, Kilobyte, Megabyte, Gigabyte, Terabyte and Petabyte
    - in order to reduce the number of digits to three or less using base 2 for sizes.
- `-l` List in long format
    - If the output is to a terminal, a total sum for all the file sizes is output on a line before the long listing.

Seldom

- `-u` Use time of last access, instead of last modification of the file
- `-U` Use time of file creation, instead of ……
- `-R` Recursively list subdirectories encountered
- `-r` Reverse the order of the sort to get reverse lexicographical order
    - or the oldest entries first
    - or largest files last, if combined with sort by size
- `-S` Sort files by size
- `-t` Sort by time modified (most recently modified first)
    - before sorting the operands by lexicographical order.

## Usage

### List

List with details

```bash
ls -hl
```

List all

```bash
ls -A
```

List all with details

```bash
ls -Ahl
```

### Grep

List with `grep`

```bash
ls | grep
ls -A | grep
ls -hl | grep
ls -Ahl | grep
```

### Sort By

`-r` options

- Show the latest at last ( datetime )
- Show the largest at last ( size )

#### Size

Sorted by increasing size

```bash
ls -hlrS

# e.g.: show top 10 largest files ( including path inode )
$ ls -hlrS | tail
total 280
-rw-r--r--   1 icehe  staff    70B Aug  6 00:10 README.md
drwxr-xr-x   3 icehe  staff    96B Aug 16 00:04 Music
drwxr-xr-x   3 icehe  staff    96B Nov 23  2017 Applications
drwx------+ 35 icehe  staff   1.1K Aug 31 02:07 Documents
drwx------+ 38 icehe  staff   1.2K Aug 17 23:19 Downloads
drwx------+ 40 icehe  staff   1.3K Sep  6 02:03 Desktop
drwx------@ 64 icehe  staff   2.0K Aug 26 11:10 Library
```

List all sorted by increasing size

```bash
ls -AhlrS
```

#### Time

Sorted by modified date

```bash
$ ls -hlrt
total 280
drwxr-xr-x   3 icehe  staff    96B Nov 23  2017 Applications
-rw-r--r--   1 icehe  staff    70B Aug  6 00:10 README.md
drwxr-xr-x   3 icehe  staff    96B Aug 16 00:04 Music
drwx------+ 38 icehe  staff   1.2K Aug 17 23:19 Downloads
drwx------@ 64 icehe  staff   2.0K Aug 26 11:10 Library
drwx------+ 35 icehe  staff   1.1K Aug 31 02:07 Documen
```

Sorted by access date

```bash
$ ls -lrtu
total 280
-rw-r--r--   1 icehe  staff    70B Aug  6 00:10 README.md
drwxr-xr-x   3 icehe  staff    96B Aug 16 00:04 Music
drwxr-xr-x   3 icehe  staff    96B Sep  9 23:26 Applications
drwx------+ 40 icehe  staff   1.3K Sep  9 23:26 Desktop
drwx------+ 35 icehe  staff   1.1K Sep  9 23:26 Documents
drwx------+ 38 icehe  staff   1.2K Sep  9 23:26 Downloads
drwx------@ 64 icehe  staff   2.0K Sep  9 23:26 Library
```

Sorted by creation date

```bash
$ ls -lrtU
total 280
drwx------@ 64 icehe  staff   2.0K Mar  7  2015 Library
drwx------+ 38 icehe  staff   1.2K Apr 15  2015 Downloads
drwxr-xr-x   3 icehe  staff    96B Jun 17  2015 Applications
drwx------+ 35 icehe  staff   1.1K Oct 12  2017 Documents
drwx------+ 40 icehe  staff   1.3K Oct 12  2017 Desktop
-rw-r--r--   1 icehe  staff    70B Aug  6 00:10 README.md
drwxr-xr-x   3 icehe  staff    96B Aug 16 00:04 Music
```

List all sorted by …

```bash
ls -AhlrS
ls -Ahlrt
ls -Ahlrtu
ls -AhlrtU
```

### Aliases

Confis file : https://github.com/IceHe/mac-conf/blob/master/.config/zsh/ls.zsh

```bash
# List
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
alias lS='ls -hlrS'
alias laS='ls -AhlrS'

# Sort by Time
alias lt='ls -Ahlrt'
alias ltu='ls -Ahlrtu'
alias ltU='ls -AhlrtU'
```
