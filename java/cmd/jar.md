# jar

> Java archive tool

- Create an archive for classes and resources, and to manipulate or restore individual classes or resources from an archive.

References

- `man jar`
- Java SE 11 Docs - Tools References - `jar` : https://docs.oracle.com/en/java/javase/11/tools/jar.html

## Synopsis

```bash
jar [OPTION...] [ [--release VERSION] [-C dir] files] ...
```

- on macOS _( BSD )_

```bash
# Create jar file
jar c[v0M]f jarfile [ -C dir ] inputfiles [ -Joption ]
jar c[v0]mf manifest jarfile [ -C dir ] inputfiles [ -Joption ]
jar c[v0M] [ -C dir ] inputfiles [ -Joption ]
jar c[v0]m manifest [ -C dir ] inputfiles [ -Joption ]

# Update jar file
jar u[v0M]f jarfile [ -C dir ] inputfiles [ -Joption ]
jar u[v0]mf manifest jarfile [ -C dir ] inputfiles [ -Joption ]
jar u[v0M] [ -C dir ] inputfiles [ -Joption ]
jar u[v0]m manifest [ -C dir ] inputfiles [ -Joption ]

# Extract jar file
jar x[v]f jarfile [ inputfiles ] [ -Joption ]
jar x[v] [ inputfiles ] [ -Joption ]

# List table of contents of jar file
jar t[v]f jarfile [ inputfiles ] [ -Joption ]
jar t[v] [ inputfiles ] [ -Joption ]

# Add index to jar file
jar i jarfile [ -Joption ]
```

## Description

- The `jar` command is a general-purpose archiving and compression tool, based on the ZIP and ZLIB compression formats.
    - Initially, the `jar` command was **designed to package Java applets (not supported since JDK 11) or applications**; however, beginning with JDK 9, users can use the `jar` command to create modular JARs.
    - For transportation and deployment, it’s usually more convenient to package modules as modular JARs.
- The syntax for the jar command resembles the syntax for the tar command.
    - It has several main operation modes, defined by one of the mandatory operation arguments.
    - Other arguments are either options that modify the behavior of the operation or are required to perform the operation.
- When modules or the components of an application (files, images, and sounds) are combined into a single archive, they can be downloaded by a Java agent (such as a browser) in a single HTTP transaction, rather than requiring a new connection for each piece.
    - This dramatically improves download times.
    - The `jar` command also compresses files, which further improves download time.
    - The `jar` command also enables individual entries in a file to be signed so that their origin can be authenticated.
    - A JAR file can be used as a class path entry, whether or not it’s compressed.
- An archive becomes a modular JAR when you include a module descriptor, `module-info.class`, in the root of the given directories or in the root of the JAR archive.
    - The following operations described in "Operation Modifiers Valid Only in Create and Update Modes" are valid only when creating or updating a modular JAR or updating an existing non-modular JAR:
        - `--module-version`
        - `--hash-modules`
        - `--module-path`

## Options

### Main Operation Modes

When using the `jar` command, you **must specify the operation for it to perform.**

- You specify the operation mode for the `jar` command by including the appropriate operation arguments described in this section.
- You can mix an operation argument with other one-letter options.
- **Generally the operation argument is the first argument specified on the command line.**

**`-c` or `--create`**

- **Creates the archive.**

`-i=FILE` or `--generate-index=FILE`

- Generates **index information for the specified JAR file.**

**`-t` or `--list`**

- Lists the **table of contents for the archive.**

**`-u` or `--update`**

- **Updates an existing JAR file.**

**`-x` or `--extract`**

- **Extracts the named (or all) files from the archive.**

`-d or --describe-module`

- Prints the module descriptor or automatic module name.

### Operation Modifiers Valid in Any Mode

_You can use the following options to customize the actions of any operation mode included in the `jar` command._

`-C DIR`

- **Changes the specified directory and includes the files** specified at the end of the command line.

```bash
jar [OPTION...] [ [--release VERSION] [-C dir] files]
```

**`-f=FILE` or `--file=FILE`**

- **Specifies the archive file name.**

`--release VERSION`

- **Creates a multirelease JAR file.**
    - Places all files specified after the option into a versioned directory of the JAR file named `META-INF/versions/VERSION/`, where `VERSION` must be must be a positive integer whose value is 9 or greater.
- At run time, where more than one version of a class exists in the JAR, the JDK will use the first one it finds, searching initially in the directory tree whose VERSION number matches the JDK's major version number.
    - It will then look in directories with successively lower VERSION numbers, and finally look in the root of the JAR.

`-v` or `--verbose`

- Sends or prints verbose output to standard output.

### Operation Modifiers Valid Only in Create and Update Modes

_You can use the following options to customize the actions of the create and the update main operation modes :_

**`-e=CLASSNAME` or `--main-class=CLASSNAME`**

- **Specifies the application entry point for standalone applications** bundled into a modular or executable modular `JAR` file.

`-m=FILE` or `--manifest=FILE`

- Includes the manifest information from the given manifest file.

`-M` or `--no-manifest`

- Doesn’t create a manifest file for the entries.

`--module-version=VERSION`

- Specifies the module version, when creating or updating a modular JAR file, or updating a non-modular JAR file.

`--hash-modules=PATTERN`

- Computes and records the hashes of modules matched by the given pattern and that depend upon directly or indirectly on a modular JAR file being created or a non-modular JAR file being updated.

`-p path` or `--module-path path`

- Specifies the location of module dependence for generating the hash.

**`@file`**

- **Reads jar options and file names from a text file.**

### Operation Modifiers Valid Only in Create, Update, and Generate-index Modes

You can use the following options to customize the actions of the create (`-c` or `--create`) the update (`-u` or `--update`) and the generate-index (`-i` or `--generate-index=FILE`) main operation modes:

`-0` or `--no-compress`

- Stores without using ZIP compression.

## Usage

Examples of jar Command Syntax

**Create** an archive, `classes.jar`, that **contains two class files, `Foo.class` and `Bar.class`.**

```bash
jar --create --file classes.jar \
    Foo.class Bar.class
```

**Create** an archive, `classes.jar`, by using an existing manifest, mymanifest, that **contains all of the files in the directory `foo/`.**

```bash
jar --create --file classes.jar \
    --manifest mymanifest
    -C foo/
```

**Create** a modular JAR archive, `foo.jar`, where the **module descriptor is located in `classes/module-info.class`.**

```bash
jar --create --file foo.jar \
    --main-class com.foo.Main \
    --module-version 1.0 \
    -C foo/classes resources
```

**Update** an existing non-modular JAR, `foo.jar`, to a **modular JAR file.**

```bash
jar --update --file foo.jar \
    --main-class com.foo.Main \
    --module-version 1.0 \
    -C foo/module-info.class
```

**Create** a **versioned or multi-release JAR**, `foo.jar`, that **places the files in the classes directory at the root of the JAR**, and the **files in the classes-10 directory in the `META-INF/versions/10` directory of the JAR**.

- In this example, the `classes/com/foo` directory contains two classes, `com.foo.Hello` (the entry point class) and `com.foo.NameProvider`, both compiled for JDK 8.
    - The `classes-10/com/foo` directory contains a different version of the `com.foo.NameProvider` class, this one containing JDK 10 specific code and compiled for JDK 10.
- Given this setup, **create a multirelease JAR file `foo.jar`** by running the following command **from the directory containing the directories `classes` and `classes-10`.**

```bash
jar --create --file foo.jar \
    --main-class com.foo.Hello \
    -C classes . \
    --release 10 \
    -C classes-10 .
```

- The JAR file `foo.jar` now contains:

```bash
% jar -tf foo.jar

META-INF/
META-INF/MANIFEST.MF
com/
com/foo/
com/foo/Hello.class
com/foo/NameProvider.class
META-INF/versions/10/com/
META-INF/versions/10/com/foo/
META-INF/versions/10/com/foo/NameProvider.class
```

- As well as other information, the file `META-INF/MANIFEST.MF`, will contain the following lines to indicate that this is a multirelease JAR file with an entry point of `com.foo.Hello`.

```bash
...
Main-Class: com.foo.Hello
Multi-Release: true
```

- Assuming that the `com.foo.Hello` class calls a method on the `com.foo.NameProvider` class, running the program using JDK 10 will ensure that the `com.foo.NameProvider` class is the one in `META-INF/versions/10/com/foo/`.
    - Running the program using JDK 8 will ensure that the `com.foo.NameProvider` class is the one at the root of the JAR, in `com/foo`.

**Create** an archive, `my.jar`, **by reading options and lists of class files from the file `classes.list`.**

- _Note : To shorten or simplify the jar command, you can specify arguments in a separate text file and pass it to the jar command with the at sign (`@`) as a prefix._

```bash
jar --create --file my.jar @classes.list
```
