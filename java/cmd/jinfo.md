# jinfo

> Configuration Info for Java : generate Java configuration information for a specified Java process

References

- `man jinfo`
- Understand the JVM - 2nd Edition - ZH Ver. - P143
- Java SE 14 Docs - Tools References - `jinfo` : https://docs.oracle.com/en/java/javase/14/docs/specs/man/jinfo.html

## Quickstart

```bash
# Show All
jinfo 12345

# Show Flags
jinfo -flag [flag_name] 12345
jinfo -flags 12345

# Show System Properties
jinfo -sysprops 12345
```

## Synopsis

```bash
jinfo [ option ] pid
jinfo [ option ] executable core
jinfo [ option ] [ server-id@ ] remote-hostname-or-IP
```

## Options

- `-flag name` Prints the name and value of the specified command-line flag.
- `-flag [+|-]name` Enables or disables the specified Boolean command-line flag.
- `-flag name=value` Sets the specified command-line flag to the specified value.
- `-flags` Prints command-line flags passed to the JVM.
- `-sysprops` Prints Java system properties as name-value pairs.

## Usage

### Default

```bash
# IntelliJ IDEA
$ jinfo 581
Java System Properties:
#Thu Aug 20 15:10:33 CST 2020
awt.toolkit=sun.lwawt.macosx.LWCToolkit
java.specification.version=11
kotlinx.coroutines.debug=off
sun.cpu.isalist=
sun.jnu.encoding=UTF-8
sun.arch.data.model=64
sun.io.useCanonPrefixCache=false
idea.fatal.error.notification=disabled
sun.font.fontmanager=sun.font.CFontManager
pty4j.preferred.native.folder=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/pty4j-native
java.vendor.url=https\://www.jetbrains.com/
apple.awt.fileDialogForDirectories=true
sun.java2d.uiScale.enabled=true
jna.tmpdir=/Users/mac/Library/Caches/JetBrains/IntelliJIdea2020.1/tmp
sun.boot.library.path=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/jbr/Contents/Home/lib
jdk.debug=release
sun.awt.exception.handler=com.intellij.openapi.application.impl.AWTExceptionHandler
com.apple.mrj.application.live-resize=false
java.specification.vendor=Oracle Corporation
java.version.date=2020-04-14
java.home=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/jbr/Contents/Home
file.separator=/
java.vm.compressedOopsMode=Zero based
line.separator=\n
java.specification.name=Java Platform API Specification
java.vm.specification.vendor=Oracle Corporation
jdk.attach.allowAttachSelf=
idea.home.path=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents
pty4j.tmpdir=/Users/mac/Library/Caches/JetBrains/IntelliJIdea2020.1/tmp
sun.management.compiler=HotSpot 64-Bit Tiered Compilers
java.runtime.version=11.0.7+10-b765.65
apple.awt.fullscreencapturealldisplays=false
user.name=mac
javax.swing.rebaseCssSizeMap=true
idea.paths.selector=IntelliJIdea2020.1
sun.java2d.pmoffscreen=false
sun.awt.noerasebackground=true
file.encoding=UTF-8
jnidispatch.path=/Users/mac/Library/Caches/JetBrains/IntelliJIdea2020.1/tmp/jna9364687959430014718.tmp
idea.popup.weight=heavy
java.vendor.version=JBR-11.0.7.10-765.65-jfx
jna.loaded=true
java.io.tmpdir=/var/folders/8r/42_nykb97xjdkh9c1p4d5c7w0000gn/T/
java.version=11.0.7
idea.xdebug.key=-Xdebug
java.vm.specification.name=Java Virtual Machine Specification
idea.jre.check=true
java.awt.printerjob=sun.lwawt.macosx.CPrinterJob
sun.os.patch.level=unknown
java.library.path=/Users/mac/Library/Java/Extensions\:/Library/Java/Extensions\:/Network/Library/Java/Extensions\:/System/Library/Java/Extensions\:/usr/lib/java\:.
java.vendor=JetBrains s.r.o.
io.netty.processId=52995
sun.io.unicode.encoding=UnicodeBig
java.rmi.server.disableHttp=true
io.netty.machineId=28\:f0\:76\:ff\:fe\:16\:65\:0e
idea.executable=idea
gopherProxySet=false
CVS_PASSFILE=~/.cvspass
idea.smooth.progress=false
java.class.path=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/bootstrap.jar\:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/extensions.jar\:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/util.jar\:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/jdom.jar\:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/log4j.jar\:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/trove4j.jar\:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/jna.jar
sun.awt.enableExtraMouseButtons=true
java.vm.vendor=JetBrains s.r.o.
idea.vendor.name=JetBrains
user.timezone=Asia/Shanghai
jb.vmOptionsFile=/Users/mac/Library/Application Support/JetBrains/IntelliJIdea2020.1/idea.vmoptions
idea.no.launcher=false
swing.bufferPerWindow=true
os.name=Mac OS X
java.vm.specification.version=11
apple.laf.useScreenMenuBar=true
user.country=CN
sun.cpu.endian=little
user.home=/Users/mac
jdk.http.auth.tunneling.disabledSchemes=""
user.language=en
idea.cycle.buffer.size=1024
io.netty.allocator.numHeapArenas=1
log4j.defaultInitOverride=true
java.awt.graphicsenv=sun.awt.CGraphicsEnvironment
apple.awt.graphics.UseQuartz=true
io.netty.allocator.numDirectArenas=1
idea.max.intellisense.filesize=2500
sun.java2d.d3d=false
java.net.preferIPv4Stack=true
io.netty.allocator.useCacheForAllThreads=false
path.separator=\:
com.jetbrains.suppressWindowRaise=true
os.version=10.14.6
jna.nosys=true
java.endorsed.dirs=
java.runtime.name=OpenJDK Runtime Environment
io.netty.allocator.cacheTrimIntervalMillis=600000
sun.nio.ch.bugLevel=
java.vm.name=OpenJDK 64-Bit Server VM
jna.platform.library.path=/usr/lib\:/usr/lib
java.vendor.url.bug=https\://youtrack.jetbrains.com
java.util.concurrent.ForkJoinPool.common.threadFactory=com.intellij.concurrency.IdeaForkJoinWorkerThreadFactory
user.dir=/
os.arch=x86_64
io.netty.serviceThreadPrefix=Netty
idea.dynamic.classpath=false
java.vm.info=mixed mode
java.vm.version=11.0.7+10-b765.65
java.rmi.server.hostname=127.0.0.1
idea.max.content.load.filesize=20000
apple.awt.UIElement=true
java.class.version=55.0

VM Flags:
-XX:-BytecodeVerificationLocal -XX:-BytecodeVerificationRemote -XX:CICompilerCount=2 -XX:ErrorFile=/Users/mac/java_error_in_idea_%p.log -XX:+HeapDumpOnOutOfMemoryError -XX:HeapDumpPath=/Users/mac/java_error_in_idea.hprof -XX:InitialHeapSize=134217728 -XX:MaxHeapSize=1073741824 -XX:MaxNewSize=348913664 -XX:MaxTenuringThreshold=6 -XX:MinHeapDeltaBytes=196608 -XX:NewSize=44695552 -XX:NonNMethodCodeHeapSize=5825164 -XX:NonProfiledCodeHeapSize=122916538 -XX:OldSize=89522176 -XX:-OmitStackTraceInFastThrow -XX:ProfiledCodeHeapSize=122916538 -XX:ReservedCodeCacheSize=251658240 -XX:+SegmentedCodeCache -XX:SoftRefLRUPolicyMSPerMB=50 -XX:+UseCompressedClassPointers -XX:+UseCompressedOops -XX:+UseConcMarkSweepGC -XX:+UseFastUnorderedTimeStamps

VM Arguments:
jvm_args: -Xms128m -Xmx1024m -XX:ReservedCodeCacheSize=240m -XX:+UseCompressedOops -Dfile.encoding=UTF-8 -XX:+UseConcMarkSweepGC -XX:SoftRefLRUPolicyMSPerMB=50 -ea -XX:CICompilerCount=2 -Dsun.io.useCanonPrefixCache=false -Djava.net.preferIPv4Stack=true -Djdk.http.auth.tunneling.disabledSchemes="" -XX:+HeapDumpOnOutOfMemoryError -XX:-OmitStackTraceInFastThrow -Djdk.attach.allowAttachSelf -Dkotlinx.coroutines.debug=off -Xverify:none -XX:ErrorFile=/Users/mac/java_error_in_idea_%p.log -XX:HeapDumpPath=/Users/mac/java_error_in_idea.hprof -Djb.vmOptionsFile=/Users/mac/Library/Application Support/JetBrains/IntelliJIdea2020.1/idea.vmoptions -Didea.home.path=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents -Didea.executable=idea -Didea.paths.selector=IntelliJIdea2020.1 -Didea.vendor.name=JetBrains
java_command: <unknown>
java_class_path (initial): /Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/bootstrap.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/extensions.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/util.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/jdom.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/log4j.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/trove4j.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/jna.jar
Launcher Type: generic
```

### Flags

```bash
# IntelliJ IDEA
$ jinfo -flags 581
VM Flags:
-XX:-BytecodeVerificationLocal -XX:-BytecodeVerificationRemote -XX:CICompilerCount=2 -XX:ErrorFile=/Users/mac/java_error_in_idea_%p.log -XX:+HeapDumpOnOutOfMemoryError -XX:HeapDumpPath=/Users/mac/java_error_in_idea.hprof -XX:InitialHeapSize=134217728 -XX:MaxHeapSize=1073741824 -XX:MaxNewSize=348913664 -XX:MaxTenuringThreshold=6 -XX:MinHeapDeltaBytes=196608 -XX:NewSize=44695552 -XX:NonNMethodCodeHeapSize=5825164 -XX:NonProfiledCodeHeapSize=122916538 -XX:OldSize=89522176 -XX:-OmitStackTraceInFastThrow -XX:ProfiledCodeHeapSize=122916538 -XX:ReservedCodeCacheSize=251658240 -XX:+SegmentedCodeCache -XX:SoftRefLRUPolicyMSPerMB=50 -XX:+UseCompressedClassPointers -XX:+UseCompressedOops -XX:+UseConcMarkSweepGC -XX:+UseFastUnorderedTimeStamps
```

### Flag

```bash
# IntelliJ IDEA
$ jinfo -flag CMSInitiatingOccupancyFraction 581
-XX:CMSInitiatingOccupancyFraction=-1
```

### System Properties

```bash
# IntelliJ IDEA
$ jinfo -sysprops 581

Java System Properties:
#Thu Aug 20 15:19:28 CST 2020
awt.toolkit=sun.lwawt.macosx.LWCToolkit
java.specification.version=11
kotlinx.coroutines.debug=off
sun.cpu.isalist=
sun.jnu.encoding=UTF-8
sun.arch.data.model=64
sun.io.useCanonPrefixCache=false
idea.fatal.error.notification=disabled
sun.font.fontmanager=sun.font.CFontManager
pty4j.preferred.native.folder=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/pty4j-native
java.vendor.url=https\://www.jetbrains.com/
apple.awt.fileDialogForDirectories=true
sun.java2d.uiScale.enabled=true
jna.tmpdir=/Users/mac/Library/Caches/JetBrains/IntelliJIdea2020.1/tmp
sun.boot.library.path=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/jbr/Contents/Home/lib
jdk.debug=release
sun.awt.exception.handler=com.intellij.openapi.application.impl.AWTExceptionHandler
com.apple.mrj.application.live-resize=false
java.specification.vendor=Oracle Corporation
java.version.date=2020-04-14
java.home=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/jbr/Contents/Home
file.separator=/
java.vm.compressedOopsMode=Zero based
line.separator=\n
java.specification.name=Java Platform API Specification
java.vm.specification.vendor=Oracle Corporation
jdk.attach.allowAttachSelf=
idea.home.path=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents
pty4j.tmpdir=/Users/mac/Library/Caches/JetBrains/IntelliJIdea2020.1/tmp
sun.management.compiler=HotSpot 64-Bit Tiered Compilers
java.runtime.version=11.0.7+10-b765.65
apple.awt.fullscreencapturealldisplays=false
user.name=mac
javax.swing.rebaseCssSizeMap=true
idea.paths.selector=IntelliJIdea2020.1
sun.java2d.pmoffscreen=false
sun.awt.noerasebackground=true
file.encoding=UTF-8
jnidispatch.path=/Users/mac/Library/Caches/JetBrains/IntelliJIdea2020.1/tmp/jna9364687959430014718.tmp
idea.popup.weight=heavy
java.vendor.version=JBR-11.0.7.10-765.65-jfx
jna.loaded=true
java.io.tmpdir=/var/folders/8r/42_nykb97xjdkh9c1p4d5c7w0000gn/T/
java.version=11.0.7
idea.xdebug.key=-Xdebug
java.vm.specification.name=Java Virtual Machine Specification
idea.jre.check=true
java.awt.printerjob=sun.lwawt.macosx.CPrinterJob
sun.os.patch.level=unknown
java.library.path=/Users/mac/Library/Java/Extensions\:/Library/Java/Extensions\:/Network/Library/Java/Extensions\:/System/Library/Java/Extensions\:/usr/lib/java\:.
java.vendor=JetBrains s.r.o.
io.netty.processId=52995
sun.io.unicode.encoding=UnicodeBig
java.rmi.server.disableHttp=true
io.netty.machineId=28\:f0\:76\:ff\:fe\:16\:65\:0e
idea.executable=idea
gopherProxySet=false
CVS_PASSFILE=~/.cvspass
idea.smooth.progress=false
java.class.path=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/bootstrap.jar\:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/extensions.jar\:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/util.jar\:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/jdom.jar\:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/log4j.jar\:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/trove4j.jar\:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/jna.jar
sun.awt.enableExtraMouseButtons=true
java.vm.vendor=JetBrains s.r.o.
idea.vendor.name=JetBrains
user.timezone=Asia/Shanghai
jb.vmOptionsFile=/Users/mac/Library/Application Support/JetBrains/IntelliJIdea2020.1/idea.vmoptions
idea.no.launcher=false
swing.bufferPerWindow=true
os.name=Mac OS X
java.vm.specification.version=11
apple.laf.useScreenMenuBar=true
user.country=CN
sun.cpu.endian=little
user.home=/Users/mac
jdk.http.auth.tunneling.disabledSchemes=""
user.language=en
idea.cycle.buffer.size=1024
io.netty.allocator.numHeapArenas=1
log4j.defaultInitOverride=true
java.awt.graphicsenv=sun.awt.CGraphicsEnvironment
apple.awt.graphics.UseQuartz=true
io.netty.allocator.numDirectArenas=1
idea.max.intellisense.filesize=2500
sun.java2d.d3d=false
java.net.preferIPv4Stack=true
io.netty.allocator.useCacheForAllThreads=false
path.separator=\:
com.jetbrains.suppressWindowRaise=true
os.version=10.14.6
jna.nosys=true
java.endorsed.dirs=
java.runtime.name=OpenJDK Runtime Environment
io.netty.allocator.cacheTrimIntervalMillis=600000
sun.nio.ch.bugLevel=
java.vm.name=OpenJDK 64-Bit Server VM
jna.platform.library.path=/usr/lib\:/usr/lib
java.vendor.url.bug=https\://youtrack.jetbrains.com
java.util.concurrent.ForkJoinPool.common.threadFactory=com.intellij.concurrency.IdeaForkJoinWorkerThreadFactory
user.dir=/
os.arch=x86_64
io.netty.serviceThreadPrefix=Netty
idea.dynamic.classpath=false
java.vm.info=mixed mode
java.vm.version=11.0.7+10-b765.65
java.rmi.server.hostname=127.0.0.1
idea.max.content.load.filesize=20000
apple.awt.UIElement=true
java.class.version=55.0
```
