# killall

> kill processes by name

## Usage

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

## Options

- `-u <username>` Limit potentially matching processes to those belonging to the specified user
- `-w` | `--wait` Wait for all killed processes to die
    - Note that killall may wait forever if the signal was ignored, had no effect, or if the process stays in zombie state.
