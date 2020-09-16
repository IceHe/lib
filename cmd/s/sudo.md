# sudo

> sudo, sudoedit - execute a command as another user

References

* `man sudo`

## Synopsis

```bash
sudo -h | -K | -k | -V
sudo -v [-AknS] [-a type] [-g group] [-h host] [-p prompt] [-u user]
sudo -l [-AknS] [-a type] [-g group] [-h host] [-p prompt] [-U user] [-u user] [command]
sudo [-AbEHnPS] [-a type] [-C num] [-c class] [-g group] [-h host] [-p prompt] [-r role] [-t type] [-u user] [VAR=value] [-i | -s] [command]
sudoedit [-AknS] [-a type] [-C num] [-c class] [-g group] [-h host] [-p prompt] [-u user] file ...
```

## Options

* `-l, --list` If no command is specified, list the allowed \(and forbidden\) commands for the invoking user \(or the user specified by the -U option\) on the current host.
* `-s, --shell` Run the shell specified by the SHELL environment variable if it is set or the shell specified by the invoking user's password database entry.
  * If a command is specified, it is passed to the shell for execution via the shell's -c option.
  * If no command is specified, an interactive shell is executed.
* ……

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

List the allowed \(& forbidden\) commands

```bash
# run as root user
$ sudo -l
Matching Defaults entries for root on box029:
    !visiblepw, always_set_home, env_reset, env_keep="COLORS DISPLAY HOSTNAME HISTSIZE INPUTRC KDEDIR LS_COLORS", env_keep+="MAIL
    PS1 PS2 QTDIR USERNAME LANG LC_ADDRESS LC_CTYPE", env_keep+="LC_COLLATE LC_IDENTIFICATION LC_MEASUREMENT LC_MESSAGES",
    env_keep+="LC_MONETARY LC_NAME LC_NUMERIC LC_PAPER LC_TELEPHONE", env_keep+="LC_TIME LC_ALL LANGUAGE LINGUAS _XKB_CHARSET
    XAUTHORITY", secure_path=/sbin\:/bin\:/usr/sbin\:/usr/bin

User root may run the following commands on box029:
    (ALL) ALL
```

