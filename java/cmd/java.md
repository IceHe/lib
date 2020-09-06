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

## Options

## Usage
