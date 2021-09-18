# Java Concurrency in Pratice

References

- Book "Java Concurrency in Pratice"
    - ZH Ver. :《 Linux 并发编程实战 》

## Introduction

Unknown Keywords

- 活跃性 liveness
- 竞态条件 race condition
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

并发安全问题 Thread-safety

- 竞态条件 Race Condition
    - 由于不恰当的执行时序而出现不正确的结果
    - _在多线程环境下, getValue 是否会返回唯一的值, 取决于运行时, 各线程中操作的交替执行方式_
- 如果没有 "同步"
    - 无论是编译器、硬件还是运行时, 都可以随意安排操作的 执行时间 和 顺序
    - _例如, 对寄存器或处理器中的变量进行缓存, 而被缓存的变量对于其它线程来说暂时(甚至永久)不可见_
- _注意 : 尽量不要破坏线程安全性 (自言自语)_

安全性 Safety & 活跃性 Liveness

- 安全性 : 永远不发生糟糕的事情
    - Safety : nothing bad ever happens
- 活跃性 : 某件正确的事情最终会发生
    - Liveness : something good eventually happens
    - 当某个操作无法继续执行下去时, 就会发生 liveness failure
        - 例如, 无意中造成无限循环, 后续的代码无法继续执行
- 性能 : 希望正确的事情尽快发生
    - Performance : we want good things to happen quickly

## Fundamentals

基础知识

### Thread Safety

Writing thread-safe code is, at its core, about managing access to **state**, and in particular to **shared**, **mutable** state.

- _线程安全的核心 : 对状态 (state) 访问操作进行管理, 特别是对共享的 (Shared) 和可变的 (Mutable) 状态的访问_

Informally, an **object's state** (对象的状态) is its data, stored in state variables such as **instance or static fields**.

- _对象的状态 : 存储在状态变量 (例如 实例或静态域) 中的数据_

By **shared**, we mean that <u>a variable could be accessed by multiple threads</u>; by **mutable**, we mean that <u>its value could change during its lifetime</u>.

- _共享 意味着 变量可以被多个线程同时访问_
- _可变 意味着 变量的值在其生命周期内可以发生变化_

Making an object **thread-safe** requires using **synchronization** to coordinate access to its mutable state.

- _需要采取同步机制来协同 (coordinate) 这些线程对变量的访问_

Primary Mechanism for Synchronization in Java

- `synchronized` keyword
- `volatile` variables
- explicit locks
- atomic variables

If **multiple threads access the same mutable state variable without appropriate synchronization**, your program is broken. There are three ways to fix it:

- **Don't share** the state variable across threads;
- Make the **state variable immutable**; or
- Use **synchronization** whenever accessing the state variable.

When designing thread-safe classes, good object-oriented techniques - encapsulation, immutability, and clear specification of invariants - are your best friends.

- _invariant : n. 不变式/不变量 ; adj. 不变的/无变化的_

线程安全 Thread-Safety 的 (非标准) 定义

- A class is **thread-safe** if it **behaves correctly** when accessed from multiple threads, regardless of the scheduling or interleaving of the execution of those threads by the runtime environment, and **with no additional synchronization or other coordination on the part of the calling code**.

---

**Stateless** objects are always thread-safe.

### 原子性 Atomicity

**竞态条件 Race Condition** (定义见上文) 常见类型

- 先检查后执行 Check-Then-Act : 通过一个可能失效的观测结果来决定下一步的动作
- 延迟初始化 Lazy Initialization : 将对象的初始化工作推迟到实际被使用时才进行, 同时要确保只被初始化一次

如何解决?

- **复合操作 Compound Actions** : 以原子方式确保线程安全性
    - 加锁 Locking : 确保原子性的内置机制

### 加锁机制 Locking

Atomic operation need locking.

- To **preserve state consistency**, update related state variables in a single atomic operation.

**内置锁 Intrinsic Lock**

- 同步代码块 ( Synchronized Block )
    - It has 2 parts :
        - a reference to an object that will serve as the lock
        - a block of code to be guarded by that lock
- 以关键字 synchronized 来修饰的方法
    - 横跨整个方法体的同步代码块
    - 同步代码块的锁就是方法调用所在的对象
- A `synchronized` method is shorthand for a synchronized block that spans an entire method body, and whose lock is the object on which the method is being invoked.
    - (Static synchronized methods use the Class object for the lock.)

```java
synchronized (lock) {
    // Access or modify shared state guarded by lock
}
```

每个 Java 对象都可以用做一个实现同步的锁, 它们被称为

- 内置锁 Intrinsic Lock 或 监视锁 Monitor Lock
- **线程在进入同步代码块之前会自动获得锁; 并且在退出同步代码块时, 自动释放锁**
- Java 的内置锁相当于一种 互斥体 mutex ( 或互斥锁 mutual exclusion lock )
    - 最多只有一个线程能持有这种锁

**重入 Reentrancy**

- Because intrinsic locks are **reentrant**, if a thread tries to acquire a lock that it already holds, the request succeeds.
- Reentrancy means that locks are **acquired on a per-thread rather than per-invocation basis**.

重入的实现 ( implement )

- Components
    - Reentrancy is implemented by associating with each lock **an acquisition count** and **an owning thread**.
- Process
    - When the count is zero, the lock is considered unheld.
    - When a thread acquires a previously unheld lock, the JVM records the owner and sets the acquisition count to one.
    - If that same thread acquires the lock again, the count is incremented, and when the owning thread exits the synchronized block, the count is decremented.
    - When the count reaches zero, the lock is released.

### Guarding State with Locks

For each mutable state variable that may be accessed by more than one thread, all accesses to that variable must be performed with the same lock held. _In this case, we say that the variable is guarded by that lock._

Every shared, mutable variable should be guarded by exactly one lock. _Make it clear to maintainers which lock that is._

For every invariant (不变性条件) that involves more than one variable, all the variables involved in that invariant must be guarded by the same lock.

### Liveness & Performance

_实例讨论略, 详见原书_

- 例子 : 对已经使用了同步代码块来构造了 long 的原子操作, 就不要使用 AtomicLong 了
    - **同时使用两种同步机制, 性能和安全性上都不好**

There is frequently a tension between simplicity and performance. When implementing a synchronization policy, resist the temptation to prematurely sacrifice simplicity ( potentially compromising safety ) for the sake of performance.

- 不要盲目地为了性能而牺牲简单性 ( simplicity )

Avoid holding locks during lengthy computations or operations at risk of not completing quickly such as network or console I/O.

- 当执行 时间较长的计算 或者 无法快速完成的操作 时 ( 例如, 网络或控制台 I/O ), 一定不要持有锁

## Sharing Objects

- **临界区 Critical Section : 访问共享资源的程序片段**
- 内存可见性 Memory Visibility

### Visibility

In general, there is no guarantee that the reading thread will see a value written by another thread on a timely basis, or even at all.

- 通常, 我们无法确保执行读操作的线程能适时地看到其他线程写入的值, 有时甚至是根本不可能的

In order to ensure **visibility of memory** writes across threads, you must use synchronization.

- 为了确保多个线程之间对内存写入草的可见性, 必须使用同步机制

---

In the absence of synchronization, the compiler, processor, and runtime can do some downright weird things to the order in which operations appear to execute.

- **在没有同步的情况下, 编译器、处理器以及运行时等都可能对操作的执行顺序进行一些意想不到的调整** _( 会重排到什么程度呢? 没有深入的遭遇和体会 )_

Attempts to reason about the order in which memory actions "must" happen in insufficiently synchronized multithreaded programs will almost certainly be incorrect.

- 在缺乏足够同步的多线程程序中, 要想对内存操作的执行顺序进行判断, 几乎无法得出正确的结果

---

失效数据 Stale Data

- 缺乏同步的程序中, 可能产生错误的结果, 其中一种情况是 -- 失效数据
    - 查看某个变量时, 可能获得一个失效值
    - 甚至 一个线程可能获得某个变量的最新值, 而获得另一个量的失效值

非原子的 64 位操作

- **最低安全性 ( out-of-thin-air safety )** : 适用于绝大多数变量
    - 当线程在没有同步的情况下读取变量, 可能会得到一个失效值
    - 但至少是由之前某个线程设置的值, 而不是一个随机值
- _最低安全性的例外 : 非 volatile 类型的 64 位数值变量 ( long & double )_
    - _Java 内存模型要求, 变量的读取操作和写入操作都必须是原子操作_
    - _对非 volatile 类型的 long 和 double 变量, JVM 允许将 64 位的读操作或写操作分解为两个 32 位的操作!?_
    - _当读取一个非 volatile 类型的 long 变量时, 如果对该变量的读操作和写操作在不同的线程中执行, 那么很可能会读到某个值的高 32 位和另一个值的低 32 位_

volatile 变量

TODO
