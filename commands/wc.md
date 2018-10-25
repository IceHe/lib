# wc

> print newline, word, and byte counts for each file

In short

> word count

Synopsis

```bash
wc [OPTION]... [FILE]...
```

## Options

- `-c, --bytes` print the byte counts
- `-m, --chars` print the character counts
- **`-l, --lines` print the newline counts**
- `-L, --max-line-length` print the length of the longest line
- `-w, --words` print the word counts

## Usage

```bash
$ echo 何冰 | wc -m
3

$ echo 何冰 | wc -c
7

$ echo 123 | wc -m
4

$ echo 123 | wc -c
4

$ wc -l README.md
217 FILE_NAME

$ wc -l README.md index.html
217 README.md
208 index.html
425 total

$ grep 'README' README.md | wc -l
18
```
