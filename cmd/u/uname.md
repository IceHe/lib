# uname

> print system information

## Options

Linux

- `-a, --all` Print all information, in the following order, except omit `-p` & `-i` if unknown
- `-s, --kernel-name` Kernel name
- `-n, --nodename` Network node hostname
- `-v, --kernel-version` Kernel version
- `-m, --machine` Print the machine hardware name
- `-p, --processor` Print the processor type or "unknown"
- `-i, --hardware-platform` Print the hardware platform or "unknown"
- `-o, --operating-system` Print the operating system

BSD

- `-a` Behave as though all of the options -mnrsv were specified
- `-m` Machine hardware name
- `-n` Nodename
    - The nodename may be a name that the system is known by to a communications network.
- `-p` Machine processor architecture name
- `-r` Operating system release
- `-s` Operating system name
- `-v` Operating system version

## Usage

Linux

```bash
$ uname -a
Linux icehe-haha 3.10.0-229.el7.x86_64 #1 SMP Fri Mar 6 11:36:42 UTC 2015 x86_64 x86_64 x86_64 GNU/Linux
# Kernel Version : 3.10.0-229.el7.x86_64 #1 SMP Fri Mar 6 11:36:42 UTC 2015

# Kernel Name
$ uname -s
Linux

# - Nodename
$ uname -n
icehe-haha

# Kernel Version
$ uname -v
#1 SMP Fri Mar 6 11:36:42 UTC 2015

# Machine
$ uname -m
x86_64

# Processor
$ uname -p
x86_64

# Hardware Platform
$ uname -i
x86_64

# Operating System
$ uname -o
GNU/Linux
```

BSD

```bash
Darwin icehe-laptop-2.local 17.7.0 Darwin Kernel Version 17.7.0: Thu Jun 21 22:53:14 PDT 2018; root:xnu-4570.71.2~1/RELEASE_X86_64 x86_64
# Darwin icehe-laptop-2.local 17.7.0 Darwin Kernel Version 17.7.0: Thu Jun 21 22:53:14 PDT 2018; root:xnu-4570.71.2~1/RELEASE_X86_64 x86_64

# Machine Hardware Name
$ uname -m
x86_64

# Nodename
$ uname -n
icehe-laptop-2.local

# Machine Processor Architecture Name
$ uname -p
i386

# Operating System Release
$ uname -r
17.7.0

# Operating System Name
$ uname -s
Darwin

# Operating System Version
$ uname -v
Darwin Kernel Version 17.7.0: Thu Jun 21 22:53:14 PDT 2018; root:xnu-4570.71.2~1/RELEASE_X86_64
```
