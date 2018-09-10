# kill

> terminate or signal a process

- [Differences between `kill <pid>` & `kill -9 <pid>`](https://unix.stackexchange.com/questions/8916/when-should-i-not-kill-9-a-process)

## Options

## Usage

### Common

```bash
kill <pid>
# aka
kill -s TERM <pid>
# or
kill -s SIGTERM <pid>
# aka
kill -15 <pid>
```

```bash
kill -9 <pid>
# aka
kill -s KILL <pid>
# or
kill -s SIGKILL <pid>
```

### List Signals

```bash
kill -l
# or
kill -L
```