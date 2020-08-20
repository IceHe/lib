# jmap

> memory map : print details of a specified process

References

- `man jmap`
- Understand the JVM - 2nd Edition - ZH Ver. - P144
- https://docs.oracle.com/en/java/javase/14/docs/specs/man/jmap.html

## Quickstart

```bash
# Dump all objects
jmap -dump:all,format=b,file=jmap-dump-all-12345.bin 12345

# Dump live objects
jmap -dump:live,format=b,file=jmap-dump-live-12345.bin 12345

# Show class loader statistics
jmap -clstats 12345
```

## Synopsis

```bash
jmap [ option ] pid
jmap [ option ] executable core
jmap [ option ] [ server-id@ ] remote-hostname-or-IP
```

## Options

- `-clstats pid` Connects to a running process and prints class loader statistics of Java heap.
- `-finalizerinfo pid` Connects to a running process and prints information on objects awaiting finalization.
- `-histo[:live] pid` Connects to a running process and prints a histogram of the Java object heap.
    - If the live suboption is specified, it then counts only live objects.
- `-dump:dump_options pid` Connects to a running process and dumps the Java heap.
    - The dump_options include:
        - `live` When specified, dumps only the live objects; if not specified, then dumps all objects in the heap.
        - `format=b` Dumps the Java heap in hprof binary format
        - `file=filename` Dumps the heap to filename
    - Example: jmap -dump:live,format=b,file=heap.bin pid

## Usage

### Class Loader

```bash
# IntelliJ IDEA
$ jmap -clstats 581
Index Super InstBytes KlassBytes annotations     CpAll MethodCount Bytecodes MethodAll     ROAll     RWAll     Total ClassName
    1    -1  82915176        504           0         0           0         0         0        24       616       640 [B
    2    -1  24106760        504           0         0           0         0         0        24       616       640 [I
    3    41  16969320        616         128     14272         109      4576     77952     18640     75632     94272 java.lang.String
    4    -1  12357432        504           0         0           0         0         0        24       616       640 [Ljava.lang.Object;
    5    41   7711064        672           0     22120         139      5679     95384     24632     95456    120088 java.lang.Class
    6    41   5642144        584           0      1392           7       149      2656      1152      3800      4952 java.util.HashMap$Node
    7    -1   4338136        504           0         0           0         0         0        32       616       648 [Ljava.util.HashMap$Node;
    8    41   3878624        592           0      1368           9       213      2776      1488      3584      5072 java.util.concurrent.ConcurrentHashMap$Node
    9    -1   2774168        504           0         0           0         0         0        24       616       640 [C
   10 59539   2287296       1440           0      7008          64      2681     48848     11232     47056     58288 java.util.ArrayList
   11     6   2131000        584           0       512           1        10       624       304      1648      1952 java.util.LinkedHashMap$Entry
   12    41   1921024        528           0       888           2        45       808       432      2032      2464 com.intellij.util.containers.IntObjectLinkedMap$MapEntry
   13 62782   1612680        792           0      7024          39      1023     13032      5984     15672     21656 org.jdom.Attribute
   14 59539   1489584       1320           0      4672          29      2038     25488      6024     25960     31984 com.intellij.util.SmartList
   15    -1   1365880        504           0         0           0         0         0        32       616       648 [Ljava.util.concurrent.ConcurrentHashMap$Node;
   16    27   1335680        584           0       728           4        41      2504       552      3464      4016 com.intellij.reference.SoftReference
   17    -1   1157888        504           0         0           0         0         0        24       616       640 [J
……
            248324816   48508944     1177480 130153960      548287  26679441 185243808 100811760 283283120 384094880 Total
                64.7%      12.6%        0.3%     33.9%           -      6.9%     48.2%     26.2%     73.8%    100.0%
Index Super InstBytes KlassBytes annotations     CpAll MethodCount Bytecodes MethodAll     ROAll     RWAll     Total ClassName
…… ( max index : 65833 )
```

### Finalization

```bash
# IntelliJ IDEA
$ jmap -finalizerinfo 581
No instances waiting for finalization found
```

### Histogram of Object Heap

#### Default All

Prints a histogram of the Java object heap

```bash
# IntelliJ IDEA
$ jmap -histo 581
 num     #instances         #bytes  class name (module)
-------------------------------------------------------
   1:        793630       87757672  [B (java.base@11.0.7)
   2:         82437       28394672  [I (java.base@11.0.7)
   3:        722035       17328840  java.lang.String (java.base@11.0.7)
   4:        158293       12708400  [Ljava.lang.Object; (java.base@11.0.7)
   5:         65850        7711960  java.lang.Class (java.base@11.0.7)
   6:        206109        6595488  java.util.HashMap$Node (java.base@11.0.7)
   7:        168315        5386080  java.util.concurrent.ConcurrentHashMap$Node (java.base@11.0.7)
   8:        113575        4543000  java.security.AccessControlContext (java.base@11.0.7)
   9:         29264        4471784  [Ljava.util.HashMap$Node; (java.base@11.0.7)
  10:         10548        3202744  [C (java.base@11.0.7)
  11:        116227        2789448  java.util.ArrayList (java.base@11.0.7)
  12:         47094        2637264  java.util.concurrent.ConcurrentHashMap$KeyIterator (java.base@11.0.7)
  13:         11443        2380144  sun.java2d.SunGraphics2D (java.desktop@11.0.7)
  14:         70641        2260512  com.intellij.util.containers.LockFreeCopyOnWriteArrayList$COWIterator
  15:         53275        2131000  java.util.LinkedHashMap$Entry (java.base@11.0.7)
  16:         65253        2088096  java.util.concurrent.locks.AbstractQueuedSynchronizer$Node (java.base@11.0.7)
  17:         60032        1921024  com.intellij.util.containers.IntObjectLinkedMap$MapEntry
  18:         26369        1898568  java.awt.geom.AffineTransform (java.desktop@11.0.7)
  19:         40317        1612680  org.jdom.Attribute
……
Total       5532528      296656320
…… ( max num : 32093 )
```

#### Live Objects

Prints a histogram of only the live Java object heap

```bash
# IntelliJ IDEA
$ jmap -histo:live 581
 num     #instances         #bytes  class name (module)
-------------------------------------------------------
   1:        740083       82895920  [B (java.base@11.0.7)
   2:         81941       24101240  [I (java.base@11.0.7)
   3:        707072       16969728  java.lang.String (java.base@11.0.7)
   4:        142229       12356432  [Ljava.lang.Object; (java.base@11.0.7)
   5:         65850        7711960  java.lang.Class (java.base@11.0.7)
   6:        176314        5642048  java.util.HashMap$Node (java.base@11.0.7)
   7:         29166        4338056  [Ljava.util.HashMap$Node; (java.base@11.0.7)
   8:        121197        3878304  java.util.concurrent.ConcurrentHashMap$Node (java.base@11.0.7)
   9:          5506        2774256  [C (java.base@11.0.7)
  10:         95301        2287224  java.util.ArrayList (java.base@11.0.7)
  11:         53275        2131000  java.util.LinkedHashMap$Entry (java.base@11.0.7)
  12:         60032        1921024  com.intellij.util.containers.IntObjectLinkedMap$MapEntry
  13:         40317        1612680  org.jdom.Attribute
  14:         62066        1489584  com.intellij.util.SmartList
  15:          2030        1365880  [Ljava.util.concurrent.ConcurrentHashMap$Node; (java.base@11.0.7)
  16:         33392        1335680  com.intellij.reference.SoftReference
  17:          9172        1151936  [J (java.base@11.0.7)
……
Total       4377356      24829144
…… ( max num : 31953 )
```

### Dump Heap

#### All

Dump all objects

```bash
# IntelliJ IDEA
$ jmap -dump:all,format=b,file=jmap-dump-all-581.bin 581
Heap dump file created
```

#### Live

Dump only live objects

```bash
# IntelliJ IDEA
$ jmap -dump:live,format=b,file=jmap-dump-all-581.bin 581
Heap dump file created
```
