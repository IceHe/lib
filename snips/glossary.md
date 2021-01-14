# Glossary

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
- _( 详见《数据密集型应用系统设计》 )_

## BASE

- Eventually-consistent services are often classified as providing BASE (Basically Available, Soft state, Eventual consistency) semantics, in contrast to traditional ACID (Atomicity, Consistency, Isolation, Durability) guarantees.
- References
    - Eventual Consistency : https://en.wikipedia.org/wiki/Eventual_consistency
    - Wikipedia : https://en.wikipedia.org/wiki/Base#Computing
- _( 详见《数据密集型应用系统设计》 )_

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
- _( 详见《数据密集型应用系统设计》 )_

## Concurrency & Parallelism

**并发 & 并行（的区别）**

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

# Common Tech Products

## SRE

**Site Reliable Engineering**

### rsyslog

**RSYSLOG is the rocket-fast system for log processing.**

References

- https://www.rsyslog.com/

### Filebeat

**Lightweight Shipper for Logs**

- Forget using SSH when you have tens, hundreds, or even thousands of servers, virtual machines, and containers generating logs.
- Filebeat helps you keep the simple things simple by offering a lightweight way to forward and centralize logs and files.

References

- Filebeat: Lightweight Log Analysis & Elasticsearch : https://www.elastic.co/products/beats/filebeat

### k8s

**Kubernetes**

References

- 简单之美 | Kubernetes基础篇：主要特性、基本概念与总体架构 : http://shiyanjun.cn/archives/1671.html

### Mesos

**Program against your datacenter like it’s a single pool of resources**

- Apache Mesos abstracts CPU, memory, storage, and other compute resources away from machines (physical or virtual), enabling fault-tolerant and elastic distributed systems to easily be built and run effectively.

References

- Apache Mesos : http://mesos.apache.org/
- Mesos入门 · Mesos中文手册 : https://mesos-cn.gitbooks.io/mesos-cn/content/primer/Mesos-of-Getting-Started.html

### Marathon

**A container orchestration platform for Mesos and DC/OS**

References

- Marathon: https://mesosphere.github.io/marathon/

Marathon is a production-grade container orchestration platform for Mesosphere’s Datacenter Operating System (DC/OS) and Apache **Mesos**.

Features

- High Availability.
    - Marathon runs as an active/passive cluster with leader election for 100% uptime.
- Multiple container runtimes.
    - Marathon has first-class support for both Mesos containers (using cgroups) and Docker.
- Stateful apps.
    - Marathon can bind persistent storage volumes to your application.
    - You can run databases like MySQL and Postgres, and have storage accounted for by Mesos.
- _Beautiful and powerful UI._
    Constraints. These allow to e.g. place only one instance of an application per rack, node, etc.
- Service Discovery & Load Balancing.
    - Several methods available.
- Health Checks.
    - Evaluate your application’s health using HTTP or TCP checks.
- Event Subscription.
    - Supply an HTTP endpoint to receive notifications - for example to integrate with an external load balancer.
- Metrics.
    - Query them at /metrics in JSON format or push them to systems like graphite, statsd and Datadog.
- Complete REST API for easy integration and scriptability.

### Elasticsearch

Elasticsearch is a distributed, RESTful search and analytics engine capable of solving a growing number of use cases.

- As the heart of the Elastic Stack, it centrally stores your data so you can discover the expected and uncover the unexpected.

References

- Elasticsearch: RESTful, Distributed Search & Analytics : https://www.elastic.co/products/elasticsearch

### Kibana

**通过 Kibana，您能够对 Elasticsearch 中的数据进行可视化并在 Elastic Stack 进行操作**

References

- https://www.elastic.co/products/kibana
- https://www.elastic.co/cn/products/kibana

### Graphite

**Make it easy to store and graph metrics**

References

- https://graphiteapp.org/

Graphite is an enterprise-ready monitoring tool that runs equally well on cheap hardware or Cloud infrastructure. Teams use Graphite to track the performance of their websites, applications, business services, and networked servers. It marked the start of a new generation of monitoring tools, making it easier than ever to store, retrieve, share, and visualize time-series data.

### Zabbix

**Monitor anything :

- Solutions for any kind of IT infrastructure, services, applications, resources

References

- https://www.zabbix.com/

### Puppet

**Make software discovery, management, and delivery automatic and pervasive with Puppet.**

References

- Deliver better software, faster | Puppet : https://puppet.com/
- 系统运维|Puppet 简介 : https://linux.cn/article-5058-1.html

## Distributed

**服务发现，配置共享（强一致性，高可用性）**

### Consul

References

- https://www.consul.io/ ( created by HarshiCorp )
- https://github.com/hashicorp/consul
- Consul 原理和使用简介 - Coding 博客 : https://blog.coding.net/blog/intro-consul

Features

- raft

### etcd

**Distributed reliable key-value store for the most critical data of a distributed system**

References

- https://github.com/etcd-io/etcd

Features

- raft

### zookeeper

References

- https://en.wikipedia.org/wiki/Apache_ZooKeeper

Features

- Paxos

## Data Process

### Flink

**Stateful Computations over Data Streams**

References

- https://flink.apache.org/

### Fluentd

**Fluentd is an open source data collector for unified logging layer.**

References

- Fluentd | Open Source Data Collector | Unified Logging Layer : https://www.fluentd.org/

### Logstash

**Centralize, Transform & Stash Your Data**

References

- Logstash: Collect, Parse, Transform Logs | Elastic : https://www.elastic.co/products/logstash

### MaxCompute

**原 ODPS - Open Data Process Service**

References

- [MaxCompute](/snips/cloud/max-compute.md)

#### Hive

References

- [Hive](/snips/cloud/max-compute.md#Hive) ( mine ) : data process

## MQ

**Message Queue ( message broker )**

### kafka

References

- https://blog.csdn.net/suifeng3051/article/details/48053965

> 使用 __消息系统__ 的好处：
>
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
>
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

### MCQ : MemcacheQ

- Simple Queue Service over Memcache
    - http://memcachedb.org/memcacheq/ ( invalid link on 2019-01-13 )
- MemcacheDB : http://memcachedb.org/
- Memcached : http://memcached.org/

### Spark

**A unified analytics engine for large-scale data processing.**

References

- https://spark.apache.org/

### Hadoop

**The Apache Hadoop project develops open-source software for reliable, scalable, distributed computing.**

- The Apache Hadoop software library is a framework that allows for the distributed processing of large data sets across clusters of computers using simple programming models.
- It is designed to scale up from single servers to thousands of machines, each offering local computation and storage.
- Rather than rely on hardware to deliver high-availability, the library itself is designed to detect and handle failures at the application layer, so delivering a highly-available service on top of a cluster of computers, each of which may be prone to failures.

References

- Apache Hadoop : https://hadoop.apache.org/

Modules

- Hadoop Common
    - The common utilities that support the other Hadoop modules.
- **Hadoop Distributed File System** (HDFS)
    - A distributed file system that provides high-throughput access to application data.
- Hadoop YARN
    - A framework for job scheduling and cluster resource management.
- Hadoop MapReduce
    - A YARN-based system for parallel processing of large data sets.
- Hadoop Ozone
    - An object store for Hadoop.

## Serialize

Serialization + Compression

- json + gzip

Comparison

- Protocol Buffers, Avro, Thrift & MessagePack - igvita.com : https://www.igvita.com/2011/08/01/protocol-buffers-avro-thrift-messagepack/

### Msgpack

**It's like JSON, but fast and small.**

- MessagePack is an efficient binary serialization format.
- It lets you exchange data among multiple languages like JSON. But it's faster and smaller.
- Small integers are encoded into a single byte, and typical short strings require only one extra byte in addition to the strings themselves.

References

- https://msgpack.org/index.html

### Protocol Buffer

- 来自 Google 的序列化 ( serialize ) 协议 : https://developers.google.com/protocol-buffers/

### Protostuff

References

- GitHub - protostuff/protostuff: Java serialization library, proto compiler, code generator : https://github.com/protostuff/protostuff
- Google Code Archive - Long-term storage for Google Code Project Hosting. : https://code.google.com/archive/p/protostuff/

### Pipe?

#### ZMQ

**Distributed Messaging**

References

- http://zeromq.org/

## Others

### Envoy

References

- https://www.envoyproxy.io/

> An open source edge and service proxy, designed for cloud-native applications

- Envoy is a high performance C++ distributed proxy designed for single services and applications, as well as a communication bus and “universal data plane” designed for large microservice “service mesh” architectures.
- Built on the learnings of solutions such as NGINX, HAProxy, hardware load balancers, and cloud load balancers, Envoy runs alongside every application and abstracts the network by providing common features in a platform-agnostic manner.
- When all service traffic in an infrastructure flows via an Envoy mesh, it becomes easy to visualize problem areas via consistent observability, tune overall performance, and add substrate features in a single place.

### Vitess

**Vitess is a database clustering system for horizontal scaling of MySQL**

References

- https://vitess.io/
- https://github.com/vitessio/vitess

Features

- horizontal scaling
- connection pooling
- shard mgt.

### Red Hat OpenShift

**OpenShift combines application lifecycle management - including image builds, continuous integration, deployments, and updates - with Kubernetes.**

### serverless

References

- https://serverless.com/

个人理解：快速部署网络服务的解决方案？

### Nomad

References

- https://www.nomadproject.io/ ( created by HarshiCorp )

Easily Deploy Applications at Any Scale（个人理解同上）

### Vault

References

- https://www.vaultproject.io/ ( created by HarshiCorp )

### CoreOS

References

- InfoQ - 促进软件开发领域知识与创新的传播 : https://www.infoq.cn/article/what-is-coreos

### Pouch

References

- 阿里巴巴正式开源自研容器技术Pouch : https://yq.aliyun.com/articles/283774?spm=5176.10695662.1996646101.searchclickresult.2f2f2b56Iti0pz

它跟 Docker 的区别 ?

- 众所周知，行业中的容器方案大多基于Linux内核提供的cgroup和namespace来实现隔离，然后这样的轻量级方案存在弊端：
    - 容器间，容器与宿主间，共享同一个内核；
    - 内核实现的隔离资源，维度不足。
- 面对如此的内核现状，阿里巴巴采取了三个方面的工作，来解决容器的安全问题：
    - 用户态增强容器的隔离维度，比如网络带宽、磁盘使用量等；
    - 给内核提交patch，修复容器的资源可见性问题，cgroup方面的bug；
    - 实现基于Hypervisor的容器，通过创建新内核来实现容器隔离。
- P2P 镜像分发
- 富容器
    - _有必要么? 大概是迫于业务部署环境的现状做的_
- 内核兼容性
    - 让不支持容器基础技术的老内核, 也能跑在容器上
