# nohup

No HangUP : invoke a utility immune to hangups

---

References

- `man nohup`
- `man bash` then `/disown`

## Quickstart

```bash
# 后台运行
nohup [command] &
# e.g.
nohup docsify serve . &

# 让 Shell 中创建的进程在 Shell 退出之后继续运行
disown
```

**Use `nohup` or `disown` if you want a background process to keep running forever.**

> **The shell exits by default upon receipt of a `SIGHUP`.**
> Before exiting, an interactive shell resends the SIGHUP to all jobs, running or stopped.
>
> _Stopped jobs are sent SIGCONT to ensure that they receive the SIGHUP._
> **To prevent the shell from sending the signal to a particular job,**
> **it should be removed from the jobs table with the `disown` builtin**
> **or marked to not receive SIGHUP using `disown -h`.**

## Synopsis

```bash
nohup [--] utility [arguments]
```

## Description

The nohup utility invokes utility with its arguments and at this time sets the signal `SIGHUP` to be ignored.

- If the standard output is a terminal, the standard output is appended to the file `nohup.out` in the current directory.
- If standard error is a terminal, it is directed to the same place as the standard output.

_Some shells may provide a builtin `nohup` command which is similar or identical to this utility._

## _Environment_

The following variables are utilized by nohup:

- _`HOME` If the output file `nohup.out` cannot be created in the current directory, the nohup utility uses the directory named by `HOME` to create the file._
- _`PATH` Used to locate the requested utility if the name contains no `/` characters._

## _Exit Status_

 _The nohup utility exits with one of the following values:_

- _126 : The utility was found, but could not be invoked._
- _127 : The utility could not be found or an error occurred in nohup._

_Otherwise, the exit status of nohup will be that of utility._

# `disown`

```bash
disown [-ar] [-h] [jobspec ...]
```

Without options, **each jobspec is removed from the table of active jobs.**

- `-h` : each jobspec is not removed from the table, but is marked so that SIGHUP is not sent to the job if the shell receives a SIGHUP.
- If no jobspec is present, and neither the `-a` nor the `-r` option is supplied, the current job is used.
- If no jobspec is supplied, the **`-a` option means to remove or mark all jobs**;
    - the **`-r` option without a jobspec argument restricts operation to running jobs**.
- _The return value is 0 unless a jobspec does not specify a valid job._
