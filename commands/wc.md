# wc

> print newline, word, and byte counts for each file

In short

> word count

Synopsis

```bash
wc [OPTION]... [FILE]...
```

## Options

- `-c, --bytes` print byte counts
- `-m, --chars` print character counts
- **`-l, --lines` print newline counts**
- `-L, --max-line-length` print length of the longest line
- `-w, --words` print word counts

## Usage

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

Lines & …

```bash
$ wc FILE_1
# lines / words / bytes / filename
34 112 893 FILE_1

$ wc -l FILE_1
34 FILE_1

$ wc -l FILE_1 FILE_2
  34 FILE_1
4800 FILE_2
4834 total

$ wc -lm FILE_1 FILE_2
# equals
$ wc -ml FILE_1 FILE_2
# lines / chars
  34   893 FILE_1
4800 52800 FILE_2
4834 53693 total
```



```bash
$ grep 101 FILE_3 | wc -l
35
```
