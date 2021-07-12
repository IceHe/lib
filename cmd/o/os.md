# OS

Show OS info ( not a command )

---

```bash
# 查看 Linux 发行版的名称及其版本号
$ cat /etc/*-release
CentOS Linux release 7.6.1810 (Core)
NAME="CentOS Linux"
VERSION="7 (Core)"
ID="centos"
ID_LIKE="rhel fedora"
VERSION_ID="7"
PRETTY_NAME="CentOS Linux 7 (Core)"
ANSI_COLOR="0;31"
CPE_NAME="cpe:/o:centos:centos:7"
HOME_URL="https://www.centos.org/"
BUG_REPORT_URL="https://bugs.centos.org/"

CENTOS_MANTISBT_PROJECT="CentOS-7"
CENTOS_MANTISBT_PROJECT_VERSION="7"
REDHAT_SUPPORT_PRODUCT="centos"
REDHAT_SUPPORT_PRODUCT_VERSION="7"

CentOS Linux release 7.6.1810 (Core)
CentOS Linux release 7.6.1810 (Core)
```

```bash
# 查看 Linux 内核版本命令
$ uname -a
Linux xyz-icehe-85698c8b66-496g2 4.19.104-300.el7.x86_64 #1 SMP Mon Feb 17 15:34:16 UTC 2020 x86_64 x86_64 x86_64 GNU/Linux
# or
$ cat /proc/version
Linux version 4.19.104-300.el7.x86_64 (mockbuild@x86-02.bsys.centos.org) (gcc version 4.8.5 20150623 (Red Hat 4.8.5-36) (GCC)) #1 SMP Mon Feb 17 15:34:16 UTC 2020
```
