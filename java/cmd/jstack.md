# jstack

> stack trace : print Java stack traces of Java threads for a specified Java process

References

- `man jstack`
- Understand the JVM - 2nd Edition - ZH Ver. - P146
- https://docs.oracle.com/en/java/javase/14/docs/specs/man/jstack.html

## Quickstart

```bash
# Show stack trace
jstack 12345
```

## Synopsis

```bash
jstack [ option ] pid
jstack [ option ] executable core
jstack [ option ] [server-id@]remote-hostname-or-IP
```

## Options

- ~~`-m` prints mixed mode ( both Java and native C/C++ frames ) stack trace.~~
- `-l` The long listing option prints additional information about locks.

## Usage

```bash
# IntelliJ IDEA
$ jstack 581
2020-08-20 17:30:29
Full thread dump OpenJDK 64-Bit Server VM (11.0.7+10-b765.65 mixed mode):

Threads class SMR info:
_java_thread_list=0x0000600005112900, length=62, elements={
0x00007ff257815800, 0x00007ff259038000, 0x00007ff25881f000, 0x00007ff259032800,
0x00007ff25800a800, 0x00007ff25903f000, 0x00007ff257812000, 0x00007ff25803f000,
0x00007ff257827000, 0x00007ff258009800, 0x00007ff258007000, 0x00007ff258881800,
0x00007ff2579c7800, 0x00007ff258259000, 0x00007ff25912e000, 0x00007ff258b39000,
0x00007ff257a8a000, 0x00007ff259265800, 0x00007ff258276800, 0x00007ff25925c000,
0x00007ff25921a800, 0x00007ff257813000, 0x00007ff2592af000, 0x00007ff2582be000,
0x00007ff259626800, 0x00007ff259307000, 0x00007ff25916a000, 0x00007ff25928d000,
0x00007ff2596b8800, 0x00007ff258924800, 0x00007ff2583d8000, 0x00007ff257f10000,
0x00007ff257e92800, 0x00007ff25d0cb800, 0x00007ff2588b1800, 0x00007ff2584ed000,
0x00007ff257c85000, 0x00007ff258b72000, 0x00007ff25bf2e800, 0x00007ff25a863000,
0x00007ff258dc5800, 0x00007ff25e6a8000, 0x00007ff25e6a9000, 0x00007ff25be87000,
0x00007ff25f63e000, 0x00007ff25a932800, 0x00007ff26059a800, 0x00007ff26050b000,
0x00007ff2604d2800, 0x00007ff2583b5000, 0x00007ff258716000, 0x00007ff260989800,
0x00007ff25d429000, 0x00007ff25d28b000, 0x00007ff258fd5800, 0x00007ff260d92000,
0x00007ff25dbe0800, 0x00007ff25f5bc000, 0x00007ff25f5a5000, 0x00007ff25df45000,
0x00007ff258d17800, 0x00007ff25d35b800
}

"Reference Handler" #2 daemon prio=10 os_prio=31 cpu=319.14ms elapsed=102474.59s tid=0x00007ff257815800 nid=0x4703 waiting on condition  [0x00007000029f7000]
   java.lang.Thread.State: RUNNABLE
    at java.lang.ref.Reference.waitForReferencePendingList(java.base@11.0.7/Native Method)
    at java.lang.ref.Reference.processPendingReferences(java.base@11.0.7/Reference.java:241)
    at java.lang.ref.Reference$ReferenceHandler.run(java.base@11.0.7/Reference.java:213)

"Finalizer" #3 daemon prio=8 os_prio=31 cpu=189.10ms elapsed=102474.59s tid=0x00007ff259038000 nid=0x3e03 in Object.wait()  [0x0000700002afa000]
   java.lang.Thread.State: WAITING (on object monitor)
    at java.lang.Object.wait(java.base@11.0.7/Native Method)
    - waiting on <no object reference available>
    at java.lang.ref.ReferenceQueue.remove(java.base@11.0.7/ReferenceQueue.java:155)
    - waiting to re-lock in wait() <0x00000007d58e8c70> (a java.lang.ref.ReferenceQueue$Lock)
    at java.lang.ref.ReferenceQueue.remove(java.base@11.0.7/ReferenceQueue.java:176)
    at java.lang.ref.Finalizer$FinalizerThread.run(java.base@11.0.7/Finalizer.java:170)

"Signal Dispatcher" #4 daemon prio=9 os_prio=31 cpu=1.62ms elapsed=102474.21s tid=0x00007ff25881f000 nid=0x4003 runnable  [0x0000000000000000]
   java.lang.Thread.State: RUNNABLE

"C2 CompilerThread0" #5 daemon prio=9 os_prio=31 cpu=599724.34ms elapsed=102474.21s tid=0x00007ff259032800 nid=0x4303 waiting on condition  [0x0000000000000000]
   java.lang.Thread.State: RUNNABLE
   No compile task

"C1 CompilerThread0" #6 daemon prio=9 os_prio=31 cpu=74331.02ms elapsed=102474.19s tid=0x00007ff25800a800 nid=0x5603 waiting on condition  [0x0000000000000000]
   java.lang.Thread.State: RUNNABLE
   No compile task

"Sweeper thread" #7 daemon prio=9 os_prio=31 cpu=29118.77ms elapsed=102474.18s tid=0x00007ff25903f000 nid=0x5703 runnable  [0x0000000000000000]
   java.lang.Thread.State: RUNNABLE

"Service Thread" #8 daemon prio=9 os_prio=31 cpu=62.68ms elapsed=102473.79s tid=0x00007ff257812000 nid=0x5803 runnable  [0x0000000000000000]
   java.lang.Thread.State: RUNNABLE

"Common-Cleaner" #9 daemon prio=8 os_prio=31 cpu=191.39ms elapsed=102473.77s tid=0x00007ff25803f000 nid=0x5a03 in Object.wait()  [0x000070000320f000]
   java.lang.Thread.State: TIMED_WAITING (on object monitor)
    at java.lang.Object.wait(java.base@11.0.7/Native Method)
    - waiting on <no object reference available>
    at java.lang.ref.ReferenceQueue.remove(java.base@11.0.7/ReferenceQueue.java:155)
    - waiting to re-lock in wait() <0x00000007d58e8ca0> (a java.lang.ref.ReferenceQueue$Lock)
    at jdk.internal.ref.CleanerImpl.run(java.base@11.0.7/CleanerImpl.java:148)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)
    at jdk.internal.misc.InnocuousThread.run(java.base@11.0.7/InnocuousThread.java:134)

"DestroyJavaVM" #11 prio=5 os_prio=31 cpu=576.28ms elapsed=102471.32s tid=0x00007ff257827000 nid=0x1b03 waiting on condition  [0x0000000000000000]
   java.lang.Thread.State: RUNNABLE

"Periodic tasks thread" #12 daemon prio=5 os_prio=31 cpu=90856.38ms elapsed=102471.31s tid=0x00007ff258009800 nid=0x5e03 waiting on condition  [0x0000700003415000]
   java.lang.Thread.State: TIMED_WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d58e8cd0> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.parkNanos(java.base@11.0.7/LockSupport.java:234)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.awaitNanos(java.base@11.0.7/AbstractQueuedSynchronizer.java:2123)
    at java.util.concurrent.DelayQueue.take(java.base@11.0.7/DelayQueue.java:229)
    at com.intellij.util.concurrency.AppDelayQueue.lambda$new$0(AppDelayQueue.java:26)
    at com.intellij.util.concurrency.AppDelayQueue$$Lambda$26/0x000000080009b040.run(Unknown Source)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"AWT-AppKit" #16 daemon prio=5 os_prio=31 cpu=292359.74ms elapsed=102469.79s tid=0x00007ff258007000 nid=0x307 runnable  [0x0000000000000000]
   java.lang.Thread.State: RUNNABLE

"AWT-Shutdown" #17 prio=5 os_prio=31 cpu=7.17ms elapsed=102469.75s tid=0x00007ff258881800 nid=0xaa03 in Object.wait()  [0x0000700003c30000]
   java.lang.Thread.State: WAITING (on object monitor)
    at java.lang.Object.wait(java.base@11.0.7/Native Method)
    - waiting on <no object reference available>
    at java.lang.Object.wait(java.base@11.0.7/Object.java:328)
    at sun.awt.AWTAutoShutdown.run(java.desktop@11.0.7/AWTAutoShutdown.java:291)
    - waiting to re-lock in wait() <0x00000007d5724720> (a java.lang.Object)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"AWT-EventQueue-0" #18 prio=6 os_prio=31 cpu=694341.30ms elapsed=102469.68s tid=0x00007ff2579c7800 nid=0xca0b waiting on condition  [0x0000700003db6000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d5724738> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.awt.EventQueue.getNextEvent(java.desktop@11.0.7/EventQueue.java:572)
    at com.intellij.ide.IdeEventQueue.lambda$getNextEvent$16(IdeEventQueue.java:677)
    at com.intellij.ide.IdeEventQueue$$Lambda$681/0x0000000800736040.compute(Unknown Source)
    at com.intellij.openapi.application.impl.ApplicationImpl.runUnlockingIntendedWrite(ApplicationImpl.java:857)
    at com.intellij.ide.IdeEventQueue.getNextEvent(IdeEventQueue.java:677)
    at java.awt.EventDispatchThread.pumpOneEventForFilters(java.desktop@11.0.7/EventDispatchThread.java:190)
    at java.awt.EventDispatchThread.pumpEventsForFilter(java.desktop@11.0.7/EventDispatchThread.java:124)
    at java.awt.EventDispatchThread.pumpEventsForHierarchy(java.desktop@11.0.7/EventDispatchThread.java:113)
    at java.awt.EventDispatchThread.pumpEvents(java.desktop@11.0.7/EventDispatchThread.java:109)
    at java.awt.EventDispatchThread.pumpEvents(java.desktop@11.0.7/EventDispatchThread.java:101)
    at java.awt.EventDispatchThread.run(java.desktop@11.0.7/EventDispatchThread.java:90)

"Timer-0" #26 daemon prio=5 os_prio=31 cpu=2.10ms elapsed=102468.92s tid=0x00007ff258259000 nid=0x10c07 in Object.wait()  [0x00007000045fe000]
   java.lang.Thread.State: WAITING (on object monitor)
    at java.lang.Object.wait(java.base@11.0.7/Native Method)
    - waiting on <no object reference available>
    at java.lang.Object.wait(java.base@11.0.7/Object.java:328)
    at java.util.TimerThread.mainLoop(java.base@11.0.7/Timer.java:527)
    - waiting to re-lock in wait() <0x00000007d4e89730> (a java.util.TaskQueue)
    at java.util.TimerThread.run(java.base@11.0.7/Timer.java:506)

"Java2D Queue Flusher" #28 daemon prio=10 os_prio=31 cpu=257470.30ms elapsed=102468.85s tid=0x00007ff25912e000 nid=0xf203 in Object.wait()  [0x0000700004701000]
   java.lang.Thread.State: TIMED_WAITING (on object monitor)
    at java.lang.Object.wait(java.base@11.0.7/Native Method)
    - waiting on <no object reference available>
    at sun.java2d.opengl.OGLRenderQueue$QueueFlusher.run(java.desktop@11.0.7/OGLRenderQueue.java:228)
    - waiting to re-lock in wait() <0x00000007d54f9da8> (a sun.java2d.opengl.OGLRenderQueue$QueueFlusher)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"Java2D Disposer" #29 daemon prio=10 os_prio=31 cpu=265.94ms elapsed=102468.74s tid=0x00007ff258b39000 nid=0xfb03 in Object.wait()  [0x0000700004804000]
   java.lang.Thread.State: WAITING (on object monitor)
    at java.lang.Object.wait(java.base@11.0.7/Native Method)
    - waiting on <no object reference available>
    at java.lang.ref.ReferenceQueue.remove(java.base@11.0.7/ReferenceQueue.java:155)
    - waiting to re-lock in wait() <0x00000007d554bec0> (a java.lang.ref.ReferenceQueue$Lock)
    at java.lang.ref.ReferenceQueue.remove(java.base@11.0.7/ReferenceQueue.java:176)
    at sun.java2d.Disposer.run(java.desktop@11.0.7/Disposer.java:144)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"Netty Builtin Server 1" #31 prio=4 os_prio=31 cpu=268.27ms elapsed=102468.62s tid=0x00007ff257a8a000 nid=0x10103 runnable  [0x0000700004a0a000]
   java.lang.Thread.State: RUNNABLE
    at sun.nio.ch.KQueue.poll(java.base@11.0.7/Native Method)
    at sun.nio.ch.KQueueSelectorImpl.doSelect(java.base@11.0.7/KQueueSelectorImpl.java:122)
    at sun.nio.ch.SelectorImpl.lockAndDoSelect(java.base@11.0.7/SelectorImpl.java:124)
    - locked <0x00000007d6107fb0> (a io.netty.channel.nio.SelectedSelectionKeySet)
    - locked <0x00000007d5fd5328> (a sun.nio.ch.KQueueSelectorImpl)
    at sun.nio.ch.SelectorImpl.select(java.base@11.0.7/SelectorImpl.java:136)
    at io.netty.channel.nio.SelectedSelectionKeySetSelector.select(SelectedSelectionKeySetSelector.java:62)
    at io.netty.channel.nio.NioEventLoop.select(NioEventLoop.java:807)
    at io.netty.channel.nio.NioEventLoop.run(NioEventLoop.java:457)
    at io.netty.util.concurrent.SingleThreadEventExecutor$4.run(SingleThreadEventExecutor.java:989)
    at io.netty.util.internal.ThreadExecutorMap$2.run(ThreadExecutorMap.java:74)
    at io.netty.util.concurrent.FastThreadLocalRunnable.run(FastThreadLocalRunnable.java:30)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"process reaper" #33 daemon prio=10 os_prio=31 cpu=7.22ms elapsed=102465.23s tid=0x00007ff259265800 nid=0x15b1f runnable  [0x0000700004b34000]
   java.lang.Thread.State: RUNNABLE
    at java.lang.ProcessHandleImpl.waitForProcessExit0(java.base@11.0.7/Native Method)
    at java.lang.ProcessHandleImpl$1.run(java.base@11.0.7/ProcessHandleImpl.java:138)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1128)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"fsnotifier" #34 prio=4 os_prio=31 cpu=1.30ms elapsed=102465.23s tid=0x00007ff258276800 nid=0x1fb27 in Object.wait()  [0x0000700004c37000]
   java.lang.Thread.State: WAITING (on object monitor)
    at java.lang.Object.wait(java.base@11.0.7/Native Method)
    - waiting on <0x00000007d4ceb148> (a java.lang.ProcessImpl)
    at java.lang.Object.wait(java.base@11.0.7/Object.java:328)
    at java.lang.ProcessImpl.waitFor(java.base@11.0.7/ProcessImpl.java:495)
    - waiting to re-lock in wait() <0x00000007d4ceb148> (a java.lang.ProcessImpl)
    at com.intellij.execution.process.ProcessWaitFor.lambda$null$0(ProcessWaitFor.java:38)
    at com.intellij.execution.process.ProcessWaitFor$$Lambda$351/0x00000008003e5c40.run(Unknown Source)
    at com.intellij.util.ConcurrencyUtil.runUnderThreadName(ConcurrencyUtil.java:210)
    at com.intellij.execution.process.ProcessWaitFor.lambda$new$1(ProcessWaitFor.java:33)
    at com.intellij.execution.process.ProcessWaitFor$$Lambda$350/0x00000008003e5840.run(Unknown Source)
    at java.util.concurrent.Executors$RunnableAdapter.call(java.base@11.0.7/Executors.java:515)
    at java.util.concurrent.FutureTask.run(java.base@11.0.7/FutureTask.java:264)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1128)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"BaseDataReader: error stream of fsnotifier" #35 prio=4 os_prio=31 cpu=0.34ms elapsed=102465.21s tid=0x00007ff25925c000 nid=0x1f903 runnable  [0x0000700004d39000]
   java.lang.Thread.State: RUNNABLE
    at java.io.FileInputStream.readBytes(java.base@11.0.7/Native Method)
    at java.io.FileInputStream.read(java.base@11.0.7/FileInputStream.java:279)
    at java.io.BufferedInputStream.read1(java.base@11.0.7/BufferedInputStream.java:290)
    at java.io.BufferedInputStream.read(java.base@11.0.7/BufferedInputStream.java:351)
    - locked <0x00000007d7368cb0> (a java.lang.ProcessImpl$ProcessPipeInputStream)
    at sun.nio.cs.StreamDecoder.readBytes(java.base@11.0.7/StreamDecoder.java:284)
    at sun.nio.cs.StreamDecoder.implRead(java.base@11.0.7/StreamDecoder.java:326)
    at sun.nio.cs.StreamDecoder.read(java.base@11.0.7/StreamDecoder.java:178)
    - locked <0x00000007d958c8b0> (a com.intellij.util.io.BaseInputStreamReader)
    at java.io.InputStreamReader.read(java.base@11.0.7/InputStreamReader.java:185)
    at java.io.Reader.read(java.base@11.0.7/Reader.java:229)
    at com.intellij.util.io.BaseOutputReader.readAvailableBlocking(BaseOutputReader.java:134)
    at com.intellij.util.io.BaseDataReader.readAvailable(BaseDataReader.java:67)
    at com.intellij.util.io.BaseDataReader.doRun(BaseDataReader.java:160)
    at com.intellij.util.io.BaseDataReader$$Lambda$205/0x00000008001cf440.run(Unknown Source)
    at com.intellij.util.ConcurrencyUtil.runUnderThreadName(ConcurrencyUtil.java:210)
    at com.intellij.util.io.BaseDataReader.lambda$start$0(BaseDataReader.java:50)
    at com.intellij.util.io.BaseDataReader$$Lambda$204/0x00000008001cfc40.run(Unknown Source)
    at java.util.concurrent.Executors$RunnableAdapter.call(java.base@11.0.7/Executors.java:515)
    at java.util.concurrent.FutureTask.run(java.base@11.0.7/FutureTask.java:264)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1128)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"BaseDataReader: output stream of fsnotifier" #36 prio=4 os_prio=31 cpu=6445.14ms elapsed=102465.21s tid=0x00007ff25921a800 nid=0x1f703 runnable  [0x0000700004e3d000]
   java.lang.Thread.State: RUNNABLE
    at java.io.FileInputStream.readBytes(java.base@11.0.7/Native Method)
    at java.io.FileInputStream.read(java.base@11.0.7/FileInputStream.java:279)
    at java.io.BufferedInputStream.read1(java.base@11.0.7/BufferedInputStream.java:290)
    at java.io.BufferedInputStream.read(java.base@11.0.7/BufferedInputStream.java:351)
    - locked <0x00000007d7321d98> (a java.lang.ProcessImpl$ProcessPipeInputStream)
    at sun.nio.cs.StreamDecoder.readBytes(java.base@11.0.7/StreamDecoder.java:284)
    at sun.nio.cs.StreamDecoder.implRead(java.base@11.0.7/StreamDecoder.java:326)
    at sun.nio.cs.StreamDecoder.read(java.base@11.0.7/StreamDecoder.java:178)
    - locked <0x00000007d894d388> (a com.intellij.util.io.BaseInputStreamReader)
    at java.io.InputStreamReader.read(java.base@11.0.7/InputStreamReader.java:185)
    at java.io.Reader.read(java.base@11.0.7/Reader.java:229)
    at com.intellij.util.io.BaseOutputReader.readAvailableBlocking(BaseOutputReader.java:134)
    at com.intellij.util.io.BaseDataReader.readAvailable(BaseDataReader.java:67)
    at com.intellij.util.io.BaseDataReader.doRun(BaseDataReader.java:160)
    at com.intellij.util.io.BaseDataReader$$Lambda$205/0x00000008001cf440.run(Unknown Source)
    at com.intellij.util.ConcurrencyUtil.runUnderThreadName(ConcurrencyUtil.java:210)
    at com.intellij.util.io.BaseDataReader.lambda$start$0(BaseDataReader.java:50)
    at com.intellij.util.io.BaseDataReader$$Lambda$204/0x00000008001cfc40.run(Unknown Source)
    at java.util.concurrent.Executors$RunnableAdapter.call(java.base@11.0.7/Executors.java:515)
    at java.util.concurrent.FutureTask.run(java.base@11.0.7/FutureTask.java:264)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1128)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"ApplicationImpl pooled thread 9" #38 prio=4 os_prio=31 cpu=1196.58ms elapsed=102464.92s tid=0x00007ff257813000 nid=0xa007 runnable  [0x0000700003312000]
   java.lang.Thread.State: RUNNABLE
    at java.net.PlainDatagramSocketImpl.receive0(java.base@11.0.7/Native Method)
    - locked <0x00000007d60c1240> (a java.net.PlainDatagramSocketImpl)
    at java.net.AbstractPlainDatagramSocketImpl.receive(java.base@11.0.7/AbstractPlainDatagramSocketImpl.java:181)
    - locked <0x00000007d60c1240> (a java.net.PlainDatagramSocketImpl)
    at java.net.DatagramSocket.receive(java.base@11.0.7/DatagramSocket.java:814)
    - locked <0x00000007cedcfa90> (a java.net.DatagramPacket)
    - locked <0x00000007d60c1270> (a java.net.DatagramSocket)
    at com.intellij.a.g.a.a.b(a.java:54)
    at com.intellij.a.g.a.d.run(d.java:21)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1128)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"ApplicationImpl pooled thread 10" #39 prio=4 os_prio=31 cpu=1189.27ms elapsed=102464.92s tid=0x00007ff2592af000 nid=0x16303 runnable  [0x0000700005043000]
   java.lang.Thread.State: RUNNABLE
    at java.net.PlainDatagramSocketImpl.receive0(java.base@11.0.7/Native Method)
    - locked <0x00000007d60c12d0> (a java.net.PlainDatagramSocketImpl)
    at java.net.AbstractPlainDatagramSocketImpl.receive(java.base@11.0.7/AbstractPlainDatagramSocketImpl.java:181)
    - locked <0x00000007d60c12d0> (a java.net.PlainDatagramSocketImpl)
    at java.net.DatagramSocket.receive(java.base@11.0.7/DatagramSocket.java:814)
    - locked <0x00000007cedd7728> (a java.net.DatagramPacket)
    - locked <0x00000007d529f0b8> (a java.net.MulticastSocket)
    at com.intellij.a.g.a.a.b(a.java:54)
    at com.intellij.a.g.a.d.run(d.java:21)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1128)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"Netty Builtin Server 2" #41 prio=4 os_prio=31 cpu=171.50ms elapsed=102464.04s tid=0x00007ff2582be000 nid=0x7b23 runnable  [0x0000700003b2a000]
   java.lang.Thread.State: RUNNABLE
    at sun.nio.ch.KQueue.poll(java.base@11.0.7/Native Method)
    at sun.nio.ch.KQueueSelectorImpl.doSelect(java.base@11.0.7/KQueueSelectorImpl.java:122)
    at sun.nio.ch.SelectorImpl.lockAndDoSelect(java.base@11.0.7/SelectorImpl.java:124)
    - locked <0x00000007d6108310> (a io.netty.channel.nio.SelectedSelectionKeySet)
    - locked <0x00000007d5fd5388> (a sun.nio.ch.KQueueSelectorImpl)
    at sun.nio.ch.SelectorImpl.select(java.base@11.0.7/SelectorImpl.java:136)
    at io.netty.channel.nio.SelectedSelectionKeySetSelector.select(SelectedSelectionKeySetSelector.java:62)
    at io.netty.channel.nio.NioEventLoop.select(NioEventLoop.java:807)
    at io.netty.channel.nio.NioEventLoop.run(NioEventLoop.java:457)
    at io.netty.util.concurrent.SingleThreadEventExecutor$4.run(SingleThreadEventExecutor.java:989)
    at io.netty.util.internal.ThreadExecutorMap$2.run(ThreadExecutorMap.java:74)
    at io.netty.util.concurrent.FastThreadLocalRunnable.run(FastThreadLocalRunnable.java:30)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"sentry-pool-1-thread-1" #45 daemon prio=1 os_prio=31 cpu=1.97ms elapsed=102459.68s tid=0x00007ff259626800 nid=0x13f0b waiting on condition  [0x0000700004b0d000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d52ca110> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingDeque.takeFirst(java.base@11.0.7/LinkedBlockingDeque.java:483)
    at java.util.concurrent.LinkedBlockingDeque.take(java.base@11.0.7/LinkedBlockingDeque.java:671)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"pool-2-thread-1" #46 prio=5 os_prio=31 cpu=295.37ms elapsed=102459.68s tid=0x00007ff259307000 nid=0xad07 waiting on condition  [0x0000700005249000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d52f25f8> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.ScheduledThreadPoolExecutor$DelayedWorkQueue.take(java.base@11.0.7/ScheduledThreadPoolExecutor.java:1177)
    at java.util.concurrent.ScheduledThreadPoolExecutor$DelayedWorkQueue.take(java.base@11.0.7/ScheduledThreadPoolExecutor.java:899)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"TimerQueue" #47 daemon prio=5 os_prio=31 cpu=172704.22ms elapsed=102459.58s tid=0x00007ff25916a000 nid=0xb92b waiting on condition  [0x000070000534c000]
   java.lang.Thread.State: TIMED_WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d530bf50> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.parkNanos(java.base@11.0.7/LockSupport.java:234)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.awaitNanos(java.base@11.0.7/AbstractQueuedSynchronizer.java:2123)
    at java.util.concurrent.DelayQueue.take(java.base@11.0.7/DelayQueue.java:229)
    at javax.swing.TimerQueue.run(java.desktop@11.0.7/TimerQueue.java:171)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"RMI TCP Accept-0" #53 daemon prio=4 os_prio=31 cpu=541.57ms elapsed=102457.05s tid=0x00007ff25928d000 nid=0x17703 runnable  [0x000070000595e000]
   java.lang.Thread.State: RUNNABLE
    at java.net.PlainSocketImpl.socketAccept(java.base@11.0.7/Native Method)
    at java.net.AbstractPlainSocketImpl.accept(java.base@11.0.7/AbstractPlainSocketImpl.java:458)
    at java.net.ServerSocket.implAccept(java.base@11.0.7/ServerSocket.java:565)
    at java.net.ServerSocket.accept(java.base@11.0.7/ServerSocket.java:533)
    at sun.rmi.transport.tcp.TCPTransport$AcceptLoop.executeAcceptLoop(java.rmi@11.0.7/TCPTransport.java:394)
    at sun.rmi.transport.tcp.TCPTransport$AcceptLoop.run(java.rmi@11.0.7/TCPTransport.java:366)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"RMI Reaper" #54 prio=4 os_prio=31 cpu=0.10ms elapsed=102457.04s tid=0x00007ff2596b8800 nid=0x1e703 in Object.wait()  [0x0000700005a61000]
   java.lang.Thread.State: WAITING (on object monitor)
    at java.lang.Object.wait(java.base@11.0.7/Native Method)
    - waiting on <0x00000007d9721d70> (a java.lang.ref.ReferenceQueue$Lock)
    at java.lang.ref.ReferenceQueue.remove(java.base@11.0.7/ReferenceQueue.java:155)
    - waiting to re-lock in wait() <0x00000007d9721d70> (a java.lang.ref.ReferenceQueue$Lock)
    at java.lang.ref.ReferenceQueue.remove(java.base@11.0.7/ReferenceQueue.java:176)
    at sun.rmi.transport.ObjectTable$Reaper.run(java.rmi@11.0.7/ObjectTable.java:349)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"RMI GC Daemon" #55 daemon prio=2 os_prio=31 cpu=22.70ms elapsed=102457.02s tid=0x00007ff258924800 nid=0x1e503 in Object.wait()  [0x0000700005b64000]
   java.lang.Thread.State: TIMED_WAITING (on object monitor)
    at java.lang.Object.wait(java.base@11.0.7/Native Method)
    - waiting on <no object reference available>
    at sun.rmi.transport.GC$Daemon.run(java.rmi@11.0.7/GC.java:126)
    - waiting to re-lock in wait() <0x00000007d8a08a80> (a sun.rmi.transport.GC$LatencyLock)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)
    at jdk.internal.misc.InnocuousThread.run(java.base@11.0.7/InnocuousThread.java:134)

"RMI Scheduler(0)" #56 daemon prio=4 os_prio=31 cpu=655.25ms elapsed=102457.01s tid=0x00007ff2583d8000 nid=0x17b03 waiting on condition  [0x0000700005c67000]
   java.lang.Thread.State: TIMED_WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d9721ba8> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.parkNanos(java.base@11.0.7/LockSupport.java:234)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.awaitNanos(java.base@11.0.7/AbstractQueuedSynchronizer.java:2123)
    at java.util.concurrent.ScheduledThreadPoolExecutor$DelayedWorkQueue.take(java.base@11.0.7/ScheduledThreadPoolExecutor.java:1182)
    at java.util.concurrent.ScheduledThreadPoolExecutor$DelayedWorkQueue.take(java.base@11.0.7/ScheduledThreadPoolExecutor.java:899)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"pool-2-thread-2" #59 prio=5 os_prio=31 cpu=129.73ms elapsed=102453.18s tid=0x00007ff257f10000 nid=0x1dc1b waiting on condition  [0x0000700003eb9000]
   java.lang.Thread.State: TIMED_WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d52f25f8> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.parkNanos(java.base@11.0.7/LockSupport.java:234)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.awaitNanos(java.base@11.0.7/AbstractQueuedSynchronizer.java:2123)
    at java.util.concurrent.ScheduledThreadPoolExecutor$DelayedWorkQueue.take(java.base@11.0.7/ScheduledThreadPoolExecutor.java:1182)
    at java.util.concurrent.ScheduledThreadPoolExecutor$DelayedWorkQueue.take(java.base@11.0.7/ScheduledThreadPoolExecutor.java:899)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"Netty Builtin Server 3" #61 prio=4 os_prio=31 cpu=836.70ms elapsed=102452.87s tid=0x00007ff257e92800 nid=0x1da03 runnable  [0x0000700005f70000]
   java.lang.Thread.State: RUNNABLE
    at sun.nio.ch.KQueue.poll(java.base@11.0.7/Native Method)
    at sun.nio.ch.KQueueSelectorImpl.doSelect(java.base@11.0.7/KQueueSelectorImpl.java:122)
    at sun.nio.ch.SelectorImpl.lockAndDoSelect(java.base@11.0.7/SelectorImpl.java:124)
    - locked <0x00000007d6108148> (a io.netty.channel.nio.SelectedSelectionKeySet)
    - locked <0x00000007d5fd53e8> (a sun.nio.ch.KQueueSelectorImpl)
    at sun.nio.ch.SelectorImpl.select(java.base@11.0.7/SelectorImpl.java:136)
    at io.netty.channel.nio.SelectedSelectionKeySetSelector.select(SelectedSelectionKeySetSelector.java:62)
    at io.netty.channel.nio.NioEventLoop.select(NioEventLoop.java:807)
    at io.netty.channel.nio.NioEventLoop.run(NioEventLoop.java:457)
    at io.netty.util.concurrent.SingleThreadEventExecutor$4.run(SingleThreadEventExecutor.java:989)
    at io.netty.util.internal.ThreadExecutorMap$2.run(ThreadExecutorMap.java:74)
    at io.netty.util.concurrent.FastThreadLocalRunnable.run(FastThreadLocalRunnable.java:30)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"sentry-pool-1-thread-2" #93 daemon prio=1 os_prio=31 cpu=1.33ms elapsed=102429.14s tid=0x00007ff25d0cb800 nid=0x29f03 waiting on condition  [0x0000700007865000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d52ca110> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingDeque.takeFirst(java.base@11.0.7/LinkedBlockingDeque.java:483)
    at java.util.concurrent.LinkedBlockingDeque.take(java.base@11.0.7/LinkedBlockingDeque.java:671)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"sentry-pool-1-thread-3" #95 daemon prio=1 os_prio=31 cpu=0.92ms elapsed=102420.73s tid=0x00007ff2588b1800 nid=0x1b60b waiting on condition  [0x0000700007968000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d52ca110> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingDeque.takeFirst(java.base@11.0.7/LinkedBlockingDeque.java:483)
    at java.util.concurrent.LinkedBlockingDeque.take(java.base@11.0.7/LinkedBlockingDeque.java:671)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"pool-4-thread-1" #514 prio=5 os_prio=31 cpu=568.51ms elapsed=99073.88s tid=0x00007ff2584ed000 nid=0x1c56b waiting on condition  [0x00007000070a3000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007dc8f0588> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingQueue.take(java.base@11.0.7/LinkedBlockingQueue.java:433)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"pool-4-thread-2" #519 prio=5 os_prio=31 cpu=463.34ms elapsed=99041.88s tid=0x00007ff257c85000 nid=0x1a353 waiting on condition  [0x0000700005d6a000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007dc8f0588> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingQueue.take(java.base@11.0.7/LinkedBlockingQueue.java:433)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"pool-4-thread-3" #540 prio=5 os_prio=31 cpu=413.42ms elapsed=98871.35s tid=0x00007ff258b72000 nid=0x1975b waiting on condition  [0x0000700006788000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007dc8f0588> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingQueue.take(java.base@11.0.7/LinkedBlockingQueue.java:433)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"pool-4-thread-4" #584 prio=5 os_prio=31 cpu=515.87ms elapsed=95915.01s tid=0x00007ff25bf2e800 nid=0x16cd3 waiting on condition  [0x0000700005552000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007dc8f0588> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingQueue.take(java.base@11.0.7/LinkedBlockingQueue.java:433)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"pool-4-thread-5" #586 prio=5 os_prio=31 cpu=553.30ms elapsed=95914.87s tid=0x00007ff25a863000 nid=0xef53 waiting on condition  [0x000070000647f000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007dc8f0588> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingQueue.take(java.base@11.0.7/LinkedBlockingQueue.java:433)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"pool-4-thread-6" #590 prio=5 os_prio=31 cpu=535.36ms elapsed=95914.73s tid=0x00007ff258dc5800 nid=0x12df7 waiting on condition  [0x000070000698e000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007dc8f0588> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingQueue.take(java.base@11.0.7/LinkedBlockingQueue.java:433)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"pool-5-thread-1" #836 prio=5 os_prio=31 cpu=0.55ms elapsed=91829.95s tid=0x00007ff25e6a8000 nid=0x162b3 waiting on condition  [0x0000700008180000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007ddbbaab8> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingQueue.take(java.base@11.0.7/LinkedBlockingQueue.java:433)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"pool-5-thread-2" #839 prio=5 os_prio=31 cpu=0.34ms elapsed=91829.39s tid=0x00007ff25e6a9000 nid=0xe227 waiting on condition  [0x0000700008283000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007ddbbaab8> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingQueue.take(java.base@11.0.7/LinkedBlockingQueue.java:433)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"pool-5-thread-3" #840 prio=5 os_prio=31 cpu=0.33ms elapsed=91829.33s tid=0x00007ff25be87000 nid=0x9d5b waiting on condition  [0x0000700008489000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007ddbbaab8> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingQueue.take(java.base@11.0.7/LinkedBlockingQueue.java:433)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"pool-5-thread-4" #842 prio=5 os_prio=31 cpu=0.24ms elapsed=91827.06s tid=0x00007ff25f63e000 nid=0x16f4b waiting on condition  [0x000070000868f000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007ddbbaab8> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingQueue.take(java.base@11.0.7/LinkedBlockingQueue.java:433)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"PtyProcess Reaper for [/bin/zsh, --login, -i]" #996 daemon prio=4 os_prio=31 cpu=44.66ms elapsed=89712.99s tid=0x00007ff25a932800 nid=0x2a757 runnable  [0x00007000040bf000]
   java.lang.Thread.State: RUNNABLE
    at com.sun.jna.Native.invokeInt(Native Method)
    at com.sun.jna.Function.invoke(Function.java:426)
    at com.sun.jna.Function.invoke(Function.java:361)
    at com.sun.jna.Library$Handler.invoke(Library.java:265)
    at com.sun.proxy.$Proxy141.waitpid(Unknown Source)
    at com.pty4j.unix.macosx.OSFacadeImpl.waitpid(OSFacadeImpl.java:148)
    at com.pty4j.unix.Pty.wait0(Pty.java:256)
    at com.pty4j.unix.UnixPtyProcess.waitFor(UnixPtyProcess.java:337)
    at com.pty4j.unix.UnixPtyProcess$Reaper.run(UnixPtyProcess.java:407)

"pool-8-thread-1" #997 prio=5 os_prio=31 cpu=101.49ms elapsed=89712.89s tid=0x00007ff26059a800 nid=0x1ad7b waiting on condition  [0x000070000688b000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007deb0cb48> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingQueue.take(java.base@11.0.7/LinkedBlockingQueue.java:433)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"Connector-Local" #998 prio=6 os_prio=31 cpu=597.70ms elapsed=89712.89s tid=0x00007ff26050b000 nid=0x26e47 runnable  [0x0000700006a91000]
   java.lang.Thread.State: RUNNABLE
    at com.sun.jna.Native.invokeInt(Native Method)
    at com.sun.jna.Function.invoke(Function.java:426)
    at com.sun.jna.Function.invoke(Function.java:361)
    at com.sun.jna.Library$Handler.invoke(Library.java:265)
    at com.sun.proxy.$Proxy143.poll(Unknown Source)
    at jtermios.macosx.JTermiosImpl.poll(JTermiosImpl.java:340)
    at jtermios.JTermios.poll(JTermios.java:452)
    at com.pty4j.unix.Pty.poll(Pty.java:301)
    at com.pty4j.unix.Pty.read(Pty.java:291)
    - locked <0x00000007deae33f0> (a java.lang.Object)
    at com.pty4j.unix.PTYInputStream.read(PTYInputStream.java:47)
    at sun.nio.cs.StreamDecoder.readBytes(java.base@11.0.7/StreamDecoder.java:284)
    at sun.nio.cs.StreamDecoder.implRead(java.base@11.0.7/StreamDecoder.java:326)
    at sun.nio.cs.StreamDecoder.read(java.base@11.0.7/StreamDecoder.java:178)
    - locked <0x00000007deb0cb90> (a java.io.InputStreamReader)
    at java.io.InputStreamReader.read(java.base@11.0.7/InputStreamReader.java:185)
    at com.jediterm.terminal.ProcessTtyConnector.read(ProcessTtyConnector.java:54)
    at com.jediterm.terminal.TtyBasedArrayDataStream.fillBuf(TtyBasedArrayDataStream.java:21)
    at com.jediterm.terminal.TtyBasedArrayDataStream.getChar(TtyBasedArrayDataStream.java:31)
    at com.jediterm.terminal.DataStreamIteratingEmulator.next(DataStreamIteratingEmulator.java:34)
    at com.jediterm.terminal.TerminalStarter.start(TerminalStarter.java:54)
    at com.jediterm.terminal.ui.JediTermWidget$EmulatorTask.run(JediTermWidget.java:361)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"AWT-AWTThreading pool-1-thread-6" #1149 daemon prio=5 os_prio=31 cpu=142.16ms elapsed=87073.41s tid=0x00007ff2604d2800 nid=0x2640f waiting on condition  [0x00007000042c4000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d554bef0> (a java.util.concurrent.SynchronousQueue$TransferStack)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.SynchronousQueue$TransferStack.awaitFulfill(java.base@11.0.7/SynchronousQueue.java:460)
    at java.util.concurrent.SynchronousQueue$TransferStack.transfer(java.base@11.0.7/SynchronousQueue.java:361)
    at java.util.concurrent.SynchronousQueue.take(java.base@11.0.7/SynchronousQueue.java:920)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.util.concurrent.Executors$PrivilegedThreadFactory$1$1.run(java.base@11.0.7/Executors.java:668)
    at java.util.concurrent.Executors$PrivilegedThreadFactory$1$1.run(java.base@11.0.7/Executors.java:665)
    at java.security.AccessController.doPrivileged(java.base@11.0.7/Native Method)
    at java.util.concurrent.Executors$PrivilegedThreadFactory$1.run(java.base@11.0.7/Executors.java:665)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"sentry-pool-1-thread-4" #1194 daemon prio=1 os_prio=31 cpu=66.13ms elapsed=86905.94s tid=0x00007ff2583b5000 nid=0x3401b waiting on condition  [0x000070000a263000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d52ca110> (a java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.locks.AbstractQueuedSynchronizer$ConditionObject.await(java.base@11.0.7/AbstractQueuedSynchronizer.java:2081)
    at java.util.concurrent.LinkedBlockingDeque.takeFirst(java.base@11.0.7/LinkedBlockingDeque.java:483)
    at java.util.concurrent.LinkedBlockingDeque.take(java.base@11.0.7/LinkedBlockingDeque.java:671)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1054)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"Batik CleanerThread" #1494 daemon prio=6 os_prio=31 cpu=0.26ms elapsed=23745.45s tid=0x00007ff258716000 nid=0x21643 in Object.wait()  [0x0000700006073000]
   java.lang.Thread.State: WAITING (on object monitor)
    at java.lang.Object.wait(java.base@11.0.7/Native Method)
    - waiting on <no object reference available>
    at java.lang.ref.ReferenceQueue.remove(java.base@11.0.7/ReferenceQueue.java:155)
    - waiting to re-lock in wait() <0x00000007e12657d0> (a java.lang.ref.ReferenceQueue$Lock)
    at java.lang.ref.ReferenceQueue.remove(java.base@11.0.7/ReferenceQueue.java:176)
    at org.apache.batik.util.CleanerThread.run(CleanerThread.java:106)

"process reaper" #1608 daemon prio=10 os_prio=31 cpu=2.64ms elapsed=20537.78s tid=0x00007ff260989800 nid=0x27717 runnable  [0x000070000343c000]
   java.lang.Thread.State: RUNNABLE
    at java.lang.ProcessHandleImpl.waitForProcessExit0(java.base@11.0.7/Native Method)
    at java.lang.ProcessHandleImpl$1.run(java.base@11.0.7/ProcessHandleImpl.java:138)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1128)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"java" #1613 prio=4 os_prio=31 cpu=3.40ms elapsed=20537.35s tid=0x00007ff25d429000 nid=0x1e1af in Object.wait()  [0x00007000041c2000]
   java.lang.Thread.State: WAITING (on object monitor)
    at java.lang.Object.wait(java.base@11.0.7/Native Method)
    - waiting on <no object reference available>
    at java.lang.Object.wait(java.base@11.0.7/Object.java:328)
    at java.lang.ProcessImpl.waitFor(java.base@11.0.7/ProcessImpl.java:495)
    - waiting to re-lock in wait() <0x00000007e22b2fa0> (a java.lang.ProcessImpl)
    at com.intellij.execution.process.ProcessWaitFor.lambda$null$0(ProcessWaitFor.java:38)
    at com.intellij.execution.process.ProcessWaitFor$$Lambda$351/0x00000008003e5c40.run(Unknown Source)
    at com.intellij.util.ConcurrencyUtil.runUnderThreadName(ConcurrencyUtil.java:210)
    at com.intellij.execution.process.ProcessWaitFor.lambda$new$1(ProcessWaitFor.java:33)
    at com.intellij.execution.process.ProcessWaitFor$$Lambda$350/0x00000008003e5840.run(Unknown Source)
    at java.util.concurrent.Executors$RunnableAdapter.call(java.base@11.0.7/Executors.java:515)
    at java.util.concurrent.FutureTask.run(java.base@11.0.7/FutureTask.java:264)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1128)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"BaseDataReader: error stream of java" #1614 prio=4 os_prio=31 cpu=58.13ms elapsed=20537.35s tid=0x00007ff25d28b000 nid=0x33a47 runnable  [0x00007000043c8000]
   java.lang.Thread.State: RUNNABLE
    at java.io.FileInputStream.readBytes(java.base@11.0.7/Native Method)
    at java.io.FileInputStream.read(java.base@11.0.7/FileInputStream.java:279)
    at java.io.BufferedInputStream.read1(java.base@11.0.7/BufferedInputStream.java:290)
    at java.io.BufferedInputStream.read(java.base@11.0.7/BufferedInputStream.java:351)
    - locked <0x00000007e22b41c8> (a java.lang.ProcessImpl$ProcessPipeInputStream)
    at sun.nio.cs.StreamDecoder.readBytes(java.base@11.0.7/StreamDecoder.java:284)
    at sun.nio.cs.StreamDecoder.implRead(java.base@11.0.7/StreamDecoder.java:326)
    at sun.nio.cs.StreamDecoder.read(java.base@11.0.7/StreamDecoder.java:178)
    - locked <0x00000007e20bd030> (a com.intellij.util.io.BaseInputStreamReader)
    at java.io.InputStreamReader.read(java.base@11.0.7/InputStreamReader.java:185)
    at java.io.Reader.read(java.base@11.0.7/Reader.java:229)
    at com.intellij.util.io.BaseOutputReader.readAvailableBlocking(BaseOutputReader.java:134)
    at com.intellij.util.io.BaseDataReader.readAvailable(BaseDataReader.java:67)
    at com.intellij.util.io.BaseDataReader.doRun(BaseDataReader.java:160)
    at com.intellij.util.io.BaseDataReader$$Lambda$205/0x00000008001cf440.run(Unknown Source)
    at com.intellij.util.ConcurrencyUtil.runUnderThreadName(ConcurrencyUtil.java:210)
    at com.intellij.util.io.BaseDataReader.lambda$start$0(BaseDataReader.java:50)
    at com.intellij.util.io.BaseDataReader$$Lambda$204/0x00000008001cfc40.run(Unknown Source)
    at java.util.concurrent.Executors$RunnableAdapter.call(java.base@11.0.7/Executors.java:515)
    at java.util.concurrent.FutureTask.run(java.base@11.0.7/FutureTask.java:264)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1128)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"BaseDataReader: output stream of java" #1615 prio=4 os_prio=31 cpu=243.31ms elapsed=20537.35s tid=0x00007ff258fd5800 nid=0x24a57 runnable  [0x0000700004907000]
   java.lang.Thread.State: RUNNABLE
    at java.io.FileInputStream.readBytes(java.base@11.0.7/Native Method)
    at java.io.FileInputStream.read(java.base@11.0.7/FileInputStream.java:279)
    at java.io.BufferedInputStream.read1(java.base@11.0.7/BufferedInputStream.java:290)
    at java.io.BufferedInputStream.read(java.base@11.0.7/BufferedInputStream.java:351)
    - locked <0x00000007e22b41a0> (a java.lang.ProcessImpl$ProcessPipeInputStream)
    at sun.nio.cs.StreamDecoder.readBytes(java.base@11.0.7/StreamDecoder.java:284)
    at sun.nio.cs.StreamDecoder.implRead(java.base@11.0.7/StreamDecoder.java:326)
    at sun.nio.cs.StreamDecoder.read(java.base@11.0.7/StreamDecoder.java:178)
    - locked <0x00000007e21e0800> (a com.intellij.util.io.BaseInputStreamReader)
    at java.io.InputStreamReader.read(java.base@11.0.7/InputStreamReader.java:185)
    at java.io.Reader.read(java.base@11.0.7/Reader.java:229)
    at com.intellij.util.io.BaseOutputReader.readAvailableBlocking(BaseOutputReader.java:134)
    at com.intellij.util.io.BaseDataReader.readAvailable(BaseDataReader.java:67)
    at com.intellij.util.io.BaseDataReader.doRun(BaseDataReader.java:160)
    at com.intellij.util.io.BaseDataReader$$Lambda$205/0x00000008001cf440.run(Unknown Source)
    at com.intellij.util.ConcurrencyUtil.runUnderThreadName(ConcurrencyUtil.java:210)
    at com.intellij.util.io.BaseDataReader.lambda$start$0(BaseDataReader.java:50)
    at com.intellij.util.io.BaseDataReader$$Lambda$204/0x00000008001cfc40.run(Unknown Source)
    at java.util.concurrent.Executors$RunnableAdapter.call(java.base@11.0.7/Executors.java:515)
    at java.util.concurrent.FutureTask.run(java.base@11.0.7/FutureTask.java:264)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1128)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"RMI RenewClean-[127.0.0.1:58805]" #1644 daemon prio=4 os_prio=31 cpu=369.04ms elapsed=20526.69s tid=0x00007ff260d92000 nid=0x617b in Object.wait()  [0x0000700009acb000]
   java.lang.Thread.State: TIMED_WAITING (on object monitor)
    at java.lang.Object.wait(java.base@11.0.7/Native Method)
    - waiting on <no object reference available>
    at java.lang.ref.ReferenceQueue.remove(java.base@11.0.7/ReferenceQueue.java:155)
    - waiting to re-lock in wait() <0x00000007e23b2ad8> (a java.lang.ref.ReferenceQueue$Lock)
    at sun.rmi.transport.DGCClient$EndpointEntry$RenewCleanThread.run(java.rmi@11.0.7/DGCClient.java:558)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"Attach Listener" #1796 daemon prio=9 os_prio=31 cpu=613.42ms elapsed=8396.75s tid=0x00007ff25dbe0800 nid=0x27b0b waiting on condition  [0x0000000000000000]
   java.lang.Thread.State: RUNNABLE

"JobScheduler FJ pool 1/3" #1872 daemon prio=4 os_prio=31 cpu=22.59ms elapsed=3271.76s tid=0x00007ff25f5bc000 nid=0x28797 waiting on condition  [0x0000700006685000]
   java.lang.Thread.State: WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d4e1beb0> (a java.util.concurrent.ForkJoinPool)
    at java.util.concurrent.locks.LockSupport.park(java.base@11.0.7/LockSupport.java:194)
    at java.util.concurrent.ForkJoinPool.runWorker(java.base@11.0.7/ForkJoinPool.java:1628)
    at java.util.concurrent.ForkJoinWorkerThread.run(java.base@11.0.7/ForkJoinWorkerThread.java:177)

"RMI TCP Connection(3019)-127.0.0.1" #1880 daemon prio=4 os_prio=31 cpu=162.59ms elapsed=3064.02s tid=0x00007ff25f5a5000 nid=0x20bfb runnable  [0x000070000544d000]
   java.lang.Thread.State: RUNNABLE
    at java.net.SocketInputStream.socketRead0(java.base@11.0.7/Native Method)
    at java.net.SocketInputStream.socketRead(java.base@11.0.7/SocketInputStream.java:115)
    at java.net.SocketInputStream.read(java.base@11.0.7/SocketInputStream.java:168)
    at java.net.SocketInputStream.read(java.base@11.0.7/SocketInputStream.java:140)
    at java.io.BufferedInputStream.fill(java.base@11.0.7/BufferedInputStream.java:252)
    at java.io.BufferedInputStream.read(java.base@11.0.7/BufferedInputStream.java:271)
    - locked <0x00000007ced81240> (a java.io.BufferedInputStream)
    at java.io.FilterInputStream.read(java.base@11.0.7/FilterInputStream.java:83)
    at sun.rmi.transport.tcp.TCPTransport.handleMessages(java.rmi@11.0.7/TCPTransport.java:544)
    at sun.rmi.transport.tcp.TCPTransport$ConnectionHandler.run0(java.rmi@11.0.7/TCPTransport.java:796)
    at sun.rmi.transport.tcp.TCPTransport$ConnectionHandler.lambda$run$0(java.rmi@11.0.7/TCPTransport.java:677)
    at sun.rmi.transport.tcp.TCPTransport$ConnectionHandler$$Lambda$1241/0x0000000800bf3c40.run(java.rmi@11.0.7/Unknown Source)
    at java.security.AccessController.doPrivileged(java.base@11.0.7/Native Method)
    at sun.rmi.transport.tcp.TCPTransport$ConnectionHandler.run(java.rmi@11.0.7/TCPTransport.java:676)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1128)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"ApplicationImpl pooled thread 621" #1911 daemon prio=4 os_prio=31 cpu=421.43ms elapsed=1017.23s tid=0x00007ff25df45000 nid=0x2072f waiting on condition  [0x0000700001d62000]
   java.lang.Thread.State: TIMED_WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d58e8d18> (a java.util.concurrent.SynchronousQueue$TransferStack)
    at java.util.concurrent.locks.LockSupport.parkNanos(java.base@11.0.7/LockSupport.java:234)
    at java.util.concurrent.SynchronousQueue$TransferStack.awaitFulfill(java.base@11.0.7/SynchronousQueue.java:462)
    at java.util.concurrent.SynchronousQueue$TransferStack.transfer(java.base@11.0.7/SynchronousQueue.java:361)
    at java.util.concurrent.SynchronousQueue.poll(java.base@11.0.7/SynchronousQueue.java:937)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1053)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"ApplicationImpl pooled thread 622" #1916 daemon prio=4 os_prio=31 cpu=531.61ms elapsed=543.07s tid=0x00007ff258d17800 nid=0x18d9f waiting on condition  [0x00007000044cb000]
   java.lang.Thread.State: TIMED_WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d58e8d18> (a java.util.concurrent.SynchronousQueue$TransferStack)
    at java.util.concurrent.locks.LockSupport.parkNanos(java.base@11.0.7/LockSupport.java:234)
    at java.util.concurrent.SynchronousQueue$TransferStack.awaitFulfill(java.base@11.0.7/SynchronousQueue.java:462)
    at java.util.concurrent.SynchronousQueue$TransferStack.transfer(java.base@11.0.7/SynchronousQueue.java:361)
    at java.util.concurrent.SynchronousQueue.poll(java.base@11.0.7/SynchronousQueue.java:937)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1053)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"ApplicationImpl pooled thread 624" #1928 daemon prio=4 os_prio=31 cpu=223.58ms elapsed=542.03s tid=0x00007ff25d35b800 nid=0x2664b waiting on condition  [0x0000700006582000]
   java.lang.Thread.State: TIMED_WAITING (parking)
    at jdk.internal.misc.Unsafe.park(java.base@11.0.7/Native Method)
    - parking to wait for  <0x00000007d58e8d18> (a java.util.concurrent.SynchronousQueue$TransferStack)
    at java.util.concurrent.locks.LockSupport.parkNanos(java.base@11.0.7/LockSupport.java:234)
    at java.util.concurrent.SynchronousQueue$TransferStack.awaitFulfill(java.base@11.0.7/SynchronousQueue.java:462)
    at java.util.concurrent.SynchronousQueue$TransferStack.transfer(java.base@11.0.7/SynchronousQueue.java:361)
    at java.util.concurrent.SynchronousQueue.poll(java.base@11.0.7/SynchronousQueue.java:937)
    at java.util.concurrent.ThreadPoolExecutor.getTask(java.base@11.0.7/ThreadPoolExecutor.java:1053)
    at java.util.concurrent.ThreadPoolExecutor.runWorker(java.base@11.0.7/ThreadPoolExecutor.java:1114)
    at java.util.concurrent.ThreadPoolExecutor$Worker.run(java.base@11.0.7/ThreadPoolExecutor.java:628)
    at java.lang.Thread.run(java.base@11.0.7/Thread.java:834)

"VM Thread" os_prio=31 cpu=116541.48ms elapsed=102474.62s tid=0x00007ff25900b000 nid=0x4903 runnable

"GC Thread#0" os_prio=31 cpu=22641.85ms elapsed=102474.87s tid=0x00007ff25901d000 nid=0x3703 runnable

"GC Thread#1" os_prio=31 cpu=22238.69ms elapsed=102471.27s tid=0x00007ff257912800 nid=0x6203 runnable

"GC Thread#2" os_prio=31 cpu=20895.42ms elapsed=102471.27s tid=0x00007ff257852000 nid=0x9b03 runnable

"GC Thread#3" os_prio=31 cpu=22311.57ms elapsed=102471.27s tid=0x00007ff257867800 nid=0x6503 runnable

"CMS Main Thread" os_prio=31 cpu=143070.43ms elapsed=102474.87s tid=0x00007ff25901d800 nid=0x4c03 runnable

"VM Periodic Task Thread" os_prio=31 cpu=24877.07ms elapsed=102473.79s tid=0x00007ff259048000 nid=0xa303 waiting on condition

JNI global refs: 2495, weak refs: 2746

```
