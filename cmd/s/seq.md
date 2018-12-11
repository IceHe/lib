# seq

> print a sequence of numbers

## Synopsis

```bash
seq [OPTION]... LAST
seq [OPTION]... FIRST LAST
seq [OPTION]... FIRST INCREMENT LAST
```

Print numbers from FIRST to LAST, in steps of INCREMENT.

- If FIRST or INCREMENT is omitted, it defaults to 1.
- That is, an omitted INCREMENT defaults to 1 even when LAST is smaller than FIRST.
- The sequence of numbers ends when the sum of the current number and INCREMENT would become greater than LAST.
- FIRST, INCREMENT, and LAST are interpreted as floating point values.
- INCREMENT is usually positive if FIRST is smaller than LAST, and INCREMENT is usually negative if FIRST is greater than LAST.
- FORMAT must be suitable for printing one argument of type 'double';
    - it defaults to `%.PRECf` if FIRST, INCREMENT, and LAST are all fixed point decimal numbers with maximum precision PREC, and to `%g` otherwise.

## Options

- `-f, --format=FORMAT` use printf style floating-point FORMAT
- `-s, --separator=STRING` use STRING to separate numbers (default: \n)
- `-w, --equal-width` equalize width by padding with leading zeroes

## Usage

### Default

#### to Last

```bash
$ seq 3
1
2
3
```

#### First to Last

```bash
$ seq 4 6
4
5
6
```

#### Increment

```bash
$ seq 1 2 5
1
3
5
```

### Equal Width

```bash
$ seq -w 0 50 100
000
050
100
```

### Seperator

```bash
# whitespace
$ seq -s' ' 3
# same as
$ seq -s\  3
1 2 3

# tab "\t"
$ seq -s"`echo -e '\t'`" 3
# same as
$ seq -s"`echo -e "\t"`" 3
1       2       3
```

### Format

```bash
$ seq -f'%3g' 3
  1
  2
  3

$ seq -f'prefix%03g' 3
prefix001
prefix002
prefix003
```
