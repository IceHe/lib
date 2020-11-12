# RocketMQ

> A unified messaging engine，lightweight data processing platform.

References

- Home Page : https://rocketmq.apache.org
    - Why RocketMQ : https://rocketmq.apache.org/docs/motivation
        - How to Support More Queues in RocketMQ? : https://rocketmq.apache.org/rocketmq/how-to-support-more-queues-in-rocketmq
    - Quick Start : https://rocketmq.apache.org/docs/quick-start
    - ……
- Documentation - CN : https://github.com/apache/rocketmq/tree/master/docs/cn
- TODOs RocketMQ总结
    - https://www.jianshu.com/p/fabb2d14ffa1
    - https://www.cnblogs.com/Jtianlin/p/8427033.html
    - https://juejin.im/post/6844904201416359949
    - https://blog.csdn.net/u012385190/article/details/108120931
    - https://liuyanzhao.com/1307946145498140672.html
    - http://woshinlper.com/system-design/data-communication/RocketMQ/

## Intro

References

- Home Page : https://rocketmq.apache.org
    - Why RocketMQ : https://rocketmq.apache.org/docs/motivation

### Features

- **Low Latency**
    - **More than 99.6% response latency within 1 millisecond under high pressure.**
- **Finance Oriented**
    - High availability with **tracking and auditing** features.
- Industry Sustainable _( 产业可持续发展的 ( 工业级的? ) )_
    - **Trillion-level message capacity guaranteed.**
- Vendor Neutral _( 厂商中立性 )_
    - A new open distributed messaging and streaming standard since latest 4.1 version.
- BigData Friendly
    - Batch transferring with versatile integration for flooding throughput.
- **Massive Accumulation**
    - Given sufficient disk space, **accumulate messages without performance loss**.

### Motivation

- At early stages, we constructed our distributed messaging middleware based on ActiveMQ 5.x(prior to 5.3).
    - Our multinational _( 跨国的 )_ business uses it for asynchronous communication, search, social network activity stream, data pipeline, even in its trade processes.
    - As our trade business throughput rises, pressure originating from our messaging cluster also becomes urgent.

#### Why RocketMQ ?

- Based on our research, with increased queues and virtual topics in use, **ActiveMQ IO module reaches a bottleneck**.
    - We tried our best to solve this problem through throttling, circuit breaker or degradation, but it did not work well.
    - So we begin to focus on the popular messaging solution Kafka at that time.
    - Unfortunately, **Kafka can not meet our requirements especially in terms of low latency and high reliability**, see [here](https://rocketmq.apache.org/rocketmq/how-to-support-more-queues-in-rocketmq/) for details _( How to Support More Queues in RocketMQ? )_ .
- In this context, we decided to invent a new messaging engine to handle a broader set of use cases, ranging from traditional pub/sub scenarios to high volume real-time zero-loss tolerance transaction system.
    - We believe this solution can be beneficial, so we would like to open source it to the community.
    - Today, more than 100 companies are using the open source version of RocketMQ in their business.
- The following table demonstrates the comparison between RocketMQ, ActiveMQ and Kafka (Apache’s most popular messaging solutions according to awesome-java):

#### RocketMQ vs. ActiveMQ vs. Kafka

<!--

- _Please note this documentation is written by the RocketMQ team._
    - _Although the ideal is a disinterested comparison of technology and features, the authors’ expertise and biases obviously favor RocketMQ._
- _The table below is a handy quick reference for spotting the differences among RocketMQ and its most popular alternatives at a glance._

-->

|Messaging Product|ActiveMQ|Kafka|RocketMQ|
|-|-|-|-|
|Client SDK|Java, .NET, C++ etc.|Java, Scala etc.|Java, C++, Go|
|**Protocol and Specification**|**Push model**, <br/>support OpenWire, STOMP, AMQP, MQTT, JMS|**Pull model**, <br/>support TCP|**Pull model**, <br/>support TCP, JMS, OpenMessaging|
|**Ordered Message**|**Exclusive Consumer or Exclusive Queues** <br/>can ensure ordering|Ensure ordering of messages <br/>**within a partition**|**Ensure strict ordering** of messages, <br/>and can scale out gracefully|
|Scheduled Message|Supported|Not Supported|Supported|
|**Batched Message**|Not Supported|Supported, <br/>with **async producer**|Supported, <br/>with **sync mode to avoid message loss**|
|**BroadCast Message**|Supported|Not Supported|Supported|
|Message Filter|Supported|Supported, <br/>you can use Kafka Streams to filter messages|Supported, <br/>property filter expressions based on SQL92|
|**Server Triggered Redelivery**|Not Supported|Not Supported|Supported|
|**Message Storage**|Supports very fast persistence using JDBC along with a high performance journal，<br/>such as levelDB, kahaDB|High performance file storage|High performance and low latency file storage|
|**Message Retroactive**<br/>_(有追溯效力的)_|Supported|Supported **offset indicate**|Supported **timestamp and offset two indicates**|
|Message Priority|Supported|Not Supported|Not Supported|
|**High Availability and Failover**|Supported, <br/>depending on storage, **if using kahadb it requires a ZooKeeper server**|Supported, <br/>**requires a ZooKeeper server**|Supported, <br/>**Master-Slave model, without another kit**|
|Message Track|Not Supported|Not Supported|Supported|
|**Configuration**|The default configuration is low level, <br/>user **need to optimize the configuration parameters**|Kafka uses **key-value pairs format for configuration**. <br/>These values can be supplied either from a file or programmatically.|Work out of box, user **only need to pay attention to a few configurations**|
|Management and Operation Tools|Supported|Supported, <br/>use terminal command to expose core metrics|Supported, <br/>rich web and terminal command to expose core metrics|

### How to Support More Queues in RocketMQ?

References

- Home Page : https://rocketmq.apache.org
    - Why RocketMQ : https://rocketmq.apache.org/docs/motivation
    - How to Support More Queues in RocketMQ? : https://rocketmq.apache.org/rocketmq/how-to-support-more-queues-in-rocketmq

#### Summary

- **Kafka** is a distributed streaming platform, which was **born from logging aggregation cases.**
    - It does not need too high concurrency.
    - In some **large scale cases in alibaba**, we found that the **original model has been unable to meet our actual needs**.
    - So, we developed a messaging middleware, named RocketMQ, which can handle a broad set of use cases,
        - ranging from **traditional publish/subscribe scenario** to <u>**demandingly high volume realtime transaction system that tolerates no message loss**</u>.
    - Now, in alibaba, RocketMQ clusters process more than 500 billion events every day, provide services for more than 3000 core applications.

#### Partition design in kafka

- 1\. Producer parallelism of writing is bounded by the number of partitions.
- 2\. The degree of consumer consumption parallelism, is also bounded by the number of partitions being consumed.
    - **Assuming that the number of partitions is 20, the maximum number of concurrent consuming consumers is 20.**
- 3\. Each topic consists of a fixed number of partitions.
    - **Partition number determines the maximum number of topics that single broker may have <u>without significantly affecting performance</u>.**

More details please refer to [here](http://www.confluent.io/blog/how-to-choose-the-number-of-topicspartitions-in-a-kafka-cluster) _( How to choose the number of topics/partitions in a Kafka cluster? )_ .

##### Why Kafka can't support more partitions

- 1\. Each partition stores the whole message data.
    - **Although each partition is orderly written to the disk, as number of concurrently writing partitions increases, writing become random in the perspective of operating system.**
- 2\. Due to the scattered data files, it is difficult to use the Linux IO Group Commit mechanism.

#### How to support more partition in RocketMQ?

![rocketmq-consume-queue.png](_images/rocketmq-consume-queue.png)

- 1\. **All message data are stored in commit log files.**
    - All writes are completely sequential whilst _( 同时 )_ reads are random.
- 2\. ConsumeQueue stores the actual user consumption location information, which are also flushed to disk in sequential manner.

> pros ：_( producers )_

- 1\. Each consume queue is lightweight and contains limited amount of meta data.
- 2\. **Access to disk is totally sequential**, which avoids disk lock contention, and will not incur high disk IO wait when a large number of queues has been created.
    - _( icehe : 思路都差不多, 尽可能顺序写 )_

> cons ：_( consumers )_

- 1\. Message consumption will **first read consume queue, then commit log**.
    - This process brings in certain cost in worst cases.
- 2\. Commit log and consume queues need to be logically consistent, which introduces extra complexities to programming model.

> Design Motivation :

- 1\. **Random read**.
    - **Read as much as possible to increase the page cache hit rate, and reduce read IO operations.**
    - So large memory is still preferable.
    - If massive messages are accumulated, would the read performance degrade badly? The answer is negative, reasons are as follows:
        - Even if size of the message is only 1KB, the system will read more data in advance, see PAGECACHE prefetch for reference.
            - This means for the sequel data read, it is access to main memory that will be carried out instead of slow disk IO read.
        - Random access CommitLog from disk.
            - If set the I/O scheduler to NOOP in case of SSD, the read qps will be greatly accelerated thus much faster than other elevator scheduler algorithm.
- 2\. Given ConsumeQueue stores fixed-size metadata only, which is mainly used to record consuming progress, random read is well supported.
    - Taking advantage of page cache prefetch, accessing ConsumeQueue is as efficiently fast as accessing main memory, even if it's in the case of massive message accumulation.
    - As a result，ConsumeQueue will NOT bring in _( 引入 )_ noticeable penalty to the read performance.
    - _( icehe : 硬盘内容在内存的读缓存, 以及预读, 真的这么有效吗? 存疑 )_
- 3\. CommitLog stores virtually all information, including the message data.
    - Similar to redo log of relational database, consume queues, message key indexes and all other required data can be completely recovered as long as commit log exists..

## Architecture

Reference

- RocketMQ Architecture https://rocketmq.apache.org/docs/rmq-arc/

### Overview

- Apache RocketMQ is a distributed messaging and streaming platform with low latency, high performance and reliability, trillion-level capacity and flexible scalability.
    - It consists of four parts: **name servers, brokers, producers and consumers**.
    - Each of them **can be horizontally extended without a single Point of Failure**.
    - _As shown in screenshot below._

![rocket-mq-architecture.png](_images/rocket-mq-architecture.png)

#### NameServerCluster

- Name Servers provide **lightweight service discovery and routing**.
    - Each Name Server records full routing information, provides corresponding reading and writing service, and supports fast storage expansion.

#### Broker Cluster

- Brokers take care of **message storage by providing lightweight TOPIC and QUEUE mechanisms**.
    - They support the <u>**Push and Pull model**</u>, contains **fault tolerance mechanism (2 copies or 3 copies)**, and provides **strong padding of peaks** and capacity of **accumulating hundreds of billion messages in their original time order**.
    - In addition, Brokers provide **disaster recovery**, **rich metrics statistics**, and **alert mechanisms**, all of which are lacking in traditional messaging systems.

#### Producer Cluster

- Producers support **distributed deployment**.
    - Distributed Producers send messages to the Broker cluster through **multiple load balancing modes**.
    - The sending processes support **fast failure** and have low latency.

#### Consumer Cluster

- Consumers support **distributed deployment in the Push and Pull model** as well.
    - It also supports **cluster consumption** and **message broadcasting**.
    - It provides **real-time message subscription mechanism** and can meet most consumer requirements.
    - _RocketMQ's website provides a simple quick-start guide to interested users._

### NameServer

- NameServer is a fully functional server, which mainly includes two features:
    - **Broker Management**, NameServer accepts the register from Broker cluster and provides heartbeat mechanism to check whether a broker is alive.
    - **Routing Management**, each NameServer will hold whole routing info about the broker cluster and the queue info for clients query.
- As we know, RocketMQ clients(Producer/Consumer) will query the queue routing info from NameServer, but how do clients find NameServer address?
- There are four methods to feed NameServer address list to clients:
    - Programmatic Way, like `producer.setNamesrvAddr("ip:port")`.
    - Java Options, use `rocketmq.namesrv.addr`.
    - Environment Variable, use `NAMESRV_ADDR`.
    - HTTP Endpoint.
- More details about how to find NameServer address please refer to [here](https://rocketmq.apache.org/rocketmq/four-methods-to-feed-name-server-address-list/) _( Four Methods to Feed Name Server Address List )_ .

### Broker Server

- Broker server is responsible for **message store and delivery**, **message query**, **HA guarantee**, and so on.
- _As shown in image below,_ Broker server has several important sub modules:
    - **Remoting Module**, the entry of broker, handles the requests from clients.
    - **Client Manager**, manages the clients (Producer/Consumer) and maintains topic subscription of consumer.
    - **Store Service**, provides simple APIs to store or query message in physical disk.
    - **HA Service**, provides data sync feature between master broker and slave broker.
    - **Index Service**, builds index for messages by specified key and provides quick message query.

![rocket-mq-broker-server.png](_images/rocket-mq-broker-server.png)

## Best Pratice

### Core Concept

Reference

- Core Concept : https://rocketmq.apache.org/docs/core-concept

#### Producer

##### Producer Group

#### Consumer

##### PullConsumer

##### PushConsumer

##### ConsumerGroup

#### Topic

#### Message

##### Message Queue

##### Tag

##### Broker

#### Name Server

#### Message Model

#### Message Order

### Broker

Reference

- Best Practice For Broker : https://rocketmq.apache.org/docs/best-practice-broker

### Consumer

Reference

- Best Practice For Producer : https://rocketmq.apache.org/docs/best-practice-producer

### NameServer

Reference

- Best Practice For NameServer : https://rocketmq.apache.org/docs/best-practice-namesvr

### JVM/Kernel Config

Reference

- RocketMQ JVM/Linux Configuration : https://rocketmq.apache.org/docs/system-config
