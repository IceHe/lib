# Java Exceptions

## Introduction

> 某类异常代表什么?

### Categories

> 分类

- **Error 系统异常 : 不应捕获**
- **Exception : 可以捕获**
- **Throwable : 包含 Error 和 Exception, 因此不应捕获它**
- **RuntimeException : 非受查异常**

### Unchecked Exception

> 非受查异常

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

> 什么时候该用哪个异常类?
>
> - Java 异常类继承层次 ( 类父子关系 )

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
