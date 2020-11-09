# kafka

> **Apache Kafka is an open-source distributed event streaming platform** used by thousands of companies for high-performance data pipelines, streaming analytics, data integration, and mission-critical applications.

References

- APACHE KAFKA : https://kafka.apache.org/
    - Intro : https://kafka.apache.org/intro
    - Quickstart : https://kafka.apache.org/quickstart

## Intro

Core Capabilities

- **High Throughput**
- **Scalable**
- **Permanent Storage**
- **High Available**

Ecosystem

- **Built-in Strem Processing**
    - Process streams of events with joins, aggregations, filters, transformations, and more, using event-time and **exactly-once processing**.
- Connect to almost anything
- Client Libraries
- Large Ecosystem Open Source Tools

Reference

- Intro - Apache kafka : https://kafka.apache.org/intro

### Description

Apache Kafka is an **event streaming platform**. What does that mean?

Kafka combines three key capabilities so you can implement your use cases for event streaming end-to-end with a single battle-tested solution:

- To **publish (write)** and **subscribe to (read)** streams of events, including continuous import/export of your data from other systems.
- To **store** streams of events durably and reliably for as long as you want.
- To **process** streams of events as they occur or retrospectively _( 回顾地  )_ .

### Main Concepts

#### Event

Main Concepts and Terminology

- An event records the fact that "something happened" in the world or in your business.
- It is also called record or message in the documentation.
- When you read or write data to Kafka, you do this in the form of events.
- Conceptually, **an event has a key, value, timestamp, and optional metadata headers.**

_Here's an example event:_

- _Event **key** : "Alice"_
- _Event **value** : "Made a payment of $200 to Bob"_
- _Event **timestamp** : "Jun. 25, 2020 at 2:06 p.m."_

#### Producers

<u>**Producers**</u> are those client applications that publish (write) events to Kafka, and <u>**consumers**</u> are those that subscribe to (read and process) these events.

- _In Kafka, producers and consumers are fully decoupled and agnostic of each other, which is a key design element to achieve the high scalability that Kafka is known for._
- For example, **producers never need to wait for consumers.**
- Kafka provides various guarantees such as the ability to **process events exactly-once.**
    - _( icehe : 对消息 "有且只消费一次" 的特性存疑, 需要了解具体实现方式 )_

#### Topics

Events are organized and durably stored in <u>**topics**</u>.

- Very simplified, a topic is similar to a folder in a filesystem, and the events are the files in that folder.
- An example topic name could be "payments".
- **Topics in Kafka are always multi-producer and multi-subscriber :**
    - a topic can have zero, one, or many producers that write events to it, as well as zero, one, or many consumers that subscribe to these events.
- **Events in a topic can be read as often as needed** -- unlike traditional messaging systems, **events are not deleted after consumption.**
    - Instead, you **define for how long Kafka should retain your events through a per-topic configuration setting, after which old events will be discarded.**
    - Kafka's performance is effectively constant with respect to data size, so storing data for a long time is perfectly fine.

#### Partitioned

Topics are <u>**partitioned**</u>, meaning **a topic is spread over a number of "buckets" located on different Kafka brokers.**

- This distributed placement of your data is very important for scalability because it allows client applications to both read and write the data from/to many brokers at the same time.
- When a new event is published to a topic, it is actually appended to one of the topic's partitions.
- Events with the same event key ( e.g., a customer or vehicle ID ) are written to the same partition, and Kafka guarantees that any consumer of a given topic-partition will always read that partition's events in exactly the same order as they were written.

![kafka-partitions.png](_images/kafka-partitions.png)

- The Figure above : This example topic has four partitions P1 ~ P4.
    - Two different producer clients are publishing, independently from each other, new events to the topic by writing events over the network to the topic's partitions.
    - Events with the same key ( denoted by their color in the figure ) are written to the same partition.
    - Note that **both producers can write to the same partition if appropriate.**

#### Replicated

To make your data fault-tolerant and highly-available, every topic can be <u>**replicated**</u>, even across geo-regions or datacenters,

- so that there are always multiple brokers that have a copy of the data just in case things go wrong, you want to do maintenance on the brokers, and so on.
- A **common production setting is a replication factor of 3**,
    - i.e., there will always be three copies of your data.
- This **replication is performed at the level of topic-partitions.**

### Design

This primer should be sufficient for an introduction.

- The [Design](https://kafka.apache.org/documentation/#design) section of the documentation explains Kafka's various concepts in full detail, if you are interested.

## Use Cases

Reference

- Use Cases - Apache kafka : https://kafka.apache.org/uses

### Messaging

消息队列

- Kafka works well as a replacement for a more traditional message broker.
    - Message brokers are used for a variety of reasons (to decouple processing from data producers, to buffer unprocessed messages, etc).
    - In comparison to most messaging systems **Kafka has better throughput**, **built-in partitioning**, **replication**, and **fault-tolerance** which makes it a good solution for large scale message processing applications.
- In our experience **messaging uses are often comparatively low-throughput, but may require low end-to-end latency and often depend on the strong durability guarantees** Kafka provides.
- _In this domain Kafka is comparable to traditional messaging systems such as [ActiveMQ](http://activemq.apache.org/) or [RabbitMQ](https://www.rabbitmq.com/)._

### Website Activity Tracking

网页(用户)活动跟踪

- The original use case for Kafka was to be able to **rebuild a user activity tracking pipeline as a set of real-time publish-subscribe feeds.**
    - This means site activity ( page views, searches, or other actions users may take ) is published to central topics with one topic per activity type.
    - These feeds are available for subscription for a range of use cases including real-time processing, real-time monitoring, and loading into Hadoop or offline data warehousing systems for offline processing and reporting.
- **Activity tracking is often very high volume** as many activity messages are generated for each user page view.

### Metrics

软件度量

- Kafka is often used for **operational monitoring data** _( 运维监控数据 )_ .
    - This involves aggregating statistics from distributed applications to produce centralized feeds of operational data.

### Log Aggregation

- Many people use Kafka as a **replacement for a log aggregation solution**.
    - Log aggregation typically collects physical log files off servers and puts them in a central place ( a file server or HDFS perhaps ) for processing.
    - Kafka abstracts away the details of files and gives a cleaner abstraction of log or event data as a stream of messages.
    - This allows for lower-latency processing and easier support for multiple data sources and distributed data consumption.
    - **In comparison to log-centric systems like Scribe or Flume, Kafka offers equally good performance, stronger durability guarantees due to replication, and much lower end-to-end latency.**

### Stream Processing

- Many users of Kafka process data in processing pipelines consisting of multiple stages, where raw input data is consumed from Kafka topics and then aggregated, enriched, or otherwise transformed into new topics for further consumption or follow-up processing.
    - For example, a processing pipeline for recommending news articles might crawl article content from RSS feeds and publish it to an "articles" topic;
        - further processing might normalize or deduplicate this content and publish the cleansed article content to a new topic;
        - a final processing stage might attempt to recommend this content to users.
    - Such processing pipelines create graphs of real-time data flows based on the individual topics.
    - Starting in 0.10.0.0, a light-weight but powerful stream processing library called [**Kafka Streams**](https://kafka.apache.org/documentation/streams/) is available in Apache Kafka to perform such data processing as described above.
    - Apart from Kafka Streams, alternative open source stream processing tools include [Apache Storm](https://storm.apache.org/) and [Apache Samza](http://samza.apache.org/).

### Event Sourcing

- Event sourcing is **a style of application design where state changes are logged as a time-ordered sequence of records.**
    - Kafka's support for very large stored log data makes it an excellent backend for an application built in this style.

### Commit Log

- Kafka can serve as a kind of **external commit-log for a distributed system**.
    - **The log helps replicate data between nodes and acts as a re-syncing mechanism for failed nodes to restore their data.**
    - The [log compaction](https://kafka.apache.org/documentation.html#compaction) feature in Kafka helps support this usage.
    - In this usage Kafka is similar to [Apache BookKeeper](https://bookkeeper.apache.org/) project.

## Design

### Motivation

- We designed Kafka to **be able to act as a unified platform for handling all the real-time data** feeds a large company might have.
    - To do this we had to think through a fairly broad set of use cases.
- It would have to have **high-throughput to support high volume event streams** such as real-time log aggregation.
- It would need to deal gracefully with large data backlogs to be able to support periodic data loads from offline systems.
- It also meant the system would have to handle low-latency delivery to handle more traditional messaging use-cases.
- We wanted to support partitioned, distributed, real-time processing of these feeds to create new, derived feeds.
    - This motivated our partitioning and consumer model.
- Finally in cases where the stream is fed into other data systems for serving, we knew the system would have to be able to guarantee fault-tolerance in the presence of machine failures.
- Supporting these uses led us to a design with a number of unique elements, **more akin to a database log than a traditional messaging system**.
    - We will outline some elements of the design in the following sections.

### Persistence

#### Don't Fear the Filesystem

- **Kafka relies heavily on the filesystem for storing and caching messages.**
    - There is a general perception that "disks are slow" which makes people skeptical that a persistent structure can offer competitive performance.
    - In fact disks are both much slower and much faster than people expect depending on how they are used;
        - and **a properly _( 正确地 )_ designed disk structure can often be as fast as the network**.
- **The key fact about disk performance is that the <u>throughput of hard drives has been diverging _( 相异 )_ from the latency of a disk seek</u> for the last decade.**
    - As a result the performance of linear writes on a JBOD configuration with six 7200rpm SATA RAID-5 array is about 600MB/sec but the performance of random writes is only about 100k/sec -- a difference of over 6000X.
    - These linear reads and writes are the most predictable of all usage patterns, and are heavily optimized by the operating system.
    - A modern operating system provides read-ahead and write-behind techniques that prefetch data in large block multiples and group smaller logical writes into large physical writes.
    - A further discussion of this issue can be found in this ACM Queue article;
        - they **actually find that sequential disk access can in some cases be faster than random memory access!**
- To compensate for this performance divergence, **modern operating systems have become increasingly aggressive in their use of main memory for disk caching.**
    - A modern OS will happily divert all free memory to disk caching with little performance penalty when the memory is reclaimed _( 回收利用 )_ .
    - All disk reads and writes will go through this unified cache.
    - This feature cannot easily be turned off without using direct I/O, so even if a process maintains an in-process cache of the data, this data will likely be duplicated in OS pagecache, effectively storing everything twice.
- Furthermore, we are building on top of the JVM, and anyone who has spent any time with Java memory usage knows two things:
    - 1\. The memory overhead of objects is very high, often doubling the size of the data stored (or worse).
    - 2\. Java garbage collection becomes increasingly fiddly and slow as the in-heap data increases.
- As a result of these factors using the filesystem and relying on pagecache is superior to maintaining an in-memory cache or other structure -- we at least double the available cache by having automatic access to all free memory, and likely double again by storing a compact byte structure rather than individual objects.
    - Doing so will result in a cache of up to 28~30GB on a 32GB machine without GC penalties.
    - Furthermore, this cache will stay warm even if the service is restarted, whereas the in-process cache will need to be rebuilt in memory (which for a 10GB cache may take 10 minutes) or else it will need to start with a completely cold cache (which likely means terrible initial performance).
    - This also greatly simplifies the code as all logic for maintaining coherency between the cache and filesystem is now in the OS, which tends to do so more efficiently and more correctly than one-off _( 一次性的 )_ in-process attempts.
    - If your disk usage favors linear reads then read-ahead is effectively pre-populating this cache with useful data on each disk read.
- This suggests a design which is very simple :
    - rather than maintain as much as possible in-memory and flush it all out to the filesystem in a panic when we run out of space, we invert that.
    - All data is immediately written to a persistent log on the filesystem without necessarily flushing to disk.
    - In effect this just means that it is transferred into the kernel's pagecache.
- This style of **pagecache-centric design** is described in an [article](http://varnish-cache.org/docs/trunk/phk/notes.html) on the design of Varnish here (along with a healthy dose of arrogance).

#### Constant Time Suffices

- The persistent data structure used in messaging systems are often a per-consumer queue with an associated BTree or other general-purpose random access data structures to maintain metadata about messages.
    - BTrees are the most versatile _( 多用途的, 多功能的 )_ data structure available, and make it possible to support a wide variety of transactional and non-transactional semantics in the messaging system.
    - They do come with a fairly high cost, though : Btree operations are O(log N).
    - Normally O(log N) is considered essentially equivalent to constant time, but this is not true for disk operations.
    - Disk seeks come at 10 ms a pop, and each disk can do only one seek at a time so parallelism is limited.
    - Hence even a handful of disk seeks leads to very high overhead.
    - Since storage systems mix very fast cached operations with very slow physical disk operations, the observed performance of tree structures is often superlinear as data increases with fixed cache -- i.e. doubling your data makes things much worse than twice as slow.
- Intuitively _( 凭直觉地 )_ a persistent queue could be built on simple reads and appends to files as is commonly the case with logging solutions.
    - This structure has the advantage that all operations are O(1) and reads do not block writes or each other.
    - **This has obvious performance advantages since the performance is completely decoupled from the data size -- one server can now take full advantage of a number of cheap, low-rotational speed 1+TB SATA drives.**
    - Though they have poor seek performance, these drives have acceptable performance for large reads and writes and come at 1/3 the price and 3x the capacity.
- Having access to virtually unlimited disk space without any performance penalty means that we can provide some features not usually found in a messaging system.
    - For example, in Kafka, instead of attempting to delete messages as soon as they are consumed, we can retain messages for a relatively long period (say a week).
    - This leads to a great deal of flexibility for consumers, as we will describe.

_suffice : vi. 足够, 有能力_

### Efficiency

- We have put significant effort into efficiency.
    - One of our primary use cases is handling web activity data, which is very high volume : each page view may generate dozens of writes.
    - Furthermore, we assume each message published is read by at least one consumer (often many), hence we strive to make consumption as cheap as possible.
- We have also found, from experience building and running a number of similar systems, that efficiency is a key to effective multi-tenant _( 多租户 )_ operations.
    - If the downstream infrastructure service can easily become a bottleneck due to a small bump in usage by the application, such small changes will often create problems.
    - By being very fast we help ensure that the application will tip-over under load before the infrastructure.
    - This is particularly important when trying to run a centralized service that supports dozens or hundreds of applications on a centralized cluster as changes in usage patterns are a near-daily occurrence.
- We discussed disk efficiency in the previous section.
    - Once poor disk access patterns have been eliminated, there are two common causes of inefficiency in this type of system :
        - too many small I/O operations, and
        - excessive **byte copying**.
- The small I/O problem happens both between the client and the server and in the server's own persistent operations.
- To avoid this, our protocol is built around a "message set" abstraction that naturally groups messages together.
    - This allows network requests to group messages together and amortize _( 分期偿还 )_ the overhead of the network roundtrip rather than sending a single message at a time.
    - The server in turn appends chunks of messages to its log in one go, and the consumer fetches large linear chunks at a time.
- This simple optimization produces orders of magnitude _( 数个数量级的 )_ speed up.
    - Batching leads to larger network packets, larger sequential disk operations, contiguous memory blocks, and so on, all of which allows Kafka to turn a bursty stream of random message writes into linear writes that flow to the consumers.
- The other inefficiency is in byte copying.
    - At low message rates this is not an issue, but under load the impact is significant.
    - To avoid this we employ a standardized binary message format that is shared by the producer, the broker, and the consumer (so data chunks can be transferred without modification between them).
- The message log maintained by the broker is itself just a directory of files, each populated by a sequence of message sets that have been written to disk in the same format used by the producer and consumer.
    - Maintaining this common format allows optimization of the most important operation: network transfer of persistent log chunks.
    - Modern unix operating systems offer a highly optimized code path for transferring data out of pagecache to a socket;
    - in Linux this is done with the [sendfile system call](https://man7.org/linux/man-pages/man2/sendfile.2.html).
- To understand the impact of sendfile, it is important to understand the **common data path for transfer of data from file to socket** :
    - 1\. The **operating system reads data from the disk into pagecache in kernel space**
    - 2\. The **application reads the data from kernel space into a user-space buffer**
    - 3\. The **application writes the data back into kernel space into a socket buffer**
    - 4\. The **operating system copies the data from the socket buffer to the NIC buffer** where it is sent over the network
        - _NIC : Network Information Center 网络信息中心_
- This is clearly inefficient, there are four copies and two system calls.
    - **Using `sendfile`, this re-copying is avoided by allowing the OS to send the data from pagecache to the network directly.**
    - So in this optimized path, only the final copy to the NIC buffer is needed.
- We expect a common use case to be multiple consumers on a topic.
    - Using the zero-copy optimization above, data is copied into pagecache exactly once and reused on each consumption instead of being stored in memory and copied out to user-space every time it is read.
    - This allows messages to be consumed at a rate that approaches the limit of the network connection.
- This combination of pagecache and sendfile means that on a Kafka cluster where the consumers are mostly caught up you will see no read activity on the disks whatsoever _( 无论什么 )_ as they will be serving data entirely from cache.
- For more background on the sendfile and zero-copy support in Java, see this [article](https://developer.ibm.com/articles/j-zerocopy/).

#### End-to-end Batch Compression

In some cases the bottleneck is actually not CPU or disk but network bandwidth. This is particularly true for a data pipeline that needs to send messages between data centers over a wide-area network. Of course, the user can always compress its messages one at a time without any support needed from Kafka, but this can lead to very poor compression ratios as much of the redundancy is due to repetition between messages of the same type (e.g. field names in JSON or user agents in web logs or common string values). Efficient compression requires compressing multiple messages together rather than compressing each message individually.

Kafka supports this with an efficient batching format. A batch of messages can be clumped together compressed and sent to the server in this form. This batch of messages will be written in compressed form and will remain compressed in the log and will only be decompressed by the consumer.

Kafka supports GZIP, Snappy, LZ4 and ZStandard compression protocols. More details on compression can be found [here](https://cwiki.apache.org/confluence/display/KAFKA/Compression).

### The Producer

#### Load Balance

## Notes

TODOs

- https://kafka.apache.org/documentation/#persistence
- https://www.confluent.io/learn/kafka-tutorial/
- Kafka 设计与原理详解 : https://blog.csdn.net/suifeng3051/article/details/48053965
- https://github.com/apache/kafka
- Kafka 总结 : https://www.google.com/search?q=kafka+%E6%80%BB%E7%BB%93&oq=kafka+%E6%80%BB%E7%BB%93&aqs=chrome..69i57j0i457j0j0i20i263j0l4.4931j0j7&sourceid=chrome&ie=UTF-8
    - https://zhuanlan.zhihu.com/p/72328153
    - https://juejin.im/post/6844903850596548615
    - https://cloud.tencent.com/developer/article/1494728
    - https://www.jianshu.com/p/c2c845e86cb1

Others

- http://activemq.apache.org/
- http://samza.apache.org/
- https://storm.apache.org/
- https://www.rabbitmq.com/
- https://www.google.com/search?q=%E9%95%BF%E8%BF%9E%E6%8E%A5+%E7%9F%AD%E8%BF%9E%E6%8E%A5&oq=%E9%95%BF%E8%BF%9E%E6%8E%A5+%E7%9F%AD%E8%BF%9E%E6%8E%A5&aqs=chrome..69i57.6181j0j7&sourceid=chrome&ie=UTF-8
    - TCP的长连接和短连接 : https://www.cnblogs.com/0201zcr/p/4694945.html
    - http的长连接和短连接（史上最通俗！）: https://www.jianshu.com/p/3fc3646fad80
    - https://juejin.im/post/6844903609138692110
- Network
    - why broken pipe : https://www.google.com/search?q=why+broken+pipe&oq=why+boken+pipe&aqs=chrome.1.69i57j0i22i30i457j0i22i30.7640j0j7&sourceid=chrome&ie=UTF-8
    - why connection reset : https://www.google.com/search?q=why+connection+reset&oq=why+connection+reset&aqs=chrome..69i57.5345j0j7&sourceid=chrome&ie=UTF-8
- 零复制
    - https://www.zhihu.com/question/21705041
    - https://www.cnblogs.com/f-ck-need-u/p/7615914.html
