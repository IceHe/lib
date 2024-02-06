# nginx

HTTP and reverse proxy server, mail proxy server

---

References

-   `man nginx`

## Find config

e.g.

```bash
# 1. find nginx path
$ ps aux | grep nginx
root       25407  0.0  0.0  12392  1368 ?        Ss   Feb05   0:00 nginx: master process /usr/local/openresty/nginx/sbin/nginx -g daemon on; master_process on;
…

# 2. find config path
$ sudo /usr/local/openresty/nginx/sbin/nginx -t
nginx: the configuration file /usr/local/openresty/nginx/conf/nginx.conf syntax is ok
nginx: configuration file /usr/local/openresty/nginx/conf/nginx.conf test is successful

# 3. view config
less /usr/local/openresty/nginx/conf/nginx.conf
```
