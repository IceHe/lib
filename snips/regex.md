# Regular Expressions ( draft )

Manual

- [Wikipedia EN](https://en.wikipedia.org/wiki/Regular_expression) ( better )
- [Wikipedia ZH](https://zh.wikipedia.org/wiki/%E6%AD%A3%E5%88%99%E8%A1%A8%E8%BE%BE%E5%BC%8F)
- [百度百科](https://baike.baidu.com/item/%E6%AD%A3%E5%88%99%E8%A1%A8%E8%BE%BE%E5%BC%8F)

Online tester & debugger: PHP, PCRE, Python, Golang & JavaScript

- [Regex 101](https://regex101.com/)

## Intro

Since the 1980s, different syntaxes for writing regular expressions exist, one being the **POSIX standard** and another, widely used, being the **Perl syntax**.

> Usage

## CH & EN

Add whitespaces between Chinese & English words ( imperfect )

```bash
([^a-zA-Z0-9`'"_\-\s\(\),\.#\[\]=?{}/*@:])([a-zA-Z0-9`'"_\-\(\),\.#\[\]=?{}/*@:]+)([^a-zA-Z0-9`'"_\-\s\(\),\.#\[\]=?{}/*@:])
$1 $2 $3
```

## Comma

Add a whitespace after comma `,`

```bash
,([^ \n]+)
, $1
```

## Date

Date Range

```bash
([0-9]{4})\s*?[/\-.年]\s*?([0-9]{1,2})\s*?[/\-.月]\s*?([0-9]{1,2})[日]?
# 2020年01月12日 ~ 2020 年 1 月 13 日
```

## HTML Tags

Replace HTML Tag

- Bold

```bash
<b[^>]*>([^<]*)</b>
\*\*$1\*\*
```

- Image

```bash
<img[^>]*src="([^"]*)"[^>]*/>
![]($1)
```

- Link

```bash
<a href="([^"]*)"[^>]*>([^<]*)</a>
[$2]($1)
```

## MD Link

Link Match

```bash
\[([^\]]+)\]\(([^\)]+)\)

# Title : $1
# Link : $2
```

## Params

Find function with 7 params

```bash
functionName\(([^,^;]*,\s?){6}([^;^,]*?)\)
```

## Quote

Replace "" with ''

```bash
"([^"]*)"
'$1'
```

## Square Brackets

```bash
^\[[^\]]*\]
```

```bash
# e.g.
[ERROR]
[WARN]
[INFO]
```

## Exact 2 Spaces Not at the Head of Line

```bash
# original
(?<!^)  (?! )

# improve 1
(?<!^)\s{2}(?! )

# improve 2
(?<!^| )\s{2}(?! )

# improve 3
(?<!^|\s)\s{2}(?!\s)
```

Pattern Match

- **`(pattern)` 匹配获取** Capturing Parenthesis
- **`(?:pattern)` 非匹配获取** Non-Capturing Parenthesis
    - e.g. `(Windows )(?:\d+)`
        - <code><u>Windows </u>98</code> matched
        - <code><u>Windows </u>2000</code> matched
        - `Windows XP` not matched
- **`(?=pattern)` 正向肯定预查** Lookahead Positive Assertions
    - e.g. `Windows (?=98)`
        - <code><u>Windows </u>98</code> matched
        - `Windows XP` not matched
- **`(?!pattern)` 正向否定预查** Lookahead Negative Assertions
    - e.g. `Windows (?!98)`
        - `Windows 98` not matched
        - <code><u>Windows </u>XP</code> matched
- **`(?<=pattern)` 反向肯定预查** Lookbehind Positive Assertions
    - e.g. `(?<=My) Windows`
        - <code>My<u> Windows</u></code> matched
        - `X Windows` not matched
- **`(?<!pattern)` 反向否定预查** Lookbehind Negative Assertions
    - e.g. `(?<!My) Windows`
        - `My Windows` not matched
        - <code>X<u> Windows</u></code> matched
