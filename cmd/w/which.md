# which

> shows the full path of (shell) commands

## Options

- `-a, --all` Print all matching executables in PATH, not just the first
- `-i, --read-alias` Read aliases (default)
- `--skip-alias` Ignore option `--read-alias`, if any.
- `--read-functions` Read shell function definitions from stdin, reporting matching ones on stdout
- `--skip-functions` Ignore option `--read-functions`, if any.
- ……

## Usage

Print the first matching executable

```bash
which <command_name>

# e.g.
$ which bash
/bin/bash
```

Print all matching executables

```bash
$ which -a bash
/bin/bash
/usr/bin/bash
```

On BSD, builtin `where` == `which -a`

```bash
$ where php
/usr/local/bin/php
/usr/bin/php

$ which php
/usr/local/bin/php
/usr/bin/php
```
