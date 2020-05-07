# jstat

> Java Virtual Machine statistics monitoring tool

References

- `man jstat`
- Understand the JVM - 2nd Edition - ZH Ver. - P142

## Quickstart

```bash
# 只显示一次
jstat -gc 12345
# 每隔 1s 显示一次
jstat -gc 12345 1000
```

## Synopsis

- The jstat tool displays performance statistics for an instrumented HotSpot Java virtual machine (JVM).
- 可以显示本地或远程 JVM 进程中的类加载、内存、垃圾收集、即时编译等运行时数据

```bash
# simple
jstat [ options vmid [interval[s|ms] [count]] ]
# detailed
jstat [ generalOption | outputOptions vmid [ interval [ s|ms ] [ count ] ] ]

# vmid - virtual machine identifier
[protocol:][//]lvmid[@hostname][:port][/servername]
```

## Options

Stat Options

- `-class` Statistics on the behavior of the class loader
- `-compiler` Statistics on the behavior of the HotSpot Just-In-Time compiler
- `-gc` Statistics on the behavior of the garbage collected-heap
- `-gccapacity` Statistics of the capacities of the generations and their corresponding spaces.
- `-gccause` Summary of garbage collection statistics (same as -gcutil),
    - _with the cause of the last and current (if applicable) garbage collection events._
- `-gcnew` Statistics of the behavior of the new generation.
- `-gcnewcapacity` Statistics of the sizes of the new  generations and its corresponding spaces.
- `-gcold` Statistics  of the behavior of the old and permanent generations.
- `-gcoldcapacity` Statistics of the sizes of the old generation.
- `-gcpermcapacity` Statistics of the sizes of the permanent generation.
- `-gcutil` Summary of garbage collection statistics.
- `-printcompilation` Summary of garbage collection statistics.

Format Options

- `-h n` Display a column header every n samples (output rows), where n is a positive integer.
    - _Default value is 0, which displays the column header above the first row of data._
- `-t` Display a timestamp column as the first column of output.
    - _The timestamp is the the time since the start time of the target JVM._
- `-JjavaOption` Pass javaOption to the java application launcher.
    - _For example, `-J-Xms48m` sets the startup memory to 48 megabytes._
    - _For a complete list of options, see java(1)._

## Usage

### Common

Class loader

```bash
# RemoteJdbcServer
$ jstat -class 62858 1000
Loaded  Bytes  Unloaded  Bytes     Time
  2508  5091.4      270   348.7       1.24
  2508  5091.4      270   348.7       1.24
……

# IntelliJ IDEA
$ jstat -class 37199 1000
Loaded  Bytes  Unloaded  Bytes     Time
 83020 165861.6     7491 11190.1     164.60
 83020 165861.6     7491 11190.1     164.60
```

JTT compiler

```bash
# RemoteJdbcServer
$ jstat -compiler 62858 1000
Compiled Failed Invalid   Time   FailedType FailedMethod
    2924      0       0    18.29          0
    2924      0       0    18.29          0
……

# IntelliJ IDEA
$ jstat -compiler 37199 1000
Compiled Failed Invalid   Time   FailedType FailedMethod
  331093      5       0  9435.30          1 com/intellij/configurationStore/StoreUtilKt saveAllProjects
  331093      5       0  9435.30          1 com/intellij/configurationStore/StoreUtilKt saveAllProjects
……
```

Garbage collected-heap

```bash
# RemoteJdbcServer
$ jstat -gc 62858 1000
 S0C    S1C    S0U    S1U      EC       EU        OC         OU       MC     MU    CCSC   CCSU   YGC     YGCT    FGC    FGCT     GCT
 0.0   1024.0  0.0   1024.0  8192.0   4096.0    8192.0     4221.1   18304.0 17594.6 1920.0 1590.2     14    0.283  21      4.039    4.322
 0.0   1024.0  0.0   1024.0  8192.0   4096.0    8192.0     4221.1   18304.0 17594.6 1920.0 1590.2     14    0.283  21      4.039    4.322
……
```

Capacities of generations

```bash
# IntelliJ IDEA
$ jstat -gccapacity 37199 1000
 NGCMN    NGCMX     NGC     S0C   S1C       EC      OGCMN      OGCMX       OGC         OC       MCMN     MCMX      MC     CCSMN    CCSMX     CCSC    YGC    FGC
   192.0 340736.0 340736.0 34048.0 34048.0 272640.0       64.0   707840.0   707840.0   707840.0      0.0 1509376.0 524960.0      0.0 1048576.0  66204.0   4610    39
   192.0 340736.0 340736.0 34048.0 34048.0 272640.0       64.0   707840.0   707840.0   707840.0      0.0 1509376.0 524960.0      0.0 1048576.0  66204.0   4610    39
……
```

Summary of garbage collection

```bash
# RemoteJdbcServer
$ jstat -gccause 62858 1000
  S0     S1     E      O      M     CCS    YGC     YGCT    FGC    FGCT     GCT    LGCC                 GCC
  0.00   0.00   0.00  51.83  95.49  81.98     14    0.283    22    4.468    4.752 System.gc()          No GC
  0.00   0.00   0.00  51.83  95.49  81.98     14    0.283    22    4.468    4.752 System.gc()          No GC
……

# IntelliJ IDEA
$ jstat -gccause 37199 1000
  S0     S1     E      O      M     CCS    YGC     YGCT    FGC    FGCT     GCT    LGCC                 GCC
  0.00  57.27  96.33  89.32  96.10  88.25   4610  232.564    39  286.399  518.963 Allocation Failure   No GC
  0.00  57.27  96.33  89.32  96.10  88.25   4610  232.564    39  286.399  518.963 Allocation Failure   No GC
……
```

New generation

```bash
# RemoteJdbcServer
$ jstat -gcnew 62858 1000
 S0C    S1C    S0U    S1U   TT MTT  DSS      EC       EU     YGC     YGCT
   0.0    0.0    0.0    0.0 15  15  512.0   8192.0   1024.0     14    0.283
   0.0    0.0    0.0    0.0 15  15  512.0   8192.0   1024.0     14    0.283
……

# IntelliJ IDEA
$ jstat -gcnew 37199 1000
 S0C    S1C    S0U    S1U   TT MTT  DSS      EC       EU     YGC     YGCT
34048.0 34048.0    0.0    0.0  3   6 17024.0 272640.0 145892.9   4614  233.273
34048.0 34048.0    0.0    0.0  3   6 17024.0 272640.0 145956.9   4614  233.273
……
```

Size of new generations

```bash

```

### Others

Show headers

```bash
$ jstat -class -h 1 62858 1000
Loaded  Bytes  Unloaded  Bytes     Time
  2444  4991.3      236   295.8       1.13
Loaded  Bytes  Unloaded  Bytes     Time
  2444  4991.3      236   295.8       1.13
……

$ jstat -class -h 2 62858 1000
Loaded  Bytes  Unloaded  Bytes     Time
  2444  4991.3      236   295.8       1.13
  2444  4991.3      236   295.8       1.13
Loaded  Bytes  Unloaded  Bytes     Time
  2444  4991.3      236   295.8       1.13
  2444  4991.3      236   295.8       1.13
```

Show timestamp

```bash
$ jstat -class -t 62858 1000
Timestamp       Loaded  Bytes  Unloaded  Bytes     Time
        84308.9   2444  4991.3      236   295.8       1.13
        84310.0   2444  4991.3      236   295.8       1.13
        84311.0   2444  4991.3      236   295.8       1.13
……
```
