# awk

> gawk - pattern scanning and processing language

References

- http://www.runoob.com
    - Command : http://www.runoob.com/linux/linux-comm-awk.html
    - Work Principles : http://www.runoob.com/w3cnote/awk-work-principle.html
    - Built-in Functions : http://www.runoob.com/w3cnote/awk-built-in-functions.html

## Synopsis

```bash
gawk [options] -f program-file [ -- ] file ...
gawk [options] [ -- ] program-text file ...

pgawk [options] -f program-file [ -- ] file ...
pgawk [options] [ -- ] program-text file ...

dgawk [options] -f program-file [ -- ] file ...
```

Gawk  is  the  GNU Project's implementation of the AWK programming language.

- Gawk provides the additional features found in the current version of UNIX `awk` and a number of GNU-specific extensions.

Pgawk  is  the  profiling version of gawk.

- It is identical in every way to gawk, except that programs run more slowly, and it automatically produces an execution profile in the file awkprof.out when done.
-  See the --profile option, below.

Dgawk is an awk debugger.

- Instead of running the program directly, it loads the AWK source code and  then  prompts  for debugging  commands.
- Unlike gawk and pgawk, dgawk only processes AWK program source provided with the -f option.
- The debugger is documented in GAWK: Effective AWK Programming.

## Options

- `-f program-file` `--file program-file` Read the AWK program source from the file program-file, instead of from the first command line argument.
    - Multiple -f (or --file) options may be used.
- **`-F fs` `--field-separator fs` Use fs for the input field separator** (the value of the FS predefined variable).
- `-v var=val` `--assign var=val` Assign  the  value  val  to  the variable var, before execution of the program begins.
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
    - If IGNORECASE  has  a  non-zero value, then string comparisons and pattern matching in rules, field splitting with FS and FPAT, record separating with RS, regular expression matching with ~ and !~, and the gensub(), gsub(), index(),  match(), patsplit(), split(), and sub() built-in functions all ignore case when doing regular expression operations.
    - NOTE: Array subscripting is not affected.
    - However, the asort() and asorti() functions are affected.
    - Thus, if IGNORECASE is not equal to zero, /aB/ matches all of the strings "ab", "aB", "Ab", and  "AB".
    - As with all AWK variables, the initial value of IGNORECASE is zero, so all regular expression and string operations are normally case-sensitive.
- `CONVFMT` The conversion format for numbers, "%.6g", by default.
- `ERRNO` If a system error occurs either doing a redirection for getline, during a read for  getline,  or  during  a close(),  then  ERRNO  will  contain a string describing the error.
    - The value is subject to translation in non-English locales.
- `FIELDWIDTHS` A whitespace separated list of field widths.
    - When set, gawk parses the input into fields of fixed  width, instead of using the value of the FS variable as the field separator.
    - See Fields, above.
- `FPAT` A regular expression describing the contents of the fields in a record.
    - When set, gawk  parses  the  input into  fields,  where the fields match the regular expression, instead of using the value of the FS variable as the field separator.
    - See Fields, above.
- `FS` The input field separator, a space by default.
    - See Fields, above.
- `OFMT` The output format for numbers, "%.6g", by default.
- `OFS` The output field separator, a space by default.
- `ORS` The output record separator, by default a newline.
- `RS` The input record separator, by default a newline.
- `RT` The record terminator.
    - Gawk sets RT to the input text that matched the  character  or  regular  expression specified by RS.
- `RSTART` The  index  of the first character matched by match(); 0 if no match.
    - (This implies that character indices start at one.)
- `RLENGTH` The length of the string matched by match(); -1 if no match.
- `SUBSEP` The character used to separate multiple subscripts in array elements, by default "\034".
- `TEXTDOMAIN` The text domain of the AWK program; used to find the localized translations for the program's strings.
- `BINMODE` On non-POSIX systems, specifies use of “binary” mode for all file I/O.
    - Numeric values of 1, 2, or 3, specify that input files, output files, or all files, respectively, should use binary I/O.
    - String  values  of "r",  or "w" specify that input files, or output files, respectively, should use binary I/O.
    - String values of "rw" or "wr" specify that all files should use binary I/O.
    - Any other string value is treated as "rw", but generates a warning message.
- `PROCINFO` The elements of this array provide access to information about the running AWK program.
    - On  some  systems, there may be elements in the array, "group1" through "groupn" for some n, which is the number of supplementary groups that the process has.
    - Use the in operator to test for these elements.  The following  elements are guaranteed to be available:
        - `PROCINFO["egid"]` the value of the getegid(2) system call.
        - `PROCINFO["strftime"]` The default time format string for strftime().
        - `PROCINFO["euid"]` the value of the geteuid(2) system call.
        - `PROCINFO["FS"]` "FS" if field splitting with FS is in effect, "FPAT" if field splitting with FPAT is in effect, or "FIELDWIDTHS" if field splitting with FIELDWIDTHS is in effect.
        - `PROCINFO["gid"]` the value of the getgid(2) system call.
        - `PROCINFO["pgrpid"]` the process group ID of the current process.
        - `PROCINFO["pid"]` the process ID of the current process.
        - `PROCINFO["ppid"]` the parent process ID of the current process.
        - `PROCINFO["uid"]` the value of the getuid(2) system call.
        - `PROCINFO["sorted_in"]` If this element exists in PROCINFO, then its value controls the order  in  which  array elements   are   traversed   in   for  loops.   Supported  values  are  "@ind_str_asc", "@ind_num_asc",  "@val_type_asc",  "@val_str_asc",   "@val_num_asc",   "@ind_str_desc", "@ind_num_desc",  "@val_type_desc",  "@val_str_desc", "@val_num_desc", and "@unsorted".
            - The value can also be the name of any comparison function defined as follows: `function cmp_func(i1, v1, i2, v2)`
        - where i1 and i2 are the indices, and v1 and v2 are the corresponding values of the two elements being  compared.
        - It should return a number less than, equal to, or greater than 0, depending on how the elements of the array are to be ordered.
        - `PROCINFO["version"]` the version of gawk.
- `ENVIRON` An array containing the values of the current environment.
    - The array is indexed by the environment variables, each element being the value of that variable (e.g., ENVIRON["HOME"] might be /home/arnold).
    - Changing this array does not affect the environment seen by programs which gawk spawns via redirection or the system() function.

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

### Pattern

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
$ awk 'BEGIN{IGNORECASE=1} /c/' sample
02 jack 77 XP
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
