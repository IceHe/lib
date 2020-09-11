# javap

> Java class file disassembler

References

- `man javap`
- Java SE 11 Docs - Tools References - `javap` : https://docs.oracle.com/en/java/javase/11/tools/javap.html#GUID-BE20562C-912A-4F91-85CF-24909F212D7F

## Quickstart

Synopsis

```bash
javap [options] classes...
```

- `classes` Specifies **one or more classes separated by spaces to be processed for annotations.**
    - You can specify a class that can be found in the class path by its file name, URL, or by its fully qualified class name.
- Examples:
    - `path/to/MyClass.class`
    - `jar:file:///path/to/MyJar.jar!/mypkg/MyClass.class`
    - `java.lang.Object`

Description

- The `javap` command **disassembles one or more class files**.
    - When no options are used, the javap command prints the protected and public fields, and methods of the classes passed to it.
- The `javap` command isn’t multirelease `JAR` aware.
    - Using the class path form of the command results in viewing the base entry in all `JAR` files, multirelease or not.
    - Using the URL form, you can use the URL form of an argument to specify a specific version of a class to be disassembled.
- The `javap` command prints its output to `stdout`.
- Note : In tools that support double hyphen (`--`) style options, the GNU-style options can use the equal sign (`=`) instead of a white space to separate the name of an option from its value.

## Options

`-help`, `--help`, or `-?`

- Prints a **help message** for the `javap` command.

`-version`

- Prints **release information.**

**`-verbose` or `-v`**

- Prints **additional information about the selected class.**

**`-l`**

- Prints **line and local variable tables.**

`-public`

- Shows **only public classes and members.**

`-protected`

- Shows **only protected and public classes and members.**

`-package`

- Shows **`package/protected/public` classes and members (default).**

**`-private` or `-p`**

- Shows **all classes and members.**

**`-c`**

- Prints **disassembled code**, for example, the instructions that comprise the Java bytecodes, for each of the methods in the class.

`-s`

- Prints **internal type signatures.**

`-sysinfo`

- Shows **system information** (path, size, date, MD5 hash) of the class being processed.

**`-constants`**

- Shows **static final constants.**

`--module module` or `-m module`

- Specifies the **module containing classes to be disassembled.**

`--module-path path`

- Specifies **where to find application modules.**

`--system jdk`

- Specifies **where to find system modules.**

`--class-path path`, `-classpath path`, or `-cp path`

- Specifies the **path that the javap command uses to find user class files.**
    - It overrides the default or the CLASSPATH environment variable when it’s set.

`-bootclasspath path`

- Overrides the **location of bootstrap class files.**

**`-Joption`**

- Passes the **specified option to the JVM.**
- For example:
    - `javap -J-version`
    - `javap -J-Djava.security.manager -J-Djava.security.policy=MyPolicy MyClassName`

## Usage
