# Shell Variables

## PATH

`PATH` The search path for commands.

- It is a colon-separated list of directories in which the shell looks for commands (see COMMAND EXECUTION below).
- A zero-length (null) directory name in the value of PATH indicates the current directory.
- A null directory name may appear as two adjacent colons `::`, or as an initial or trailing colon.
- The default path is system-dependent, and is set by the administrator who installs bash.
- A common value is

```bash
/usr/local/bin:/usr/local/sbin:/usr/bin:/usr/sbin:/bin:/sbin
```

## HISTFILE

`HISTFILE`

- The name of the file in which command history is saved (see HISTORY below).
- The default value is `~/.bash_history`.
- If unset, the command history is not saved when a shell exits.

`HISTFILESIZE`

- The maximum number of lines contained in the history file.
- When this variable is assigned a value, the history file is truncated, if necessary, to contain no more than that number of lines by removing the oldest entries.
- The history file is also truncated to this size after writing it when a shell exits.
- If the value is 0, the history file is truncated to zero size.
- Non-numeric values and numeric values less than zero inhibit truncation.
- The shell sets the default value to the value of HISTSIZE after reading any startup files.

`HISTSIZE`

- The number of commands to remember in the command history (see HISTORY below).
- If the value is 0, commands are not saved in the history list.
- Numeric values less than zero result in every command being saved on the history list (there is no limit).
- The shell sets the default value to 500 after reading any startup files.

## PS\*

`PS1` 主提示符

- The value of this parameter is expanded (see PROMPTING below) and used as the primary prompt string.
- The default value is `\s-\v\$ `.

`PS2` 次提示符

- The value of this parameter is expanded as with PS1 and used as the secondary prompt string.
- The default is `> `.

## OSTYPE

`OSTYPE` Automatically set to a string that describes the operating system on which bash is executing. The default is system-dependent.

```bash
# e.g.
$ echo $OSTYPE
# on macOS : darwin*
darwin17.0
# on CentOS 7
linux-gnu
```