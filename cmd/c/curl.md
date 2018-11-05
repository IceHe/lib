# curl

> transfer a URL : a tool to transfer data from or to a server, using one of the supported protocols

## Options

Header

- `-I, --head` Fetch headers only! ( HTTP FTP FILE )
- `-i, --include` Include the HTTP-header in the output.
- `-H, --header <header>` Extra header to include in the request
    - when sending HTTP to a server ( HTTP )
    - e.g., `curl -H "X-First-Name: Joe" http://example.com/`

Method

- `-X, --request <command>` Specify a custom request method to use
    - when communicating with the HTTP server
    - e.g., `curl -X HEAD http://example.com/`

Display

- `-s, --silent` Silent or quiet mode.
    - Do not show progress meter or error messages.
- `-S, --show-error` It makes curl show an error message if it fails.
    - when used with `-s, --silent`

Download

- `-L, --location` Enable redirect ( HTTP ) :
    - If the server reports that requested page has moved to different location (indicated with Location: header & 3XX response code), it will make curl redo the request on the new place.
- `-O, --remote-name` Write output to local file named like remote file.
    - (Only file part of remote file is used, path is cut off.)

## Usage

### Download

```bash
curl -LO <url_to_file>

# e.g.
$ curl -LO https://getcomposer.org/composer.phar
  % Total    % Received % Xferd  Average Speed   Time    Time     Time  Current
                                 Dload  Upload   Total   Spent    Left  Speed
100 1841k  100 1841k    0     0   449k      0  0:00:04  0:00:04 --:--:--  449k
```

### Request

```bash
curl -X <http_method> <url> -H '<header_name>: <header_value>'

# e.g.
$ curl -X POST http://10.1.2.3:8888/comments -H 'Host: api.weibo.cn'
```