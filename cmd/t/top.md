# top

> display Linux processes

References

* `man top`
* 理解Linux系统负荷 : [http://www.ruanyifeng.com/blog/2011/07/linux\_load\_average\_explained.html](http://www.ruanyifeng.com/blog/2011/07/linux_load_average_explained.html)
  * load average 有三个值，分别表示不同时长内的「系统负荷」采样值：1 分钟 / 5 分钟 / 15 分钟！

## Usage

TODO

## Display

### Default

```bash
$ top
top - 18:51:50 up 119 days,  4:10,  1 user,  load average: 0.37, 0.51, 0.53
Tasks: 381 total,   1 running, 376 sleeping,   4 stopped,   0 zombie
%Cpu(s):  1.3 us,  0.9 sy,  0.0 ni, 97.8 id,  0.1 wa,  0.0 hi,  0.0 si,  0.0 st
KiB Mem : 16205448 total,  3243892 free,  5664692 used,  7296864 buff/cache
KiB Swap:  8388604 total,  8254972 free,   133632 used.  9169648 avail Mem

   PID USER      PR  NI    VIRT    RES    SHR S  %CPU %MEM     TIME+ COMMAND
175308 root      20   0   23.1g   4.6g  15220 S   8.6 30.0  29:43.59 java
163516 root      20   0  137368  14372    808 S   4.0  0.1   3530:20 htop
 62195 root      20   0 1689996  29448   2876 S   1.3  0.2 138:56.53 EcoAgent
226858 root      20   0 2719956  99288   6584 S   0.7  0.6 293:40.06 dockerd
 73030 root      20   0   46244  15600   4300 S   0.3  0.1 685:26.32 gitlab-runner
149353 root      20   0  153360  33032   1108 S   0.3  0.2  22:02.69 tmux: server
227155 redis     20   0  142952   5844   1492 S   0.3  0.0   1:15.34 redis-server
     1 root      20   0  191152   3260   1764 S   0.0  0.0 220:48.06 systemd
     2 root      20   0       0      0      0 S   0.0  0.0   0:01.55 kthreadd
     3 root      20   0       0      0      0 S   0.0  0.0  22:07.39 ksoftirqd/0
     5 root       0 -20       0      0      0 S   0.0  0.0   0:00.00 kworker/0:0H
     8 root      rt   0       0      0      0 S   0.0  0.0   0:15.11 migration/0
     9 root      20   0       0      0      0 S   0.0  0.0   0:00.00 rcu_bh
    10 root      20   0       0      0      0 S   0.0  0.0 313:24.15 rcu_sched
    11 root       0 -20       0      0      0 S   0.0  0.0   0:00.00 lru-add-drain
    12 root      rt   0       0      0      0 S   0.0  0.0   1:02.67 watchdog/0
    13 root      rt   0       0      0      0 S   0.0  0.0   1:02.47 watchdog/1
    14 root      rt   0       0      0      0 S   0.0  0.0   0:14.84 migration/1
    15 root      20   0       0      0      0 S   0.0  0.0  11:50.14 ksoftirqd/1
    17 root       0 -20       0      0      0 S   0.0  0.0   0:00.00 kworker/1:0H
    18 root      rt   0       0      0      0 S   0.0  0.0   0:42.36 watchdog/2
    19 root      rt   0       0      0      0 S   0.0  0.0   0:16.49 migration/2
    20 root      20   0       0      0      0 S   0.0  0.0  17:44.97 ksoftirqd/2
    22 root       0 -20       0      0      0 S   0.0  0.0   0:00.00 kworker/2:0H
    23 root      rt   0       0      0      0 S   0.0  0.0   0:42.06 watchdog/3
```

### Help

```bash
Help for Interactive Commands - procps-ng version 3.3.10
Window 1:Def: Cumulative mode Off.  System: Delay 3.0 secs; Secure mode Off.

  Z,B,E,e   Global: 'Z' colors; 'B' bold; 'E'/'e' summary/task memory scale
  l,t,m     Toggle Summary: 'l' load avg; 't' task/cpu stats; 'm' memory info
  0,1,2,3,I Toggle: '0' zeros; '1/2/3' cpus or numa node views; 'I' Irix mode
  f,F,X     Fields: 'f'/'F' add/remove/order/sort; 'X' increase fixed-width

  L,&,<,> . Locate: 'L'/'&' find/again; Move sort column: '<'/'>' left/right
  R,H,V,J . Toggle: 'R' Sort; 'H' Threads; 'V' Forest view; 'J' Num justify
  c,i,S,j . Toggle: 'c' Cmd name/line; 'i' Idle; 'S' Time; 'j' Str justify
  x,y     . Toggle highlights: 'x' sort field; 'y' running tasks
  z,b     . Toggle: 'z' color/mono; 'b' bold/reverse (only if 'x' or 'y')
  u,U,o,O . Filter by: 'u'/'U' effective/any user; 'o'/'O' other criteria
  n,#,^O  . Set: 'n'/'#' max tasks displayed; Show: Ctrl+'O' other filter(s)
  C,...   . Toggle scroll coordinates msg for: up,down,left,right,home,end

  k,r       Manipulate tasks: 'k' kill; 'r' renice
  d or s    Set update interval
  W,Y       Write configuration file 'W'; Inspect other output 'Y'
  q         Quit
          ( commands shown with '.' require a visible task display window )
Press 'h' or '?' for help with Windows,
Type 'q' or <Esc> to continue
```

