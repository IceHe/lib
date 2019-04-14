# w

> Show **who** is logged on and what they are doing

## Options

- `-u, --no-current` Ignores the username while figuring out the current process and cpu times.
    - To demonstrate this, do a "su" and do a "w" and a "w -u".
- `-i, --ip-addr` Display IP address instead of hostname for from field.

## Usage

```bash
$ w
 13:40:00 up 483 days, 19:50,  3 users,  load average: 0.23, 0.50, 0.53
USER     TTY   FROM       LOGIN@ IDLE  JCPU  PCPU  WHAT
someone1 pts/0 10.0.0.1   Thu16  0.00s 0.10s 0.01s sshd: icehe [priv]
icehe    pts/6 172.16.0.0 12:36  1:01m 0.15s 0.00s sshd: icehe [priv]
icehe    pts/5 172.16.0.0 12:34  1:04m 0.54s 0.00s sshd: icehe [priv]
```

```bash
$ w -u
 13:46:18 up 483 days, 19:56,  3 users,  load average: 0.06, 0.22, 0.40
USER     TTY   FROM       LOGIN@ IDLE  JCPU  PCPU  WHAT
someone1 pts/0 10.0.0.1   Thu16  2.00s 0.10s 0.00s tmux attach-session -t 0
icehe    pts/6 172.16.0.0 12:36  1:07m 0.15s 0.00s tail -f access.log error.log
icehe    pts/5 172.16.0.0 12:34  1:10m 0.54s 0.49s bash
```
