# locale

> get locale-specific information

References

- locale(1) - Linux manual page : http://man7.org/linux/man-pages/man1/locale.1.html

## Bash Env Vars

- `LANG` Used to determine the locale category for any category not specifically selected with a variable starting with `LC_`.
- `LC_ALL` This variable overrides the value of LANG and any other LC_ variable specifying a locale category.
- `LC_COLLATE` This  variable  determines the collation order used when sorting the results of pathname expansion, and determines the behavior of range expressions, equivalence classes, and collating sequences within pathname expansion and pattern matching.
- `LC_CTYPE` This variable determines the interpretation of characters and the behavior of character classes within pathname expansion and pattern matching.
- `LC_MESSAGES` This variable determines the locale used to translate double-quoted strings preceded by a \$.
- `LC_NUMERIC` This variable determines the locale category used for number formatting.

## Options

## Usage

```bash
$ locale
locale: Cannot set LC_CTYPE to default locale: No such file or directory
locale: Cannot set LC_ALL to default locale: No such file or directory
LANG=en_US.UTF-8
LC_CTYPE=UTF-8
LC_NUMERIC="en_US.UTF-8"
LC_TIME="en_US.UTF-8"
LC_COLLATE="en_US.UTF-8"
LC_MONETARY="en_US.UTF-8"
LC_MESSAGES="en_US.UTF-8"
LC_PAPER="en_US.UTF-8"
LC_NAME="en_US.UTF-8"
LC_ADDRESS="en_US.UTF-8"
LC_TELEPHONE="en_US.UTF-8"
LC_MEASUREMENT="en_US.UTF-8"
LC_IDENTIFICATION="en_US.UTF-8"
LC_ALL=
```
