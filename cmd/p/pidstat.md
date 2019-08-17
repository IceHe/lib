# pidstat

> Report statistics for Linux tasks.

The pidstat command is used for monitoring individual tasks currently being managed by the Linux kernel.

> `top` 能知道系统 CPU 高,
> `pidstat` 能找到对应哪个进程导致的 CPU 高,
> 最后 `perf` 能找到这个进程的哪些函数调用占用了 CPU，
>
> 这几个工具一个比一个看的更细节, 一般也是这个思路查 CPU 问题.
>
> From : https://weibo.com/1642628345/I1zCoaD1I

## Quickstart

### Default

```bash
pidstat
# output
Linux 3.10.0-957.5.1.el7.x86_64 (icehe)         08/17/2019      _x86_64_        (1 CPU)

09:42:13 AM   UID       PID    %usr %system  %guest    %CPU   CPU  Command
09:42:13 AM     0         1    0.00    0.00    0.00    0.00     0  systemd
09:42:13 AM     0         2    0.00    0.00    0.00    0.00     0  kthreadd
09:42:13 AM     0         3    0.00    0.00    0.00    0.00     0  ksoftirqd/0
09:42:13 AM     0         9    0.00    0.00    0.00    0.00     0  rcu_sched
09:42:13 AM     0        11    0.00    0.00    0.00    0.00     0  watchdog/0
09:42:13 AM     0        15    0.00    0.00    0.00    0.00     0  khungtaskd
09:42:13 AM     0        30    0.00    0.00    0.00    0.00     0  kswapd0
09:42:13 AM     0        89    0.00    0.00    0.00    0.00     0  kauditd
09:42:13 AM     0       512    0.00    0.00    0.00    0.00     0  tmux
09:42:13 AM     0       739    0.00    0.00    0.00    0.00     0  vim
09:42:13 AM     0      1147    0.00    0.00    0.00    0.00     0  kworker/0:1H
09:42:13 AM     0      1205    0.00    0.00    0.00    0.00     0  jbd2/vda1-8
09:42:13 AM     0      1280    0.00    0.00    0.00    0.00     0  systemd-journal
09:42:13 AM     0      1310    0.00    0.00    0.00    0.00     0  systemd-udevd
09:42:13 AM     0      1778    0.00    0.00    0.00    0.00     0  auditd
09:42:13 AM    81      2134    0.00    0.00    0.00    0.00     0  dbus-daemon
09:42:13 AM     0      2405    0.00    0.00    0.00    0.00     0  systemd-logind
09:42:13 AM   999      2411    0.00    0.00    0.00    0.00     0  polkitd
09:42:13 AM     0      2419    0.00    0.00    0.00    0.00     0  atd
09:42:13 AM     0      2422    0.00    0.00    0.00    0.00     0  crond
09:42:13 AM   998      2442    0.00    0.00    0.00    0.00     0  chronyd
09:42:13 AM     0      2743    0.01    0.00    0.00    0.01     0  tuned
09:42:13 AM     0      2750    0.00    0.00    0.00    0.01     0  rsyslogd
09:42:13 AM     0      3125    0.00    0.00    0.00    0.00     0  sshd
09:42:13 AM     0      3160    0.02    0.02    0.00    0.04     0  aliyun-service
09:42:13 AM     0      5567    0.00    0.00    0.00    0.00     0  kworker/u2:0
09:42:13 AM     0     15868    0.00    0.00    0.00    0.01     0  AliYunDunUpdate
09:42:13 AM     0     15920    0.05    0.03    0.00    0.08     0  AliYunDun
09:42:13 AM     0     20140    0.00    0.00    0.00    0.00     0  kworker/0:2
09:42:13 AM     0     21945    0.00    0.00    0.00    0.00     0  kworker/0:1
09:42:13 AM     0     23416    0.00    0.00    0.00    0.00     0  kworker/u2:1
```

### Interval

Display 5 reports of CPU statistics for every active task in the system at 2 second intervals.

```bash
pidstat 2 5
# output
Linux 3.10.0-957.5.1.el7.x86_64 (icehe)         08/17/2019      _x86_64_        (1 CPU)

10:25:29 AM   UID       PID    %usr %system  %guest    %CPU   CPU  Command

10:25:31 AM   UID       PID    %usr %system  %guest    %CPU   CPU  Command
10:25:33 AM     0     15920    0.00    0.50    0.00    0.50     0  AliYunDun

10:25:33 AM   UID       PID    %usr %system  %guest    %CPU   CPU  Command
10:25:35 AM     0     15920    0.51    0.00    0.00    0.51     0  AliYunDun
10:25:35 AM     0     22086    0.00    0.51    0.00    0.51     0  pidstat

10:25:35 AM   UID       PID    %usr %system  %guest    %CPU   CPU  Command
10:25:37 AM     0     15920    0.50    0.50    0.00    1.00     0  AliYunDun

10:25:37 AM   UID       PID    %usr %system  %guest    %CPU   CPU  Command
10:25:39 AM     0         9    0.00    0.50    0.00    0.50     0  rcu_sched
10:25:39 AM     0     22086    0.00    0.50    0.00    0.50     0  pidstat

Average:      UID       PID    %usr %system  %guest    %CPU   CPU  Command
Average:        0         9    0.00    0.10    0.00    0.10     -  rcu_sched
Average:        0     15920    0.20    0.20    0.00    0.40     -  AliYunDun
Average:        0     22086    0.00    0.20    0.00    0.20     -  pidstat
```

### Pid

Display 5 reports of page faults and memory statistics for PID 15920 at 2 second intervals.

```bash
pidstat -r -p 15920 2 5
# output
Linux 3.10.0-957.5.1.el7.x86_64 (icehe)         08/17/2019      _x86_64_        (1 CPU)

10:29:04 AM   UID       PID  minflt/s  majflt/s     VSZ    RSS   %MEM  Command
10:29:06 AM     0     15920      3.02      0.00  134088  17748   3.56  AliYunDun
10:29:08 AM     0     15920      0.00      0.00  134088  17748   3.56  AliYunDun
10:29:10 AM     0     15920      0.00      0.00  134088  17748   3.56  AliYunDun
10:29:12 AM     0     15920      0.00      0.00  134088  17748   3.56  AliYunDun
10:29:14 AM     0     15920      0.00      0.00  134088  17748   3.56  AliYunDun
Average:        0     15920      0.60      0.00  134088  17748   3.56  AliYunDun
```

### CMD Name

Display global page faults and memory statistics for all the processes whose command name includes the string "ali" or "bird".

```bash
pidstat -C 'ali|pid' -r -p ALL
# output
Linux 3.10.0-957.5.1.el7.x86_64 (icehe)         08/17/2019      _x86_64_        (1 CPU)

10:32:06 AM   UID       PID  minflt/s  majflt/s     VSZ    RSS   %MEM  Command
10:32:06 AM     0      3160      0.02      0.00   40748   2740   0.55  aliyun-service
10:32:06 AM     0     22093      0.00      0.00  108168   1040   0.21  pidstat
```

### Child

Display 5 reports of page faults statistics at 2 second intervals for the child processes of all tasks in the system.

Notice : Only child processes with non-zero statistics values are displayed.

```bash
pidstat -T CHILD -r 2 5
# output
Linux 3.10.0-957.5.1.el7.x86_64 (icehe)         08/17/2019      _x86_64_        (1 CPU)

10:34:41 AM   UID       PID minflt-nr majflt-nr  Command
10:34:43 AM     0     15920         6         0  AliYunDun
10:34:43 AM     0     22094       158         0  pidstat

10:34:43 AM   UID       PID minflt-nr majflt-nr  Command
10:34:45 AM     0     22094       162         0  pidstat

10:34:45 AM   UID       PID minflt-nr majflt-nr  Command
10:34:47 AM     0     22094       153         0  pidstat

10:34:47 AM   UID       PID minflt-nr majflt-nr  Command
10:34:49 AM     0     22094       153         0  pidstat

10:34:49 AM   UID       PID minflt-nr majflt-nr  Command
10:34:51 AM     0     22094       153         0  pidstat

Average:      UID       PID minflt-nr majflt-nr  Command
Average:        0     15920         1         0  AliYunDun
Average:        0     22094       156         0  pidstat
```

## Options

- `-C comm` Display only tasks whose command name includes the string comm.
    - This string can be a regular expression.
- `-p { pid [,...] | SELF | ALL }` Select tasks (processes) for which statistics are to be reported.
    - pid is the process identification number.
- `-r` Report page faults and memory utilization.
    - UID : The real user identification number of the task being monitored.
    - USER : The name of the real user owning the task being monitored.
    - PID : The identification number of the task being monitored.
    - minflt/s : Total number of minor faults the task has made per second, those which have not required loading a memory page from disk.
    - majflt/s : Total number of major faults the task has made per second, those which have required loading a memory page from disk.
    - VSZ : Virtual Size - The virtual memory usage of entire task in kilobytes.
    - RSS : Resident Set Size - The non-swapped physical memory used by the task in kilobytes.
    - %MEM : The tasks's currently used share of available physical memory.
    - Command : The command name of the task.
- `-T { TASK | CHILD | ALL }`
    - This option specifies what has to be monitored by the pidstat command.
    - The TASK keyword indicates that statistics are to be reported for individual tasks (this is the default option) whereas the CHILD keyword indicates that statistics are to be globally reported for the selected tasks and all their children.
