# Concepts

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

- **Concurrency** is when two or more tasks can start, run, and complete in overlapping time periods. It doesn't necessarily mean they'll ever both be running at the same instant. For example, multitasking on a single-core machine.
- **Parallelism** is when tasks literally run at the same time, e.g., on a multicore processor.
- Reference : StackOverflow : https://stackoverflow.com/questions/1050222/what-is-the-difference-between-concurrency-and-parallelism

## Database

### DAO

- In computer software, a data access object (DAO) is an object that provides an abstract interface to some type of database or other persistence mechanism.
- Wikipedia : https://en.wikipedia.org/wiki/Data_access_object

### ORM

Object-Relational Mapping ( Here is not _Object-Role Modeling_. )

- Object-relational mapping (ORM, O/RM, and O/R mapping tool) in computer science is a programming technique for converting data between incompatible type systems using object-oriented programming languages.
- Wikipedia : https://en.wikipedia.org/wiki/Object-relational_mapping

## Lint

From **Core Java Volume I-Fundermentals**

> - 术语 lint 最初用来描述一种定位 C 程序中潜在问题的工具
> - 现在通常用于描述查找可疑但不违背语法规则的代码问题的工具

## Processor affinity

- Processor affinity, or CPU pinning, enables the binding and unbinding of a process or a thread to a central processing unit (CPU) or a range of CPUs, so that the process or thread will execute only on the designated CPU or CPUs rather than any CPU.
- Wikipedia : https://en.wikipedia.org/wiki/Processor_affinity

## Write amplification

写入放大

- An undesirable phenomenon associated with flash memory and solid-state drives (SSDs) where the actual amount of information physically written to the storage media is a multiple of the logical amount intended to be written.
- Wikipedia : https://en.wikipedia.org/wiki/Write_amplification
- 中文维基 :

## _TODO_

process & thread

- process
- thread
