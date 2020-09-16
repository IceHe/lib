# chown

> change file owner and group

References

* `man chown`

## Quickstart

```bash
chown user:group file   # Change file owner & group
chown user file         # Only owner …
chown :group file       # Only group …
chown -R user:group dir # Recursively in directory
```

## Synopsis

```bash
chown [OPTION]... [OWNER][:[GROUP]] FILE...
chown [OPTION]... --reference=RFILE FILE...
```

## Usage

### Common

File

```bash
chown <user>:<group> <file>
# e.g.
chown icehe:staff temp.log
```

Directory

```bash
chown <user>:<group> -R <directory>
# e.g.
chown icehe:staff -R logs/
```

Symbolic Link

* Change the owner of file & subfiles

```bash
chown -hR root file
```

### owner:group

#### owner

If only an owner \(a user name or numeric user ID\) is given, that user is made the owner of each given file, and the files' group is not changed.

```bash
chown <user> <file_path>
# e.g.
chown icehe file
```

#### owner:group

If the owner is followed by a colon and a group name \(or numeric group ID\), with no spaces between them, the group ownership of the files is changed as well.

```bash
chown <user>:<group> <file_path>
# e.g.
chown root:staff file
```

#### owner:

If a colon but no group name follows the user name, that user is made the owner of the files and the group of the files is changed to that user's login group.

```bash
chown <user>: <file_path>
# e.g.
chown icehe: file
```

#### :group

If the colon and group are given, but the owner is omitted, only the group of the files is changed; in this case, chown performs the same function as chgrp.

```bash
chown :<group> <file_path>
# e.g.
chown :staff file
```

#### :

If only a colon is given, or if the entire operand is empty, neither the owner nor the group is changed.

```bash
chown : <file_path>
# e.g.
chown : file
```

## Options

Common

* `-R, --recursive` operate on files & directories recursively
* `--reference=RFILE` use RFILE's owner & group rather than specifying OWNER:GROUP values

Symbolic Link

* `-h, --no-dereference` **affect symbolic links instead of any referenced file**
  * useful only on systems that can change the ownership of a symlink
* `--dereference` affect the referent of each symbolic link \( **default** \)
  * rather than the symbolic link itself

Wrong Operation Prevention

* `--preserve-root` **fail to operate recursively on '/'**
* `--no-preserve-root` do not treat '/' specially \( **default** \)

