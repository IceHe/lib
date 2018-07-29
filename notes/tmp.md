title: Tmp Note
---

# Google 技巧：不让 google.com 跳转到 google.com.hk

* 直接用http://www.google.com/ncr，ncr是no country redirection，是一个强制不跳转的命令；
* 用https://www.google.com/，https协议。

# Charles 技巧

* Proxy：代理调试，例如手机使用Charles进行调试。
* HTTPS：SSL 截获、代理，需要安装加密证书。
* View：Structure/Squence 按照请求（路由层级）或顺序，查看请求。
* Filter：过滤，通过 关键词 或 Proxy->Recording Settings。
* Request Response：查看请求、响应的参数和内容，以 JSON、列表 或 文本 等格式查看。
* DNS Spoofing：DNS 欺骗。从一个网址映射到另一网址或 IP 地址。
* Map Remote：端口映射。例如，从80端口81端口
* Throttling：模拟慢速网络。
* Edit：修改包内容。
* Repeat：压力测试。
* Breakpoints：断点，还有 Rewrite 功能等…
* …

# CentOS 安装 PHP7

* 在当时另一台已经装好 PHP7 的开发机，用 `php-config` 查看安装 PHP7 时用的安装指令参数！
* 然后，下载源码 PHP7 源码:
    * `./configure xxx-prefix=安装路径`
    * `make`
    * `make install`
* 安装各种需要用的 PHP7 组件：
    * `git clone xxx` 下载组件的源码
    * `/path/to/php7/bin/phpize`
    * `./configure xxx-prefix?=/path/to/php7`
    * `make`
    * `make install`
    * 如果缺了什么相关库的开发包用 `yum install xxx-devel` 安装 （devel代表带源码的开发包）
* `php -m` 看各组件是否安装好了！
* 配置 nginx
* 启动 php-fpm `/path/to/php7/sbin/php-fpm`

# PhpStorm 配置 远程调试 Xdebug

* 在PhpStorm打开要debug的project
* 右上角点击打开一个下拉小菜单，点击Edit Configurations

* 添加一个PHP Remote Debug，添加一个服务器
    * 填入要进行远程调试环境的主机的 IP
    * 勾选 Use Path mappings
（端口据说使用默认的80就好，不过有时记得根据实际情况调试）
路径填入：与该本地project对应的在远程主机的目录
* 记得 Ide key (session id) 填入的值
必须与远程主机的 php.ini 中 xdebug 写的 ide 一致

* xdebug 的安装过程颇为复杂，请另寻安装教程。
* xdebug 安装后，还需要配置到 /etc/php.ini
    * 工作时远程主机的 xdebug 的配置文件路径为：/etc/php.d/xdebug.ini
    * 当时该配置文件的内容为：
```
[xdebug]
xdebug.remote_enable = On
xdebug.remote_connect_back = Off
xdebug.remote_host = 10.209.2.181（当前本机的ip）
xdebug.remote_port = 9000
xdebug.idekey = phpstorm
xdebug.remote_autostart = 1
```

# 设置更长的超时时间，以便 Xdebug 调试

* 修改 php-fpm 的 v5.conf 配置文件
```
[v5.weibo.cn]
user = www
group = www
listen = 127.0.0.1:9015
listen.allowed_clients = 127.0.0
pm.max_children = 10
;pm.start_servers = 10
;pm.min_spare_servers = 5
;pm.max_spare_servers = 20
pm.max_requests = 1500
slowlog = /data1/v5.weibo.cn/logs/php/$pool-slow_log
;request_slowlog_timeout = 10
;request_terminate_timeout = 30
request_slowlog_timeout = 300
request_terminate_timeout = 300
catch_workers_output
```

# rsync 配置

1. 在 server 的 `/etc/rysnc.conf` 添加设置，对某目录进行rsync支持。
```
[project_name]
hosts allow = 10.0.0.0/8
hosts deny  = *
read only   = false
list        = false
path        = /path/to/project
auth users  = user_name
secrets file = /path/to/rsync.pass
```

2. 在 server 的 `/path/to/rsync.pass` 文件中添加用户和密码，以冒号分隔两者。（该文件的权限位需设为 `600`）
```
user_name:passwd
```

3. 在本机写 rsync 的脚本。
```
#!/bin/sh
rsync -rltgoDP --delete --password-file=/path/to/.rsync.pwd --exclude='/path/need/to/exclude' /path/to/local_project/ rsync://<user_name>@<server_ip_addr>:<port_number>/project_name
```

4. 在本机创建文件 /path/to/.rsync.pwd，并将密码写入其中。（建议其可读写的权限设置得更严格）
```
passwd
```

5. 给本机的 rsync 脚本赋予运行权限， 给 server 的项目目录 /path/to/project 赋予对应 rsync 用户的写入权限，然后运行 rysnc 脚本即可。

# 基于 Composer 的 PHP 模块化开发



