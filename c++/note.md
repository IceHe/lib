title: C++ 笔记
date: 2919-07-09
updated: 2918-07-09
noupdate: true
categories: [C++]
tags: [C++]
description: Note &#58; 简明笔记。
---

# C++

- 内存分配
    - 静态内存分配
        - BSS（Block Started by Symbol）区块起始符
            - 全局变量、静态变量
        - 数据段 data segment
    - 代码段 code segment / text segment
    - 堆 heap
        - 存放进程运行中被动态分配的内存段，可变长
    - 栈 stack
        - 存放进程临时创建的局部变量（如，函数体内的局部变量），不包括 static 变量
    - 其它：堆向上增长，栈向下增长。
- 内存泄露 memory leak
    - 进程未能释放不再使用的内存（然后这些内存无法被其它进程所用）。
- 野指针 wild ptr
    - 指向不可用（不可控、不可知）内存的指针。
- 预处理（宏）
    - 用宏判断大小：
        `#define MAX(a, b) (abs((a) - (b)) == ((a) - (b)) ? (a) : (b))`
    - 用宏判断符号数:
        `#define IS_UNSIGNED(a) (a >= 0 && ~a >= 0)`
        `#define IS_UNSIGNED_TYPE(type) ((type)0 - 1 > 0)`
    - 用宏求 int 的 byte 数：
        `#define SIZE_OF(value) ((char*)(&value + 1) - (char*)&value)`
- 位操作
    - 快速求 2 的 3 次方：`2 << 3`
    - 快速求整数 x 的七倍：`x << 3 - x`
    - 求平均值：
        - 传统方法：`(x + y) / 2` 可能会溢出
        - 奇巧方法：`(x & y) + ((x ^ y) >> 1)`
            - 解释：从二进制角度来说
                - `(x & y)` 等于都是 1 的 bit（数位）相加的结果除以二了；
                - `(x ^ y) >> 1` 等于将有一个 1 一个 0 的数位除以二了。
    - 整数 int
        - 值范围：-2^32 < int < 2^32 - 1
            - 32 bits 系统下，为 4 bytes。
                - 0x 00 00 00 00 == int 0
                - 0x 11 11 11 11 == int -1
                - 因为正数范围被 0 占去了一个位置，所以正数范围比负数范围小 1 ！
                    负数的绝对值：`-x = ~x + 1`
                - `0 == ~(0 - 1)` == `~0 = 0 - 1`
                    - `x + ~x = -1` 等于 `x == ~(x - 1)` 等于 `~x = x - 1`
        - 求绝对值:
            - TODO：C++ Interview Bookmark - Page 9
        - 常用等式：
            - __取负数：`-x = ~x + 1` === `-x = ~(x - 1)`__
            - __去掉整型数值的最后一位 b'1'：`b & (b - 1)`__
            - __获得整型数值的最后一位 b'1'：`b & ~(b - 1)` === `n & (-n)`__
    - 求整型变量的二进制表示中，有多少个数位为 1：
        - 提示：还是要用循环；考虑 '1' 稀疏的情况如何快速求解！
    - __大小端 big / little endian（字节序）！__
        - 低地址在左，高地址在右 0x4000 ~ 0x4003
            - 地址：从低到高（从左到右）。
        - 高字节在左，低字节在右 0x12345678！
            - 字节：从高到低（从左到右）。
        - 大端：从左到右存放 left to right（操作系统常用）
            - 高字节从低地址开始放。
        - 小端：从右到左存放 right to left（网络传输常用）
            - 高字节从高地址开始放。
        - [__参考资料链接__](http://blog.csdn.net/ce123_zhouwei/article/details/6971544)
    - 不用除号完成除法（利用位操作和加减）
        See CLion
    - 不用加号号完成加法（利用位操作）
        See CLion
    - 不用乘号完成乘法（利用位操作和加减）
        See CLion
    - n 位的二进制数字串，有多少个子串不存在相邻的数位同时为 1
        See CLion
    - __不使用第三个变量，来实现两个变量的数值交换！__
        See CLion
- 浮点数（TODO）
    - 精确度
    - 等于的判断方法
- 字符串
    - 数字与字符串转换
        - 与浮点数的对换，并不困难。
        - 字符串转换为整数
            See CLion
        - 整数转换为字符串
            See CLion
    - 字符串复制 strcpy
        See CLion
    - __内存复制函数 memcpy__
        See CLion
    - 字符串长度 strlen
        See CLion
- 编译
    - 编译 complile、链接 link、载入 load
        - 编译：预处理生成 file，词法分析、语法分析、语义分析、优化后编译成（机器码）
        - 链接：将目标模块和库函数链接到一起… 暂略
        - 载入：将程序调入内存，并转换成可执行的程序服务。
- 面向对象
    - 封装 encapsulation
    - 继承 inheritance
    - 多态 polymorphism
- 不能被继承的类
    - 把构造函数 constructor 私有化（声明为 private）即可。
- 基类 base class 的析构函数 destructor 应定义为虚函数 virtual function
    - 避免多态实现时，造成内存泄露。如果子类析构时，不调用基类的析构函数，就会……
- 不用 `if`、`?:`、`switch` 等判断语句或操作符，如何找到两个 int 中的最大值和最小值？
    See CLion
- 判断一个 int 是否为 2 的若干次幂
    See CLion
- __已知随机函数 rand7()（区间为整数 1 ~ 10），如何构造 rand10()__
    TODO：不懂，看完概率论，回头再看

# Database

- SQL: Structured Query Language
    - 功能：query 查询、manipulate 操作、define 定义、control 控制
    - DML: Data Manipulation Language: insert, modify, delete
    - DDL: Data Definition Language: 对 user, table, view, index 进行定义和撤销
- 基本语句
    - 查询
        - __select__ * from table where …
    - 操作
        - __insert__ into table(key, …) values(val, …)
        - __update__ table set key=val where …
        - __delete__ from table where …
    - 定义
        - __create__ table tableName(key [type], …)
        - __drop__ table tableName
    - 控制
        - __grant__ …
        - __revoke__ …
- 内/外连接
    - inner join 内连接，也称自然连接：只有两个表都匹配的 row 才会在 resultSet 中出现（舍弃不匹配的数据）。
    - outer join 外连接：类型 left outer join, right outer join, full outer join
- __ACID__（TODO 具体解释！）
    - atomicity 原子性
    - consistency 一致性
    - isolation 隔离性
    - durability 持久性
- 死锁
    - 必要条件：
        - 互斥：每个资源只能被一个进程使用
        - 请求与保持等待：请求资源被阻塞时，对已获得的资源保持不放。
        - 不可剥夺：进程已获得的资源，在未使用完之前，不可强制剥夺。
        - 环路等待：拖干个进程间，首尾连接的等待 resource 关系。
    - 共享锁：读锁，用于只读操作。简称 S 锁。
    - 互斥锁：排它锁，用于修改数据。简称 X 锁。
- 范式
    （TODO 搞不懂！要结合实践。C++ Interview Book 笔记的第 23 页末）
    - 规范化。范式，识别 DB 的 data element、relation。
    - 1NF：每一列都是不可分割的基本数据项。
    - 2NF：要求表的每个 instance 或 row 必须可以被唯一地区分。
    - 3NF：首先满足 2NF，每个非主属性都不传递依赖于 R 的候选键。（？？？）
    - BCNF：首先满足 3NF，每个属性都不传递依赖于 R 的候选键。（？？？）
    - 4NF：… 不想理了。

# 计算机网络 Network

- OSI 七层模型
    - __应用层 Application__
        - __HTTP、FTP__、SNMP、NFS、WAIS
        - HTTP（TODO）
    - 表现层 Presentation
        - 压缩、解压，加密、解密
    - 会话层 Session
        - SMTP、DNS。RPC、NFC
    - \-\-\-
    - __传输层 Transport__
        - __TCP、UDP__（TODO）
            - 三次握手、四次断连
            - 它们之间的区别
        - 各种网络状态
        - 包结构
    - __网络层 Network__（TODO）
        - __IP__、ICMP、ARP、RARP、AKP、UUCP
            - 包结构
    - 数据链路 Data Link
        - FDDI、Arpanet、PDN、SLOP、Ethernet、PPP
        - Frame
        - CRC 校验、网络拓扑、流量控制、重发、MAC 地址。
    - 物理层 Physical
- 五层
    - 应用层（应用层+表现层）
        - 会话层未真正存在？
    - 传输层
    - 网络层
    - 数据链路层
    - 物理层
- MVC
    - Model、Controller、View
- 设备
    - 路由器 router
    - 交换机 switch
    - 集线器 hub
- 请求类型（TODO）
    - GET
    - POST
    - PUT
    - DELETE
- DNS（TODO）
- ping
    - packet Internaet Grope 因特网包探索器
- socket 套接字

# 操作系统 OS

- 进程与线程的区别
    - 程序：一组指令的有序集合
    - __进程__：
        - 在操作系统中，进行资源分配和 CPU 调度的独立单位（不一定）。
    - __线程__：
        - 本身不拥有系统资源，只拥有一点运行中必不可少的资源（程序计数器、寄存器和栈）。
    - 一个进程中可以有几个线程
        - 实现了线程的系统中，thread 才是调度的基本单位，是系统中并发执行的单元！
        - 线程的优点：开销小、易调度、提高并发性，能充分发挥多核、多处理器的性能。
        - 一个进程中的多个线程，可以共享资源，而且线程切换代价比进程代价小。
    - 线程同步机制：
        - 临界区 critical region
            - 串行访问公共资源
        - 互斥量 mutex
            - 也能支持不同 app 间的公共资源访问共享。
        - 信号量 semaphore
            - 多个线程同事访问一个资源
        - 事件 event
            - 事件发生之后，再通知相关任务启动。
- 内存管理
    - 块式、页式、段式、段页式
    - __页__ page（？）是物理单位，分页为了实现离散分配方式，减少内存浪费，提高利用率。（主要是系统需要，而非用户需要）
    - __段__ segment 是信息的逻辑单位。
    - 内碎片：分配给程序的内存没用完，或者分配了却没有好好利用（而其它程序又利用不了）。
    - 外碎片：空间太小，无法为新的程序分配足够内存。
- 缓存替换算法
    - 随机
    - FIFO 先进先出
    - LRU 最近最少使用 lesat recently used
    - LFU 最近最不频繁使用 least frequently used
    - OPT 最优替换（理想方式的代称，现实中不可能做到）

# 设计模式

- 常用
    - 工厂、单例、适配器、享元、观察者
- 类型
    - 创建型
        - 工厂、抽象工厂 Factory（按需生产？）
        - 生成器 Builder（帮助构造？）
        - 原型 Prototype（复制自身）
        - 单例 Singleton
    - 结构性
        - 适配器 Adapter
            - 统一接口标准，可无痛替换
        - 桥接 Bridge（TODO？）
        - 组合 Composite（组合）
        - 装饰器 Decorator（TODO，似懂非懂）
        - 外观 Facade（TODO，似懂非懂）
        - 享元 Flyweight（TODO？）
        - 代理 Proxy（TODO）
    - 行为型
        - 职责链 Chain of Responsibility（抛出错误，进行处理）
        - 命令 Command（TODO？）
        - 迭代器 Iterator（TODO）
        - 中介者 Mediator
        - 备忘录 Memento
        - 观察者 Observer
            - Publish / Subscription 发布订阅
        - 状态 State
        - 策略 Strategy
        - 访问者模式 Visitor

# 数据结构和算法

- 递归实现数组求和
    See CLion
- 一个 for 语句循环打印出一个二维数组
    See CLion
- 散点知识
    - 在一个顺序表中插入、删除一个节点，平均需要移动多少个节点？
        - 插入 n / 2 删除 (n - 1) / 2
    - 用一个递归算法，判断一个数组中的值，是否递增？
        see CLion


# 其它概念

- 云计算
    - IaaS：基础设施即服务 Infrastructure as a Service
    - PaaS：平台即服务 Platform as a Service
    - SaaS：软件即服务 Software as a Service
