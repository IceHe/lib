# JetBrains - VM Options

IDEs

- CLion
- IntelliJ IDEA
- PhpStorm
- PyCharm
- ……

How to Edit

- `Menu Bar` → `Help` → `Edit Custom VM Options…`

File Path

- IntelliJ IDEA : `/Users/[USERNAME]/Library/Application Support/JetBrains/IntelliJIdea2020.1/idea.vmoptions`

## References

- 习惯使用 Eclipse, 如何快速上手 IDEA ? 6. 设置 IDEA 优化 JVM 参数 : https://zhuanlan.zhihu.com/p/126355599
- Java HotSpot VM Options : https://www.oracle.com/java/technologies/javase/vmoptions-jsp.html
- Java SE 11 Docs - Tools References - `java` : https://docs.oracle.com/en/java/javase/11/tools/java.html
- Java SE 11 Docs - HotSpot Virtual Machine Garbage Collection Tuning Guide : https://docs.oracle.com/en/java/javase/11/gctuning/garbage-first-garbage-collector.html
- Selecting the JDK version the IDE will run under - JetBrains IDEs Support : https://intellij-support.jetbrains.com/hc/en-us/articles/206544879-Selecting-the-JDK-version-the-IDE-will-run-under

## Expaination

- `-Xms size` Sets the **initial size** (in bytes) of the **heap**.
    - _This value must be a multiple of 1024 and greater than 1 MB._
    - _Append the letter k or K to indicate kilobytes, m or M to indicate megabytes, g or G to indicate gigabytes._
- `-Xmx size` Specifies the **maximum size** (in bytes) of the **memory allocation pool**.
    - _It is equivalent to `-XX:MaxHeapSize`._
    - _The default value is chosen at runtime based on system configuration._
    - **For server deployments, `-Xms` and `-Xmx` are often set to the same value.**
- `-XX:+UseConcMarkSweepGC` Enables the use of the **CMS garbage collector for the old generation**.
    - CMS is an alternative to the default garbage collector (G1), which also focuses on meeting application latency requirements.
    - _By default, this option is disabled and the collector is selected automatically based on the configuration of the machine and type of the JVM._
    - _The CMS garbage collector is **deprecated**._
- `-XX:+UseParNewGC` Enables the use of **parallel threads for collection in the young generation**.
    - _By default, this option is disabled._
    - It's **automatically enabled when you set the `-XX:+UseConcMarkSweepGC` option**.
    - _Using the `-XX:+UseParNewGC` option without the `-XX:+UseConcMarkSweepGC` option was **deprecated** in JDK 8._
    - _All uses of the `-XX:+UseParNewGC` option are **deprecated**._
    - Using the option without `-XX:+UseConcMarkSweepGC` isn't possible.
- `-XX:+UseCompressedOops` Enable the use of **compressed pointers**.
    - _By default, this option is enabled, and compressed pointers are used when Java heap sizes are less than 32 GB._
    - When this option is enabled, **object references are represented as 32-bit offsets instead of 64-bit pointers, which typically increases performance when running the application with Java heap sizes of less than 32 GB**.
    - This option works **only for 64-bit JVMs**.
- `-XX:+HeapDumpOnOutOfMemoryError` Enables **dumping the Java heap** to a file in the current directory by **using the heap profiler (HPROF) when a `java.lang.OutOfMemoryError` exception is thrown**.
    - _You can explicitly set the heap dump file path and name using the `-XX:HeapDumpPath` option._
    - _By default, this option is disabled and the heap isn't dumped when an OutOfMemoryError exception is thrown._
- `-XX:HeapDumpPath=path` **Sets the path and file name for writing the heap dump** provided by the heap profiler (HPROF) when the `-XX:+HeapDumpOnOutOfMemoryError` option is set.
    - By default, the file is created in the current working directory, and it's named `java_pid<pid>.hprof` where \<pid\> is the identifier of the process that caused the error.
    - _The following example shows how to set the default file explicitly ( **%p represents the current process identifier** ) :_
        - `-XX:HeapDumpPath=./java_pid%p.hprof`
- `-XX:-OmitStackTraceInFastThrow`
    - The compiler in the server VM now provides correct stack backtraces for all "cold" built-in exceptions.
    - For performance purposes, when such an exception is thrown a few times, the method may be recompiled.
    - After recompilation, the compiler may choose a faster tactic using preallocated exceptions that do not provide a stack trace.
    - To **disable completely the use of preallocated exceptions**, use this new flag: `-XX:-OmitStackTraceInFastThrow`.
    - References :
        - https://stackoverflow.com/questions/2411487/nullpointerexception-in-java-with-no-stacktrace
        - https://www.oracle.com/java/technologies/javase/release-notes-Introduction.html#vm
- `-XX:CICompilerCount=threads` Sets the **number of compiler threads to use for compilation**.
    - By default, the number of threads is set to 2 for the server JVM, to 1 for the client JVM, and it scales to the number of cores if **tiered compilation** _( 分层编译 )_ is used.
    - _The following example shows how to set the number of threads to 2 : `-XX:CICompilerCount=2`_
- `-XX:ErrorFile=filename` Specifies the **path and file name to which error data is written when an irrecoverable error occurs**.
    - By default, this file is created in the current working directory and named `hs_err_pidpid.log` where pid is the identifier of the process that caused the error.
- `-XX:ReservedCodeCacheSize=size` Sets the **maximum code cache size (in bytes) for JIT-compiled code**.
    - _The default maximum code cache size is 240 MB, unless you disable tiered compilation with the option `-XX:-TieredCompilation`, then the default size is 48 MB._
    - This option has a **limit of 2 GB**; otherwise, an error is generated.
    - The maximum code cache size shouldn't be less than the initial code cache size.
    - _See the option `-XX:InitialCodeCacheSize`._
- `-XX:SoftRefLRUPolicyMSPerMB=time` Sets the **amount of time (in milliseconds) a softly reachable object is kept active on the heap** after the last time it was referenced.
    - The default value is one second of lifetime per free megabyte in the heap.
    - The `-XX:SoftRefLRUPolicyMSPerMB` option accepts integer values representing milliseconds per one megabyte of the current heap size (for Java HotSpot Client VM) or the maximum possible heap size (for Java HotSpot Server VM).
    - This difference means that the Client VM tends to flush soft references rather than grow the heap, whereas the Server VM tends to grow the heap rather than flush soft references.
    - In the latter case, the value of the `-Xmx` option has a significant effect on how quickly soft references are garbage collected.
- `-Xverify:none` Disables the verifier.
    - Note: This is not a supported configuration and, as noted, was **deprecated from Java 13**.
    - _If you encounter problems with the verifier turned off, remove this option and try to reproduce the problem._
    - References :
        - Java 8 : https://docs.oracle.com/javase/8/docs/technotes/tools/windows/java.html
        - OpenJ9 : https://www.eclipse.org/openj9/docs/xverify/
- `-Dfile.encoding=UTF-8`
    - References :
        - OpenJ9 :  https://www.eclipse.org/openj9/docs/dfileencoding/
- `-Djava.net.preferIPv4Stack=true` To **enforce IPv4 preference over IPv6**.
    - _IPv4 is required by Oracle Identity Analytics for network communication._
    - _Refer to the operating system documentation for instructions to enable IPv4 stack._
    - References :
        - Oracle : https://docs.oracle.com/cd/E27119_01/doc.11113/e23126/installationandupgradeguideprintable36.html
        - IBM : https://www.ibm.com/support/pages/ipv6-can-cause-poor-java-performance
- `-Djdk.attach.allowAttachSelf`
    - _( icehe : 对这个参数搞得还不是很清楚, 不折腾了 )_
    - References :
        - Stack Overflow : https://stackoverflow.com/questions/47522449/jmockit-error-on-initialization-java-lang-illegalstateexception-running-on-jdk/47522648#47522648
        - ROOKOUT Documentation : https://docs.rookout.com/docs/jvm-setup/
        - Oracle : https://www.oracle.com/java/technologies/javase/9-notes.html
- `-Djdk.http.auth.tunneling.disabledSchemes=""` To re-enable **basic authentication for Proxy**.
    - Cause : **In Java 8u111, Basic authentication for HTTPS tunneling was disabled by default**.
    - References :
        - Basic authentication fails for outgoing proxy in Java 8u111 - Atlassian Documentation : https://confluence.atlassian.com/kb/basic-authentication-fails-for-outgoing-proxy-in-java-8u111-909643110.html
- `-Dkotlinx.coroutines.debug=off`
    - _( icehe : 对这个参数搞得还不是很清楚, 应该就是 "关闭对 Kotlin 语言 coroutines 的 debug 功能" )_
    - References :
        - Kotlin : https://kotlin.github.io/kotlinx.coroutines/kotlinx-coroutines-debug/
- `-Dsun.io.useCanonPrefixCache=false` **Disable Java's canonicalization cache**.
    - _This can be done by setting the system properties `sun.io.useCanonCaches` and `sun.io.useCanonPrefixCache` to false._
    - _By default, canonical file names are cached for 30 seconds ( read from source [here](http://www.docjar.com/html/api/java/io/ExpiringCache.java.html) ) ._
    - References :
        - Stack Overflow : https://stackoverflow.com/questions/7479198/canonical-file-path-in-java-optimization-problem
        - Coder Work : https://www.coder.work/article/860466
- `-ea` **Enables assertions**.
    - Synopsis : `-enableassertions[:[packagename]...|:classname] or -ea[:[packagename]...|:classname]`
        - By default, assertions are disabled in all packages and classes.
        - With no arguments, `-enableassertions` (-ea) enables assertions in all packages and classes.
        - _With the packagename argument ending in ..., the switch enables assertions in the specified package and any subpackages._
        - _If the argument is simply ..., then the switch enables assertions in the unnamed package in the current working directory._
        - _With the classname argument, the switch enables assertions in the specified class._
    - _The `-enableassertions` (-ea) option applies to all class loaders and to system classes (which don't have a class loader)._
        - _There's one exception to this rule :_
            - _If the option is provided with no arguments, then it doesn't apply to system classes._
        - _This makes it easy to enable assertions in all classes except for system classes._
        - _The `-enablesystemassertions` option provides a separate switch to enable assertions in all system classes._
        - _To explicitly disable assertions in specific packages or classes, use the `-disableassertions` (-da) option._
        - _If a single command contains multiple instances of these switches, then they're processed in order, before loading any classes._
    - _For example, to run the MyClass application with assertions enabled only in the package com.wombat.fruitbat (and any subpackages) but disabled in the class com.wombat.fruitbat.Brickbat, use the following command:_
        - `java -ea:com.wombat.fruitbat... -da:com.wombat.fruitbat.Brickbat MyClass`

## Versions

### Use CMS _( beofre 2019.9 )_

- `-XX:+UseConcMarkSweepGC`

```bash
-Xms1024m
-Xmx1024m
-XX:+UseConcMarkSweepGC
-XX:+UseCompressedOops
-XX:+HeapDumpOnOutOfMemoryError
-XX:-OmitStackTraceInFastThrow
-XX:CICompilerCount=2
-XX:ErrorFile=$USER_HOME/java_error_in_idea_%p.log
-XX:HeapDumpPath=$USER_HOME/java_error_in_idea.hprof
-XX:ReservedCodeCacheSize=240m
-XX:SoftRefLRUPolicyMSPerMB=50
-Xverify:none
-Dfile.encoding=UTF-8
-Djava.net.preferIPv4Stack=true
-Djdk.attach.allowAttachSelf
-Djdk.http.auth.tunneling.disabledSchemes=""
-Dkotlinx.coroutines.debug=off
-Dsun.io.useCanonPrefixCache=false
-ea
```

### Try ZGC _( 2020.09.03 )_

- `-XX:+UseConcMarkSweepGC`
- `-XX:+UseZGC`

```bash
-Xms1024m
-Xmx1024m
-XX:+UnlockExperimentalVMOptions
-XX:+UseZGC
-XX:+UseCompressedOops
-XX:+HeapDumpOnOutOfMemoryError
-XX:-OmitStackTraceInFastThrow
-XX:CICompilerCount=2
-XX:ErrorFile=$USER_HOME/java_error_in_idea_%p.log
-XX:HeapDumpPath=$USER_HOME/java_error_in_idea.hprof
-XX:ReservedCodeCacheSize=240m
-XX:SoftRefLRUPolicyMSPerMB=50
-Xverify:none
-Dfile.encoding=UTF-8
-Djava.net.preferIPv4Stack=true
-Djdk.attach.allowAttachSelf
-Djdk.http.auth.tunneling.disabledSchemes=""
-Dkotlinx.coroutines.debug=off
-Dsun.io.useCanonPrefixCache=false
-ea
```

### Use ZGC _( 2020.09.04 )_

- `-XX:+UseG1GC`

```bash
-Xms1024m
-Xmx1024m
-XX:+UseG1GC
-XX:+UseCompressedOops
-XX:+HeapDumpOnOutOfMemoryError
-XX:-OmitStackTraceInFastThrow
-XX:CICompilerCount=2
-XX:ErrorFile=$USER_HOME/java_error_in_idea_%p.log
-XX:HeapDumpPath=$USER_HOME/java_error_in_idea.hprof
-XX:ReservedCodeCacheSize=240m
-XX:SoftRefLRUPolicyMSPerMB=50
-Xverify:none
-Dfile.encoding=UTF-8
-Djava.net.preferIPv4Stack=true
-Djdk.attach.allowAttachSelf
-Djdk.http.auth.tunneling.disabledSchemes=""
-Dkotlinx.coroutines.debug=off
-Dsun.io.useCanonPrefixCache=false
-ea
```
