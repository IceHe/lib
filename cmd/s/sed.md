# sed

> stream editor for filtering and transforming text

References

- StackOverflow : https://stackoverflow.com/questions/5410757/delete-lines-in-a-text-file-that-contain-a-specific-string
- Basic : http://www.runoob.com/linux/linux-comm-sed.html
- Advanced : http://www.theunixschool.com/2012/06/sed-25-examples-to-delete-line-or.html

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

## Space

`sed` has a **hold space** and a **pattern space**.

- We have to distinguish between them before concentrating on that specific command!

Related Advanced Commands

- `n N` Read/append the next line of input into the pattern space.
- `h H` Copy/append pattern space to hold space.
- `g G` Copy/append hold space to pattern space.
- `x` Exchange the contents of the hold and pattern spaces.
- ……

Reference : https://unix.stackexchange.com/questions/233014/how-does-the-command-sed-1ghd-reverse-the-contents-of-a-file

### Pattern Space

- When `sed` reads a new line, it is loaded into the pattern space.
- Therefore, that space is **overwritten every time a new line is processed**.

### Hold Space

- The hold space is **consistent over the whole processing** and values can be stored there for later usage.

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

#### Next Line

Do something in the next line

```bash
$ sed '/^2$/{n; s/3/C/;}' sample1
1
2
C
4
```

#### Quit

Print until 2nd line & Quit

```bash
$ sed 2q sample1
1
2
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

#### Read

Append sample2 content to the line of smaple1 that matched regex '/3/'

```bash
$ sed '/3/r sample2' sample1
1
2
3
No Name Mark Remark
 1 tom 59 AZ
 2 jack 77 XP
 3 alex 97 CC
4
```

#### Write

Write sample1 content matched regex '/3/' to file 'output_file'

```bash
$ sed '/3/w output_file' sample1
No Name Mark Remark
01 tom 59 AZ
02 jack 77 XP
03 alex 97 CC

# check
$ cat output_file
03 alex 97 CC
```

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
$ sed -i.bak 's/^0/ /g' sample2

# check
$ cat sample2
No Name Mark Remark
 1 tom 59 AZ
 2 jack 77 XP
 3 alex 97 CC

$ cat sample2.bak
No Name Mark Remark
01 tom 59 AZ
02 jack 77 XP
03 alex 97 CC
```

### Combination

#### Normal

`-e` add the script to the commands to be executed

```bash
$ sed -e '1d;4d' -e 's/7/0/g' sample2
01 tom 59 AZ
02 jack 00 XP
```

#### Reverse Contents

```bash
sed '1!G;h;$!d' <file>

# e.g.
$ seq 4 | sed '1!G;h;$!d'
4
3
2
1
```

#### 九九乘法表

```bash
$ seq 9 | sed 'H;g' | awk -v RS='' '{for(i=1;i<=NF;i++)printf("%dx%d=%d%s", i, NR, i*NR, i==NR?"\n":"\t")}'
1x1=1
1x2=2   2x2=4
1x3=3   2x3=6   3x3=9
1x4=4   2x4=8   3x4=12  4x4=16
1x5=5   2x5=10  3x5=15  4x5=20  5x5=25
1x6=6   2x6=12  3x6=18  4x6=24  5x6=30  6x6=36
1x7=7   2x7=14  3x7=21  4x7=28  5x7=35  6x7=42  7x7=49
1x8=8   2x8=16  3x8=24  4x8=32  5x8=40  6x8=48  7x8=56  8x8=64
1x9=9   2x9=18  3x9=27  4x9=36  5x9=45  6x9=54  7x9=63  8x9=72  9x9=81
```
