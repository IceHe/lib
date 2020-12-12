# javap

Java class file disassembler

---

References

- `man javap`
- Java SE 11 Docs - Tools References - `javap` : https://docs.oracle.com/en/java/javase/11/tools/javap.html

## Quickstart

```bash
# Default
javap HelloWorld
# or
javap HelloWorld.class

# With disassembled code
# - e.g. the instructions that comprise the Java bytecodes,
#   for each of the methods in the class.
javap -c HelloWorld

# Verbose
javap -v HelloWorld
# or
javap -verbose HelloWorld
```

## Synopsis

```bash
javap [options] classes...
```

- `classes` Specifies **one or more classes separated by spaces to be processed for annotations.**
    - You can specify a class that can be found in the class path by its file name, URL, or by its fully qualified class name.
- Examples:
    - `path/to/MyClass.class`
    - `jar:file:///path/to/MyJar.jar!/mypkg/MyClass.class`
    - `java.lang.Object`

## Description

- The `javap` command **disassembles one or more class files**.
    - When no options are used, the javap command prints the protected and public fields, and methods of the classes passed to it.
- The `javap` command isn't multirelease `JAR` aware.
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

- Prints **disassembled code**, for example, **the instructions that comprise the Java bytecodes, for each of the methods in the class.**

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
    - It overrides the default or the CLASSPATH environment variable when it's set.

`-bootclasspath path`

- Overrides the **location of bootstrap class files.**

**`-Joption`**

- Passes the **specified option to the JVM.**
- For example:
    - `javap -J-version`
    - `javap -J-Djava.security.manager -J-Djava.security.policy=MyPolicy MyClassName`
- See Overview of Java Options.

## Usage

HelloWorldFrame.java

```bash
import java.awt.Graphics;

import javax.swing.JFrame;
import javax.swing.JPanel;

public class HelloWorldFrame extends JFrame {

   String message = "Hello World!";

   public HelloWorldFrame(){
        setContentPane(new JPanel(){
            @Override
            protected void paintComponent(Graphics g) {
                g.drawString(message ,15, 30);
            }
        });
        setSize(100,100);
    }
    public static void main(String[] args) {
        HelloWorldFrame frame = new HelloWorldFrame();
        frame.setVisible(true);
    }
}
```

Compile

```bash
# Prepare
$ javac HelloWorldFrame.java
```

Disassemble

```bash
$ javap HelloWorldFrame.class
# or
$ javap HelloWorldFrame

# output
Compiled from "HelloWorldFrame.java"
public class HelloWorldFrame extends javax.swing.JFrame {
  java.lang.String message;
  public HelloWorldFrame();
  public static void main(java.lang.String[]);
}
```

Disassemble

- with disassembled code
    - e.g. the instructions that comprise the Java bytecodes, for each of the methods in the class.

```bash
$ javap -c HelloWorldFrame
# output
Compiled from "HelloWorldFrame.java"
public class HelloWorldFrame extends javax.swing.JFrame {
  java.lang.String message;

  public HelloWorldFrame();
    Code:
       0: aload_0
       1: invokespecial #1        // Method javax/swing/JFrame."<init>":()V
       4: aload_0
       5: ldc           #2        // String Hello World!
       7: putfield      #3        // Field message:Ljava/lang/String;
      10: aload_0
      11: new           #4        // class HelloWorldFrame$1
      14: dup
      15: aload_0
      16: invokespecial #5        // Method HelloWorldFrame$1."<init>":(LHelloWorldFrame;)V
      19: invokevirtual #6        // Method setContentPane:(Ljava/awt/Container;)V
      22: aload_0
      23: bipush        100
      25: bipush        100
      27: invokevirtual #7        // Method setSize:(II)V
      30: return

  public static void main(java.lang.String[]);
    Code:
       0: new           #8        // class HelloWorldFrame
       3: dup
       4: invokespecial #9        // Method "<init>":()V
       7: astore_1
       8: aload_1
       9: iconst_1
      10: invokevirtual #10       // Method setVisible:(Z)V
      13: return
}
```

Verbose

- Prints **additional information about the selected class.**

```bash
$ javap -v HelloWorldFrame
# or
$ javap -verbose HelloWorldFrame

# output
Classfile /Users/IceHe/Documents/lib/books/src/understand-jvm/HelloWorldFrame.class
  Last modified Sep 13, 2020; size 634 bytes
  SHA-256 checksum b9b067c99e296a1ca6e5054ee9ec0e98d753ad68cd8cd5ae718c30ed351f4e67
  Compiled from "HelloWorldFrame.java"
public class HelloWorldFrame extends javax.swing.JFrame
  minor version: 0
  major version: 58
  flags: (0x0021) ACC_PUBLIC, ACC_SUPER
  this_class: #10                         // HelloWorldFrame
  super_class: #2                         // javax/swing/JFrame
  interfaces: 0, fields: 1, methods: 2, attributes: 3
Constant pool:
   #1 = Methodref          #2.#3          // javax/swing/JFrame."<init>":()V
   #2 = Class              #4             // javax/swing/JFrame
   #3 = NameAndType        #5:#6          // "<init>":()V
   #4 = Utf8               javax/swing/JFrame
   #5 = Utf8               <init>
   #6 = Utf8               ()V
   #7 = String             #8             // Hello World!
   #8 = Utf8               Hello World!
   #9 = Fieldref           #10.#11        // HelloWorldFrame.message:Ljava/lang/String;
  #10 = Class              #12            // HelloWorldFrame
  #11 = NameAndType        #13:#14        // message:Ljava/lang/String;
  #12 = Utf8               HelloWorldFrame
  #13 = Utf8               message
  #14 = Utf8               Ljava/lang/String;
  #15 = Class              #16            // HelloWorldFrame$1
  #16 = Utf8               HelloWorldFrame$1
  #17 = Methodref          #15.#18        // HelloWorldFrame$1."<init>":(LHelloWorldFrame;)V
  #18 = NameAndType        #5:#19         // "<init>":(LHelloWorldFrame;)V
  #19 = Utf8               (LHelloWorldFrame;)V
  #20 = Methodref          #10.#21        // HelloWorldFrame.setContentPane:(Ljava/awt/Container;)V
  #21 = NameAndType        #22:#23        // setContentPane:(Ljava/awt/Container;)V
  #22 = Utf8               setContentPane
  #23 = Utf8               (Ljava/awt/Container;)V
  #24 = Methodref          #10.#25        // HelloWorldFrame.setSize:(II)V
  #25 = NameAndType        #26:#27        // setSize:(II)V
  #26 = Utf8               setSize
  #27 = Utf8               (II)V
  #28 = Methodref          #10.#3         // HelloWorldFrame."<init>":()V
  #29 = Methodref          #10.#30        // HelloWorldFrame.setVisible:(Z)V
  #30 = NameAndType        #31:#32        // setVisible:(Z)V
  #31 = Utf8               setVisible
  #32 = Utf8               (Z)V
  #33 = Utf8               Code
  #34 = Utf8               LineNumberTable
  #35 = Utf8               main
  #36 = Utf8               ([Ljava/lang/String;)V
  #37 = Utf8               SourceFile
  #38 = Utf8               HelloWorldFrame.java
  #39 = Utf8               NestMembers
  #40 = Utf8               InnerClasses
{
  java.lang.String message;
    descriptor: Ljava/lang/String;
    flags: (0x0000)

  public HelloWorldFrame();
    descriptor: ()V
    flags: (0x0001) ACC_PUBLIC
    Code:
      stack=4, locals=1, args_size=1
         0: aload_0
         1: invokespecial #1                  // Method javax/swing/JFrame."<init>":()V
         4: aload_0
         5: ldc           #7                  // String Hello World!
         7: putfield      #9                  // Field message:Ljava/lang/String;
        10: aload_0
        11: new           #15                 // class HelloWorldFrame$1
        14: dup
        15: aload_0
        16: invokespecial #17                 // Method HelloWorldFrame$1."<init>":(LHelloWorldFrame;)V
        19: invokevirtual #20                 // Method setContentPane:(Ljava/awt/Container;)V
        22: aload_0
        23: bipush        100
        25: bipush        100
        27: invokevirtual #24                 // Method setSize:(II)V
        30: return
      LineNumberTable:
        line 10: 0
        line 8: 4
        line 11: 10
        line 17: 22
        line 18: 30

  public static void main(java.lang.String[]);
    descriptor: ([Ljava/lang/String;)V
    flags: (0x0009) ACC_PUBLIC, ACC_STATIC
    Code:
      stack=2, locals=2, args_size=1
         0: new           #10                 // class HelloWorldFrame
         3: dup
         4: invokespecial #28                 // Method "<init>":()V
         7: astore_1
         8: aload_1
         9: iconst_1
        10: invokevirtual #29                 // Method setVisible:(Z)V
        13: return
      LineNumberTable:
        line 20: 0
        line 21: 8
        line 22: 13
}
SourceFile: "HelloWorldFrame.java"
NestMembers:
  HelloWorldFrame$1
InnerClasses:
  #15;                                    // class HelloWorldFrame$1
```
