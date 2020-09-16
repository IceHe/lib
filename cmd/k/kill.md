# kill

## kill

> terminate or signal a process

References

* `man kill`
* [Differences between `kill <pid>` & `kill -9 <pid>`](https://unix.stackexchange.com/questions/8916/when-should-i-not-kill-9-a-process)

### Quickstart

```bash
# Get PID of process
pidof nginx
pgrep nginx
ps aux | grep nginx
ps -ef | grep nginx

# kill
kill pid        # Kill a process
kill -9 pid     # Force to kill
kill -1 pid     # Kill & then restart it
kill -s HUP pid

# e.g.
$ pidof nginx
507 541
$ kill -1 507 541
# or
$ pkill -HUP nginx
```

### Options

* `-s, --signal <signal>` Specify the signal to send.
  * The signal may be given as a signal name or number.
* `-l, --list <signal>` Print a list of signal names, or convert signal given as argument to a name.
  * The signals are found in /usr/include/linux/signal.h

### Usage

#### Common

Process ID `<pid>`

* How to get

```bash
pidof <process_name>
pgrep <process_name>
ps aux | grep <process_name>
ps -ef | grep <process_name>
……
```

Kill process

* give the target process a chance to clean up
  * terminal sub-process

```bash
kill <pid>
## aka.
kill -15 <pid>
## aka. on BSD
kill -s TERM <pid>
## aka. on Linux
kill -s SIGTERM <pid>
```

Force to kill process

* sub-processes may not be killed

```bash
kill -9 <pid>
## aka. on BSD
kill -s KILL <pid>
## aka. on Linux
kill -s SIGKILL <pid>
```

Kill process & then restart it

```bash
kill -1 <pid>
# aka on BSD
kill -s HUP <pid>
# or on Linux
kill -s SIGHUP <pid>
```

#### List Signals

```bash
$ kill -l
 1) SIGHUP       2) SIGINT       3) SIGQUIT      4) SIGILL       5) SIGTRAP
 2) SIGABRT      7) SIGBUS       8) SIGFPE       9) SIGKILL     10) SIGUSR1
11)  SIGSEGV     12) SIGUSR2     13) SIGPIPE     14) SIGALRM     15) SIGTERM
16)  SIGSTKFLT   17) SIGCHLD     18) SIGCONT     19) SIGSTOP     20) SIGTSTP
21)  SIGTTIN     22) SIGTTOU     23) SIGURG      24) SIGXCPU     25) SIGXFSZ
26)  SIGVTALRM   27) SIGPROF     28) SIGWINCH    29) SIGIO       30) SIGPWR
31)  SIGSYS      34) SIGRTMIN    35) SIGRTMIN+1  36) SIGRTMIN+2  37) SIGRTMIN+3
38)  SIGRTMIN+4  39) SIGRTMIN+5  40) SIGRTMIN+6  41) SIGRTMIN+7  42) SIGRTMIN+8
43)  SIGRTMIN+9  44) SIGRTMIN+10 45) SIGRTMIN+11 46) SIGRTMIN+12 47) SIGRTMIN+13
48)  SIGRTMIN+14 49) SIGRTMIN+15 50) SIGRTMAX-14 51) SIGRTMAX-13 52) SIGRTMAX-12
53)  SIGRTMAX-11 54) SIGRTMAX-10 55) SIGRTMAX-9  56) SIGRTMAX-8  57) SIGRTMAX-7
58)  SIGRTMAX-6  59) SIGRTMAX-5  60) SIGRTMAX-4  61) SIGRTMAX-3  62) SIGRTMAX-2
63)  SIGRTMAX-1  64) SIGRTMAX
```

### Related

* [`killall`](https://github.com/IceHe/lib/tree/4e6b7c73229e0e23ff9d6acf7f2ba61d9dacec30/cmd/k/killall.md) Kill processes by name
* `pgrep` Find processes by name
* `pkill` Signal processes by name

## killall

> kill processes by name

### Usage

Kill processes by name

```bash
killall <process_name>
```

Kill all processes that a specific user owns

```bash
killall -u <username>
```

Only returns after the process dies

```bash
killall -w <process_name>
```

### Options

* `-u <username>` Limit potentially matching processes to those belonging to the specified user
* `-w` \| `--wait` Wait for all killed processes to die
  * Note that killall may wait forever if the signal was ignored, had no effect, or if the process stays in zombie state.

