# ulimit

> system resource limit to shell

Bash Built-in Command

- see `man bash`

## Synopsis

```bash
ulimit [-HSTabcdefilmnpqrstuvx [limit]]
```

- Provides control over the resources available to the shell and to processes started by it, on systems that allow such control.
- The **`-H` and `-S` options specify that the hard or soft limit** is set for the given resource.
- A hard limit cannot be increased by a non-root user once it is set; a soft limit may be increased up to the value of the hard limit.
- If neither `-H` nor `-S` is specified, both the soft and hard limits are set.
- The value of limit can be a number in the unit specified for the resource or one of the special values hard, soft, or unlimited, which stand for the current hard limit, the current soft limit, and no limit, respectively.
- If limit is omitted, the current value of the soft limit of the resource is printed, unless the `-H` option is given.
- When more than one resource is specified, the limit name and unit are printed before the value.

## Options

Other options are interpreted as follows:

- `-a` All current limits are reported
- `-b` Maximum socket buffer size
- `-c` Maximum size of core files created
- `-d` Maximum size of a process's data segment
- `-e` Maximum scheduling priority ("nice")
- `-f` Maximum size of files written by the shell and its children
- `-i` Maximum number of pending signals
- `-l` Maximum size that may be locked into memory
- `-m` Maximum resident set size (many systems do not honor this limit)
- `-n` Maximum number of open file descriptors (most systems do not allow this value to be set)
- `-p` Pipe size in 512-byte blocks (this may not be set)
- `-q` Maximum number of bytes in POSIX message queues
- `-r` Maximum real-time scheduling priority
- `-s` Maximum stack size
- `-t` Maximum amount of cpu time in seconds
- `-u` Maximum number of processes available to a single user
- `-v` Maximum amount of virtual memory available to the shell and, on some systems, to its children
- `-x` Maximum number of file locks
- `-T` Maximum number of threads

Note that

- If limit is given, it is the new value of the specified resource (the `-a` option is display only).
- If no option is given, then `-f` is assumed.
- Values are in 1024-byte increments, except for `-t`, which is in seconds, `-p`, which is in units of 512-byte blocks, and `-T`, `-b`, `-n`, and `-u`, which are unscaled values.
- The return status is 0 unless an invalid option or argument is supplied, or an error occurs while setting a new limit.
- In POSIX Mode 512-byte blocks are used for the `-c` and `-f` options.

## Usage

### All

- on Linux

#### Soft Limit

( default )

```bash
$ ulimit -a
# same as
$ ulimit -a -S
core file size          (blocks, -c) 0
data seg size           (kbytes, -d) unlimited
scheduling priority             (-e) 0
file size               (blocks, -f) unlimited
pending signals                 (-i) 63214
max locked memory       (kbytes, -l) 64
max memory size         (kbytes, -m) unlimited
open files                      (-n) 200000
pipe size            (512 bytes, -p) 8
POSIX message queues     (bytes, -q) 819200
real-time priority              (-r) 0
stack size              (kbytes, -s) 8192
cpu time               (seconds, -t) unlimited
max user processes              (-u) 63214
virtual memory          (kbytes, -v) unlimited
file locks                      (-x) unlimited
```

#### Hard Limit

```bash
$ ulimit -a -H
core file size          (blocks, -c) 0
data seg size           (kbytes, -d) unlimited
scheduling priority             (-e) 0
file size               (blocks, -f) unlimited
pending signals                 (-i) 63214
max locked memory       (kbytes, -l) 64
max memory size         (kbytes, -m) unlimited
open files                      (-n) 200000
pipe size            (512 bytes, -p) 8
POSIX message queues     (bytes, -q) 819200
real-time priority              (-r) 0
stack size              (kbytes, -s) 8192
cpu time               (seconds, -t) unlimited
max user processes              (-u) 63214
virtual memory          (kbytes, -v) unlimited
file locks                      (-x) unlimited
```

#### File Descriptors

Maximum number of open file descriptors

```bash
# CentOS 7.6
$ ulimit -n
200000

# macOS
$ ulimit -n
4864
```

### _macOS_

Soft Limit ( default )

```bash
$ ulimit -a
# same as
$ ulimit -a -S
-t: cpu time (seconds)              unlimited
-f: file size (blocks)              unlimited
-d: data seg size (kbytes)          unlimited
-s: stack size (kbytes)             8192
-c: core file size (blocks)         0
-v: address space (kbytes)          unlimited
-l: locked-in-memory size (kbytes)  unlimited
-u: processes                       1418
-n: file descriptors                4864
```

Hard Limit

```bash
$ ulimit -a -H
-t: cpu time (seconds)              unlimited
-f: file size (blocks)              unlimited
-d: data seg size (kbytes)          unlimited
-s: stack size (kbytes)             65532
-c: core file size (blocks)         unlimited
-v: address space (kbytes)          unlimited
-l: locked-in-memory size (kbytes)  unlimited
-u: processes                       2128
-n: file descriptors                unlimited
```
