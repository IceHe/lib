# 命令行笔记

> The Art of Command Line : 命令行的艺术

-----------------

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
    - grep -v
    - egrep
    - grep -E
- vimdiff

### Network

- ifconfig
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

### Others

- export
- gdb
- find

递归查找文件
find [dir] -name 'file_name'

- make
- rsync

rsync -goDp

- sudo
- su
- source
- strace
- ltrace

- screen

- top
- htop

- uptime
- uname
- whoami
- which
- whereis

- z

### lock

chattr +i file
chattr -i file
lsattr 查锁
