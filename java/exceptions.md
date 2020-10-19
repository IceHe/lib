# Java Exceptions


References

- The Java Exception Class Hierarchy : https://airbrake.io/blog/java-exception-handling/the-java-exception-class-hierarchy

## Introduction

> 某类异常代表什么?

Categories 分类

- **Error 系统异常 : 不应捕获**
- **Exception : 可以捕获**
- **Throwable : 包含 Error 和 Exception, 因此不应捕获它**
- **RuntimeException : 非受查异常**

Unchecked Exception 非受查异常

- References
    - Unchecked Exceptions - The Controversy - Oracle Docs : https://docs.oracle.com/javase/tutorial/essential/exceptions/runtime.html

## Class Hierarchy

> 什么时候该用哪个异常类?
>
> - Java 异常类继承层次 ( 类父子关系 )

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
        - UnsupportedClassVersionError
    - ExceptionInInitializerError
    - IncompatibleClassChangeError
        - AbstractMethodError
        - IllegalAccessError
        - InstantiationError
        - NoSuchFieldError
        - NoSuchMethodError
    - NoClassDefFoundError
    - UnsatisfiedLinkError
    - VerifyError
- ~~ThreadDeath~~ _( deprecated )_
- VirtualMachineError
    - InternalError
    - OutOfMemoryError
    - StackOverflowError
    - UnknownError

#### Exception

- CloneNotSupportedException
- InterruptedException
- IOException
    - FileNotFoundException
    - SocketException
        - ConnectException
    - UnknownHostException
- ReflectiveOperationException
    - ClassNotFoundException
    - IllegalAccessException
    - InstantiationException
    - InvocationTargetException
    - NoSuchFieldException
    - NoSuchMethodException
- RuntimeException _( Unchecked Exception )_
    - ArithmeticException
    - ArrayStoreException
    - ClassCastException
    - ConcurrentModificationException
    - EnumConstantNotPresentException
    - IllegalArgumentException
        - IllegalThreadStateException
        - NumberFormatException
    - IllegalMonitorStateException
    - IllegalStateException
    - IndexOutOfBoundsException
        - ArrayIndexOutOfBoundsException
        - StringIndexOutOfBoundsException
    - NegativeArraySizeException
    - NullPointerException
    - SecurityException
    - TypeNotPresentException
    - UnsupportedOperationException
