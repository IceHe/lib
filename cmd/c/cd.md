# cd

> Change the current directory to dir.

## Quickstart

```bash
cd dir  # Change directory
cd ~    # To user's home
cd $HOME
cd -    # To last dir
cd $OLDPWD
```

## _Synopsis_

```bash
cd [-L|[-P [-e]]] [dir]
```

- **The variable HOME is the default dir.**
- The variable CDPATH defines the search path for the directory containing dir.
    - Alternative directory names in CDPATH are separated by a colon `:`.
    - A null directory name in CDPATH is the same as the current directory, i.e., `.`.
- If dir begins with a slash (/), then CDPATH is not used.
- **An argument of `-` is equivalent to `$OLDPWD`.**
- If a non-empty directory name from CDPATH is used, or if `-` is the first argument, and the directory change is successful, the absolute pathname of the new working directory is written to the standard output.
- The return value is true if the directory was successfully changed; false otherwise.

## _Options_

- `-P` Use the physical directory structure instead of following symbolic links
    - see also the -P option to the `set` builtin command
- `-L` Forces symbolic links to be followed
- `-e` If the `-e` option is supplied with `-P`, and the current working directory cannot be successfully determined after a successful directory change, `cd` will return an unsuccessful status.
