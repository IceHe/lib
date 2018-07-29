title: Cmd Plan
---

``` markdown

<http://www.cnblogs.com/kluan/p/4458278.html> du -m --max-depth=1

<http://siberiawolf.com/free_programming/index.html#Shell>

<https://www.cheatography.com/citguy/cheat-sheets/nix-users-and-groups/>

<https://www.cheatography.com/mrinflictor/cheat-sheets/centos/>

<https://www.cheatography.com/nielzzz/cheat-sheets/ububtu-server/>

[Linux常用操作](https://github.com/ruanyf/articles/blob/master/dev/linux/operations.md) - watch, nmcli, fdisk

[chmod 0000 权限用法](https://github.com/ruanyf/articles/blob/master/dev/linux/basic.md)

[bash的用法](https://github.com/ruanyf/articles/blob/master/dev/linux/bash.md)

[SHELL编程之语法基础 – 邹立巍的博客](http://liwei.life/2016/05/16/69/)

[bash命令一览](https://github.com/ruanyf/articles/blob/master/dev/linux/commands.md)

[Debian的用法](https://github.com/ruanyf/articles/blob/master/dev/linux/debian.md)

[cUrl](https://curl.haxx.se/)

[归档和备份](https://github.com/ruanyf/articles/blob/master/dev/bash/archiving.md)

[一些好用的命令](http://popozhu.github.io/2013/06/24/%E4%B8%80%E4%BA%9B%E5%A5%BD%E7%94%A8%E7%9A%84%E5%91%BD%E4%BB%A4/)

[进程处理](https://github.com/ruanyf/articles/blob/master/dev/linux/process.md)

[软件包管理](https://github.com/ruanyf/articles/blob/master/dev/linux/package.md)

[Linux常用操作](https://github.com/ruanyf/articles/blob/master/dev/linux/operations.md)

[文件处理](https://github.com/ruanyf/articles/blob/master/dev/linux/file-processing.md)

[grep](http://www.cheatography.com/tme520/cheat-sheets/grep/)

[Make 命令教程](https://github.com/ruanyf/articles/blob/master/2015/2015-02-19-make.md)

lsof : list open files

0 Blg: CLI Note! #g

pwd 命令用于显示当前目录。

env 查看环境变量

/etc/hosts：左侧 ip，右侧域名。（脑残不止一两次了！）

「命令行的艺术」<https://github.com/jlevy/the-art-of-command-line/blob/master/README.md>

sed <http://coolshell.cn/articles/9104.html>

awk <http://coolshell.cn/articles/9070.html>

<Linux查看环境变量当前信息和查看命令 http://os.51cto.com/art/201005/202463.htm>

<Features - iTerm2 - Mac OS Terminal Replacement https://iterm2.com/features.html>

<http://www.pixelbeat.org/cmdline.html>

<http://www.unixguide.net/linux/linuxshortcuts.shtml>

<http://www.rain.org/~mkummel/unix.html>

<http://www.catonmat.net/blog/set-operations-in-unix-shell-simplified/>

Bash <http://www.mediacollege.com/cgi-bin/man/page.cgi?topic=bash>

<https://www.quora.com/What-are-some-lesser-known-but-useful-Unix-commands>

<https://www.quora.com/What-are-the-most-useful-Swiss-army-knife-one-liners-on-Unix>

<https://www.quora.com/What-are-some-time-saving-tips-that-every-Linux-user-should-know>

<http://man.linuxde.net>

<http://explainshell.com/>

删除文件夹实例：
rm -rf /var/log/httpd/access
将会删除/var/log/httpd/access目录以及其下所有文件、文件夹

删除文件使用实例：
rm -f /var/log/httpd/access.log
将会强制删除/var/log/httpd/access.log这个文件

linux下重命名文件或文件夹的命令mv既可以重命名，又可以移动文件或文件夹.
例子：将目录A重命名为B
mv A B
例子：将/a目录移动到/b下，并重命名为c
mv /a /b/c

建立符号连接
ln -s src dest
为某一个文件在另外一个位置建立一个同步的链接，最常用的参数是-s
具体用法是：ln –s 源文件 目标文件。
当要在不同的目录，用到相同的文件时，不需要在每一个需要的目录下都放一个必须相同的文件，
只要在某个固定的目录，放上该文件，然后在其它 的目录下用ln命令链接（link）它就可以，不必重复的占用磁盘空间。
例如：ln –s /bin/less /usr/local/bin/less -s 是代号（symbolic）的意思。

查找一个命令的绝对路径
where command_name

MacOS下没有Linux的tree指令用以查看目录树，
可以用一下的指令来代替：
find . -print | sed -e 's;[^/]*/;|____;g;s;____|; |;g'

wget
是一个从网络上自动下载文件的自由工具，支持通过HTTP、HTTPS、FTP三个最常见的TCP/IP协议下载，并可以使用HTTP代理。wget名称的由来是“World Wide Web”与“get”的结合。

uname -a
查看系统的主要信息
（cat /etc/issue     查看系统版本）

sudo -s 和 su root
切换到root权限下

ifconfig
获取本机的ip等有关信息

rsync
# 将代码从本地同步到服务端处
rsync -avzP --delete --password-file=/Users/IceHe/.rsync.pwd --exclude='.git' --exclude='.idea' /Users/IceHe/Coding/Work/weibov5_code_RSYNC_DEV/ rsync://www@dev:8875/weibov5_code

# 将代码从服务端拷贝到本地来
rsync -avzP --delete --password-file=/Users/IceHe/.rsync.pwd --exclude='.git' --exclude='.idea' rsync://www@dev:8875/weibov5_code /Users/IceHe/Coding/Work/weibov5_code_RSYNC_DEV

git clone <url> <dest_path>
设置dest_path，可以将文件放到指定的目录中

在vim中使用Shell指令
先输入“ :! ”，再输入你要使用的指令！

lsof -i tcp:80 哪个程序占用了80端口？

^old^new
替换前一条命令里的部分字符串。
场景：echo"wanderful"，其实是想输出echo"wonderful"。
只需要^a^o

man ascii
显示ascii码表。

netstat–tlnp
列出本机进程监听的端口号

how to use Shadowsocks in Terminal on OS X
http://www.jianshu.com/p/16d7275ec736

---

[Linux Tools Quick Tutorial](http://linuxtools-rst.readthedocs.org/zh_CN)
[crontab 定时任务](linuxtools-rst.readthedocs.org/zh_CN/latest/tool/crontab.html)
[显示文件内容的linux终端命令(cat、head、less、tail等)](http://www.jbxue.com/LINUXjishu/9606.html)
[每天一个linux命令（30）: chown命令](http://www.cnblogs.com/peida/archive/2012/12/04/2800684.html)
[chmod 查看及修改文件权限](http://www.cnblogs.com/CgenJ/archive/2011/07/28/2119454.html)
[查找目录下的所有文件中是否含有某个字符串](http://zhidao.baidu.com/link?url=p2TZzZRgciRt_BhF8V1U6ECHgla2bHQcSvybourupgSMi9-LRZ5EciILv5ZQm6wKKXXG1tXH8gYg5OagHKfCuPZKz5UVobELUX3oE2Wq0_G)
[Unix 高手的 10 个习惯](http://mp.weixin.qq.com/s?__biz=MzAwNjMxMTA5Mw==&amp;mid=400665034&amp;idx=1&amp;sn=e123ee0e7acf0ad1dc79caa672348e3b&amp;scene=1&amp;srcid=11287mrCChrjerjkwuA0ej0K#rd)
[Linux常用系统信息查看命令](http://blogread.cn/it/article/6209)
[CentOS系统中常用查看日志命令](http://www.centoscn.com/CentOS/help/2014/0310/2540.html)
[tar 解压 / 压缩](http://blog.chinaunix.net/uid-1840233-id-3147304.html)
[监控 Linux 的 命令行工具](http://blog.jobbole.com/88704/)
[详述Linux ftp命令的使用方法](http://os.51cto.com/art/201003/186325.htm)
[rsync 简明教程](http://waiting.iteye.com/blog/643171)
[nc (netcat) - 网络工具中的瑞士军刀](http://www.oschina.net/translate/linux-netcat-command)
[20个 Unix/Linux 命令技巧](http://blog.jobbole.com/85378/)
[linux expect命令的使用方法介绍](http://www.111cn.net/sys/linux/78617.htm)
[Bash下Ctrl-C、Ctrl-D和Ctrl-Z的区别](http://haiquan.sinaapp.com/2013/03/%E3%80%90%E5%8E%9F%E5%88%9B%E3%80%91bash%E4%B8%8Bctrl-c%E3%80%81ctrl-d%E5%92%8Cctrl-z%E7%9A%84%E5%8C%BA%E5%88%AB/)
[Linux Add "sudoer"](http://blog.csdn.net/duguduchong/article/details/8126778)
[linux 文件名命名规则](http://xu020408.blog.163.com/blog/static/26548920097209315756/)
[CentOS 安装vsftp 建新用户的方法](http://www.jb51.net/os/RedHat/105909.html)
[Linux Partition n HD Type 分区和硬盘类型](http://fanli7.net/a/caozuoxitong/Linux/20111123/145772.html)

# Copy File & Dir to another dir

About Windows CMD
`xcopy E:\Music_pop\*.mp3 /s d:\t_cp_mp3_0\.`
`for /r E:\Music_symphony %i in (*.mp3) do @echo %i && @copy /y "%i" d:\t_cp_mp3_0`

# CentOS 6.5 Locale Problem

Problem:
```
$ locale
locale: Cannot set LC_CTYPE to default locale: No such file or directory
locale: Cannot set LC_ALL to default locale: ?????????
LANG=zh_CN.UTF-8
LC_CTYPE=UTF-8
LC_NUMERIC="zh_CN.UTF-8"
LC_TIME="zh_CN.UTF-8"
LC_COLLATE="zh_CN.UTF-8"
LC_MONETARY="zh_CN.UTF-8"
LC_MESSAGES="zh_CN.UTF-8"
LC_PAPER="zh_CN.UTF-8"
LC_NAME="zh_CN.UTF-8"
LC_ADDRESS="zh_CN.UTF-8"
LC_TELEPHONE="zh_CN.UTF-8"
LC_MEASUREMENT="zh_CN.UTF-8"
LC_IDENTIFICATION="zh_CN.UTF-8"
LC_ALL=
```

Solution:
I think that what you want to do is type:
`export LC_ALL="zh_CN.UTF-8"`
However i think it's not recommended to do this because it will override all your other locale settings. One thing you might try to avoid that is setting it to an empty string. In theory, that value is allowed to be empty which just tells your computer to use the settings above it.
export LC_ALL=""
I have no idea if that will work, but it's worth a shot.

将这一句放到.zshrc等的Shell类的配置文件，
`export LC_ALL="zh_CN.UTF-8"`
每次启动命令行，就都能正确本地化

# 只显示常规目录

$ ls -d */
$ ls -F | grep /
$ ls -l | grep ^d
$ tree -dL 1

# 只显示隐藏目录

$ ls -d .*/

# 隐藏目录和非隐藏目录都显示

$ find -maxdepth 1 -type d

# hostname命令返回当前服务器的主机名。

$ hostname

# 显示当前的日期时间
$ date
2016年 03月 14日 星期一 17:32:35 CST

# 显示本月日历
$ cal
      三月 2016
日 一 二 三 四 五 六
       1  2  3  4  5
 6  7  8  9 10 11 12
13 14 15 16 17 18 19
20 21 22 23 24 25 26
27 28 29 30 31

# 应用管理

$ whatis nginx
$ whereis nginx

# 命令行小技巧

!! 重复上一个命令

!$ 上一个命令中最后一个参数

Ctrl-y 粘贴上一个被删除的词

# Find 命令

找出某个目录下面所有文件，然后删除

$ find /some/path -type f -delete

或者

$ find /some/path -type f -exec rm -f {} \;

找出某个目录下面指定类型的文件，然后删除

$ find /some/path -type f -iname "*.txt" -exec rm -f {} \;

# icdiff

有颜色辅助，且分列显示的命令，比 diff 好用多了。

# 列举包含某字符串的文件

find ./ -type f | xargs grep 'www.baidu.com'

# pmset

mac 电源管理

```
