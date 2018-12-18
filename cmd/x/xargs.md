# xargs

> build and execute command lines from standard input

## Synopsis

```bash
xargs  [-0prtx]  [-E  eof-str]
    [-e[eof-str]] [--eof[=eof-str]]  [--null]
    [-d  delimiter] [--delimiter delimiter]
    [-I replace-str] [-i[replace-str]]
    [--replace[=replace-str]]
    [-l[max-lines]] [-L max-lines]
    [--max-lines[=max-lines]]
    [-n max-args]   [--max-args=max-args]
    [-s   max-chars]  [--max-chars=max-chars]
    [-P  max-procs]  [--max-procs=max-procs]
    [--process-slot-var=name] [--interactive]
    [--verbose] [--exit]  [--no-run-if-empty]
    [--arg-file=file]  [--show-limits]
    [--version] [--help]
    [command [initial-arguments]]
```

## Options

- `-0, --null` Input items are terminated by a null character instead of by whitespace, and the quotes and  backslash  are  not special  (every character is taken literally).
    - Disables the end of file string, which is treated like any other argument.
    - Useful when input items might contain white space, quote marks, or backslashes.
    - The GNU find -print0 option produces input suitable for this mode.
- `-a file, --arg-file=file` Read  items  from file instead of standard input.
    - If you use this option, stdin remains unchanged when commands are run.
    - Otherwise, stdin is redirected from /dev/null.
- `--delimiter=delim, -d delim` Input items are terminated by the specified character.
    - The specified delimiter may be a single character, a  C- style  character  escape such as \n, or an octal or hexadecimal escape code.
    - Octal and hexadecimal escape codes are understood as for the printf command.
    - Multibyte characters are not supported.
    - When processing the  input, quotes  and  backslash are not special; every character in the input is taken literally.
    - The -d option disables any end-of-file string, which is treated like any other argument.
    - You can use this option when the  input  consists  of  simply  newline-separated  items,  although  it is almost always better to design your program to use --null where this is possible.
- `-E eof-str` Set the end of file string to eof-str.
    - If the end of file string occurs as a line of input, the rest of the input is ignored.
    - If neither -E nor -e is used, no end of file string is used.
- `-e [eof-str], --eof[=eof-str]` This  option is a synonym for the -E option.
    - Use -E instead, because it is POSIX compliant while this option is not.
    - If eof-str is omitted, there is no end of file string.
    - If neither -E nor -e  is  used,  no  end  of  file string is used.
- `-I replace-str` Replace occurrences of replace-str in the initial-arguments with names read from standard input.
    - Also, unquoted blanks do not terminate input items; instead the separator is the newline character.
    - Implies -x and -L 1.
- `-i [replace-str], --replace[=replace-str]` This option is a synonym for -Ireplace-str if replace-str is specified.
    - If the replace-str argument is missing, the effect is the same as -I{}.
    - This option is deprecated; use -I instead.
- `-L max-lines` Use at most max-lines nonblank input lines per command line.
    - Trailing blanks cause an input line to be logically continued on the next input line.
    - Implies -x.
- `-l [max-lines], --max-lines[=max-lines]` Synonym for the -L option.
    - Unlike -L, the max-lines argument is optional.
    - If max-lines is  not  specified,  it defaults to one.
    - The -l option is deprecated since the POSIX standard specifies -L instead.
- `-n max-args, --max-args=max-args` Use  at  most  max-args arguments per command line.
    - Fewer than max-args arguments will be used if the size (see the -s option) is exceeded, unless the -x option is given, in which case xargs will exit.
- `-P max-procs, --max-procs=max-procs` Run up to max-procs processes at a time; the default is 1.
    - If max-procs is 0, xargs will run as many  processes as  possible  at  a  time.
    - Use the -n option or the -L option with -P; otherwise chances are that only one exec will be done.
    - While xargs is running, you can send its process a SIGUSR1 signal to increase the number of  commands  to run simultaneously, or a SIGUSR2 to decrease the number.
    - You cannot decrease it below 1.
    - xargs never terminates its commands; when asked to decrease, it merely waits for more than one existing command to terminate before starting another.
- `-p, --interactive` Prompt  the user about whether to run each command line and read a line from the terminal.
    - Only run the command line if the response starts with `y' or `Y'.
    - Implies -t.
- `--process-slot-var=name` Set the environment variable name to a unique value in each running child process.
    - Values are reused once child processes exit.
    - This can be used in a rudimentary load distribution scheme, for example.
- `-r, --no-run-if-empty` If the standard input does not contain any nonblanks, do not run the command.
    - Normally, the command is run once even if there is no input.
    - This option is a GNU extension.
    - -s max-chars, --max-chars=max-chars Use at most max-chars characters per command line, including the command and initial-arguments and the terminating nulls at the ends of the argument strings.
    - The largest allowed value is system-dependent, and is calculated as the argument length limit for exec, less the size of your environment, less 2048 bytes of headroom.
    - If  this value  is  more  than  128KiB, 128Kib is used as the default value; otherwise, the default value is the maximum.
    - 1KiB is 1024 bytes.
    - xargs automatically adapts to tighter constraints.
- `--show-limits` Display the limits on the command-line length which are imposed by the operating system, xargs' choice of buffer size and the -s option.
    - Pipe the input from /dev/null (and perhaps specify --no-run-if-empty) if you don't want xargs to do anything.
- `-x, --exit` Exit if the size (see the -s option) is exceeded.

## Usage

Sample 1

```bash
$ cat sample1
1
2
3
4
```

### Default

```bash
$ cat sample1 | xargs
# same as
$ xargs -a sample1
1 2 3 4
```
