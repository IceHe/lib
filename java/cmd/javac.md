# javac

> Java compiler

References

* `man javac`
* Java SE 11 Docs - Tools References - `javac` : [https://docs.oracle.com/en/java/javase/11/tools/javac.html](https://docs.oracle.com/en/java/javase/11/tools/javac.html)

## Synopsis

```bash
javac [ options ] [ sourcefiles ] [ @argfiles ]
```

* `sourcefiles` One or more source files to be compiled \(such as `MyClass.java`\)
  * or processed for annotations \(such as `MyPackage.MyClass`\).
* `@argfiles` One or more files that list source files.

    -The `-J` options are not allowed in these files.

## Description

* The javac command reads class and interface definitions, written in the Java programming language, and compiles them into bytecode class files.
  * The javac command can also process annotations in Java source files and classes.
* A launcher environment variable, `JDK_JAVAC_OPTIONS`, was introduced in JDK 9 that prepended its content to the command line to `javac`.
  * See "Using JDK\_JAVAC\_OPTIONS Environment Variable".

## Options

### Standard

**`@filename`**

* **Reads options and file names from a file.**
  * To shorten or simplify the javac command, you can specify one or more files that contain arguments to the javac command \(except `-J` options\).
  * This lets you to create `javac` commands of any length on any operating system.
  * See "javac Command-Line Argument Files".

`-Akey[=value]`

* Specifies **options to pass to annotation processors.**
  * These options aren't interpreted by `javac` directly, but are made available for use by individual processors.
  * The key value should be one or more identifiers separated by a dot \(`.`\).

`--add-modules module,module`

* Specifies **root modules to resolve in addition to the initial modules**, or all modules on the module path if `module` is `ALL-MODULE-PATH`.

**`--boot-class-path path` or `-bootclasspath path`**

* **Overrides the location of the bootstrap class files.**
* Note:This can only be used when compiling for versions prior to JDK 9.
  * As applicable, see the descriptions in --release, -source, or -target for details.

**`--class-path path, -classpath path, or -cp path`**

* Specifies **where to find user class files and annotation processors.**
* This class path overrides the user class path in the CLASSPATH environment variable.
  * If `--class-path`, `-classpath`, or `-cp` aren't specified, then the user class path is the current directory.
  * If the `-sourcepath` option isn't specified, then the user class path is also searched for source files.
  * If the `-processorpath` option isn't specified, then the class path is also searched for annotation processors.

`-d directory`

* Sets the **destination directory for class files.**
  * If a class is part of a package, then `javac` puts the class file in a subdirectory that reflects the package name and creates directories as needed.
  * For example:
    * Oracle Solaris, Linux, and macOS : If you specify `-d /home/myclasses` and the class is called `com.mypackage.MyClass`, then the class file is `/home/myclasses/com/mypackage/MyClass.class`.
* If the `-d` option isn't specified, then `javac` puts each class file in the same directory as the source file from which it was generated.
  * Note : The directory specified by the -d option isn't automatically added to your user class path.

`-deprecation`

* Shows a **description of each use or override of a deprecated member or class.**
  * Without the `-deprecation` option, javac shows a summary of the source files that use or override deprecated members or classes.
  * The `-deprecation` option is shorthand for -Xlint:deprecation.

`--enable-preview`

* Enables **preview language features.**
  * Used in conjunction with either `-source` or `--release`.

`-encoding encoding`

* Specifies **character encoding used by source files, such as EUC-JP and UTF-8.**
  * If the `-encoding` option isn't specified, then the platform default encoding is used.

`-endorseddirs directories`

* Overrides the **location of the endorsed standards path.**
  * Note : This can only be used when compiling for versions prior to JDK 9.
  * As applicable, see the descriptions in --release, -source, or -target for details.

`-extdirs directories`

* Overrides the **location of the installed extensions.**
  * The directories variable is a colon-separated list of directories.
  * Each JAR file in the specified directories is searched for class files.
  * All JAR files found become part of the class path.
* If you are cross-compiling, then this option specifies the directories that contain the extension classes.
  * See "Cross-Compilation Options" for javac.
* Note : This can only be used when compiling for versions prior to JDK 9.
  * As applicable, see the descriptions in `--release`, `-source`, or `-target` for details.

**`-g`**

* **Generates all debugging information, including local variables.**
  * By default, only line number and source file information is generated.

**`-g:[lines, vars, source]`**

* **Generates only the kinds of debugging information specified by the comma-separated list of keywords.**
* Valid keywords are:
  * `lines` Line number debugging information.
  * `vars` Local variable debugging information.
  * `source` Source file debugging information.

**`-g:none`**

* Doesn't generate debugging information.

`-h directory`

* Specifies **where to place generated native header files.**
  * When you specify this option, a native header file is generated for each class that contains native methods or that has one or more constants annotated with the `java.lang. annotation.Native` annotation.
  * If the class is part of a package, then the compiler puts the native header file in a subdirectory that reflects the package name and creates directories as needed.

`--help`, `–help` or `-?`

* Prints a **synopsis of the standard options.**

`--help-extra` or `-X`

* Prints the **help for extra options.**

**`-implicit:[none, class]`**

* Specifies **whether or not to generate class files for implicitly referenced files:**
  * `-implicit:class` — Automatically generates class files.
  * `-implicit:none` — Suppresses class file generation.
* If this option isn't specified, then the default automatically generates class files.
  * In this case, the compiler issues a warning if any class files are generated when also doing annotation processing.
  * The warning isn't issued when the -implicit option is explicitly set.
  * See Searching for Types.

**`-Joption`**

* **Passes option to the runtime system**, where option is one of the Java **options described on `java` command**.
  * For example, `-J-Xms48m` sets the startup memory to 48 MB.
* Note : The `CLASSPATH` environment variable, `-classpath` option, `-bootclasspath` option, and `-extdirs` option don't specify the classes used to run `javac`.
  * Trying to customize the compiler implementation with these options and variables is risky and often doesn't accomplish what you want.
  * If you must customize the complier implementation, then use the `-J` option to pass options through to the underlying Java launcher.

`--limit-modules module,module*`

* **Limits the universe of observable modules.**

`--module module-name` or `-m module-name`

* **Compiles only the specified module and checks time stamps.**

`--module-path path` or `-p path`

* Specifies **where to find application modules.**

`--module-source-path module-source-path`

* Specifies **where to find input source files for multiple modules.**

`--module-version version`

* Specifies the **version of modules that are being compiled.**

`-nowarn`

* **Disables warning messages.**
  * This option operates the same as the `-Xlint:none` option.

**`-parameters`**

* **Generates metadata for reflection on method parameters.**
  * Stores formal parameter names of constructors and methods in the generated class file so that the method `java.lang.reflect.Executable.getParameters` from the Reflection API can retrieve them.

`-proc:[none, only]`

* Controls **whether annotation processing and compilation are done.**
  * `-proc:none` means that compilation takes place without annotation processing.
  * `-proc:only` means that only annotation processing is done, without any subsequent compilation.

_`-processor class1[,class2,class3...]`_

* **Names of the annotation processors to run.**
  * This bypasses the default discovery process.

_`--processor-module-path path`_

* Specifies the **module path used for finding annotation processors.**

_`--processor-path path` or `-processorpath path`_

* Specifies where to find annotation processors.
  * If this option isn't used, then the class path is searched for processors.

**`-profile profile`**

* **Checks that the API used is available in the specified profile.**
* Note : This can only be used when compiling for versions prior to JDK 9.
  * As applicable, see the descriptions in --release, -source, or -target for details.

`--release release`

* **Compiles against the public, supported and documented API for a specific VM version.**
  * Supported release targets are 6, 7, 8, 9, 10, and 11.
* Note:When using `--release` for a version of the Java Platform that supports modules, you can't use `--add-modules` to access internal JDK modules, nor can you use `--add-exports` to access internal JDK APIs in the modules.

`-s directory`

* Specifies the **directory used to place the generated source files.**
  * If a class is part of a package, then the compiler puts the source file in a subdirectory that reflects the package name and creates directories as needed.
* For example:

    Oracle Solaris, Linux, and macOS : If you specify `-s /home/mysrc` and the class is called `com.mypackage.MyClass`, then the source file is put in `/home/mysrc/com/mypackage/MyClass.java`.

`-source release`

* Specifies the **version of source code accepted.**
* The following values for release are allowed:
  * `1.6` No language changes were introduced in Java SE 6.
    * However, encoding errors in source files are now reported as errors instead of warnings as was done in earlier releases of Java Platform, Standard Edition.
  * `6` Synonym for 1.6.
  * `1.7` The compiler accepts code with features introduced in Java SE 7.
  * `7` Synonym for 1.7.
  * `1.8` The compiler accepts code with features introduced in Java SE 8.
  * `8` Synonym for 1.8.
  * `9` The compiler accepts code with features introduced in Java SE 9.
  * `10` The compiler accepts code with features introduced in Java SE 10.
  * `11` The compiler accepts code with features introduced in Java SE 11.
    * The default value.
* _Note : Beginning with JDK 9, javac no longer supports `-source` release settings less than or equal to 5._
  * _If settings less than or equal to 5 are used, then the javac command behaves as if -source 6 were specified._

`--source-path path or -sourcepath path`

* Specifies **where to find input source files.**
  * This is the source code path used to search for class or interface definitions.
  * As with the user class path, source path entries are separated by colons \(`:`\) on Oracle Solaris, Linux, and macOS and semicolons \(`;`\) on Windows.
  * They can be directories, `JAR` archives, or `ZIP` archives.
  * If packages are used, then the local path name within the directory or archive must reflect the package name.
* Note : Classes found through the class path might be recompiled when their source files are also found.
  * See "Searching for Types".

`--system jdk | none`

* Overrides the location of system modules.

`-target release`

* Generates class files for a specific VM version.

`--upgrade-module—path path`

* Overrides the location of upgradeable modules.

**`-verbose`**

* **Outputs messages about what the compiler is doing.**
  * Messages include information about each class loaded and each source file compiled.

**`--version` or `-version`**

* Prints version information.

**`-Werror`**

* **Terminates compilation when warnings occur.**

### Extra

`--add-exports module/package=other-module(,other-module)*`

* Specifies **a package to be considered as exported from its defining module to additional modules or to all unnamed modules** when the value of other-module is ALL-UNNAMED.

`--add-reads module=other-module(,other-module)*`

* Specifies **additional modules to be considered as required by a given module.**

`--default-module-for-created-files module-name`

* Specifies the **fallback target module for files created by annotation processors**, if none is specified or inferred.

`-Djava.endorsed.dirs=dirs`

* Overrides the **location of the endorsed standards path.**
* _Note : This can only be used when compiling for versions prior to JDK 9._
  * _As applicable, see the descriptions in `--release`, `-source`, or `-target` for details._

`-Djava.ext.dirs=dirs`

* Overrides the **location of installed extensions.**
* _Note : This can only be used when compiling for versions prior to JDK 9._
  * _As applicable, see the descriptions in `--release`, `-source`, or `-target` for details._

`--doclint-format [html4|html5]`

* Specifies the **format for documentation comments.**

`--patch-module module=file(:file)*`

* **Overrides or augments a module with classes and resources in JAR files or directories.**

`-Xbootclasspath:path`

* Overrides the **location of the bootstrap class files.**
* _Note : This can only be used when compiling for versions prior to JDK 9._
  * _As applicable, see the descriptions in `--release`, `-source`, or `-target` for details._

`-Xbootclasspath/a:path`

* Adds a suffix to the bootstrap class path.
* _Note : This can only be used when compiling for versions prior to JDK 9._
  * _As applicable, see the descriptions in `--release`, `-source`, or `-target` for details._

`-Xbootclasspath/p:path`

* Adds a **prefix to the bootstrap class path.**
* _Note : This can only be used when compiling for versions prior to JDK 9._
  * _As applicable, see the descriptions in `--release`, `-source`, or `-target` for details._

`-Xdiags:[compact, verbose]`

* Selects a **diagnostic mode.**

`-Xdoclint`

* Enables **recommended checks for problems in javadoc comments.**

`-Xdoclint:(all|none|[-]group)[/access]`

* Enables or disables **specific groups of checks.**
* `group` can have one of the following values:
  * accessibility
  * html
  * missing
  * reference
  * syntax
* `access` specifies the minimum visibility level of classes and members that the `-Xdoclint` option checks.
  * It can have one of the following values \(in order of most to least visible\):
    * public
    * protected
    * package
    * private
* _The default `access` level is `private`._
* _For more information about these groups of checks, see the `-Xdoclint` option of the `javadoc` command._
  * _The `-Xdoclint` option is disabled by default in the `javac` command._
* _For example, the following option checks classes and members \(with all groups of checks\) that have the access level of protected and higher \(which includes protected and public\):_
  * _`-Xdoclint:all/protected`_
* _The following option enables all groups of checks for all access levels, except it won't check for HTML errors for classes and members that have the access level of package and higher \(which includes package, protected, and public\):_
  * _`-Xdoclint:all,-html/package`_

`-Xdoclint/package:[-]packages(,[-]package)*`

* Enables or disables **checks in specific packages.**
  * Each package is either the qualified name of a package or a package name prefix followed by a period and asterisk \(`.*`\), which expands to all sub-packages of the given package.
  * Each package can be prefixed with a hyphen \(`-`\) to disable checks for a specified package or packages.

**`-Xlint`**

* Enables all **recommended warnings.**
  * In this release, enabling all available warnings is recommended.

`-Xlint:[-]key(,[-]key)*`

* **Supplies warnings to enable or disable, separated by a comma \(`,`\).**
  * Precede a key by a hyphen \(`-`\) to disable the specified warning.
* Supported values for key are:
  * `all` : Enables all warnings.
  * `auxiliaryclass` : Warns about an auxiliary class that's hidden in a source file, and is used from other files.
  * `cast` : Warns about the use of unnecessary casts.
  * `classfile` : Warns about the issues related to classfile contents.
  * `deprecation` : Warns about the use of deprecated items.
  * `dep-ann` : Warns about the items marked as deprecated in javadoc but without the @Deprecated annotation.
  * `divzero` : Warns about the division by the constant integer 0.
  * `empty` : Warns about an empty statement after if.
  * `exports` : Warns about the issues regarding module exports.
  * `fallthrough` : Warns about the falling through from one case of a switch statement to the next.
  * `finally` : Warns about finally clauses that don't terminate normally.
  * `module` : Warns about the module system-related issues.
  * `opens` : Warns about the issues related to module opens.
  * `options` : Warns about the issues relating to use of command line options.
  * `overloads` : Warns about the issues related to method overloads.
  * `overrides` : Warns about the issues related to method overrides.
  * `path` : Warns about the invalid path elements on the command line.
  * `processing` : Warns about the issues related to annotation processing.
  * `rawtypes` : Warns about the use of raw types.
  * `removal` : Warns about the use of an API that has been marked for removal.
  * `requires-automatic` : Warns developers about the use of automatic modules in requires clauses.
  * `requires-transitive-automatic` : Warns about automatic modules in requires transitive.
  * `serial` : Warns about the serializable classes that don't provide a serial version ID. Also warns about access to non-public members from a serializable element.
  * `static` : Warns about accessing a static member using an instance.
  * `try` : Warns about the issues relating to the use of try blocks \(that is, try-with-resources\).
  * `unchecked` : Warns about the unchecked operations.
  * `varargs` : Warns about the potentially unsafe vararg methods.
  * `none` : Disables all warnings.
* _See Examples of Using `-Xlint` keys._

`-Xmaxerrs number`

* Sets the **maximum number of errors to print.**

`-Xmaxwarns number`

* Sets the **maximum number of warnings to print.**

`-Xpkginfo:[always, legacy, nonempty]`

* Specifies **when and how the `javac` command generates `package-info.class` files from `package-info.java` files using one of the following options :**
  * `always` Generates a `package-info.class` file for every `package-info.java` file.
    * This option may be useful if you use a build system such as Ant, which checks that each `.java` file has a corresponding `.class` file.
  * `legacy` Generates a `package-info.class` file only if `package-info.java` contains annotations.
    * This option doesn't generate a `package-info.class` file if `package-info.java` contains only comments.
    * Note : A `package-info.class` file might be generated but be empty if all the annotations in the `package-info.java` file have `RetentionPolicy.SOURCE`.
  * `nonempty` Generates a `package-info.class` file only if `package-info.java` contains annotations with `RetentionPolicy.CLASS` or `RetentionPolicy.RUNTIME`.

`-Xplugin:name args`

* Specifies the name and optional arguments for a plug-in to be run.

`-Xprefer:[source, newer]`

* Specifies **which file to read when both a source file and class file are found for an implicitly compiled class using one of the following options.**
* _See "Searching for Types"._
  * `-Xprefer:newer` : Reads the newer of the source or class files for a type \(**default**\).
  * `-Xprefer:source` : Reads the source file.
    * Use `-Xprefer:source` when you want to be sure that any annotation processors can access annotations declared with a retention policy of `SOURCE`.

`-Xprint`

* Prints a **textual representation of specified types for debugging purposes.**
  * This doesn't perform annotation processing or compilation.
  * The format of the output could change.

`-XprintProcessorInfo`

* Prints information about which annotations a processor is asked to process.

`-XprintRounds`

* Prints information about initial and subsequent annotation processing rounds.

**`-Xstdout filename`**

* **Sends compiler messages to the named file.**
  * By default, compiler messages go to `System.err`.

## Usage

### @filename

Single Argument File

* You could use a single argument file named argfile to hold all javac arguments:

```bash
javac @argfile
```

* This argument file could contain the contents of both files shown in the following "Two Argument Files" example.

Two Argument Files

* You can create two argument files : one for the javac options and the other for the source file names.
  * Note that the following lists have no line-continuation characters.
* Create a file named `options` that contains the following:
  * Oracle Solaris, Linux, and macOS:

```bash
-d classes
-g
-sourcepath /java/pubs/ws/1.3/src/share/classes
```

* Create a file named `classes` that contains the following:

```bash
MyClass1.java
MyClass2.java
MyClass3.java
```

* Then, run the `javac` command as follows:

```bash
javac @options @classes
```

Argument Files with Paths

* The argument files can have paths, but any file names inside the files are relative to the current working directory \(not `path1` or `path2`\):

```bash
javac @path1/options @path2/classes
```

### `-Xlint` keys

**`cast`**

* Warns about **unnecessary and redundant casts**, for example:

```java
String s = (String) "Hello!"
```

`classfile`

* Warns about **issues related to class file contents**.

**`deprecation`**

* Warns about the **use of deprecated items**. For example:
  * The method `java.util.Date.getDay` has been deprecated since JDK 1.1.

```bash
java.util.Date myDate = new java.util.Date();
int currentDay = myDate.getDay();
```

**`dep-ann`**

* Warns about **items that are documented with the `@deprecated` Javadoc comment**, but don't have the `@Deprecated` annotation, for example:

```bash
/**
  * @deprecated As of Java SE 7, replaced by {@link #newMethod()}
  */
public static void deprecatedMethod() { }
public static void newMethod() { }
```

`divzero`

* Warns about **division by the constant integer 0**, for example:

```java
int divideByZero = 42 / 0;
```

`empty`

* Warns about **empty statements after if statements**, for example:

```java
class E {
    void m() {
         if (true) ;
    }
}
```

`fallthrough`

* **Checks the switch blocks for fall-through cases** and provides a warning message for any that are found.
  * Fall-through cases are cases in a switch block, other than the last case in the block, whose code doesn't include a break statement, allowing code execution to fall through from that case to the next case.
* For example, the code following the case 1 label in this switch block doesn't end with a break statement:

```java
witch (x) {
case 1:
    System.out.println("1");
    // No break statement here.
case 2:
    System.out.println("2");
}
```

* If the `-Xlint:fallthrough` option was used when compiling this code, then the compiler emits a warning about possible fall-through into case, with the line number of the case in question.

`finally`

* Warns about **finally clauses that can't be completed normally**, for example:

```java
public static int m() {
    try {
        throw new NullPointerException();
    } catch (NullPointerException(); {
        System.err.println("Caught NullPointerException.");
        return 1;
    } finally {
        return 0;
    }
}
```

* The compiler generates a warning for the finally block in this example.
  * When the int method is called, it returns a value of 0.
  * A finally block executes when the try block exits.
  * In this example, when control is transferred to the catch block, the int method exits.
  * However, the finally block must execute, so it's executed, even though control was transferred outside the method.

`options`

* Warns about **issues that related to the use of command-line options.**
  * See "Cross-Compilation Options" for `javac`.

`overrides`

* Warns about **issues related to method overrides.**
* _For example, consider the following two classes:_

```java
public class ClassWithVarargsMethod {
  void varargsMethod(String... s) { }
}

public class ClassWithOverridingMethod extends ClassWithVarargsMethod {
   @Override
   void varargsMethod(String[] s) { }
}
```

* The compiler generates a warning similar to the following:.

```bash
warning: [override] varargsMethod(String[]) in ClassWithOverridingMethod
overrides varargsMethod(String...) in ClassWithVarargsMethod; overriding
method is missing '...'
```

* When the compiler encounters a `varargs` method, it translates the `varargs` formal parameter into an array.
* In the method `ClassWithVarargsMethod.varargsMethod`, the compiler translates the `varargs` formal parameter `String... s` to the formal parameter `String[] s`, an array that matches the formal parameter of the method `ClassWithOverridingMethod.varargsMethod`.
  * Consequently, this example compiles.

`path`

* Warns about **invalid path elements and nonexistent path directories on the command line** \(with regard to the class path, the source path, and other paths\).
  * Such warnings can't be suppressed with the @SuppressWarnings annotation.
* _For example:_
  * _Oracle Solaris, Linux, and macOS : `javac -Xlint:path -classpath /nonexistentpath Example.java`_

`processing`

* Warns about **issues related to annotation processing.**
  * The compiler generates this warning when you have a class that has an annotation, and you use an annotation processor that can't handle that type of exception.
* For example, the following is a simple annotation processor:
* Source file `AnnocProc.java` :

```java
import java.util.*;
import javax.annotation.processing.*;
import javax.lang.model.*;
import javaz.lang.model.element.*;

@SupportedAnnotationTypes("NotAnno")
public class AnnoProc extends AbstractProcessor {
  public boolean process(Set<? extends TypeElement> elems, RoundEnvironment renv){
     return true;
  }

  public SourceVersion getSupportedSourceVersion() {
     return SourceVersion.latest();
   }
}
```

* Source file `AnnosWithoutProcessors.java` :

```java
@interface Anno { }

@Anno
class AnnosWithoutProcessors { }
```

* The following commands compile the annotation processor `AnnoProc`, then run this annotation processor against the source file `AnnosWithoutProcessors.java` :

```bash
javac AnnoProc.java
javac -cp . -Xlint:processing -processor AnnoProc -proc:only AnnosWithoutProcessors.java
```

* When the compiler runs the annotation processor against the source file `AnnosWithoutProcessors.java`, it generates the following warning:

```bash
warning: [processing] No processor claimed any of these annotations: Anno
```

* To resolve this issue, you can rename the annotation defined and used in the class `AnnosWithoutProcessors` from `Anno` to `NotAnno`.

`rawtypes`

* Warns about **unchecked operations on raw types.**
* The following statement generates a `rawtypes` warning:

```java
void countElements(List l) { ... }
```

* The following example doesn't generate a `rawtypes` warning:

```java
void countElements(List<?> l) { ... }
```

* `List` is a raw type.
  * However, `List<?>` is an unbounded wildcard parameterized type.
  * Because `List` is a parameterized interface, always specify its type argument.
  * In this example, the `List` formal argument is specified with an unbounded wildcard \(`?`\) as its formal type parameter, which means that the countElements method can accept any instantiation of the `List` interface.

`serial`

* Warns about missing serialVersionUID definitions on serializable classes.
* _For example:_

```bash
public class PersistentTime implements Serializable
{
    private Date time;

    public PersistentTime() {
        time = Calendar.getInstance().getTime();
    }

    public Date getTime() {
        return time;
    }
}
```

* The compiler generates the following warning:

```bash
warning: [serial] serializable class PersistentTime has no definition of serialVersionUID
```

* If a serializable class doesn't explicitly declare a field named `serialVersionUID`, then the serialization runtime environment calculates a default `serialVersionUID` value for that class based on various aspects of the class, as described in the Java Object Serialization Specification.
  * However, it's strongly recommended that all serializable classes explicitly declare `serialVersionUID` values because the default process of computing `serialVersionUID` values is highly sensitive to class details that can vary depending on compiler implementations.
  * As a result, this might cause an unexpected InvalidClassExceptions during deserialization.
  * To guarantee a consistent `serialVersionUID` value across different Java compiler implementations, a serializable class must declare an explicit `serialVersionUID` value.

`static`

* Warns about **issues relating to the use of static variables**, for example:

```java
class XLintStatic {
    static void m1() { }
    void m2() { this.m1(); }
}
```

* The compiler generates the following warning:

```bash
warning: [static] static method should be qualified by type name,
XLintStatic, instead of by an expression
```

* To resolve this issue, you can call the `static` method `m1` as follows:

```java
XLintStatic.m1();
```

* Alternately, you can remove the `static` keyword from the declaration of the method `m1`.

`try`

* Warns about **issues relating to the use of `try` blocks**, including try-with-resources statements.
  * For example, a warning is generated for the following statement because the resource ac declared in the try block isn't used:

```java
try (AutoCloseable ac = getResource()) {
    // do nothing
}
```

`unchecked`

* Gives **more detail for unchecked conversion warnings that are mandated by the Java Language Specification**, for example :

```java
List l = new ArrayList<Number>();
List<String> ls = l; // unchecked warning
```

* During type erasure, the types `ArrayList<Number>` and `List<String>` become `ArrayList` and `List`, respectively.
* The `ls` command has the parameterized type `List<String>`.
  * When the `List` referenced by `l` is assigned to `ls`, the compiler generates an unchecked warning.
  * At compile time, the compiler and JVM can't determine whether `l` refers to a `List<String>` type.
  * In this case, `l` doesn't refer to a `List<String>` type.
  * As a result, heap pollution occurs.
* A heap pollution situation occurs when the `List` object `l`, whose static type is `List<Number>`, is assigned to another `List` object, ls, that has a different static type, `List<String>`.
  * However, the compiler still allows this assignment.
  * It must allow this assignment to preserve backward compatibility with releases of Java SE that don't support generics.
  * Because of type erasure, `List<Number>` and `List<String>` both become `List`.
  * Consequently, the compiler allows the assignment of the object l, which has a raw type of `List`, to the object `ls`.

`varargs`

* Warns about **unsafe use of variable arguments \(`varargs`\) methods**, in particular, those that contain non-reifiable arguments, for example:

```java
public class ArrayBuilder {
    public static <T> void addToList (List<T> listArg, T... elements) {
        for (T x : elements) {
            listArg.add(x);
        }
    }
}
```

* A non-reifiable type is a type whose type information isn't fully available at runtime.
* The compiler generates the following warning for the definition of the method `ArrayBuilder.addToList` :

```bash
warning: [varargs] Possible heap pollution from parameterized vararg type T
```

* When the compiler encounters a varargs method, it translates the varargs formal parameter into an array.
  * However, the Java programming language doesn't permit the creation of arrays of parameterized types.
  * In the method `ArrayBuilder.addToList`, the compiler translates the varargs formal parameter `T...` elements to the formal parameter `T[]` elements, an array.
  * However, because of type erasure, the compiler converts the `varargs` formal parameter to `Object[]` elements.
  * Consequently, there's a possibility of heap pollution.

## Others

### Annotation Processing

* The `javac` command provides direct support for annotation processing, superseding the need for the separate annotation processing command, `apt`.
* The API for annotation processors is defined in the `javax.annotation.processing` and `javax.lang.model` packages and subpackages.

How Annotation Processing Works

* Unless annotation processing is disabled with the `-proc:none` option, the compiler searches for any annotation processors that are available.
  * The search path can be specified with the `-processorpath` option.
  * If no path is specified, then the user class path is used.
  * Processors are located by means of service provider-configuration files named `META-INF/services/javax.annotation.processing`.
  * Processor on the search path.
  * Such files should contain the names of any annotation processors to be used, listed one per line.
  * Alternatively, processors can be specified explicitly, using the `-processor` option.
* After scanning the source files and classes on the command line to determine what annotations are present, the compiler queries the processors to determine what annotations they process.
  * When a match is found, the processor is called.
  * A processor can claim the annotations it processes, in which case no further attempt is made to find any processors for those annotations.
  * After all of the annotations are claimed, the compiler does not search for additional processors.
* If any processors generate new source files, then another round of annotation processing occurs: Any newly generated source files are scanned, and the annotations processed as before.
  * Any processors called on previous rounds are also called on all subsequent rounds.
  * This continues until no new source files are generated.
* After a round occurs where no new source files are generated, the annotation processors are called one last time, to give them a chance to complete any remaining work.
  * Finally, unless the -proc:only option is used, the compiler compiles the original and all generated source files.

### Searching for Types

* To compile a source file, the compiler often needs information about a type, but the type definition is not in the source files specified on the command line.
* The compiler needs type information for every class or interface used, extended, or implemented in the source file.
  * This includes classes and interfaces not explicitly mentioned in the source file, but that provide information through inheritance.
* For example, when you create a subclass of `java.awt.Window`, you are also using the ancestor classes of Window: `java.awt.Container`, `java.awt.Component`, and `java.lang.Object`.
* When the compiler needs type information, it searches for a source file or class file that defines the type.
  * The compiler searches for class files first in the bootstrap and extension classes, then in the user class path \(which by default is the current directory\).
  * The user class path is defined by setting the CLASSPATH environment variable or by using the `-classpath` option.
* If you set the -sourcepath option, then the compiler searches the indicated path for source files.
  * Otherwise, the compiler searches the user class path for both class files and source files.
* You can specify different bootstrap or extension classes with the `-bootclasspath` and the `-extdirs` options.
* _See "Cross-Compilation Options" for `javac`._
* A successful type search may produce a class file, a source file, or both.
  * If both are found, then you can use the `-Xprefer` option to instruct the compiler which to use.
  * If `newer` is specified, then the compiler uses the newer of the two files.
  * If `source` is specified, the compiler uses the source file.
  * The default is `newer`.
* If a type search finds a source file for a required type, either by itself, or as a result of the setting for the `-Xprefer` option, then the compiler reads the source file to get the information it needs.
  * By default the compiler also compiles the source file.
  * You can use the `-implicit` option to specify the behavior.
  * If none is specified, then no class files are generated for the source file.
  * If `class` is specified, then class files are generated for the source file.
* The compiler might not discover the need for some type information until after annotation processing completes.
  * When the type information is found in a source file and no `-implicit` option is specified, the compiler gives a warning that the file is being compiled without being subject to annotation processing.
  * To disable the warning, either specify the file on the command line \(so that it will be subject to annotation processing\) or use the `-implicit` option to specify whether or not class files should be generated for such source files.

