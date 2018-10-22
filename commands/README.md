# Commands

- which
- whereis
`where` `which`

```bash
$ where python
# output e.g.
/usr/local/bin/python
/usr/bin/python
```

```bash
$ which python
# output e.g.
/usr/local/bin/python
```

## TODOs

- [ab](ab.md)
- [awk-sed-grep_tmp](awk-sed-grep_tmp.md)
- [bash](bash.md)
- [dstat](dstat.md)
    - https://linux.cn/article-3215-1.html
- [sed](sed.md)
- top / **htop**
- iftop 流量带宽
- [useful_tmp](useful_tmp.md)

https://www.tldp.org/LDP/Bash-Beginners-Guide/html/sect_10_02.html

<!-- - awk / sed / grep / xargs -->

## Archived

Recommended Guide

- [The Art of Command Line](https://github.com/jlevy/the-art-of-command-line/blob/master/README.md) / [中文版](https://github.com/jlevy/the-art-of-command-line/blob/master/README-zh.md)

Mine

- [Home/CLI](README.md#cli)

Manual

- `man` is an interface to the on-line reference manuals

```bash
man <command>

# `man bash`
```

## Temporary

`tree` ( mock ) : list directory content

```bash
find <directory_path> | sed -e "s/[^-][^\/]*\//  |/g" -e "s/|\([^ ]\)/|── \1/"
```

`ln` make links

```bash
ln -s <source_file> <target_file>
```

unix / linux 不同的程序仓库代表什么

- /bin
- /sbin
- /usr/bin
- /usr/sbin
- /usr/local/bin
- /usr/local/sbin
- /usr/local/go/bin
- /Users/USERNAME/.composer/vendor/bin
- ……

`jq`

> Command-line JSON processor

- `… | jq -r 'join(",")'`
    - 原来错的命令行是 `… | jq -r '.[]|join(",")'`
    - `.[]` 表达式，遍历显示所有 value！
- `… | jq -r '.playlists | .[].id'`
    - 将 playlists 数组中的每个元素的 id 提取出来
- ref : http://hyperpolyglot.org/json

`touch` change file access and modification times

`cat /etc/*-release` 查看 Linux ( Distribution ) 发行版

设置时区

``` sh
# 设置时区
#   以便正确设置 crontab 的执行时间
#   写成 `\cp` 是为了跳过 confirmation 直接执行命令

\cp /usr/share/zoneinfo/Asia/Shanghai /etc/localtime

# 当时在 V7 的 Docker 镜像里试，
# -r, -f 和 -i 选项，都还是要进行确认，真是不明白为啥……
```

- 另一种方法

``` sh
TZ=Asia/Shanghai
ln -snf /usr/share/zoneinfo/$TZ /etc/localtime && echo $TZ > /etc/timezone
```

测量整条命令的运行时间

- 还是用 `perf stat -r N -d` 比较靠谱和精确
- 用 bash 的 time 命令一来系统误差较大（可能高达 2 毫秒），二来精度不足，只到毫秒精度
- 当然，perf stat 还能输出很多其他有用的信息
    - 比如 dcache 命中率还有 branch misprediction 比例等很多方面的 CPU 统计信息

删除无用的 Docker containers

```bash
docker ps -a | grep Exited | awk '{ print $1 }' | xargs docker rm
# better
docker ps -a -q | xargs docker rm
```

`mktemp` 创建临时文件

- 那么 `mktemp || bail` 有什么用？

重启 dockerd

```bash
kill -SIGHUP $(pidof dockerd)
```

压缩图片

```bash
sips -Z 640 *.jpg
```

将 PNG 图片转换成 JPG

```bash
mogrify -format jpg *.png
```

查看文件、文件夹占用的磁盘大小

```bash
# cwd
du -sh
# files in cwd
du -sh *
```

https://devhints.io

- 命令行输出
    0 标准输入流 stdin
    1 标准输出流 stdout
    2 标准错误输出 stderr
- `cut` 剪切数据。以每一行为一个处理对象。
    -b 按字节 -c 按字符 -f 按域 －d 指定分隔符 与 awk 相似
- `2>>/dev/null` 把错误流写进/dev/null中，
    /dev/null是类Unix系统中的一个特殊文件设备，
    作用是接受一切输入它的数据，并丢弃这些数据
- `$?` 上个命令的退出状态，或函数的返回值
- `head -n 1` | `head -1` 显示文件的第1行
- `tr` 对来自标准输入的字符进行替换、压缩和删除
    可以将一组字符变成另外一组字符。`tr 'A-Z' 'a-z'` 则为大小写替换

`tcpdump`

```bash
tcpdump -i any -nnX -w file_name
```

解压缩 http://alex09.iteye.com/blog/647128

```bash
# .gz
## compress
gzip <file_path>
## de-compress
gzip -d <file_path>.gz
gunzip <file_path>.gz

# .rar
## compress
rar a <file_path>.rar <dir_path>
## de-compress
rar x <file_path>.rar

# .tar
## compress
tar cvf <file_path>
## de-compress
tar xvf <file_path>

# .tar.Z
## compress
tar cZvf <file_path>
## de-compress
tar xZvf <file_path>.tar.Z

# Z
## compress
compress <file_path>
## de-compress
uncompress <file_path>.Z

# .zip
## compress
zip <file_path>.zip <dir_path>
## de-compress
unzip <file_path>.zip
```

截取文件内容

- 头几行 `head -5`，中间几行 `sed -n '10,20p'`，末尾几行 `tail -5`

https://blog.csdn.net/kangaroo_07/article/details/43733891

### bash

bash 脚本

#### -ex

`bash -ex` 同 `set -ex`

- `-e` 有命令执行错误就退出
- `-x` 打印执行的命令行

参考 https://www.peterbe.com/plog/set-ex

[bash 的威力](https://zhuanlan.zhihu.com/p/31209138?group_id=915890535597486080)

#### 循环语句

```bash
#!/bin/bash

for i in {03..23}; do
    echo processing access.log.20181007-$i

    gunzip access.log.20181007-$i.gz

    grep 'playlists/video_stream.json' access.log.20181007-$i >> access_log_video_stream
    wc -l access_log_video_stream

    grep 'playlists/list.json' access.log.20181007-$i >> access_log_list
    wc -l access_log_list

    grep 'playlists/show.json' access.log.20181007-$i >> access_log_show
    wc -l access_log_show

    gzip access.log.20181007-$i
done
```

## Art of CLI

> The Art of Command Line : 命令行的艺术

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
- z

### lock

chattr +i file
chattr -i file
lsattr 查锁
