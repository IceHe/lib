# jcmd

> send diagnostic command requests to a running JVM

References

- `man jcmd`
- https://docs.oracle.com/javase/8/docs/technotes/tools/unix/jcmd.html

## Quickstart

```bash
# Show available commands
jcmd 581 help -all

```

## Synopsis & Options

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

## Commands

### Help

`help [options] [arguments]`

- For more information about a specific command.
- arguments:
    - `command name` : The name of the command for which we want help (STRING, no default value)
- _Note : The following options must be specified using either key or key=value syntax._
- options:
    - `-all`: ( Optional ) Show help for all commands (BOOLEAN, false) .

### Compiler

`Compiler.codecache`

- Prints code cache layout and bounds.
- _Impact: Low_
- _Permission: java.lang.management.ManagementPermission(monitor)_

`Compiler.codelist`

- Prints all compiled methods in code cache that are alive.
- _Impact: Medium_
- _Permission: java.lang.management.ManagementPermission(monitor)_

`Compiler.queue`

- Prints methods queued for compilation.
- _Impact: Low_
- _Permission: java.lang.management.ManagementPermission(monitor)_

`Compiler.directives_add *filename* *arguments*`

- Adds compiler directives from a file.
- _Impact: Low_
- _Permission: java.lang.management.ManagementPermission(monitor)_
- arguments:
    - `filename` : The name of the directives file (STRING, no default value)

`Compiler.directives_clear`

- Remove all compiler directives.
- _Impact: Low_
- _Permission: java.lang.management.ManagementPermission(monitor)_

`Compiler.directives_print`

- Prints all active compiler directives.
- _Impact: Low_
- _Permission: java.lang.management.ManagementPermission(monitor)_

`Compiler.directives_remove`

- Remove latest added compiler directive.
- _Impact: Low_
- _Permission: java.lang.management.ManagementPermission(monitor)_

### GC

**`GC.class_histogram [options]`**

- Provides statistics about the Java heap usage.
- _Impact: High --- depends on Java heap size and content._
- _Permission: java.lang.management.ManagementPermission(monitor)_
- _Note: The options must be specified using either key or key=value syntax._
- options:
    - `-all` : ( Optional ) Inspects all objects, including unreachable objects ( BOOLEAN, false )

**`GC.class_stats [options] [arguments]`**

- ( Deprecated ) Provide statistics about Java class meta data.
- _Impact: High --- depends on Java heap size and content._
- _Note: The options must be specified using either key or key=value syntax._
- options:
    - `-all` : (Optional) Shows all columns (BOOLEAN, false)
    - `-csv` : (Optional) Prints in CSV (comma-separated values) format for spreadsheets (BOOLEAN, false)
    - `-help` : (Optional) Shows the meaning of all the columns (BOOLEAN, false)
- arguments:
    `columns` : (Optional) Comma-separated list of all the columns to be shown. If not specified, the following columns are shown:
        - InstBytes
        - KlassBytes
        - CpAll
        - annotations
        - MethodCount
        - Bytecodes
        - MethodAll
        - ROAll
        - RWAll
        - Total
    - ( STRING, no default value )

`GC.finalizer_info`

- Provides information about the Java finalization queue.
- _Impact: Medium_
- _Permission: java.lang.management.ManagementPermission(monitor)_

**`GC.heap_dump [options] [arguments]`**

- Generates a HPROF format dump of the Java heap.
- _Impact: High --- depends on the Java heap size and content._
    - _Request a full GC unless the -all option is specified._
- _Permission: java.lang.management.ManagementPermission(monitor)__
- _Note: The following options must be specified using either key or key=value syntax._
- options:
    - `-all` : (Optional) Dump all objects, including unreachable objects (BOOLEAN, false)
- arguments:
    - `filename` : The name of the dump file (STRING, no default value)

**`GC.heap_info`**

- Provides generic Java heap information.
- _Impact: Medium_
- _Permission: java.lang.management.ManagementPermission(monitor)_

**`GC.run`**

- Calls java.lang.System.gc().
- _Impact: Medium --- depends on the Java heap size and content._

`GC.run_finalization`

- Calls java.lang.System.runFinalization().
- _Impact: Medium --- depends on the Java content._

### JFR

`JFR.check [options]`

- Show information about a running flight recording
- _Impact: Low_
- _Note: The options must be specified using either key or key=value syntax._
    - _If no parameters are entered, information for all active recordings is shown._
- options:
    - `name` : (Optional) Name of the flight recording. (STRING, no default value)
    - `verbose` : (Optional) Flag for printing the event settings for the recording (BOOLEAN, false)

**`JFR.configure [options]`**

- Set the parameters for a flight recording
- _Impact: Low_
- _Note: The options must be specified using either key or key=value syntax._
    - _If no parameters are entered, the current settings are displayed._
- options:
    - `globalbuffercount` : (Optional) Number of global buffers.
        - This option is a legacy option: change the memorysize parameter to alter the number of global buffers.
        - This value cannot be changed once JFR has been initalized.
        - (STRING, default determined by the value for memorysize)
    - `globalbuffersize` : (Optional) Size of the global buffers, in bytes.
        - This option is a legacy option: change the memorysize parameter to alter the size of the global buffers.
        - This value cannot be changed once JFR has been initalized.
        - (STRING, default determined by the value for memorysize)
    - `maxchunksize` : (Optional) Maximum size of an individual data chunk in bytes if one of the following suffixes is not used: 'm' or 'M' for megabytes OR 'g' or 'G' for gigabytes.
        - This value cannot be changed once JFR has been initialized.
        - (STRING, 12M)
    - `memorysize` : (Optional) Overall memory size, in bytes if one of the following suffixes is not used: 'm' or 'M' for megabytes OR 'g' or 'G' for gigabytes.
        - This value cannot be changed once JFR has been initialized.
        - (STRING, 10M)
    - `repositorypath` : (Optional) Path to the location where recordings are stored until they are written to a permanent file.
        - ( STRING, The default location is the temporary directory for the operating system.
            - On Linux operating systems, the temporary directory is /tmp.
            - On Windwows, the temporary directory is specified by the TMP environment variable.)
    - `stackdepth` : (Optional) Stack depth for stack traces.
        - Setting this value greater than the default of 64 may cause a performance degradation.
        - This value cannot be changed once JFR has been initialized.
        - (LONG, 64)
    - `thread_buffer_size` : (Optional) Local buffer size for each thread in bytes if one of the following suffixes is not used: 'k' or 'K' for kilobytes or 'm' or 'M' for megabytes.
        - Overriding this parameter could reduce performance and is not recommended.
        - This value cannot be changed once JFR has been initialized.
        - (STRING, 8k)
    - `samplethreads` : (Optional) Flag for activating thread sampling. (BOOLEAN, true)

**`JFR.dump [options]`**

- Write data to a file while a flight recording is running
- _Impact: Low_
- _Note: The options must be specified using either key or key=value syntax._
    - _No options are required._
    - _The recording continues to run after the data is written._
- options:
    - `begin` : (Optional) Specify the time from which recording data will be included in the dump file.
        - The format is specified as local time. (STRING, no default value)
    - `end` : (Optional) Specify the time to which recording data will be included in the dump file.
        - The format is specified as local time. (STRING, no default value)
    - Note: For both begin and end, the time must be in a format that can be read by java.time.LocalTime::parse(STRING), java.time.LocalDateTime::parse(STRING) or java.time.Instant::parse(STRING)._
        - _For example, "13:20:15", "2020-03-17T09:00:00" or "2020-03-17T09:00:00Z"._
    - _Note: begin and end times correspond to the timestamps found within the recorded information in the flight recording data._
        - _Another option is to use a time relative to the current time that is specified by a negative integer followed by "s", "m" or "h". For example, "-12h", "-15m" or "-30s"_
    - `filename` : (Optional) Name of the file to which the flight recording data is dumped. If no filename is given, a filename is generated from the PID and the current date. The filename may also be a directory in which case, the filename is generated from the PID and the current date in the specified directory. (STRING, no default value)
    - `maxage` : (Optional) Length of time for dumping the flight recording data to a file. (INTEGER followed by 's' for seconds 'm' for minutes or 'h' for hours, no default value)
    - `maxsize` : (Optional) Maximum size for the amount of data to dump from a flight recording in bytes if one of the following suffixes is not used: 'm' or 'M' for megabytes OR 'g' or 'G' for gigabytes. (STRING, no default value)
    - `name` : (Optional) Name of the recording. If no name is given, data from all recordings is dumped. (STRING, no default value)
    - `path-to-gc-root` : (Optional) Flag for saving the path to garbage collection (GC) roots at the time the recording data is dumped. The path information is useful for finding memory leaks but collecting it can cause the application to pause for a short period of time. Turn on this flag only when you have an application that you suspect has a memory leak. (BOOLEAN, false)

`JFR.start [options]`

- Start a flight recording
- _Impact: Low_
- _Note: The options must be specified using either key or key=value syntax._
    - _If no parameters are entered, then a recording is started with default values._
- options:
    - `delay` : (Optional) Length of time to wait before starting to record (INTEGER followed by 's' for seconds 'm' for minutes or 'h' for hours, 0s)
    - `disk` : (Optional) Flag for also writing the data to disk while recording (BOOLEAN, true)
    - `dumponexit` : (Optional) Flag for writing the recording to disk when the Java Virtual Machine (JVM) shuts down.
        - If set to 'true' and no value is given for filename, the recording is written to a file in the directory where the process was started.
        - The file name is a system-generated name that contains the process ID, the recording ID and the current time stamp.
        - (For example: id-1-2019_12_12_10_41.jfr) (BOOLEAN, false)
    - `duration` : (Optional) Length of time to record.
        - _Note that 0s means forever (INTEGER followed by 's' for seconds 'm' for minutes or 'h' for hours, 0s)_
    - `filename` : (Optional) Name of the file to which the flight recording data is written when the recording is stopped.
        - If no filename is given, a filename is generated from the PID and the current date and is placed in the directory where the process was started.
        - The filename may also be a directory in which case, the filename is generated from the PID and the current date in the specified directory.
        - (STRING, no default value)
    - `maxage` : (Optional) Maximum time to keep the recorded data on disk.
        - This parameter is valid only when the disk parameter is set to true.
        - _Note 0s means forever. (INTEGER followed by 's' for seconds 'm' for minutes or 'h' for hours, 0s)_
    - `maxsize` : (Optional) Maximum size of the data to keep on disk in bytes if one of the following suffixes is not used: 'm' or 'M' for megabytes OR 'g' or 'G' for gigabytes.
        - This parameter is valid only when the disk parameter is set to 'true'.
        - The value must not be less than the value for the maxchunksize parameter set with the JFR.configure command.
        - (STRING, 0 (no maximum size))
    - `name` : (Optional) Name of the recording.
        - If no name is provided, a name is generated.
        - Make note of the generated name that is shown in the response to the command so that you can use it with other commands.
        - (STRING, system-generated default name)
    - `path-to-gc-root` : (Optional) Flag for saving the path to garbage collection (GC) roots at the end of a recording.
        - The path information is useful for finding memory leaks but collecting it is time consuming.
        - Turn on this flag only when you have an application that you suspect has a memory leak.
        - If the settings parameter is set to 'profile', then the information collected includes the stack trace from where the potential leaking object was allocated.
        - (BOOLEAN, false)
    - `settings` : (Optional) Name of the settings file that identifies which events to record.
        - To specify more than one file, separate the names with a comma (',').
        - Include the path if the file is not in JAVA-HOME/lib/jfr.
        - The following profiles are included with the JDK in the JAVA-HOME/lib/jfr directory: 'default.jfc': collects a predefined set of information with low overhead, so it has minimal impact on performance and can be used with recordings that run continuously; 'profile.jfc': Provides more data than the 'default.jfc' profile, but with more overhead and impact on performance.
        - Use this configuration for short periods of time when more information is needed.
        - Use none to start a recording without a predefined configuration file.
        - (STRING, JAVA-HOME/lib/jfr/default.jfc)

`JFR.stop [options]`

- Stop a flight recording
- _Impact: Low_
- _Note: The options must be specified using either key or key=value syntax._
    - _If no parameters are entered, then no recording is stopped._
- options:
    - `filename` : (Optional) Name of the file to which the recording is written when the recording is stopped. If no path is provided, the data from the recording is discarded.
        - (STRING, no default value)
    - `name` : (Optional) Name of the recording
        - (STRING, no default value)

### JVMTI

`JVMTI.agent_load [arguments]`

- Loads JVMTI native agent.
- _Impact: Low_
- _Permission: java.lang.management.ManagementPermission(control)_
- arguments:
    - `library path` : Absolute path of the JVMTI agent to load.
        - (STRING, no default value)
    - `agent option` : (Optional) Option string to pass the agent.
        - (STRING, no default value)

**`JVMTI.data_dump`**

- Signals the JVM to do a data-dump request for JVMTI.
- _Impact: High_
- _Permission: java.lang.management.ManagementPermission(monitor)_

### ManagementAgent

`ManagementAgent.start [options]`

- Starts remote management agent.
- _Impact: Low --- no impact_
- _Note: The following options must be specified using either key or key=value syntax._
- options:
    - `config.file` : (Optional) Sets com.sun.management.config.file
        - (STRING, no default value)
    - `jmxremote.host` : (Optional) Sets com.sun.management.jmxremote.host
        - (STRING, no default value)
    - `jmxremote.port` : (Optional) Sets com.sun.management.jmxremote.port
        -(STRING, no default value)
    - `jmxremote.rmi.port` : (Optional) Sets com.sun.management.jmxremote.rmi.port
        - (STRING, no default value)
    - `jmxremote.ssl` : (Optional) Sets com.sun.management.jmxremote.ssl
        - (STRING, no default value)
    - `jmxremote.registry` .ssl: (Optional) Sets com.sun.management.jmxremote.registry.ssl
        - (STRING, no default value)
    - `jmxremote.authenticate` : (Optional) Sets com.sun.management.jmxremote.authenticate
        - (STRING, no default value)
    - `jmxremote.password.file` : (Optional) Sets com.sun.management.jmxremote.password.file
        - (STRING, no default value)
    - `jmxremote.access.file` : (Optional) Sets com.sun.management.jmxremote.acce ss.file
        - (STRING, no default value)
    - `jmxremote.login.config` : (Optional) Sets com.sun.management.jmxremote.log in.config
        - (STRING, no default value)
    - `jmxremote.ssl.enabled.cipher.suites` : (Optional) Sets com.sun.management.
    - `jmxremote.ssl.enabled.cipher.suite` : (STRING, no default value)
    - `jmxremote.ssl.enabled.protocols` : (Optional) Sets com.sun.management.jmxr emote.ssl.enabled.protocols
        - (STRING, no default value)
    - `jmxremote.ssl.need.client.auth` : (Optional) Sets com.sun.management.jmxre mote.need.client.auth
        - (STRING, no default value)
    - `jmxremote.ssl.config.file` : (Optional) Sets com.sun.management.jmxremote. ssl_config_file
        - (STRING, no default value)
    - `jmxremote.autodiscovery` : (Optional) Sets com.sun.management.jmxremote.au todiscovery
        - (STRING, no default value)
    - `jdp.port` : (Optional) Sets com.sun.management.jdp.port
        - (INT, no default value)
    - `jdp.address` : (Optional) Sets com.sun.management.jdp.address
        - (STRING, no default value)
    - `jdp.source_addr` : (Optional) Sets com.sun.management.jdp.source_addr
        - (STRING, no default value)
    - `jdp.ttl` : (Optional) Sets com.sun.management.jdp.ttl
        - (INT, no default value)
    - `jdp.pause` : (Optional) Sets com.sun.management.jdp.pause
        - (INT, no default value)
    - `jdp.name` : (Optional) Sets com.sun.management.jdp.name
        - (STRING, no default value)

`ManagementAgent.start_local`

- Starts the local management agent.
- _Impact: Low --- no impact_

`ManagementAgent.status`

- Print the management agent status.
- _Impact: Low --- no impact_
- _Permission: java.lang.management.ManagementPermission(monitor)_

`ManagementAgent.stop`

- Stops the remote management agent.
- _Impact: Low --- no impact_

### Thread

**`Thread.print [options]`**

- Prints all threads with stacktraces.
- _Impact: Medium --- depends on the number of threads._
- _Permission: java.lang.management.ManagementPermission(monitor)_
- _Note: The following options must be specified using either key or key=value syntax._
- options:
    - `-l` : (Optional) Prints java.util.concurrent locks
        - (BOOLEAN, false)

### VM

**`VM.classloader_stats`**

- Prints statistics about all ClassLoaders.
- _Impact: Low_
- _Permission: java.lang.management.ManagementPermission(monitor)_

**`VM.class_hierarchy [options] [arguments]`**

- Prints a list of all loaded classes, indented to show the class hierarchy.
    - The name of each class is followed by the `ClassLoaderData*` of its ClassLoader, or "null" if it is loaded by the bootstrap class loader.
- _Impact: Medium --- depends on the number of loaded classes._
- _Permission: java.lang.management.ManagementPermission(monitor)_
- _Note: The following options must be specified using either key or key=value syntax._
- options:
    - `-i` : (Optional) Inherited interfaces should be printed.
        - (BOOLEAN, false)
    - `-s` : (Optional) If a class name is specified, it prints the subclasses.
        - If the class name is not specified, only the superclasses are printed.
        - (BOOLEAN, false)
- arguments:
    - `classname` : (Optional) The name of the class whose hierarchy should be printed.
        - If not specified, all class hierarchies are printed.
        - (STRING, no default value)

`VM.command_line`

- Prints the command line used to start this VM instance.
- _Impact: Low_
- _Permission: java.lang.management.ManagementPermission(monitor)_

`VM.dynlibs`

- Prints the loaded dynamic libraries.
- _Impact: Low_
- _Permission: java.lang.management.ManagementPermission(monitor)_

**`VM.info`**

- Prints information about the JVM environment and status.
- _Impact: Low_
- _Permission: java.lang.management.ManagementPermission(monitor)_

`VM.log [options]`

- Lists current log configuration, enables/disables/configures a log output, or ro tates all logs.
- _Impact: Low_
- _Permission: java.lang.management.ManagementPermission(control)_
- options:
    - Note: The following options must be specified using either key or key=value syntax._
    - `output` : (Optional) The name or index (#) of output to configure.
        - (STRING, no default value)
    - output_options: (Optional) Options for the output.
        - (STRING, no default value)
    - `what` : (Optional) Configures what tags to log.
        - (STRING, no default value )
    - `decorators` : (Optional) Configures which decorators to use.
        - Use 'none' or an empty value to remove all.
        - (STRING, no default value)
    - `disable` : (Optional) Turns off all logging and clears the log configuration.
        - (BOOLEAN, no default value)
    - `list` : (Optional) Lists current log configuration.
        - (BOOLEAN, no default value)
    - `rotate` : (Optional) Rotates all logs.
        - (BOOLEAN, no default value)

**`VM.flags [options]`**

- Prints the VM flag options and their current values.
- _Impact: Low_
- Permission: java.lang.management.ManagementPermission(monitor)_
- _Note: The following options must be specified using either key or key=value syntax._
- options:
    - `-all` : (Optional) Prints all flags supported by the VM
        - (BOOLEAN, false).

`VM.native_memory [options]`

- Prints native memory usage
- _Impact: Medium_
- _Permission: java.lang.management.ManagementPermission(monitor)_
- _Note: The following options must be specified using either key or key=value syntax._
- options:
    - `summary` : (Optional) Requests runtime to report current memory summary, which includes total reserved and committed memory, along with memory usage summary by each subsystem.
        - (BOOLEAN, false)
    - `detail` : (Optional) Requests runtime to report memory allocation >= 1K by each callsite.
        - (BOOLEAN, false)
    - `baseline` : (Optional) Requests runtime to baseline current memory usage, so it can be compared against in later time.
        - (BOOLEAN, false)
    - `summary.diff` : (Optional) Requests runtime to report memory summary comparison against previous baseline.
        - (BOOLEAN, false)
    - `detail.diff` : (Optional) Requests runtime to report memory detail comparison against previous baseline, which shows the memory allocation activities at different callsites.
        - (BOOLEAN, false)
    - `shutdown` : (Optional) Requests runtime to shutdown itself and free the memory used by runtime.
        - (BOOLEAN, false)
    - `statistics` : (Optional) Prints tracker statistics for tuning purpose.
        - (BOOLEAN, false)
    - `scale` : (Optional) Memory usage in which scale, KB, MB or GB
        - (STRING, KB)

`VM.print_touched_methods`

- Prints all methods that have ever been touched during the lifetime of this JVM.
- _Impact: Medium --- depends on Java content._

**`VM.set_flag [arguments]`**

- Sets the VM flag option by using the provided value.
- _Impact: Low_
- _Permission: java.lang.management.ManagementPermission(control)_
- arguments:
    - `flag name` : The name of the flag that you want to set
        - (STRING, no default value)
    - `string value` : (Optional) The value that you want to set
        - (STRING, no default value)

`VM.stringtable [options]`

- Dumps the string table.
- _Impact: Medium --- depends on the Java content._
- _Permission: java.lang.management.ManagementPermission(monitor)_
- _Note: The following options must be specified using either key or key=value syntax._
- options:
    - `-verbose` : (Optional) Dumps the content of each string in the table
        - (BOOLEAN, false)

`VM.symboltable [options]`

- Dumps the symbol table.
- _Impact: Medium --- depends on the Java content._
- _Permission: java.lang.management.ManagementPermission(monitor)_
- _Note: The following options must be specified using either key or key=value syntax)._
- options:
    - `-verbose` : (Optional) Dumps the content of each symbol in the table
        - (BOOLEAN, false)

`VM.systemdictionary`

- Prints the statistics for dictionary hashtable sizes and bucket length.
- _Impact: Medium_
- _Permission: java.lang.management.ManagementPermission(monitor)_
- _Note: The following options must be specified using either key or key=value syntax._
- options:
    - `-verbose` : (Optional) Dump the content of each dictionary entry for all class loaders.
        - (BOOLEAN, false)

**`VM.system_properties`**

- Prints the system properties.
- _Impact: Low_
- _Permission: java.util.PropertyPermission(*, read)_

`VM.uptime [options]`

- Prints the VM uptime.
- _Impact: Low_
- _Note: The following options must be specified using either key or key=value syntax._
- options:
    - `-date` : (Optional) Adds a prefix with the current date
        - (BOOLEAN, false)

`VM.version`

- Prints JVM version information.
- _Impact: Low_
- _Permission: java.util.PropertyPermission(java.vm.version, read)_

## Usage

### Help

```bash
$ jcmd 581 help -all
581:
Compiler.CodeHeap_Analytics
	Print CodeHeap analytics

Compiler.codecache
	Print code cache layout and bounds.

Compiler.codelist
	Print all compiled methods in code cache that are alive

Compiler.directives_add
	Add compiler directives from file.

Compiler.directives_clear
	Remove all compiler directives.

Compiler.directives_print
	Print all active compiler directives.

Compiler.directives_remove
	Remove latest added compiler directive.

Compiler.queue
	Print methods queued for compilation.

GC.class_histogram
	Provide statistics about the Java heap usage.

GC.class_stats
	Provide statistics about Java class meta data.

GC.finalizer_info
	Provide information about Java finalization queue.

GC.heap_dump
	Generate a HPROF format dump of the Java heap.

GC.heap_info
	Provide generic Java heap information.

GC.run
	Call java.lang.System.gc().

GC.run_finalization
	Call java.lang.System.runFinalization().

JFR.check
	Checks running JFR recording(s)

JFR.configure
	Configure JFR

JFR.dump
	Copies contents of a JFR recording to file. Either the name or the recording id must be specified.

JFR.start
	Starts a new JFR recording

JFR.stop
	Stops a JFR recording

JVMTI.agent_load
	Load JVMTI native agent.

JVMTI.data_dump
	Signal the JVM to do a data-dump request for JVMTI.

ManagementAgent.start
	Start remote management agent.

ManagementAgent.start_local
	Start local management agent.

ManagementAgent.status
	Print the management agent status.

ManagementAgent.stop
	Stop remote management agent.

Thread.print
	Print all threads with stacktraces.

VM.class_hierarchy
	Print a list of all loaded classes, indented to show the class hiearchy. The name of each class is followed by the ClassLoaderData* of its ClassLoader, or "null" if loaded by the bootstrap class loader.

VM.classloader_stats
	Print statistics about all ClassLoaders.

VM.classloaders
	Prints classloader hierarchy.

VM.command_line
	Print the command line used to start this VM instance.

VM.dynlibs
	Print loaded dynamic libraries.

VM.flags
	Print VM flag options and their current values.

VM.info
	Print information about JVM environment and status.

VM.log
	Lists current log configuration, enables/disables/configures a log output, or rotates all logs.

VM.metaspace
	Prints the statistics for the metaspace

VM.native_memory
	Print native memory usage

VM.print_touched_methods
	Print all methods that have ever been touched during the lifetime of this JVM.

VM.set_flag
	Sets VM flag option using the provided value.

VM.stringtable
	Dump string table.

VM.symboltable
	Dump symbol table.

VM.system_properties
	Print system properties.

VM.systemdictionary
	Prints the statistics for dictionary hashtable sizes and bucket length

VM.uptime
	Print VM uptime.

VM.version
	Print JVM version information.

help
	For more information about a specific command use 'help <command>'. With no argument this will show a list of available commands. 'help all' will show help for all commands.
```

### VM

Class Loaders

```bash
$ 581:
+-- <bootstrap>
      |
      +-- jdk.internal.reflect.DelegatingClassLoader (+ 123 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader (+ 75 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 5 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 1 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 3 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 8 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 8 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 3 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader
      |
      +-- javax.management.remote.rmi.NoCallStackClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 8 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 4 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 6 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 10 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 13 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 5 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 14 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 12 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 1 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 37 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 12 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 4 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 11 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 1 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 47 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 3 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 69 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 3 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 5 more)
      |
      +-- com.intellij.ide.plugins.cl.PluginClassLoader
      |     |
      |     +-- jdk.internal.reflect.DelegatingClassLoader (+ 65 more)
      |
      +-- "platform", jdk.internal.loader.ClassLoaders$PlatformClassLoader
            |
            +-- "app", jdk.internal.loader.ClassLoaders$AppClassLoader
            |     |
            |     +-- sun.reflect.misc.MethodUtil
            |     |     |
            |     |     +-- jdk.internal.reflect.DelegatingClassLoader
            |     |
            |     +-- jdk.internal.reflect.DelegatingClassLoader
            |
            +-- com.intellij.util.lang.UrlClassLoader
                  |
                  +-- jdk.internal.reflect.DelegatingClassLoader (+ 495 more)
                  |
                  +-- java.net.URLClassLoader (+ 1 more)

```

Command Line

```bash
$ jcmd 581 VM.command_line
581:
VM Arguments:
jvm_args: -Xms128m -Xmx1024m -XX:ReservedCodeCacheSize=240m -XX:+UseCompressedOops -Dfile.encoding=UTF-8 -XX:+UseConcMarkSweepGC -XX:SoftRefLRUPolicyMSPerMB=50 -ea -XX:CICompilerCount=2 -Dsun.io.useCanonPrefixCache=false -Djava.net.preferIPv4Stack=true -Djdk.http.auth.tunneling.disabledSchemes="" -XX:+HeapDumpOnOutOfMemoryError -XX:-OmitStackTraceInFastThrow -Djdk.attach.allowAttachSelf -Dkotlinx.coroutines.debug=off -Xverify:none -XX:ErrorFile=/Users/mac/java_error_in_idea_%p.log -XX:HeapDumpPath=/Users/mac/java_error_in_idea.hprof -Djb.vmOptionsFile=/Users/mac/Library/Application Support/JetBrains/IntelliJIdea2020.1/idea.vmoptions -Didea.home.path=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents -Didea.executable=idea -Didea.paths.selector=IntelliJIdea2020.1 -Didea.vendor.name=JetBrains
java_command: <unknown>
java_class_path (initial): /Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/bootstrap.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/extensions.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/util.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/jdom.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/log4j.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/trove4j.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/jna.jar
Launcher Type: generic
```

Flags

```bash
$ jcmd 581 VM.flags
581:
-XX:-BytecodeVerificationLocal -XX:-BytecodeVerificationRemote -XX:CICompilerCount=2 -XX:ErrorFile=/Users/mac/java_error_in_idea_%p.log -XX:+HeapDumpOnOutOfMemoryError -XX:HeapDumpPath=/Users/mac/java_error_in_idea.hprof -XX:InitialHeapSize=134217728 -XX:MaxHeapSize=1073741824 -XX:MaxNewSize=348913664 -XX:MaxTenuringThreshold=6 -XX:MinHeapDeltaBytes=196608 -XX:NewSize=44695552 -XX:NonNMethodCodeHeapSize=5825164 -XX:NonProfiledCodeHeapSize=122916538 -XX:OldSize=89522176 -XX:-OmitStackTraceInFastThrow -XX:ProfiledCodeHeapSize=122916538 -XX:ReservedCodeCacheSize=251658240 -XX:+SegmentedCodeCache -XX:SoftRefLRUPolicyMSPerMB=50 -XX:+UseCompressedClassPointers -XX:+UseCompressedOops -XX:+UseConcMarkSweepGC -XX:+UseFastUnorderedTimeStamps
```

Metaspace

```bash
$ jcmd 581 VM.metaspace
581:

Total Usage - 11774 loaders, 67807 classes:
  Non-Class: 30216 chunks,   364.00 MB capacity,   353.02 MB ( 97%) used,     9.11 MB (  3%) free,    29.70 KB ( <1%) waste,     1.84 MB ( <1%) overhead, deallocated: 14291 blocks with 2.45 MB
      Class: 13429 chunks,    54.86 MB capacity,    48.11 MB ( 88%) used,     5.93 MB ( 11%) free,   472 bytes ( <1%) waste,   839.31 KB (  1%) overhead, deallocated: 1515 blocks with 515.08 KB
       Both: 43645 chunks,   418.85 MB capacity,   401.12 MB ( 96%) used,    15.03 MB (  4%) free,    30.16 KB ( <1%) waste,     2.66 MB ( <1%) overhead, deallocated: 15806 blocks with 2.96 MB


Virtual space:
  Non-class space:      366.00 MB reserved,     364.17 MB (>99%) committed
      Class space:        1.00 GB reserved,      54.95 MB (  5%) committed
             Both:        1.36 GB reserved,     419.12 MB ( 30%) committed



Chunk freelists:
   Non-Class:

 specialized chunks:    3, capacity 3.00 KB
       small chunks:   19, capacity 76.00 KB
      medium chunks: (none)
   humongous chunks: (none)
              Total:   22, capacity=79.00 KB
       Class:

 specialized chunks: (none)
       small chunks:   10, capacity 20.00 KB
      medium chunks: (none)
   humongous chunks: (none)
              Total:   10, capacity=20.00 KB

Waste (percentages refer to total committed size 419.12 MB):
              Committed unused:    172.00 KB ( <1%)
        Waste in chunks in use:     30.16 KB ( <1%)
         Free in chunks in use:     15.03 MB (  4%)
     Overhead in chunks in use:      2.66 MB ( <1%)
                In free chunks:     99.00 KB ( <1%)
Deallocated from chunks in use:      2.96 MB ( <1%) (15806 blocks)
                       -total-:     20.95 MB (  5%)


MaxMetaspaceSize: unlimited
CompressedClassSpaceSize: 1.00 GB

InitialBootClassLoaderMetaspaceSize: 4.00 MB

```

StringTable

```bash
$ jcmd 581 VM.stringtable
581:
StringTable statistics:
Number of buckets       :    131072 =   1048576 bytes, each 8
Number of entries       :    161848 =   2589568 bytes, each 16
Number of literals      :    161848 =  12364464 bytes, avg  76.396
Total footprsize_t         :           =  16002608 bytes
Average bucket size     :     1.235
Variance of bucket size :     1.239
Std. dev. of bucket size:     1.113
Maximum bucket size     :        10
```

SymbolTable

```bash
$ jcmd 581 VM.symboltable
581:
SymbolTable statistics:
Number of buckets       :     20011 =    160088 bytes, each 8
Number of entries       :    848159 =  20355816 bytes, each 24
Number of literals      :    848159 =  52737952 bytes, avg  62.179
Total footprint         :           =  73253856 bytes
Average bucket size     :    42.385
Variance of bucket size :    42.806
Std. dev. of bucket size:     6.543
Maximum bucket size     :        75
```

Uptime

```bash
$ jcmd 581 VM.uptime
581:
63217.613 s
```

Version

```bash
$ jcmd 581 VM.version
581:
OpenJDK 64-Bit Server VM version 11.0.7+10-b765.65
JDK 11.0.7
```