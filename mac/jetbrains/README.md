# JetBrains

IDEs

- CLion
- IntelliJ IDEA
- PhpStorm
- PyCharm
- ……

## VM Options

- How to Edit
    - `Menu Bar` → `Help` → `Edit Custom VM Options…`
- File Path
    - IntelliJ IDEA : `/Users/[USERNAME]/Library/Application Support/JetBrains/IntelliJIdea2020.1/idea.vmoptions`

### References

- https://www.oracle.com/java/technologies/javase/vmoptions-jsp.html
- https://docs.oracle.com/javase/8/docs/technotes/tools/windows/java.html
- https://zhuanlan.zhihu.com/p/126355599
- https://intellij-support.jetbrains.com/hc/en-us/articles/206544879-Selecting-the-JDK-version-the-IDE-will-run-under
- https://docs.oracle.com/en/java/javase/11/gctuning/garbage-first-garbage-collector.html#GUID-ED3AB6D3-FD9B-4447-9EDF-983ED2F7A573

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
