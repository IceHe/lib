# sudo

> sudo, sudoedit - execute a command as another user

See `man sudo` for more.

## Synopsis

```bash
sudo -h | -K | -k | -V
sudo -v [-AknS] [-a type] [-g group] [-h host] [-p prompt] [-u user]
sudo -l [-AknS] [-a type] [-g group] [-h host] [-p prompt] [-U user] [-u user] [command]
sudo [-AbEHnPS] [-a type] [-C num] [-c class] [-g group] [-h host] [-p prompt] [-r role] [-t type] [-u user] [VAR=value] [-i | -s] [command]
sudoedit [-AknS] [-a type] [-C num] [-c class] [-g group] [-h host] [-p prompt] [-u user] file ...
```

## Options

- `-s, --shell` Run the shell specified by the SHELL environment variable if it is set or the shell specified by the invoking user's password database entry.
    - If a command is specified, it is passed to the shell for execution via the shell's -c option.
    - If no command is specified, an interactive shell is executed.
- ……

## Usage

Run a single command

```bash
sudo <command>
# e.g.
sudo vim /etc/hosts
```

Switch to user 'root'

```bash
sudo -s
```
