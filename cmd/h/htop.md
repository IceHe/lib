# htop

> interactive process viewer

References

- `man htop`

## Quickstart

```bash
$ htop

  CPU[||                       1.3%]   Tasks: 21, 36 thr; 1 running
  Mem[|||||||||||||||||||60.5M/487M]   Load average: 0.23 0.09 0.07
  Swp[                        0K/0K]   Uptime: 33 days, 17:35:13

  PID USER      PRI  NI  VIRT   RES   SHR S CPU% MEM%   TIME+  Command
 6441 root        0 -20  123M  8420  5816 S  0.7  1.7  2h41:57 /usr/local/aegi…
28509 root       20   0  119M  2184  1424 R  0.7  0.4  0:00.05 htop
 3164 root       20   0 40748  2744  2000 S  0.0  0.6  6:37.65 /usr/sbin/aliyu…
    1 root       20   0 43532  3516  2300 S  0.0  0.7  0:32.53 /usr/lib/system…
 1779 root       16  -4 55520  1104   648 S  0.0  0.2  0:00.07 /sbin/auditd
……

# Then press `h` to get help

htop 2.2.0 - (C) 2004-2019 Hisham Muhammad
Released under the GNU GPL. See 'man' page for more info.

CPU usage bar: [low-priority/normal/kernel/virtualiz               used%]
Memory bar:    [used/buffers/cache                            used/total]
Swap bar:      [used                                          used/total]
Type and layout of header meters are configurable in the setup screen.

 Status: R: running; S: sleeping; T: traced/stopped; Z: zombie; D: disk sleep
 Arrows: scroll process list              Space: tag process
 Digits: incremental PID search               c: tag process and its children
   F3 /: incremental name search              U: untag all processes
   F4 \: incremental name filtering        F9 k: kill process/tagged processes
   F5 t: tree view                         F7 ]: higher priority (root only)
      p: toggle program path               F8 [: lower priority (+ nice)
      u: show processes of a single user      a: set CPU affinity
      H: hide/show user process threads       e: show process environment
      K: hide/show kernel threads             i: set IO priority
      F: cursor follows process               l: list open files with lsof
 F6 + -: expand/collapse tree                 s: trace syscalls with strace
  P M T: sort by CPU%, MEM% or TIME
      I: invert sort order               F2 C S: setup
 F6 > .: select sort column                F1 h: show this help screen
Press any key to return.                  F10 q: quit
```

## Options

- `-p, --pid=PID,PID...` Given PIDs only
- `-s, --sort-key COLUMN` Sort by selected COLUMN
- `-u, --user=USERNAME` Processes of a given user only

## Columns

### Default

### Common

- Command : Full command line of the process
    - i.e. program name and arguments
- PID : Process ID
- PPID : Parent process ID
- STATE (S) : State of the process
    - S : Sleeping (idle)
    - R : Running
    - D : Disk sleep (uninterruptible)
    - Z : Zombie (waiting for parent to read its exit status)
    - T : Traced or suspended (e.g. by SIGTSTP)
    - W : Paging
- NLWP : Number of threads in the process.
- PERCENT_CPU (CPU%) : Percentage of the CPU time that the process is currently using.
- UTIME (UTIME+) : The user CPU time
    - which is the amount of time the process has spent executing on the CPU in user mode (i.e everything but system calls), measured in clock ticks.
- STIME (STIME+) : The system CPU time
    - which is the amount of time the kernel has spent executing system calls on behalf of the process, measured in clock ticks.
- TIME (TIME+) : The time
    - measured in clock ticks that the process has spent in user and system time (see UTIME, STIME above).
- PRIORITY (PRI) : The kernel's internal priority for the process
    - usually just its nice value plus twenty. Different for real-time processes.
- PERCENT_MEM : Percentage of memory the process is currently using
    - (based on the process's resident memory size, see  M_RESIDENT below).
- M_SIZE (VIRT) : Size in memory of the total program size
- M_RESIDENT (RES) : The resident set size, i.e the size of the text and data sections, plus stack usage.
- M_SHARE (SHR) : The size of the process's shared pages
- USER : The username of the process owner, or the user ID if the name can't be determined.

### Others

- PGRP : Process's group ID
- SESSION (SESN) : The process's session ID
- TTY_NR (TTY) : The controlling terminal of the process
- TPGID : Process ID of the foreground process group of the controlling terminal.
- PROCESSOR (CPU) : ID of the CPU the process last executed on
- NICE (NI) : The nice value of a process, from 19 (low priority) to -20 (high priority).
    - A high value means the process is being nice, letting others have a higher relative priority. Only root can lower the value.
- CUTIME
    The  children's user CPU time, which is the amount of time the process's waited-for children have spent executing
    in user mode (see UTIME above).
- CSTIME : The children's system CPU time
    - which is the amount of time the kernel has spent executing system calls on  behalf of all the process's waited-for children (see STIME above).
- M_TRS (CODE) : The size of the text segment of the process (i.e the size of the processes executable instructions).
- M_LRS (LIB) : The library size of the process.
- M_DRS (DATA) : The size of the data segment plus stack usage of the process.
- M_DT (DIRTY) : The size of the dirty pages of the process.
- ST_UID (UID) : The user ID of the process owner.
- STARTTIME : The time the process was started.
- RCHAR (RD_CHAR) : The number of bytes the process has read.
- WCHAR (WR_CHAR) : The number of bytes the process has written.
- SYSCR (RD_SYSC) : The number of read(2) syscalls for the process.
- SYSCW (WR_SYSC) : The number of write(2) syscalls for the process.
- RBYTES (IO_RBYTES) : Bytes of read(2) I/O for the process.
- WBYTES (IO_WBYTES) : Bytes of write(2) I/O for the process.
- IO_READ_RATE (IORR) : The I/O rate of read(2) in bytes per second, for the process.
- IO_WRITE_RATE (IOWR) : The I/O rate of write(2) in bytes per second, for the process.
- IO_RATE (IO) : The I/O rate, IO_READ_RATE + IO_WRITE_RATE (see above).
- CNCLWB (IO_CANCEL) : Bytes of cancelled write(2) I/O.
- CGROUP : Which cgroup the process is in.
- CTID : OpenVZ container ID, a.k.a virtual environment ID.
- VPID : OpenVZ process ID.
- VXID : VServer process ID.
- OOM : OOM killer score.
- All other flags : Currently unsupported (always displays '-').

## Commands

> Interactive Commands

The following commands are supported while in htop:

- `Arrows, PgUP, PgDn, Home, End` Scroll the process list.
- `Space` Tag or untag a process.
    - Commands that can operate on multiple processes, like "kill", will then apply over the list of tagged processes, instead of the currently highlighted one.
- `U` Untag all processes (remove all tags added with the Space key).
- `s` Trace process system calls
    - if strace(1) is installed, pressing this key will attach it to the currently selected process, presenting a live update of system calls issued by the process.
- `l` Display open files for a process
    - if lsof(1) is installed, pressing this key will display the list of file descriptors opened by the process.
- `F1, h, ?` Go to the help screen
- `F2, S` Go to the setup screen, where you can configure the meters displayed at the top of the screen, set various display options, choose among color schemes, and select which columns are displayed, in which order.
- `F3, /` Incrementally search the command lines of all the displayed processes.
    - The currently selected (highlighted) command will update as you type.
    - While in search mode, pressing F3 will cycle through matching occurrences.
- `F4, \` Incremental process filtering: type in part of a process command line and only processes whose names match will be shown.
    - To cancel filtering, enter the Filter option again and press Esc.
- `F5, t` Tree view: organize processes by parenthood, and layout the relations between them as a tree.
    - Toggling the key will switch between tree and your previously selected sort view.
    - Selecting a sort view will exit tree view.
- `F6` On sorted view, select a field for sorting, also accessible through < and >.
    - The current sort field is indicated by a highlight in the header.
    - On tree view, expand or collapse the current subtree.
    - A "+" indicator in the tree node indicates that it is collapsed.
- `F7, ]` Increase the selected process's priority (subtract from 'nice' value).
    - This can only be done by the superuser.
- `F8, [` Decrease the selected process's priority (add to 'nice' value)
- `F9, k` "Kill" process: sends a signal which is selected in a menu, to one or a group of processes.
    - If processes were tagged, sends the signal to all tagged processes.
    - If none is tagged, sends to the currently selected process.
- `F10, q` Quit
- `I` Invert the sort order: if sort order is increasing, switch to decreasing, and vice-versa.
- `+, -` When in tree view mode, expand or collapse subtree.
    - When a subtree is collapsed a "+" sign shows to the left of the process name.
- `a` (on multiprocessor machines) Set CPU affinity: mark which CPUs a process is allowed to use.
- `u` Show only processes owned by a specified user.
- `M` Sort by memory usage (top compatibility key).
- `P` Sort by processor usage (top compatibility key).
- `T` Sort by time (top compatibility key).
- `F` "Follow" process: if the sort order causes the currently selected process to move in the list, make the selection bar follow it.
    - This is useful for monitoring a process: this way, you can keep a process always visible on screen.
    - When a movement key is used, "follow" loses effect.
- `K` Hide kernel threads: prevent the threads belonging the kernel to be displayed in the process list. (This is a toggle key.)
- `H` Hide user threads: on systems that represent them differently than ordinary processes (such as recent NPTL-based systems), this can hide threads from userspace processes in the process list. (This is a toggle key.)
- `Ctrl-L` Refresh: redraw screen and recalculate values.
- `Numbers` PID search: type in process ID and the selection highlight will be moved to it.
