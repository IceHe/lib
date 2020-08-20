# jstat

> monitor JVM statistics

References

- `man jstat`
- Understand the JVM - 2nd Edition - ZH Ver. - P142
- https://docs.oracle.com/en/java/javase/14/docs/specs/man/jstat.html

## Quickstart

```bash
# 只显示一次
jstat -gc 12345
# 每隔 1s 显示一次
jstat -gc 12345 1000
```

## Synopsis

- The jstat tool displays performance statistics for an instrumented HotSpot Java virtual machine ( JVM ) .
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
- `-gccause` Summary of garbage collection statistics ( same as `-gcutil` ) ,
    - _with the cause of the last and current ( if applicable ) garbage collection events._
- `-gcnew` Statistics of the behavior of the new generation.
- `-gcnewcapacity` Statistics of the sizes of the new  generations and its corresponding spaces.
- `-gcold` Statistics  of the behavior of the old and permanent generations.
- `-gcoldcapacity` Statistics of the sizes of the old generation.
- ~~`-gcpermcapacity` Statistics of the sizes of the permanent generation.~~
- `-gcmetacapacity` Statistics of the sizes of the meta space.
- `-gcutil` Summary of garbage collection statistics.
- `-printcompilation` Summary of garbage collection statistics.

Output Options

- `-h n` Display a column header every n samples ( output rows ), where n is a positive integer.
    - _Default value is 0, which displays the column header above the first row of data._
- `-t` Display a timestamp column as the first column of output.
    - _The timestamp is the the time since the start time of the target JVM._
- `-JjavaOption` Pass javaOption to the java application launcher.
    - _For example, `-J-Xms48m` sets the startup memory to 48 megabytes._
    - _For a complete list of options, see java(1)._

## Usage

### Class Loader

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

- **Loaded** : Number of classes loaded.
- **Bytes** : Number of KB loaded.
- **Unloaded** : Number of classes unloaded.
- **Bytes** : Number of KB loaded.
- **Time** : Time spent performing class loading and unloading operations.

### JTT Compiler

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

- **Compiled** : Number of compilation tasks performed.
- **Failed** : Number of compilations tasks failed.
- **Invalid** : Number of compilation tasks that were invalidated.
- **Time** : Time spent performing compilation tasks.
- **FailedType** : Compile type of the last failed compilation.
- **FailedMethod** : Class name and method of the last failed compilation.

### GC Heap

```bash
# RemoteJdbcServer
$ jstat -gc 62858 1000
 S0C    S1C    S0U    S1U      EC       EU        OC         OU       MC     MU    CCSC   CCSU   YGC     YGCT    FGC    FGCT     GCT
 0.0   1024.0  0.0   1024.0  8192.0   4096.0    8192.0     4221.1   18304.0 17594.6 1920.0 1590.2     14    0.283  21      4.039    4.322
 0.0   1024.0  0.0   1024.0  8192.0   4096.0    8192.0     4221.1   18304.0 17594.6 1920.0 1590.2     14    0.283  21      4.039    4.322
……
```

- **S0C** : Current survivor space 0 capacity (KB).
- **S1C** : Current survivor space 1 capacity (KB).
- **S0U** : Survivor space 0 utilization (KB).
- **S1U** : Survivor space 1 utilization (KB).
- **EC** : Current eden space capacity (KB).
- **EU** : Eden space utilization (KB).
- **OC** : Current old space capacity (KB).
- **OU** : Old space utilization (KB).
- ~~PC : Current permanent space capacity (KB).~~
- ~~PU : Permanent space utilization (KB).~~
- **MC** : Metaspace Committed Size (KB).
- **MU** : Metaspace utilization (KB).
- **CCSC** : Compressed class committed size (KB).
- **CCSU** : Compressed class space used (KB).
- **YGC** : Number of young generation garbage collection (GC) events.
- **YGCT** : Young generation garbage collection time.
- **FGC** : Number of full GC events.
- **FGCT** : Full garbage collection time.
- **GCT** : Total garbage collection time.

### Memory Pool Generation & Space Capacities

```bash
# IntelliJ IDEA
$ jstat -gccapacity 37199 1000
 NGCMN    NGCMX     NGC     S0C   S1C       EC      OGCMN      OGCMX       OGC         OC       MCMN     MCMX      MC     CCSMN    CCSMX     CCSC    YGC    FGC
   192.0 340736.0 340736.0 34048.0 34048.0 272640.0       64.0   707840.0   707840.0   707840.0      0.0 1509376.0 524960.0      0.0 1048576.0  66204.0   4610    39
   192.0 340736.0 340736.0 34048.0 34048.0 272640.0       64.0   707840.0   707840.0   707840.0      0.0 1509376.0 524960.0      0.0 1048576.0  66204.0   4610    39
……
```

- **NGCMN** : Minimum new generation capacity (KB).
- **NGCMX** : Maximum new generation capacity (KB).
- **NGC** : Current new generation capacity (KB).
- **S0C** : Current survivor space 0 capacity (KB).
- **S1C** : Current survivor space 1 capacity (KB).
- **EC** : Current eden space capacity (KB).
- **OGCMN** : Minimum old generation capacity (KB).
- **OGCMX** : Maximum old generation capacity (KB).
- **OGC** : Current old generation capacity (KB).
- **OC** : Current old space capacity (KB).
- ~~PGCMN : Minimum permanent generation capacity (KB).~~
- ~~PGCMX : Maximum Permanent generation capacity (KB).~~
- ~~PGC : Current Permanent generation capacity (KB).~~
- ~~PC : Current Permanent space capacity (KB).~~
- **MCMN** : Minimum metaspace capacity (KB).
- **MCMX** : Maximum metaspace capacity (KB).
- **MC** : Metaspace Committed Size (KB).
- **CCSMN** : Compressed class space minimum capacity (KB).
- **CCSMX** : Compressed class space maximum capacity (KB).
- **CCSC** : Compressed class committed size (KB).
- **YGC** : Number of young generation GC events.
- **FGC** : Number of full GC events.

### GC Summary

This option displays the same summary of garbage collection statistics as the `-gcutil` option, but includes the causes of the last garbage collection event and ( if applicable ) the current garbage collection event.

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

- Columns in `-gcutil`
    - **S0** : Survivor space 0 utilization as a percentage of the space's current capacity.
    - **S1** : Survivor space 1 utilization as a percentage of the space's current capacity.
    - **E** : Eden space utilization as a percentage of the space's current capacity.
    - **O** : Old space utilization as a percentage of the space's current capacity.
    - ~~P : Permanent  space  utilization as a percentage of the space's current capacity.~~
    - **M** : Metaspace utilization as a percentage of the space's current capacity.
    - **CCS** : Compressed class space utilization as a percentage.
    - **YGC** : Number of young generation GC events.
    - **YGCT** : Young generation garbage collection time.
    - **FGC** : Number of full GC events.
    - **FGCT** : Full garbage collection time.
    - **GCT** : Total garbage collection time.
- In addition to the columns listed for `-gcutil` , this option adds the following columns :
    - **LGCC** : Cause of last garbage collection
    - **GCC** : Cause of current garbage collection

### New Generation

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

- **S0C** : Current survivor space 0 capacity (KB).
- **S1C** : Current survivor space 1 capacity (KB).
- **S0U** : Survivor space 0 utilization (KB).
- **S1U** : Survivor space 1 utilization (KB).
- **TT** : Tenuring threshold.
- **MTT** : Maximum tenuring threshold.
- **DSS** : Desired survivor size (KB).
- **EC** : Current eden space capacity (KB).
- **EU** : Eden space utilization (KB).
- **YGC** : Number of young generation GC events.
- **YGCT** : Young generation garbage collection time.

### New Generation Space Size

```bash
# RemoteJdbcServer
$ jstat -gcnewcapacity 62858 1000
  NGCMN      NGCMX       NGC      S0CMX     S0C     S1CMX     S1C       ECMX        EC      YGC   FGC
       0.0  2097152.0     8192.0      0.0      0.0 2097152.0      0.0  2097152.0     8192.0    14    22
       0.0  2097152.0     8192.0      0.0      0.0 2097152.0      0.0  2097152.0     8192.0    14    22
……

# IntelliJ IDEA
$ jstat -gcnewcapacity 37199 1000
  NGCMN      NGCMX       NGC      S0CMX     S0C     S1CMX     S1C       ECMX        EC      YGC   FGC
     192.0   340736.0   340736.0  34048.0  34048.0  34048.0  34048.0   272640.0   272640.0  4614    40
     192.0   340736.0   340736.0  34048.0  34048.0  34048.0  34048.0   272640.0   272640.0  4614    40
……
```

- **NGCMN** : Minimum new generation capacity (KB).
- **NGCMX** : Maximum new generation capacity (KB).
- **NGC** : Current new generation capacity (KB).
- **S0CMX** : Maximum survivor space 0 capacity (KB).
- **S0C** : Current survivor space 0 capacity (KB).
- **S1CMX** : Maximum survivor space 1 capacity (KB).
- **S1C** : Current survivor space 1 capacity (KB).
- **ECMX** : Maximum eden space capacity (KB).
- **EC** : Current eden space capacity (KB).
- **YGC** : Number of young generation GC events.
- **FGC** : Number of full GC events.

### Old Generation

```bash
# IntelliJ IDEA
$ jstat -gcold 581 1000
   MC       MU      CCSC     CCSU       OC          OU       YGC    FGC    FGCT    CGC    CGCT     GCT
414072.0 395921.5  54732.0  47887.6    707840.0    247228.1    556    10   79.436   368   46.837  149.360
414072.0 395921.5  54732.0  47887.6    707840.0    247228.1    556    10   79.436   368   46.837  149.360
……
```

- ~~PC : Current permanent space capacity (KB).~~
- ~~PU : Permanent space utilization (KB).~~
- **MC** : Metaspace Committed Size (KB).
- **MU** : Metaspace utilization (KB).
- **CCSC** : Compressed class committed size (KB).
- **CCSU** : Compressed class space used (KB).
- **OC** : Current old space capacity (KB).
- **OU** : Old space utilization (KB).
- **YGC** : Number of young generation GC events.
- **FGC** : Number of full GC events.
- **FGCT** : Full garbage collection time.
- **GCT** : Total garbage collection time.

### Old Generation Space Size

```bash
# IntelliJ IDEA
$  jstat -gcoldcapacity 581 1000
   OGCMN       OGCMX        OGC         OC       YGC   FGC    FGCT    CGC    CGCT     GCT
       64.0    707840.0    707840.0    707840.0   557    10   79.436   368   46.837  149.398
       64.0    707840.0    707840.0    707840.0   557    10   79.436   368   46.837  149.398
……
```

- **OGCMN** : Minimum old generation capacity (KB).
- **OGCMX** : Maximum old generation capacity (KB).
- **OGC** : Current old generation capacity (KB).
- **OC** : Current old space capacity (KB).
- **YGC** : Number of young generation GC events.
- **FGC** : Number of full GC events.
- **FGCT** : Full garbage collection time.
- **GCT** : Total garbage collection time.

### Metaspace size

```bash
# IntelliJ IDEA
$ jstat -gcmetacapacity 581 1000
   MCMN       MCMX        MC       CCSMN      CCSMX       CCSC     YGC   FGC    FGCT    CGC    CGCT     GCT
       0.0  1409024.0   414072.0        0.0  1048576.0    54732.0   557    10   79.436   368   46.837  149.398
       0.0  1409024.0   414072.0        0.0  1048576.0    54732.0   557    10   79.436   368   46.837  149.398
……
```

- **MCMN** : Minimum metaspace capacity (KB).
- **MCMX** : Maximum metaspace capacity (KB).
- **MC** : Metaspace Committed Size (KB).
- **CCSMN** : Compressed class space minimum capacity (KB).
- **CCSMX** : Compressed class space maximum capacity (KB).
- **YGC** : Number of young generation GC events.
- **FGC** : Number of full GC events.
- **FGCT** : Full garbage collection time.
- **GCT** : Total garbage collection time.

### HotSpot VM compiler method

```bash
# IntelliJ IDEA
$ jstat -printcompilation 581 1000
Compiled  Size  Type Method
   88518     83    1 com/intellij/openapi/vfs/newvfs/persistent/FSRecords$DbConnection$3 run
   88518     83    1 com/intellij/openapi/vfs/newvfs/persistent/FSRecords$DbConnection$3 run
……
```

- **Compiled** : Number of compilation tasks performed by the most recently compiled method.
- **Size** : Number of bytes of byte code of the most recently compiled method.
- **Type** : Compilation type of the most recently compiled method.
- **Method** : Class name and method name identifying the most recently compiled method.
    - Class name uses a slash (/) instead of a dot (.) as a name space separator.
    - The method name is the method within the specified class.
    - The format for these two fields is consistent with the HotSpot `-XX:+PrintCompilation` option.

### Show Headers

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

### Show Timestamp

```bash
$ jstat -class -t 62858 1000
Timestamp       Loaded  Bytes  Unloaded  Bytes     Time
        84308.9   2444  4991.3      236   295.8       1.13
        84310.0   2444  4991.3      236   295.8       1.13
        84311.0   2444  4991.3      236   295.8       1.13
……
```
