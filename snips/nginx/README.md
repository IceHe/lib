# Nginx

> a free, open-source, high-performance HTTP server and reverse proxy, as well as an IMAP/POP3 proxy server.

- Home : https://www.nginx.com/
- Wiki : https://www.nginx.com/resources/wiki/
- Docs : Nginx中文文档 : http://www.nginx.cn/doc/


## Simple HTTP Server

### Usage

- Put config file in directory `/etc/nginx/conf.d/`
    - or `/usr/local/ect/nginx/servers` ( macOS )
- Replace `/path/to/website` with real path
- Run `service nginx restart` in terminal ( SysVinit )
    - or `systemctl restart nginx` ( systemd )
    - or `nginx -s reload`
- Visit `http://<host>:<port>/` in browser

### Simple Conf

File : simple.conf

[simple.conf](./simple.conf ':include :type=code nginx')

### Proxy Pass

Modify nginx config

- Find specified domain server config
- Append location config
    - Put `location /sub_path/` before `location /`
    - Setup proxy `proxy_pass` to real website host

File : proxy_pass.conf

[proxy_pass.conf](./proxy_pass.conf ':include :type=code nginx')

## Basic

