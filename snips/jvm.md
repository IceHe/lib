# Java Virtual Machine

References

- Book《深入理解 Java 虚拟机：JVM 高级特性与最佳实践》
    - 垃圾回收算法手册: 自动内存管理的艺术
    - Java 性能优化权威指南 / Effective Java

## Introduction

### Keywords?

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

## Index

