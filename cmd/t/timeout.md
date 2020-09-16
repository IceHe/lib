# timeout

> run a command with a time limit

References

* `man timeout`

## Synopsis

```bash
timeout [OPTION] DURATION COMMAND [ARG]...
timeout [OPTION]
```

Start COMMAND, and kill it if still running after DURATION.

## Options

* `--preserve-status` exit with the same status as COMMAND, even when the command times out
* `--foreground` when not running timeout directly from a shell prompt, allow COMMAND to read from the TTY and get TTY signals
  * in this mode, children of COMMAND will not be timed out
* `-k, --kill-after=DURATION` also send a KILL signal if COMMAND is still running this long after the initial signal was sent
* `-s, --signal=SIGNAL` specify the signal to be sent on timeout
  * SIGNAL may be a name like 'HUP' or a number
  * see `kill -l` for a list of signals

## Duration

DURATION is a floating point number with an optional suffix:

* `s` seconds \( **default** \)
* `m` minutes
* `h` hours
* `d` days

## Usage

```bash
timeout <duration> <comand>

# e.g.
# Kill the process if it has not finished in 2 seconds.
timeout 2s cat info.log
```

