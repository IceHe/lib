# visudo

> edit the sudoers file

## Synopsis

```bash
visudo [-chqsV] [-f sudoers] [-x output_file]
```

- visudo edits the sudoers file in a safe fashion, analogous to `vipw`.
- visudo locks the sudoers file against multiple simultaneous edits, provides basic sanity checks, and checks for parse errors.
- If the sudoers file is currently being edited you will receive a message to try again later.

## Options

- `-c, --check` Enable check-only mode.
    - The existing sudoers file will be checked for syntax errors, owner and mode.
    - A message will be printed to the standard output describing the status of sudoers unless the -q option was specified.
    - If the check completes successfully, visudo will exit with a value of 0.
    - If an error is encountered, visudo will exit with a value of 1.
- `-f sudoers, --file=sudoers` Specify an alternate sudoers file location.
    - With this option, visudo will edit (or check) the sudoers file of your choice, instead of the default, /etc/sudoers.
    - The lock file used is the specified sudoers file with “.tmp” appended to it.
    - In check-only mode only, the argument to -f may be ‘-’, indicating that sudoers will be read from the standard input.
- `-s, --strict` Enable strict checking of the sudoers file.
    - If an alias is used before it is defined, visudo will consider this a parse error.
    - Note that it is not possible to differentiate between an alias and a host name or user name that consists solely of uppercase letters, digits, and the underscore (‘_’) character.
- ……

## Files

- `/etc/sudo.conf` _Sudo front end configuration_
- `/etc/sudoers` **List of who can run what**
- `/etc/sudoers.tmp` Lock file for visudo

## Usage

```bash
visudo
```
