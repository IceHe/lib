# Java

> Notes \( draft \)

## Basics

Install

* [Install](install.md)

Basic

* [Hello World](https://github.com/IceHe/lib/tree/947acea0af9811b33d5eeab49993da378ed0aeac/java/hello-java.md) \( draft \)
* [Glossary](glossary.md)

Framework

* [Spring](spring.md) & Spring Boot

Package Manager

* [Maven](maven.md)

Style Guide

* Alibaba : [https://edu.aliyun.com/certification/cldt02](https://edu.aliyun.com/certification/cldt02)
* Google : [https://google.github.io/styleguide/javaguide.html](https://google.github.io/styleguide/javaguide.html)

Coding

* [Snippets](code-snippets.md)
* [Notices](notices.md)

Command Line Tools

* jar : Java archive tool
* java : Java application launcher
* javac : Java compiler
* javap : Java class file disassembler
* jconsole : VM Performance Statistics
* jmap : Stack & Heap
* ……

## Others

### Some Refs

IntelliJ IDEA Plugins

* IntelliJ IDEA 18 周岁，吐血推进珍藏已久的必装插件 : [https://www.hollischuang.com/archives/3220](https://www.hollischuang.com/archives/3220)
  * Maven Helper
  * Lombok plugin
  * FindBugs-IDEA
  * 阿里巴巴代码规约检测
  * google-java-format
  * GsonFormat
  * String Manipulation
  * Key promoter X
  * AceJump
  * …

Hello World

* spring-boot-examples : [https://github.com/ityouknow/spring-boot-examples](https://github.com/ityouknow/spring-boot-examples)
  * about learning Spring Boot via examples.
  * Spring Boot 教程、技术栈示例代码，快速简单上手教程

Basics

* 我的阿里之路+Java面经考点 : [https://juejin.im/post/5aa4a2e35188255589496eb8](https://juejin.im/post/5aa4a2e35188255589496eb8)
* To Be Top Javaer - Java工程师成神之路 : [https://github.com/hollischuang/toBeTopJavaer](https://github.com/hollischuang/toBeTopJavaer) （内容好不好待验证）
  * HollisChuang's Blog-Java干货集散地 : [https://www.hollischuang.com/](https://www.hollischuang.com/)

### Coding

Manipulate Excel File

* How to Write to an Excel file in Java using Apache POI \| CalliCoder : [https://www.callicoder.com/java-write-excel-file-apache-poi/](https://www.callicoder.com/java-write-excel-file-apache-poi/)

Java Spring ConstraintValidator \( 约束校验器 \)

* JavaBean Validation - Object Association validation with @Valid

  : [https://www.logicbig.com/tutorials/java-ee-tutorial/bean-validation/cascaded-validation.html](https://www.logicbig.com/tutorials/java-ee-tutorial/bean-validation/cascaded-validation.html)

Create new Map.Entry\(key, velue\) using \*Utils

* How to create new Entry \(key, value\) - Stack Overflow : [https://stackoverflow.com/questions/3110547/java-how-to-create-new-entry-key-value](https://stackoverflow.com/questions/3110547/java-how-to-create-new-entry-key-value)

```java
Map.Entry<String,Integer> entry =
    new AbstractMap.SimpleEntry<String, Integer>("exmpleString", 42);
```

将字符串转换为日期对象

* Java 8 - How to convert String to LocalDate : [https://www.mkyong.com/java8/java-8-how-to-convert-string-to-localdate/](https://www.mkyong.com/java8/java-8-how-to-convert-string-to-localdate/)
  * Java 应该用 LocalDate / LocalTime / LocalDateTime 保存时间
  * 禁止使用 java.util.Date & java.text.SimpleDateFormat !

使用 Strean 找出重复的对象

* Find duplicates using Java 8 lambda : [https://carsten-luxig.de/find-duplicated-items-in-2-collections-with-lambda-expressions](https://carsten-luxig.de/find-duplicated-items-in-2-collections-with-lambda-expressions)

```java
Stream<Entry<String, List<Item>>> duplicates = merged
        .collect(Collectors.groupingBy(Item::getId)))
        .entrySet().stream()
        .filter(e -> e.getValue() > 1);
```

如何生成 JavaDoc

* Intellij IDEA如何生成JavaDoc : [https://www.jianshu.com/p/0ddb0864e499](https://www.jianshu.com/p/0ddb0864e499)

### Design Pattern

用 "静态工厂方法" 替代 "构造函数" 的优点

* [Java: The Factory Method Pattern](http://t.cn/E9O7ZRI%20)
* [Constructors or Static Factory Methods? - DZone Java](http://t.cn/E9Oq9qC%20)

> Moving Logic Out of Constructors. If we just put this logic into the constructor, we’d be breaking the Single Responsibility Principle. We would **end up with a monolithic constructor that does a lot more than initialize fields**.

泛型类对象的工厂 & 使用责任链削减分支数量

* Factory Chain: A Design Pattern for Factories with Generics by Hugo Troche - developer.\*, Developer Dot Star : [https://www.developerdotstar.com/mag/articles/troche\_factorychain.html](https://www.developerdotstar.com/mag/articles/troche_factorychain.html)

### Details

异常层次 \( 类父子关系 \)

* The Java Exception Class Hierarchy : [https://airbrake.io/blog/java-exception-handling/the-java-exception-class-hierarchy](https://airbrake.io/blog/java-exception-handling/the-java-exception-class-hierarchy)
  * 某类异常代表什么?
    * Error 系统异常 : 不应捕获
    * Exception : 可以捕获
    * Throwable : 包含 Error 和 Exception, 因此不应捕获它
    * RuntimeException : 非受查异常?
  * 什么时候该用哪个异常类?

为什么有的 Java 类写了一个 readResolve\(\) 方法?

* 从字节流序列化得到一个对象时, 相同的对象序列化为同一个单例对象!
* Java serialization: readObject\(\) vs. readResolve\(\) - Stack Overflow : [https://stackoverflow.com/questions/1168348/java-serialization-readobject-vs-readresolve](https://stackoverflow.com/questions/1168348/java-serialization-readobject-vs-readresolve)
* Java Object Serialization Specification: 3 - Object Input Classes : [https://www.math.uni-hamburg.de/doc/java/jdk1.4.1/docs/guide/serialization/spec/input.doc7.html](https://www.math.uni-hamburg.de/doc/java/jdk1.4.1/docs/guide/serialization/spec/input.doc7.html)

