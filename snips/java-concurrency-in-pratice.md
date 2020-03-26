# Java Concurrency in Pratice

References

- Book "Java Concurrency in Pratice"
    - ZH Ver. :《 Linux 并发编程实战 》

## 简介 Introduction

Unknown Keywords

- 活跃性
- 竞态条件
- 复合操作
- 内置锁
- 重入
- volatile
- 逸出
- ad-hoc 线程封闭
- 栈封闭
- 实例封闭
- 同步容器
- 并发容器
- 闭锁
- FutureTask
- 信号量 _(半懂不懂)_
- 栅栏
- Amdahl 定律
- 锁分段
- 热点域
- 定时锁 _(超时失效?)_
- synchroinzed
- ReentrantLock
- 条件队列
- 条件谓词
- 过早唤醒
- CountDownLatch

GUI 程序的运行方式

- 主事件循环 Main Event Loop
- 事件分发线程 EDT - Event Dispatch Thread _(用以代替主事件循环)_

并发安全问题

- 竞态条件 Race Condition
    - 在多线程环境下, getValue 是否会返回唯一的值, 取决于运行时, 各线程中操作的交替执行方式
- 如果没有 "同步"
    - 无论是编译器、硬件还是运行时, 都可以随意安排操作的 执行时间 和 顺序
    - _例如, 对寄存器或处理器中的变量进行缓存, 而被缓存的变量对于其它线程来说暂时(甚至永久)不可见_
- _注意 : 尽量不要破坏线程安全性 (自言自语)_

活跃性

- 安全性 : 永远不发生糟糕的事情
    - Safety : nothing bad ever happens
- 活跃性 : 某件正确的事情最终会发生
    - Liveness : something good eventually happens
    - 当某个操作无法继续执行下去时, 就会发生 liveness failure
        - 例如, 无意中造成无限循环, 后续的代码无法继续执行
- 性能 : 希望正确的事情尽快发生

## 基础知识 Fundamentals

### Thread Safety

TODO
