# Regular Expressions (draft)

Manual

- [Wikipedia EN](https://en.wikipedia.org/wiki/Regular_expression) ( better )
- [Wikipedia ZH](https://zh.wikipedia.org/wiki/%E6%AD%A3%E5%88%99%E8%A1%A8%E8%BE%BE%E5%BC%8F)
- [百度百科](https://baike.baidu.com/item/%E6%AD%A3%E5%88%99%E8%A1%A8%E8%BE%BE%E5%BC%8F)

Online tester & debugger: PHP, PCRE, Python, Golang & JavaScript

- [Regex 101](https://regex101.com/)

## Intro

Since the 1980s, different syntaxes for writing regular expressions exist, one being the **POSIX standard** and another, widely used, being the **Perl syntax**.

## Usage

### CH & EN

Add whitespaces between Chinese & English words ( imperfect )

```bash
([^a-zA-Z0-9`'"_\- \(\),.#\[\]=?{}/*@:])([a-zA-Z0-9`'"_\-\(\),.#\[\]=?{}/*@:]+)([^a-zA-Z0-9`'"_\- \(\),.#\[\]=?{}/*@:])
$1 $2 $3
```

### Comma

Add a whitespace after comma `,`

```bash
,([^ \n]+)
, $1
```

### Date

Date Range

```bash
([0-9]{4})\s*?[/\-.年]\s*?([0-9]{1,2})\s*?[/\-.月]\s*?([0-9]{1,2})[日]?
# 2020年01月12日 ~ 2020 年 1 月 13 日
```

### HTML Tags

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

### MD Link

Link Match

```bash
\[([^\]]+)\]\(([^\)]+)\)

# Title : $1
# Link : $2
```

### Params

Find function with 7 params

```bash
functionName\(([^,^;]*,\s?){6}([^;^,]*?)\)
```

### Quote

Replace "" with ''

```bash
"([^"]*)"
'$1'
```

### Square Brackets

```bash
^\[[^\]]*\]
```

```bash
# e.g.
[ERROR]
[WARN]
[INFO]
```
