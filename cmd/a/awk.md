# awk (WIP)

> gawk - pattern scanning and processing language

References

- http://www.runoob.com
    - Command : http://www.runoob.com/linux/linux-comm-awk.html
    - Work Principles : http://www.runoob.com/w3cnote/awk-work-principle.html
    - Built-in Functions : http://www.runoob.com/w3cnote/awk-built-in-functions.html

## Synopsis

```bash
gawk [options] -f program-file [--] file ...
gawk [options] [--] program-text file ...

pgawk [options] -f program-file [--] file ...
pgawk [options] [--] program-text file ...

dgawk [options] -f program-file [--] file ...
```

Gawk is the GNU Project's implementation of the AWK programming language.

- Gawk provides the additional features found in the current version of UNIX `awk` and a number of GNU-specific extensions.

Pgawk is the profiling version of gawk.

- It is identical in every way to gawk, except that programs run more slowly, and it automatically produces an execution profile in the file awkprof.out when done.
- See the `--profile` option.

Dgawk is an awk debugger.

- Instead of running the program directly, it loads the AWK source code and then prompts for debugging commands.
- Unlike gawk and pgawk, dgawk only processes AWK program source provided with the `-f` option.
- The debugger is documented in GAWK: Effective AWK Programming.

### Records

- Normally, records are separated by newline characters.
- You can control how records are separated by assigning values to the built-in variable `RS`.
- If `RS` is any single character, that character separates records.
- Otherwise, `RS` is a regular expression.
- Text in the input that matches this regular expression separates the record.
- However, in compatibility mode, only the first character of its string value is used for separating records.
- If `RS` is set to the null string, then records are separated by blank lines.
- When `RS` is set to the null string, the newline character always acts as a field separator, in addition to whatever value FS may have.

### Fields

- As each input record is read, gawk splits the record into fields, using the value of the `FS` variable as the field sepa rator.
- If `FS` is a single character, fields are separated by that character.
- If `FS` is the null string, then each individual character becomes a separate field.
- Otherwise, `FS` is expected to be a full regular expression.
- In the special case that `FS` is a single space, fields are separated by runs of spaces and/or tabs and/or newlines.
    - (But see the section POSIX COMPATIBILITY, below).
    - NOTE: The value of `IGNORECASE` (see below) also affects how fields are split when `FS` is a regular expression, and how records are separated when `RS` is a regular expression.

## Options

- `-f program-file` `--file program-file` Read the AWK program source from the file program-file, instead of from the first command line argument.
    - Multiple -f (or --file) options may be used.
- **`-F fs` `--field-separator fs` Use fs for the input field separator** (the value of the FS predefined variable).
- `-v var=val` `--assign var=val` Assign the value val to the variable var, before execution of the program begins.
    - Such variable values are available to the BEGIN block of an AWK program.
- ……

## Built-in Variables

- `NF` The number of fields in the current input record.
- `NR` The total number of input records seen so far.
- `FNR` The input record number in the current input file.
- `ARGC` The number of command line arguments (does not include options to gawk, or the program source).
- `ARGV` Array of command line arguments.
    - The array is indexed from 0 to ARGC - 1.
    - Dynamically changing the contents of ARGV can control the files used for data.
- `ARGIND` The index in ARGV of the current file being processed.
- `FILENAME` The name of the current input file.
    - If no files are specified on the command line, the value of FILENAME is “-”.
    - However, FILENAME is undefined inside the BEGIN block (unless set by getline).
- `IGNORECASE` Controls the case-sensitivity of all regular expression and string operations.
    - If IGNORECASE has a non-zero value, then string comparisons and pattern matching in rules, field splitting with FS and FPAT, record separating with RS, regular expression matching with ~ and !~, and the gensub(), gsub(), index(), match(), patsplit(), split(), and sub() built-in functions all ignore case when doing regular expression operations.
    - NOTE: Array subscripting is not affected.
    - However, the asort() and asorti() functions are affected.
    - Thus, if IGNORECASE is not equal to zero, /aB/ matches all of the strings "ab", "aB", "Ab", and "AB".
    - As with all AWK variables, the initial value of IGNORECASE is zero, so all regular expression and string operations are normally case-sensitive.
- `CONVFMT` The conversion format for numbers, "%.6g", by default.
- `ERRNO` If a system error occurs either doing a redirection for getline, during a read for getline, or during a close(), then ERRNO will contain a string describing the error.
    - The value is subject to translation in non-English locales.
- `FIELDWIDTHS` A whitespace separated list of field widths.
    - When set, gawk parses the input into fields of fixed width, instead of using the value of the FS variable as the field separator.
    - See Fields, above.
- `FPAT` A regular expression describing the contents of the fields in a record.
    - When set, gawk parses the input into fields, where the fields match the regular expression, instead of using the value of the FS variable as the field separator.
    - See Fields, above.
- `FS` The input field separator, a space by default.
    - See Fields, above.
- `OFMT` The output format for numbers, "%.6g", by default.
- `OFS` The output field separator, a space by default.
- `ORS` The output record separator, by default a newline.
- `RS` The input record separator, by default a newline.
- `RT` The record terminator.
    - Gawk sets RT to the input text that matched the character or regular expression specified by RS.
- `RSTART` The index of the first character matched by match(); 0 if no match.
    - (This implies that character indices start at one.)
- `RLENGTH` The length of the string matched by match(); -1 if no match.
- `SUBSEP` The character used to separate multiple subscripts in array elements, by default "\034".
- `TEXTDOMAIN` The text domain of the AWK program; used to find the localized translations for the program's strings.
- `BINMODE` On non-POSIX systems, specifies use of “binary” mode for all file I/O.
    - Numeric values of 1, 2, or 3, specify that input files, output files, or all files, respectively, should use binary I/O.
    - String values of "r", or "w" specify that input files, or output files, respectively, should use binary I/O.
    - String values of "rw" or "wr" specify that all files should use binary I/O.
    - Any other string value is treated as "rw", but generates a warning message.
- `PROCINFO` The elements of this array provide access to information about the running AWK program.
    - On some systems, there may be elements in the array, "group1" through "groupn" for some n, which is the number of supplementary groups that the process has.
    - Use the in operator to test for these elements. The following elements are guaranteed to be available:
        - `PROCINFO["egid"]` the value of the getegid(2) system call.
        - `PROCINFO["strftime"]` The default time format string for strftime().
        - `PROCINFO["euid"]` the value of the geteuid(2) system call.
        - `PROCINFO["FS"]` "FS" if field splitting with FS is in effect, "FPAT" if field splitting with FPAT is in effect, or "FIELDWIDTHS" if field splitting with FIELDWIDTHS is in effect.
        - `PROCINFO["gid"]` the value of the getgid(2) system call.
        - `PROCINFO["pgrpid"]` the process group ID of the current process.
        - `PROCINFO["pid"]` the process ID of the current process.
        - `PROCINFO["ppid"]` the parent process ID of the current process.
        - `PROCINFO["uid"]` the value of the getuid(2) system call.
        - `PROCINFO["sorted_in"]` If this element exists in PROCINFO, then its value controls the order in which array elements are traversed in for loops.
        - Supported values are "@ind_str_asc", "@ind_num_asc", "@val_type_asc", "@val_str_asc", "@val_num_asc", "@ind_str_desc", "@ind_num_desc", "@val_type_desc", "@val_str_desc", "@val_num_desc", and "@unsorted".
        - The value can also be the name of any comparison function defined as follows: `function cmp_func(i1, v1, i2, v2)`
        - where i1 and i2 are the indices, and v1 and v2 are the corresponding values of the two elements being compared.
        - It should return a number less than, equal to, or greater than 0, depending on how the elements of the array are to be ordered.
        - `PROCINFO["version"]` the version of gawk.
- `ENVIRON` An array containing the values of the current environment.
    - The array is indexed by the environment variables, each element being the value of that variable (e.g., ENVIRON["HOME"] might be /home/arnold).
    - Changing this array does not affect the environment seen by programs which gawk spawns via redirection or the system() function.

## Scripts Structure

Reference : Work Principles http://www.runoob.com/w3cnote/awk-work-principle.html

```bash
awk 'BEGIN{ commands } pattern{ commands } END{ commands }'
```

## Patterns

### Introduction

```bash
BEGIN
END
BEGINFILE
ENDFILE
/regular expression/
relational expression
pattern && pattern
pattern || pattern
pattern ? pattern : pattern
(pattern)
! pattern
pattern1, pattern2
```

### BEGIN & END

BEGIN and END are two special kinds of patterns which are not tested against the input.

- The action parts of all BEGIN patterns are merged as if all the statements had been written in a single BEGIN block.
- They are executed before any of the  input is read.
- Similarly, all the END blocks are merged, and executed when all the input is exhausted (or when an exit statement is executed).
- BEGIN and END patterns cannot be combined with other  patterns  in  pattern  expressions.
- BEGIN and END patterns cannot have missing action parts.

### Regular Expression

For `/regular expression/` patterns, the associated statement is executed for each input record that matches the regular expression.

- These  generally  test whether certain fields match certain regular expressions.

Regular expressions are the same as those in egrep, and are summarized in section 'Regular Expressions' ( see `man awk` ).

### Logical Operations

The `&&`, `||`, and `!` operators are logical AND, logical OR, and logical NOT, respectively, as in C.

- They do short-circuit evaluation, also as in C, and are used for combining more primitive pattern expressions.
- As  in  most  languages, parentheses may be used to change the order of evaluation.

The `?:` operator is like the same operator in C.

- If the first pattern is true then the pattern used for testing is the second pattern, otherwise it is the third.
- Only one of the second and third patterns is evaluated.

A relational expression may use any of the operators defined below in the section on actions ( see `man awk` ).

### Range

The `pattern1, pattern2` form of an expression is called a range pattern.

- It matches all input records starting with a record that matches pattern1, and continuing until a record that matches pattern2, inclusive.
- It does not combine with any other sort of pattern expression.

## Statements

### Control

```bash
if (condition) statement [ else statement ]

while (condition) statement
do statement while (condition)
for (expr1; expr2; expr3) statement
for (var in array) statement
break
continue

delete array[index]
delete array

exit [ expression ]

{ statements }

switch (expression) {
case value|regex : statement
...
[ default: statement ]
}
```

### I/O

- `close(file [, how])` Close  file,  pipe or co-process.
    - The optional how should only be used when closing one end of a two-way pipe to a co-process.
    - It must be a string value, either "to" or "from".
- `getline` Set $0 from next input record; set NF, NR, FNR.
- `getline <file` Set $0 from next record of file; set NF.
- `getline var` Set var from next input record; set NR, FNR.
- `getline var <file` Set var from next record of file.
- `command | getline [var]` Run command piping the output either into $0 or var, as above.
- `command |& getline [var]` Run command as a co-process piping the output either into $0 or var, as above.
    - Co-processes are a gawk extension.
    - (command can also be a socket. See the subsection Special File Names, below.)
- `next` Stop processing the current input record.
    - The next input record is read and processing starts over with the first pattern in the AWK program.
    - If the end of the input data is reached, the END block(s), if any, are executed.
- `nextfile` Stop processing the current input file.
    - The next input record read comes from the next input file.
    - FILENAME and ARGIND are updated, FNR is reset to 1, and processing starts  over  with  the first  pattern  in the AWK program.
    - If the end of the input data is reached, the END block(s), if any, are executed.
- `print` Print the current record.
    - The output record is terminated with the value of the ORS variable.
- `print expr-list` Print expressions.
    - Each expression is separated by the value of the OFS  variable.
    - The  output record is terminated with the value of the ORS variable.
- `print expr-list >file` Print  expressions  on file.
    - Each expression is separated by the value of the OFS variable.
    - The output record is terminated with the value of the ORS variable.
- `printf fmt, expr-list` Format and print.
    - See The printf Statement, below.
- `printf fmt, expr-list >file` Format and print on file.
- `system(cmd-line)` Execute the command cmd-line, and return the exit status.
    - (This may not  be  available  on  non-POSIX systems.)
- `fflush([file])` Flush any buffers associated with the open output file or pipe file.
    - If file is missing or if it is the null string, then flush all open output files and pipes.

Additional output redirections are allowed for print and printf.

- `print ... >> file` Appends output to the file.
- `print ... | command` Writes on a pipe.
- `print ... |& command` Sends data to a co-process or socket.
    - (See also the subsection Special File Names, below.)

The getline command returns 1 on success, 0 on end of file, and -1 on an error.

- Upon an error, ERRNO contains a string describing the problem.

NOTE: Failure in opening a two-way socket will result in a non-fatal error being returned to the calling function.

- If using a pipe, co-process, or socket to getline, or from print or printf within a loop, you must use close()  to  create new  instances  of  the  command or socket.
- AWK does not automatically close pipes, sockets, or co-processes when they return EOF.

The print Statment

- See in `man awk`

## Functions

### Numeric

### String

### Time

### Others

Bit Manipulations

Type

### User-Defined

## Usage

Sample

```bash
$ cat sample
No Name Mark Remark
01 tom 59 AZ
02 jack 77 XP
03 alex 97 CC
```

### $n : Fields

#### $0 : Record

Whole Record (Line)

```bash
$ awk '{print $0}' sample
No Name Mark Remark
01 tom 59 AZ
02 jack 77 XP
03 alex 97 CC
```

#### $1 : 1st Field

First Field (Column)

```bash
$ awk '{print $1}' sample
No
01
02
03
```

#### $2 : 2nd Field

```bash
$ awk '{print $2}' sample
Name
tom
jack
alex
```

……

#### Custom Seperator

Sample with separator comma `,`

```bash
$ cat sample_comma
No,Name,Mark,Remark
01,tom,59,AZ
02,jack,77,XP
03,alex,97,CC
```

Use Default Separator

```bash
$ awk '{print $2}' sample_comma
# output 4 blank lines




```

Use Custom separator

```bash
$ awk -F, '{print $2}' sample_comma
# same as
$ awk -F , '{print $2}' sample_comma
# same as
$ awk -F',' '{print $2}' sample_comma
# output
Name
tom
jack
alex
```

### String

#### Join

```bash
awk 'BEGIN { x="z"; str="app" x "boy" x "cat"; print str; }'
appzboyzcat
```

```bash
awk '{ str=str $0 } END { print str }' sample
No Name Mark Remark01 tom 59 AZ02 jack 77 XP03 alex 97 CC
```

```bash
$ awk '{ str=str " " $0 } END { print str }' sample
 No Name Mark Remark 01 tom 59 AZ 02 jack 77 XP 03 alex 97 CC

$ awk 'NR == 1 { str = $0 } NR != 1 { str = str " " $0 } END { print str }' sample
No Name Mark Remark 01 tom 59 AZ 02 jack 77 XP 03 alex 97 CC
```

### Built-in Variables

#### Arguments

ARGC, ARGV

```bash
$ awk 'BEGIN {print ARGC, ARGV[0], ARGV[1]}' file
2 awk file
```

& ARGIND

```bash
$ awk '{print ARGC, ARGV[0], ARGV[1], ARGV[2], ARGIND}' sample1 sample2
# ASRGIND == 1 : process 1st file 'sample1'
3 awk sample1 sample2 1
3 awk sample1 sample2 1
3 awk sample1 sample2 1
# ASRGIND == 2 : process 2nd file 'sample2'
3 awk sample1 sample2 2
3 awk sample1 sample2 2
3 awk sample1 sample2 2
```

#### File Name

```bash
$ awk '{print ARGIND, FILENAME}' sample1 sample2
1 sample1
1 sample1
1 sample1
1 sample1
2 sample2
2 sample2
2 sample2
2 sample2
```

#### Line Number

`NR` Number of Record

```bash
$ awk '{print NR, $2}' sample
1 Name
2 tom
3 jack
4 alex
```

`FNR` Number of Record for each File

```bash
$ awk '{print NR, FNR, ARGIND, FILENAME}' sample1 sample2
1 1 1 sample1
2 2 1 sample1
3 3 1 sample1
4 4 1 sample1
5 1 2 sample2
6 2 2 sample2
7 3 2 sample2
8 4 2 sample2
```

#### Field Count

`NF` Number of Field

```bash
$ awk -F '[,7]' '{print NF, $3}' sample_comma
4 Mark
4 59
6
5 9
```

#### Environment Variables

```bash
$ awk 'BEGIN{print ENVIRON["HOME"]; print ENVIRON["PATH"];}'
/root
/usr/local/sbin:/usr/local/rvm/gems/ruby-2.5.1/bin:/usr/local/rvm/gems/ruby-2.5.1@global/bin:/usr/local/rvm/rubies/ruby-2.5.1/bin:/sbin:/bin:/usr/sbin:/usr/bin:/usr/local/bin:/usr/local/rvm/bin:/usr/local/bin:/root/bin
```

#### Proc Info

```bash
$ awk 'BEGIN{print PROCINFO["version"]; print PROCINFO["strftime"]}'
4.0.2
%a %b %e %H:%M:%S %Z %Y
```

### Patterns

#### Compare

```bash
$ awk '$3 > 60 {print $0}' sample
No Name Mark Remark
02 jack 77 XP
03 alex 97 CC
```

#### Record Length

```bash
$ awk 'length>13' sample
No Name Mark Remark

$ awk 'length>12' sample
No Name Mark Remark
02 jack 77 XP
03 alex 97 CC
```

#### Regular Expression

```bash
$ awk '/^[0-9]{2}/' sample
# same as
$ awk '/^[0-9]{2}/ {print $0}' sample
01 tom 59 AZ
02 jack 77 XP
03 alex 97 CC

$ awk '/^[0-9]{2}/' sample | awk '$3 > 60'
02 jack 77 XP
03 alex 97 CC
```

#### Reverse

Regex

```bash
$ awk '!/^[0-9]{2}/' sample
No Name Mark Remark
```

Specified Field

```bash
$ awk '$3 !~ /[0-9]+/' sample
No Name Mark Remark
```

#### Ignore Case

Case Sensitive

```bash
$ awk '/c/' sample
02 jack 77 XP
```

Ignore Case

```bash
$ awk -v IGNORECASE=1 /c/ sample
# same as
$ awk 'BEGIN{IGNORECASE=1} /c/' sample
02 jack 77 XP
03 alex 97 CC
```

#### Range

Range `pattern1, pattern2`

```bash
$ awk '/1/, /3/ {print $0}' sample
01 tom 59 AZ
02 jack 77 XP
03 alex 97 CC
```

OR `pattern1 || pattern2`

```bash
$ awk '/1/ || /3/ {print $0}' sample
01 tom 59 AZ
03 alex 97 CC
```

AND `pattern1 && pattern2`

```bash
awk '/7/ && /9/ {print $0}' sample
03 alex 97 CC
```

NOT `!pattern`

```bash
$ '!/2/ {print $0}' sample
No Name Mark Remark
01 tom 59 AZ
03 alex 97 CC
```

`expression ? pattern1 : pattern2`

```bash
$ awk '1 ? /2/ : /3/ {print $0}' sample
02 jack 77 XP

$ awk '0 ? /2/ : /3/ {print $0}' sample
03 alex 97 CC
```

### Script

```bash
awk -f awk_script input_file
# e.g.
awk -f parser.awk info.log
```

#### Hello World

Sample Hello

```bash
$ cat hello.awk
BEGIN {
    # quote string with " not '
    print "hello, world!"
}
```

Run

```bash
$ awk -f hello.awk
hello, world!
```

#### Total Size of Files

```bash
$ ls -l | awk '{sum += $5} END {print sum}'
178481205
```

#### Fabonacci Sequence

```bash
$ seq 9 | awk 'BEGIN {a=0;b=1;print b;} {for(i=0;i<NF;i++){t=b;b=a+b;a=t;print b;}}'
1
1
2
3
5
8
13
21
34
55
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

## Examples

### Control Statement

`while () {};`

```bash
$ awk 'BEGIN {i=3; while (i--) {print i};}'
2
1
0
```

`do {…} while (…);`

```bash
$ awk 'BEGIN {i=3; do { print i } while(i--);}'
3
2
1
0
```

`if (…) {…} else {…};`

```bash
$ awk 'BEGIN { if (1) { print ARGC } else { print ARGV[0], ARGV[1] } }' sample
2

$ awk 'BEGIN { if (0) { print ARGC } else { print ARGV[0], ARGV[1] } }' sample
awk sample
```
