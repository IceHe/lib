# sed

> stream editor for filtering and transforming text

References

- StackOverflow : https://stackoverflow.com/questions/5410757/delete-lines-in-a-text-file-that-contain-a-specific-string
- http://www.runoob.com/linux/linux-comm-sed.html
- http://www.theunixschool.com/2012/06/sed-25-examples-to-delete-line-or.html

## Synopsis

```bash
sed [OPTION]... {script-only-if-no-other-script} [input-file]...
```

- If no `-e, --expression` or `-f, --file` option is given, then the first non-option argument is taken as the sed script to interpret.
- All remaining arguments are names of input files;
    - if no input files are specified, then the standard input is read.

## Options

- `-n, --quiet, --silent` suppress automatic printing of pattern space
- `-e script, --expression=script` add the script to the commands to be executed
- `-f script-file, --file=script-file` add the contents of script-file to the commands to be executed
- `--follow-symlinks` follow symlinks when processing in place
- **`-i[SUFFIX], --in-place[=SUFFIX]` edit files in place** (makes backup if SUFFIX supplied)
- `-c, --copy` use copy instead of rename when shuffling files in -i mode
- `-b, --binary` does nothing; for compatibility with WIN32/CYGWIN/MSDOS/EMX ( open files in binary mode (CR+LFs are not treated specially))
- `-l N, --line-length=N` specify the desired line-wrap length for the `l' command
- `--posix` disable all GNU extensions.
- `-r, --regexp-extended` use extended regular expressions in the script.
- `-s, --separate` consider files as separate rather than as a single continuous long stream.
- `-u, --unbuffered` load minimal amounts of data from the input files and flush the output buffers more often
- `-z, --null-data` separate lines by NUL characters

## Commands

### Zero-address

TODO: ????

- `: label` Label for `b` and `t` commands.
- `#comment` The comment extends until the next newline (or the end of a -e script fragment).
- `}` The closing bracket of a { } block.

### Zero- or One- address

- `=` Print the current line number.
- `a \text` Append text
    - which has each embedded newline preceded by a backslash.
- `i \text` Insert text
    - which has each embedded newline preceded by a backslash.
- `q [exit-code]` Immediately quit the sed script without processing any more input
    - except that if auto-print is not disabled the current pattern space will be printed.
- `Q [exit-code]` Immediately quit the sed script without processing any more input.
- `r filename` Append text read from filename.
- `R filename` Append a line read from filename.
    - Each invocation of the command reads a line from the file.

### Accept address ranges

- `{` Begin a block of commands (end with a `}`).
- `b label` Branch to label;
    - if label is omitted, branch to end of script.
- `c \text` Replace the selected lines with text,
    - which has each embedded newline preceded by a backslash.
- `d` Delete pattern space. Start next cycle.
- `D` If pattern space contains no newline, start a normal new cycle as if the d command was issued.
    - Otherwise, delete text in the pattern space up to the first newline, and restart cycle with the resultant pattern space, without reading a new line of input.
- `h H` Copy/append pattern space to hold space.
- `g G` Copy/append hold space to pattern space.
- `l` List out the current line in a 'visually unambiguous' form.
- `l width` List out the current line in a 'visually unambiguous' form, breaking it at width characters.
- `n N` Read/append the next line of input into the pattern space.
- `p` Print the current pattern space.
- `P` Print up to the first embedded newline of the current pattern space.
- `s/regexp/replacement/` Attempt to match regexp against the pattern space.
    - If successful, replace that portion matched with replacement.
    - The replacement may contain the special character & to refer to that portion of the pattern space which matched, and the special escapes \1 through \9 to refer to the corresponding matching sub-expressions in the regexp.
- `t label` If a s/// has done a successful substitution since the last input line was read and since the last t or T command, then branch to label; if label is omitted, branch to end of script.
- `T label` If no s/// has done a successful substitution since the last input line was read and since the last t or T command, then branch to label; if label is omitted, branch to end of script.
- `w filename` Write the current pattern space to filename.
- `W filename` Write the first line of the current pattern space to filename.
- `x` Exchange the contents of the hold and pattern spaces.
- `y/source/dest/` Transliterate the characters in the pattern space which appear in source to the corresponding character in dest.

## Addresses

### Count

Count of addresses

- Sed commands can be given with **no addresses**, in which case the command will be executed for **all input lines**;
- with **one address**, in which case the command will only be executed for input lines which match that address;
- or with **two addresses**, in which case the command will be executed for all input lines which **match the inclusive range of lines starting from the first address and continuing to the second address**.

### Range

Three things to note about address ranges:

- the syntax is `addr1,addr2` (i.e., the addresses are separated by a comma);
- the line which `addr1` matched will always be accepted, even if `addr2` selects an earlier line;
- and if `addr2` is a regexp, it will not be tested against the line that `addr1` matched.

After the address (or address-range), and before the command, a `!` may be inserted, which specifies that the command shall only be executed if the address (or address-range) does not match.

### Types

The following address types are supported:

- `number` Match only the specified line number
    - (which increments cumulatively across files, unless the -s option is specified on the command line).
- `first~step` Match every step'th line starting with line first.
    - For example, ``sed -n 1~2p'' will print all the odd-numbered lines in the input stream, and the address 2~5 will match every fifth line, starting with the second.
    - first can be zero; in this case, sed operates as if it were equal to step. (This is an extension.)
- `$` Match the last line.
- `/regexp/` Match lines matching the regular expression regexp.
- `\cregexpc` Match lines matching the regular expression regexp
    - The c may be any character.

### GNU Forms

GNU sed also supports some special 2-address forms:

- `0,addr2` Start out in "matched first address" state, until addr2 is found.
    - This is similar to 1,addr2, except that if addr2 matches the very first line of input the 0,addr2 form will be at the end of its range, whereas the 1,addr2 form will still be at the beginning of its range.
    - This works only when addr2 is a regular expression.
- `addr1,+N` Will match addr1 and the N lines following addr1.
- `addr1,~N` Will match addr1 and the lines following addr1 until the next line whose input line number is a multiple of N.

## Usage

### Addresses

See section ' [Lines - Delete](#Delete) '

### Lines

Sample 1

```bash
$ cat sample1
1
2
3
4
```

#### Delete

All

```bash
$ sed d sample1
# output nothing
```

##### Single

```bash
$ sed 1d sample1
2
3
4

$ sed 2d sample1
1
3
4
```

##### Multiple

```bash
$ sed 1d\;3d sample1
# same as
$ sed '1d;3d' sample1
2
4
```

##### Range

###### `addr1,addr2`

```bash
$ sed 1,2d sample1
3
4

$ sed 2,4d sample1
1

# error
$ sed 0,2d sample1
sed: -e expression #1, char 4: invalid usage of line address 0
```

###### `addr~step`

```bash
$ sed 1~2d sample1
2
4

$ sed 2~2d sample1
1
3
```

###### `$` last line

```bash
$ sed \$d sample1
# same as
$ sed '$d' sample1
1
2
3

$ sed 2,\$d sample1
# same as
$ sed '2,$d' sample1
1
```

###### `/regex/`

```bash
$ sed /^[13]$/d sample1
2
4

$ sed /^[24]$/d sample1
1
3
```

###### `!` reverse

```bash
$ sed 1\!d sample1
# same as
$ sed '1!d' sample1
1

$ sed 2,3\!d sample1
2
3
```

#### Print

```bash
$ sed -n 2,3p sample1
2
3
```

Sample Print

```bash
$ cat sample_print
1app
2app
3cat
4cat
```

```bash
$ sed -n /app/p sample_print
1app
2app
```

#### Replace

```bash
$ sed c\A sample1
A
A
A
A
```

```bash
$ sed 2,3c\B sample1
1
B
4
```

Sample Replace

```bash
$ cat sample_replace
1app
2app
3cat
4cat
```

```bash
$ sed s/cat/AAA/g sample_replace
1app
2app
3AAA
4AAA
```

#### Insert

```bash
$ sed i\insert_line sample1
insert_line
1
insert_line
2
insert_line
3
insert_line
4
```

#### Append

```bash
$ sed a\append_line sample1
1
append_line
2
append_line
3
append_line
4
append_line
```

#### Number

Sample 2

```bash
$ cat sample2
No Name Mark Remark
01 tom 59 AZ
02 jack 77 XP
03 alex 97 CC
```

```bash
$ sed = sample2
1
No Name Mark Remark
2
01 tom 59 AZ
3
02 jack 77 XP
4
03 alex 97 CC
```

### File

#### Append

```bash
$ sed r words numbers salaries
# same as
$ sed R words numbers salaries
abhishek
divyam
chitransh
50
39
15
manager  5000
director 4000
employee 6000
```

#### Edit in Place

```bash
```

### Combination

```bash
```
