# man

an interface to the on-line reference **manuals**

---

References

- `man man`

## Quickstart

```bash
man command # Format & display the on-line manual pages
man awk     # e.g.
```

## Synopsis

System's manual pager

```bash
man [section] <command_name>
```

## Sections

- 1 : Executable programs or shell commands
- 2 : System calls ( functions provided by the kernel )
- 3 : Library calls ( functions within program libraries )
- 4 : Special files ( usually found in /dev )
- 5 : File formats and conventions. e.g., /etc/passwd
- 6 : _Games_
- 7 : Miscellaneous ( including macro packages and conventions )
    - e.g., man(7), groff(7)
- 8 : System administration commands ( usually only for root )
- 9 : Kernel routines [Non standard]

## Examples

```bash
$ man bash
$ man 1 kill
$ man 2 kill
$ man 3 kill
```