# ps

On Linux

> report a snapshot of the current processes

On BSD

> process status

## Options

- `-e` | `-A` Select all processes
- `-f` Do full-format listing
    - This option can be combined with many other UNIX-style options to add additional columns.
    - It also causes the command arguments to be printed.
    - See the `c` option, the format keyword args, and the format keyword comm.

### Style

- BSD-style options `v`
- Unix-style options `-v`
- GNU-style options `--version`

Reference : https://unix.stackexchange.com/questions/78691/unix-bsd-gnu-options-in-linuxs-ps-command-where-are-they-from

## Usage

### Common

Standard syntax ( Unix-style )

```bash
$ ps -ef
UID  PID PPID C STIME TTY     TIME CMD
root   1    0 0  2017 ?   00:56:33 /usr/lib/systemd/systemd --switched-root --system --deserialize 24
root   2    0 0  2017 ?   00:00:15 [kthreadd]
root   3    2 0  2017 ?   00:02:26 [ksoftirqd/0]
root   5    2 0  2017 ?   00:00:00 [kworker/0:0H]
……

# seldom
$ ps -eF
UID  PID PPID  C    SZ  RSS PSR STIME TTY     TIME CMD
root   1    0  0 14334 3432   3  2017 ?   00:56:33 /usr/lib/systemd/systemd --switched-root --system --deserialize 24
root   2    0  0     0    0   6  2017 ?   00:00:15 [kthreadd]
root   3    2  0     0    0   0  2017 ?   00:02:26 [ksoftirqd/0]
root   5    2  0     0    0   0  2017 ?   00:00:00 [kworker/0:0H]
……
```

BSD syntax ( BSD-style )

```bash
$ ps aux
USER  PID  %CPU %MEM      VSZ    RSS   TTY STAT STARTED      TIME COMMAND
root    52   0.0  0.0  4305532   1240   ??  Ss   Wed11PM   0:01.17 /usr/sbin/syslogd
root  5277   0.0  0.0  4268180   1120 s002  R+    1:29AM   0:00.00 ps aux
root     1   0.0  0.1  4328008  11828   ??  Ss   Wed11PM   0:36.65 /sbin/launchd
……

$ ps ax
PID TTY STAT  TIME COMMAND
  1 ?   Ss   56:33 /usr/lib/systemd/systemd --switched-root --system --deserialize 24
  2 ?   S     0:15 [kthreadd]
  3 ?   S     2:26 [ksoftirqd/0]
  5 ?   S<    0:00 [kworker/0:0H]
……
```

### Others

> See `man ps` on Linux

Print using standard syntax

```bash
ps -e
ps -ely

# e.g.
$ ps -e
PID TTY     TIME CMD
  1 ?   00:56:33 systemd
  2 ?   00:00:15 kthreadd
  3 ?   00:02:26 ksoftirqd/0
  5 ?   00:00:00 kworker/0:0H
……
```

Print a process tree

```bash
$ ps -ejH
 1789  1789  1789 ?        00:00:00   sshd
30544 30544 30544 ?        00:00:00     sshd
30548 30544 30544 ?        00:00:13       sshd
30549 30549 30549 pts/4    00:00:00         bash
30601 30601 30549 pts/4    00:00:00           sudo
30602 30602 30549 pts/4    00:00:00             bash
30660 30660 30549 pts/4    00:00:00               tmux
30692 30692 30692 ?        00:00:00     sshd
30696 30692 30692 ?        00:00:02       sshd
30697 30697 30697 pts/7    00:00:00         bash
 5091  5091 30697 pts/7    00:00:00           sudo
 5092  5092 30697 pts/7    00:00:00             bash
11093 11093 30697 pts/7    00:00:00               man
11106 11093 30697 pts/7    00:00:00                 less
16681 16681 16681 ?        00:00:00     sshd
16685 16681 16681 ?        00:00:00       sshd
16686 16686 16686 pts/9    00:00:00         bash
16782 16782 16686 pts/9    00:00:00           sudo
16783 16783 16686 pts/9    00:00:00             bash
28028 28028 16686 pts/9    00:00:00               ps
 4036  4036  4036 ?        00:00:00     sshd
 4040  4036  4036 ?        00:00:00       sshd
 4049  4049  4049 pts/10   00:00:00         bash
 4801  4801  4049 pts/10   00:00:00           sudo
 4802  4802  4049 pts/10   00:00:01             bash

# More details
$ ps axjf
    1  1789  1789  1789 ?           -1 Ss       0   0:00 /usr/local/sbin/sshd -D
 1789 30544 30544 30544 ?           -1 Ss       0   0:00  \_ sshd: zhiyuan16 [priv]
30544 30548 30544 30544 ?           -1 S     1115   0:13  |   \_ sshd: zhiyuan16@pts/4
30548 30549 30549 30549 pts/4    30660 Ss    1115   0:00  |       \_ -bash
30549 30601 30601 30549 pts/4    30660 S        0   0:00  |           \_ sudo -s
30601 30602 30602 30549 pts/4    30660 S        0   0:00  |               \_ /bin/bash
30602 30660 30660 30549 pts/4    30660 S+       0   0:00  |                   \_ tmux attach-session -t 0
 1789 30692 30692 30692 ?           -1 Ss       0   0:00  \_ sshd: zhiyuan16 [priv]
30692 30696 30692 30692 ?           -1 S     1115   0:02  |   \_ sshd: zhiyuan16@pts/7
30696 30697 30697 30697 pts/7    11093 Ss    1115   0:00  |       \_ -bash
30697  5091  5091 30697 pts/7    11093 S        0   0:00  |           \_ sudo -s
 5091  5092  5092 30697 pts/7    11093 S        0   0:00  |               \_ /bin/bash
 5092 11093 11093 30697 pts/7    11093 S+       0   0:00  |                   \_ man ps
11093 11106 11093 30697 pts/7    11093 S+       0   0:00  |                       \_ less -s
 1789 16681 16681 16681 ?           -1 Ss       0   0:00  \_ sshd: zhiyuan16 [priv]
16681 16685 16681 16681 ?           -1 S     1115   0:00  |   \_ sshd: zhiyuan16@pts/9
16685 16686 16686 16686 pts/9    26620 Ss    1115   0:00  |       \_ -bash
16686 16782 16782 16686 pts/9    26620 S        0   0:00  |           \_ sudo -s
16782 16783 16783 16686 pts/9    26620 S        0   0:00  |               \_ /bin/bash
16783 26620 26620 16686 pts/9    26620 R+       0   0:00  |                   \_ ps axjf
 1789  4036  4036  4036 ?           -1 Ss       0   0:00  \_ sshd: jiayue7 [priv]
 4036  4040  4036  4036 ?           -1 S     1098   0:00      \_ sshd: jiayue7@pts/10
 4040  4049  4049  4049 pts/10    4802 Ss    1098   0:00          \_ -bash
 4049  4801  4801  4049 pts/10    4802 S        0   0:00              \_ sudo -s
 4801  4802  4802  4049 pts/10    4802 S+       0   0:01                  \_ /bin/bash
```

Print every process running as root (real & effective ID) in user format

```bash
$ ps -U root -u root u
USER PID %CPU %MEM   VSZ  RSS TTY STAT START  TIME COMMAND
root   1  0.0  0.0 57336 3432 ?   Ss    2017 56:33 /usr/lib/systemd/systemd --switched-root --system --deserialize 24
root   2  0.0  0.0     0    0 ?   S     2017  0:15 [kthreadd]
root   3  0.0  0.0     0    0 ?   S     2017  2:26 [ksoftirqd/0]
root   5  0.0  0.0     0    0 ?   S<    2017  0:00 [kworker/0:0H]
……
```

Print every process with a user-defined format

```bash
ps -eo pid,tid,class,rtprio,ni,pri,psr,pcpu,stat,wchan:14,comm
ps axo stat,euid,ruid,tty,tpgid,sess,pgrp,ppid,pid,pcpu,comm
ps -Ao pid,tt,user,fname,tmout,f,wchan
```

Print only the process IDs of syslogd

```bash
ps -C tmux -o pid=
```

Print only the name of PID 1

```bash
ps -q 1 -o comm=
```

## Process

### Flags

The sum of these values is displayed in the "F" column, which is provided by the flags output specifier:

- `1` forked but didn't exec
- `4` used super-user privileges

### State Codes

Here are the different values that the s, stat and state output specifiers (header "STAT" or "S") will display to
describe the state of a process:

- `D` uninterruptible sleep (usually IO)
- `R` running or runnable (on run queue)
- `S` interruptible sleep (waiting for an event to complete)
- `T` stopped by job control signal
- `t` stopped by debugger during the tracing
- `W` paging (not valid since the 2.6.xx kernel)
- `X` dead (should never be seen)
- `Z` defunct ("zombie") process, terminated but not reaped by its parent
