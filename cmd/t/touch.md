# touch

On Linux

- change file timestamps

On BSD

- change file access and modification times

---

References

- `man touch`

## Synopsis

```bash
touch [-A [-][[hh]mm]SS] [-acfhm] [-r file] [-t [[CC]YY]MMDDhhmm[.SS]] file ...
```

## Options

### Timestamps

- `-a` Change only the access time
- `-m` Change only the modification time
- `--time=WORD` _Change the specified time_.
    - WORD is :
        - access, atime, use : equivalent to `-a WORD` is modify
        - mtime : equivalent to `-m`

### Custom Datetime

- `-d, --date=STRING` Parse STRING and use it instead of current time
- `-t STAMP` Use `[[CC]YY]MMDDhhmm[.ss]` instead of current time
- `-c, --no-create` Do not create any files

DATE STRING

- The `--date=STRING` is a mostly free format human readable date string.
    - such as "Sun, 29 Feb 2004 16:21:42 -0800" or "2004-02-29 16:21:42"
    - or even "next Thursday"!
- A date string may contain items indicating calendar date, time of day, time zone, day of week, relative time, relative date, and numbers.
- An empty string indicates the beginning of the day.
- The date string format is more complex than is easily documented here but is fully described in the info documentation.

### Seldom

- `-f` ~~Ignored on Linux~~
    - On BSD : Attempt to force the update, even if the file permissions do not currently permit it.
- `-h, --no-dereference` Affect each symbolic link instead of any referenced file
    - Useful only on systems that can change the  timestamps of a symlink
- `-r, --reference=FILE` Use this file's times instead of current time

## Usage

### Default

Sample

```bash
$ stat file | tail -4 | head -3
Access: 2018-11-03 20:32:44.294916321 +0800
Modify: 2018-11-03 20:07:06.233962622 +0800
Change: 2018-11-03 20:23:30.279810551 +0800
```

Change Timestamps

```bash
$ touch file

# check
$ stat file | tail -4 | head -3
Access: 2018-11-04 19:49:04.951145517 +0800
Modify: 2018-11-04 19:49:04.951145517 +0800
Change: 2018-11-04 19:49:04.951145517 +0800
```

### Only

Sample

```bash
$ stat file | tail -4 | head -3
Access: 2018-11-04 19:49:04.951145517 +0800
Modify: 2018-11-04 19:49:04.951145517 +0800
Change: 2018-11-04 19:49:04.951145517 +0800
```

**Notice : ctime ( last changed time ) always changes after `touch` !**

#### Modification Time

Change Only Modification Time

```bash
$ touch -m file

# check
$ stat file | tail -4 | head -3
Access: 2018-11-04 19:49:04.951145517 +0800
Modify: 2018-11-04 19:53:12.740878463 +0800
Change: 2018-11-04 19:53:12.740878463 +0800
```

### Only atime

Change Only Access Time

```bash
$ touch -a file

# check
$ stat file | tail -4 | head -3
Access: 2018-11-04 20:00:23.692322764 +0800
Modify: 2018-11-04 19:53:12.740878463 +0800
Change: 2018-11-04 20:00:23.692322764 +0800
```
