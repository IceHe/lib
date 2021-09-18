# Linux Kernel

References

- Book "Linux Kernel Development, Third Edition"
    - ZH Ver. :《 Linux 内核设计与实现（原书第3版）》
- TODO
    - 为什么系统调用会消耗较多资源 : https://draveness.me/whys-the-design-syscall-overhead
    - 为什么 Linux 默认页大小是 4KB : https://draveness.me/whys-the-design-linux-default-page
    - 处理器感知线程管理系统 · OSDI 2018 : https://draveness.me/papers-arachne
    - NVMe 固态硬盘与键值存储 KVell · SOSP 2019 : https://draveness.me/papers-kvell
    - 调度系统设计精要 : https://draveness.me/system-design-scheduler

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
    - 从整体上作为一个单独的大进程来实现
    - 运行在单独的地址空间上, 运行在内核态下, 功能模块, 直接通过函数进行调用
- 微内核 ( [microkernel](https://en.wikipedia.org/wiki/Microkernel) ) : e.g. macOS, Windows
    - 各功能划分为独立的过程, 每个过程叫一个 "服务器" (server?)
    - 只有请求特权服务的服务器, 才能运行在特权模式下, 其它服务器则运行在用户空间
    - 服务器间通过消息传递通信 -- IPC 进程间通信 机制
- Linux 是单内核, 但是设计和实现上支持 动态加载内核模块

内核提供的服务

- 中断响应 ( interrupt )
- 进程调度 : 管理多个进程, 分享 CPU 时间 ( process scheduling )
- 内存管理 : 管理进程地址空间 ( memory management )
    - 地址空间 ( [address space](https://en.wikipedia.org/wiki/Address_space) )
    - 虚拟内存 ( virtual memory ) / 物理内存 / 页表映射
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
- 提供具有设备类的面向对象的 设备模型 / 热插拔事件, 以及用户空间的 设备文件系统 ( [sysfs](https://en.wikipedia.org/wiki/Sysfs) )
    - sysfs : "a pseudo file system" provided by the Linux kernel that exports information about various kernel subsystems, hardware devices, and associated device drivers from the kernel's device model to "user space" through "virtual files". In addition to providing information about various devices and kernel subsystems, exported virtual files are also used for their configuration.
- _忽略了设计得拙劣的 Unix 特性 / 过时的标准_
- _体现了 "自由" 的精髓 : 公开开发模型, 自由发展, 实用主义_

内核版本号

- 英文句号 "." 分隔
- 第 1 位 : 主版本号 ( major version )
- 第 2 位 : 从版本号 ( minor version )
    - 单数 : 开发版 ( development )
    - 双数 : 稳定版 ( stable )
- 第 3 位 : 修订版本号 ( revision version )
    - 包括 bugfix / 新的 drivers / 新的 features
- 第 4 位 : 稳定版本号 ( stable version )
    - 版本发布周期变长, 才引入 "稳定版本号"
    - 包括关键性的 bugfix, 开发板内核向前移植的重要修改等
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
    - 进程 ( process ) 跟 任务 ( task ) 同义
    - 可执行程序代码 ( Unix 称其为 text section )
- 执行线程 ( thread of execution )
- 进程描述符 ( process descriptor )
- 任务列表 ( task list )
    - **内核把进程的列表存放在 task list**
    - list 中每一项的类型为 task_struct
        - task_struct 在 32 位机器上, 大小约 1.7 KB, 较大但合理
            - _对比 x86 架构的内存页大小一般是 4KB,_ 包括 :
                - 进程 打开的文件
                - 进程 地址空间
                - _挂起的信号_ ( 不太懂 ? )
                - 进程 状态 ( process status )
                - ……
        - task_struct 会被 预分配 & 重复使用 ( slab )
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
    struct task_struct *task;
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

**写时拷贝** ( copy-on-write )

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
- 父进程准备睡眠, 等待子进程其唤醒
    - 紫禁城作为父进程的一个单独的线程在它的地址空间里运行, 父进程被阻塞, 直到子进程退出或执行 exec()

进程终结

- 正常来说, 进程的析构是自身引起的 : 在进程调用 exit（）系统调用时
    - 内核必须释放它所占有的资源
        - ……
    - 并通知父进程 "进程已终结", 并给其子进程找养父
        - 否则 "孤儿进程" 就会在退出时永远处于僵死状态 _( 因为父进程可能在其子进程之前退出 )_
    - 调用 schedule() 切换到新的进程
- 或者 可能隐式地从某个程序的 main 函数返回
    - **其实 C compiler 会在 main() 函数的返回点后面, 放置调用 exit() 的代码!**
- 或者 进程接收到它 既不能处理 也不能忽略的 信号或异常时, 被动地终结

删除进程描述符 : 略

## Process Scheduling

进程调度程序 ( 简称 调度程序 )

- 在可运行态进程之间, 分配优先的 CPU 时间资源的内核子系统

多任务 ( multitasking ) 系统分类

- 抢占式多任务 **preemptive** multitasking
    - 抢占 preemption : 由调度程序来决定, 什么时候停止一个进程的运行, 以便其它进程能够得到执行机会
- 非抢占式多任务 **cooperative** multitasking
    - 让步 yielding : 除非进程自己主动停止运行 ( 主动挂起自己 ) , 否则它会一直执行

调度算法

- "O(1) 调度算法"
- "反转楼梯最后期限调度算法"
    - ( RSDL : Rotating Staircase Deadline scheduler 反转楼梯最后期限调度 )
    - 后来替代 O(1) 算法时, 又名 "完全公平调度算法"
    - ( CFS : Complete Fair scheduler )

进程分类 ( 根据主要消耗的资源划分 )

- I/O 消耗型 : 大部分时间用来 提交 & 等待 I/O 请求
    - 例如, GUI 程序 —— 键盘输入, 网络 I/O
- CPU 消耗型 : 大部分时间用来执行代码

调度策略 两个矛盾目标间的 平衡

- 进程响应迅速 ( 响应时间短 )
- 最大系统利用率 ( 高吞吐量 )

策略

- 按优先级
    - nice 值 : 取值范围 -20 ~ +19 , 默认值为 0, 值越大, 进程优先级越低
        - 运行 `ps -el` , 其中 NI 一列表示 nice 值
    - 实时优先级 : 取值范围 0 ~ 99 , 值越大, 进程优先级越高

时间片 ( **timeslice** / quantum / processor slice )

- 表明进程在被抢占前所能持续运行的时间

抢占时机

- 取决于新的可运行程序消耗了多少处理器 "使用比"
    - 如果消耗的 "使用比" 比当前进程小, 则新进程立即投入运行, 抢占当前进程; 否则推迟运行
    - 例如, 同时给 文本编辑器 和 视频解码器 的使用比为 50%
        - 但是 文本编辑器 经常等待键盘 I/O, 没有消费掉 50% 处理器使用比
        - 所以 CFS 调度算法, 总会在 文本编辑器 需要时被投入运行, 视频解码器在剩下的时刻运行

Unix 系统进程调度

- 每个 nice 值 ( 优先级 ) 对应不同的固定时间片
    - 问题一 : 时间片值是绝对的, 值 0 对应 100 ms, 1 对应 95 ms, 29 对应 10 ms, 20 对应 5 ms
    - 问题二 : 根据 nice 初始值, 进行变化, 处理器使用比波动很大
        - 假定存在两个进程
            - 一个 nice 值为 0, 另一个为 1, 使用处理器时间比为 100 : 95, 还行
            - 一个 nice 值为 19, 另一个为 20, 使用处理器时间比为 10 : 5, 差距悬殊
    - 问题三 : 时间片的绝对值跟 定时器节拍 强相关, 时间片需要是定时器节拍的整数倍
        - 在不同的硬件上, 不容易内核测试 _( 难以适配和调整? )_
    - 问题四 : 进程恶意调整自己的 nice 值, 霸占本该属于其他进程的时间片

CFS 公平调度 简述

- 允许每个进程运行一段时间 / 循环轮转 / 选择运行最少的进程作为下一个运行进程
    - 在所有可运行进程总数基础上, 计算出一个进程应该运行多久 ( 而不是只依靠 nice 值 )
- _时间片的最小粒度 : 默认 1 ms ( 避免不可接受的进程切换消耗 )_

CFS 公平调度 实现

- 组成部分 : **时间记账 / 进程选择 / 调度器入口 / 睡眠和唤醒**

时间记账 ( time-accounting )

- 虚拟实时 vruntime :
    - 计算方法 : 经过了所有可运行进程总数的标准化
    - 以 ns 为单位, 与定时器节拍不相关

进程选择

- 思路 : 选择具有最小 vruntime 的进程
- **可运行进程队列**
    - 组织方式 : **红黑树** ( Linux 中被称为 rbtree )
        - 它是一个 "**自平衡二叉搜索树**"

调度器入口

- 选择哪个进程可以运行, 何时将其投入运行
    - 1\. 找到一个最高优先级的调度类 ( 它要有自己的可运行队列 )
    - 2\. 然后问这个调度类 : 谁才是下一个该运行的进程 ( pick_next_task() )

睡眠和唤醒

- _休眠 ( 被阻塞 ) : 特殊的不可执行状态_

等待队列

- 用途 : 休眠 通过等待队列来处理
- 它是由等待某些事件发生的 进程组成的 简单链表

唤醒 ( wake up )

- 唤醒操作 通过函数 wake_up() 进行, 会唤醒指定的等待队列上的所有进程
    - 调用函数 try_to_wake_up() : 将进程设置为 TASK_RUNNING 状态
    - 调用函数 enqueue_task() 将此进程放入红黑树 ( 可运行进程队列 )
    - 如果被唤醒的 进程优先级 比当前正在执行的 进程的优先级高
        - 还要 **设置 need_resched 标志** : 用于提醒内核是否需要重新执行一次调度

抢占和上下文切换 ( switch context )

- need_resched 标志
    - 表示有其它进程应当被运行了, 提醒 内核 要尽快调用 调度程序
    - 执行流程 : 返回用户空间 以及从中断返回的时候, 内核检查 need_resched 标志
        - 如果已被设置, 内核会继续执行之前, 会调用调度程序

用户抢占

- 内核即将返回用户空间时, 如果 need_resched 标志被设置
    - 会导致 schedule() 被调用, 发生 "用户抢占"
- 发生时机
    - 从系统调用返回用户空间时
    - 从中断处理程序返回用户空间时

内核抢占

- 2.6 版本之前的内核, 调度程序无法抢占 ( 正在运行的 ) 其它内核进程
    - 内核代码一直要执行到完成 ( 返回用户空间 ) 或明显的阻塞为止
- 重新调度的时机 : 只要没有持有锁, 内核就可以进行抢占
    - struct thread_info 中的 preempt_count 计数
        - 进程使用锁时 preempt_count++
        - 进程释放锁时 preempt_count--
- 发生时机
    - 中断处理程序正在执行, 且在返回内核空间之前
    - 内核代码再一次具有可抢占性的时候
    - 如果内核中的任务显式地调用 schedule()
    - 如果内核中的任务阻塞, ( 同样也很重导致调用 schedule() )

---

实时调度的策略

- SCHED_FIFO 先入先出
    - 不使用时间片限制 : 一直执行, 除非被阻塞, 或者主动释放处理器
- SCHED_RR 实时轮流 ( 使用时间片限制的 SCHED_FIFO 策略 )

普通 非实时的调度策略

- SCHED_NORMAL

注意 : 负数的 NICE 值, 只能有 super user ( root? ) 才能设置 ( 用于提高进程的优先级 )

## System Call

系统调用 : 用户进程和内核进行交互的一组接口

- 交互方式 : 应用程序发出各种请求, 内核负责满足这些请求, 或者无法满足时, 返回一个错误
- 目标 : 主要为了保证系统稳定可靠, 避免应用程序恣意妄为
    - 应用程序如果可以随访问硬件而内核又对此一无所知, 那么内核就无法实现多任务和虚拟内存

提供的一些功能

- 让应用程序受限地访问硬件设备
- 创建新进程
- 并与已有进程进行通信
- 申请操作系统其它资源
- ……

POSIX 标准

- Unix 世界中, 最流行的应用编程接口
    - 基于 Unix  的可移植操作系统标准

API 的设计哲学 : **Mechanism, not policy.**

```text
从程序员的角度看, 系统调用无关紧要, 他们只需要跟 API 打交道就可以.
相反, 内核只跟系统调用打交道; 库函数集应用程序如何使用系统调用, 内核不关心.
但是, 内核必须时刻牢记系统调用所有潜在的用途, 并保证它们有良好的通用性和灵活性.

关于 Unix 接口设计有一句格言 "提供机制而不是策略".
`Mechanism, not policy.`

In other words, Unix 的系统调用抽象出用于完成特定确定目的的函数,
至于这些函数怎么用完全不需要内核去关心. ( 合理的解耦 )
```

系统调用号 ( system call number )

- 每个系统调用被赋予一个系统调用号.
    - 用它就能指明要执行的系统调用
    - 删除后不允许被回收利用, 避免已编译过的代码调用系统调用时出错!
- syscall : 系统调用在 Linux 中常被称作 syscall

系统调用处理程序 ( system call handler )

- 通知内核 的机制靠 软中断 ( softriq ) 实现
    - **通过引发一个异常, 来促使系统切换到内核态去执行异常处理程序**
    - 此时的异常处理程序, 实际上就是 "系统调用处理程序"

如何确定 **调用 哪个系统调用?**

- **进入 "系统调用处理程序" 前, 将 "系统调用号" 放到特定的寄存器中**
    - 由内核的 "系统调用处理程序" 自己去特定寄存器去取
        - _我的联想 : 类似于通过 "全局变量" 来传递_
    - 例如, 在 x86 上, 用的是 eax 寄存器

如何 传递参数 给系统调用?

- 类似上文 : 参数也提前 存放在 特定寄存器 ( 多个 ) 中
    - 如果需要传递 6 及以上个数的参数时 ( 不多见 )
    - 此时, 用一个单独的寄存器 存放指向所有这些参数 在用户空间地址的指针.

系统调用 如何返回值?

- 也通过 寄存器传递
    - 例如, 在 x86 系统上, 也是 eax 寄存器
        - _( 上文中提到的, 存放系统调用号的寄存器 )_

实现 系统调用

- 确定 明确的用途
- Linux 不提倡从用多用途的 系统调用 :
    - 一个系统通过传递不同的参数值, 来选择完成不同的工作

## Kernel Data Structure

common

- linked list
- queue
- map
- binary tree

linked list 设计

- **Linux 内核标准链表实现 : 环形双向链表 ( circular doubly linked list )**

linked list 实现

- 实现思路 : 不是将数据结构塞入链表, 而是 **将链表节点塞入数据结构**

节约两次提领 ( dereference )

- 如果已经有链表的 next 和 prev 指针了 :
    - 可以直接调用内部链表函数, 直接省下一点时间
    - _其实就是提领指针的时间_
- 封装好的函数, 没有太多特殊的操作 :
    - 1\. 仅仅找到 next 和 prev 指针
    - 2\. 再调用内部函数而已
- 内部函数 跟 外部包装函数同名 : 仅仅在前面加了两条下划线

queue

- 基本操作 : enqueue, dequeue
- 实现结构 : kfifo
    - 维护 2 个偏移量 : 入口偏移 & 出口偏移
    - _推测 : 用固定大小的数组实现的?_

map 设计

- 映射, 也常被称为 关联数组
    - 在 Linux 被命名为 idr _( 啥单词组合的缩写? )_
- 基本操作 :
    - add(key, value)
    - remove(key)
    - value = lookup(key)

map 实现

- 散列表
    - 优点 : 提供更好的平均的渐进复杂度
- 二叉树 ( binary tree )
    - 优点 : 最坏的情况下, 能有更好的表现
        - 对数复杂度 < 线性复杂性
        - 二叉搜索树, 满足顺序保证, 遍历性能好
        - 不需要散列函数, 只需要定义 <= 操作算子即可

UID : 唯一标识数

- 映射 UID 到一个指针

binary tree

- BST : binary search tree 二叉搜索树
- 自平衡二叉搜索树 : 例如, **rbtree 红黑树 ( 半平衡 )**

## Interrupt Processing

操作系统 对硬件设备进行管理, 它们之间需要能互相通信

- 但是, 处理器 的速度跟 外围硬件设备 不在同一数量级上 _( 差距悬殊 )_
- 如果, 让快速的内核 去请求并等待 硬件缓慢的响应, 效率太低

让硬件在需要的时候, 再向内核发出信号 —— 中断机制

- _由 内核主动 改为 硬件主动_
    - _内核主动 : 例如 pooling 轮询, 周期性地重复执行_
        - _会做很多无用功_

不同的设备 对应的中断不同, 它们都通过一个个唯一的数字来标志不同设备

- 中断值, 通常被称为 中断请求 ( IRQ : Interrupt Request? ) 线
    - IRQ 0 : 时钟中断
    - IRQ 1 : 键盘中断
    - ……
- 对于连接到 PCI 总线上的设备而言, 中断是动态分配的

异常 & 中断

- 它们不一样, 异常在产生时必须考虑与处理器时钟同步
    - 异常, 也常常被成为 "同步中断"
- 许多处理器体系结构处理异常或中断的方式类似, 此时内核处理也类似

中断处理程序 interrupt handler

- 或称 中断服务例程 interrupt service routine ( ISR )
- 中断 可能随发生, 中断处理程序 随时可能执行
    - 所以, 必须保证其能快速执行, 以尽快恢复中断代码的执行

top half ( 上半部 ) & bottom half ( 下半部 )

- 中断处理程序 的两个目标
    - 1\. 运行 _(响应?)_ 得快
    - 2\. 完成的任务量多
    - _它们之间有此消彼长的矛盾关系_
- 中断处理 的两个部分
    - 1\. top half 上半部
    - 2\. bottom half 下半部

top half 的分工

- 接收到中断后, 立即开始执行
- 但只做有严格时限的工作
    - _例如, 对接收的中断进行应答或复位硬件_
    - 这些工作都是在所有中断被禁止的情况下完成的 _( 这里看得不是很懂? )_

bottom half 的分工

- 能够被允许稍后完成的工作, 会推迟到 "下半部"
- 在合适的时间, 下半部会 "被开中断执行" _( 这里看得不是很懂? )_

entropy pool ( 内核熵池 )

- 负责提供从各种随机事件导出真正的随机数

real-time clock ( RTC )

- 是从系统定时器中独立出来的设备
- 用于设置系统时钟, 提供报警器 (alarm), 或周期性的定时器

interrupt context ( 中断上下文 )

procfs 虚拟文件系统

- 它只存在于内核内存
- 一般安装于 /proc 目录
    - 读写文件, 都要调用内核函数, 模拟从真实的文件读写
    - 例如, /proc/interrupts 存放 系统中与中断相关的统计信息

中断控制

- 内核接口提供了 能够禁止当前处理器的中断系统, 或屏蔽掉整个机器的一条中断线的能力
- 一般来说, **控制中断系统 是为了 提供 "同步"**
    - 通过禁止中断, 可以确保某个中断处理程序, 不会抢占当前代码
        - 禁止中断 还可以禁止 内核抢占
        - 然而, 不管是禁止中断还是禁止内核抢占, 都没有提供保护机制防止 来自其它处理器对共享数据的并发访问.
    - 因此, 内核代码一般都需要 **获取** 某种 **锁**
        - **防止来自其它处理器对共享数据的并发访问**
        - 获取这些锁的同时, 也伴随着禁止本地中断
- 两个 保护机制
    - 锁 : 防止 来自其它处理器 对共享数据的并发访问
    - 禁止中断 : 防止 来自其它中断处理程序的 并发访问

## Bottom Half

中断处理程序 存在局限, 只能完成整个中断处理流程的上半部分

- **以异步方式执行, 而且可能打断其它重要代码** ( 甚至包括其它中断处理程序 )
    - 避免被打断代码停止时间过长, 中断处理程序应该执行得越快越好
- 如果当前有一个中断处理程序正在执行
    - 最好情况下 ( 若 IRQF_DISABLED 没被设置 ), 与该中断同级的其它中断会被屏蔽
    - 最坏情况下 ( 若 IRQF_DISABLED 被设置 ), 当前处理器上所有其它中断都会被屏蔽
    - 因此 **禁止中断后, 硬件与操作系统无法通信**, 中断处理程序执行得越快越好
- 由于中断处理程序往往需要对硬件进行操作, 所以对它们有 **很高的时限要求**
- 中断处理程序 **不在进程上下文中运行, 所以 不能阻塞**, 限制了它们所做的事情

需求

- 操作系统必须有一个 快速/异步/简单 的机制负责对硬件做出响应
    - 并完成那些 时间要求很严格的操作
- 对于那些时间要求相对宽松的任务, 就推后到中断被激活以后再去运行

因此

- 整个中断处理流程, 就被划分为两半 :
    - 1\. 中断处理程序 ( 上半部 top half )
    - 2\. 下半部 bottom half

下半部的实现机制

- 起源 : 一开始 Linux 就只提供被叫做 bottom half 的机制
    - 被称作 BH ( 避免跟通用词 bottom half 混淆 )
    - 机制 : 提供一个静态创建, 由 32 个 bottom halves 组成的链表
        - 上半部 通过一个 32 位整数中的一位来标识允许哪个 bottom half 可以执行
    - 缺点 : 易用却不够灵活, 简单却有性能瓶颈
- 任务队列 ( task queue )
    - 是一组队列, 每个队列都是 "等待调用的函数" 组成的链表
        - 根据队列不同, 会在某个时刻被执行
    - 表现不错, 但仍不够灵活, 性能还不够好
        - 不满足性能较高的子系统, 例如网络
    - 2.5 版本内核时, 它被 工作队列 接口取代了
- 软中断 ( softirq ) & tasklet
    - softirqs : 一组静态定义的下半部接口, 有 32 个
        - 必须在编译期间就进行静态注册
        - 可以完全替代 BH 接口
    - tasklet : 基于 softirqs 实现的 灵活性强/动态创建 的下半部实现机制
        - 两个不同类型 tasklet 可以在不同处理器上执行
        - 但类型相同的 tasklet 不能同时执行
        - 目标 : 在性能和易用性之间寻求平衡
    - 大部分下半部处理用 tasklet 就够了
    - 网络这样对性能要求高的情况, 才需要用 softirqs

2.6 系列内核的 3 个 下半部 实现机制

- 软中断 softriq
- tasklet
- 工作队列 work queue

TODO
