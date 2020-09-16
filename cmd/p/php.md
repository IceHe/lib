# php

> PHP Command Line Interface

References

* `man php`

## Synopsis

### Run

Run Code

```bash
php [options] -r code [[--] args...]
```

* `--run code`, `-r code` Run PHP code without using script tags '&lt;?..?&gt;'
* Using parameter `-r` you can directly execute PHP code simply as you would do inside a .php file when  using  the `eval()` function.

### Interactive

Run PHP Interactively

```bash
php [options] -a
```

* `--interactive, -a` Run PHP interactively.
  * This lets you enter snippets of PHP code that directly get executed.
  * When read‐line support is enabled you can edit the lines and also have history support.

### Line Processor

Line Process

```bash
php [options] [-B begin_code] -R code [-E end_code] [[--] args...]
php [options] [-B begin_code] -F file [-E end_code] [[--] args...]
```

* `--process-begin code`, `-B begin_code` Run PHP begin\_code before processing input lines
* `--process-code code`, `-R code` Run PHP code for every input line
* `--process-file file`, `-F file` Parse and execute file for every input line
* `--process-end code`, `-E end_code` Run PHP end\_code after processing all input lines

### Http Server

HTTP Server

```bash
php [options] -S addr:port [-t docroot]
```

### Other Options

* `--info, -i` PHP information and configuration
* `--syntax-check, -l` Syntax check only \(lint\)
* `--modules, -m` Show compiled in modules
* `--ini` Show configuration file names

## Usage

### Run

Hello world

```bash
$ php -r 'echo "hello world\n";'
hello world
```

Read file

```bash
# /usr/home/icehe on server 10.2.3.4
$ php -r "echo file_get_contents('./input1');"
abhishek
divyam
chitransh
naveen
harsh
```

### Line Processor

#### Code

```bash
$ cat input1 | php -R 'echo "^".$argn."$\n";'
^abhishek$
^divyam$
^chitransh$
^naveen$
^harsh$
```

With option `-B` & `-E`

```bash
$ cat input1 | php -B 'echo "begin\n";' -R 'echo "^".$argn."$\n";' -E 'echo "end\n";'
begin
^abhishek$
^divyam$
^chitransh$
^naveen$
^harsh$
end
```

#### Code File

```bash
$ cat tmp.php
<?php
echo "^".$argn."$\n";

$ cat input1 | php -F tmp.php
^abhishek$
^divyam$
^chitransh$
^naveen$
^harsh$
```

### Http Server

Server

```bash
# /usr/home/icehe on server 10.2.3.4
$ php -S 0.0.0.0:30233 -t .
PHP 7.1.20 Development Server started at Wed Dec  5 17:54:11 2018
Listening on http://0.0.0.0:30233
Document root is /usr/home/icehe
Press Ctrl-C to quit.
```

Read from server

```bash
$ curl 10.77.120.249:30233/input1
abhishek
divyam
chitransh
naveen
harsh

# Download
$ curl -LO 10.2.3.4:30233/input1
```

### Others

INI

```bash
$ php --ini
Configuration File (php.ini) Path: /etc
Loaded Configuration File:         /etc/php.ini
Scan for additional .ini files in: /etc/php.d
Additional .ini files parsed:      /etc/php.d/bz2.ini,
/etc/php.d/calendar.ini,
/etc/php.d/ctype.ini,
……
```

Modules

```bash
$ php -m
[PHP Modules]
bz2
ctype
……
Zend OPcache
zip
zlib

[Zend Modules]
Zend OPcache
```

Information

```bash
$ php -i
# same as code `phpinfo()`
```

