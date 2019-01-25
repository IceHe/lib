# HTTP

References

- https://hit-alibaba.github.io/interview/basic/network/HTTP.html

Features

- stateless 无状态
- …

## Request

### Methods

基本

- GET 查
- POST 增
- PUT 改
- DELETE 删

### Composition

- status 状态行
- headers 请求头
- body 消息主体

```bash
<method> <request-URL> <version>
<headers>

<entity-body>
```

e.g. GET

```http
GET /books/?sex=man&name=Professional HTTP/1.1
Host: www.example.com
User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.6)
Gecko/20050225 Firefox/1.0.1
Connection: Keep-Alive
```

e.g. POST

```http
 POST / HTTP/1.1
 Host: www.example.com
 User-Agent: Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.7.6)
 Gecko/20050225 Firefox/1.0.1
 Content-Type: application/x-www-form-urlencoded
 Content-Length: 40
 Connection: Keep-Alive

 sex=man&name=Professional
```

### POST Content-Type

浏览器的原生 `<form>` 表单

`application/x-www-form-urlencoded`

`multipart/form-data`

```http
POST http://www.example.com HTTP/1.1
Content-Type:multipart/form-data; boundary=----WebKitFormBoundaryrGKCBY7qhFd3TrwA

------WebKitFormBoundaryrGKCBY7qhFd3TrwA
Content-Disposition: form-data; name="text"

title
------WebKitFormBoundaryrGKCBY7qhFd3TrwA
Content-Disposition: form-data; name="file"; filename="chrome.png"
Content-Type: image/png

PNG ... content of chrome.png ...
------WebKitFormBoundaryrGKCBY7qhFd3TrwA--
```

### Notice

- GET 请求可以提交的数据量 URL 长度限制
    - HTTP 没有对此有限制
    - 限制来自浏览器、服务端的实现
- POST 请求理论上没有限制
    - 处于安全考虑，服务端会做限制

## Response

### Composition

- status 状态行
- headers 响应头
- body 响应正文

```http
HTTP/<version> <status_code> <message>

<headers>

<body>
```

e.g.

```http
HTTP/1.1 200 OK

Server:Apache Tomcat/5.0.12
Date:Mon,6Oct2003 13:23:42 GMT
Content-Length:112

<html>...
```

### Status Codes

References

- https://en.wikipedia.org/wiki/List_of_HTTP_status_codes

Common

- 200 OK
- \-\-\-
- 301 Move Permanently 永久重定向
- 302 Move Temporarily 临时重定向
- 304 Not Modified
- \-\-\-
- 400 Bad Request 服务端请求有语法错误
- 401 Unauthorized 请求未经授权
- 403 Forbidden（服务器收到请求，但是）拒绝服务
- 404 Not Found 请求的资源不存在
- \-\-\-
- 500 Internal Server Error 服务器发生不可预期的错误
- 502 Bad Gateway
    - The server was acting as a gateway or proxy and received an invalid response from the upstream server.
- 503 Service Unavailable 服务不可用（一段时间后，服务器可能会恢复）
- 504 Gateway Timeout

More

- 1xx Information
    - 100 Continue
    - 101 Switching Protocols
- 2xx Success
    - 201 Created
    - 202 Accepted
    - 204 No Content
- 3xx Redirection
- 4xx Client Errors
- 5xx Server Errors

## Persistent Connection

持久连接

- HTTP 1.0 使用 header `Connection: Keep-Alive`（当时还没官方标准）
    - 请求和响应都应带有
    - 只要客户端浏览器、服务器能支持就行，HTTP 连接就会保持，不会断开（TCP）
        - 只要不超过 Keep-Alive 规定的时间
- HTTP 1.1 中，所有连接都默认被保持（官方标准）
    - 能否完成 Keep-Alive 就看服务器设置的情况
    - 加入 `Connection: close` 才关闭

Notice

- Keep-Alive 只是简单保持 TCP 连接，避免重新建立连接
- `Keep-Alive: timeout=5, max=100`，表示这个 TCP 通道可以保持 5 秒，最多接收 100 次请求就断开
- 它不能保证连接的存活，不过连接关闭时，能得到一个通知。
    - 所以不能让程序依赖 HTTP 的 Keep-Alive 特性

## Transfer-Encoding

chunked 传输方式

## HTTP Pipeline

- 连续发送多个请求，然后等待响应
- 只有 GET 和 HEAD 能管线化，POST 请求不行
- HTTP 1.0 不支持，需要 1.1
    - 依赖 Persistent Connection

Chrome 和 Firefox 等浏览器都没有默认打开的特性。

## 会话跟踪

方法

- URL 重写：加入标志信息，如 token
- 隐藏表单域
- Cookie
    - 永久：放磁盘
    - 暂时：放内存
- Session
    - 服务端生成 Session 对象
    - 依赖于 Cookie
        - SessionID 放在 Cookie 中

## 跨站攻击

### CSRF / XSRF

> Cross-Site Request Forgery

跨站请求伪造

- 发布伪造的拼接 URL，其它用户点击之后，会触发对应请求
    - 冒充用户在站内的正常操作

避免方法

- 使用 POST 请求处理关键操作
- 在进行必要的操作时，使用验证码
- 检查头信息 referer
    - 只能监控攻击，无法用于抵御
- token：随机、一次性、保密，让其无法被伪造

### XSS

> Cross Site Scripting

跨站脚本攻击

- 提交含有 JS 脚本的文本内容到页面
    - 一旦服务器没有处理好（过滤、转义），分发到到用户手上，就会运行这些脚本
    - 可能导致盗号或其他未授权操作

避免方法

- 过滤用户输入
    - 使用 HTML 解析库进行解析，过滤掉危险的标签
        - 例如 script，或者元素的 onclick 事件