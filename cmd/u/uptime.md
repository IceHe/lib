# uptime

> Tell how long the system has been running.

## Options

Linux

- `-p, --pretty` Show uptime in pretty format
- `-s, --since` System up since, in yyyy-mm-dd HH:MM:SS format

BSD

- None

## Usage

Linux

```bash
$ uptime
11:23:14 up 483 days, 17:34,  2 users,  load average: 0.25, 0.18, 0.28

$ uptime -p
up 1 year, 17 weeks, 17 hours, 34 minutes

$ uptime -s
2017-07-03 17:49:26
```

BSD

```bash
$ uptime
11:25  up 22 days, 21:09, 7 users, load averages: 2.82 3.19 3.22
```
