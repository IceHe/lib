# nginx

HTTP and reverse proxy server, mail proxy server

---

References

-   `man nginx`
-   [nginx notes](/snip/nginx/nginx.md)

## Reload

```bash
# e.g.
nginx -s reload
# or
systemctl reload nginx
```

## List modules

```bash
$ nginx -V
nginx version: openresty/1.25.3.1
built with OpenSSL 1.1.1w  11 Sep 2023
TLS SNI support enabled
configure arguments:
    --prefix=/usr/local/openresty/nginx
    --with-cc-opt='-O2 -DNGX_LUA_ABORT_AT_PANIC -I/usr/local/openresty/zlib/include -I/usr/local/openresty/pcre/include -I/usr/local/openresty/openssl111/include'
    --add-module=../ngx_devel_kit-0.3.3
    --add-module=../echo-nginx-module-0.63
    --add-module=../xss-nginx-module-0.06
    --add-module=../ngx_coolkit-0.2
    --add-module=../set-misc-nginx-module-0.33
    --add-module=../form-input-nginx-module-0.12
    --add-module=../encrypted-session-nginx-module-0.09
    --add-module=../srcache-nginx-module-0.33
    --add-module=../ngx_lua-0.10.26
    --add-module=../ngx_lua_upstream-0.07
    --add-module=../headers-more-nginx-module-0.37
    --add-module=../array-var-nginx-module-0.06
    --add-module=../memc-nginx-module-0.20
    --add-module=../redis2-nginx-module-0.15
    --add-module=../redis-nginx-module-0.3.9
    --add-module=../ngx_stream_lua-0.0.14
    --with-ld-opt='-Wl,-rpath,/usr/local/openresty/luajit/lib -L/usr/local/openresty/zlib/lib -L/usr/local/openresty/pcre/lib -L/usr/local/openresty/openssl111/lib -Wl,-rpath,/usr/local/openresty/zlib/lib:/usr/local/openresty/pcre/lib:/usr/local/openresty/openssl111/lib'
    --with-pcre-jit
    --with-stream
    --with-stream_ssl_module
    --with-stream_ssl_preread_module
    --with-http_v2_module
    --without-mail_pop3_module
    --without-mail_imap_module
    --without-mail_smtp_module
    --with-http_stub_status_module
    --with-http_realip_module
    --with-http_addition_module
    --with-http_auth_request_module
    --with-http_secure_link_module
    --with-http_random_index_module
    --with-http_gzip_static_module
    --with-http_sub_module
    --with-http_dav_module
    --with-http_flv_module
    --with-http_mp4_module
    --with-http_gunzip_module
    --with-threads
    --with-stream
    --without-pcre2
    --with-http_ssl_module
```

## Find config path

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
