# Java Exceptions

## Introduction

**某类异常代表什么?**

### Categories

**分类**

- **Error 系统异常 : 不应捕获**
- **Exception : 可以捕获**
- **Throwable : 包含 Error 和 Exception, 因此不应捕获它**
- **RuntimeException : 非受查异常**

### Unchecked Exception

**非受查异常**

- Unchecked Exceptions - The Controversy - Oracle Docs : https://docs.oracle.com/javase/tutorial/essential/exceptions/runtime.html
- Checked and Unchecked Exceptions in Java - Baeldung.com : https://www.baeldung.com/java-checked-unchecked-exceptions#when

> "If it's so good to document a method's API, including the exceptions it can throw, why not specify runtime exceptions too?"
>
> - **Runtime exceptions represent problems that are the result of a programming problem**, and as such, the **API client code cannot reasonably be expected to recover from them or to handle them in any way**.
> - _Such problems include arithmetic exceptions, such as dividing by zero; pointer exceptions, such as trying to access an object through a null reference; and indexing exceptions, such as attempting to access an array element through an index that is too large or too small._
>
> Here's the **bottom line guideline** :
>
> - **If a client can reasonably be expected to recover from an exception, make it a checked exception.**
> - **If a client cannot do anything to recover from the exception, make it an unchecked exception.**

- Are checked exceptions good or bad? : https://www.infoworld.com/article/3142626/are-checked-exceptions-good-or-bad.html

> - **Checked exceptions are not really exceptions.**
>     - The thing about checked exceptions is that they are not really exceptions by the usual understanding of the concept.
>     - Instead, **they are API alternative return values.**

## Class Hierarchy

**什么时候该用哪个异常类?**

- Java 异常类继承层次 ( 类父子关系 )

References

- The Java Exception Class Hierarchy : https://airbrake.io/blog/java-exception-handling/the-java-exception-class-hierarchy

### Throwable

Differ Throwable and Exception

- References
    - 9 Best Practices to Handle Exceptions in Java : https://stackify.com/best-practices-exceptions-java/
    - java - Difference between using Throwable and Exception in a try catch - Stack Overflow : https://stackoverflow.com/questions/2274102/difference-between-using-throwable-and-exception-in-a-try-catch

#### _Error_

- AssertionError
- LinkageError
    - BootstrapMethodError
    - ClassCircularityError
    - ClassFormatError
        - [UnsupportedClassVersionError](https://airbrake.io/blog/java-exception-handling/unsupportedclassversionerror)
    - [ExceptionInInitializerError](https://airbrake.io/blog/java-exception-handling/exceptionininitializererror)
    - IncompatibleClassChangeError
        - AbstractMethodError
        - IllegalAccessError
        - InstantiationError
        - NoSuchFieldError
        - NoSuchMethodError
    - [NoClassDefFoundError](https://airbrake.io/blog/java-exception-handling/noclassdeffounderror)
    - [UnsatisfiedLinkError](https://airbrake.io/blog/java-exception-handling/unsatisfiedlinkerror)
    - VerifyError
- ~~ThreadDeath~~ _( deprecated )_
- VirtualMachineError
    - InternalError
    - [OutOfMemoryError](https://airbrake.io/blog/java-exception-handling/outofmemoryerror)
    - [StackOverflowError](https://airbrake.io/blog/java-exception-handling/stackoverflowerror)
    - UnknownError

#### Exception

- CloneNotSupportedException
- InterruptedException
- IOException
    - [FileNotFoundException](https://airbrake.io/blog/java-exception-handling/filenotfoundexception)
    - SocketException
        - [ConnectException](https://airbrake.io/blog/java-exception-handling/connectexception)
    - [UnknownHostException](https://airbrake.io/blog/java-exception-handling/unknownhostexception)
- ReflectiveOperationException
    - [ClassNotFoundException](https://airbrake.io/blog/java-exception-handling/classnotfoundexception)
    - IllegalAccessException
    - InstantiationException
    - [InvocationTargetException](https://airbrake.io/blog/java-exception-handling/invocationtargetexception)
    - NoSuchFieldException
    - [NoSuchMethodException](https://airbrake.io/blog/java-exception-handling/nosuchmethoderror)
- RuntimeException _( Unchecked Exception )_
    - ArithmeticException
    - ArrayStoreException
    - [ClassCastException](https://airbrake.io/blog/java-exception-handling/classcastexception)
    - ConcurrentModificationException
    - EnumConstantNotPresentException
    - [IllegalArgumentException](https://airbrake.io/blog/java-exception-handling/illegalargumentexception)
        - IllegalThreadStateException
        - [NumberFormatException](https://airbrake.io/blog/java-exception-handling/numberformatexception)
    - IllegalMonitorStateException
    - [IllegalStateException](https://airbrake.io/blog/java-exception-handling/illegalstateexception)
    - [IndexOutOfBoundsException](https://airbrake.io/blog/java-exception-handling/indexoutofboundsexception)
        - [ArrayIndexOutOfBoundsException](https://airbrake.io/blog/java-exception-handling/arrayindexoutofboundsexception)
        - StringIndexOutOfBoundsException
    - NegativeArraySizeException
    - [NullPointerException](https://airbrake.io/blog/java-exception-handling/nullpointerexception)
    - SecurityException
    - TypeNotPresentException
    - UnsupportedOperationException

## Checked Exception Arguement

> 相关争论

- [The Trouble with Checked Exceptions](https://www.artima.com/articles/the-trouble-with-checked-exceptions)
- [Kotlin 和 Checked Exception](https://www.yinwang.org/blog-cn/2017/05/23/kotlin)
- [如何评价王垠的《Kotlin和Checked Exception》?](https://www.zhihu.com/question/60240474)
    -   [Checked Exception 和 Java 标准库自相矛盾](https://www.zhihu.com/question/60240474/answer/174540315)
        把异常不分青红皂白包装成 RuntimeException 的“设计模式”，早已是 Java 程序员大家都知道的秘密，但标准库中加入 UncheckedIOException 可能算是第一次官方承认这个秘密吧。
    -   [应该是用于传递特定信息，触发特定操作的一种编程机制](https://www.zhihu.com/question/60240474/answer/173856389)
        真正的CE是编程者专门设计的，用于传递特定信息，触发特定操作的一种编程机制。也就是说，throw点和catch点是一个整体设计的两部分，而不是“不管你怎么处理，反正我会throw 它”。反观Java，在类库层面提供的大量通用CE，都是毫无意义的。
    -   [不应该去捕获其它函数抛出的异常，而应该去捕获你需要处理的异常](https://www.zhihu.com/question/60240474/answer/174070501)
        CE之所以没什么用，最根本的原因是，你不应该去捕获其它函数抛出的异常，而应该去捕获你需要处理的异常，在函数签名里写或者不写某个东西对这一目标毫无帮助。需要捕获的异常仅仅包括运行时才会产生的、事先可以预料到的、并且可以恢复的异常，比如磁盘满网络断了之类，其它所有的异常只意味着程序错误，掩盖它们是没用的。

自己的想法

- Fail Fast 策略是合理的
    - 把 Checked Expcetion 包装成 RuntimeException 抛出去就完事了…
    - _像是在 Java 里给方法加 lombok 的注解 `@SneakyThrow`_
- 如果你还想着使用 Checked Exception, 或许可以这么做?
    - 改为抛出其它 RuntimeException 的子类 _( 自行定义, 以区分各种意外情况 )_
    - 然后把会抛出的异常, 添加到 JavaDoc `@throw` 的注释说明中 _( 关心异常的调用方, 自行决定处理或忽略异常 )_
