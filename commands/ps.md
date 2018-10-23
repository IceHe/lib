# ps

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

Standard syntax ( Unix-style )

```bash
$ ps -ef
  UID   PID  PPID   C STIME   TTY           TIME CMD
    0     1     0   0 Wed11PM ??         0:35.22 /sbin/launchd
    0    52     1   0 Wed11PM ??         0:01.15 /usr/sbin/syslogd
    0    53     1   0 Wed11PM ??         0:03.27 /usr/libexec/UserEventAgent (System)
  ………
```

BSD syntax ( BSD-style )

```bash
$ ps aux
USER  PID  %CPU %MEM      VSZ    RSS   TT  STAT STARTED      TIME COMMAND
root    52   0.0  0.0  4305532   1240   ??  Ss   Wed11PM   0:01.17 /usr/sbin/syslogd
root  5277   0.0  0.0  4268180   1120 s002  R+    1:29AM   0:00.00 ps aux
root     1   0.0  0.1  4328008  11828   ??  Ss   Wed11PM   0:36.65 /sbin/launchd
……
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
