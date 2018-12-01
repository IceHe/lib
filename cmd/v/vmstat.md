# vmstat

> Report virtual memory statistics

- It reports information about processes, memory, paging, block IO, traps, disks and cpu activity.
- See `man vmstat` for more.
- Recommend to use [`dstat`](/cmd/d/dstat.md).

## Synopsis

```bash
vmstat [options] [delay [count]]
```

- `[delay]` The delay between updates in seconds.
    - If no delay is specified, only one report is printed with the average values since boot.
- `[count]` Number of updates.
    - In absence of count, when delay is defined, default is infinite.

## Options

- `-a, --active` Display active and inactive memory, given a 2.5.41 kernel or better.
- `-f, --forks` The `-f` switch displays the number of forks since boot.
    - This includes the fork, vfork, and clone system calls, and is equivalent to the total number of tasks created.
    - Each process is represented by one or more tasks, depending on thread usage.
    - This display does not repeat.
- `-m, --slabs` Displays slabinfo. ( [related](https://en.wikipedia.org/wiki/Slab_allocation) )
- `-n, --one-header` Display the header only once rather than periodically.
- `-s, --stats` Displays a table of various event counters and memory statistics.
    - This display does not repeat.
- `-d, --disk` Report disk statistics (2.5.70 or above required).
- `-D, --disk-sum` Report some summary statistics about disk activity.
- `-p, --partition <device>` Detailed statistics about partition (2.5.70 or above required).
- `-S, --unit <character>` Switches outputs between 1000 (k), 1024 (K), 1000000 (m), or 1048576 (M) bytes.
    - Note this does not change the swap (si/so) or block (bi/bo) fields.
- `-t, --timestamp` Append timestamp to each line
- `-w, --wide` Wide output mode
    - (useful for systems with higher amount of memory, where the default output mode suffers from unwanted column breakage).
    - The output is wider than 80 characters per line.

## Usage

### Default

```bash
$ vmstat
procs -----------memory---------- ---swap-- -----io---- -system-- ------cpu-----
 r  b   swpd   free   buff  cache   si   so    bi    bo   in   cs us sy id wa st
 0  1 133632 3192476 591804 6748972    0    0     4     7    0    0  1  1 99  0  0
```

### Num of Forks

```bash
$ vmstat -f
     58994744 forks
```

### Slab Info

Reference - Wikipedia : https://en.wikipedia.org/wiki/Slab_allocation

```bash
$ vmstat -m
Cache                       Num  Total   Size  Pages
nf_conntrack_ffff97cbde365200   7513   8619    320     51
nf_conntrack_ffff97ca058b6680    918    918    320     51
nf_conntrack_ffffffffb26fc940   8772   9027    320     51
ovl_inode                  9443  11520    680     48
kcopyd_job                    0      0   3312      9
dm_uevent                     0      0   2608     12
dm_rq_target_io               0      0    136     60
ext4_groupinfo_4k          2340   2340    136     60
ext4_inode_cache         209408 212133   1032     31
……
```

### Statistics

```bash
$ vmstat -s
     16205448 K total memory
      5682016 K used memory
      6837084 K active memory
      5140572 K inactive memory
      3177264 K free memory
       593268 K buffer memory
      6752900 K swap cache
      8388604 K total swap
       133632 K used swap
      8254972 K free swap
    166947332 non-nice user cpu ticks
        14957 nice user cpu ticks
    107030164 system cpu ticks
  24351923368 idle cpu ticks
     13372986 IO-wait cpu ticks
            0 IRQ cpu ticks
     17943990 softirq cpu ticks
            0 stolen cpu ticks
   1095739880 pages paged in
   1834985904 pages paged out
      1253051 pages swapped in
      1598390 pages swapped out
   4080507397 interrupts
   2608489652 CPU context switches
   1531896089 boot time
     59028977 forks
```

### Disk

```bash
$ vmstat -d
disk- ------------reads------------ ------------writes----------- -----IO------
       total merged sectors      ms  total merged sectors      ms    cur    sec
sda   16000920 1070549 2191479760 25750904 90065962 53947497 3670037304 785831005      0 168229
```

### Disk Summary

```bash
$ vmstat -D
            1 disks
            7 partitions
     16000920 total reads
      1070549 merged reads
   2191479760 read sectors
     25750904 milli reading
     90065976 writes
     53947511 merged writes
   3670037528 written sectors
    785831095 milli writing
            0 inprogress IO
       168229 milli spent IO
```

### Partition

```bash
vmstat -p <device>

# e.g.
$ vmstat -p sda1
sda1          reads   read sectors  writes    requested writes
              859958   20557314    2187249   29626552
```

### Size Unit

```bash
vmstat -S <character>

# e.g.
$ vmstat -S K
# K : 1024 bytes
# k : 1000 bytes
procs -----------memory---------- ---swap-- -----io---- -system-- ------cpu-----
 r  b   swpd   free   buff  cache   si   so    bi    bo   in   cs us sy id wa st
 1  0 133632 3167672 594204 6753820    0    0     4     7    0    0  1  1 99  0  0

$ vmstat -S M
# M : 1048576 bytes
# m : 1000000 bytes
procs -----------memory---------- ---swap-- -----io---- -system-- ------cpu-----
 r  b   swpd   free   buff  cache   si   so    bi    bo   in   cs us sy id wa st
 0  0    130   3096    580   6595    0    0     4     7    0    0  1  1 99  0  0
```

### With Timestamp

```bash
$ vmstat -t
procs -----------memory---------- ---swap-- -----io---- -system-- ------cpu----- -----timestamp-----
 r  b   swpd   free   buff  cache   si   so    bi    bo   in   cs us sy id wa st                 CST
 0  0 133632 3174344 594432 6754140    0    0     4     7    0    0  1  1 99  0  0 2018-11-14 20:59:57
```

### Wide Ouput Mode

```bash
$ vmstat -w
procs -----------------------memory---------------------- ---swap-- -----io---- -system-- --------cpu--------
 r  b         swpd         free         buff        cache   si   so    bi    bo   in   cs  us  sy  id  wa  st
 1  0       133632      4155796       505364      5839292    0    0     5     8    0    0   1   1  99   0   0
```
