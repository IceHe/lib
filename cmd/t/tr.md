# tr

> translate or delete characters

Synopsis

```bash
tr [OPTION]... SET1 [SET2]
```

Translate, squeeze, and/or delete characters from standard input, writing to standard output.

## Options

- `-c, -C, --complement` use the complement of SET1
- `-d, --delete` delete characters in SET1, do not translate
- `-s, --squeeze-repeats` replace each input sequence of a repeated character that is listed in SET1 with a single occurrence of that character
- `-t, --truncate-set1` first truncate SET1 to length of SET2

## SETs

SETs are specified as strings of characters.

Most represent themselves. Interpreted sequences are:

- `\NNN` character with octal value NNN (1 to 3 octal digits)
- `\\` backslash
- `\b` backspace
- `\n` new line
- `\r` return
- `\t` horizontal tab
- `CHAR1-CHAR2` all characters from CHAR1 to CHAR2 in ascending order
- `[CHAR*]` in SET2, copies of CHAR until length of SET1
- `[CHAR*REPEAT]` REPEAT copies of CHAR, REPEAT octal if starting with 0
- `[:alnum:]` all letters and digits
- `[:alpha:]` all letters
- `[:blank:]` all horizontal whitespace
- `[:cntrl:]` all control characters
- `[:digit:]` all digits
- `[:graph:]` all printable characters, not including space
- `[:lower:]` all lower case letters
- `[:print:]` all printable characters, including space
- `[:punct:]` all punctuation characters
- `[:space:]` all horizontal or vertical whitespace
- `[:upper:]` all upper case letters
- `[:xdigit:]` all hexadecimal digits
- `[=CHAR=]` all characters which are equivalent to CHAR

## Usage

### Lower Case to Upper

```bash
$ tr [:lower:] [:upper:]
abc
ABC
```

```bash
$ tr AC ac
ABC
aBc

$ tr A-C a-c
ABCDE
abcDE
```

### Replace Delimiter

#### Common

```bash
$ echo "This is for testing." | tr [:space:] '\t'
This    is      for     testing.
```

#### Squeeze Repeats

```bash
$ echo "This  is  for  testing." | tr [:space:] '\t'
This            is              for             testing.

# Squeeze Repeats
$ echo "This  is  for  testing." | tr -s [:space:] '\t'
This    is      for     testing.
```

#### Join Lines

Join all lines into a single one

```bash
tr -s '\n' ' '
# e.g.
tr -s '\n' ' ' < input > output
```

### Delete Chars

```bash
$ echo "what the fuck" | tr -d 'hu'
wat te fck
```

```bash
$ echo "abc 123" | tr -d [:digit:]
# or
$ echo "abc 123" | tr -d '1-3'
abc
```

#### Complement

Remove all charactors except the specified ones

```bash
$ echo "abc 123" | tr -cd [:digit:]
123
```

#### Non-printable Chars

Notice : Non-printable chars inlucde `\n`

```bash
tr -cd [:print:]
# e.g.
tr -cd [:print:] < input > output
```
