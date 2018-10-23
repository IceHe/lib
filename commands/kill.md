# kill

> terminate or signal a process

- [Differences between `kill <pid>` & `kill -9 <pid>`](https://unix.stackexchange.com/questions/8916/when-should-i-not-kill-9-a-process)

## Options

- `-s, --signal <signal>` Specify the signal to send.
    - The signal may be given as a signal name or number.
- `-l, --list <signal>` Print a list of signal names, or convert signal given as argument to a name.
    - The signals are found in /usr/include/linux/signal.h

## Usage

### Common

Process ID `<pid>`

- How to get

```bash
pidof <process_name>
pgrep <process_name>
ps aux | grep <process_name>
ps -ef | grep <process_name>
……
```

Kill process

- give the target process a chance to clean up
    - terminal sub-process

```bash
kill <pid>
# aka (in BSD)
kill -s TERM <pid>
# or (in Linux)
kill -s SIGTERM <pid>
# aka
kill -15 <pid>
```

Force to kill process

- sub-processes may not be killed

```bash
kill -9 <pid>
# aka (in BSD)
kill -s KILL <pid>
# or (in Linux)
kill -s SIGKILL <pid>
```

Kill process & then restart it

```bash
kill -1 <pid>
# aka (in BSD)
kill -s HUP <pid>
# or (in Linux)
kill -s SIGHUP <pid>
```

### List Signals

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
58) SIGRTMAX-6  59) SIGRTMAX-5  60) SIGRTMAX-4  61) SIGRTMAX-3  62) SIGRTMAX-2
63) SIGRTMAX-1  64) SIGRTMAX
```

## killall

> kill processes by name

### Options

- `-u <username>` Limit potentially matching processes to those belonging to the specified user
- `-w` | `--wait` Wait for all killed processes to die
    - Note that killall may wait forever if the signal was ignored, had no effect, or if the process stays in zombie state.

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

## Others

- `pgrep` find processes by name
- `pkill` signal processes by name
