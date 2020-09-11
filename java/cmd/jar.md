# jar

> Java archive tool

- Create an archive for classes and resources, and to manipulate or restore individual classes or resources from an archive.

References

- `man jar`
- Java SE 11 Docs - Tools References - `jar` : https://docs.oracle.com/en/java/javase/11/tools/jar.html

## Quickstart

Synopsis

```bash
jar [OPTION...] [ [--release VERSION] [-C dir] files] ...
```

Description

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

### Operation Modifiers Valid in Any Mode

### Operation Modifiers Valid Only in Create and Update Modes

### Operation Modifiers Valid Only in Create, Update, and Generate-index Modes

### Others

## Usage

Examples of jar Command Syntax
