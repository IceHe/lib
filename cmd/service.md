# service

> run a System V init script

/etc/init.d

- The directory containing System V init scripts.

Control services

```bash
service <SCRIPT> <COMMAND> [OPTIONS]

# common
service <serv_name> <start|stop|restart|status>
# seldom
service <serv_name> <try-restart|reload|force-reload>
```

e.g.

```bash
$ service nginx restart
Redirecting to /bin/systemctl restart nginx.service

$ service nginx status
Redirecting to /bin/systemctl status  nginx.service
nginx.service
   Loaded: not-found (Reason: No such file or directory)
   Active: inactive (dead)
```
