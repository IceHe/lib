# Crontab

> maintain crontab files for individual users

## Commands

List current crontab

```bash
crontab -l
```

Edit crontab

```bash
crontab -e
```

## Config File

### User

File Path

```bash
$ tree /var/spool/cron

# output e.g.
/var/spool/cron
├── root
├── sysmon
└── icehe
```

File sample

[/etc/crontab](user-crontab ':include :type=code bash')

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
0 * * * * root /bin/sleep $(($RANDOM\%120+10)) && /usr/sbin/ntpdate tiger.sina.com.cn > /dev/null
0 3,7,10,13,16,19,23 * * *              root /var/cfengine/bin/cfexecd
# run sce_agent_update
0 * * * * root /bin/sleep $(($RANDOM\%120+10)) && /bin/sh /var/sce/sce_agent_update.sh >> /var/log/sce/sce_agent.lo
g 2>&1
#run sce_sync
*/10 * * * * root /bin/sleep $(($RANDOM\%120+10)) && /bin/sh /var/sce/sce_agent/jobs/sce_sync.sh >> /var/log/sce/sc
e_agent.log 2>&1
30 */1 * * * root /var/cfengine/inputs/files/scripts/cfengine_health_check.sh
```

## Timing

crontab guru : <https://crontab.guru/#0_*_*_*_*>

- The quick and simple editor for cron schedule expressions
