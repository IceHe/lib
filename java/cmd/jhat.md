# jhat

> Java Heap Analysis Tool

* Only available in JDK 8

References

* `man jhat`
* Understand the JVM - 2nd Edition - ZH Ver. - P145
* [https://docs.oracle.com/javase/8/docs/technotes/tools/unix/jhat.html](https://docs.oracle.com/javase/8/docs/technotes/tools/unix/jhat.html)

## Quickstart

```bash
# Analyze dump file
jhat jmap-dump-all-12345.bin
```

## Synopsis

```bash
jhat [ options ] <heap-dump-file>
```

## Options

* `-stack false|true` Turns off tracking object allocation call stack.
  * If allocation site information is not available in the heap dump, then you have to set this flag to false.
  * The default is true.
* `-refs false|true` Turns off tracking of references to objects.
  * Default is true.
  * By default, back pointers, which are objects that point to a specified object such as referrers or incoming references, are calculated for all objects in the heap.
* `-port port-number` Sets the port for the jhat HTTP server.
  * Default is 7000.
* `-exclude exclude-file` Specifies a file that lists data members that should be excluded from the reachable objects query.
  * For example, if the file lists java.lang.String.value, then, then whenever the list of objects that are reachable from a specific object o are calculated, reference paths that involve java.lang.String.value field are not considered.
* `-baseline exclude-file` Specifies a baseline heap dump.
  * Objects in both heap dumps with the same object ID are marked as not being new.
  * Other objects are marked as new.
  * This is useful for comparing two different heap dumps.
* `-debug int` Sets the debug level for this tool.
  * A level of 0 means no debug output.
  * Set higher values for more verbose modes.
* _`-version` Reports the release number and exits_
* _`-h` \| `-help` Displays a help message and exits._
* _`-Jflag` Passes flag to the Java Virtual Machine on which the jhat command is running._
  * _For example, `-J-Xmx512m` to use a maximum heap size of 512 MB._

## Usage

```bash
# IntelliJ IDEA
$ jmap -dump:all,format=b,file=jmap-dump-all-581.bin 581
Heap dump file created

$ jhat jmap-dump-all-581.bin
Reading from jmap-dump-all-581.bin...
Dump file created Thu Aug 20 16:47:13 CST 2020
Snapshot read, resolving...
Resolving 4436517 objects...
Chasing references, expect 887 dots.......................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................
Eliminating duplicate references.......................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................................
Snapshot resolved.
Started HTTP server on port 7000
Server is ready.
```

* And then visit [http://localhost:7000/](http://localhost:7000/)

