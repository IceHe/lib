# Java Virtual Machine

References

- Book《深入理解 Java 虚拟机：JVM 高级特性与最佳实践》
    - 垃圾回收算法手册: 自动内存管理的艺术
    - Java 性能优化权威指南 / Effective Java

## Introduction

Keywords?

- 自动内存管理 : 永久代 / 元空间
- 垃圾回收算法和收集器 : ZGC / 低延迟全并发收集器
    - 跨代引用 : 记忆集 / 卡表 / 并发标记 / 原始快照算法
- 命令行和可视化工具 : JHSDB / JFR / JMC
- 执行子系统
- 类加载过程 : 加载 / 验证 / 准备 / 解析 / 初始化
    - 找到正确的方法 : 符号表?
    - 如何执行字节码 / 内存结构
    - 对动态语言的支持
- 热点探测 / 即时编译 (JIT) : Graal 编译器
- 内存模型 : 结构 / 原子性 / 可见性 / 有序性
- 线程安全

优点

- 一次编译, 到处(随处)运行. Write Once, Run Anywhere.
- 相对安全的内存管理和访问机制
    - 避免绝大部分内存泄露和指针越界
- 实现了热点代码检测 & 运行时编译及优化
- _完善的 API_

运行在 JVM 上的编程语言

- Kotlin
- Clojure
- JRuby
- Groovy

JDK 特性

- JDK 1.1
    - JAR 文件格式
    - JDBC
    - JavaBeans
    - RMI - Remote Method Invocation 远程方法调用
    - 语言层面
        - Inner Class 内部类 & Reflection 反射
- JDK 1.2
    - ? EJB
    - ? Java Plug-in
    - ? Java IDL
    - JIT - Just In Time 即时编译器
    - 语言层面
        - 关键字 scrictfp - strict float point 精确浮点
- JDK 1.3
    - Java 类库改进 : 数学运算 / Timer API / …
    - JNDI - Java Naming and Directory Interface 命名和目录接口
    - ……
- JDK 1.4
    - 正则表达式
    - 异常链
        - _指将捕获的异常包装进一个新的异常中并重新抛出的异常处理方式_
        - _原异常被保存为新异常的一个属性, 例如 cause_
        - _这个想法是指一个方法应该抛出定义在相同的抽象层次上的异常, 但不会丢弃更低层次的信息_
    - NIO - Java Non-blocing IO 非阻塞性 IO
        - _为所有的原始类型提供 (Buffer) 缓存支持_
        - _字符集编码解码解决方案_
        - _Channel ：一个新的原始 I/O 抽象_
        - _支持锁和内存映射文件的文件访问接口_
        - _提供多路 (non-blocking) 非阻塞式的高伸缩性网络I/O_
    - 日志类 log
    - XML 解析器
    - ? XSLT 转换器
- JDK 1.5 → JDK 5 _( 命名方式转变 )_
    - 语法
        - 自动装箱
        - 泛型
        - 动态注解
        - 枚举
        - 可变长参数
        - 遍历循环 foreach
    - JMM - Java Memory Model 内存模型
    - java.util.concurrent 并发包
- JDK 6
    - _J2EE / J2SE / J2ME → Java EE / Java SE / Java ME ( 命名转变 )_
    - 初步的动态语言支持
    - 编译器注解处理器
    - 微型 HTTP 服务器 API
    - 虚拟机内部改进
        - 锁与同步
        - 垃圾收集
        - 类加载
- JDK 7
    - G1 - Garbage-First 收集器
    - 加强对非 Java 语言的调用支持
    - 可并行的类加载架构
- JDK 8
    - Lambda 表达式, 支持函数式编程
    - 动态语言支持 _( 例如 Groovy )_
    - 新的时间日期 API _( 例如 LocalDateTime )_
    - _JEP - JDK Enhancement Proposals 来定义和管理发布的特性_
- JDK 9
    - Jigsaw 虚拟机层面的模块化支持
    - _管理发布变化_
        - _3月 / 9月 各发布一个大版本, 避免引发交付风险_
        - _每三年划出一个 LTS - Long Term Support 长期支持版本_
            - _JDK 8 & JDK 11 是 LTS 版本, 下一个是 JDK 17_
- JDK 10
    - 内部重构
        - 统一源仓库
        - 统一垃圾收集器接口
        - 统一即时编译接口 : 引入 Graal 即时编译器
    - _2018.6 JMC 开发团队解散_
    - _2018.10 最后一届 JavaOne 大会_
- JDK 11
    - ZGC 革命性的垃圾收集器
    - 类型推断加入 Lambda 语法
- JDK 12
- JDK 13
    - [语法糖](https://mp.weixin.qq.com/s?src=11&timestamp=1584695676&ver=2228&signature=yUmOZYGmdezPvlNcdVw7CK4MptGLS70zFrklGJlGoQpJ-ejAUISbIxSwH9wn6j6aSHHYSZIA7m3q7DkDP3Tbn1XQSKpf2raY8aqowgGAwD9xTyPjwItuupWgwo4r36ut&new=1)
        - switch 表达式 _( 简化了传统写法, 增强了语法糖和用法 )_
        - Text Blocks 文本块 _( 不用转义, 使用三重双引号, 划出文本块 )_

题外话 : JVM的GC释放的内存会还给操作系统吗？

- GC后的内存如何处置，其实是取决于不同的垃圾回收器的。因为把内存还给OS，意味着要调整JVM的堆大小，这个过程是比较耗费资源的。
- 在JDK 11中，Java引入了ZGC，这是一款可伸缩的低延迟垃圾收集器，但是当时只是实验性的。并且，ZGC释放的内存是不会还给操作系统的。

VM 发展

- Exact VM
    - Exact Memory Management 准确式内存管理
        - aka. Non-Conservative/Accurate Mem. Mgt.
        - 指 VM 可以知道某个位置数据的类型, 例如 整数 12345
- HotSpot VM
    - 默认的 JVM
    - _(也有)_ 准确式内存管理
    - 热点探测技术 _( 通过执行计数器, 找到最具编译价值的代码 )_
        - 即时编译 或 栈上替换编译 OSR ( On-Stack Replacement )
- BEA Liquid VM / Azul VM
    - 针对特定架构的硬件, 进行优化, 充分发挥硬件性能
        - 自带操作系统/越过操作系统, 不需要再进行内核态/用户态的切换, 直接控制硬件…… 等
- Graal VM
    - 无语言倾向 : "Run Programs Faster Anywhere."
    - 在 HotSpot VM 的基础上, 增强成跨语言全栈虚拟机
        - 可以作为任何语言的运行平台使用
            - _包括 Java / Scala / Groovy / Kotlin 等 JVM 之上的语言_
            - _还有 C / C++ / Rust 等基于 LLVM 的语言_
            - _还有 JavaScript / Ruby / Python / R 等_
        - _无额外开销地混合使用这些编程语言_
        - _支持不同语言中混用对方接口和对象_
        - _也支持这些语言使用已经编写好的本地库文件_
    - 原理 :
        - 将不同语言的源码, 编译成中间格式 _( 例如 LLVM 字节码 )_
        - 通过解释器转换为能被 Graal VM 接受的中间表示 _( IR - Intermediate Representation )_
            - _? 不是特别明白 中间码 和 中间表示 的区别_

即时编译器

- C1 编译器 : 编译时间短, 代码优化程度低 -- 客户端编译器
- C2 编译器 : 编译时间长, 代码优化程度高 -- 服务器编译器
    - 通常它们会在分层编译机制下, 与解释器互相配合来共同构成 HotSpot VM 的执行子系统
- Graal 编译器 : C2 的替代者
    - 可维护性更好, 性能还反超历史悠久的 C2 _( 代码复杂难以维护 )_
    - 支持更复杂的优化
        - Partial Escape Analysis 部分逃逸分析
        - Aggressive Speculative Optimization 预测性优化 _( 比较激进 )_

提前编译 AOT - Ahead of Time Compilation

- 相对于 "即时编译" 的概念, 提前将所有代码编译好
    - 启动更快, 不用预热
    - 但是破坏了 "一次编写, 到处运行" 的约定
        - 不同的硬件和操作系统需要不同的发行包
- _"向 Native 迈进", 性能更好, 内存占用更小, 运行时环境更小_

## 内存区域 & 内存溢出异常

### 运行时数据区

JVM 运行时数据区 Runtime Data Area

- 方法区 Method Area ( 有所有线程共享的数据区, 以下简称 共享 )
- 堆 Heap ( 共享 )
- 虚拟机栈 VM Stack ( 线程隔离的数据区, 以下简称 私有 )
- 本地方法栈 Native Method Stack ( 私有 )
- 程序计数器 Program Counter Register ( 私有 )

其它相关部分

- 执行引擎 ( 共享 )
- 本地库接口 ( 共享 )
- 本地方法库 ( 未知 )

_以上详情看原书 图2-1 Java虚拟机运行时数据区_

程序计数器 Program Counter Register

- 当前线程所执行的字节码的行号指示器 _( 跟软硬件/操作系统的体系结构类似 )_
- **字节码解释器工作时, 通过改变该计数器来选取下一条需要执行的字节码指令**
- 即 程序控制流的指示器 -- 分支/循环/跳转/错误处理/线程恢复 均依赖它
- JVM 多线程, 每个线程都需要独立的程序计数器, 所以它是 线程私有的内存数据

Java 虚拟机栈 Java Virtual Machine Stack

- 也是线程私有的, 生命周期与线程相同
- 每个方法被执行时, JVM 都会创建一个栈帧 Stack Frame
    - 用于存储 局部变量表 / 操作栈 / 动态链接 / 方法出口等信息
    - 每个方法被调用直至执行完毕, 对应着一个栈帧从入栈到出栈的过程
- 局部变量表
    - 存放编译器可知的数据
        - Java 基本数据类型 : boolean / byte / …… / long / double
        - 对象引用 reference : 可能是引用指针/句柄/…
        - returnAddress 类型 : 指向一条字节码指令的位置
    - 数据类型 : 在变量表中, 以局部变量槽 Slot 来表示
        - 除了 long 和 double 用 2 个变量槽, 其它类型只用 1 个
        - 变量槽 slot 实际多大, 由 JVM 具体的实现来决定

本地方法栈 Native Method Stack

- 跟虚拟机栈的区别
    - 虚拟机栈 : 为虚拟机执行 Java 方法 (也就是字节码) 服务
    - 本地方法栈 : 为虚拟机使用到的本地 (Native) 方法服务
        - ? 字节码 和 Native 方法的区别 ?
- 有的虚拟机如 HotSpot VM 直接把 VM Stack 和 Native Method Stack 合二为一

Java 堆 Heap

- 所有线程共享的一块内存区域, VM 启动时创建
- 所有的对象实例以及数组都应当在对上分配
- 垃圾收集器管理 Java Heap, 也被成为 GC 堆 ( Garbage Collected Heap )
    - 从回收内存的角度看, 现代垃圾收集器 大部分都基于 **分代收集理论设计**
    - 从分配内存的角度看, 所有线程共享的 Java 堆 可以划分出多个线程私有的分配缓冲区, 以提升分配效率
        - 线程私有分配缓冲区 TLAB - Thread Local AllocationBuffer
- Java Heap 可以处于物理上不连续的内存空间中 _( 虚拟内存空间? )_
- Java Heap 既可以被实现为 固定大小的, 也可以是 可拓展的
    - 主流都是 可拓展的 ( 通过参数 -Xmx 和 -Xms 设定 )

方法区 Method Area

- 各个线程共享的内存区域
- 存储 已被虚拟机加载的类型信息 / 常量 / 静态变量 / 即时编译器编译后的代码缓存 / …
- 运行时常量池 Runtime Constant Pool -- Method Area 的一部分
    - 常量池表 Constant Pool Table : 存放编译器生成的各种字面量与符号引用
        - 它们在类加载后, 存放到方法区的运行时常量池中

直接内存 Direct Memory

- 并不是虚拟机运行时数据区的一部分, 也不是 JVM 规范中定义的内存区域
- JDK 1.4 加入 NIO ( New Input/Output )
    - 引入基于通道 Channel 与缓冲区 Buffer 的 I/O 方式
    - 可以使用 Native 函数直接分配对外内存 _( 容易内存溢出 )_
    - 然后通过一个存储在 Java Heap 里的 DirectByteBuffer 对象作为这块内存的引用进行操作
    - ? 显著提高性能, 因为避免了在 Java Heap 和 Native Heap 中来回复制数据
- 用途/原因, 详见

### HotSpot VM 的对象和内存

对象的创建

- new 指令 -> 检查指令的参数是否能在 常量池 中定位到一个类的 符号引用
- 并且检查这个 符号引用 代表的类是否已被 加载、解析和初始化过
- 若无, 必须先执行相关的 类加载过程 (详情暂略)
- 为新创建的对象 分配内存, 并将内存空间置0
    - 内存大小在类加载后可以完全确定
- 执行 构造函数, 即 Class 文件中的 <init>() 方法

技术名词

- 指针碰撞 Bump The Pointer
- 空间列表 Free List
- 空间压缩整理 Compact
- 清除 Sweep
- 对象头 Object Header : 对象相关的信息存放处

如何保证能成功地并发分配内存

- A. 对分配内存空间的动作进行同步处理
    - 采用 CAS 配上失败重试的方式保证更新操作的原子性
- B. 把内存分配的动作按照线程划分在不同的空间之中进行
    - 即每个线程在 Java 堆中预先分配一小块内存, 称为 本地线程分配缓存 TLAB - Thread Local Allaction Buffer
    - 那个线程要分配内存, 就在那个线程的 TLAB 分配
    - 等 TLAB 用完了, 分配新的缓存区时, 才需要同步锁定

对象的内存布局

- 在 HotSpot 虚拟机里, 对象在堆内存中的存储布局可以划分为
    - 对象头 Header
    - 实例数据 Instance Data
    - 对齐填充 Padding

对象头 Object Header

- HotSpot VM 里, 对象头包括两类信息 :
    - 1\. 存储对象自身的运行时数据
        - HashCode
        - GC 分代年龄
        - ? 锁状态标志
        - ? 线程持有的锁
        - ? 偏向进程 ID
        - ? 偏向时间戳
    - 2\. 类型指针
        - 即对象指向它的类型元数据的指针
        - JVM 通过它来确定该对象是哪个类的实例
        - _不是所有 VM 实现都必须在对象数据上保留类型指针_
        - 如果对象是一个 Java 数组, 还必须有一块用于记录数据长度的数据
    - 3\. 对齐填充
        - HotSpot VM 的自动内存管理系统, 要求对象起始地址必须是 8 bytes 的整数倍

对象自身的运行时数据

- 存储这些信息的长度在 32 位和 64 位的 VM (未开启压缩指针) 分别为 32 bits 和 64 bits, 官方称为 Mark Word
- 考虑到 VM 的空间效率, 它是一个动态定义的数据结构
    - 在极小的空间内存储尽可能多的数据, 根据对象的状态复用自己的存储空间 -- 按位存储 _(布局 & 每位的含义等详见原书)_

OOPs - Ordinary Object Pointers

对象的访问定位

- Java 程序通过栈上的 reference 数据来操作 heap 上的具体 object
- VM 规范中没有规定 reference 应该通过什么方式来定位和访问
- 主流方式有 :
    - A. 句柄 handle
        - Java Heap 中划分出句柄池, reference 中存储的就是对象的句柄地址
        - 句柄中包含 : _(详见原书图2-2)_
            - **对象实例数据的 指针**
            - 类型数据的指针 _(指出各实例数据的数据类型)_
        - 优点 : reference 存储稳定的句柄地址
            - 对象被移动时 _(垃圾收集时会异动对象)_ , 只需要改变句柄中的 实例数据指针, 不需要修改 reference 本身
    - B. 直接指针 direct pointer
        - reference 中直接存储 对象地址
        - 地址所指的数据 包含 : _(详见原书图2-3)_
            - **对象实例数据**
            - 类型数据的指针
        - 优点 : 速度更快, 节省一次指针定位的时间
    - HotSpot VM 主要使用 direct pointer 的方式访问对象 _(当然也有例外情况)_

概念区分

- 内存泄露 Memory Leak
- 内存溢出 Memory Overflow

JVM 参数

- `-Xms` 设置 堆的最小值, 例如 -Xms20m
- `-Xmx` 设置 堆的最大值, 例如 -Xmx4g
- `-Xss` 设置 栈容量, 例如 -Xss128k
    - 不同版本的 JVM 和操作系统, 栈容量最小值限制有所不同
        - JDK 11
            - Linux 228K
            - Windows 180K
- `-Xoss` 设置 本地方法栈容量

## 垃圾收集器 & 内存分配策略

"Java 与 C++ 之间有一堵由动态内存分配和垃圾收集技术所围成的高墙, 墙外的人想进去, 墙里面的人却想出来." 感觉大多数人跨过这堵墙之后就不想出来了.

> 垃圾收集 GC - Garbage Collection

引用计数算法 Reference Counting

- 占用额外的内存来进行计数
    - 优点 : 原理简单, 判定效率高
- 主流 JVM 没有选用 引用计数算法 来管理内存
    - 主要原因 : 有许多例外情况要考虑, 需要大量额外的处理
        - 例如, 引用计数很难解决对象之间相互引用的问题

可达性分析算法 Reachability Analysis

- 基本思路
    - 通过一系列称为 GC Roots 的根对象作为起始节点集
    - 从这些节点开始, 根据引用关系向下搜索, 搜索过程所走过的路径称为 引用链 Reference Chain
    - 如果某个对象到 GC Roots 间没有任何引用相连
        - 或者用图论的话来说, 就是从 GC Roots 到这个对象不可达时, 则证明此对象是不可能再被使用的

固定可作为 GC Roots 的对象包括

- VM Stack (栈帧中的本地变量表) 中引用的对象
    - 例如, 各个线程被调用的方法堆栈中使用的参数、局部变量、临时变量等
- Method Area 中静态属性引用的对象
    - 例如 Java 类的引用类型静态变量
- Method Area 中常量引用的对象
    - 例如 字符串常量池 String Table 中的引用
- Native Method Stack 中 JNI (即通常所说的 Native 方法) 引用的对象
- JVM 内部的引用
    - 例如, 基本数据类型对应的 Class 对象,
    - 一些常驻的异常对象 NullPointerException、OutOfMemoryError 等
    - 系统类加载器
- 所有被同步锁 (synchronized 关键字) 持有的对象
- 反应 JVM 内部情况的 JMXBean、JVMTI 中注册的回调、本地代码缓存等

某类 "食之无味弃之可惜" 的对象

- 当内存空间还够用时, 能保存在内存中
- 如果内存空间在 GC 后仍然紧张, 这些对象就会被抛弃

所以, 要扩充 reference 的概念 (以便描述某类对象)

- 强引用 Strongly Reference : 对应传统 "引用" 的定义
- 软引用 Soft Reference : 还有用但非必须的对象
    - 在系统发生内存溢出异常前, 对这些对象进行第二次回收
    - 如果还没有足够的内存, 才会抛 StackOverflowError
- 弱引用 Weak Reference : 非必须的对象, 比软引用更弱
    - 只能生存到下一次垃圾手机发生为止
- 虚引用 Phantom Reference : 幽灵引用 / 幻影引用 -- 最弱的引用
    - 一个对象是否拥有虚引用, 完全不会对其生存期构成影响
    - 无法通过它取得对象实例
    - 设置它的 唯一目的 : 能在对象被收集器回收时, 收到一个系统通知 (详情?)

对象是否回收的判断过程 : 两次标记过程

- 如果对象 Reachability Analysis 后发现没有与 GC Roots 相连接的引用链 -- 第一次被标记
- 随后进行一次筛选, 条件是此对象是否有必要执行 finalized() 方法
    - 如果对象没有覆盖 (自定义的) 的 finalize() 方法
    - 或者 finalize() 已经被 VM 调用过
    - 就会被视为 "没有必要执行 finalize()" (然后第二次被标记 -> 回收 (死亡))
- 如有必要, 执行 finalize()
    - 对象被放置到 F-Queue 队列中
    - 稍候有 VM 自动建立、低调度优先级的 Finalizer 线程去执行它们的 finalize() 方法
    - 稍后收集器将对 F-Queue 中的对象进行第二次 小规模(?) 的标记
        - 如果此时, 对象将 this 重新与引用连上的任何一个对象, 就可以暂时免除被回收 (死亡), 可以继续存活

@Deprecated : 避免使用 finalize()

- finalize() 脱胎于 C++ 的析构函数 (妥协, 让 C/C++ 程序员更容易接受 Java)
- 缺点 : 运行代码高昂, 不确定性大, 无法保证各个对象的调用顺序
- 例如 关闭外部资源 (close file), 用 try-finally 比使用 finallize() 更及时合理

回收方法区
