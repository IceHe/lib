# sysctl

> configure kernel parameters at runtime

References

* `man sysctl`

## Options

* `-a, --all` Display all values currently available.
* `-w, --write` Use this option when you want to change a sysctl setting.
* `-p[FILE], --load[=FILE]` Load in sysctl settings from the file specified or `/etc/sysctl.conf` if none given.
  * Specifying as filename means reading data from standard input.
  * Using this option will mean arguments to sysctl are files, which are read in the order they are specified.
  * The file argument may be specified as regular expression.
* `-n, --values` Use this option to disable printing of the key name when printing values.
* `-e, --ignore` Use this option to ignore errors about unknown keys.
* `-N, --names` Use this option to only print the names.
  * It may be useful with shells that have programmable completion.

## Config File

e.g.

```bash
$ cat /etc/sysctl.conf
# System default settings live in /usr/lib/sysctl.d/00-system.conf.
# To override those settings, enter new settings here, or in an /etc/sysctl.d/<name>.conf file
#
# For more information, see sysctl.conf(5) and sysctl.d(5).
# System default settings live in /usr/lib/sysctl.d/00-system.conf.
# To override those settings, enter new settings here, or in an /etc/sysctl.d/<name>.conf file
#
# For more information, see sysctl.conf(5) and sysctl.d(5).
kernel.panic = 1
net.ipv4.conf.all.accept_redirects = 0
net.ipv4.conf.default.accept_redirects = 0
net.ipv4.conf.all.send_redirects = 0
net.ipv4.conf.default.send_redirects = 0
net.ipv4.conf.default.arp_ignore = 1
net.ipv4.conf.default.arp_announce = 2
net.ipv4.conf.all.arp_ignore = 1
net.ipv4.conf.all.arp_announce = 2
net.ipv4.ip_no_pmtu_disc = 1
```

## Usage

### All

```bash
$ sysctl -a
user.cs_path: /usr/bin:/bin:/usr/sbin:/sbin
user.bc_base_max: 99
user.bc_dim_max: 2048
user.bc_scale_max: 99
user.bc_string_max: 1000
user.coll_weights_max: 2
user.expr_nest_max: 32
user.line_max: 2048
user.re_dup_max: 255
user.posix2_version: 200112
……
# TL;DR : Try it yourself
```

### Socket

#### View

socket 接收缓冲最大值（单位：Byte）

```bash
$ sysctl net.core.rmem_max
net.core.rmem_max = 16777216

# or
$ sysctl -a | grep net.core.rmem_max
net.core.rmem_max = 16777216

# or
$ cat /proc/sys/net/core/rmem_max
16777216
```

#### Modify

```bash
$ sysctl -w net.core.rmem_max=16777216
net.core.rmem_max = 16777216
```

### Ping

#### Disable

```bash
$ sysctl -w net.ipv4.icmp_echo_ignore_all=1
```

#### Enable

```bash
$ sysctl -w net.ipv4.icmp_echo_ignore_all=0
```

#### via config file

Disable / Enable

* Append content below to `/etc/sysctl.conf`
  * or modify configuration `net.ipv4.icmp_echo_ignore_all` in it

```bash
# Disable/Enable ping requests
net.ipv4.icmp_echo_ignore_all = 1 # disabled
# or
net.ipv4.icmp_echo_ignore_all = 0 # enabled
```

* Bring configs into effect

```bash
$ sysctl -p
```

