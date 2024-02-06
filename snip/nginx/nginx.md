# Nginx

A free, open-source, high-performance HTTP server and reverse proxy, as well as an IMAP/POP3 proxy server.

---

-   Home : https://www.nginx.com/
-   Wiki : https://www.nginx.com/resources/wiki/
-   Docs : Nginx 中文文档 : http://www.nginx.cn/doc/

## Simple HTTP Server

### Usage

-   Put config file in directory `/etc/nginx/conf.d/`
    -   or `/usr/local/etc/nginx/servers` ( macOS )
    -   or see `brew info nginx` ( Apple Silicon macOS )
-   Replace `/path/to/website` with real path
-   Run `service nginx restart` in terminal ( SysVinit )
    -   or `systemctl restart nginx` ( systemd )
    -   or `nginx -s reload`
-   Visit `http://<host>:<port>/` in browser

### Simple Conf

File : simple.conf

[simple.conf](./simple.conf ":include :type=code nginx")

### Proxy Pass

Modify nginx config

-   Find specified domain server config
-   Append location config
    -   Put `location /sub_path/` before `location /`
    -   Setup proxy `proxy_pass` to real website host

File : proxy_pass.conf

[proxy_pass.conf](./proxy_pass.conf ":include :type=code nginx")

## VHOST

Nginx 虚拟主机（Virtual Host）是一种在单个服务器上托管多个网站的功能。

它类似于 Apache 的虚拟主机，允许您在同一台服务器上托管多个域名或网站。
Nginx 的虚拟主机配置文件被称为"server block"，
它允许您根据不同的域名或请求路径来配置不同的网站内容和行为。
通过配置 Nginx 虚拟主机，您可以将多个网站托管在同一台服务器上，而无需为每个网站设置一个独立的服务器。
