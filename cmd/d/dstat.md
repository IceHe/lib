# dstat

> versatile tool for generating system resource statistics

Reference : https://linux.cn/article-3215-1.html

## Usage

Default

```bash
$ dstat
You did not select any stats, using -cdngy by default.
----total-cpu-usage---- -dsk/total- -net/total- ---paging-- ---system--
usr sys idl wai hiq siq| read  writ| recv  send|  in   out | int   csw
  1   0  99   0   0   0|  96k  172k|   0     0 | 525B  670B|4701  5520
  1   1  98   0   0   0|   0    84k|1625B 2224B|   0     0 |5132  6332
  1   1  98   0   0   0|   0     0 |1788B 2561B|   0     0 |4950  7388
  1   1  98   0   0   0|   0     0 |6795B 6639B|   0     0 |5574  8364
  1   1  98   0   0   0|   0     0 |8444B 7591B|   0     0 |5561  7976
  1   0  98   0   0   0|   0   152k|  50k   45k|   0     0 |7075  8975
……
```

## Description

Dstat is a versatile **replacement for `vmstat`, `iostat` and `ifstat`**.

Dstat allows you to view all of your system resources instantly, you can e.g. compare disk usage in combination with interrupts from your IDE controller, or **compare the network bandwidth numbers directly with the disk throughput (in the same interval)**.

Dstat also cleverly gives you the most detailed information in columns and clearly indicates in what magnitude and unit the output is displayed. Less confusion, less mistakes, more efficient.

Dstat is unique in letting you aggregate block device throughput for a certain diskset or network bandwidth for a group of interfaces, ie. you can see the throughput for all the block devices that make up a single filesystem or storage system.

## Options

### Default Output

- `-a, --all` Equals `-cdngy` ( **default** )
- `-c, --cpu` Enable cpu stats (system, user, idle, wait, hardware interrupt, software interrupt)
- `-d, --disk` Enable disk stats (read, write)
- `-n, --net` Enable network stats (receive, send)
- `-g, --page` Enable page stats (page in, page out)
- `-y, --sys` Enable system stats (interrupts, context switches)

### Advanced Output

- `-c, --cpu` Enable cpu stats (system, user, idle, wait, hardware interrupt, software interrupt)
    - `-C 0,3,total` Include cpu0, cpu3 and total (when using -c/--cpu)
- `-d, --disk` Enable disk stats (read, write)
    - `-D total,hda` Include total and hda (when using -d/--disk)
- `-i, --int` Enable interrupt stats
    - `-I 5,10` Include interrupt 5 and 10 (when using -i/--int)
- `-l, --load` Enable load average stats (1 min, 5 mins, 15mins)
- `-m, --mem` Enable memory stats (used, buffers, cache, free)
- `-n, --net` Enable network stats (receive, send)
    - `-N eth1,total` Include eth1 and total (when using -n/--net)
- `-p, --proc` Enable process stats (runnable, uninterruptible, new)
- `-r, --io` Enable I/O request stats (read, write requests)
- `-s, --swap` Enable swap stats (used, free)
- `-S swap1,total` Include swap1 and total (when using -s/--swap)
- `-t, --time` Enable time/date output
    - `-T, --epoch` Enable time counter (seconds since epoch)
- `--aio` Enable aio stats (asynchronous I/O)
- `--fs, --filesystem` Enable filesystem stats (open files, inodes)
- `--ipc` Enable ipc stats (message queue, semaphores, shared memory)
- `--lock` Enable file lock stats (posix, flock, read, write)
- `--raw` Enable raw stats (raw sockets)
- `--socket` Enable socket stats (total, tcp, udp, raw, ip-fragments)
- `--tcp` Enable tcp stats (listen, established, syn, time_wait, close)
- `--udp` Enable udp stats (listen, active)
- `--unix` Enable unix stats (datagram, stream, listen, active)
- `--vm` Enable vm stats (hard pagefaults, soft pagefaults, allocated, free)
- `--plugin-name` Enable (external) plugins by plugin name, see PLUGINS for options

### Others

- `--list` List the internal and external plugin names
- `-f, --full` Expand `-C, -D, -I, -N, -S` discovery lists
- `-v, --vmstat` Equals `-pmgdsc -D total`

Values

- `--bits` Force bits for values expressed in bytes
- `--float` Force float values on screen (mutual exclusive with `--integer`)
- `--integer` Force integer values on screen (mutual exclusive with --float)

Colors

- `--bw, --blackonwhite` Change colors for white background terminal
- `--nocolor` Disable colors (implies --noupdate)

Others

- `--noheaders` Disable repetitive headers
- `--noupdate` Disable intermediate updates when delay > 1
- `--output file` Write CSV output to file
- `--profile` Show profiling statistics when exiting dstat

### Plugins

See `man dstat` section PLUGINS.
