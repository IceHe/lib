# Linux Kernel

References

- Book "Linux Kernel Development, Third Edition"
    - ZH Ver. :《 Linux 内核设计与实现（原书第3版）》

## Introdution

Linux 特点

- 设计简洁
- 所有东西都被当做 "文件" 对待
    - 典型的例外 Sockets ( 不是文件 )
- C 语言实现 -> 易移植

设计理念

- 设计 ( design ) & 机制 ( mechanism? ) 分离

内核设计

- 单内核 ( [monolithic kernel](https://en.wikipedia.org/wiki/Monolithic_kernel) ) : e.g. Unix, Linux
- 微内核 ( [microkernel](https://en.wikipedia.org/wiki/Microkernel) ) : e.g. macOS, Windows

内核提供的服务

- 中断响应 ( interrupt )
- 进程调度 : 管理多个进程, 分享 CPU 时间 ( process scheduling )
- 内存管理 : 管理进程地址空间 ( memory management )
    - 地址空间 ( [address space](https://en.wikipedia.org/wiki/Address_space) )
    - or 虚拟内存 ( virtual memory ) ?
- 网络 : TCP/IP … ( network )
- 进程间通讯 : IPC ( Inter-Process Communication )

处理器的活动

- 运行于用户空间, 执行用户进程
- 运行于内核空间, 处于进程上下文, 代表某个特定的进程执行
- 运行于内核空间, 处于中断上下文, 与任何进程无关, 处理某个特定的中断
    - 例如, 键盘 / 鼠标 事件 ……

Linux 跟 Unix 的 显著差异

- 支持动态加载内核模块 ( Loadable Kernel Module )
- 支持对称多处理 ( SMP : [Symmetric Multi-Processing](https://en.wikipedia.org/wiki/Symmetric_multiprocessing) ) 机制
    - 特点 : 多个 CPU 共享一台计算机的内存 (及其它资源)
    - 目标 : 利用多 CPU (多核) 并行处理, 提升单机性能
- 支持抢占 ( preemptive / [pre-emption](https://en.wikipedia.org/wiki/Preemption_(computing)) )
- 不区分 线程 & 进程 : 所有 进程 & 线程 都一样, **只不过其中的一些 进程 / 线程 共享资源而已**
- _提供具有设备类的面向对象的 设备模型 / 热插拔事件, 以及用户空间的 设备文件系统 ( [sysfs](https://en.wikipedia.org/wiki/Sysfs) )_
    - TODO : 暂时还没能跟以往知识联系起来
    - sysfs : "a pseudo file system" provided by the Linux kernel that exports information about various kernel subsystems, hardware devices, and associated device drivers from the kernel's device model to "user space" through "virtual files". In addition to providing information about various devices and kernel subsystems, exported virtual files are also used for their configuration.
- _忽略了设计得拙劣的 Unix 特性 / 过时的标准_
- _体现了 "自由" 的精髓 ( 我 ???? 无关紧要 ) : 公开开发模型, 自由发展, 实用主义_

内核版本号

- 英文句号 "." 分隔
- 第 1 位 : 主版本号 ( major version )
- 第 2 位 : 从版本号 ( minor version )
    - 单数 : 开发版 ( development )
    - 双数 : 稳定版 ( stable )
- 第 3 位 : 修订版本号 ( revision version )
- 第 4 位 : 稳定版本号 ( stable version )
- 前两位加起来, 例如 "2.6" 代表一个内核系列 ( kernel series )

内核开发的特点

- 不能访问 **C 库** ( [ANSI C Lib](https://en.wikipedia.org/wiki/C_standard_library) ? ), 以及标准的 C 头文件
    - 原因 : 速度 & 大小 ( 太大 )
- 必须使用 **GNU C** ( [GNU C Lib / glibc](https://en.wikipedia.org/wiki/GNU_C_Library) )
    - 内核不完全符合 ANSI C 标准
- 没有 用户空间那样的 **内存保护机制** ( [Memory protection](https://en.wikipedia.org/wiki/Memory_protection) )
- 难以执行 **浮点运算**
    - 由于硬件体系结构的问题, 内核不能完美支持浮点操作 ( 用户空间可以 ).
- 每个进程只有一个很小的 **定长堆栈**
- 由于内核支持 异步中断 / 抢占 / SMP, 因此必须时刻注意 同步 & 并发
    - 进程并发访问共享数据 -> 要求有同步机制 保证不出现竞争条件
    - 常用解决方案 : 自旋锁 ( spin lock ) & 信号量( semaphore )
- _考虑可移植性的重要性_

## Process Management

相关名词

- 进程 ( process ) : 处于执行期的 程序 (目标码 存放在存储介质上)
    - 进程跟 任务 ( task ) 同义
    - 可执行程序代码 ( Unix 称其为 text section )
- 执行线程 ( thread of execution )
- 进程描述符 ( process descriptor )
- 任务列表 ( task list )
    - **内核把进程的列表存放在 task list**
    - list 中每一项的类型为 task_struct
        - task_struct 在 32 位机器上, 大小约 1.7 KB, 较大但合理, 包括 :
            - 进程 打开的文件
            - 进程 地址空间
            - _挂起的信号_ ( 不太懂 ? )
            - 进程 状态 ( process status )
            - ……
        - task_struct 会被 预分配 & 重复使用
            - 以避免 动态分配 & 释放 带来的资源消耗
            - 优点 : 进程创建迅速
    - 双向循环链表结构 : 并非由静态数组实现, 所以不应叫做 task array

现代操作系统的 2 种 "虚拟机制"

- 虚拟处理器
- 虚拟内存 ( virtual memory )

进程的 "生命周期"

- 1\. fork() : 父进程 调用 fork() **创建 子进程**
    - fork() 一共 return 两次
        - 一次 return 到 父进程
        - 另一次 return 到 子进程
    - fork() 实际上由 clone() 系统调用实现的
- 2\. exec() : 创建新的 地址空间, 然后 **把新的程序载入** 其中
- 3\. exit() : 系统调用退出执行, 释放资源
- 4*\. wait4() : 父进程 调用 wait4() 系统调用 查询子进程 是否终结
    - 由内核负责实现 wait4() 系统调用
    - C Lib 通常提供 wait(), waitpid(), wait3(), wait4() 函数
    - **进程退出执行后, 被设置为 "僵死状态"**
        - **直到它的父进程调用 wait() 或 waitpid() 为止**

_内存分配_

- [Slab allocation](https://en.wikipedia.org/wiki/Slab_allocation)

分配进程描述符

```c
struct thread_info {
    struct task_struct  *task;
    ……
}
```

进程状态 ( process state )

- TASK_RUNNING 运行
    - 正在运行 / 在 task list 中待执行
    - _进程在用户空间中执行的唯一可能状态_ ( 不是很理解 ? )
- TASK_INTERRUPTIBLE 可中断
    - 正在睡眠, 被阻塞
- TASK_UNINTERRUPTIBLE 不可中断
- __TASK_TRACED 被跟踪
    - 被其它进程跟踪的进程 例如 ptrace
- __TASK_STOPPED 停止
    - 被停止执行 : 没有运行, 也不能投入运行

进程家族树

- 所有进程是 pid 为 1 的 init 进程的后代
- 1\. 内核在系统启动的最后阶段启动 init 进程
- 2\. init 进程读取系统的初始化脚本 initscript, 并执行其它的相关程序, 最终完成启动

写时拷贝 ( copy-on-write )

- 1\. fork() 时, 父进程 & 子进程 共享同一个进程地址空间
- 2\. 只有需要写入时, 数据才会被复制, 然后各个进程才开始拥有各自的拷贝
- 好处 : 减少系统资源的消耗, 节省复制资源所需的时间, 进程得以快速启动

线程 ( thread )

- 是一个现代编程的抽象概念 : 同一程序内共享内存地址空间运行的一组线程
    - _支持 并发 ( concurrent ) / 并行 ( parallelism ) 设计技术_
- Linux 把所有的线程 ( thread ) 当做进程 ( process ) 来实现
    - _跟 Microsoft Windows 或 Sun Solaris 等操作系统的实现差异非常大_

创建线程

- clone(CLONE_VM | CLONE_FS | CLONE_FILES | CLONE_SIGHAND, 0)
    - 需要用 "参数标志" ( flags ) 指明需要共享哪些资源?
    - 地址空间 / 文件系统资源 / 文件描述符 / 信号处理程序

vfork() 跟 fork() 的区别

- 除了不拷贝父进程的页表项外, 它跟 fork() 的功能基本相同.
- 父进程准备睡眠, 等待紫禁城将其唤醒
    - 紫禁城作为父进程的一个单独的线程在它的地址空间里运行, 父进程被阻塞, 直到子进程退出或执行 exec()

进程终结

- 正常来说, 进程的析构是自身引起的 : 在进程调用 exit（）系统调用时
    - 内核必须释放它所占有的资源
    - 并通知父进程 : 子进程已终结
- 或者 可能隐式地从某个程序的 main 函数返回
    - **其实 C compiler 会在 main() 函数的返回点后面, 放置调用 exit() 的代码!**
- 或者 进程接收到它 既不能处理 也不能忽略的 信号或异常时, 被动地终结

删除进程描述符 : 略

## Process Scheduling
