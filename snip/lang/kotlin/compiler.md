# Compiler - Kotlin

References

- [Kotlin command-line compiler - Kotlin Docs](https://kotlinlang.org/docs/command-line.html)
- [Kotlin compiler options - Kotlin Docs](https://kotlinlang.org/docs/compiler-reference.html)

## Install

### Homebrew

**( Recommended )**

```bash
brew update
brew install kotlin
```

### _SDKMAN!_

_( Optional )_

An easier way to install Kotlin on UNIX-based systems, such as OS X, Linux, Cygwin, FreeBSD, and Solaris, is [SDKMAN!](https://sdkman.io/).
It also works in Bash and ZSH shells.

- [Learn how to install SDKMAN!](https://sdkman.io/install). e.g.:

    ```bash
    curl -s "https://get.sdkman.io" | bash
    ```

To install the Kotlin compiler via SDKMAN!, run the following command in the terminal:

```bash
sdk install kotlin
```

## Compile and Run

### Application

For example:

1\. Create a simple application in Kotlin. `hello_world.kt` :

```kt
// hello_world.kt
fun main() {
    println("Hello, World!")
}
```

2\. Compile the application

```bash
kotlinc hello_world.kt --include-runtim -d hello_world.jar
```

3\. Run the application

```bash
$ java -jar target/hello_world.jar
Hello world!
```

_To see all available compilers options, run_

```bash
$ kotlinc -help
Usage: kotlinc-jvm <options> <source files>
where possible options include:
  -classpath (-cp) <path>    List of directories and JAR/ZIP archives to search for user class files
  -d <directory|jar>         Destination for generated class files
  -expression (-e)           Evaluate the given string as a Kotlin script
  -include-runtime           Include Kotlin runtime into the resulting JAR
  -java-parameters           Generate metadata for Java 1.8 reflection on method parameters
  -jdk-home <path>           Include a custom JDK from the specified location into the classpath instead of the default JAVA_HOME
  -jvm-target <version>      Target version of the generated JVM bytecode (1.6 (DEPRECATED), 1.8, 9, 10, 11, 12, 13, 14, 15 or 16), default is 1.8
  -module-name <name>        Name of the generated .kotlin_module file
  -no-jdk                    Don't automatically include the Java runtime into the classpath
  -no-reflect                Don't automatically include Kotlin reflection into the classpath
  -no-stdlib                 Don't automatically include the Kotlin/JVM stdlib and Kotlin reflection into the classpath
  -script-templates <fully qualified class name[,]>
                             Script definition template classes
  -Werror                    Report an error if there are any warnings
  -api-version <version>     Allow using declarations only from the specified version of bundled libraries
  -X                         Print a synopsis of advanced options
  -help (-h)                 Print a synopsis of standard options
  -kotlin-home <path>        Path to the home directory of Kotlin compiler used for discovery of runtime libraries
  -language-version <version> Provide source compatibility with the specified version of Kotlin
  -P plugin:<pluginId>:<optionName>=<value>
                             Pass an option to a plugin
  -progressive               Enable progressive compiler mode.
                             In this mode, deprecations and bug fixes for unstable code take effect immediately,
                             instead of going through a graceful migration cycle.
                             Code written in the progressive mode is backward compatible; however, code written in
                             non-progressive mode may cause compilation errors in the progressive mode.
  -script                    Evaluate the given Kotlin script (*.kts) file
  -nowarn                    Generate no warnings
  -verbose                   Enable verbose logging output
  -version                   Display compiler version
  -J<option>                 Pass an option directly to JVM
  @<argfile>                 Read compiler arguments and file paths from the given file

For details, see https://kotl.in/cli
```

### Library

1\. Create a simple application in Kotlin. `HelloWorld.kt` :

```kt
// HelloWorld.kt
class HelloWorld {
    companion object {
        @JvmStatic fun main(args: Array<String>) {
            println("Hello world!")
        }
    }
}
```

2\. Compile the application

```bash
kotlinc hello-world.kt --include-runtim -d hello-world.jar
```

3\. Run the application

```bash
$ kotlin -classpath target/HelloWorld.jar HelloWorld
Hello world!
```

### REPL

Read-Eval-Print Loop

You can run the compiler without parameters to have an interactive shell. In this shell, you can type any valid Kotlin code and see the results.

```bash
$ kotlinc-jvm
Welcome to Kotlin version 1.5.31 (JRE 1.8.0_282-b08)
Type :help for help, :quit for quit
>>> 2+3
res0: kotlin.Int = 5
>>> println("Test Kotlin Shell")
Test Kotlin Shell
>>>
```

### Script

1\. Create a simple script in Kotlin. `HelloWorld.kt` :

```kt
// hello_world.kts
fun main() {
    println("Hello world!")
}

main();
println("Welcome, IceHe!")
```

2\. Comile and run the script

```bash
$ kotlinc -script src/hello_world.kts
Hello world!
Welcome, IceHe!
```

……

## Compiler Options

Each release of Kotlin includes compilers for the supported targets:

- **JVM**,
- **JavaScript**, and
- **native binaries** for [supported platforms](https://kotlinlang.org/docs/native-overview.html#target-platforms).
    - macOS
    - iOS, tvOS, watchOS
    - Linux
    - Windows (MinGW)
    - Android NDK
    - ……

……

_You can also run Kotlin compilers manually from the command line as described in the Working with command-line compiler tutorial (above) ._

_Kotlin compilers have a number of options for tailoring<!-- 剪裁, 使合适 --> the compiling process. ……_

There are several ways to **set the compiler options and their values (compiler arguments):**

-   In **IntelliJ IDEA**, write in the compiler arguments in the **Additional command-line parameters** text box in "Settings | Build, Execution, Deployment | Compilers | Kotlin Compiler"

-   If you're using **Gradle**, specify the compiler arguments in the **`kotlinOptions`** property of the Kotlin compilation task.

    _For details, see [Gradle](https://kotlinlang.org/docs/gradle.html#compiler-options)._

-   If you're using **Maven**, specify the compiler arguments in the **`<configuration>`** element of the Maven plugin node.

    _For details, see [Maven](https://kotlinlang.org/docs/maven.html#specifying-compiler-options)._

-   If you run a **command-line** compiler, add the compiler arguments directly to the utility call or write them into an [**argfile**](https://kotlinlang.org/docs/compiler-reference.html#api-version-version).

### Common

-   `-version`

-   `-nowarn`

    _Suppress the compiler from displaying warnings during compilation._

-   **`-Werror`**

    **Turn any warnings into a compilation error.**

-   `-verbose`

-   **`-script`**

    **Evaluate a Kotlin script file.**

    When called with this option, the compiler executes the first Kotlin script (`*.kts`) file among the given arguments.

-   `-help`, `-h`

-   **`-X`**

    **Display information about the advanced options and exit.**

    _These options are currently unstable: their names and behavior may be changed without notice._

-   `-kotlin-home path`

    Specify a custom path to the Kotlin compiler used for the discovery of runtime libraries.

-   **`-P plugin:pluginId:optionName=value`**

    **Pass an option to a Kotlin compiler plugin.**

    Available plugins and their options are listed in the "Tools > Compiler plugins" section of the documentation.

-   `-language-version version`

    _Provide source compatibility with the specified version of Kotlin._

-   `-api-version version`

    _Allow using declarations only from the specified version of Kotlin bundled libraries._

-   **`-progressive`**

    **Enable the [progressive mode](https://kotlinlang.org/docs/whatsnew13.html#progressive-mode) for the compiler.**

    In the progressive mode, deprecations and bug fixes for unstable code take effect immediately, instead of going through a graceful migration cycle.
    Code written in the progressive mode is backwards compatible; however, code written in a non-progressive mode may cause compilation errors in the progressive mode.

-   **`@argfile`**

    **Read the compiler options from the given file.**

    Such a file can contain compiler options with values and paths to the source files.
    Options and paths should be separated by whitespaces.
    For example: `-include-runtime -d hello.jar hello.kt`

    To pass values that contain whitespaces, surround them with single (`'`) or double (`"`) quotes.
    If a value contains quotation marks in it, escape them with a backslash (`\`).
    `-include-runtime -d 'My folder'`

    You can also pass multiple argument files, for example, to separate compiler options from source files.

    ```bash
    $ kotlinc @compiler.options @classes
    ```

    If the files reside in locations different from the current directory, use relative paths.

    ```bash
    $ kotlinc @options/compiler.options hello.kt
    ```

    <!-- icehe : 这段没看懂, 感觉还得用一用才能理解… 2021/10/28 -->

### Kotlin/JVM

The Kotlin compiler for JVM compiles Kotlin source files into Java class files.
**The command-line tools for Kotlin to JVM compilation are `kotlinc` and `kotlinc-jvm`.**
You can also use them for executing Kotlin script files.

-   **`-classpath path (-cp path)`**

    **Search for class files in the specified paths.**

    _Separate elements of the classpath with system path separators (`;` on Windows, `:` on macOS/Linux)._
    The classpath can contain file and directory paths, ZIP, or JAR files.

-   **`-d path`**

    **Place the generated class files into the specified location.**

    The location can be a directory, a ZIP, or a JAR file.

-   **`-include-runtime`**

    **Include the Kotlin runtime into the resulting JAR file.**

    Makes the resulting archive runnable on any Java-enabled environment.

-   `-jdk-home path`

    Use a custom JDK home directory to include into the classpath if it differs from the default `JAVA_HOME`.

-   `-jvm-target version`

    Specify the target version of the generated JVM bytecode.

    Possible values are 1.6 (DEPRECATED), 1.8, 9, 10, 11, 12, 13, 14, 15 and 16. The default value is 1.8.

-   **`-java-parameters`**

    **Generate metadata for Java 1.8 reflection on method parameters.**

-  `-module-name name` (JVM)

    _Set a custom name for the generated `.kotlin_module` file._

-   `-no-jdk`

    _Don't automatically include the Java runtime into the classpath._

-   `-no-reflect`

    _Don't automatically include the Kotlin reflection (kotlin-reflect.jar) into the classpath._

-   `-no-stdlib` (JVM)

    _Don't automatically include the Kotlin/JVM stdlib (`kotlin-stdlib.jar`) and Kotlin reflection (`kotlin-reflect.jar`) into the classpath._

-   `-script-templates classnames[,]`

    _Script definition template classes._

    _Use fully qualified class names and separate them with commas (`,`)._

### Kotlin/JS

The Kotlin compiler for JS compiles Kotlin source files into JavaScript code.
The command-line tool for Kotlin to JS compilation is **`kotlinc-js`**.

-   `-libraries path`

    Paths to Kotlin libraries with `.meta.js` and `.kjsm` files, separated by the system path separator.

-   **`-main {call|noCall}`**

    **Define whether the main function should be called upon execution.**

-   `-meta-info`

    **Generate `.meta.js` and `.kjsm` files with metadata.**

    Use this option when creating a JS library.

-   `-module-kind {umd|commonjs|amd|plain}`

    **The kind of JS module generated by the compiler:**

    - `umd` - a Universal Module Definition module
    - `commonjs` - a CommonJS module
    - `amd` - an Asynchronous Module Definition module
    - `plain` - a plain JS module

-   `-no-stdlib` (JS)

    _Don't automatically include the default Kotlin/JS stdlib into the compilation dependencies._

-   **`-output filepath`**

    **Set the destination file for the compilation result.**

    The value must be a path to a `.js` file including its name.

-   **`-output-postfix filepath`**

    **Add the content of the specified file to the end of the output file.**

-   `-source-map`

    Generate the source map.

-   `-source-map-base-dirs path`

    Use the specified paths as base directories.

    Base directories are used for calculating relative paths in the source map.

-   `-source-map-embed-sources {always|never|inlining}`

    Embed source files into the source map.

-   `-source-map-prefix`

    Add the specified prefix to paths in the source map.

### Kotlin/Native

Kotlin/Native compiler compiles Kotlin source files into native binaries for the supported platforms.
The command-line tool for Kotlin/Native compilation is **`kotlinc-native`**.

-   **`-enable-assertions`, `-ea`**

    **Enable runtime assertions in the generated code.**

-   **`-g`**

    **Enable emitting debug information.**

-   `-generate-test-runner`, `-tr`

    Produce an application for running unit tests from the project.

-   `-generate-worker-test-runner`, `-trw`

    Produce an application for running unit tests in a [worker thread](https://kotlinlang.org/docs/native-concurrency.html#workers).

-   `-generate-no-exit-test-runner`, `-trn`

    Produce an application for running unit tests without an explicit process exit.

-   **`-include-binary path`, `-ib path`**

    **Pack external binary within the generated klib file.**

-   `-library path` `-l path`

    **Link with the library.**

    To learn about using libraries in Kotlin/native projects, see [Kotlin/Native libraries](https://kotlinlang.org/docs/native-libraries.html).

-   `-library-version version`, `-lv version`

    Set the library version.

-   `-list-targets`

    List the available hardware targets.

-   `-module-name name` (Native)

    Specify a name for the compilation module.

    This option can also be used to specify a name prefix for the declarations exported to Objective-C:
    [How do I specify a custom Objective-C prefix/name for my Kotlin framework?](https://kotlinlang.org/docs/native-faq.html#how-do-i-specify-a-custom-objective-c-prefix-name-for-my-kotlin-framework)

-   `-native-library path` `-nl path`

    Include the native bitcode library.

-   `-no-default-libs`

    Disable linking user code with the default platform libraries distributed with the compiler.

-   `-nomain`

    Assume the main entry point to be provided by external libraries.

-   `-nopack`

    Don't pack the library into a klib file.

-   `-linker-option`

    Pass an argument to the linker during binary building.

    This can be used for linking against some native library.

-   `-linker-options args`

    Pass multiple arguments to the linker during binary building.

    _Separate arguments with whitespaces._

-   `-nostdlib`

    Don't link with stdlib.

-   **`-opt`**

    **Enable compilation optimizations.**

-   `-output name`, `-o name`

    Set the name for the output file.

-   `-entry name`, `-e name`

    Specify the qualified entry point name.

-   `-produce output`, `-p output`

    Specify output file kind:

    - `program`
    - `static`
    - `dynamic`
    - `framework`
    - `library`
    - `bitcode`

-   `-repo path`, `-r path`

    Library search path.

    For more information, see [Library search sequence](https://kotlinlang.org/docs/native-libraries.html#library-search-sequence).

-   `-target target`

    **Set hardware target.**

    To see the list of available targets, use the [`-list-targets`](https://kotlinlang.org/docs/compiler-reference.html#kotlin-native-compiler-options) option.
