# Jobs

```bash
^c
^d
```

## SIGNALS

- When bash is interactive, in the absence of any traps, it ignores SIGTERM (so that kill 0 does not kill an  interactive shell),  and  SIGINT  is  caught  and  handled (so that the wait builtin is interruptible).
- In all cases, bash ignores SIGQUIT.
- If job control is in effect, bash ignores SIGTTIN, SIGTTOU, and SIGTSTP.

---

- Non-builtin commands run by bash have signal handlers set to the values inherited by the shell from its  parent.
- When job  control is not in effect, asynchronous commands ignore SIGINT and SIGQUIT in addition to these inherited handlers.
- Commands run as a result of command substitution ignore the keyboard-generated job control  signals  SIGTTIN,  SIGTTOU, and SIGTSTP.

---

- The  shell  exits  by default upon receipt of a SIGHUP.
- Before exiting, an interactive shell resends the SIGHUP to all jobs, running or stopped.
- Stopped jobs are sent SIGCONT to ensure that they receive the SIGHUP.
- To prevent the  shell from  sending  the  signal  to  a particular job, it should be removed from the jobs table with the disown builtin (see SHELL BUILTIN COMMANDS below) or marked to not receive SIGHUP using disown -h.

---

- If the huponexit shell option has been set with shopt, bash sends a SIGHUP to all jobs when an interactive login  shell exits.

---

- If  bash is waiting for a command to complete and receives a signal for which a trap has been set, the trap will not be executed until the command completes.
- When bash is waiting for an asynchronous  command  via  the  wait  builtin,  the reception of a signal for which a trap has been set will cause the wait builtin to return immediately with an exit status greater than 128, immediately after which the trap is executed.

## Job Control

- Job control refers to the ability to selectively stop (suspend) the execution of processes and continue (resume)  their execution  at  a  later point.
- A user typically employs this facility via an interactive interface supplied jointly by the operating system kernel's terminal driver and bash.

---

- The shell associates a job with each pipeline.
- It keeps a table of currently executing jobs, which may be listed  with the jobs command.
- When bash starts a job asynchronously (in the background), it prints a line that looks like:

```bash
[1] 25647
```

indicating  that  this  job is job number 1 and that the process ID of the last process in the pipeline associated with this job is 25647.

---

- All of the processes in a single pipeline are members of the same job.
- Bash uses the job  abstraction as the basis for job control.

---

- To  facilitate  the implementation of the user interface to job control, the operating system maintains the notion of a current terminal process group ID.
- Members of this process group (processes whose process group ID  is  equal  to  the current  terminal  process group ID) receive keyboard-generated signals such as SIGINT.
- These processes are said to be in the foreground.
- Background processes are those whose process group ID differs from the terminal's;
    - such  processes are immune to keyboard-generated signals.
- Only foreground processes are allowed to read from or, if the user so specifies with stty tostop, write to the terminal.
- Background processes which attempt to read  from  (write  to  when  stty tostop  is  in  effect) the terminal are sent a SIGTTIN (SIGTTOU) signal by the kernel's terminal driver, which, unless caught, suspends the process.

---

- If the operating system on which bash is running supports job control, bash contains facilities to use it.
- Typing  the suspend  character  (typically  ^Z, Control-Z) while a process is running causes that process to be stopped and returns control to bash.
- Typing the delayed suspend character (typically ^Y, Control-Y) causes the process to be stopped  when it  attempts  to  read  input  from the terminal, and control to be returned to bash.
- The user may then manipulate the state of this job, using the bg command to continue it in the background, the fg command to continue it  in  the  foreground,  or  the kill command to kill it.
- A ^Z takes effect immediately, and has the additional side effect of causing pending output and typeahead to be discarded.

---

- There are a number of ways to refer to a job in the shell.
- The character % introduces a job  specification  (jobspec).
- Job  number  n may be referred to as %n.
- A job may also be referred to using a prefix of the name used to start it, or using a substring that appears in its command line.
- For example, %ce refers to a stopped ce job.
- If a prefix  matches more than one job, bash reports an error.
- Using %?ce, on the other hand, refers to any job containing the string ce in its command line.
- If the substring matches more than one job, bash reports an error.
- The symbols %% and %+  refer  to the  shell's  notion of the current job, which is the last job stopped while it was in the foreground or started in the background.
- The previous job may be referenced using %-.
- If there is only a single job, %+ and %- can both be used to refer  to  that  job.
- In  output pertaining to jobs (e.g., the output of the jobs command), the current job is always flagged with a +, and the previous job with a -.
- A single % (with no accompanying job specification)  also  refers  to the current job.

---

- Simply naming a job can be used to bring it into the foreground: %1 is a synonym for ``fg %1'', bringing job 1 from the background into the foreground.
- Similarly, ``%1 &'' resumes job 1 in the background, equivalent to ``bg %1''.

---

- The shell learns immediately whenever a job changes state.
- Normally, bash waits until it is about to  print  a  prompt before  reporting  changes  in  a  job's  status  so as to not interrupt any other output.
- If the -b option to the set builtin command is enabled, bash reports such changes immediately.
- Any trap on SIGCHLD is executed for each child that exits.

---

- If an attempt to exit bash is made while jobs are stopped (or, if the checkjobs shell option has been enabled using the shopt builtin, running), the shell prints a warning message, and, if the checkjobs option is enabled,  lists  the  jobs and  their  statuses.
- The jobs command may then be used to inspect their status.
- If a second attempt to exit is made without an intervening command, the shell does not print another warning, and any stopped jobs are terminated.

## Commands

### jobs

```bash
jobs [-lnprs] [ jobspec ... ]
jobs -x command [ args ... ]
```

- If jobspec is given, output is restricted to information about that job.
- The  return  status  is  0  unless  an invalid option is encountered or an invalid jobspec is supplied.

#### Options

The first form lists the active jobs.

- `-l` List process IDs in addition to the normal information.
- `-n` Display  information  only  about jobs that have changed status since the user was last notified of their status.
- `-p` List only the process ID of the job's process group leader.
- `-r` Restrict output to running jobs.
- `-s` Restrict output to stopped jobs.
- `-x` Jobs replaces any jobspec found in command or args with the corresponding process group ID, and executes command passing it args, returning its exit status.

### bg

```bash
^z
```

```bash
bg [jobspec ...]
```

- Resume each suspended job jobspec in the background, as if it had been  started  with  &.   If  jobspec  is  not present,  the  shell's  notion  of the current job is used.
- bg jobspec returns 0 unless run when job control is disabled or, when run with job control enabled, any specified jobspec was not found or was started  without  job control.

### fg

```bash
fg [jobspec]
```

- Resume jobspec in the foreground, and make it the current job.  If jobspec is not present, the shell's notion of the current job is used.
- The return value is that of the command placed into the foreground, or failure if  run when  job  control is disabled or, when run with job control enabled, if jobspec does not specify a valid job or jobspec specifies a job that was started without job control.

### disown

```bash
disown [-ar] [-h] [jobspec ...]
```

- Without options, each jobspec is removed from the table of active jobs.
- If jobspec is not present, and  neither -a  nor  -r is supplied, the shell's notion of the current job is used.
- If  no  jobspec is present, and neither the -a nor the -r option is supplied, the current job is used.
- The return value is 0 unless a jobspec does not specify a valid job.

#### Options

- `-h` each jobspec is not removed from the table
    - but is marked so that SIGHUP is not sent to the  job  if  the  shell  receives  a SIGHUP.

If no jobspec is supplied

- `-a` remove or mark all jobs
- `-r` restricts operation to running jobs

### wait

```bash
wait [n ...]
```

- Wait for each specified process and return its termination status.  Each n may be a process ID or a job specification; if a job spec is given, all processes in that job's pipeline are waited for.
- If n  is  not  given,  all currently  active  child processes are waited for, and the return status is zero.
- If n specifies a non-existent process or job, the return status is 127.
- Otherwise, the return status is the exit status of the  last  process or job waited for.
