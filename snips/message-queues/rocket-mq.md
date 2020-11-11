# RocketMQ

> A unified messaging engine，lightweight data processing platform.

References

- Home Page : https://rocketmq.apache.org
    - Why RocketMQ : https://rocketmq.apache.org/docs/motivation
    - How to Support More Queues in RocketMQ? : https://rocketmq.apache.org/rocketmq/how-to-support-more-queues-in-rocketmq
    - Quick Start : https://rocketmq.apache.org/docs/quick-start
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

![rocketmq-consumequeue-record-format.png](_images/rocketmq-consumequeue-record-format.png)

- 1\. All message data are stored in commit log files.
    - All writes are completely sequential whilst reads are random.
- 2\. ConsumeQueue stores the actual user consumption location information, which are also flushed to disk in sequential manner.

> pros ：

- 1\. Each consume queue is lightweight and contains limited amount of meta data.
- 2\. Access to disk is totally sequential, which avoids disk lock contention, and will not incur high disk IO wait when a large number of queues has been created.

> cons：

- 1\. Message consumption will first read consume queue, then commit log. This process brings in certain cost in worst cases.
- 2\. Commit log and consume queues need to be logically consistent, which introduces extra complexities to programming model.

> Design Motivation :

- 1\. Random read. Read as much as possible to increase the page cache hit rate, and reduce read IO operations. So large memory is still preferable. If massive messages are accumulated, would the read performance degrade badly? The answer is negative, reasons are as follows:
    - Even if size of the message is only 1KB, the system will read more data in advance, see PAGECACHE prefetch for reference. This means for the sequel data read, it is access to main memory that will be carried out instead of slow disk IO read.
    - Random access CommitLog from disk. If set the I/O scheduler to NOOP in case of SSD, the read qps will be greatly accelerated thus much faster than other elevator scheduler algorithm.
- 2\. Given ConsumeQueue stores fixed-size metadata only, which is mainly used to record consuming progress, random read is well supported. Taking advantage of page cache prefetch, accessing ConsumeQueue is as efficiently fast as accessing main memory, even if it’s in the case of massive message accumulation. As a result，ConsumeQueue will NOT bring in noticeable penalty to the read performance.
- 3\. CommitLog stores virtually all information, including the message data. Similar to redo log of relational database, consume queues, message key indexes and all other required data can be completely recovered as long as commit log exists..

## Quick Start
