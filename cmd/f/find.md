# find

> search for files in a directory hierarchy

References

* `man find`

## Quickstart

```bash
# Common
find -type d    # Find directory
find -type f    # Find regular file
find -type l    # Find symbolic link

# Find files matched shell pattern
find -path "*m*"
find -name "*.log"
# -name : the path without the leading dir

# Others
find -maxdepth 1    # Descend at most 1 level of dirs
find -mtime 5       # Find files modified 5 min ago
find -empty         # Find empty files & dirs
```

## Synopsis

```bash
find [-H] [-L] [-P] [-D debugopts] [-Olevel] [path...] [expression]
```

## Usage

### Name Pattern

#### File

Suffix

```bash
$ find -name "*3"
./sample3
./input3
```

Extension Name

```bash
$ find -name "*.log"
./info.log
./access.log
./warn.log
……
```

#### Directory

```bash
$ find -maxdepth 1 -path "*d*"
./dir
./sub_dir
./dictionary
……

$ find -maxdepth 1 -path "*d"
$ find -maxdepth 1 -path "d*"
# output nothing
```

### Type

#### File

```bash
$ find -maxdepth 1 -type f
./.mysql_history
./.bash_profile
./.lesshst
./.vimrc
./.bash_history
./.bash_logout
./.bashrc
```

#### Directory

```bash
$ find -maxdepth 1 -type d
.
./.config
./.ssh
./dir
./.local
./.cache
./.mozilla
```

### Timestamp

Files modified in 7 days

```bash
$ find -mtime -7
```

Files that are not accessed in 7 days

```bash
$ find -atime +7
```

### Size

File Size

```bash
find -size 0
```

Empty file or directory

```bash
find -empty
```

#### Advanced

Absolute path of empty files

```bash
find -type f -size 0 -exec realpath {} \;
```

## Options

### Timestamp

#### Numeric Args

* `+n` for greater than n
* `-n` for less than n
* `n` for exactly n

#### \*min

* `-amin n` File was last accessed n minutes ago.
* `-cmin n` File's status was last changed n minutes ago.
* `-mmin n` File's data was last modified n minutes ago.

#### \*time

* `-used n` File was last accessed n days after its status was last changed.
* `-atime n` File was last accessed n\*24 hours ago.
  * When find figures out how many 24-hour periods ago the file was last accessed, any fractional part is ignored, so to match `-atime +1`, a file has to have been accessed at least two days ago.
* `-ctime n` File's status was last changed n\*24 hours ago.
* `-mtime n` File's data was last modified n\*24 hours ago.

#### Newer than file

* `-anewer file` File was last accessed more recently than file was modified.
* `-cnewer file` File's status was last changed more recently than file was modified.
* `-newer file` File was modified more recently than file.
* If file is a symbolic link and the `-H` option or the `-L` option is in effect, the access time of the file it points to is always used.

### Permissions

#### Mode

* `-perm mode` File's permission bits are exactly mode \(octal or symbolic\).
  * Since an exact match is required, if you want to use this form for symbolic modes, you may have to specify a rather complex mode string.
  * For example `-perm g=w` will only match files which have mode 0020 \(that is, ones for which group write permission is the only permis sion set\).
  * It is more likely that you will want to use the `/` or `-` forms, for example `-perm -g=w`, which matches any file with group write permission.
* `-perm -mode` All of the permission bits mode are set for the file.
  * Symbolic modes are accepted in this form, and this is usually the way in which would want to use them.
  * You must specify `u`, `g` or `o` if you use a symbolic mode.
* `-perm /mode` Any of the permission bits mode are set for the file.
  * Symbolic modes are accepted in this form.
  * You must specify `u`, `g` or `o` if you use a symbolic mode.
  * If no permission bits in mode are set, this test matches any file \(the idea here is to be consistent with the behaviour of `-perm -000`\).
* ~~`-perm +mode`~~ Deprecated

#### Access

* `-readable` Matches files which are readable.
* `-writable` Matches files which are writable.

#### Owner

* `-uid n` File's numeric user ID is n.
* `-user uname` File is owned by user uname \(numeric user ID allowed\).
* `-gid n` File's numeric group ID is n.
* `-group gname` File belongs to group gname \(numeric group ID allowed\).

### Name Pattern

* `-name pattern` Base of file name \(the path with the leading directories removed\) matches shell pattern.
  * Because the leading directories are removed, the file names considered for a match with -name will never include a slash, so `-name a/b` will never match anything \(you probably need to use -path instead\).
  * The metacharacters \(`*`, `?`, and `[]`\) match a `.` at the start of the base name \(this is a change in findutils-4.2.2\).
  * To ignore a directory and the files under it, use `-prune`; see an example in the description of `-path`.
  * Braces are not recognised as being special, despite the fact that some shells including Bash imbue braces with a special meaning in shell patterns.
  * The filename matching is performed with the use of the `fnmatch` library function.
* `-path pattern` File name matches shell pattern pattern.
  * The metacharacters do not treat `/` or `.` specially; so, for example, find . -path "./sr\*sc" will print an entry for a directory called `./src/misc` \(if one exists\).
  * To ignore a whole directory tree, use `-prune` rather than checking every file in the tree.
  * For example, to skip the directory `src/emacs` and all files and directories under it, and print the names of the other files found, do something like this: `find . -path ./src/emacs -prune -o -print`
  * Note that the pattern match test applies to the whole file name, starting from one of the start points named on the command line.
  * It would only make sense to use an absolute path name here if the relevant start point is also an absolute path.
  * This means that this command will never match anything: `find bar -path /foo/bar/myfile -print`
  * Find compares the -path argument with the concatenation of a directory name and the base name of the file it's examining.
  * Since the concatenation will never end with a slash, `-path` arguments ending in a slash will match nothing \(except perhaps a start point specified on the command line\).

### Size

`-size n[cwbkMG]` File uses n units of space.

The following suffixes can be used:

* `b` for 512-byte blocks \(this is the default if no suffix is used\)
* `c` for bytes
* `w` for two-byte words
* `k` for Kilobytes \(units of 1024 bytes\)
* `M` for Megabytes \(units of 1048576 bytes\)
* `G` for Gigabytes \(units of 1073741824 bytes\)

Note that

* The size does not count indirect blocks, but it does count blocks in sparse files that are not actually allocated.
* Bear in mind that the `%k` and `%b` format specifiers of `-printf` handle sparse files differently.
* The `b` suffix always denotes 512-byte blocks and never 1 Kilobyte blocks, which is different to the behaviour of -ls.

#### Empty

* `-empty` File is empty and is either a regular file or a directory.

### Type

`-type c` File is of type c:

* `b` block \(buffered\) special
* `c` character \(unbuffered\) special
* `d` **directory**
* `p` named pipe \(FIFO\)
* `f` **regular file**
* `l` **symbolic link**
  * this is never true if the `-L` option or the `-follow` option is in effect, unless the symbolic link is broken.
  * u want to search for symbolic links when `-L` is in effect, use `-xtype`.
* `s` socket
* `D` door \(Solaris\)

### Actions

* `-delete` Delete files; true if removal succeeded.
  * If the removal failed, an error message is issued.
  * If `-delete` fails, find's exit status will be nonzero \(when it eventually exits\).
  * Use of `-delete` automatically turns on the `-depth` option.
  * Warnings: Don't forget that the find command line is evaluated as an expression, so putting `-delete` first will make find try to delete everything below the starting points you specified.
  * When testing a find command line that you later intend to use with -delete, you should explicitly specify -depth in order to avoid later surprises.
  * Because `-delete` implies -depth, you cannot usefully use -prune and -delete together.
* `-exec command ;` Execute command; true if 0 status is returned.
  * All following arguments to find are taken to be arguments to the command until an argument consisting of `;` is encountered.
  * The string \`{}' is replaced by the current file name being processed everywhere it occurs in the arguments to the command, not just in arguments where it is alone, as in some versions of find.
  * Both of these constructions might need to be escaped \(with a `\`\) or quoted to protect them from expansion by the shell.
  * The specified command is run once for each matched file.
  * The command is executed in the starting directory.
  * There are unavoidable security problems surrounding use of the -exec action; you should use the -execdir option instead.
* `-ok command ;` Like `-exec` but ask the user first.
  * If the user agrees, run the command. Otherwise just return false.
  * If the command is run, its standard input is redirected from /dev/null.
  * The response to the prompt is matched against a pair of regular expressions to determine if it is an affirmative or negative response.
  * This regular expression is obtained from the system if the \`POSIXLY\_CORRECT' environment variable is set, or otherwise from find's message translations.
  * If the system has no suitable definition, find's own definition will be used.
  * In either case, the interpretation of the regular expression itself will be affected by the environment variables 'LC\_CTYPE' \(character classes\) and 'LC\_COLLATE' \(character ranges and equivalence classes\).
* ……

### Symbolic Link

* `-P` Never follow symbolic links \( default behaviour \).
  * The information used shall be taken from the properties of the symbolic link itself.
* `-L` Follow symbolic links.
  * The information used shall be taken from the properties of the file to which the link points, not from the link itself \(unless it is a broken symbolic link or find is unable to examine the file to which the link points\).
* `-H` Do not follow symbolic links, except while processing the command line arguments.

### Depth

* `-maxdepth levels` Descend at most levels \(a non-negative integer\) levels of directories below the command line arguments.
  * `-maxdepth 0` means only apply the tests and actions to the command line arguments.
* `-mindepth levels` Do not apply any tests or actions at levels less than levels \(a non-negative integer\).
  * `-mindepth 1` means process all files except the command line arguments.

### Others

* `-mount` Don't descend directories on other filesystems.

