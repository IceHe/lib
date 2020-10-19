# Java Notes

## Quickstart

- 我的阿里之路+Java面经考点 : https://juejin.im/post/5aa4a2e35188255589496eb8
- To Be Top Javaer - Java工程师成神之路 : https://github.com/hollischuang/toBeTopJavaer （内容好不好待验证）
    - HollisChuang's Blog-Java干货集散地 : https://www.hollischuang.com/

## Spring Boot Demos

- spring-boot-examples : https://github.com/ityouknow/spring-boot-examples
    - about learning Spring Boot via examples.
    - Spring Boot 教程、技术栈示例代码，快速简单上手教程

## IntelliJ IDEA Plugins

IntelliJ IDEA 18 周岁，吐血推进珍藏已久的必装插件 : https://www.hollischuang.com/archives/3220

- Maven Helper
- Lombok plugin
- google-java-format
- String Manipulation
- Key promoter X
- GsonFormat
- …

## Design Pattern

用 "静态工厂方法" 替代 "构造函数" 的优点

- [Java: The Factory Method Pattern](http://t.cn/E9O7ZRI )
- [Constructors or Static Factory Methods? - DZone Java]( http://t.cn/E9Oq9qC )

> Moving Logic Out of Constructors. If we just put this logic into the constructor, we’d be breaking the Single Responsibility Principle. We would **end up with a monolithic constructor that does a lot more than initialize fields**.

泛型类对象的工厂 & 使用责任链削减分支数量

- Factory Chain: A Design Pattern for Factories with Generics by Hugo Troche - developer.*, Developer Dot Star : https://www.developerdotstar.com/mag/articles/troche_factorychain.html

## readResolve

为什么有的 Java 类写了一个 readResolve() 方法?

- 从字节流序列化得到一个对象时, 相同的对象序列化为同一个单例对象!
- Java serialization: readObject() vs. readResolve() - Stack Overflow : https://stackoverflow.com/questions/1168348/java-serialization-readobject-vs-readresolve
- Java Object Serialization Specification: 3 - Object Input Classes : https://www.math.uni-hamburg.de/doc/java/jdk1.4.1/docs/guide/serialization/spec/input.doc7.html
