# javac

> Java compiler

References

- `man javac`
- Java SE 11 Docs - Tools References - `javac` : https://docs.oracle.com/en/java/javase/11/tools/javac.html

## Quickstart

Synopsis

```bash
javac [ options ] [ sourcefiles ] [ @argfiles ]
```

- `sourcefiles` One or more source files to be compiled (such as `MyClass.java`)
    - or processed for annotations (such as `MyPackage.MyClass`).
- `@argfiles` One or more files that list source files.
    -The `-J` options are not allowed in these files.

Description

- The javac command reads class and interface definitions, written in the Java programming language, and compiles them into bytecode class files.
    - The javac command can also process annotations in Java source files and classes.
- A launcher environment variable, `JDK_JAVAC_OPTIONS`, was introduced in JDK 9 that prepended its content to the command line to `javac`.
    - See "Using JDK_JAVAC_OPTIONS Environment Variable".

## Options

### Standard

**`@filename`**

- **Reads options and file names from a file.**
    - To shorten or simplify the javac command, you can specify one or more files that contain arguments to the javac command (except `-J` options).
    - This lets you to create `javac` commands of any length on any operating system.
    - See "javac Command-Line Argument Files".

`-Akey[=value]`

- Specifies **options to pass to annotation processors.**
    - These options aren’t interpreted by `javac` directly, but are made available for use by individual processors.
    - The key value should be one or more identifiers separated by a dot (`.`).

`--add-modules module,module`

- Specifies **root modules to resolve in addition to the initial modules**, or all modules on the module path if `module` is `ALL-MODULE-PATH`.

**`--boot-class-path path` or `-bootclasspath path`**

- **Overrides the location of the bootstrap class files.**
- Note:This can only be used when compiling for versions prior to JDK 9.
    - As applicable, see the descriptions in --release, -source, or -target for details.

**`--class-path path, -classpath path, or -cp path`**

- Specifies **where to find user class files and annotation processors.**
- This class path overrides the user class path in the CLASSPATH environment variable.
    - If `--class-path`, `-classpath`, or `-cp` aren’t specified, then the user class path is the current directory.
    - If the `-sourcepath` option isn’t specified, then the user class path is also searched for source files.
    - If the `-processorpath` option isn’t specified, then the class path is also searched for annotation processors.

`-d directory`

- Sets the **destination directory for class files.**
    - If a class is part of a package, then `javac` puts the class file in a subdirectory that reflects the package name and creates directories as needed.
    - For example:
        - Oracle Solaris, Linux, and macOS : If you specify `-d /home/myclasses` and the class is called `com.mypackage.MyClass`, then the class file is `/home/myclasses/com/mypackage/MyClass.class`.
- If the `-d` option isn’t specified, then `javac` puts each class file in the same directory as the source file from which it was generated.
    - Note : The directory specified by the -d option isn’t automatically added to your user class path.

`-deprecation`

- Shows a **description of each use or override of a deprecated member or class.**
    - Without the `-deprecation` option, javac shows a summary of the source files that use or override deprecated members or classes.
    - The `-deprecation` option is shorthand for -Xlint:deprecation.

`--enable-preview`

- Enables **preview language features.**
    - Used in conjunction with either `-source` or `--release`.

`-encoding encoding`

- Specifies **character encoding used by source files, such as EUC-JP and UTF-8.**
    - If the `-encoding` option isn’t specified, then the platform default encoding is used.

`-endorseddirs directories`

- Overrides the **location of the endorsed standards path.**
    - Note : This can only be used when compiling for versions prior to JDK 9.
    - As applicable, see the descriptions in --release, -source, or -target for details.

`-extdirs directories`

- Overrides the **location of the installed extensions.**
    - The directories variable is a colon-separated list of directories.
    - Each JAR file in the specified directories is searched for class files.
    - All JAR files found become part of the class path.
- If you are cross-compiling, then this option specifies the directories that contain the extension classes.
    - See "Cross-Compilation Options" for javac.
- Note : This can only be used when compiling for versions prior to JDK 9.
    - As applicable, see the descriptions in `--release`, `-source`, or `-target` for details.

**`-g`**

- **Generates all debugging information, including local variables.**
    - By default, only line number and source file information is generated.

**`-g:[lines, vars, source]`**

- **Generates only the kinds of debugging information specified by the comma-separated list of keywords.**
- Valid keywords are:
    - `lines` Line number debugging information.
    - `vars` Local variable debugging information.
    - `source` Source file debugging information.

**`-g:none`**

- Doesn’t generate debugging information.

`-h directory`

- Specifies **where to place generated native header files.**
    - When you specify this option, a native header file is generated for each class that contains native methods or that has one or more constants annotated with the `java.lang. annotation.Native` annotation.
    - If the class is part of a package, then the compiler puts the native header file in a subdirectory that reflects the package name and creates directories as needed.

`--help`, `–help` or `-?`

- Prints a **synopsis of the standard options.**

`--help-extra` or `-X`

- Prints the **help for extra options.**

**`-implicit:[none, class]`**

- Specifies **whether or not to generate class files for implicitly referenced files:**
    - `-implicit:class` — Automatically generates class files.
    - `-implicit:none` — Suppresses class file generation.
- If this option isn’t specified, then the default automatically generates class files.
    - In this case, the compiler issues a warning if any class files are generated when also doing annotation processing.
    - The warning isn’t issued when the -implicit option is explicitly set.
    - See Searching for Types.

**`-Joption`**

- **Passes option to the runtime system**, where option is one of the Java **options described on `java` command**.
    - For example, `-J-Xms48m` sets the startup memory to 48 MB.
- Note : The `CLASSPATH` environment variable, `-classpath` option, `-bootclasspath` option, and `-extdirs` option don’t specify the classes used to run `javac`.
    - Trying to customize the compiler implementation with these options and variables is risky and often doesn’t accomplish what you want.
    - If you must customize the complier implementation, then use the `-J` option to pass options through to the underlying Java launcher.

`--limit-modules module,module*`

- **Limits the universe of observable modules.**

`--module module-name` or `-m module-name`

- **Compiles only the specified module and checks time stamps.**

`--module-path path` or `-p path`

- Specifies **where to find application modules.**

`--module-source-path module-source-path`

- Specifies **where to find input source files for multiple modules.**

`--module-version version`

- Specifies the **version of modules that are being compiled.**

`-nowarn`

- **Disables warning messages.**
    - This option operates the same as the `-Xlint:none` option.

**`-parameters`**

- **Generates metadata for reflection on method parameters.**
    - Stores formal parameter names of constructors and methods in the generated class file so that the method `java.lang.reflect.Executable.getParameters` from the Reflection API can retrieve them.

`-proc:[none, only]`

- Controls **whether annotation processing and compilation are done.**
    - `-proc:none` means that compilation takes place without annotation processing.
    - `-proc:only` means that only annotation processing is done, without any subsequent compilation.

_`-processor class1[,class2,class3...]`_

- **Names of the annotation processors to run.**
    - This bypasses the default discovery process.

_`--processor-module-path path`_

- Specifies the **module path used for finding annotation processors.**

_`--processor-path path` or `-processorpath path`_

- Specifies where to find annotation processors.
    - If this option isn’t used, then the class path is searched for processors.

**`-profile profile`**

- **Checks that the API used is available in the specified profile.**
- Note : This can only be used when compiling for versions prior to JDK 9.
    - As applicable, see the descriptions in --release, -source, or -target for details.

`--release release`

- **Compiles against the public, supported and documented API for a specific VM version.**
    - Supported release targets are 6, 7, 8, 9, 10, and 11.
- Note:When using `--release` for a version of the Java Platform that supports modules, you can’t use `--add-modules` to access internal JDK modules, nor can you use `--add-exports` to access internal JDK APIs in the modules.

`-s directory`

- Specifies the **directory used to place the generated source files.**
    - If a class is part of a package, then the compiler puts the source file in a subdirectory that reflects the package name and creates directories as needed.
- For example:
    Oracle Solaris, Linux, and macOS : If you specify `-s /home/mysrc` and the class is called `com.mypackage.MyClass`, then the source file is put in `/home/mysrc/com/mypackage/MyClass.java`.

`-source release`

- Specifies the **version of source code accepted.**
    - The following values for release are allowed:
- Note : Beginning with JDK 9, javac no longer supports `-source` release settings less than or equal to 5.
    - If settings less than or equal to 5 are used, then the javac command behaves as if -source 6 were specified.
        - `1.6` No language changes were introduced in Java SE 6.
            - However, encoding errors in source files are now reported as errors instead of warnings as was done in earlier releases of Java Platform, Standard Edition.

6
Synonym for 1.6.

1.7
The compiler accepts code with features introduced in Java SE 7.

7
Synonym for 1.7.

1.8
The compiler accepts code with features introduced in Java SE 8.

8
Synonym for 1.8.

9
The compiler accepts code with features introduced in Java SE 9.

10
The compiler accepts code with features introduced in Java SE 10.

11
The default value. The compiler accepts code with features introduced in Java SE 11.

--source-path path or -sourcepath path
Specifies where to find input source files. This is the source code path used to search for class or interface definitions. As with the user class path, source path entries are separated by colons (:) on Oracle Solaris, Linux, and macOS and semicolons (;) on Windows. They can be directories, JAR archives, or ZIP archives. If packages are used, then the local path name within the directory or archive must reflect the package name.

Note:Classes found through the class path might be recompiled when their source files are also found. See Searching for Types.
--system jdk | none
Overrides the location of system modules.

-target release
Generates class files for a specific VM version.

--upgrade-module—path path
Overrides the location of upgradeable modules.

-verbose
Outputs messages about what the compiler is doing. Messages include information about each class loaded and each source file compiled.

--version or -version
Prints version information.

-Werror
Terminates compilation when warnings occur.

### Cross-Compilation

### Extra

## Usage
