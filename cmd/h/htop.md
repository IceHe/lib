# htop

> interactive process viewer

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

Interactive Commands
