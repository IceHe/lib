# systemctl

> Control the systemd system and service manager

## Synopsis

```bash
systemctl [OPTIONS...] COMMAND [NAME]
```

### Control services

```bash
systemctl <start|stop|reload|restart|status> <parttern>
```

More COMMAND details

* `reload` : reload **configuration** of the units
* `try-restart` : restart **if the units are running** \( do nothing if not running \)
* `show` : show **properties** of the units
* `kill` : send a signal to one or more proecesses of the unit
* ……

```bash
# e.g.
$ systemctl restart nginx
$ systemctl status nginx
● nginx.service - The nginx HTTP and reverse proxy server
   Loaded: loaded (/etc/systemd/system/nginx.service; disabled; vendor preset: disabled)
   Active: active (running) since Sun 2018-09-30 19:22:22 CST; 4s ago
  Process: 236844 ExecStart=/usr/sbin/nginx (code=exited, status=0/SUCCESS)
  Process: 236840 ExecStartPre=/usr/sbin/nginx -t (code=exited, status=0/SUCCESS)
  Process: 236837 ExecStartPre=/usr/bin/rm -f /run/nginx.pid (code=exited, status=0/SUCCESS)
 Main PID: 236845 (nginx)
    Tasks: 25
   Memory: 12.5M
   CGroup: /system.slice/nginx.service
           ├─236845 nginx: master process /usr/sbin/nginx
           ├─236846 nginx: worker process
           ├─236848 nginx: worker process
           ├─……
           └─236870 nginx: worker process

Sep 30 19:22:22 box029.wb.trans.imgbed.bx.sinanode.com systemd[1]: Starting The nginx HTTP and reverse proxy server...
Sep 30 19:22:22 box029.wb.trans.imgbed.bx.sinanode.com nginx[236840]: nginx: the configuration file /etc/nginx/nginx.conf sy... ok
Sep 30 19:22:22 box029.wb.trans.imgbed.bx.sinanode.com nginx[236840]: nginx: configuration file /etc/nginx/nginx.conf test i...ful
Sep 30 19:22:22 box029.wb.trans.imgbed.bx.sinanode.com systemd[1]: Failed to read PID from file /run/nginx.pid: Invalid argument
Sep 30 19:22:22 box029.wb.trans.imgbed.bx.sinanode.com systemd[1]: Started The nginx HTTP and reverse proxy server.
Hint: Some lines were ellipsized, use -l to show in full.
```

### List services

All

```bash
$ systemctl list-unit-files
UNIT FILE                                     STATE
dev-mqueue.mount                              static
sys-kernel-debug.mount                        static
tmp.mount                                     disabled
brandbot.path                                 disabled
cups.path                                     enabled
…
```

Enabled

```bash
$ systemctl list-unit-files | grep enabled
UNIT FILE                                     STATE
docker.service                                enabled
nginx-proxy.service                           enabled
rsyslog.service                               enabled
…
```

