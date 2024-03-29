# Crontab

On Linux

**crond - daemon to execute scheduled commands**

On BSD

**A time-based job scheduler in Unix-like computer operating systems.**

---

References

- `man crontab`
- **Cheat Sheet** : https://crontab.guru/#0_*_*_*_*
    - _The quick and simple editor for cron schedule expressions by Cronitor_
- Manual : http://crontab.org
- Wikipedia : https://en.wikipedia.org/wiki/Cron

Related Command

- `crontab` : maintain crontab files for individual users

Assume

- on Linux ( CentOS 7 )

Notice

- **`cron`** is different from `crontab`
    - Cron Expression Generator & Explainer : https://www.freeformatter.com/cron-expression-generator-quartz.html
    - Cron Trigger Tutorial : http://www.quartz-scheduler.org/documentation/quartz-2.3.0/tutorials/crontrigger.html

## Usage

List current crontab

```bash
crontab -l
```

Edit crontab

```bash
crontab -e
```

## Config

### User

Content sample

```bash
# Setup Environment Variables
## Timezone
TZ=Asia/Shanghai
HOME=/path/to/home/
SHELL=/bin/bash
PATH=/usr/local/sbin:/usr/local/bin:/usr/sbin:/usr/bin:/sbin:/bin
MAILTO=root

# Schedules
* * * * * ./script_to_execute.sh
15 * * * * ./script_with_output.sh &>> output.log
```

Source file paths

```bash
$ tree /var/spool/cron
/var/spool/cron
├── root
├── sysmon
└── icehe
```

### System

Files & Direcotries

- /etc/crontab ( file )
- /etc/cron.d/*
- /etc/cron.daily/*
- /etc/cron.hourly/*
- /etc/cron.monthly/*
- /etc/cron.weekly/*

/etc/crontab ( just a template )

```bash
SHELL=/bin/bash
PATH=/sbin:/bin:/usr/sbin:/usr/bin
MAILTO=root
HOME=/

# For details see man 4 crontabs

# Example of job definition:
# .---------------- minute (0 - 59)
# |  .------------- hour (0 - 23)
# |  |  .---------- day of month (1 - 31)
# |  |  |  .------- month (1 - 12) OR jan,feb,mar,apr ...
# |  |  |  |  .---- day of week (0 - 6) (Sunday=0 or 7) OR sun,mon,tue,wed,thu,fri,sat
# |  |  |  |  |
# *  *  *  *  * user-name command to be executed

# run ntp
0 * * * * root /bin/sleep $(($RANDOM\%120+10)) && /usr/sbin/ntpdate example.com.cn > /dev/null
0 3,7,10,13,16,19,23 * * *              root /var/cfengine/bin/cfexecd
# run sce_agent_update
0 * * * * root /bin/sleep $(($RANDOM\%120+10)) && /bin/sh /var/sce/sce_agent_update.sh >> /var/log/sce/sce_agent.lo
g 2>&1
#run sce_sync
*/10 * * * * root /bin/sleep $(($RANDOM\%120+10)) && /bin/sh /var/sce/sce_agent/jobs/sce_sync.sh >> /var/log/sce/sc
e_agent.log 2>&1
30 */1 * * * root /var/cfengine/inputs/files/script/cfengine_health_check.sh
```

### Timing

crontab guru : <https://crontab.guru/#0_*_*_*_*>

- The quick and simple editor for cron schedule expressions

## Debug

### Log

Log files

- /var/log/cron
- /var/log/cron-[YYYYMMdd]
- /var/log/cron-[YYYYMMdd].gz

/var/log/cron

- Log content sample

```bash
Sep  7 15:19:14 box029 crontab[17831]: (root) BEGIN EDIT (icehe)
Sep  7 15:19:17 box029 crontab[17831]: (root) REPLACE (icehe)
Sep  7 15:19:17 box029 crontab[17831]: (root) END EDIT (icehe)
Sep  7 15:20:01 box029 CROND[17915]: (root) CMD (/usr/lib64/sa/sa1 1 1)
Sep  7 15:21:01 box029 CROND[18033]: (sysmon) CMD (cd /usr/local && ./send.sh >/dev/null 2>&1)
Sep  7 16:01:01 box029 CROND[23251]: (root) CMD (run-parts /etc/cron.hourly)
Sep  7 16:01:01 box029 run-parts(/etc/cron.hourly)[23251]: starting 0anacron
Sep  7 16:01:01 box029 run-parts(/etc/cron.hourly)[23268]: finished 0anacron
Sep  7 16:01:01 box029 run-parts(/etc/cron.hourly)[23251]: starting mcelog.cron
Sep  7 16:01:01 box029 run-parts(/etc/cron.hourly)[23274]: finished mcelog.cron
```

Log written by **rsyslog**.service

- Start if it's off

```bash
# systemv
systemctl status rsyslog
systemctl start rsyslog

# service
service rsyslog status
service rsyslog start
```

### crond

Jobs run by **crond**.service

```bash
# systemv
systemctl <status|start|stop|restart> crond

# service
service crond <status|start|stop|restart> crond
```

## On macOS

1\. Open the Crontab config file

```bash
crontab -e
```

2\. Install / Edit a crontab

```bash
* * * * * /usr/local/bin/terminal-notifier -title "定时提醒" -message "测试每分钟弹浮窗" -ignoreDnD -group 1
0,30 * * * * /usr/local/bin/terminal-notifier -title "定时提醒" -message "该喝水了～" -ignoreDnD -group 1
10 */1 * * * /usr/local/bin/terminal-notifier -title "定时提醒" -message "该活动颈椎了～" -ignoreDnD -group 2 ​​​
```

- Prepare : `brew install terminal-notifier`
- References : https://weibo.com/6067744410/JgC7UbZI5

### Not Working?

- Problem : Crontab is not working on macOS?
- Solution : Grant cron Full Disk Access in MacOS
- _Reference : How to Fix Cron Permission Issues in MacOS Catalina & Mojave_ : https://osxdaily.com/2020/04/27/fix-cron-permissions-macos-full-disk-access

![allow-cron-full-disk-access-mac.jpg](_image/allow-cron-full-disk-access-mac.jpg)
