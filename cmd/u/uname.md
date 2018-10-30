# uname

> print system information

## Options

- `-a, --all` Print all information, in the following order, except omit `-p` & `-i` if unknown
- `-s, --kernel-name` Kernel name
- `-n, --nodename` Network node hostname
- `-v, --kernel-version` Kernel version
- `-m, --machine` Print the machine hardware name
- `-p, --processor` Print the processor type or "unknown"
- `-i, --hardware-platform` Print the hardware platform or "unknown"
- `-o, --operating-system` Print the operating system

## Usage

```bash
$ uname -a
# Linux
Linux icehe-haha 3.10.0-229.el7.x86_64 #1 SMP Fri Mar 6 11:36:42 UTC 2015 x86_64 x86_64 x86_64 GNU/Linux
# BSD
Darwin icehe-laptop-2.local 17.7.0 Darwin Kernel Version 17.7.0: Thu Jun 21 22:53:14 PDT 2018; root:xnu-4570.71.2~1/RELEASE_X86_64 x86_64
```