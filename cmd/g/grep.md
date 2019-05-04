# grep

> grep, egrep, fgrep - print lines matching a pattern

## Quickstart

```bash
# Regular Expression
egrep pattern file      # Use extended syntaxes
grep -E pattern file
grep -e pattern file    # Use basic syntaxes
# e.g.
egrep "^#" /etc/hosts

# Common
grep -v pattern file    # Invert match
grep --invert-match pattern file
grep -i pattern file    # Ignore case
grep --ignore-case pattern file
grep -n pattern file    # Print with line numbers
grep --line-number pattern file
grep -c pattern file    # Count of matching lines
grep --count pattern file

# Context
grep -A NUM pattern file    # Print n lines after matching lines
grep --after-context=n pattern file
grep -B NUM pattern file    # Print n lines before matching lines
grep --before-context=n pattern file
grep -C NUM pattern file    # Print n lines before & after …
grep -NUM pattern file      # e.g. grep -2 abc file
grep --context=NUM pattern file
```

## Synopsis

grep

```bash
grep [OPTIONS] PATTERN [FILE...]
grep [OPTIONS] [-e PATTERN | -f FILE] [FILE...]
```

egrep

```bash
egrep
# same as
grep -E
```

fgrep

- _cannot understand its usage temporarily_

```bash
fgrep
# same as
grep -F
```

## Options

### Matcher Selection

Interpret PATTERN as :

- **`-E, --extended-regexp`** an **extended regular expression** (ERE)
- `-F, --fixed-strings, --fixed-regexp` a list of **fixed strings**
    - separated by newlines, any of which is to be matched.
    - ~~`--fixed-regexp`~~ is an obsoleted alias, please do not use it in new scripts.
- `-G, --basic-regexp` a **basic regular expression** (BRE)
    - This is **the default**.
- `-P, --perl-regexp` a **Perl regular expression**
    - This is highly experimental and grep `-P` may warn of unimplemented features.

### Matching Control

- **`-e PATTERN, --regexp=PATTERN` Use PATTERN as the pattern**.
    - This can be used to specify multiple search patterns, or to protect a pattern beginning with a hyphen (-).
- `-f FILE, --file=FILE` Obtain patterns from FILE, one per line.
    - The empty file contains zero patterns, and therefore matches nothing.
- **`-i, --ignore-case` Ignore case distinctions** in both the PATTERN and the input files.
- **`-v, --invert-match` Invert the sense of matching**, to select non-matching lines.
- `-w, --word-regexp` Select only those lines containing matches that form whole words.
    - The test is that the matching substring must either be at the beginning of the line, or preceded by a non-word constituent character.
    - Similarly, it must be either at the end of the line or followed by a non-word constituent character.
    - Word-constituent characters are letters, digits, and the underscore.
- `-x, --line-regexp` Select only those matches that exactly match the whole line.

### General Output Control

- **`-c, --count`** Suppress normal output; instead print **a count of matching lines** for each input file.
    - With the `-v, --invert-match option`, count non-matching lines.
- `-L, --files-without-match` Suppress normal output; instead print the name of each input file from which no output would normally have been printed.
    - The scanning will stop on the first match.
- **`-l, --files-with-matches`** Suppress normal output; instead print **the name of each input file** from which output would normally have been printed.
    - The scanning will stop on the first match.
- `-m NUM, --max-count=NUM` Stop reading a file after NUM matching lines.
    - If the input is standard input from a regular file, and NUM matching lines are output, grep ensures that the standard input is positioned to just after the last matching line before exiting, regardless of the presence of trailing context lines.
    - This enables a calling process to resume a search.
    - When grep stops after NUM matching lines, it outputs any trailing context lines.
    - When the -c or --count option is also used, grep does not output a count greater than NUM.
    - When the -v or --invert-match option is also used, grep stops after outputting NUM non-matching lines.
- `-o, --only-matching` Print only the matched (non-empty) parts of a matching line, with each such part on a separate output line.
- `-q, --quiet, --silent` Quiet; do not write anything to standard output.
    - Exit immediately with zero status if any match is found, even if an error was detected.
- `-s, --no-messages` Suppress error messages about nonexistent or unreadable files.
    - Portability note: unlike GNU grep, 7th Edition Unix grep did not conform to POSIX, because it lacked -q and its -s option behaved like GNU grep\'s -q option.
    - USG-style grep also lacked -q but its -s option behaved like GNU grep.
    - Portable shell scripts should avoid both -q and -s and should redirect standard and error output to /dev/null instead.

### Output Line Prefix Control

- `-H, --with-filename` Print the file name for each match.
    - This is the default when there is more than one file to search.
- `-h, --no-filename` Suppress the prefixing of file names on output.
    - This is the default when there is only one file (or only standard input) to search.
- `--label=LABEL` Display input actually coming from standard input as input coming from file LABEL.
    - This is especially useful when implementing tools like zgrep
    - e.g., `gzip -cd foo.gz | grep --label=foo -H` something.
- **`-n, --line-number`** Prefix each line of output **with the 1-based line number** within its input file.
- `-T, --initial-tab` Make sure that the first character of actual line content lies on a tab stop, so that the alignment of tabs looks normal.
    - This is useful with options that prefix their output to the actual content: -H,-n, and -b.
    - In order to improve the probability that lines from a single file will all start at the same column, this also causes the line number and byte offset (if present) to be printed in a minimum size field width.
- ……

### Context Line Control

- **`-A NUM, --after-context=NUM` Print NUM lines of trailing context after matching lines**.
    - Places a line containing a group separator (described under --group-separator) between contiguous groups of matches.
    - With the -o or --only-matching option, this has no effect and a warning is given.
- **`-B NUM, --before-context=NUM` Print NUM lines of leading context before matching lines**.
    - Places a line containing a group separator (described under --group-separator) between contiguous groups of matches.
    - With the -o or --only-matching option, this has no effect and a warning is given.
- **`-C NUM, -NUM, --context=NUM` Print NUM lines of output context**.
    - Places a line containing a group separator (described under --group-separator) between contiguous groups of matches.
    - With the -o or --only-matching option, this has no effect and a warning is given.
- `--group-separator=SEP` Use SEP as a group separator.
    - By default SEP is double hyphen (--).
- `--no-group-separator` Use empty string as a group separator.

### File & Directory Selection

- `-D ACTION, --devices=ACTION` If an input file is a device, FIFO or socket, use ACTION to process it.
    - By default, ACTION is read, which means that devices are read just as if they were ordinary files.
    - **If ACTION is skip, devices are silently skipped**.
- `-d ACTION, --directories=ACTION` **If an input file is a directory, use ACTION to process it**.
    - By default, ACTION is **read**, i.e., read directories just as if they were ordinary files.
    - If ACTION is **skip**, silently skip directories.
    - If ACTION is **recurse**, read all files under each directory, recursively, following symbolic links only if they are on the command line. This is equivalent to the -r option.
- `--exclude-from=FILE` Skip files whose base name matches any of the file-name globs read from FILE (using wildcard matching as described under --exclude).
- `--exclude-dir=DIR` Exclude directories matching the pattern DIR from recursive searches.
- `--include=GLOB` Search only files whose base name matches [GLOB](https://en.wikipedia.org/wiki/Glob_(programming)) (using wildcard matching as described under --exclude).
- **`-r, --recursive` Read all files under each directory, recursively**, following symbolic links only if they are on the command line.
    - This is equivalent to the `-d recurse` option.
- **`-R, --dereference-recursive`** Read all files under each directory, recursively.
    - **Follow all symbolic links**, unlike -r.

## Usage

Sample

```bash
$ cat input
abhishek
divyam
chitransh
naveen
harsh
```

### Default

```bash
$ grep h input
abhishek
chitransh
harsh
```

### Count

```bash
$ grep h input -c
3
```

### Line Number

```bash
$ grep h input -n
1:abhishek
3:chitransh
5:harsh
```

### Invert Match

```bash
$ grep h input -v
divyam
naveen
```

### Context

#### After

```bash
$ grep t input -A 1
chitransh
naveen
```

#### Before

```bash
grep t input -B 1
divyam
chitransh
```

#### Before & After

```bash
$ grep t input -C 1
divyam
chitransh
naveen
```

### Recursive

Follow all symbolic links ( Recommended )

```bash
grep <content> <file/directory> -R
```

Follow symbolic links only if they are on the command line

```bash
grep <content> <file/directory> -r
```

### Regular Expression

`egrep` = `grep -E`

```bash
$ egrep '.*sh$' input
# same as
$ grep -E '.*sh$' input
chitransh
harsh
```

```bash
$ egrep '.*sh' input
abhishek
chitransh
harsh
```

```bash
$ egrep '[n|h]a.*' input
naveen
harsh
```

```bash
$ egrep '(abh|chi).*' input
abhishek
chitransh
```

## Regular Expression

grep understands three different versions of regular expression syntax:

- basic
- extended
- perl

Implementsations

- In **GNU grep, there is no difference** in available functionality **between basic & extended syntaxes**.
- In other implementations, basic regular expressions are less powerful.
    - Differences for basic regular expressions are summarized afterwards.
    - Perl regular expressions give additional functionality, and are documented in pcresyntax(3) and pcrepattern(3), but may not be available on every system.

Basic vs Extended Regular Expressions

- In basic regular expressions the meta-characters `? + { | ( )` lose their special meaning; instead use the backslashed versions `\? \+ \{ \| \( \)`.
- Traditional egrep did not support the `{` meta-character, and some egrep implementations support `\{` instead, so portable scripts should avoid `{` in grep -E patterns and should use `[{]` to match a literal `{`.
- GNU grep -E attempts to support traditional usage by assuming that `{` is not special if it would be the start of an invalid interval specification.
    - For example, the command grep `-E '{1'` searches for the two-character string `{1` instead of reporting a syntax error in the regular expression.
    - POSIX allows this behavior as an extension, but portable scripts should avoid it.
