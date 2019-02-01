# Cloud

## k8s

> Kubernetes

References

- 简单之美 | Kubernetes基础篇：主要特性、基本概念与总体架构 : http://shiyanjun.cn/archives/1671.html

## rsyslog

> RSYSLOG is the rocket-fast system for log processing.

References

- https://www.rsyslog.com/

## Distributed

> 服务发现，配置共享（强一致性，高可用性）

### Consul

References

- https://www.consul.io/ ( created by HarshiCorp )
- https://github.com/hashicorp/consul
- Consul 原理和使用简介 - Coding 博客 : https://blog.coding.net/blog/intro-consul

Features

- raft

### etcd

> Distributed reliable key-value store for the most critical data of a distributed system

References

- https://github.com/etcd-io/etcd

Features

- raft

### zookeeper

References

- https://en.wikipedia.org/wiki/Apache_ZooKeeper

Features

- Paxos

## MQ

> Message Queue ( message broker )

### kafka

References

- https://blog.csdn.net/suifeng3051/article/details/48053965

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

### MCQ : MemcacheQ

- Simple Queue Service over Memcache
    - http://memcachedb.org/memcacheq/ ( invalid link on 2019-01-13 )
- MemcacheDB : http://memcachedb.org/
- Memcached : http://memcached.org/

## Serialize

Serialization + Compression

- json + gzip

### Protocol Buffer

- 来自 Google 的序列化 ( serialize ) 协议 : https://developers.google.com/protocol-buffers/

### Protostuff

References

- GitHub - protostuff/protostuff: Java serialization library, proto compiler, code generator : https://github.com/protostuff/protostuff
- Google Code Archive - Long-term storage for Google Code Project Hosting. : https://code.google.com/archive/p/protostuff/

## Others

### Envoy

References

- https://www.envoyproxy.io/

> An open source edge and service proxy, designed for cloud-native applications

- Envoy is a high performance C++ distributed proxy designed for single services and applications, as well as a communication bus and “universal data plane” designed for large microservice “service mesh” architectures.
- Built on the learnings of solutions such as NGINX, HAProxy, hardware load balancers, and cloud load balancers, Envoy runs alongside every application and abstracts the network by providing common features in a platform-agnostic manner.
- When all service traffic in an infrastructure flows via an Envoy mesh, it becomes easy to visualize problem areas via consistent observability, tune overall performance, and add substrate features in a single place.

### Vitess

> Vitess is a database clustering system for horizontal scaling of MySQL

References

- https://vitess.io/
- https://github.com/vitessio/vitess

Features

- horizontal scaling
- connection pooling
- shard mgt.

### Red Hat OpenShift

> OpenShift combines application lifecycle management - including image builds, continuous integration, deployments, and updates - with Kubernetes.

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