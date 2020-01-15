# Linux Kernel

References

- Book "Linux Kernel Development, Third Edition" - ZH Ver.
    - 《 Linux 内核设计与实现（原书第3版）》

## Notes

Linux 特点

- 设计简洁
- 所有东西都被当做 "文件" 对待
    - 典型的例外 Sockets ( 不是文件 )
- C 语言实现 -> 易移植

设计理念

- 设计 和 机制分离

内核设计

- 单内核 : Unix, Linux
- 微内核 : macOS, Windows

内核提供的服务

- 中断响应 ( interrupt )
- 进程调度 : 管理多个进程, 分享 CPU 时间 ( process scheduling )
- 内存管理 : 管理进程地址空间 ( memory management )
- 网络 : TCP/IP … ( network )
- 进程间通讯 : IPC
    - IPC

处理器的活动

- 运行于用户空间, 执行用户进程
- 运行于内核空间, 处于进程上下文, 代表某个特定的进程执行
- 运行于内核空间, 处于中断上下文, 与任何进程无关, 处理某个特定的中断
    - 例如, 键盘 / 鼠标 事件 ……

Linux 跟 Unix 的 显著差异

- 支持动态加载内核模块
- 支持对称多处理 ( SMP ) 机制
    - SMP : [Symmetric Multi-Processing](https://en.wikipedia.org/wiki/Symmetric_multiprocessing)
        - 特点 : 多个 CPU 共享一台计算机的内存 (及其它资源)
        - 目标 : 利用多 CPU (多核) 并行处理, 提升单机性能
