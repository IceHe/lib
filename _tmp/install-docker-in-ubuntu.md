ubuntu 如何安装 docker ！

- 由于墙的原因，无法直接连接 docker.com
    - 没法用 apt install 直接装（已经设置好源了）
    - 没法用 sh get-docker.sh 脚本装
    - 反正山穷水尽
- shadowsocks 的 sslocal 只能在命令行产生 socks 代理，没法用 HTTP 代理来解决问题

```bash
export HTTP_PROXY=127.0.0.1:1080;
export HTTPS_PROXY=127.0.0.1:1080;
```

- 找不到可以在本地把 socks proxy 转成 http proxy 的方法
- 找不到连接到远程 shadowsocks client (HTTP) 的方法
- 最后mac桌面版下载 *.deb ，再用 U盘把该 *.deb 安装包传到服务器上，才安装上……（太痛苦了，浪费了好多时间，才找到了这种方法！）
- **想问运维一个问题：远程的云服务器该怎么绕过墙安装一些软件？！**

答案？！

- 问了一下舍友（永胜），发现自己谷歌百度上找来的参考资料很不靠谱！
    - 舍友推荐 https://legacy.gitbook.com/book/yeasy/docker_practice/details
- 正确的参考资料说明了「软件源」的问题！（运维也是应该使用软件源来解决这个问题的）

感想

- 原来两者 2min ~ 30min 解决的问题不小心就搞了几个小时（恐怕有十个小时），真是南辕北辙！