# ag

The Silver Searcher. Like `ack`, but faster.

---

References

- `man ag`

## Synopsis

```bash
ag [options] pattern [path ...]
```

## Description

Recursively search for PATTERN in PATH. Like grep or `ack`, but faster.

## Options

**`-a --all-types`**

**Search all files. This doesn't include hidden files**, and doesn't respect any ignore files.

**`--hidden`**

**Search hidden files.** This option obeys ignored files.

**`-t --all-text`**

**Search all text files. This doesn't include hidden files.**

**`-u --unrestricted`**

**Search all files. This ignores `.ignore`, `.gitignore`, etc. It searches binary and hidden files as well.**

**`-v --invert-match`**

**Match every line not containing the specified pattern.**

**`-A --after [LINES]`**

**Print lines after match.** If not provided, LINES defaults to 2.

**`-B --before [LINES]`**

**Print lines before match.** If not provided, LINES defaults to 2.

**`-C --context [LINES]`**

**Print lines before and after matches.** Default is 2.

**`-Q --literal`**

**Do not parse PATTERN as a regular expression. Try to match it literally.**

**`-s --case-sensitive`**

**Match case-sensitively.**

**`-S --smart-case`**

**Match case-sensitively if there are any uppercase letters in PATTERN, case-insensitively otherwise.** Enabled by default.

**`-c --count`**

**Only print the number of matches in each file.**

Note: This is the number of matches, not the number of matching lines.
Pipe output to `wc -l` if you want the number of matching lines.

**`--pager COMMAND`**

**Use a pager such as less.**
Use --nopager to override.
This option is also ignored if output is piped to another program.

`--column`

Print column numbers in results.

_`--ackmate`_

_Output results in a format parseable by AckMate https://github.com/protocool/AckMate ._

_`--[no]affinity`_

_Set thread affinity (if platform supports it). Default is true._

_`--[no]break`_

_Print a newline between matches in different files. Enabled by default._

_`--[no]color`_

_Print color codes in results. Enabled by default._

_`--color-line-number`_

_Color codes for line numbers. Default is 1;33._

_`--color-match`_

_Color codes for result match numbers. Default is 30;43._

_--color-path_

_Color codes for path names. Default is 1;32._

_`-D --debug`_

_Output ridiculous amounts of debugging info._
_Not useful unless you're actually debugging._

**`--depth NUM`**

**Search up to NUM directories deep, -1 for unlimited.** Default is 25.

_`--[no]filename`_

_Print file names. Enabled by default, except when searching a single file._

`-f --[no]follow`_

_Follow symlinks. Default is false._

_`-F --fixed-strings`_

_Alias for `--literal` for compatibility with grep._

_--[no]group_

_The default, `--group`, lumps multiple matches in the same file together,_
_and presents them under a single occurrence of the filename._
_`--nogroup` refrains from this, and instead places the filename at the start of each match line._

**`-g PATTERN`**

**Print filenames matching PATTERN.**

`-G --file-search-regex PATTERN`

Only search files whose names match PATTERN.

_`-H --[no]heading`_

_Print filenames above matching contents._

**`--ignore PATTERN`**

**Ignore files/directories whose names match this pattern.**
Literal file and directory names are also allowed.

_`--ignore-dir NAME`_

_Alias for `--ignore` for compatibility with ack._

_`-i --ignore-case`_

_Match case-insensitively._

`-l --files-with-matches`

Only print the names of files containing matches, not the matching lines.
An empty query will print all files that would be searched.

**`-L --files-without-matches`**

**Only print the names of files that don't contain matches.**

`--list-file-types`

See FILE TYPES below.

**`-m --max-count NUM`**

**Skip the rest of a file after NUM matches.** Default is 0, which never skips.

_`--[no]mmap`_

_Toggle use of memory-mapped I/O. Defaults to true on platforms where mmap() is faster than read(). (All but macOS.)_

_`--[no]multiline`_

_Match regexes across newlines. Enabled by default._

_`-n --norecurse`_

_Don't recurse into directories._

_`--[no]numbers`_

_Print line numbers. Default is to omit line numbers when searching streams._

_`-o --only-matching`_

_Print only the matching part of the lines._

_`--one-device`_

_When recursing directories, don't scan dirs that reside on other storage devices._
_This lets you avoid scanning slow network mounts._
_This feature is not supported on all platforms._

_`-p --path-to-ignore STRING`_

_Provide a path to a specific .ignore file._

_`--parallel`_

_Parse the input stream as a search term, not data to search._
_This is meant to be used with tools such as GNU parallel._
_For example: `echo "foo\nbar\nbaz" | parallel "ag {} ."` will run 3 instances of ag,_
_searching the current directory for "foo", "bar", and "baz"._

_`--print-long-lines`_

_Print matches on very long lines (> 2k characters by default)._

_`--passthrough --passthru`_

_When searching a stream, print all lines even if they don't match._

_`-r --recurse`_

_Recurse into directories when searching. Default is true._

_`--search-binary`_

_Search binary files for matches._

_`--silent`_

_Suppress all log messages, including errors._

_`--stats`_

_Print stats (files scanned, time taken, etc)._

_`--stats-only`_

_Print stats (files scanned, time taken, etc) and nothing else._

_`-U --skip-vcs-ignores`_

_Ignore VCS ignore files (.gitignore, .hgignore), but still use .ignore._

_`-V --version`_

_Print version info._

_`--vimgrep`_

_Output results in the same form as Vim's :vimgrep /pattern/g_

_Here is a ~/.vimrc configuration example: `set grepprg=ag\ --vimgrep\ $* set grepformat=%f:%l:%c:%m`_

_Then use `:grep` to grep for something._
_Then use `:copen`, `:cn`, `:cp`, etc. to navigate through the matches._

**`-w --word-regexp`**

**Only match whole words.**

_`--workers NUM`_

_Use NUM worker threads. Default is the number of CPU cores, with a max of 8._

_`-z --search-zip`_

Search contents of compressed files.
Currently, gz and xz are supported.
This option requires that ag is built with lzma and zlib.

_`-0 --null --print0`_

_Separate the filenames with `\0`, rather than `\n`: this allows `xargs -0 <command>` to correctly process filenames containing spaces or newlines._

## File Types

It is possible to restrict the types of files searched.
For example, passing `--html` will search only files with the extensions htm, html, shtml or xhtml.
For a list of supported types, run `ag --list-file-types`.

```bash
$ ag --list-file-types
The following file types are supported:
  --actionscript
      .as  .mxml

  --ada
      .ada  .adb  .ads

  --asciidoc
      .adoc  .ad  .asc  .asciidoc

  --apl
      .apl

  --asm
      .asm  .s

  --batch
      .bat  .cmd

  --bitbake
      .bb  .bbappend  .bbclass  .inc

  --bro
      .bro  .bif

  --cc
      .c  .h  .xs

  --cfmx
      .cfc  .cfm  .cfml

  --chpl
      .chpl

  --clojure
      .clj  .cljs  .cljc  .cljx

  --coffee
      .coffee  .cjsx

  --coq
      .coq  .g  .v

  --cpp
      .cpp  .cc  .C  .cxx  .m  .hpp  .hh  .h  .H  .hxx  .tpp

  --crystal
      .cr  .ecr

  --csharp
      .cs

  --css
      .css

  --cython
      .pyx  .pxd  .pxi

  --delphi
      .pas  .int  .dfm  .nfm  .dof  .dpk  .dpr  .dproj  .groupproj  .bdsgroup  .bdsproj

  --dlang
      .d  .di

  --dot
      .dot  .gv

  --dts
      .dts  .dtsi

  --ebuild
      .ebuild  .eclass

  --elisp
      .el

  --elixir
      .ex  .eex  .exs

  --elm
      .elm

  --erlang
      .erl  .hrl

  --factor
      .factor

  --fortran
      .f  .f77  .f90  .f95  .f03  .for  .ftn  .fpp

  --fsharp
      .fs  .fsi  .fsx

  --gettext
      .po  .pot  .mo

  --glsl
      .vert  .tesc  .tese  .geom  .frag  .comp

  --go
      .go

  --groovy
      .groovy  .gtmpl  .gpp  .grunit  .gradle

  --haml
      .haml

  --handlebars
      .hbs

  --haskell
      .hs  .hsig  .lhs

  --haxe
      .hx

  --hh
      .h

  --html
      .htm  .html  .shtml  .xhtml

  --idris
      .idr  .ipkg  .lidr

  --ini
      .ini

  --ipython
      .ipynb

  --isabelle
      .thy

  --j
      .ijs

  --jade
      .jade

  --java
      .java  .properties

  --jinja2
      .j2

  --js
      .es6  .js  .jsx  .vue

  --json
      .json

  --jsp
      .jsp  .jspx  .jhtm  .jhtml  .jspf  .tag  .tagf

  --julia
      .jl

  --kotlin
      .kt

  --less
      .less

  --liquid
      .liquid

  --lisp
      .lisp  .lsp

  --log
      .log

  --lua
      .lua

  --m4
      .m4

  --make
      .Makefiles  .mk  .mak

  --mako
      .mako

  --markdown
      .markdown  .mdown  .mdwn  .mkdn  .mkd  .md

  --mason
      .mas  .mhtml  .mpl  .mtxt

  --matlab
      .m

  --mathematica
      .m  .wl

  --md
      .markdown  .mdown  .mdwn  .mkdn  .mkd  .md

  --mercury
      .m  .moo

  --naccess
      .asa  .rsa

  --nim
      .nim

  --nix
      .nix

  --objc
      .m  .h

  --objcpp
      .mm  .h

  --ocaml
      .ml  .mli  .mll  .mly

  --octave
      .m

  --org
      .org

  --parrot
      .pir  .pasm  .pmc  .ops  .pod  .pg  .tg

  --pdb
      .pdb

  --perl
      .pl  .pm  .pm6  .pod  .t

  --php
      .php  .phpt  .php3  .php4  .php5  .phtml

  --pike
      .pike  .pmod

  --plist
      .plist

  --plone
      .pt  .cpt  .metadata  .cpy  .py  .xml  .zcml

  --proto
      .proto

  --pug
      .pug

  --puppet
      .pp

  --python
      .py

  --qml
      .qml

  --racket
      .rkt  .ss  .scm

  --rake
      .Rakefile

  --restructuredtext
      .rst

  --rs
      .rs

  --r
      .r  .R  .Rmd  .Rnw  .Rtex  .Rrst

  --rdoc
      .rdoc

  --ruby
      .rb  .rhtml  .rjs  .rxml  .erb  .rake  .spec

  --rust
      .rs

  --salt
      .sls

  --sass
      .sass  .scss

  --scala
      .scala

  --scheme
      .scm  .ss

  --shell
      .sh  .bash  .csh  .tcsh  .ksh  .zsh  .fish

  --smalltalk
      .st

  --sml
      .sml  .fun  .mlb  .sig

  --sql
      .sql  .ctl

  --stata
      .do  .ado

  --stylus
      .styl

  --swift
      .swift

  --tcl
      .tcl  .itcl  .itk

  --terraform
      .tf  .tfvars

  --tex
      .tex  .cls  .sty

  --thrift
      .thrift

  --tla
      .tla

  --tt
      .tt  .tt2  .ttml

  --toml
      .toml

  --ts
      .ts  .tsx

  --twig
      .twig

  --vala
      .vala  .vapi

  --vb
      .bas  .cls  .frm  .ctl  .vb  .resx

  --velocity
      .vm  .vtl  .vsl

  --verilog
      .v  .vh  .sv

  --vhdl
      .vhd  .vhdl

  --vim
      .vim

  --wix
      .wxi  .wxs

  --wsdl
      .wsdl

  --wadl
      .wadl

  --xml
      .xml  .dtd  .xsl  .xslt  .ent  .tld  .plist

  --yaml
      .yaml  .yml

```

## Ignoring Files

**By default, `ag` will ignore files whose names match patterns in `.gitignore`, `.hgignore`, or `.ignore`.**
These files can be anywhere in the directories being searched.
Binary files are ignored  by  default  as  well.
**Finally, `ag` looks in `$HOME/.agignore` for ignore patterns.**

_If you want to ignore `.gitignore` and `.hgignore`, but still take `.ignore` into account, use `-U`._

Use the `-t` option to search all text files;
`-a` to search all files;
and `-u` to search all, including hidden files.

```bash
$ ag -a -Q '*.iml'
# output nothing

$ ag -u -Q '*.iml'
xyz-icehe-admin/.gitignore
7:*.iml

xyz-icehe-storage/.gitignore
7:*.iml

.gitignore
7:*.iml

$ ag -u *.iml
.idea/modules.xml
5:      <module fileurl="file://$PROJECT_DIR$/xyz-icehe-admin.iml" filepath="$PROJECT_DIR$/xyz-icehe-admin.iml" />

```

## Usages

`ag printf`: Find matches for "printf" in the current directory.

`ag foo /bar/`: Find matches for "foo" in path /bar/.

`ag -- --foo`: Find matches for "--foo" in the current directory.
( **As with most UNIX command line utilities, "--" is used to signify that the remaining arguments should not be treated as options.** )
