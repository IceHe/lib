# jps

> JVM Process Status Tool : list the instrumented JVMs on the target system

References

- `man jps`
- Understand the JVM - 2nd Edition - ZH Ver. - P141

## Quickstart

```bash
# Show arguments pased to JVM
jps -v
# Show arguments passed to main method
jps -m
# Show full package names or full path names
jps -l
```

## Description

- The jps tool lists the instrumented HotSpot Java Virtual Machines (JVMs) on the target system.
- If jps is run without specifying a hostid, it will look for instrumented JVMs on the local host.
    - A jstatd process is assumed to be running on the target host.
- …

## Options

- `-q` _只输出 LVMID, 省略主类的名称._
    - _Suppress the output of the class name, JAR file name, and arguments passed to the main method, producing only a list of local VM identifiers._
    - LVMID - Local Virtual Machine Identifier
- `-m` Output the arguments passed to the main method.
    - _The output may be null for embedded JVMs._
- `-l` Output the full package name for the application's main class or the full path name to the application's JAR file.
- `-v` Output the arguments passed to the JVM.
- `-V` _Output the arguments passed to the JVM through the flags file_
    - _(the .hotspotrc file or the file specified by the -XX:Flags=<filename> argument)._
- `-Joption` _Pass option to the java launcher called by javac._
    - _For example, -J-Xms48m sets the startup memory to 48 megabytes._
    - _It is a common convention for -J to pass options to the underlying VM executing_

## Usage

Default

```bash
$ jps
56822 Launcher
58326 Jps
37199
```

Shortest

```bash
$ jps -q
60373
56822
37199
```

Show full package names or full path names

```bash
$ jps -l
56822 org.jetbrains.jps.cmdline.Launcher
58346 sun.tools.jps.Jps
37199
```

Show arguments passed to main method

```bash
$ jps -m
56822 Launcher /Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/netty-resolver-4.1.47.Final.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/maven-resolver-provider-3.6.1.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/log4j.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/maven-model-3.6.1.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/idea_rt.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/jps-model.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/netty-buffer-4.1.47.Final.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/plugins/java/lib/aether-dependency-resolver.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/annotations.jar:/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/lib/oro-2.0.8.jar:/Users/mac/Applications/JetBrai
60472 Jps -m
37199
```

Show arguments pased to JVM

```bash
$ jps -v
56822 Launcher -Xmx700m -Djava.awt.headless=true -Djdt.compiler.useSingleThread=true -Dpreload.project.path=/Users/mac/Documents/java.buyermall -Dpreload.config.path=/Users/mac/Library/Application Support/JetBrains/IntelliJIdea2020.1/options -Dcompile.parallel=false -Drebuild.on.dependency.change=true -Djava.net.preferIPv4Stack=true -Dio.netty.initialSeedUniquifier=-7963982648567631968 -Dfile.encoding=UTF-8 -Duser.language=en -Duser.country=CN -Didea.paths.selector=IntelliJIdea2020.1 -Didea.home.path=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents -Didea.config.path=/Users/mac/Library/Application Support/JetBrains/IntelliJIdea2020.1 -Didea.plugins.path=/Users/mac/Library/Application Support/JetBrains/IntelliJIdea2020.1/plugins -Djps.log.dir=/Users/mac/Library/Logs/JetBrains/IntelliJIdea2020.1/build-log -Djps.fallback.jdk.home=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents/jbr/Contents/Home -Djps.fallback.jdk.version=11.0.6 -Dio.netty.noUnsafe=true -Djava.io.tmpdir=/Users/mac/Librar
60599 Jps -Dapplication.home=/Library/Java/JavaVirtualMachines/jdk1.8.0_221.jdk/Contents/Home -Xms8m
37199  -Xms128m -Xmx1024m -XX:ReservedCodeCacheSize=240m -XX:+UseCompressedOops -Dfile.encoding=UTF-8 -XX:+UseConcMarkSweepGC -XX:SoftRefLRUPolicyMSPerMB=50 -ea -XX:CICompilerCount=2 -Dsun.io.useCanonPrefixCache=false -Djava.net.preferIPv4Stack=true -Djdk.http.auth.tunneling.disabledSchemes="" -XX:+HeapDumpOnOutOfMemoryError -XX:-OmitStackTraceInFastThrow -Djdk.attach.allowAttachSelf -Dkotlinx.coroutines.debug=off -Xverify:none -XX:ErrorFile=/Users/mac/java_error_in_idea_%p.log -XX:HeapDumpPath=/Users/mac/java_error_in_idea.hprof -Djb.vmOptionsFile=/Users/mac/Library/Application Support/JetBrains/IntelliJIdea2020.1/idea.vmoptions -Didea.home.path=/Users/mac/Applications/JetBrains Toolbox/IntelliJ IDEA.app/Contents -Didea.executable=idea -Didea.paths.selector=IntelliJIdea2020.1 -Didea.vendor.name=JetBrains
```
