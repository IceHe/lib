# Commands

Reference

- Coreutils - GNU core utilities : https://www.gnu.org/software/coreutils/coreutils.html
- URL Template as follow

> www.gnu.org/software/coreutils/manual/html_node/**[COMMAND_NAME]**-invocation.html

TODO

- dig
- nslookup
- ifconfig

## TODOs

- [awk-sed-grep_tmp](awk-sed-grep_tmp.md)

https://www.tldp.org/LDP/Bash-Beginners-Guide/html/sect_10_02.html

## Archived

Recommended Guide

- [The Art of Command Line](https://github.com/jlevy/the-art-of-command-line/blob/master/README.md) / [中文版](https://github.com/jlevy/the-art-of-command-line/blob/master/README-zh.md)

Mine

- [Home/CLI](README.md#cli)

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

### Process

- ack
- ag
- awk
- cut
    - join
    - paste
- sed
- xargs

#### filter

- comm
- diff
- grep
    - grep -v
    - egrep
    - grep -E
- vimdiff

### Network

- ifconfig
- ping

### Dir & File

- chmod

chmod ugo+rwxa file    user group other read write executable all

- chown

chown 用户名:用户分组

- ln

ln -s

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
- z

### lock

chattr +i file
chattr -i file
lsattr 查锁

## Useful

统计每秒访问量

`grep 'interface_name' localhost_access_log |awk '{print $5}' |sort |uniq -c |sort -n -r |head -n 20`

用root身份执行最后一个命令

`sudo !!`

在当前文件夹下开启一个简易http服务器，可以用于临时分享文件

`python -m SimpleHTTPServer`

把最后一次执行命令的foo替换成bar后执行

`^foo^bar`

开启编辑器，用来编辑一个复杂命令并执行

`ctrl-x e`

插入最近命令的参数，每按一次向前移动一个参数

`'ALT+.' or '<ESC> .'`

开启一个简易计时器

`time read`

less版tail -f，按ctrl+c可以暂停输入，shift+F继续输入。

`less +F file`

把上一个命令存为sh文件

`echo "!!" > foo.sh`

输出文件中start_pattern到stop_pattern中间的部分

`awk '/start_pattern/,/stop_pattern/' file.txt`

为特别复杂的语句添加label，以后可以在ctrl+R时直接搜索label

`some_very_long_and_complex_command # label`

删除非.foo,.bar.baz的文件

`rm !(*.foo|*.bar|*.baz)`

去掉重复行（不需要排序）

`awk '!x[$0]++' file`

grep时去掉grep本身

`ps aux |grep [p]rocess-name`

输出文件的10-20行

`sed -n '10,20p' file`

显示当前正在使用网络的连接。

`ss -p`

用finder打开当前文件夹（mac）。

`open .`

显示当前文件夹下最大的10个文件/文件夹。

`du -s * |sort -n |tail`

把file2的权限更新到与file1一致.

`chmod --reference file1 file2`

同ctrl+x e

`fc`

显示进程树

`ps awwfux |less -S`

执行command，如果5s后没有结束就kill它。

`timeout 5s COMMAND`

对比当前和10秒后进程打开文件的情况（同理可对比其它命令）

`diff <(lsof -p 1234) <(sleep 10; lsof -p 1234)`

重复执行上一个命令直到执行成功

`util !!;do :;done`

在某种文件类型中搜索关键字

`find . -name "*.[ch]" -exec grep -i -H "search pharse" {} \;`

查看哪个进程占用了80端口

`lsof -i tcp:80`

删除1，3列

`awk '{$1=$3=""}1' file`

显示行号

`nl`

切换到上一个命令最后一个参数指向的目录（:t是文件）

`cd !$:h`

计算299秒是多少分钟

`bc <<< 'obase=60;299'`

## sed

```bash
#!/bin/sh

for arg in $*
do
    grep -E '(?:class )(.*?)(?:Sniff)' $arg \
        | awk '{ print $2; }' \
        | awk -F 'Sniff' '{ print "    <!-- ## Squiz.Operators."$1" -->"; }' \
        >> ~/Desktop/tmp.txt

    sed -n '3p' $arg \
        | sed 's/^...//g; s/\.$//g' \
        | awk '{ print "    <!-- "$0" -->"; }' \
        >> ~/Desktop/tmp.txt

    echo >> ~/Desktop/tmp.txt
done
```

## ab

> Apache Bench

References

- Tutorial : https://www.tutorialspoint.com/apache_bench

Install

https://blog.csdn.net/kingofworld/article/details/41774079

### Usage

Options

- `-c` concurrent?
- `-n` request times
- `-t` duration second
- `-g` output data

Related commands

- dstat
- iostat ?

### http_load

## Bash

> GNU Bourne-Again SHell

Bash Cheatsheet https://devhints.io/bash

References

- [Bash脚本](https://github.com/ruanyf/articles/blob/master/dev/linux/script.md)
- <http://www.linux-sxs.org/programming/bashcheat.html>
- <http://ahei.info/chinese-bash-man.htm>
- <https://www.gnu.org/software/bash/manual/bashref.html>
- <http://tldp.org/LDP/Bash-Beginners-Guide/html/index.html>
- <http://www.linuxtopia.org/online_books/advanced_bash_scripting_guide/refcards.html>

### TEMP

confirm.sh

```bash
#!/bin/bash

read -r -p "Are You Sure? [Y/n]"
echo

if [[ $REPLY =~ ^[yY]$ ]]; then
    echo 'Yes'
elif [[ $REPLY =~ ^[nN]$ ]]; then
    echo 'No'
else
    echo 'Invalid Input!'
fi
```

## zgrep

```bash
zgrep 'content' file.gz
```
