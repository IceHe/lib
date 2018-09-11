# ps

> process status

## Options

- `-e` | `-A` Select all processes
- `-f` Do full-format listing
    - This option can be combined with many other UNIX-style options to add additional columns.
    - It also causes the command arguments to be printed.
    - See the `c` option, the format keyword args, and the format keyword comm.

## Usage

```bash
ps -ef
ps aux
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