# Java Exception Class Hierarchy

> Java 异常类继承层次 ( 类父子关系 )

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

- TODO

> 什么时候该用哪个异常类?

## Throwable

### Error

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

### Exception

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
- RuntimeException
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
