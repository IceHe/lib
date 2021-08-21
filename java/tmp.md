# Tmp

## 一、Java 基础

1.  String 类为什么是 final 的

    -   final : 不可被继承 ( 即不可有子类 ) , 不可修改 ( 引用地址 / 指针 )
    -   好处 :
        -   方便实现 JVM 字符串常量池 → 节省内存
        -   不可修改 → 线程安全 ( 其它类似的 final class 也一样 )
            - "Because String objects are immutable they can be shared."

1.  HashMap 的源码，实现原理，底层结构。

1.  说说你知道的几个 Java 集合类：list、set、queue、map 实现类咯。。。

1.  描述一下 ArrayList 和 LinkedList 各自实现和区别

1.  Java 中的队列都有哪些，有什么区别。

1.  反射中，Class、forName 和 classloader 的区别，Class、forName 会执行静态代码块；

1.  Java7、Java8 的新特性(baidu 问的,好 BT)

1.  Java 数组和链表两种结构的操作效率，在哪些情况下(从开头开始，从结尾开始，从中间开始)，哪些操作(插入，查找，删除)的效率高

1.  Java 内存泄露的问题调查定位：jmap，jstack 的使用等等

1.  string、stringbuilder、stringbuffer 区别

1.  hashtable 和 hashmap 的区别

1.  异常的结构，运行时异常和非运行时异常，各举个例子

1.  Stringa=“abc”Stringb=“abc”Stringc=newString(“abc”)Stringd=“ab”+“c”、他们之间用==比较的结果

1.  String 类的常用方法

1.  Java 的引用类型有哪几种

1.  抽象类和接口的区别

1.  java 的基础类型和字节大小。

1.  Hashtable,HashMap,ConcurrentHashMap 底层实现原理与线程安全问题（建议熟悉 jdk 源码，才能从容应答）

1.  如果不让你用 JavaJdk 提供的工具，你自己实现一个 Map，你怎么做。说了好久，说了 HashMap 源代码，如果我做，就会借鉴 HashMap 的原理，说了一通 HashMap 实现

1.  Hash 冲突怎么办？哪些解决散列冲突的方法？

1.  HashMap 冲突很厉害，最差性能，你会怎么解决?从 O（n）提升到 log（n）咯，用二叉排序树的思路说了一通

1.  rehash

1.  hashCode()与 equals()生成算法、方法怎么重写

## 二、JavaIO

1. 讲讲 IO 里面的常见类，字节流、字符流、接口、实现类、方法阻塞。
1. 讲讲 NIO。
1. String 编码 UTF-8 和 GBK 的区别?
1. 什么时候使用字节流、什么时候使用字符流?
1. 递归读取文件夹下的文件，代码怎么实现

## 三、JavaWeb

1. session 和 cookie 的区别和联系，session 的生命周期，多个服务部署时 session 管理。
1. servlet 的一些相关问题
1. webservice 相关问题
1. jdbc 连接，forname 方式的步骤，怎么声明使用一个事务。举例并具体代码
1. 无框架下配置 web、xml 的主要配置内容
1. jsp 和 servlet 的区别

## 四、JVM

1. Java 的内存模型以及 GC 算法
1. jvm 性能调优都做了什么
1. 介绍 JVM 中 7 个区域，然后把每个区域可能造成内存的溢出的情况说明
1. 介绍 GC 和 GCRoot 不正常引用。
1. 自己从 classload 加载方式，加载机制说开去，从程序运行时数据区，讲到内存分配，讲到 String 常量池，讲到 JVM 垃圾回收机制，算法，hotspot。反正就是各种扩展
1. jvm 如何分配直接内存，new 对象如何不分配在堆而是栈上，常量池解析
1. 数组多大放在 JVM 老年代（不只是设置 PretenureSizeThreshold，问通常多大，没做过一问便知）
1. 老年代中数组的访问方式
1. GC 算法，永久代对象如何 GC，GC 有环怎么处理
1. 谁会被 GC，什么时候 GC
1. 如果想不被 GC 怎么办
1. 如果想在 GC 中生存 1 次怎么办

## 五、开源框架

1. hibernate 和 ibatis 的区别
1. 讲讲 mybatis 的连接池。
1. spring 框架中需要引用哪些 jar 包，以及这些 jar 包的用途
1. springMVC 的原理
1. springMVC 注解的意思
1. spring 中 beanFactory 和 ApplicationContext 的联系和区别
1. spring 注入的几种方式（循环注入）
1. spring 如何实现事物管理的
1. springIOC
1. springAOP 的原理
1. hibernate 中的 1 级和 2 级缓存的使用方式以及区别原理（Lazy-Load 的理解）
