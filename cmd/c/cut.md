# cut

> remove sections from each line of files

References

* `man cut`

## Quickstart

```bash
cut -f 1,3 -d ':' --output-delimiter=', ' file
# -f 1,3    : Show fields of column 1 & 3
# -d ':'    : Split by ':' (delimiter)
# --output-delimiter ', ' : Use ', ' as field delimiter

# e.g.
sed 's/#.*//' /etc/group | cut -f 2-3 -d ':' --output-delimiter=', '
# -f 2-3    : Show fields from column 2 to 3 (range)
sed 's/#.*//' /etc/group | cut -f 1-2,4 -d ':' --output-delimiter=', '
# -f 2-3,4  : Show fields from column 1 to 2 and of column 4 (multiple ranges)
```

## Synopsis

```bash
cut OPTION... [FILE]...
```

With no FILE, or when FILE is -, read standard input.

## Options

Split

* `-b, --bytes=LIST` Select only these bytes
  * `-n` With `-b`: Don't split multibyte characters
* `-c, --characters=LIST` Select only these characters
* `-f, --fields=LIST` Select only these fields; also print any line that contains no delimiter character, unless the -s option is specified
  * `-d, --delimiter=DELIM` Use DELIM instead of TAB for field delimiter
* `--complement` Complement the set of selected bytes, characters or fields

Output

* `--output-delimiter=STRING` use STRING as the output delimiter the default is to use the input delimiter
* `-s, --only-delimited` Do not print lines not containing delimiters

LIST

* Use one, and only one of `-b`, `-c` or `-f`.
* Each LIST is made up of one range, or many ranges separated by commas.
* Selected input is written in the same order that it is read, and is written exactly once.

Each range is one of:

* `N` N'th byte, character or field, counted from 1
* `N-` From N'th byte, character or field, to end of line
* `N-M` From N'th to M'th \(included\) byte, character or field
* `-M` From first to M'th \(included\) byte, character or field

## Usage

### Delimiter

Default delimiter : TAB

* Option `=d' '` : Set DELIMITER to WHITE\_SPACE below

### Fields

Sample

```bash
$ cat sample
No Name Mark Remark
01 tom 59 AZ
02 jack 77 XP
03 alex 97 CC
```

#### Single

```bash
$ cut -f 1 -d' ' sample
No
01
02
03
```

#### Multi

```bash
$ cut -f 2,4 -d' ' sample
Name Remark
tom AZ
jack XP
alex CC
```

#### Range

**-M**

From first to M

```bash
$ cut -f -2 -d' ' sample
# or
$ cut -f-2 -d' ' sample
# or
$ cut -f'-2' -d' ' sample

No Name
01 tom
02 jack
03 alex
```

**N-**

From N to last

```bash
$ cut -f 3- -d' ' sample
# or
$ cut -f3- -d' ' sample
# or
$ cut -f'3-' -d' ' sample

Mark Remark
59 AZ
77 XP
97 CC
```

**N-M**

From N to M

```bash
$ cut -f 2-3 -d' ' sample
# or
$ cut -f2-3 -d' ' sample
# or
$ cut -f'2-3' -d' ' sample

Name Mark
tom 59
jack 77
alex 97
```

#### Inverse Selection

```bash
$ cut -f 2 --complement -d' ' sample
# exclude column 2
No Mark Remark
01 59 AZ
02 77 XP
03 97 CC
```

### Char

```bash
$ cut -c 4 sample
N
t
j
a
```

### Bytes

Sample 2

```bash
$ cat sample2
No Name Mark Remark
01 何冰 59 AZ
02 字节 77 XP
03 数量 97 CC
```

Default

```bash
$ cut -b 2 sample2
o
1
2
3
```

#### Multibyte Char

Notice : something wrong!

```bash
$ cut -b 4 sample2
N
```

Option `-b` with `-n` : Don't split multibyte characters

```bash
$ cut -b4 -n sample2
N
何
字
数
```

### Output

#### Custom Delimiter

```bash
$ cut -f1- -d' ' --output-delimiter=';' sample
No;Name;Mark;Remark
01;tom;59;AZ
02;jack;77;XP
03;alex;97;CC
```

#### Filter

Sample 3

```bash
$ cat sample3
No Name Mark Remark
01 何冰 59 AZ
02 字节 77 XP
03 数量 97 CC
04空隙11JK
```

Do not print lines not containing delimiters

```bash
$ cut -f1- -d' ' -s sample3
No Name Mark Remark
01 何冰 59 AZ
02 字节 77 XP
03 数量 97 CC
```

