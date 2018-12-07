# su

> run a command with substitute user and group ID

## Synopsis

```bash
su [options...] [-] [user [args...]]
```

- When called without arguments su defaults to running an interactive shell as root

## Options

- `-c command, --command=command` Pass command to the shell.
- _`--session-command=command`_ Same as `-c` but do not create a new session (discouraged).
- `-g, --group=group` Specify the primary group, this option is allowed for root user only.
- `-G, --supp-group=group` Specify a supplemental group.
    - This option is available to the root user only.
    - The first specified supplementary group is also used as a primary group if the option --group is unspecified.
- `-, -l, --login` Starts the shell as login shell with an environment similar to a real login:
    - clears all environment variables except for TERM
    - initializes the environment variables HOME, SHELL, USER, LOGNAME, PATH
    - changes to the target user's home directory
    - sets argv[0] of the shell to '-' in order to make the shell a login shell
- `-m, -p, --preserve-environment` Preserves the whole environment, ie does not set HOME, SHELL, USER nor LOGNAME.
    - The option is ignored if the option `--login` is specified.
- `-s SHELL, --shell=SHELL` Runs the specified shell instead of the default.
    - The shell to run is selected according to the following rules in order:
        - the shell specified with `--shell`
        - The shell specified in the environment variable SHELL if the `--preserve-environment` option is used.
        - the shell listed in the passwd entry of the target user
        - /bin/sh
    - If the target user has a restricted shell (i.e. not listed in /etc/shells) the `--shell` option and the SHELL environment variables are ignored unless the calling user is root.

## Usage

Default

```bash
su
# same as
su root
```
