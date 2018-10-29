# head

> output the first part of files

Sysnopsis

```bash
head [OPTION]... [FILE]...
```

## Options

### Amount

- `-n, --lines=[-]K` Print the first K lines instead of the first 10; with the leading '-', print all but the last K  lines  of  each file
- `-c, --bytes=[-]K` Print the first K bytes of each file; with the leading '-', print all but the last K bytes of each file

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

Print 10 lines ( Default )

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

Print 1st line

```bash
$ head -1 README.md
<!DOCTYPE html>
```

Print top 20 lines

```bash
$ head -20 index.html
<!DOCTYPE html>

<!-- Entry to docsify : https://docsify.js.org -->

<html lang="en">
<head>

  <title>IceHe Lib</title>

  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="description" content="Weibo Video Platform Docs">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

  <!-- Favicon : https://en.wikipedia.org/wiki/Favicon -->
  <!-- <link rel="shortcut icon" type="image/x-icon" href="_docsify/weibo-favicon.ico" /> -->
  <link rel="shortcut icon" type="image/x-icon" href="https://cdn.icehe.xyz/_docsify/h-favicon.ico" />

  <!-- Font Awesome : https://fontawesome.com/how-to-use/on-the-web/setup/getting-started?using=web-fonts-with-css -->
  <!-- <link rel="stylesheet" href="https://cdn.icehe.xyz/_docsify/resources/__use.fontawesome.com_releases_v5.1.0_css_all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous"> -->
```

Print first line of files **verbosely**

```bash
$ head -1v script.sh temp.txt
==> script.sh <==
#!/bin/bash

==> temp.txt <==
haha
```
