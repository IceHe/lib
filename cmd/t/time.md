# time

time command execution

---

References

- `man time`

## Synopsis

```bash
time [-lp] utility
```

## Description

The time utility executes and times utility.
After the utility finishes,
time writes the total time elapsed,
the time consumed by system overhead,
and the time used to execute utility
to the standard error stream.
**Times are reported in seconds.**

## Options

- `-l` The contents of the rusage structure are printed.
- `-p` _The output is formatted as specified by IEEE Std 1003.2-1992 (POSIX.2)._

Some shells may provide a builtin time command which is similar or identical to this utility.

## Usage

```bash
time sleep 2
sleep 2  0.00s user 0.00s system 0% cpu 2.014 total
```
