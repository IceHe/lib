# iostat

> Report Central Processing Unit (CPU) statistics and input/output statistics for devices and partitions.

- The iostat command is used for monitoring system input/output device loading by observing the time the devices are active in relation to their average transfer rates.
- The iostat command generates reports that can be used to change system configuration to better balance the input/output load between physical disks.
- See `man iostat` for more.
- Recommend to use [`dstat`](/cmd/d/dstat.md).

## Synopsis

```bash
iostat [ -c ] [ -d ] [ -h ] [ -k | -m ]
    [ -N ] [ -t ] [ -V ] [ -x ] [ -y ] [ -z ]
    [ -j { ID | LABEL | PATH | UUID | ... } ]
    [ [ -T ] -g group_name ]
    [ -p [ device [,...] | ALL ] ]
    [ device [...] | ALL ]
    [ interval [ count ] ]
```

## Options

Display

- `-c` Display **CPU** utilization report
- `-d` Display **device** utilization report
- `-x` Display **extended statistics**

Format

- `-k` Display statistics in **kilobytes** per second
- `-m` Display statistics in **megabytes** per second
- `-t` Print **time** for each report displayed

## Usage

### Display

#### Default

```bash
$ iostat
Linux 3.10.0-862.6.3.el7.x86_64 (box0.icehe.xyz)        11/08/2018      _x86_64_        (24 CPU)

avg-cpu:  %user   %nice %system %iowait  %steal   %idle
           0.56    0.00    0.43    0.05    0.00   98.96

Device:            tps    kB_read/s    kB_wrtn/s    kB_read    kB_wrtn
sda              10.21        96.35       172.04  942451408 1682772420
```

#### CPU

```bash
$ iostat -c
Linux 3.10.0-862.6.3.el7.x86_64 (box029.wb.trans.imgbed.bx.sinanode.com)        11/15/2018      _x86_64_        (24 CPU)

avg-cpu:  %user   %nice %system %iowait  %steal   %idle
           0.68    0.00    0.51    0.05    0.00   98.76
```

#### Device

```bash
iostat -d
Linux 3.10.0-862.6.3.el7.x86_64 (box029.wb.trans.imgbed.bx.sinanode.com)        11/15/2018      _x86_64_        (24 CPU)

Device:            tps    kB_read/s    kB_wrtn/s    kB_read    kB_wrtn
sda              10.31       108.07       179.64 1121062944 1863404872
```

#### Extended

```bash
$ iostat -x
Linux 3.10.0-862.6.3.el7.x86_64 (box029.wb.trans.imgbed.bx.sinanode.com)        11/15/2018      _x86_64_        (24 CPU)

avg-cpu:  %user   %nice %system %iowait  %steal   %idle
           0.68    0.00    0.51    0.05    0.00   98.76

Device:         rrqm/s   wrqm/s     r/s     w/s    rkB/s    wkB/s avgrq-sz avgqu-sz   await r_await w_await  svctm  %util
sda               0.10     5.23    1.57    8.74   108.07   179.64    55.81     0.08    8.05    1.61    9.21   1.58   1.63
```

### Interval

- 2 seconds

```bash
$ iostat 2
Linux 3.10.0-862.6.3.el7.x86_64 (box0.icehe.xyz )        11/08/2018      _x86_64_        (24 CPU)

avg-cpu:  %user   %nice %system %iowait  %steal   %idle
           0.56    0.00    0.43    0.05    0.00   98.96

Device:            tps    kB_read/s    kB_wrtn/s    kB_read    kB_wrtn
sda              10.21        96.35       172.04  942451408 1682773744

avg-cpu:  %user   %nice %system %iowait  %steal   %idle
           1.11    0.00    0.65    0.00    0.00   98.24

Device:            tps    kB_read/s    kB_wrtn/s    kB_read    kB_wrtn
sda               0.00         0.00         0.00          0          0

avg-cpu:  %user   %nice %system %iowait  %steal   %idle
           1.11    0.00    0.52    0.06    0.00   98.31

Device:            tps    kB_read/s    kB_wrtn/s    kB_read    kB_wrtn
sda               2.50         0.00        30.00          0         60

……
```

### Count

- 1 second
- 3 times

```bash
$ iostat 1 3
Linux 3.10.0-862.6.3.el7.x86_64 (box0.icehe.xyz )        11/08/2018      _x86_64_        (24 CPU)

avg-cpu:  %user   %nice %system %iowait  %steal   %idle
           0.56    0.00    0.43    0.05    0.00   98.96

Device:            tps    kB_read/s    kB_wrtn/s    kB_read    kB_wrtn
sda              10.21        96.35       172.04  942451408 1682802056

avg-cpu:  %user   %nice %system %iowait  %steal   %idle
           0.63    0.00    0.58    0.00    0.00   98.79

Device:            tps    kB_read/s    kB_wrtn/s    kB_read    kB_wrtn
sda               0.00         0.00         0.00          0          0

avg-cpu:  %user   %nice %system %iowait  %steal   %idle
           0.92    0.00    0.46    0.00    0.00   98.62

Device:            tps    kB_read/s    kB_wrtn/s    kB_read    kB_wrtn
sda               0.00         0.00         0.00          0          0

```
