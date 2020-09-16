# jhsdb

> Java HotSpot : attach to a Java process or launch a postmortem debugger to analyze the content of a core dump from a crashed JVM

* Available after JDK 9

References

* `man jhsdb`
* Java SE 14 Docs - Tools References - `jhsdb` : [https://docs.oracle.com/en/java/javase/14/docs/specs/man/jhsdb.html](https://docs.oracle.com/en/java/javase/14/docs/specs/man/jhsdb.html)
* Talk about openjdk's jhsdb tool - Programmer Sought : [https://www.programmersought.com/article/32321720601/](https://www.programmersought.com/article/32321720601/)

## Quickstart

```bash

```

## Synopsis

```bash
jhsdb clhsdb [--pid pid | --exe executable --core coredump]
jhsdb hsdb [--pid pid | --exe executable --core coredump]
jhsdb debugd (--pid pid | --exe executable --core coredump) [options]
jhsdb jstack (--pid pid | --exe executable --core coredump | --connect [server-id@]debugd-host) [options]
jhsdb jmap (--pid pid | --exe executable --core coredump | --connect [server-id@]debugd-host) [options]
jhsdb jinfo (--pid pid | --exe executable --core coredump | --connect [server-id@]debugd-host) [options]
jhsdb jsnap (--pid pid | --exe executable --core coredump | --connect [server-id@]debugd-host) [options]
```

* `jhsdb clhsdb` Starts the interactive **command-line debugger**.
* `jhsdb hsdb` Starts the interactive **GUI debugger**.
* `jhsdb debugd` Starts the **remote debug server**.
* `jhsdb jstack` Prints **stack and locks info**.
* `jhsdb jmap` Prints **heap info**.
* `jhsdb jinfo` Prints basic **JVM info**.
* `jhsdb jsnap` Prints **performance counter info**.
* `jhsdb command --help` Displays the **options available** for the command.

## Description

### `command`

```bash
$ jhsdb command
    clhsdb              command line debugger
    hsdb                ui debugger
    debugd --help       to get more information
    jstack --help       to get more information
    jmap   --help       to get more information
    jinfo  --help       to get more information
    jsnap  --help       to get more information
```

### `clhsdb`

```bash
$ jhsdb clhsdb --help
    --pid <pid>             To attach to and operate on the given live process.
    --core <corefile>       To operate on the given core file.
    --exe <executable for corefile>

    The --core and --exe options must be set together to give the core
    file, and associated executable, to operate on. They can use
    absolute or relative paths.
    The --pid option can be set to operate on a live process.
    --core and --pid are mutually exclusive.

    Examples: jhsdb clhsdb --pid 1234
          or  jhsdb clhsdb --core ./core.1234 --exe ./myexe
```

### `hsdb`

```bash
$ jhsdb hsdb --help
    --pid <pid>             To attach to and operate on the given live process.
    --core <corefile>       To operate on the given core file.
    --exe <executable for corefile>

    The --core and --exe options must be set together to give the core
    file, and associated executable, to operate on. They can use
    absolute or relative paths.
    The --pid option can be set to operate on a live process.
    --core and --pid are mutually exclusive.

    Examples: jhsdb hsdb --pid 1234
          or  jhsdb hsdb --core ./core.1234 --exe ./myexe
```

### `debugd`

```bash
$ jhsdb debugd --help
    --serverid <id>         A unique identifier for this debug server.
    --pid <pid>             To attach to and operate on the given live process.
    --core <corefile>       To operate on the given core file.
    --exe <executable for corefile>

    The --core and --exe options must be set together to give the core
    file, and associated executable, to operate on. They can use
    absolute or relative paths.
    The --pid option can be set to operate on a live process.
    --core and --pid are mutually exclusive.

    Examples: jhsdb debugd --pid 1234
          or  jhsdb debugd --core ./core.1234 --exe ./myexe
```

### `jstack`

```bash
$ jhsdb jstack --help
    --locks                 To print java.util.concurrent locks.
    --mixed                 To print both Java and native frames (mixed mode).
    --pid <pid>             To attach to and operate on the given live process.
    --core <corefile>       To operate on the given core file.
    --exe <executable for corefile>
    --connect [<id>@]<host> To connect to a remote debug server (debugd).

    The --core and --exe options must be set together to give the core
    file, and associated executable, to operate on. They can use
    absolute or relative paths.
    The --pid option can be set to operate on a live process.
    The --connect option can be set to connect to a debug server (debugd).
    --core, --pid, and --connect are mutually exclusive.

    Examples: jhsdb jstack --pid 1234
          or  jhsdb jstack --core ./core.1234 --exe ./myexe
          or  jhsdb jstack --connect debugserver
          or  jhsdb jstack --connect id@debugserver
```

### `jmap`

```bash
$ jhsdb jmap --help
    <no option>             To print same info as Solaris pmap.
    --heap                  To print java heap summary.
    --binaryheap            To dump java heap in hprof binary format.
    --dumpfile <name>       The name of the dump file.
    --histo                 To print histogram of java object heap.
    --clstats               To print class loader statistics.
    --finalizerinfo         To print information on objects awaiting finalization.
    --pid <pid>             To attach to and operate on the given live process.
    --core <corefile>       To operate on the given core file.
    --exe <executable for corefile>
    --connect [<id>@]<host> To connect to a remote debug server (debugd).

    The --core and --exe options must be set together to give the core
    file, and associated executable, to operate on. They can use
    absolute or relative paths.
    The --pid option can be set to operate on a live process.
    The --connect option can be set to connect to a debug server (debugd).
    --core, --pid, and --connect are mutually exclusive.

    Examples: jhsdb jmap --pid 1234
          or  jhsdb jmap --core ./core.1234 --exe ./myexe
          or  jhsdb jmap --connect debugserver
          or  jhsdb jmap --connect id@debugserver
```

### `jinfo`

```bash
$ jhsdb jinfo --help
    --flags                 To print VM flags.
    --sysprops              To print Java System properties.
    <no option>             To print both of the above.
    --pid <pid>             To attach to and operate on the given live process.
    --core <corefile>       To operate on the given core file.
    --exe <executable for corefile>
    --connect [<id>@]<host> To connect to a remote debug server (debugd).

    The --core and --exe options must be set together to give the core
    file, and associated executable, to operate on. They can use
    absolute or relative paths.
    The --pid option can be set to operate on a live process.
    The --connect option can be set to connect to a debug server (debugd).
    --core, --pid, and --connect are mutually exclusive.

    Examples: jhsdb jinfo --pid 1234
          or  jhsdb jinfo --core ./core.1234 --exe ./myexe
          or  jhsdb jinfo --connect debugserver
          or  jhsdb jinfo --connect id@debugserver
```

### `jsnap`

```bash
$ jhsdb jsnap --help
    --all                   To print all performance counters.
    --pid <pid>             To attach to and operate on the given live process.
    --core <corefile>       To operate on the given core file.
    --exe <executable for corefile>
    --connect [<id>@]<host> To connect to a remote debug server (debugd).

    The --core and --exe options must be set together to give the core
    file, and associated executable, to operate on. They can use
    absolute or relative paths.
    The --pid option can be set to operate on a live process.
    The --connect option can be set to connect to a debug server (debugd).
    --core, --pid, and --connect are mutually exclusive.

    Examples: jhsdb jsnap --pid 1234
          or  jhsdb jsnap --core ./core.1234 --exe ./myexe
          or  jhsdb jsnap --connect debugserver
          or  jhsdb jsnap --connect id@debugserver
```

* _\( icehe : 不像以上的几个命令, 这个没有独立的命令行命令 \)_

## Options

### debugd

* `--serverid server-id` An optional unique ID for this debug server.
  * _This is required if multiple debug servers are run on the same machine._

### jinfo

* `--flags` Prints the VM flags.
* `--sysprops` Prints the Java system properties.
* `no option` : Prints the VM flags and the Java system properties.

### jmap

* `no option` Prints the same information as Solaris pmap.
* `--heap` Prints the java heap summary.
* `--binaryheap` Dumps the java heap in hprof binary format.
* `--dumpfile name` The name of the dumpfile.
* `--histo` Prints the histogram of java object heap.
* `--clstats` Prints the class loader statistics.
* `--finalizerinfo` Prints the information on objects awaiting finalization.

### jstack

* `--locks` Prints the java.util.concurrent locks information.
* `--mixed` Attempts to print both java and native frames if the platform allows it.

### jsnap

* `--all` Prints all performance counters.

## Usage

* 暂略

