# Execution Engine

> Understanding Java Virtual Machine - Part 3

References

- Book《深入理解 Java 虚拟机：JVM 高级特性与最佳实践》
    - 英文书名 : Understanding the Java Virtual Machine - Advanced Features and Best Practices, Third Edition
    <!-- - 垃圾回收算法手册: 自动内存管理的艺术 -->
    <!-- - Java 性能优化权威指南 / Effective Java -->

## 类文件结构

- 代码编译的结果从本地机器码转变为字节码
    - _是存储格式发展的一小步, 却是编程语言发展的一大步_

### 无关性的基石

- 实现语言无关性的基础仍然是 **虚拟机** 和 **字节码存储格式**
    - **JVM** 不与包括 Java 语言在内的任何程序语言绑定, 它 **只与 "Class文件" 这种特定的二进制文件格式所关联**
    - Class 文件中 **包含了 JVM 指令集、符号表以及若干其他辅助信息**
- _基于安全方面的考虑,《Java 虚拟机规范》中要求在 Class 文件必须应用许多强制性的语法和结构化约束_
    - 但 **图灵完备的字节码格式, 保证了任意一门功能性语言都可以表示为一个能被 JVM 所接受的有效的 Class 文件**
    - _作为一个通用的、与机器无关的执行平台, 任何其他语言的实现者都可以将 JVM 作为他们语言的运行基础, 以 Class 文件作为他们产品的交付媒介_
    - _例如, 使用 Java 编译器可以把 Java 代码编译为存储字节码的 Class 文件, 使用JRuby 等其他语言的编译器一样可以把它们的源程序代码编译成 Class 文件_
- 虚拟机丝毫不关心 Class 的来源是什么语言, 它与程序语言之间的关系如下图所示
    - Java 语言中的各种语法、关键字、常量变量和运算符号的语义最终都会由多条字节码指令组合来表达
    - 这决定了字节码指令所能提供的语言描述能力必须比 Java 语言本身更加强大才行
    - _因此, 有一些 Java 语言本身无法有效支持的语言特性并不代表在字节码中也无法有效表达出来_
    - _这为其他程序语言实现一些有别于 Java 的语言特性提供了发挥空间_

![jvm-language-independency.png](_images/understand-jvm/jvm-language-independency.png)

## 虚拟机类加载机制

## 虚拟机字节码执行引擎

## 类加载及执行子系统的案例和实战
