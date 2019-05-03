# cat

> concatenate files and print on the standard output

## Quickstart

```bash
cat file        # Print a file
cat -n file     # With line numbers
cat file1 file2 # Print files
cat             # Copy standard input to standard output
```

## Options

Format

- **`-n, --number` Number all output lines**
- `-b, --number-nonblank` Number nonempty output lines, overrides `-n`
- _`-E, --show-ends` Display $ at end of each line_
- `-s, --squeeze-blank` Suppress repeated empty output lines
- _`-T, --show-tabs` Display TAB characters as ^I_
- _`-v, --show-nonprinting` Use ^ and M-notation, except for LFD & TAB_

Combination

- `-A, --show-all` equivalent to `-vET`
- `-e` equivalent to `-vE`
- `-t` equivalent to `-vT`

## Usage

### Default

```bash
cat <file1> <file2> …

# e.g.
$ cat txt1
haha


hehe
$ cat txt2
foo


bar
$ cat txt1 txt2
haha


hehe
foo


bar
```

### Line Number

```bash
$ cat -n txt1 txt2
     1  haha
     2
     3
     4  hehe
     5  foo
     6
     7
     8  bar
```

### Suppress

Suppress repeated empty output lines

```bash
$ cat -s txt1 txt2
haha

hehe
foo

bar
```

```bash
$ cat -bs txt1 txt2
     1  haha

     2  hehe
     3  foo

     4  bar
```

### Others

Copy standard input to standard output.

```bash
$ cat
icehe
icehe
```
