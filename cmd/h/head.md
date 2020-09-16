# head

> output the first part of files

References

- `man head`

Sysnopsis

```bash
head [OPTION]... [FILE]...
```

## Quickstart

```bash
head file       # Print top 10 lines in file
head -25 file   # Print top 25 lines in file
head -n -5 file # Print all but last 5 lines
```

## Options

### Amount

- `-n, --lines=[-]K` Print the first K lines instead of the first 10;
    - with the leading '-' ( e.g. `-n -5K` ), print all but the last K lines of each file
- `-c, --bytes=[-]K` Print the first K bytes of each file;
    - with the leading '-' ( e.g. `-n -7K` ), print all but the last K bytes of each file

K may have a multiplier suffix:

- b : 512
- kB : 1000
- K : 1024
- MB : 1000\*1000
- M : 1024\*1024
- GB : 1000\*1000\*1000
- G : 1024\*1024\*1024
- and so on for T, P, E, Z, Y.

### Print

- `-q, --quiet, --silent` Never print headers giving file names
- `-v, --verbose` Always print headers giving file names

## Usage

### Default

Print 10 lines

```bash
$ head LICENSE
                    GNU GENERAL PUBLIC LICENSE
                       Version 3, 29 June 2007

 Copyright (C) 2007 Free Software Foundation, Inc. <http://fsf.org/>
 Everyone is permitted to copy and distribute verbatim copies
 of this license document, but changing it is not allowed.

                            Preamble

  The GNU General Public License is a free, copyleft license for
```

### Common

Print 1st line

```bash
$ head -1 index.html
<!DOCTYPE html>
```

Print top 12 lines

```bash
$ head -12 index.html
<!DOCTYPE html>

<!-- Entry to docsify : https://docsify.js.org -->

<html lang="en">
<head>

  <title>IceHe Lib</title>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="description" content="IceHe's Library">
```

### All But Last

Print print all but the last 36 lines

```bash
$ head -n -36 for.sh
#!/bin/bash

function do_pressure_test {
    echo seq \$1=$1
```

### Verbose

Print first line of files **verbosely**

```bash
$ head -1v script.sh temp.txt
==> script.sh <==
#!/bin/bash

==> temp.txt <==
haha
```
