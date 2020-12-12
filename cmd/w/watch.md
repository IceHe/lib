# watch

execute a program periodically, showing output fullscreen

---

References

- Install `brew install watch` on macOS
- Manual : `man watch`

## Synopsis

```bash
watch [options] command
```

- `watch` runs command repeatedly, displaying its output and errors (the first screenfull).
    - This allows you to watch the program output change over time.
    - **By default, command is run every 2 seconds and watch will run until interrupted.**

## Options

**`-d, --differences [permanent]`**

- **Highlight the differences between successive updates.**
    - Option will read optional argument that changes highlight to be permanent, allowing to see what has changed at least once since first iteration.

**`-n, --interval seconds`**

- **Specify update interval.**
    - The command will **not allow quicker than 0.1 second interval**, in which the smaller values are converted.
    - Both '.' and ',' work for any locales.

`-p, --precise`

- Make `watch` attempt to run `command` every `interval` seconds.
    - Try it with `ntptime` and notice how the fractional seconds stays (nearly) the same, as opposed to normal mode where they continuously increase.

`-t, --no-title`

- Turn off the header showing the interval, command, and current time at the top of the display, as well as the following blank line.

`-b, --beep`

- Beep if command has a non-zero exit.

`-e, --errexit`

- Freeze updates on command error, and exit after a key press.

`-g, --chgexit`

- Exit when the output of `command` changes.

`-c, --color`

- Interpret ANSI color and style sequences.

`-x, --exec`

- Pass command to `exec(2)` instead of `sh -c` which reduces the need to use extra quoting to get the desired effect.

_`-h, --help`_

- _Display help text and exit._

_`-v, --version`_

- _Display version information and exit._

## Exit Status

|Exit Status|Description|
|-|-|
|0|Success.|
|1|Various failures.|
|2|Forking the process to watch failed.|
|3|Replacing child process stdout with write side pipe failed.|
|4|Command execution failed.|
|5|Closing child process write pipe failed.|
|7|IPC pipe creation failed.|
|8|Getting child process return value with `waitpid(2)` failed,<br/> or command exited up on error.|
|other| The watch will propagate command exit status as child exit status.|

## Usage

### Examples

To watch for mail, you might do
       watch -n 60 from
To watch the contents of a directory change, you could use
       watch -d ls -l
If you're only interested in files owned by user joe, you might use
       watch -d 'ls -l | fgrep joe'
To see the effects of quoting, try these out
       watch echo $$
       watch echo '$$'
       watch echo "'"'$$'"'"
To see the effect of precision time keeping, try adding -p to
       watch -n 10 sleep 1
You can watch for your administrator to install the latest kernel with
       watch uname -r

( Note that `-p` isn't guaranteed to work across reboots, especially in the face of ntpdate or other bootup time-changing mechanisms )

### With AB

Reference

- Using Apache Bench for simple load testing : https://vyspiansky.github.io/2019/12/02/apache-bench-for-load-testing

```bash
$ watch -n 1 ab -n 10 -c 5 http://example.com/

Every 1.0s: ab -n 10 -c 5 http://example.com/                                                             zhiyuanhe02.local: Mon Nov  9 15:05:58 2020

This is ApacheBench, Version 2.3 <$Revision: 1826891 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking example.com (be patient).....done


Server Software:        ECS
Server Hostname:        example.com
Server Port:            80

Document Path:          /
Document Length:        1256 bytes

Concurrency Level:      5
Time taken for tests:   4.444 seconds
Complete requests:      10
Failed requests:        0
Total transferred:      16153 bytes
HTML transferred:       12560 bytes
Requests per second:    2.25 [#/sec] (mean)
Time per request:       2222.071 [ms] (mean)
Time per request:       444.414 [ms] (mean, across all concurrent requests)
Transfer rate:          3.55 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:      169  578 527.0    174    1235
Processing:   170  612 542.5    269    1420
Waiting:      170  327 283.0    172     936
Total:        339 1190 850.1   1315    2599

Percentage of the requests served within a certain time (ms)
  50%   1315
  66%   1345
  75%   1407
  80%   2554
  90%   2599
  95%   2599
  98%   2599
  99%   2599
 100%   2599 (longest request)
```

#### Highlight Differences

```bash
$ watch -d -c -n 1 ab -n 10 -c 5 http://example.com/
```
