# Regular Expressions

Manual

- [Wikipedia](https://zh.wikipedia.org/wiki/%E6%AD%A3%E5%88%99%E8%A1%A8%E8%BE%BE%E5%BC%8F)
- [百度百科](https://baike.baidu.com/item/%E6%AD%A3%E5%88%99%E8%A1%A8%E8%BE%BE%E5%BC%8F)

Recommended

- [Regex 101](https://regex101.com/)

## Code Style

Add whitespaces between Chinese & English words ( imperfect )

```bash
([^a-zA-Z0-9`'"_\- \(\),.#\[\]=?{}/*@:])([a-zA-Z0-9`'"_\-\(\),.#\[\]=?{}/*@:]+)([^a-zA-Z0-9`'"_\- \(\),.#\[\]=?{}/*@:])
$1 $2 $3
```

Add a whitespace after comma `,`

```bash
,([^ \n]+)
, $1
```

Replace "" with ''

```bash
"([^"]*)"
'$1'
```

## Refactor

Find function with 7 params

```bash
functionName\(([^,^;]*,\s?){6}([^;^,]*?)\)
```

## Markdown

Heading Level Down

```bash
^##
^#
```

Link Match

```bash
\[([^\]]+)\]\(([^\)]+)\)
# Title : $1
# Link : $2
```

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
