# ab

> Apache HTTP server benchmarking tool

- `ab` is a tool for benchmarking your Apache Hypertext Transfer Protocol (HTTP) server.
    - It is designed to give you an impression of how your current Apache installation performs.
    - This especially shows you how many requests per second your Apache  installation is capable of serving.

References

- `man ab` on macOS
- Using Apache Bench for simple load testing : https://vyspiansky.github.io/2019/12/02/apache-bench-for-load-testing

## Quickstart

```bash
# Append extra headers to the request
ab -n 100 -c 10 -H "Accept-Encoding: gzip,deflate" http://example.com/

# Don’t exit if it gets an error
ab -n 100 -c 10 -r http://example.com/

# To make POST requests with a specific file used as the POST data
ab -n 100 -c 10 -p data.json -T application/json http://example.com/

########################################

# Use watch to keep on firing ab requests at an endpoint.
# ( Notice that watch isn’t available by default on macOS,
#   but can be easily installed with Homebrew. )
brew install watch
# and then run
watch -n 1 ab -n 100 -c 10 http://example.com/
```

## Synopsis

```bash
 ab [ -A auth-username:password ]
    [ -b windowsize ]
    [ -B local-address ]
    [ -c concurrency ]
    [ -C cookie-name=value ]
    [ -d ]
    [ -e csv-file ]
    [ -f protocol ]
    [ -g gnuplot-file ]
    [ -h ]
    [ -H custom-header ]
    [ -i ]
    [ -k ]
    [ -l ]
    [ -m HTTP-method ]
    [ -n requests ]
    [ -p POST-file ]
    [ -P proxy-auth-username:password ]
    [ -q ]
    [ -r ]
    [ -s timeout ]
    [ -S ]
    [ -t timelimit ]
    [ -T content-type ]
    [ -u PUT-file ]
    [ -v verbosity]
    [ -V ]
    [ -w ]
    [ -x <table>-attributes ]
    [ -X proxy[:port] ]
    [ -y <tr>-attributes  ]
    [ -z <td>-attributes ]
    [ -Z ciphersuite ]
    [http[s]://]hostname[:port]/path
```

## Options

_`-A auth-username:password`_

- Supply BASIC Authentication credentials to the server.
    - The username and password are separated by a single : and sent on the wire base64 encoded.
    - The string is sent regardless of whether the server needs it (i.e., has sent an 401 authentication needed).

_`-b windowsize`_

- _Size of TCP send/receive buffer, in bytes._

_`-B local-address`_

- _Address to bind to when making outgoing connections._

**`-c concurrency`**

- **Number of multiple requests to perform at a time.**
    - Default is one request at a time.

**`-C cookie-name=value`**

- **Add a Cookie: line to the request.**
    - The argument is typically in the form of a `name=value` pair.
    - This field is repeatable.

`-d`

- Do not display the "percentage served within XX [ms] table". (legacy support).

**`-e csv-file`**

- **Write a Comma separated value (CSV) file which contains for each percentage (from 1% to 100%) the time (in milliseconds) it took to serve that percentage of the requests.**
    - This is usually more useful than the 'gnuplot' file; as the results are already 'binned'.

_`-f protocol`_

- _Specify SSL/TLS protocol (SSL2, SSL3, TLS1, TLS1.1, TLS1.2, or ALL)._
    - _TLS1.1 and TLS1.2 support available in 2.4.4 and later._

**`-g gnuplot-file`

- **Write all measured values out as a 'gnuplot' or TSV (Tab separate values) file.**
    - This file can easily be imported into packages like Gnuplot, IDL, Mathematica, Igor or even Excel.
    - The labels are on the first line of the file.

_`-h`_

- _Display usage information._

**`-H custom-header`**

- **Append extra headers to the request.**
    - The argument is typically in the form of a valid header line, containing a colon-separated field-value pair (i.e., "Accept-Encoding: zip/zop;8bit").

_`-i`_

- _Do HEAD requests instead of GET._

**`-k`**

- **Enable the HTTP KeepAlive feature, i.e., perform multiple requests within one HTTP session.**
    - **Default is no KeepAlive.**

_`-l`_

- _Do not report errors if the length of the responses is not constant._
    - _This can be useful for dynamic pages._
    - _Available in 2.4.7 and later._

**`-m HTTP-method`

- **Custom HTTP method for the requests.**
    - _Available in 2.4.10 and later._

**`-n requests`**

- **Number of requests to perform for the benchmarking session.**
    - **The default is to just perform a single request which usually leads to non-representative benchmarking results.**

**`-p POST-file`**

- **File containing data to POST.**
    - Remember to also set `-T`.

_`-P proxy-auth-username:password`_

- _Supply BASIC Authentication credentials to a proxy en-route._
    - _The username and password are separated by a single : and sent on the wire base64 encoded._
    - _The string is sent regardless of whether the proxy needs it (i.e., has sent an 407 proxy authentication needed)._

**`-q`**

- **When processing more than 150 requests, ab outputs a progress count on stderr every 10% or 100 requests or so.**
    - The `-q` flag will suppress these messages.
    - _( icehe : 没太看懂这个选项的用途, 在错误输出流中输出有用的参考信息么? )_

**`-r`**

- **Don't exit on socket receive errors.**

**`-s timeout`**

- **Maximum number of seconds to wait before the socket times out.**
    - **Default is 30 seconds.**
    - Available in 2.4.4 and later.

**`-S`**

- **Do not display the median and standard deviation values, nor display the warning/error messages when the average and median are more than one or two times the standard deviation apart.**
    - **And default to the min/avg/max values.** (legacy support).

**`-t timelimit`**

- **Maximum number of seconds to spend for benchmarking.**
    - This **implies a `-n 50000` internally.**
    - Use this to **benchmark the server within a fixed total amount of time.**
    - **Per default there is no timelimit.**

**`-T content-type`**

- **Content-type header to use for POST/PUT data**, eg. `application/x-www-form-urlencoded`.
    - **Default is `text/plain`.**

`-u PUT-file`

- File containing data to PUT.
    - Remember to also set `-T`.

**`-v verbosity`**

- **Set verbosity level - 4 and above prints information on headers, 3 and above prints response codes (404, 200, etc.), 2 and above prints warnings and info.**

`-V`

- Display version number and exit.

`-w`

- Print out results in HTML tables.
    - Default table is two columns wide, with a white background.

_`-x <table>-attributes`_

- _String to use as attributes for `<table>`._
    - _Attributes are inserted `<table here>`._

**`-X proxy[:port]`**

- **Use a proxy server for the requests.**

_`-y <tr>-attributes`_

- String to use as attributes for `<tr>`.

_`-z <td>-attributes`_

- String to use as attributes for `<td>`.

`-Z ciphersuite`

- Specify SSL/TLS cipher suite (See openssl ciphers)

## Output

The following list describes the values returned by ab:

Server Software

- The value, if any, returned in the server HTTP header of the first successful response.
    - This includes all characters in the header from beginning to the point a character with decimal value of 32 (most notably: a space or CR/LF) is detected.

Server Hostname

- The DNS or IP address given on the command line

Server Port

- The port to which ab is connecting.
    - If no port is given on the command line, this will default to 80 for http and 443 for https.

SSL/TLS Protocol

- The protocol parameters negotiated between the client and server.
    - This will only be printed if SSL is used.

Document Path

- The request URI parsed from the command line string.

Document Length

- This is the size in bytes of the first successfully returned document.
    - If the document length changes during testing, the response is considered an error.

**Concurrency Level**

- **The number of concurrent clients used during the test**

**Time taken for tests**

- This is **the time taken from the moment the first socket connection is created to the moment the last response is received**

Complete requests

- The number of successful responses received

Failed requests

- The number of requests that were considered a failure.
    - If the number is greater than zero, another line will be printed showing the number of requests that failed due to connecting, reading, incorrect content length, or exceptions.

Write errors

- The number of errors that failed during write (**broken pipe**).

**Non-2xx responses**

- **The number of responses that were not in the 200 series of response codes.**
    - If all responses were 200, this field is not printed.

**Keep-Alive requests**

- **The number of connections that resulted in Keep-Alive requests**

Total body sent

- If configured to send data as part of the test, this is the total number of bytes sent during the tests.
    - This field is omitted if the test did not include a body to send.

Total transferred

- The total number of bytes received from the server.
    - This number is essentially the number of bytes sent over the wire.

HTML transferred

- The total number of document bytes received from the server.
    - This number excludes bytes received in HTTP headers

**Requests per second**

- **The number of requests per second.**
    - This value is the result of dividing the number of requests by the total time taken

**Time per request**

- **The average time spent per request.**
    - The first value is calculated with the formula `concurrency * timetaken * 1000 / done` while the second value is calculated with the formula `timetaken * 1000 / done`

Transfer rate

- The rate of transfer as calculated by the formula `totalread / 1024 / timetaken`

## Usage

### Common

```bash
# ab -n <num_requests> -c <concurrency> <addr>:<port><path>
$ ab -n 1000 -c 100 http://localhost:3000/\#/README

This is ApacheBench, Version 2.3 <$Revision: 1826891 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking localhost (be patient)
Completed 100 requests
Completed 200 requests
Completed 300 requests
Completed 400 requests
Completed 500 requests
Completed 600 requests
Completed 700 requests
Completed 800 requests
Completed 900 requests
Completed 1000 requests
Finished 1000 requests

Server Software:        nginx/1.19.4
Server Hostname:        localhost
Server Port:            3000

Document Path:          /#/README
Document Length:        14270 bytes

Concurrency Level:      100
Time taken for tests:   0.528 seconds
Complete requests:      1000
Failed requests:        0
Total transferred:      14506000 bytes
HTML transferred:       14270000 bytes
Requests per second:    1893.41 [#/sec] (mean)
Time per request:       52.815 [ms] (mean)
Time per request:       0.528 [ms] (mean, across all concurrent requests)
Transfer rate:          26822.06 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0   14  10.1     12      45
Processing:     1   37  15.7     38      86
Waiting:        1   23  10.4     23      55
Total:         12   52  19.8     56      94

Percentage of the requests served within a certain time (ms)
  50%     56
  66%     62
  75%     66
  80%     68
  90%     73
  95%     82
  98%     90
  99%     93
 100%     94 (longest request)
```

###

```bash

```
