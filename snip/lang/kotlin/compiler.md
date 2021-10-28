# Compiler - Kotlin

References

- [Kotlin command-line compiler - Kotlin Docs](https://kotlinlang.org/docs/command-line.html)

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

## Compile and run an application

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

## Compile a library

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

## Run the REPL

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

## Run scripts

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
