title: 命令行笔记
date: 2018-11-30
noupdate: true
categories: [Cmd]
tags: [Cmd]
description: The Art of Command Line &#58; 命令行的艺术
-----------------

Ref : [The Art of Command Line](https://github.com/jlevy/the-art-of-command-line/blob/master/README.md)
[中文版](https://github.com/jlevy/the-art-of-command-line/blob/master/README-zh.md)

## TODO

### String

- cat
- head
- less
- tail

### Process

- ack
- ag
- awk
- cut
    - join
    - paste
- sed
- sort
- tar
- uniq
- xargs

#### filter

- comm
- diff
- wc

- grep
grep -v
egrep
grep -E

- vimdiff

### Network

- curl
- ifconfig
- lsof
- nc
- netstat
- ping
- wget

### Dir & File

- cd

- chmod
chmod ugo+rwxa file    user group other read write executable all

- chown
chown 用户名:用户分组

- du
du -sh

- ln
ln -s

- ls

- mkdir
mkdir -p

- rm
rm -rf

### Jobs

- ^ c
- ^ d
- ^ z
- fg
- bg
- jobs

### Language

- composer
- gem
- maven
- npm
- yarn

### Others

- crontab
- docker
- export
- git
- gdb

- find
递归查找文件
find [dir] -name 'file_name'

- make

- ps
`ps -ef`
`ps aux`
- kill
kill -HUP

- python
- php

- rsync
rsync -goDp

- service
- sudo
- su
- source
- strace
- ltrace

- screen
- tmux

- top
- htop

- uptime
- uname
- whoami
- which
- whereis

- z
- zsh

### macOS

- launchctl
- pbcopy
- pbpaste
- realpath

- readline

### Bash

- bash
.bashrc
scrpit

### lock

chattr +i file
chattr -i file
lsattr 查锁