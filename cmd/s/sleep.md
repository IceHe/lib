# sleep

> delay for a specified amount of time

## Synopsis

```bash
sleep NUMBER[SUFFIX]...
```

### NUMBER

- Pause for NUMBER seconds (default).
- NUMBER may be
    - an **integer**
    - an arbitrary **floating point** number

Given two or more arguments!

- Pause for the amount of time specified by the sum of their values.

### SUFFIX

- `s` for seconds (the default)
- `m` for minutes
- `h` for hours
- `d` for days.

## Usage

```bash
# 1 second
sleep 1

# 0.1 second
sleep 0.2
## equal
sleep 0.2s

# 3 minuete
sleep 3m

# 4 hour
sleep 4h

# 5 day
sleep 5d

# sumation
sleep 1d 2h 3m 4s
```
