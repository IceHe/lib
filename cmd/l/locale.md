# locale

> get locale-specific information

References

- locale(1) - Linux manual page : http://man7.org/linux/man-pages/man1/locale.1.html
- 解决 Mac Os X ssh LC_CTYPE 警告问题 : http://data4q.com/2018/01/06/%E8%A7%A3%E5%86%B3mac-os-x-ssh-lc_ctype%E8%AD%A6%E5%91%8A%E9%97%AE%E9%A2%98/

## Quickstart

```bash
export LC_ALL=zh_CN.utf8    # Set locale temporarily
locale                      # Display locale settings
```

## Intro

Synopsis

```bash
locale [option]
locale [option] -a
locale [option] -m
locale [option] name...
```

Description

- The locale command displays information about the current locale, or all locales, on standard output.

## Options

- `-a, --all-locales` Display a list of all available locales.
    - The -v option causes the LC_IDENTIFICATION metadata about each locale to be included in the output.
- `-m, --charmaps` Display the available charmaps (character set description files).
    - To display the current character set for the locale, use locale -c charmap.

## Bash Env Vars

- `LANG` Used to determine the locale category for any category not specifically selected with a variable starting with `LC_`.
- `LC_ALL` This variable overrides the value of LANG and any other LC_ variable specifying a locale category.
- `LC_COLLATE` This  variable  determines the collation order used when sorting the results of pathname expansion, and determines the behavior of range expressions, equivalence classes, and collating sequences within pathname expansion and pattern matching.
- `LC_CTYPE` This variable determines the interpretation of characters and the behavior of character classes within pathname expansion and pattern matching.
- `LC_MESSAGES` This variable determines the locale used to translate double-quoted strings preceded by a \$.
- `LC_NUMERIC` This variable determines the locale category used for number formatting.

## Usage

### Default

When invoked without arguments, locale displays the current locale settings for each locale category, based on the settings of the environment variables that control the locale.

```bash
$ locale
LANG=en_US.UTF-8
LC_CTYPE=UTF-8
LC_NUMERIC="en_US.UTF-8"
LC_TIME="en_US.UTF-8"
LC_COLLATE="en_US.UTF-8"
LC_MONETARY="en_US.UTF-8"
LC_MESSAGES="en_US.UTF-8"
LC_PAPER="en_US.UTF-8"
LC_NAME="en_US.UTF-8"
LC_ADDRESS="en_US.UTF-8"
LC_TELEPHONE="en_US.UTF-8"
LC_MEASUREMENT="en_US.UTF-8"
LC_IDENTIFICATION="en_US.UTF-8"
LC_ALL=
```

#### Setting

```bash
$ export LC_ALL=zh_CN.utf8
$ locale
LANG=zh_CN.utf8
LC_CTYPE="zh_CN.utf8"
LC_NUMERIC="zh_CN.utf8"
LC_TIME="zh_CN.utf8"
LC_COLLATE="zh_CN.utf8"
LC_MONETARY="zh_CN.utf8"
LC_MESSAGES="zh_CN.utf8"
LC_PAPER="zh_CN.utf8"
LC_NAME="zh_CN.utf8"
LC_ADDRESS="zh_CN.utf8"
LC_TELEPHONE="zh_CN.utf8"
LC_MEASUREMENT="zh_CN.utf8"
LC_IDENTIFICATION="zh_CN.utf8"
LC_ALL=zh_CN.utf8
```

### All Locales

```bash
$ locale -a
……
en_AG
en_AG.utf8
en_AU
en_AU.iso88591
en_AU.utf8
en_BW
en_BW.iso88591
en_BW.utf8
en_CA
en_CA.iso88591
en_CA.utf8
en_DK
en_DK.iso88591
en_DK.utf8
en_GB
en_GB.iso88591
en_GB.iso885915
en_GB.utf8
en_HK
en_HK.iso88591
en_HK.utf8
en_IE
en_IE@euro
en_IE.iso88591
en_IE.iso885915@euro
en_IE.utf8
en_IN
en_IN.utf8
en_NG
en_NG.utf8
en_NZ
en_NZ.iso88591
en_NZ.utf8
en_PH
en_PH.iso88591
en_PH.utf8
en_SG
en_SG.iso88591
en_SG.utf8
en_US
en_US.iso88591
en_US.iso885915
en_US.utf8
en_ZA
en_ZA.iso88591
en_ZA.utf8
en_ZW
en_ZW.iso88591
en_ZW.utf8
……
zh_CN
zh_CN.gb18030
zh_CN.gb2312
zh_CN.gbk
zh_CN.utf8
zh_HK
zh_HK.big5hkscs
zh_HK.utf8
zh_SG
zh_SG.gb2312
zh_SG.gbk
zh_SG.utf8
zh_TW
zh_TW.big5
zh_TW.euctw
zh_TW.utf8
zu_ZA
zu_ZA.iso88591
zu_ZA.utf8
```

### All Charmaps

```bash
$ locale -m
……
BIG5
BIG5-HKSCS
……
GB18030
GB2312
GBK
……
ISO-8859-1
ISO-8859-10
ISO-8859-11
ISO-8859-13
ISO-8859-14
ISO-8859-15
ISO-8859-16
ISO-8859-2
ISO-8859-3
ISO-8859-4
ISO-8859-5
ISO-8859-6
ISO-8859-7
ISO-8859-8
ISO-8859-9
ISO-8859-9E
ISO-IR-197
ISO-IR-209
ISO-IR-90
ISO_10367-BOX
ISO_10646
ISO_11548-1
ISO_2033-1983
ISO_5427
ISO_5427-EXT
ISO_5428
ISO_646.BASIC
ISO_646.IRV
ISO_6937
ISO_6937-2-25
ISO_6937-2-ADD
ISO_8859-1,GL
ISO_8859-SUPP
……
LATIN-GREEK
LATIN-GREEK-1
UTF-8
……
```
