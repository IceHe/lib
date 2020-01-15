# Linux Kernel

References

- Book "Linux Kernel Development, Third Edition"
    - ZH Ver. :《 Linux 内核设计与实现（原书第3版）》

## Notes

Linux 特点

- 设计简洁
- 所有东西都被当做 "文件" 对待
    - 典型的例外 Sockets ( 不是文件 )
- C 语言实现 -> 易移植

设计理念

- 设计 ( design ) 和 机制 ( mechanism? ) 分离

内核设计

- 单内核 ( [monolithic kernel](https://en.wikipedia.org/wiki/Monolithic_kernel) ) : e.g. Unix, Linux
- 微内核 ( [microkernel](https://en.wikipedia.org/wiki/Microkernel) ) : e.g. macOS, Windows

内核提供的服务

- 中断响应 ( interrupt )
- 进程调度 : 管理多个进程, 分享 CPU 时间 ( process scheduling )
- 内存管理 : 管理进程地址空间 ( memory management )
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
- 不区分 线程 和 进程 : 所有 进程 & 线程 都一样, **只不过其中的一些 进程 / 线程 共享资源而已**
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
