# jcmd

> send diagnostic command requests to a running JVM

References

- `man jcmd`
- https://docs.oracle.com/javase/8/docs/technotes/tools/unix/jcmd.html

## Quickstart

```bash
```

## Synopsis

```bash
jcmd [pid | main-class] command... | PerfCounter.print | -f filename
jcmd [-l]
jcmd -h
```

- `main-class` When used, the jcmd utility sends the diagnostic command request to all Java processes with the specified name of the main class.
- `command` The command must be a valid jcmd command for the selected JVM.
    - **The list of available commands for jcmd is obtained by running the help command ( `jcmd pid help` )** where pid is the process ID for the running Java process.
    - **If the pid is 0, commands will be sent to all Java processes.**
    - The main class argument will be used to match, either partially or fully, the class used to start Java.
    - _If no options are given, it lists the running Java process identifiers with the main class and command-line arguments that were used to launch the process ( the same as using -l )._
- `Perfcounter.print` Prints the performance counters exposed by the specified Java process.
- `-f filename` Reads and executes commands from a specified file, filename.
- `-l` Displays the list of Java Virtual Machine process identifiers that are not running in a separate docker process along with the main class and command-line arguments that were used to launch the process.
    - _If the JVM is in a docker process, you must use tools such as ps to look up the PID._
    - _Note : Using jcmd without arguments is the same as using `jcmd -l` ._

## Options

## Usage

```bash
```
