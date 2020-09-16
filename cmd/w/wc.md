# wc

> print newline, word, and byte counts for each file

In short

> **word count**

References

- `man wc`

## Options

- `-c, --bytes` print byte counts
- `-m, --chars` print character counts
- **`-l, --lines` print newline counts**
- `-L, --max-line-length` print length of the longest line
- `-w, --words` print word counts

## Usage

Lines & …

```bash
$ wc file_1
# lines / words / bytes / filename
34 112 893 file_1

$ wc -l file_1
34 file_1

$ wc -l file_1 file_2
  34 file_1
4800 file_2
4834 total

$ wc -lm file_1 file_2
# equals
$ wc -ml file_1 file_2
# lines / chars
  34   893 file_1
4800 52800 file_2
4834 53693 total
```

Combination

```bash
$ grep 101 file_3 | wc -l
35
```

Bytes & Chars

```bash
$ echo 何冰 | wc -c
7

$ echo 何冰 | wc -m
3

$ echo 123 | wc -c
4

$ echo 123 | wc -m
4
```
