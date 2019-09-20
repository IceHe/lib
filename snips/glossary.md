# Glossary (draft)

## 向后兼容 & 向后兼容

同义词

- forword / 向前 / upword / 向上
- backword / 向后 / downword / 向下

Forward & Backward compatible

- forward 理解为「前进/未来」（不是~~以前~~），向未来拓展！
- backward 理解为「后退/过去」，向过去兼容！

我的想法

- forward : 旧版本软件，可以替代新版本软件运作
- backward : 新版本软件，可以替代旧版本软件运作

例如

- 向前兼容：旧版的 Microsoft Office Word 可以打开新版的 doc 文档.
- 向后兼容：新版的 Microsoft Office Word 可以打开旧版的 doc 文档.

轮子哥的解释

- forward 向前兼容：Windows 3.1 要能运行为 Windows 10 开发的程序
- backward 向后兼容：Windows 10 要能运行为 Windows 3.1 开发的程序

References

- 软件的「向前兼容」和「向后兼容」如何区分？- 知乎 : https://www.zhihu.com/question/47239021

## MySQL

- binlog: Binary Log（感觉好像 Redis AOF 就是参考它来实现的，过往的最佳实践）
    - https://dev.mysql.com/doc/refman/8.0/en/binary-log.html
- 整型数据
    https://dev.mysql.com/doc/refman/5.5/en/integer-types.html
- Java Composity Key 联合主键
    - Differ JpaRepository & CrudRepository
        - https://stackoverflow.com/questions/14014086/what-is-difference-between-crudrepository-and-jparepository-interfaces-in-spring
- SQL Time Type? `timestamp` vs `datetime`
    - https://www.codeproject.com/Tips/1215635/MySQL-DATETIME-vs-TIMESTAMP
    - https://stackoverflow.com/questions/409286/should-i-use-the-datetime-or-timestamp-data-type-in-mysql

---

## ACID

- In computer science, ACID (Atomicity, Consistency, Isolation, Durability) is a set of properties of database transactions intended to guarantee validity even in the event of errors, power failures, etc.
- In the context of databases, a sequence of database operations that satisfies the ACID properties (and these can be perceived as a single logical operation on the data) is called a transaction.
- Wikipedia : https://en.wikipedia.org/wiki/ACID_(computer_science)

## BASE

- Eventually-consistent services are often classified as providing BASE (Basically Available, Soft state, Eventual consistency) semantics, in contrast to traditional ACID (Atomicity, Consistency, Isolation, Durability) guarantees.
- References
    - Eventual Consistency : https://en.wikipedia.org/wiki/Eventual_consistency
    - Wikipedia : https://en.wikipedia.org/wiki/Base#Computing

## CAP

CAP theorem

- In theoretical computer science, the CAP theorem states that it is impossible for a distributed data store to simultaneously provide more than two out of the following three guarantees:
    - **Consistency**: Every read receives the most recent write or an error
    - **Availability**: Every request receives a (non-error) response – with the guarantee that it contains the most recent write
    - **Partition tolerance**: The system continues to operate despite an arbitrary number of messages being dropped (or delayed) by the network between nodes
- In particular, the CAP theorem **implies that in the presence of a network partition, one has to choose between consistency and availability**.
- Note that consistency as defined in the CAP theorem is quite different from the consistency guaranteed in ACID database transactions.
- Wikipedia : https://en.wikipedia.org/wiki/CAP_theorem
- 知乎 : https://www.zhihu.com/question/54105974/answer/139037688
- CAP迷思：关于分区容忍性 : http://zzyongx.github.io/blogs/cap-confusion-problems-with-partition-tolerance.html
- ~~百度百科~~ : https://baike.baidu.com/item/CAP%E5%8E%9F%E5%88%99/5712863?fr=aladdin ( 关于 A 和 P 说得好像有点问题 )

## Concurrency & Parallelism

> 并发 & 并行（的区别）

- 并发 **Concurrency** is when two or more tasks can start, run, and complete in overlapping time periods. It doesn't necessarily mean they'll ever both be running at the same instant. For example, multitasking on a single-core machine.
- 并行 **Parallelism** is when tasks literally run at the same time, e.g., on a multicore processor.
- Reference : StackOverflow : https://stackoverflow.com/questions/1050222/what-is-the-difference-between-concurrency-and-parallelism

## Reverse proxy

- 反向代理方式，是指以代理服务器来接受internet上的连接请求，然后将请求转发给内部网络上的服务器，并将从服务器上得到的结果返回给internet上请求连接的客户端，此时代理服务器对外就表现为一个反向代理服务器。
- In computer networks, a reverse proxy is a type of proxy server that retrieves resources on behalf of a client from one or more servers. These resources are then returned to the client as if they originated from the Web server itself.

## Database

### DAO

- In computer software, a data access object (DAO) is an object that provides an abstract interface to some type of database or other persistence mechanism.
- Wikipedia : https://en.wikipedia.org/wiki/Data_access_object

### ORM

Object-Relational Mapping ( Here is not _Object-Role Modeling_. )

- Object-relational mapping (ORM, O/RM, and O/R mapping tool) in computer science is a programming technique for converting data between incompatible type systems using object-oriented programming languages.
- Wikipedia : https://en.wikipedia.org/wiki/Object-relational_mapping

## Lint

From **Core Java Volume I - Fundermentals**

> - 术语 lint 最初用来描述一种定位 C 程序中潜在问题的工具
> - 现在通常用于描述查找可疑但不违背语法规则的代码问题的工具

## Processor affinity

- Processor affinity, or CPU pinning, enables the binding and unbinding of a process or a thread to a central processing unit (CPU) or a range of CPUs, so that the process or thread will execute only on the designated CPU or CPUs rather than any CPU.
- Wikipedia : https://en.wikipedia.org/wiki/Processor_affinity

## Write amplification

写入放大

- An undesirable phenomenon associated with flash memory and solid-state drives (SSDs) where the actual amount of information physically written to the storage media is a multiple of the logical amount intended to be written.
- Wikipedia : https://en.wikipedia.org/wiki/Write_amplification
- 中文维基 : https://zh.wikipedia.org/wiki/%E5%86%99%E5%85%A5%E6%94%BE%E5%A4%A7
