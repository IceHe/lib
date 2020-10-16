# Java Notes

## Startup

IntelliJ IDEA Plugins

- IntelliJ IDEA 18 周岁，吐血推进珍藏已久的必装插件 : https://www.hollischuang.com/archives/3220
    - Maven Helper
    - Lombok plugin
    - google-java-format
    - _阿里巴巴代码规约检测_
    - String Manipulation
    - Key promoter X
    - GsonFormat
    - …

Hello World

- spring-boot-examples : https://github.com/ityouknow/spring-boot-examples
    - about learning Spring Boot via examples.
    - Spring Boot 教程、技术栈示例代码，快速简单上手教程

Basics

- 我的阿里之路+Java面经考点 : https://juejin.im/post/5aa4a2e35188255589496eb8
- To Be Top Javaer - Java工程师成神之路 : https://github.com/hollischuang/toBeTopJavaer （内容好不好待验证）
    - HollisChuang's Blog-Java干货集散地 : https://www.hollischuang.com/

## Coding

### Read and Write Excel File

- How to Write to an Excel file in Java using Apache POI | CalliCoder : https://www.callicoder.com/java-write-excel-file-apache-poi/

### Spring ConstraintValidator

约束校验器

- JavaBean Validation - Object Association validation with @Valid
  : https://www.logicbig.com/tutorials/java-ee-tutorial/bean-validation/cascaded-validation.html

### Convert String to LocalDateTime

将字符串转换为日期对象

- Java 8 - How to convert String to LocalDate : https://www.mkyong.com/java8/java-8-how-to-convert-string-to-localdate/
    - Java 应该用 LocalDate / LocalTime / LocalDateTime 保存时间
    - 禁止使用 java.util.Date & java.text.SimpleDateFormat !

### Generate JavaDoc

如何生成 JavaDoc

- Intellij IDEA如何生成JavaDoc : https://www.jianshu.com/p/0ddb0864e499

## Design Pattern

用 "静态工厂方法" 替代 "构造函数" 的优点

- [Java: The Factory Method Pattern](http://t.cn/E9O7ZRI )
- [Constructors or Static Factory Methods? - DZone Java]( http://t.cn/E9Oq9qC )

> Moving Logic Out of Constructors. If we just put this logic into the constructor, we’d be breaking the Single Responsibility Principle. We would **end up with a monolithic constructor that does a lot more than initialize fields**.

泛型类对象的工厂 & 使用责任链削减分支数量

- Factory Chain: A Design Pattern for Factories with Generics by Hugo Troche - developer.*, Developer Dot Star : https://www.developerdotstar.com/mag/articles/troche_factorychain.html

## Details

异常层次 ( 类父子关系 )

- The Java Exception Class Hierarchy : https://airbrake.io/blog/java-exception-handling/the-java-exception-class-hierarchy
    - 某类异常代表什么?
        - Error 系统异常 : 不应捕获
        - Exception : 可以捕获
        - Throwable : 包含 Error 和 Exception, 因此不应捕获它
        - RuntimeException : 非受查异常?
    - 什么时候该用哪个异常类?

为什么有的 Java 类写了一个 readResolve() 方法?

- 从字节流序列化得到一个对象时, 相同的对象序列化为同一个单例对象!
- Java serialization: readObject() vs. readResolve() - Stack Overflow : https://stackoverflow.com/questions/1168348/java-serialization-readobject-vs-readresolve
- Java Object Serialization Specification: 3 - Object Input Classes : https://www.math.uni-hamburg.de/doc/java/jdk1.4.1/docs/guide/serialization/spec/input.doc7.html

## Notices

### Diff Throwable & Exception

References

- 9 Best Practices to Handle Exceptions in Java : https://stackify.com/best-practices-exceptions-java/
- java - Difference between using Throwable and Exception in a try catch - Stack Overflow : https://stackoverflow.com/questions/2274102/difference-between-using-throwable-and-exception-in-a-try-catch

决定

- 不该去 catch Throwable !
- 也不该去 catch Error 吧 ?

### generate serial version uid in IDEA

References

- java generate serialVersionUID - Google Search : https://www.google.com/search?newwindow=1&ei=siS3XIKAGMqT0gL-x4ioDA&q=java+generate+serialVersionUID&oq=java+generate+serialVersionUID&gs_l=psy-ab.3..0i7i30l5j0i8i7i30l4.2820.298466..299489...1.0..0.2351.7704.3-3j0j3j3j9-1......0....1..gws-wiz.......0i71j35i39.Hgb0WkftIFI
- SerialVersionUID in Java - GeeksforGeeks : https://www.geeksforgeeks.org/serialversionuid-in-java/
- Java serialVersionUID - How to generate serialVersionUID : https://howtodoinjava.com/java/serialization/serialversionuid/
- java - What is a serialVersionUID and why should I use it? - Stack Overflow : https://stackoverflow.com/questions/285793/what-is-a-serialversionuid-and-why-should-i-use-it
- java - How to generate serial version UID in Intellij - Stack Overflow : https://stackoverflow.com/questions/24573643/how-to-generate-serial-version-uid-in-intellij/24573768

### GsonFormat

- GitHub - zzz40500/GsonFormat: 根据Gson库使用的要求,将JSONObject格式的String  解析成实体 : https://github.com/zzz40500/GsonFormat

### Maven Dependencies Red Underlines

- Maven Dependencies Red underlines - IDEs Support (IntelliJ Platform) | JetBrains : https://intellij-support.jetbrains.com/hc/en-us/community/posts/207369215-Maven-Dependencies-Red-underlines

> **todd prickett** : _Created November 16, 2018 03:33_
>
> I agree with all the suggestions to delete the .idea directory.
>
> I tried a maven clean/compile from both inside and outside the IDE.  Both worked, but red squiggles remained.
>
> I tried clean, reimport from the Maven directory.  No joy.
>
> I tried restarting IntelliJ.  No joy.
>
> I tried Invalidate Caches/Restart.  No joy.
>
> Finally, I exited IntelliJ.  Deleted the .idea directory.  Imported a new project and chose the .pom file to import from.  Success.
