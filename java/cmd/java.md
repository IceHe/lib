# java

> Java application launcher

References

- `man java`
- Java SE 11 Docs - Tools References - `java` : https://docs.oracle.com/en/java/javase/11/tools/java.html

On Windows OS

- The `javaw` command is identical to `java`, _except that with javaw there's no associated console window._
- _Use `javaw` when you don't want a command prompt window to appear._
- _The javaw launcher will, however, display a dialog box with error information if a launch fails._

## Quickstart

- TODO

## Desription

- The `java` command **starts a Java application**.
    - It does this by starting the Java Runtime Environment (JRE), loading the specified class, and calling that class's `main()` method.
    - The method must be declared public and static, it must not return any value, and it must accept a String array as a parameter. The method declaration has the following form:
        - `public static void main(String[] args)`
- In source-file mode, the java command can launch a class declared in a source file.
    - _See "Using Source-File Mode to Launch Single-File Source-Code Programs" for a description of using the source-file mode._
- Note : You can use the `JDK_JAVA_OPTIONS` launcher environment variable to prepend its content to the actual command line of the java launcher.
    - See "Using the `JDK_JAVA_OPTIONS` Launcher Environment Variable".
- By default, the first argument that isn't an option of the `java` command is the fully qualified name of the class to be called.
    - If `-jar` is specified, then its argument is the name of the JAR file containing the class and resource files for the application.
    - **The startup class must be indicated by the `Main-Class` manifest header in its manifest file**.
- Arguments after the class file name or the JAR file name are passed to the `main()` method.

## Synopsis

To **launch a class file** :

- No required option

```bash
java [options] mainclass [args...]
```

To launch the main class **in a JAR file** :

- Required option : `-jar`

```bash
java [options] -jar jarfile [args...]
```

To launch the main class **in a module** :

- Required options : `-m` | `--module`

```bash
java [options] -m module[/mainclass] [args...]
# or
java [options] --module module[/mainclass] [args...]
```

To launch a single **source-file program** :

- No required option

```bash
java [options] source-file [args...]
```

---

`[options]`

- Optional : Specifies command-line options separated by spaces.
    - _See Overview of Java Options for a description of available options._

`mainclass`

- **Specifies the name of the class to be launched.**
    - _Command-line entries following classname are the arguments for the main method._

`-jar jarfile`

- **Executes a program encapsulated in a JAR file.**
    - The `jarfile` argument is the name of a JAR file with **a manifest that contains a line in the form `Main-Class:classname` that defines the class with the `public static void main(String[] args)` method that serves as your application's starting point**.
    - When you use `-jar`, the specified JAR file is the source of all user classes, and other class path settings are ignored.
    - _If you're using JAR files, then see `jar`._

`-m` or `--module module[/mainclass]`

- **Executes the main class in a module specified by `mainclass` if it is given**, or, if it is not given, the value in the module.
    - _In other words, `mainclass` can be used when it is not specified by the module, or to override the value when it is specified._
    - _See "Standard Options" for Java._

`source-file`

- **Specifies the source file that contains the main class when using source-file mode**.
    - Only used to launch a single source-file program.
    - _See "Using Source-File Mode to Launch Single-File Source-Code Programs"_

`[args...]`

- Optional : **Arguments** following `mainclass`, `source-file`, `-jar jarfile`, and `-m` or `--module module/mainclass` **are passed as arguments to the main class**.

**Using Source-File Mode to Launch Single-File Source-Code Programs**

- _Omitted details…_
- See https://docs.oracle.com/en/java/javase/11/tools/java.html#GUID-3B1CE181-CD30-4178-9602-230B800D4FAE

**Using the JDK_JAVA_OPTIONS Launcher Environment Variable**

- _Omitted details…_
- See https://docs.oracle.com/en/java/javase/11/tools/java.html#GUID-3B1CE181-CD30-4178-9602-230B800D4FAE

## Options

_The java command supports a wide range of options in the following categories :_

**Standard Options**

- Options **guaranteed to be supported by all implementations of the Java Virtual Machine (JVM)**.
- _They’re used for common actions, such as checking the version of the JRE, setting the class path, enabling verbose output, and so on._

**Extra Options**

- **General purpose options that are specific to the Java HotSpot Virtual Machine.**
- _They aren’t guaranteed to be supported by all JVM implementations, and are subject to change._
- These options start with `-X`.

**Advanced Options**

- _The advanced options aren’t recommended for casual use._
- These are **developer options used for tuning specific areas of the Java HotSpot Virtual Machine operation that often have specific system requirements** _and may require privileged access to system configuration parameters._
- _These options aren’t guaranteed to be supported by all JVM implementations and are subject to change._
- Advanced options start with `-XX`.
    - **Advanced Runtime Options**
        - Control the runtime behavior of the Java HotSpot VM.
    - **Advanced JIT Compiler Options**
        - Control the dynamic just-in-time (JIT) compilation performed by the Java HotSpot VM.
    - **Advanced Serviceability Options**
        - Enable gathering system information and performing extensive debugging.
    - **Advanced Garbage Collection Options**
        - Control how garbage collection (GC) is performed by the Java HotSpot

### Standard Options

These are the most commonly used options **supported by all implementations of the JVM**.

**`-agentlib:libname[=options]`**

- **Loads the specified native agent library**.
    - After the library name, a comma-separated list of options specific to the library can be used.
- _Oracle Solaris, Linux, and macOS :_
    - _If the option `-agentlib:foo` is specified, then the JVM attempts to load the library named `libfoo.so` in the location specified by the `LD_LIBRARY_PATH` system variable (on macOS this variable is `DYLD_LIBRARY_PATH`)._
- The following example shows **how to load the Java Debug Wire Protocol (JDWP) library and listen for the socket connection on port 8000, suspending the JVM before the main class loads** :
    - **`-agentlib:jdwp=transport=dt_socket,server=y,address=8000`**

`-agentpath:pathname[=options]`

- Loads the native agent library specified by the absolute path name.
    - This option is **equivalent to `-agentlib` but uses the full path and file name of the library**.

**`--class-path classpath, -classpath classpath`, or `-cp classpath`**

- A semicolon (`;`) separated list of directories, JAR archives, and ZIP archives to search for class files.
- Specifying classpath overrides any setting of the `CLASSPATH` environment variable.
    - If the class path option isn’t used and classpath isn’t set, then the user class path consists of the current directory (`.`).
- As a special convenience, a class path element that contains a base name of an asterisk (`*`) is considered equivalent to specifying a list of all the files in the directory with the extension `.jar` or `.JAR`.
    - _A Java program can’t tell the difference between the two invocations._
    - For example, if the directory `mydir` contains `a.jar` and `b.JAR`, then the class path element `mydir/*` is expanded to `a.jar:b.JAR`, except that the order of JAR files is unspecified.
    - All `.jar` files in the specified directory, even hidden ones, are included in the list.
    - A class path entry consisting of an asterisk (`*`) expands to a list of all the jar files in the current directory.
    - The `CLASSPATH` environment variable, where defined, is similarly expanded.
    - _Any class path wildcard expansion occurs before the Java VM is started._
    - _Java programs never see wildcards that aren’t expanded except by querying the environment, such as by calling `System.getenv("CLASSPATH")`._

_`--disable-@files`_

- _Can be used anywhere on the command line, including in an argument file, to **prevent further `@filename` expansion**._
    - _This option stops expanding `@-argfiles` after the option._

_`--enable-preview`_

- _Allows classes to depend on preview features of the release._

_`--module-path modulepath...` or `-p modulepath`_

- _A semicolon (`;`) separated list of directories in which each directory is a directory of modules._

_`--upgrade-module-path modulepath...`_

- _A semicolon (`;`) separated list of directories in which each directory is a directory of modules that replace upgradeable modules in the runtime image._

_`--add-modules module[,module...]`_

- _Specifies the **root modules to resolve in addition to the initial module**._
    - _`module` also can be `ALL-DEFAULT`, `ALL-SYSTEM`, and `ALL-MODULE-PATH`._

_`--list-modules`_

- _Lists the observable modules and then exits._

_`-d module name` or `--describe-module module_name`_

- _Describes a specified module and then exits._

**`--dry-run`**

- _**Creates the VM but doesn’t execute the main method.**_
    - _This `--dry-run` option might be useful for validating the command-line options such as the module system configuration._

_`--validate-modules`_

- _Validates all modules and exits._
    - _This option is helpful for finding conflicts and other errors with modules on the module path._

**`-Dproperty=value`**

- **Sets a system property value.**
    - _The property variable is a string with no spaces that represents the name of the property._
    - _The value variable is a string that represents the value of the property._
    - _If value is a string with spaces, then enclose it in quotation marks ( for example `-Dfoo="foo bar"` ) ._

_`-disableassertions[:[packagename]...|:classname]` or `-da[:[packagename]...|:classname]`_

- **Disables assertions.**
    - By default, assertions are disabled in all packages and classes.
    - _With no arguments, `-disableassertions` (`-da`) disables assertions in all packages and classes._
    - _With the packagename argument ending in `..., the switch disables assertions in the specified package and any subpackages._
    - _If the argument is simply `...`, then the switch disables assertions in the unnamed package in the current working directory._
    - _With the classname argument, the switch disables assertions in the specified class._
- The `-disableassertions` (`-da`) option applies to all class loaders and to system classes (which don’t have a class loader).
    - _There’s one exception to this rule :_
        - _If the option is provided with no arguments, then it doesn’t apply to system classes._
    - _This makes it easy to disable assertions in all classes except for system classes._
    - _The `-disablesystemassertions` option enables you to disable assertions in all system classes._
    - _To explicitly enable assertions in specific packages or classes, use the `-enableassertions` (`-ea`) option._
    - _Both options can be used at the same time._
    - For example, to run the MyClass application with assertions enabled in the package `com.wombat.fruitbat` (and any subpackages) but disabled in the class `com.wombat.fruitbat.Brickbat`, use the following command:
        - `java -ea:com.wombat.fruitbat... -da:com.wombat.fruitbat.Brickbat MyClass`

_`-disablesystemassertions` or `-dsa`_

- _Disables assertions in all system classes._

_`-enableassertions[:[packagename]...|:classname]` or `-ea[:[packagename]...|:classname]`_

- _**Enables assertions.**_
    - _It's the opposite of `-disableassertions`_

_`-enablesystemassertions` or `-esa`_

- _Enables assertions in all system classes._

_`-help`, `-h`, or `-?`_

- _Prints the help message to the error stream._

_`--help`_

- _Prints the help message to the output stream._

_`-javaagent:jarpath[=options]`_

- _Loads the specified Java programming language agent._

_`--show-version`_

- _Prints the product version to the output stream and continues._

_`-showversion`_

- _Prints the product version to the error stream and continues._

_`--show-module-resolution`_

- _Shows module resolution output during startup._

_`-splash:imagepath`_

- _Shows the splash screen with the image specified by imagepath._
    - _HiDPI scaled images are automatically supported and used if available._
    - _The unscaled image file name, such as `image.ext`, should always be passed as the argument to the `-splash` option._
    - _The most appropriate scaled image provided is picked up automatically._
- _For example, to show the `splash.gif` file from the images directory when starting your application, use the following option:_
    - _`-splash:images/splash.gif`_
- _See the SplashScreen API documentation for more information._

**`-verbose:class`**

- **Displays** information about **each loaded class.**

**`-verbose:gc`**

- **Displays** information about **each garbage collection (GC) event.**

`-verbose:jni`

- **Displays** information about the **use of native methods** and other Java Native Interface (JNI) activity.

`-verbose:module`

- **Displays** information about **the modules in use**.

`--version`

- Prints product version to the **error stream** and exits.

`-version`

- Prints product version to the **output stream** and exits.

**`-X`**

- **Prints the help on extra options** to the **error stream**.

**`--help-extra`**

- **Prints the help on extra options** to the **output stream**.

**`@argfile`**

- **Specifies one or more argument files prefixed by `@` used by the java command.**
    - It isn’t uncommon for the java command line to be very long because of the `.jar` files needed in the classpath.
    - The `@argfile` option **overcomes command-line length limitations** by enabling the launcher to expand the contents of argument files after shell expansion, but before argument processing.
    - Contents in the argument files are expanded because otherwise, they would be specified on the command line until the `-Xdisable-@files` option was encountered.
- The argument files **can also contain the main class name and all options.**
    - If an argument file contains all of the options required by the java command, then the command line could simply be : `java @argfile`

### Extra Options

These are general purpose options that are **specific to the Java HotSpot Virtual Machine**.

_`-Xbatch`_

- _**Disables background compilation.**_
    - _By default, the JVM compiles the method as a background task, running the method in interpreter mode until the background compilation is finished._
    - _The `-Xbatch` flag disables background compilation so that compilation of all methods proceeds as a foreground task until completed._
    - _This option is equivalent to `-XX:-BackgroundCompilation`._

_`-Xbootclasspath/a:directories|zip|JAR-files`_

- _**Specifies a list of directories, JAR files, and ZIP archives to append to the end of the default bootstrap class path**._
- _Oracle Solaris, Linux, and macOS : Colons (`:`) separate entities in this list._
- _Windows : Semicolons (`;`) separate entities in this list._

_`-Xcheck:jni`_

- _Performs additional checks for Java Native Interface (JNI) functions._
    - _Specifically, it validates the parameters passed to the JNI function and the runtime environment data before processing the JNI request._
    - _It also checks for pending exceptions between JNI calls._
    - _Any invalid data encountered indicates a problem in the native code, and the JVM terminates with an irrecoverable error in such cases._
    - _Expect a performance degradation when this option is used._

**`-Xcomp`**

- **Forces compilation of methods on first invocation.**
    - **By default, the Client VM (`-client`) performs 1,000 interpreted method invocations and the Server VM (`-server`) performs 10,000 interpreted method invocations to gather information for efficient compilation.**
    - Specifying the `-Xcomp` option disables interpreted method invocations to increase compilation performance at the expense of efficiency.
    - You can also change the number of interpreted method invocations before compilation by using the `-XX:CompileThreshold` option.

`-Xdebug`

- **Does nothing**. Provided for backward compatibility.

`-Xdiag`

- Shows additional diagnostic messages.

`-Xfuture`

- Enables strict class-file format checks that enforce close conformance to the class-file format specification.
    - Developers should use this flag when developing new code.
    - Stricter checks may become the default in future releases.

**`-Xint`**

- **Runs the application in interpreted-only mode.**
    - Compilation to native code is disabled, and all bytecode is executed by the interpreter.
    - _The performance benefits offered by the just-in-time (JIT) compiler aren’t present in this mode._

_`-Xinternalversion`_

- _Displays more detailed JVM version information than the `-version option`, and then exits._

**`-Xloggc:option`**

- **Enables the JVM unified logging framework.**
    - Logs GC status to a file with time stamps.

**`-Xlog:option`**

- **Configure or enable logging with the Java Virtual Machine (JVM) unified logging framework.**
    - See "Enable Logging with the JVM Unified Logging Framework".

`-Xmixed`

- Executes all bytecode by the interpreter except for hot methods, which are compiled to native code.

**`-Xmn size`**

- Sets the **initial and maximum size (in bytes) of the heap for the young generation (nursery).**
    - _Append the letter k or K to indicate kilobytes, m or M to indicate megabytes, or g or G to indicate gigabytes._
    - _The young generation region of the heap is used for new objects._
        - _GC is performed in this region more often than in other regions._
        - _If the size for the young generation is too small, then a lot of minor garbage collections are performed._
        - _If the size is too large, then only full garbage collections are performed, which can take a long time to complete._
    - Oracle recommends that you keep the size for the young generation greater than 25% and less than 50% of the overall heap size.
    - _The following examples show how to set the initial and maximum size of young generation to 256 MB using various units :_

```bash
-Xmn256m
-Xmn262144k
-Xmn268435456
```

- Instead of the `-Xmn` option to set both the initial and maximum size of the heap for the young generation, you can use `-XX:NewSize` to set the initial size and `-XX:MaxNewSize` to set the maximum size.

**`-Xms size`**

- Sets the **initial size (in bytes) of the heap.**
    - If you don't set this option, then the initial size is set as the sum of the sizes allocated for the old generation and the young generation.
    - The initial size of the heap for the young generation can be set by using the -Xmn option or the -XX:NewSize option.

**`-Xmx size`**

- Specifies **the maximum size (in bytes) of the memory allocation pool in bytes.**
    - _The default value is chosen at runtime based on system configuration._
    - For server deployments, **`-Xms` and `-Xmx` are often set to the same value.**
- The `-Xmx` option is equivalent to `-XX:MaxHeapSize`.

`-Xnoclassgc`

- **Disables garbage collection (GC) of classes.**
    - This can save some GC time, which shortens interruptions during the application run.
    - When you specify `-Xnoclassgc` at startup, the **class objects in the application are left untouched during GC and are always considered live.**
    - This can result in more memory being permanently occupied which, if not used carefully, throws an out-of-memory exception.

`-Xrs`

- **Reduces the use of operating system signals by the JVM.**
    - Shutdown hooks enable the orderly shutdown of a Java application by running user cleanup code (such as closing database connections) at shutdown, even if the JVM terminates abruptly.
- Oracle Solaris, Linux, and macOS:
    - The JVM catches signals to implement shutdown hooks for unexpected termination.
        - The JVM uses `SIGHUP`, `SIGINT`, and `SIGTERM` to initiate the running of shutdown hooks.
    - Applications embedding the JVM frequently need to trap signals such as `SIGINT` or `SIGTERM`, which can lead to interference with the JVM signal handlers.
        - The `-Xrs` option is available to address this issue.
        - When `-Xrs` is used, the signal masks for `SIGINT`, `SIGTERM`, `SIGHUP`, and `SIGQUIT` aren’t changed by the JVM, and signal handlers for these signals aren’t installed.
- Windows:
    - _omitted…_
- _There are two consequences of specifying `-Xrs` :_
    - Oracle Solaris, Linux, and macOS : **SIGQUIT thread dumps aren’t available.**
    - _Windows : Ctrl + Break thread dumps aren’t available._
- User code is responsible for causing shutdown hooks to run, for example, by calling the `System.exit()` when the JVM is to be terminated.

_`-Xshare:mode`_

- **Sets the class data sharing (CDS) mode.**
- _Possible mode arguments for this option include the following:_
    - _`auto` Uses CDS if possible._
        - _This is the default value for Java HotSpot 32-Bit Client VM._
    - _`on` Requires the use of CDS._
        - _This option prints an error message and exits if class data sharing can’t be used._
    - _`off` Instructs not to use CDS._
- _Note : **`-Xshare:on` is used for testing purposes only and can cause intermittent failures due to the use of address space layout randomization by the operation system.**_
    - _This option should **not be used in production environments.**_

_`-XshowSettings`_

- _Shows all settings and then continues._

_`-XshowSettings:category`_

- _**Shows settings and continues.**_
- _Possible category arguments for this option include the following:_
    - _`all` Shows all categories of settings. This is the default value._
    - _`locale` Shows settings related to locale._
    - _`properties` Shows settings related to system properties._
    - _`vm` Shows the settings of the JVM._
    - _`system` Linux : Shows host system or container configuration and continues._

**`-Xss size`**

- Sets **the thread stack size (in bytes).**
    - The default value depends on the platform:
        - Linux/x64 (64-bit) : 1024 KB
        - macOS (64-bit) : 1024 KB
        - Oracle Solaris/x64 (64-bit) : 1024 KB
        - Windows : The default value depends on virtual memory
- This option is similar to `-XX:ThreadStackSize`.

_`--add-reads module=target-module(,target-module)*`_

- _Updates module to read the target-module, regardless of the module declaration._
    - _`target-module` can be all unnamed to read all unnamed modules._

_`--add-exports module/package=target-module(,target-module)*`_

- _Updates module to export package to target-module, regardless of module declaration._
    - _The target-module can be all unnamed to export to all unnamed modules._

_`--add-opens module/package=target-module(,target-module)*`_

- _Updates module to open package to target-module, regardless of module declaration._

~~`--illegal-access=parameter`~~

- _Note : This option will be removed in a future release._
- _omitted…_

_`--limit-modules module[,module...]`_

- _Specifies the limit of the universe of observable modules._

_`--patch-module module=file(;file)*`_

- _Overrides or augments a module with classes and resources in JAR files or directories._

_`--disable-@files`_

- _Can be used anywhere on the command line, including in an argument file, to prevent further `@filename` expansion._
    - _This option stops expanding `@-argfiles` after the option._

`--source version`

- Sets the version of the source in source-file mode.

> Extra Options for macOS

_The following extra options are macOS-specific._

_`-XstartOnFirstThread`_

- _Runs the `main()` method on the first (AppKit) thread._

_`-Xdock:name=application_name`_

- _Overrides the default application name displayed in dock._

_`-Xdock:icon=path_to_icon_file`_

- _Overrides the default icon displayed in dock._

### Advanced Options

## Usage
