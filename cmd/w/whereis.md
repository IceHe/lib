# whereis

> locate the binary, source, and manual page files for a command

## Options

- `-b` Search only for binaries
- `-m` Search only for manuals
- `-s` Search only for sources
- `-l` Output list of effective lookup paths the `whereis` is using

## Usage

Locate commands

```bash
whereis <command_name>...

# e.g.
$ whereis java bash
java: /usr/bin/java /usr/lib/java /etc/java /usr/share/java /usr/share/man/man1/java.1
bash: /usr/bin/bash /usr/share/man/man1/bash.1.gz
```

Show lookup paths

```bash
$ whereis -l java
bin: /usr/bin
bin: /usr/sbin
bin: /usr/lib
bin: /usr/lib64
bin: /etc
bin: /usr/etc
bin: /usr/games
bin: /usr/local/bin
bin: /usr/local/sbin
bin: /usr/local/etc
bin: /usr/local/lib
bin: /usr/local/games
bin: /usr/include
bin: /usr/local
bin: /usr/libexec
bin: /usr/share
man: /usr/man/man8
man: /usr/share/man/man2x
man: /usr/share/man/ca
man: /usr/share/man/ko
man: /usr/share/man/zh_TW
man: /usr/share/man/pt_PT
man: /usr/share/man/sv
man: /usr/share/man/mann
man: /usr/share/man/man9
man: /usr/share/man/zh
man: /usr/share/man/man5
man: /usr/share/man/en
man: /usr/share/man/es
man: /usr/share/man/man3x
man: /usr/share/man/man1
man: /usr/share/man/man6
man: /usr/share/man/nl
man: /usr/share/man/man4x
man: /usr/share/man/pt
man: /usr/share/man/man1x
man: /usr/share/man/overrides
man: /usr/share/man/uk
man: /usr/share/man/ru
man: /usr/share/man/cs
man: /usr/share/man/fr
man: /usr/share/man/hu
man: /usr/share/man/man3p
man: /usr/share/man/man2
man: /usr/share/man/man6x
man: /usr/share/man/man7
man: /usr/share/man/hr
man: /usr/share/man/man5x
man: /usr/share/man/de
man: /usr/share/man/man0p
man: /usr/share/man/man8
man: /usr/share/man/ro
man: /usr/share/man/ja
man: /usr/share/man/it
man: /usr/share/man/pl
man: /usr/share/man/man7x
man: /usr/share/man/da
man: /usr/share/man/id
man: /usr/share/man/zh_CN
man: /usr/share/man/man4
man: /usr/share/man/tr
man: /usr/share/man/man3
man: /usr/share/man/pt_BR
man: /usr/share/man/man1p
man: /usr/share/man/man9x
man: /usr/share/man/sk
man: /usr/share/man/man8x
src: /usr/src/debug
src: /usr/src/kernels
java: /usr/bin/java /usr/lib/java /etc/java /usr/share/java /usr/share/man/man1/java.1
```