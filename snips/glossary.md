# Glossary (draft)

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

## MCQ : MemcacheQ

- Simple Queue Service over Memcache
    - http://memcachedb.org/memcacheq/ ( invalid link on 2019-01-13 )
- MemcacheDB : http://memcachedb.org/
- Memcached : http://memcached.org/

## Protocol Buffer

- 来自 Google 的序列化 ( serialize ) 协议 : https://developers.google.com/protocol-buffers/

## kafka

> 使用 __消息系统__ 的好处：
> 1. 解耦：
>   允许你独立的扩展或修改两边的处理过程，只要确保它们遵守同样的接口约束。
> 2. 冗余：
>   消息队列把数据进行持久化直到它们已经被完全处理，通过这一方式规避了数据丢失风险。许多消息队列所采用的"插入-获取-删除"范式中，在把一个消息从队列中删除之前，需要你的处理系统明确的指出该消息已经被处理完毕，从而确保你的数据被安全的保存直到你使用完毕。
> 3. 扩展性：
>   因为消息队列解耦了你的处理过程，所以增大消息入队和处理的频率是很容易的，只要另外增加处理过程即可。
> 4. 灵活性 & 峰值处理能力：
>   在访问量剧增的情况下，应用仍然需要继续发挥作用，但是这样的突发流量并不常见。如果为以能处理这类峰值访问为标准来投入资源随时待命无疑是巨大的浪费。使用消息队列能够使关键组件顶住突发的访问压力，而不会因为突发的超负荷的请求而完全崩溃。
> 5. 可恢复性：
>   系统的一部分组件失效时，不会影响到整个系统。消息队列降低了进程间的耦合度，所以即使一个处理消息的进程挂掉，加入队列中的消息仍然可以在系统恢复后被处理。
> 6. 顺序保证：
>   在大多使用场景下，数据处理的顺序都很重要。大部分消息队列本来就是排序的，并且能保证数据会按照特定的顺序来处理。（Kafka 保证一个 Partition 内的消息的有序性）
> 7. 缓冲：
>   有助于控制和优化数据流经过系统的速度，解决生产消息和消费消息的处理速度不一致的情况。
> 8. 异步通信：
>   很多时候，用户不想也不需要立即处理消息。消息队列提供了异步处理机制，允许用户把一个消息放入队列，但并不立即处理它。想向队列中放入多少消息就放多少，然后在需要的时候再去处理它们。
>
> kafka 相关术语：
> 1. producer：
>   消息生产者，发布消息到 kafka 集群的终端或服务。
> 2. broker：
>   kafka 集群中包含的服务器。
> 3. topic：
>   每条发布到 kafka 集群的消息属于的类别，即 kafka 是面向 topic 的。
> 4. partition：
>   partition 是物理上的概念，每个 topic 包含一个或多个 partition。kafka 分配的单位是 partition。
> 5. consumer：
>   从 kafka 集群中消费消息的终端或服务。
> 6. Consumer group：
>   high-level consumer API 中，每个 consumer 都属于一个 consumer group，每条消息只能被 consumer group 中的一个 Consumer 消费，但可以被多个 consumer group 消费。
> 7. replica：
>   partition 的副本，保障 partition 的高可用。
> 8. leader：
>   replica 中的一个角色， producer 和 consumer 只跟 leader 交互。
> 9. follower：
>   replica 中的一个角色，从 leader 中复制数据。
> 10. controller：
>   kafka 集群中的其中一个服务器，用来进行 leader election 以及 各种 failover。
> 11. zookeeper：
>   kafka 通过 zookeeper 来存储集群的 meta 信息。

- 很棒的笔记总结！https://www.cnblogs.com/cyfonly/p/5954614.html
- 官方文档 : https://kafka.apache.org/documentation/#introduction
- Benchmark :  https://engineering.linkedin.com/kafka/benchmarking-apache-kafka-2-million-writes-second-three-cheap-machines

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

- **Concurrency** is when two or more tasks can start, run, and complete in overlapping time periods. It doesn't necessarily mean they'll ever both be running at the same instant. For example, multitasking on a single-core machine.
- **Parallelism** is when tasks literally run at the same time, e.g., on a multicore processor.
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
- 中文维基 : https://zh.wikipedia.org/wiki/%E5%86%99%E5%85%A5%E6%94%BE%E5%A4%A7
