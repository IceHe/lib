# URL Encoding

a method to encode arbitrary data in a Uniform Resource Identifier (URI) using only the limited US-ASCII characters legal within a URI

---

References

- **[关于URL编码 - 阮一峰](http://www.ruanyifeng.com/blog/2010/02/url_encoding.html)**
- [Percent Encoding - Wikipedia](https://en.wikipedia.org/wiki/Percent-encoding)
- [百分号编码 - 维基百科](https://zh.wikipedia.org/wiki/%E7%99%BE%E5%88%86%E5%8F%B7%E7%BC%96%E7%A0%81)

## Intro

**Percent-encoding**, also known as **URL encoding**, is **a method to encode arbitrary data in a Uniform Resource Identifier (URI) using only the limited US-ASCII characters legal within a URI.**

_Although it is known as URL encoding, it is also used more generally within the main Uniform Resource Identifier (URI) set, which includes both Uniform Resource Locator (URL) and Uniform Resource Name (URN)._
As such, it is also used in the preparation of data of the **`application/x-www-form-urlencoded`** media type, as is often used in the submission of HTML form data in HTTP requests.

## In URI

Types of URI characters

- **reserved** : characters that sometimes have special meaning
- **unreserved** : characters have no such meanings

_RFC 3986 section 2.2_ **Reserved** Characters _(January 2005)_

```bash
! # $ & ' ( ) * + , / : ; = ? @ [ ]
```

_RFC 3986 section 2.3_ **Unreserved** Characters _(January 2005)_

```text
A B C D E F G H I J K L M N O P Q R S T U V W X Y Z
a b c d e f g h i j k l m n o p q r s t u v w x y z
0 1 2 3 4 5 6 7 8 9 - _ . ~
```

Other characters in a URI must be percent encoded.

---

Common characters after percent-encoding (ASCII or UTF-8 based)

- `!` %21
- `#` %23
- `$` %24
- `&` %26
- `'` %27
- `(` %28
- `)` %29
- `*` %2A
- `+` %2B
- `,` %2C
- `/` %2F
- `:` %3A
- `;` %3B
- `=` %3D
- `?` %3F
- `@` %40
- `[` %5B
- `]` %5D

## Scene

- URL 传参时，可能由于参数编码的问题，服务器无法正确解析参数的内容
    - 特别是自行使用字符串操作拼接 URL 时
        - 忘记对参数做 url-encode
        - 或者做了多重的 url-encoded
            - 例如有封装好的 URL 拼接函数，它内置对参数的自动 url-encode
            - 但是调用该工具函数前，你已经对参数进行了一次 url-encode，导致参数被多重编码
    - 甚至 URL 除了参数部分之外，也有编码问题

## Usage

Prepare Testing

- Open **Chrome** Browser
- Press `⌥ ⌘ j` to open `View -> Developer -> JavaScript Console`
- Run code as follow

### Examples

Chinese characters

```javascript
# Unicode
> escape("百分号编码")
"%u767E%u5206%u53F7%u7F16%u7801"

# UTF-8
> encodeURI("icehe.xyz@qq.com")
'icehe.xyz@qq.com'
> encodeURIComponent("icehe.xyz@qq.com")
'icehe.xyz%40qq.com'
```

URL with Chinese characters

```url
https://zh.wikipedia.org/wiki/%E7%99%BE%E5%88%86%E5%8F%B7%E7%BC%96%E7%A0%81
# decoded
https://zh.wikipedia.org/wiki/百分号编码
```

如上 `%E7%99%BE` 中的 `E7 99 BE` 是汉字 `百` 的 `UTF-8` 编码值

- 现在 URL 中包含的汉字，通常都是 UTF-8 编码
    - 当然有可能是其它的编码，例如 GB2312（与浏览器等有关），服务器需要注意解析方式

### ~~escape~~

Deprecated method!

### encodeURL

**对 URL 整体进行编码**

不会对以下字符（保留字符）进行编码

- `0-9a-zA-Z` 字母数字
- `~!@#$&*()-_=+;:',./?`

```javascript
> encodeURI("~!@#$&*()-_=+;:',./?")
"~!@#$&*()-_=+;:',./?"

> encodeURIComponent("~!@#$&*()-_=+;:',./?")
"~!%40%23%24%26*()-_%3D%2B%3B%3A'%2C.%2F%3F"

> encodeURIComponent("~!*()-_'.")
"~!*()-_'."
```

### encodeURLComponent

**对 URL 的参数进行编码**

不会对以下字符进行编码

- `0-9a-zA-Z` 字母数字
- `~!()*-_'.`

保留字符的百分号编码

|!|#|$|&|'|(|)|*|+|
|-|-|-|-|-|-|-|-|-|-|-|-|-|-|-|-|-|-|
|%21|%23|%24|%26|%27|%28|%29|%2A|%2B|
|,|/|:|;|=|?|@|[|]|
|%2C|%2F|%3A|%3B|%3D|%3F|%40|%5B|%5D|
