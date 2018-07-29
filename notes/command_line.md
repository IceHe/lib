title: CLI Note 命令行
---
<!--date: 2016-01-24 20:12:50-->
<!--updated: 2016-01-27-->
<!--categories: [Command]-->
<!--tags: [Command]-->
<!--description: 我的命令行指令总结，及相关配置。CLI = Command Line Interface-->

# Temp

`command &` run the process in background
`^ z` suspend the process
`bg` continue the process in background
`fg` continue the process in foreground
`bg %num` specify ...
`fg %num` specify ...

Add SSH key for Git
1. `ssh-keygen`
2. `cat id_rsa.pub | pbcopy`
3. Paste to add in Gitlab & etc

# Abbreviations

`abbr` abbreviation
`cmd` command
`cmds` commands

`DB` database
`del` delete
`dir` directory
`dirs` directories

`env` environment
`exec` execute
`OS` operating system

`param` parameter
`pwd` password
`rd` read
`rm` remove
`sth` something

# [Zsh](http://zsh.sourceforge.net/)

- [**Docs**](http://zsh.sourceforge.net/Doc/)

- [**oh-my-zsh**](http://ohmyz.sh/) &nbsp;&&nbsp;  [my fork](https://github.com/IceHe/oh-my-zsh)

- Alias

    - [.zshrc](https://github.com/IceHe/oh-my-zsh/blob/master/.zshrc)
    - [dir](https://github.com/IceHe/oh-my-zsh/blob/master/lib/directories.zsh)
    - [git](https://github.com/IceHe/oh-my-zsh/blob/master/plugins/git/git.plugin.zsh)
    - [tmux](https://github.com/IceHe/oh-my-zsh/blob/master/plugins/tmux/tmux.plugin.zsh)
    - [vi-mode](https://github.com/IceHe/oh-my-zsh/blob/master/plugins/vi-mode/vi-mode.plugin.zsh)

 「Linux Shell 哪种更常用，这些shell各有什么特长？」知乎 [依云的回答](https://www.zhihu.com/question/29380922/answer/44157927) 摘要：

    - `bash`：通用，广泛可得。(Powerful and always available.)
    - `zsh`：各种功能十分强大，尤其是补全和脚本，但也更复杂。
    - `fish`：对新用户友好，但不符合 POSIX 标准，别处复制的命令基本没法用！
    - 可参考：[Comparison of Command Shells - Wikipedia](https://en.wikipedia.org/wiki/Comparison_of_command_shells)

<br/>

# Common

-  **Explanations**

    - `[-o]`
    Sth between `[` & `]` is optional.
    Option `-o` is optional.

    - `[-abc]`
    Options `-a`, `-b` and `-c` can be used at the same time.

    - `[-a | -b | -c]`
    The last option of `-a`, `-b` or `-c` overides the other previous options.

    - `[-A [-B]]`
    Option `-B` is valid if option `-A` is specified.

    - `-d` *(Default)*
    Option `-d` is default option of the cmd.
    It's valid even if it isn't specified.

<br/>

- **Commonly Options**

    *PS: Usually act as follows, but not always!*

    `-a` **All**: Exec cmds with many default options.
    `-d` Do with sth including **dirs**.
    `-f` **Force**: Do sth without confirmation.
    `-i` **If**: Need confirmation to do sth.
    `-n` **Not**: When need confirmation, don't do sth.
    `-p` **Preserve** sth.
    `-r` | `-R` **Recursive**: Do with sth including entire subtree.
    `-v` **Verbose**: Show details.

<br/>

- **`man cmd_name ...` Format & display the cmd Manual.**.


- **`bash` Bourne-Again SHell**

    An sh-compatible cmd language interpreter that cmds rd from the standard input or from a file.


- **`ls [-ACFGLRSTUalmrtu1] [file ...]` List dir Contents.**

    `-1` Output to be **one entry per line**. &nbsp;*(Default option when not using terminals.)*
    `-C` Multi-**column** output. &nbsp;*(Default option when using in termainals.)*

    `-A` List **all** except for `.` and `..`.
    `-a` **All**: Including hidden files (whose names begin with a dot `.`).

    `-F` Display **prompts**:
     &nbsp; &nbsp; &nbsp; &nbsp; Slash `/` after each dir pathname
     &nbsp; &nbsp; &nbsp; &nbsp; Asterisk `*` after each executable
     &nbsp; &nbsp; &nbsp; &nbsp; At sign `@` after each symbolic link
     &nbsp; &nbsp; &nbsp; &nbsp; Equals sign `=` after each socket
     &nbsp; &nbsp; &nbsp; &nbsp; Percent sign `%` after each whiteout
     &nbsp; &nbsp; &nbsp; &nbsp; Vertical bar `|` after each FIFO

    `-G` Colorized output. *(It's equivalent to defining CLICOLOR in the env.)*
    `-R` **Recursively** list subdirs encountered.

    `-l` List in **long** format.
    `-m` **Stream** output format, items separated by commas.
    `-T` With complete **time** information.

    `-r` List in **reverse** order.
    `-S` Sort files by **size**.
    `-t` Sort by **time** modified.

    `-u` Use time of **last access**, instead of last modification of the file
    `-U` Use time of file **creation**, instead of ...


- **`cd [-|-1|-2|-3|-4|-5|-6|-7|-8|-9]` Change Dir.**

    `-` Back to previous working dir.
    `-1|-2|-3|-4|-5|-6|-7|-8|-9` Back to recently working dir in dir stacks.


- **`mv [-f | -i | -n] source target` Move file.**
    `mv source ... directory` mv files to a dir.

    `-f` Force to overwrite existing files.
    `-i` Need confirmation ...
    `-n` Don't ...

    Be able to **Rename** a file.


- **`cp [-R [-H | -L | -P]] [-fi | -n] [-apvX] source_file target_file` Copy files.**
    `cp source_file ... target_directory` cp files to a dir.

    `-a` **All**: Same as `-pPR`.

    `-f` Force to overwrite existing files.
    `-i` Need confirmation ...
    `-n` Don't ...

    `-p` **Preserve** Attributes as follows:
     &nbsp; &nbsp; &nbsp; &nbsp; modification time, access time, file flags, file mode, user ID, and group ID, as allowed by permissions.

    `-X` Do not copy Extended Attributes (EAs) or resource forks.

    **`-R` Recursive**
     &nbsp; &nbsp; &nbsp; &nbsp; `-H` If the option `-R` is specified, symbolic links on the cmd line are followed.
     &nbsp; &nbsp; &nbsp; &nbsp; `-L` ..., **all** symbolic links are followed.
     &nbsp; &nbsp; &nbsp; &nbsp; `-P` ..., **no** ... followed. *(Default)*


- **`rm [-dfiPRrvW] file ...` Rm files & dir entries.**

    `-d` Rm **dirs** as well.

    `-f` Force to rm existing files.
    `-i` Need confirmation to rm ...

    `-r` | `-R` **Recursive**: rm including subtrees. It implies `-d` .

    `-P` **Permanently** del files by overwriting three times! And then no one can re-read them. [Here is WHY](http://unix.stackexchange.com/questions/36870/whats-the-purpose-of-rm-p).
    `-W` Undelete the named files. Only be used to recover files covered by whiteouts.


- **`mkdir [-p] [-m mode] directory_name` Make Dirs.**

    `-p` Create **intermediate** dirs as required.

    `-m mode` Set the mode of permission bits of the final created dir.
     &nbsp; &nbsp; &nbsp; &nbsp; Operation char `+` & `-` can be used to modify the initial mode `a=rwx`.


- **`rmdir [-p] directory ...` Rm Dirs.**

    `-p` Rm each dir component of a pathname, if they are empty.


- **`chmod [-R [-H | -L | -P]] mode file ...` Change file Modes.**
    `chmod [-R [-H | -L | -P]] [-a | +a | =a] ACE file ...`

    `[-R [-H | -L | -P]]` Same as `cp` cmd above.

    - `mode` may be absolute or symbolic. ([Numeric Notion of Filesystem Permissions](https://en.wikipedia.org/wiki/File_system_permissions#Numeric_notation))

    **Absolute** mode is an octal number constructed from the sum of one or more of the following values:
    `4000` Set-user-**ID-on-execution bit**: Executable files with this bit set will run with effective uid set to the **uid** of the file owner.
    `2000` Set-group-ID-on-execution bit: ... set to the **gid** ...
    `1000` [**Sticky bit**](https://en.wikipedia.org/wiki/Sticky_bit). (Only file/dir's owner or root user can rename or del it, if set.)
    `0400` Allow **rd** by **owner**.
    `0200` ... **write** ...
    `0100` ... **execution** ... for files. Allow ... to **search** in it for dirs.
    `0040` ... **rd** by **group members**.
    `0020` ... **write** ...
    `0010` ... **execution** ... for files. Allow ... to **search** ... for dir.
    `0004` ... **rd** by **others**.
    `0002` ... **write** ...
    `0001` ... **execution** ... for files. Allow ... to **search** ... for dir.

    **Symbolic** mode is described by the following gramma:
    \- Who: `a` all, `u` user (owner), `g` group, `o` others.  `a = ugo`.
    \- Operation: `+` append, `-` rm, `=` assign.
    \- Permission: `r` rd, `w` write, `x` exec/search, `t` sticky,
     &nbsp; &nbsp; &nbsp; &nbsp; `s` set-user-ID-on-execution & set-group-ID-on-execution, `u` user, `g` group, `o` others,
     &nbsp; &nbsp; &nbsp; &nbsp; `X` exec/search bits if it's a dir or any of the exec/search bits are set in the original (unmodified) mode.

    Operations:
    \- `+` Append permissions to files.
    \- `-` Removing permissions from files.
    \- `=` Assigning permissions to files.

    Permission examples:
    \- `u+r` == original mode | `0400`
    \- `g+w` == original mode | `0020`
    \- `o-x` == original mode & ~`0001`
    \- `a=rwx` == original mode = `0777`
    \- `+x` == `a+x`

    Complete examples:
    `chmod +rwx ./test.sh` == `chmod 777 ./test.sh`

    - Filesystem [**ACL**](https://en.wikipedia.org/wiki/Access_control_list) is used to administrate file permissions.


- **`chown [-h] [-R [-H | -L | -P]] owner[:group] file ...` Change file Owner and group.**
    `chown [-h] [-R [-H | -L | -P]] :group file ...`

    `-h` If the file is a symbolic link, change the user ID and/or the group ID of the link itself.

    `[-R [-H | -L | -P]]` Same as `cp` cmd above.


- **`su [- | -l | -m] [login [args]]` Substitute user identity.**

    `-` | `-l` Simulate a **full** login.
    `-m` Leave the env **unmodified**.


- **`sudo -A | -b | -h | -i | -s` Exec a cmd as another user**

    `-A` If require **pwd**, read it from the user's terminal.
    `-b` Run the given cmd in the **background**.
    `-h` Print a short help message about `sudo` cmd.
    `-i` (Simulate **initial** login) Runs the shell specified by the pwd DB entry of the target user as a login shell.
    `-s` Runs the **shell** specified by the SHELL env variable if it is set or the shell as specified in the pwd DB.


- **`ifconfig interface [create] ... [parameters]` Configure network interface params.**
    `ifconfig interface destroy`
    `ifconfig -a [-L] [-d] [-m] [-r] [-u] [-v] [address_family]`
    `ifconfig -l [-d] [-u] [address_family]`
    `ifconfig [-L] [-d] [-m] [-r] [-u] [-v] [-C]`
    `ifconfig interface vlan vlan-tag vlandev iface`
    `ifconfig interface -vlandev iface`
    `ifconfig interface bonddev iface`
    `ifconfig interface -bonddev iface`
    `ifconfig interface bondmode lacp | static`


- **`uname [-amnprsv]` Print OS name.**

    `-a` == `-manrsv`
    `-m` Print the **machine** hardware name.
    `-n` ... **nodename** (The system is known by nodename to communications network).
    `-p` ... machine **processor** architecture name.
    `-r` ... OS **release**.
    `-s` ... **OS** name.
    `-v` ... OS **version**.


- **`uptime` Show how long system has been running.**


- **`ps` Process Status.**

    - `-e`
    - `-f`


- **`env`**
- **`cat`**
- **`kill`**
- **`jobs`**
- **`bg`**
- **`fg`**
- **`ln`**
- **`du`**
- **`df`**

- **`rsync`**
- **`netcat`**
- **`netstat`**
- **`ifconfig`**
- **`ping`**
- **`find`**
- **`grep`**
- **`less`**
- **`head`**
- **`tail`**
- **`awk`**
- **`sort`**
- **`xarg`**
- **`diff`**
- **`brew`**
- **`mount`**
- **`fdisk`**
- **`mkfs`**
- **`lsblk`**
- **`dig`**
- **`pstree`**
- **`pgrep`**
- **`pkill`**
- **`nohup`**
- **`disown`**
- **`mosh`**
- **`top`**
- **`htop`**
- **`lsof`**
- **`ssh`**


- [Art of CL](https://github.com/jlevy/the-art-of-command-line/blob/master/README.md)

<br/>

# [Git](http://git-scm.com)

- [My Git Note](/cmd/git_note)

<br/>

# [Vim](http://www.vim.org/)

- [**Docs**](http://www.vim.org/docs.php)
- [**SPF-13**](http://vim.spf13.com/) &nbsp;&&nbsp; [my fork](https://github.com/IceHe/spf13-vim)
- [My Shortcut Note](/mac_shortcuts/#Vim)
- [Vim Cheat Sheet](http://coolshell.cn//wp-content/uploads/2011/09/vim_cheat_sheet_for_programmers_print.png) - 键位操作总结图。

<br/>

# Todo

- to be continue ...

- [realpath](http://stackoverflow.com/questions/5265702/how-to-get-full-path-of-a-file)

<br/>

# Related

- 我的 [Mac 快捷键](/mac/shortcuts)
- **CLI Note 命令行**

