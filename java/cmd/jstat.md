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

Show class loader behavior stats

```bash
jstat -class 62858 1000
Loaded  Bytes  Unloaded  Bytes     Time
  2508  5091.4      270   348.7       1.24
  2508  5091.4      270   348.7       1.24
……
```

Show JTT compiler behavior stats

```bash
jstat -compiler 37199 1000
Compiled Failed Invalid   Time   FailedType FailedMethod
  331093      5       0  9435.30          1 com/intellij/configurationStore/StoreUtilKt saveAllProjects
  331093      5       0  9435.30          1 com/intellij/configurationStore/StoreUtilKt saveAllProjects
```

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
