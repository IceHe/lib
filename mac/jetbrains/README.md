# JetBrains - VM Options

IDEs

- CLion
- IntelliJ IDEA
- PhpStorm
- PyCharm
- ……

- How to Edit
    - `Menu Bar` → `Help` → `Edit Custom VM Options…`
- File Path
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
