# chgrp

> change group ownership

References

- `man chgrp`

## Quickstart

```bash
chgrp staff file    # Change group to `staff`
chgrp staff dir
chgrp staff -R dir  # Recursively in directory
```

Group `staff` is related to root. ( see file `/etc/group` )

## Options

Common

- `-R, --recursive` operate on files and directories recursively

Symbolic Link

- `--dereference` affect the referent of each symbolic link (this is the default),
    - rather  than  the  symbolic  link itself
- `-h, --no-dereference` affect  symbolic  links instead of any referenced file
    - (useful only on systems that can change the ownership of a symlink)

The following options modify how a hierarchy is traversed when the `-R` option is also specified.

- If more than one is specified, only the final one takes effect.
    - `-H` if a command line argument is a symbolic link to a directory, traverse it
    - `-L` traverse every symbolic link to a directory encountered
    - `-P` do not traverse any symbolic links (default)
