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

## 内存区域与内存溢出异常
