# nginx

HTTP and reverse proxy server, mail proxy server

---

References

-   `man nginx`

## Find config path

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

# target:
/usr/local/openresty/nginx/conf/nginx.conf
```

## View config

```bash
$ nginx -T
# e.g.
…
# configuration file /usr/local/openresty/nginx/conf/vhost/example.icehe.life.conf:
    server {
        listen       80;
        server_name  example.icehe.life;
        root /data/wwwroot/example.icehe.life;
        #charset koi8-r;

        #access_log  logs/host.access.log  main;
        access_log              /data/logs/example.icehe.life/access.log combined buffer=512k flush=1m;
        error_log               /data/logs/example.icehe.life/error.log warn;
        location ~* \.(html|js|json)$ {
        gzip_static on;
    }
    location ^~ /dist/ {
        gzip_static on;
    }
            #error_page  404              /404.html;

        # redirect server error pages to the static page /50x.html
        #
        error_page   500 502 503 504  /50x.html;
        location = /50x.html {
            root   html;
        }

        # proxy the PHP scripts to Apache listening on 127.0.0.1:80
        #
        #location ~ \.php$ {
        #    proxy_pass   http://127.0.0.1;
        #}

        # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
        #
        #location ~ \.php$ {
        #    root           html;
        #    fastcgi_pass   127.0.0.1:9000;
        #    fastcgi_index  index.php;
        #    fastcgi_param  SCRIPT_FILENAME  /scripts$fastcgi_script_name;
        #    include        fastcgi_params;
        #}

        # deny access to .htaccess files, if Apache's document root
        # concurs with nginx's one
        #
        #location ~ /\.ht {
        #    deny  all;
        #}
    }
```
