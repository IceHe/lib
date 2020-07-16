# Designing Data-Intensive Applications

References

- Book "Designing Data-Intensive Applications"
    - ZH Ver. :《 数据密集型应用系统设计 》

## Reliable, Scalable & Maintainable Systems

**Reliability** _( 可靠性 )_

- _Tolerating hardware & software faults, human errors_
    - The system should continue to work correctly (performing the correct function at the desired level of performance) even in the face of adversity
    - _( 当出现意外情况如硬件、软件故障、人为失误等, 系统应可以继续正常运转 : 虽然性能可能有所降低, 但确保功能正常 )_

**Scalability** _( 可拓展性 / 可伸缩性 )_

- _Measuring load & performance : Latency percentiles, throughput_
    - As the system grows (in data volume, traffic volume, or complexity), there should be reasonable ways of dealing with that growth.
    - _( 随着规模的增长, 例如数据量、流量或复杂性, 系统应以合理的方式来匹配这种增长 )_

**Maintainability** _( 可维护性 )_

- _Operability, simplicity & evolvability_ _( 可演化性 )_
    - Over time, many different people will work on the system (engineering and operations, both maintaining current behavior and adapting the system to new use cases), and they should all be able to work on it productively.
    - _( 随着时间的推移, 许多新的人员参与到系统开发和运维, 以维护现有功能或适配新场景, 系统都应高效运转 )_

---

Application Types

- Data-intensive _数据密集型_
- Compute-intensive _计算密集型_

Data Systems

- Database
    - _Store data so that they, or another application, can find it again later_
        - _( 数据库 : 存储数据, 之后应用可再次访问 )_
- Cache
    - _Remember the result of an expensive operation, to speed up reads_
        - _( 高速缓存 : 缓存那些复杂或操作代价昂贵的结果, 以加快下一次访问 )_
- Search Index
    - _Allow users to search data by keyword or filter it in various ways_
        - _( 索引 : 按照关键字搜索数据, 并支持各种过滤 )_
- Stream processing
    - _Send a message to another process, to be handled asynchronously_
        - _( 流式处理 : 持续发送消息至另一个进程, 处理采用异步方式 )_
- Batch processing
    - _Periodically crunch a large amount of accumulated data_
        - _( 批处理 : 定期处理大量的累积数据 )_

_Others_

- _Full-text search server ( 全文索引服务 )_
    - _e.g.: Elasticsearch / Solr_ _( both from Lucene )_
- _Rolling upgrade ( 滚动升级 )_

### Reliability

_Expectations_

- _Continuing to work correctly, even when things go wrong._
    - _( 即使发生了某些错误, 系统仍可以继续正常工作 )_

<!--

    - _The application performs the function that the user expected._
        - _( 应用程序执行用户所期望的功能 )_
    - _It can tolerate the user making mistakes or using the software in unexpected ways._
        - _( 可以容忍用户出现错误或者不正确的软件使用方法 )_
    - _Its performance is good enough for the required use case, under the expected load and data volume._
        - _( 性能可以应对典型场景、合理负载压力和数据量 )_
    - _The system prevents any unauthorized access and abuse._
        - _( 系统可防止任何未经授权的访问和滥用 )_

-->

_Concepts_

- **Faults**
    - The things that can go wrong
    - _( 错误/故障 : 可能出错的事情 )_
- **Fault-tolerant** or **Resilient**
    - Systems that anticipate faults and can cope with them
    - _( 容错/弹性 : 系统可应对错误 )_

_Fault 故障 / Failure 失效_

- _Differences_
    - Fault : One component of the system deviating from its spec
        - _( 故障 : 组件偏离其正常规格 )_
    - Failure : A failure is when the system as a whole stops providing the required service to the user
        - _( 失效 : 系统作为一个整体停止, 无法向用户提供所需的服务 )_
- _Targets_
    - _It is impossible to reduce the probability of a fault to zero;_
    - _therefore it is usually best to design fault-tolerance mechanisms that prevent faults from causing failures._
- Build reliable systems from unreliable parts
    - _( 在不可靠组件基础上, 构建可靠性系统 )_

<!--

_Faults_

- _Harware Faults_
    - _…_
- _Software Errors_
    - _A software bug that causes every instance of an application server to crash when given a particular bad input._
        - _For example, consider the leap second on June 30, 2012, that caused many applications to hang simultaneously due to a bug in the Linux kernel_
    - _A runaway process that uses up some shared resource -- CPU time, memory, disk space, or network bandwidth._
    - _A service that the system depends on that slows down, becomes unresponsive, or starts returning corrupted responses._
    - _Cascading failures, where a small fault in one component triggers a fault in another component, which in turn triggers further faults._
- _Human Errors_
    - _Design systems in a way that minimizes opportunities for error. For example, well-designed abstractions, APIs, and admin interfaces make it easy to do “the right thing” and discourage “the wrong thing.”_
        - _However, if the interfaces are too restrictive people will work around them, negating their benefit, so this is a tricky balance to get right._
    - _Decouple the places where people make the most mistakes from the places where they can cause failures._
        - _In particular, provide fully featured non-production sandbox environments where people can explore and experiment safely, using real data, without affecting real users._
    - _Test thoroughly at all levels, from unit tests to whole-system integration tests and manual tests._
        - _Automated testing is widely used, well understood, and espe‐ cially valuable for covering corner cases that rarely arise in normal operation._
    - _Allow quick and easy recovery from human errors, to minimize the impact in the case of a failure._
        - _For example, make it fast to roll back configuration changes, roll out new code gradually (so that any unexpected bugs affect only a small subset of users), and provide tools to recompute data (in case it turns out that the old com‐ putation was incorrect)._
    - _Set up detailed and clear monitoring, such as performance metrics and error rates._
        - _In other engineering disciplines this is referred to as telemetry. (Once a rocket has left the ground, telemetry is essential for tracking what is happening, and for understanding failures.)_
        - _Monitoring can show us early warning signals and allow us to check whether any assumptions or constraints are being violated. When a problem occurs, metrics can be invaluable in diagnosing the issue._
    - _Implement good management practices and training—a complex and important aspect, and beyond the scope of this book._

-->

### Scalability

#### Describing Load

- Load Parameters _( 负载参数 )_
    - Web server : Requests Per Second ( RPS ) _/ Queries Per Second ( QPS )_
    - Database : Ratio of reads to writes _( 写入比例 )_
    - Chat room : Number of simultaneously active users
    - Cache : Hit rate
- Example : Twitter
    - Main operations
        - Post tweet : avg rps 4.6k , peak rps 12k _( Nov 2012 )_
        - Home timeline : avg rps 300k
    - Challenge : Fan-out _( 扇出 )_
        - Implementation
            - Pull _( 拉模型 )_
            - Push _( 推模型 )_
            - Push & Pull _( 推拉结合 )_
    - ommitted … ( **重要! 详见原书例** )

#### Describing Performance

_Look at it in two ways:_

- When you increase a load parameter and keep the system resources (CPU, mem‐ ory, network bandwidth, etc.) unchanged, how is the performance of your system affected?
- When you increase a load parameter, how much do you need to increase the resources if you want to keep performance unchanged?

_Performance Numbers ( 性能指标 )_

- Throughput _( 吞吐量 )_ : _The number of records we can process per second, or the total time it takes to run a job on a dataset of a certain size_
- Response Time _( 响应时间 )_ : _The time between a client sending a request and receiving a response_

Differ latency from response time

- **Response Time = Service Time + Network Delays + Queueing Delays**
    - Service Time ( 服务时间 ) : the actual time to process the request
- **Latency : The duration that a request is waiting to be handled**
    - during which it is latent, awaiting service

_Random Additional Latency ( 每次请求的响应时间, 由于许多因素的影响而不同 )_

- _a context switch to a background process ( 上下文切换 进程调度  )_
- _the loss of a network packet and TCP retransmission ( 网络数据包丢失和 TCP 重传 )_
- _a garbage collection pause ( 垃圾回收暂停 )_
- _a page fault forcing a read from disk ( 缺页中断 磁盘IO )_
- _mechanical vibrations in the server rack ( 甚至是服务器支架的机械振动 )_
- …

Response Time

- _The mean is not a very good metric if you want to know your “typical” response time,_
    - _because it doesn’t tell you how many users actually experienced that delay._
    - _Usually it is better to use **percentiles** ( 百分位数 ) ._
- _And **median** response time : half your requests return in less than the median, and half your requests take longer than that._
    - _This makes the median a good metric if you want to know how long users typically have to wait…_
    - _The median is also known as the **50th percentile**, and sometimes abbreviated as **p50**._
- _Strictly speaking, the term “**average**” doesn’t refer to any particular formula,_
    - _but in practice it is usually understood as the arithmetic mean: given n values, add up all the values, and divide by n._

Percentiles _( 百分位数 )_

- _Response time thresholds_
    - p95 : _e.g., **if the 95th percentile response time is 1.5 seconds, that means 95 out of 100 requests take less than 1.5 seconds, and 5 out of 100 requests take 1.5 seconds or more.**_
    - p99 / p999 / etc.
    - mean = p50
- _High percentiles of response times, also known as **tail latencies**, are important because they directly affect users’ experience of the service._

Service Level Agreements ( SLAs )

- _Percentiles are often used in **service level objectives (SLOs)** and **service level agreements (SLAs)**, contracts that define the expected performance and availability of a service._
- _e.g.: An SLA may state that the service is considered to be up if it has a median response time of less than 200 ms and a 99th percentile under 1 s ( if the response time is longer, it might as well be down ), and the service may be required to be up at least 99.9% of the time._

Queueing delays _( 排队延迟 )_

- Queueing delays often account for a large part of the response time at high percentiles.
- As a server can only process a small number of things in parallel ( limited, for example, by its number of CPU cores ),
    - it only takes a small number of slow requests to hold up the processing of subsequent requests -- an effect sometimes known as **head-of-line blocking**.
    - _Even if those subsequent requests are fast to process on the server, the client will see a slow overall response time due to the time waiting for the prior request to complete._
- _Due to this effect, it is important to measure response times on the client side._

_Percentiles in Practice_

- _Even if you make the calls in parallel, the end-user request still needs to wait for the slowest of the parallel calls to complete._
    - _It takes just one slow call to make the entire end-user request slow._
- _Even if only a small percentage of backend calls are slow, the chance of getting a slow call increases if an end-user request requires multiple backend calls, and so a higher proportion of end-user requests end up being slow ( an effect known as **tail latency amplification** )._

_Approaches for Coping with Load_

- _People often talk of a dichotomy between_
    - **scaling up (vertical scaling, moving to a more powerful machine)** and
    - **scaling out (horizontal scaling, distributing the load across multiple smaller machines)**.
- _Distributing load across multiple machines is also known as a **shared-nothing** architecture._
- _Some systems are **elastic**, meaning that they can automatically add computing resources when they detect a load increase, whereas other systems are scaled manually ( a human analyzes the capacity and decides to add more machines to the system )._
