# awk

> gawk - pattern scanning and processing language

References

- http://www.runoob.com
    - Command : http://www.runoob.com/linux/linux-comm-awk.html
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

## Usage
