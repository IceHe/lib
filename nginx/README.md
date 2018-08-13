# Nginx

## Usage

- Put config file in directory `/etc/nginx/conf.d/`
    - or `/usr/local/ect/nginx/servers` ( macOS )
- Replace `/path/to/website` with real path
- Run `service nginx restart` in terminal ( SysVinit )
    - or `systemctl restart nginx` ( systemd )
    - or `nginx -s reload`
- Visit `http://[host_ip]:[port]/` in browser

## Simple Conf

File : simple.conf

[simple.conf](./simple.conf ':include :type=code nginx')
