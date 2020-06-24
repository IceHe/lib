# Designing Data-Intensive Applications

References

- Book "Designing Data-Intensive Applications"
    - ZH Ver. :《 数据密集型应用系统设计 》

## Table of Contents

Part I. Foundations of Data Systems

- 1\. Reliable, Scalable, and Maintainable Applications
    - _Thinking About Data Systems_
    - Reliability _( 可靠性 )_
        - Hardware Faults
        - Software Errors
        - Human Errors
        - _How Important Is Reliability?_
    - **Scalability** _( 可伸缩性 )_
        - **Describing Load**
        - **Describing Performance**
        - **Approaches for Coping with Load**
    - Maintainability _( 可维护性 )_
        - Operability: Making Life Easy for Operations _( 可运维性 )_
        - Simplicity: Managing Complexity _( 简单性 )_
        - Evolvability: Making Change Easy _( 可演化性 )_
- 2\. Data Models and Query Languages
    - **Relational Model Versus Document Model** _( 关系模型 / 文档模型 )_
        - **The Birth of NoSQL**
        - **The Object-Relational Mismatch**
        - **Many-to-One and Many-to-Many Relationships**
        - Are Document Databases Repeating History?
        - Relational Versus Document Databases Today
    - Query Languages for Data
        - Declarative Queries on the Web _( 声明式查询 )_
        - MapReduce Querying
    - **Graph-Like Data Models** _( 图模型 )_
        - **Property Graphs**
        - The Cypher Query Language
        - Graph Queries in SQL
        - Triple-Stores and SPARQL
        - The Foundation: Datalog
- 3\. Storage and Retrieval
    - **Data Structures That Power Your Database**
        - Hash Indexes
        - **SSTables and LSM-Trees** _( 日志结构合并树 )_
        - **B-Trees**
        - Comparing B-Trees and LSM-Trees
        - Other Indexing Structures
    - **Transaction Processing or Analytics?**
        - Data Warehousing _( 数据仓库 )_
        - **Stars and Snowflakes: Schemas for Analytics Column-Oriented Storage**
    - **Column-Oriented Storage** _( 列式存储 )_
        - **Column Compression**
        - **Sort Order in Column Storage**
        - Writing to Column-Oriented Storage
        - Aggregation: Data Cubes and Materialized Views
- 4\. Encoding and Evolution
    - **Formats for Encoding Data**
        - Language-Specific Formats
        - JSON, XML, and Binary Variants
        - **Thrift and Protocol Buffers**
        - _Avro_
        - The Merits of Schemas
    - **Modes of Dataflow**
        - Dataflow Through Databases
        - Dataflow Through Services: REST and RPC
        - Message-Passing Dataflow

Part II. Distributed Data

- 5\. Replication
    - Leaders and Followers
        - Synchronous Versus Asynchronous Replication
        - Setting Up New Followers
        - Handling Node Outages
        - Implementation of Replication Logs
    - Problems with Replication Lag
        - Reading Your Own Writes
        - Monotonic Reads
        - Consistent Prefix Reads
    - Solutions for Replication Lag
        - Multi-Leader Replication
        - Use Cases for Multi-Leader Replication
        - Handling Write Conflicts
    - Multi-Leader Replication Topologies
        - Leaderless Replication
        - Writing to the Database When a Node Is Down
        - Limitations of Quorum Consistency
        - Sloppy Quorums and Hinted Handoff
        - Detecting Concurrent Writes
- 6\. Partitioning
    - Partitioning and Replication
    - Partitioning of Key-Value Data
        - Partitioning by Key Range
        - Partitioning by Hash of Key
        - Skewed Workloads and Relieving Hot Spots
    - Partitioning and Secondary Indexes
        - Partitioning Secondary Indexes by Document
        - Partitioning Secondary Indexes by Term
    - Rebalancing Partitions
        - Strategies for Rebalancing
        - Operations: Automatic or Manual Rebalancing
    - Request Routing
        - Parallel Query Execution
- 7\. Transactions
    - The Slippery Concept of a Transaction
        - The Meaning of ACID
        - Single-Object and Multi-Object Operations
    - Weak Isolation Levels
        - Read Committed
        - Snapshot Isolation and Repeatable Read
        - Preventing Lost Updates
        - Write Skew and Phantoms
    - Serializability
        - Actual Serial Execution
        - Two-Phase Locking (2PL)
        - Serializable Snapshot Isolation (SSI)
- 8\. The Trouble with Distributed Systems
    - Faults and Partial Failures
        - Cloud Computing and Supercomputing
    - Unreliable Networks
        - Network Faults in Practice
        - Detecting Faults
        - Timeouts and Unbounded Delays
        - Synchronous Versus Asynchronous Networks
    - Unreliable Clocks
        - Monotonic Versus Time-of-Day Clocks
        - Clock Synchronization and Accuracy
        - Relying on Synchronized Clocks
        - Process Pauses
    - Knowledge, Truth, and Lies
        - The Truth Is Defined by the Majority
        - Byzantine Faults
        - System Model and Reality
- 9\. Consistency and Consensus
    - Consistency Guarantees
    - Linearizability
        - What Makes a System Linearizable?
        - Relying on Linearizability
        - Implementing Linearizable Systems
        - The Cost of Linearizability
    - Ordering Guarantees
        - Ordering and Causality
        - Sequence Number Ordering
        - Total Order Broadcast
    - Distributed Transactions and Consensus
        - Atomic Commit and Two-Phase Commit (2PC)
        - Distributed Transactions in Practice
        - Fault-Tolerant Consensus
        - Membership and Coordination Services

Part III. Derived Data

- 10\. Batch Processing
    - Batch Processing with Unix Tools
        - Simple Log Analysis
        - The Unix Philosophy
    - MapReduce and Distributed Filesystems
        - MapReduce Job Execution
        - Reduce-Side Joins and Grouping
        - Map-Side Joins
        - The Output of Batch Workflows
        - Comparing Hadoop to Distributed Databases
    - Beyond MapReduce
        - Materialization of Intermediate State
        - Graphs and Iterative Processing
        - High-Level APIs and Languages
- 11\. Stream Processing
    - Transmitting Event Streams
        - Messaging Systems
        - Partitioned Logs
    - Databases and Streams
        - Keeping Systems in Sync
        - Change Data Capture
        - Event Sourcing
        - State, Streams, and Immutability
    - Processing Streams
        - Uses of Stream Processing
        - Reasoning About Time
        - Stream Joins
        - Fault Tolerance
- 12\. The Future of Data Systems
    - Data Integration
        - Combining Specialized Tools by Deriving Data
        - Batch and Stream Processing
    - Unbundling Databases
        - Composing Data Storage Technologies
        - Designing Applications Around Dataflow
        - Observing Derived State
    - Aiming for Correctness
        - The End-to-End Argument for Databases
        - Enforcing Constraints
        - Timeliness and Integrity
        - Trust, but Verify
    - Doing the Right Thing
        - Predictive Analytics
        - Privacy and Tracking 536 Summary

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
    - Chat room : Number of simultaneously active users _( 在线人数 )_
    - Cache : Hit rate _( 命中率 )_
- Example : Twitter
    - Main operations
        - Post tweet : avg rps 4.6k , peak rps 12k _( Nov 2012 )_
        - Home timeline : avg rps 300k
    - Challenge : Fan-out _( 扇出 )_
        - Implementation
            - Pull _( 拉模型 )_
            - Push _( 推模型 )_
            - Push & Pull _( 推拉结合 )_
    - ommitted here … ( **重要! 详见原书例** )

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

##### Percentiles

Response Time

- _The mean is not a very good metric if you want to know your “typical” response time,_
    - _because it doesn't tell you how many users actually experienced that delay._
    - _Usually it is better to use **percentiles** ( 百分位数 ) ._
- _And **median** response time : half your requests return in less than the median, and half your requests take longer than that._
    - _This makes the median a good metric if you want to know how long users typically have to wait…_
    - _The median is also known as the **50th percentile**, and sometimes abbreviated as **p50**._
- _\* Strictly speaking, the term “**average**” doesn't refer to any particular formula,_
    - _but in practice it is usually understood as the arithmetic mean: given n values, add up all the values, and divide by n._

Percentiles _( 百分位数 )_

- _Response time thresholds ( 响应时间阈值 )_
    - p95 : _e.g., **if the 95th percentile response time is 1.5 seconds, that means 95 out of 100 requests take less than 1.5 seconds, and 5 out of 100 requests take 1.5 seconds or more.**_
    - p99 / p999 / etc.
    - mean = p50
- _High percentiles of response times, also known as **tail latencies** ( 尾部延迟 / 长尾效应 ), are important because they directly affect users' experience of the service._

Service Level Objectives ( SLOs ) _( 服务质量目标 )_ and
Service Level Agreements ( SLAs ) _( 服务质量协议 )_

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
- _Even if only a small percentage of backend calls are slow, the chance of getting a slow call increases if an end-user request requires multiple backend calls, and so a higher proportion of end-user requests end up being slow ( an effect known as **tail latency amplification** ( 长尾效应 ) )._
    - _( 即使只有很小百分比的请求缓慢, 如果某用户总是频繁产生这种调用, 最终总体变慢的概率就会增加, 即长尾效应 )_

##### Cope with Load

- _Approaches for Coping with Load ( 应对负载增加的方法 )_

Scale Up & Scale Out

- _An architecture that is appropriate for one level of load is unlikely to cope with 10 times that load._
- _People often talk of a dichotomy between ( 做取舍 )_
    - **scaling up ( vertical scaling, moving to a more powerful machine )** and
        - _垂直拓展 ( 即升级到更强大的机器 )_
    - **scaling out ( horizontal scaling, distributing the load across multiple smaller machines )**.
        - _水平拓展 ( 即将负载分布到多个更小的机器 )_
- _Distributing load across multiple machines is also known as a **shared-nothing** architecture._
    - _在多台机器上分配负载也被称为无共享体系结构_
- _A system that can run on a single machine is often simpler, but high-end machines can become very expensive, so very intensive workloads often can't avoid scaling out._
    - _在单台机器上运行系统通常更简单, 然而高端机器可能非常昂贵, 且拓展水平有限, 最终往往还是无法避免需要水平拓展_
- _In reality, good architectures usually involve a pragmatic mixture of approaches: for example, using several fairly powerful machines can still be simpler and cheaper than a large number of small virtual machines._
    - _实际上, 好的架构通常要做些实际取舍. 例如, 使用几个强悍的服务器仍可以比大量的小型虚拟机来得更简单便宜_

Elastic _( 弹性 )_

- Some systems are **elastic**, meaning that they can automatically add computing resources when they detect a load increase,
    - _whereas other systems are scaled manually (a human analyzes the capacity and decides to add more machines to the system)._
- _An elastic system can be useful if load is highly unpredictable, but manually scaled systems are simpler and may have fewer operational surprises._

_Others_

- Easy of use 易用性
- _In an early-stage startup or an unproven product it's usually more important to be able to iterate quickly on product features than it is to scale to some hypothetical future load._
    - _( 对于初创公司或尚未定型的产品, 快速迭代推出产品功能, 往往比应对不可知的拓展性更为重要 )_

### Mantainability

- _It is well known that the majority of the cost of software is not in its initial development, but in its ongoing maintenance :_
    - _fixing bugs,_
    - _keeping its systems operational,_
    - _investigating failures ( 故障排查 ) ,_
    - _adapting it to new platforms,_
    - _modifying it for new use cases,_
    - _repaying technical debt ( 偿还技术债 ) ,_
    - _and adding new features._
- _We can and should design software in such a way that it will hopefully minimize pain during maintenance, and thus avoid creating legacy software ( 过时的系统 ) ourselves._
    - _To this end, we will pay particular attention to **three design principles for software systems**…_

**Operability** _可运维性 : Making Life Easy for Operations_

- Make it easy for operations _( 运维 )_ teams to keep the system running smoothly _( 平稳运行 )_ .

**Simplicity** _简单性 : Managing Complexity_

- Make it easy for new engineers to understand the system, by removing as much complexity as possible from the system.
    - _( Note this is not the same as simplicity of the user interface. 跟用户界面的简单性不一样 )_

**Evolvability** _可演化性 : Making Change Easy_

- Make it easy for engineers to make changes to the system in the future, adapting it for unanticipated use cases as requirements change.
    - aka. **extensibility, modifiability, or plasticity**.
    - _( 可延伸性, 易修改性, 可塑性 )_

<!--

#### Operability : Making Life Easy for Operations

Making Life Easy for Operations _( 运维 )_

- _While some aspects of operations can and should be automated, it is still up to humans to set up that automation in the first place and to make sure it's working correctly._
- _A good operations team typically is responsible for the following, and more:_

_Responsibility_

- Monitoring the health of the system and quickly restoring service if it goes into a bad state
- Tracking down _( 追踪 )_ the cause of problems, such as system failures or degraded performance _( 性能下降 )_
- Keeping software and platforms up to date, including security patches
- Keeping tabs on _( 密切注意 )_ how different systems affect each other, so that a problematic change can be avoided before it causes damage
- Anticipating future problems and solving them before they occur (e.g., capacity planning)
- Establishing good practices and tools for deployment, configuration management, and more
- Performing complex maintenance tasks, such as moving an application from one platform to another
- Maintaining the security of the system as configuration changes are made
- Defining processes that make operations predictable and help keep the production environment stable
- Preserving the organization's knowledge about the system, even as individual people come and go

Good operability means making routine tasks easy, allowing the operations team to focus their efforts on high-value activities.

_Data systems can do various things to make routine tasks easy, including:_

- Providing visibility into the runtime behavior and internals of the system, with good monitoring
- Providing good support for automation and integration with standard tools
- Avoiding dependency on individual machines (allowing machines to be taken down for maintenance while the system as a whole continues running uninter‐ rupted)
- Providing good documentation and an easy-to-understand operational model ( "If I do X, Y will happen" )
- Providing good default behavior, but also giving administrators the freedom to override defaults when needed
- Self-healing where appropriate, but also giving administrators manual control over the system state when needed
- Exhibiting predictable behavior, minimizing surprises

#### Simplicity : Making Change Easy

- reason about 推出原因

#### Evolvability : Making Change Easy

- Agile 敏捷
- TDD : Test-Driven Development
- Refactoring 重构

-->

_Nonfunctional Requirements_

- security 安全性
- _reliability_
- compliance 合规性
- _scalability_
- compatibility 兼容性
- _mantainability 可运维性_

## Data Models and Query Languages

- Relational Model 关系模型
- Document Model 文档模型
- NoSQL : Not Only SQL
- polyglot persistence _( 混合持久化 )_
    - _use both relational and nonrelational datastores_

_Driving forces behind the adoption of NoSQL databases_

- A need for greater scalability than relational databases can easily achieve, including very large datasets or very high write throughput
- _A widespread preference for free and open source software over commercial database products_
- Specialized query operations that are not well supported by the relational model
- Frustration with the restrictiveness of relational schemas, and a desire for a more dynamic and expressive data model

_The Object-Relational Mismatch_ _( 对象-关系 不匹配 )_

- ORM - Object-Relational Mapping

_Schema flexibility in the document model_

- _Most document databases, and the JSON support in relational databases, do not enforce any schema on the data in documents._
- _XML support in relational databases usually comes with optional schema validation._
- No schema _( 无模式 )_ means that arbitrary keys and values can be added to a document,
    - and when reading, clients have no guarantees as to what fields the documents may contain.

_Many-to-One and Many-to-Many Relationships_

- _If your application has mostly one-to-many rela‐ tionships (tree-structured data) or no relationships between records, the document model is appropriate._
- _The relational model can handle simple cases of many-to-many relationships, …_

_Schema flexibility ( 模式灵活性 ) in the document model_

- _Most document databases, and the JSON support in relational databases, do not enforce any schema on the data in documents._
    - _XML support in relational databases usually comes with optional schema validation._
- **No schema** means that arbitrary keys and values can be added to a document,
    - and when reading, clients have no guarantees as to what fields the documents may contain.

_Data locality for queries ( 查询的数据局部性 )_

- _A document is usually stored as a single continuous string, encoded as JSON, XML, or a binary variant thereof (such as MongoDB's BSON)._
- If your application often needs to access the entire document (for example, to render it on a web page), there is a performance advantage to this **storage locality**.
- _If data is split across multiple tables, multiple index lookups are required to retrieve it all, which may require more disk seeks and take more time._

_Query Languages for Data_

- **Imperative** _( 命令式 )_ : _IMS, CODASYL ( Conference on Data System Languages )_
    - _Tells the computer to perform certain operations in a certain order._
        - _You can imagine stepping through the code line by line, evaluating conditions, updating variables, and deciding whether to go around the loop one more time._
- **Declarative** _( 声明式 )_ : SQL, CSS, XSL _( XPath expression )_
    - _Just specify the pattern of the data you want -- what conditions the results must meet, and how you want the data to be transformed (e.g., sorted, grouped, and aggregated) -- but not how to achieve that goal._
        - _It is up to the database system's query optimizer to decide which indexes and which join methods to use, and in which order to execute various parts of the query._
    - _It is attractive because it is typically more concise and easier to work with than an imperative API._
        - _But more importantly, it also hides implementation details of the database engine, which makes it possible for the database system to introduce performance improvements without requiring any changes to queries._

MapReduce Querying

- **MapReduce** is a programming model for processing large amounts of data in bulk across many machines, popularized by Google
- _MapReduce is neither a declarative query language nor a fully imperative query API, but somewhere in between:_
    - _the logic of the query is expressed with snippets of code, which are called repeatedly by the processing framework._
- It is based on the **map** ( aka. collect ) and **reduce** ( aka. fold or inject ) functions that exist in many functional programming languages.
- _MapReduce is a fairly low-level programming model for distributed execution on a cluster of machines._
    - _Higher-level query languages like SQL can be implemented as a pipeline of MapReduce operations, but there are also many distributed implementations of SQL that don't use MapReduce._

Graph-Like Data Models _( 图状数据模型 )_

- _The relational model can handle simple cases of many-to-many relationships,_
    - but as the connections within your data become more complex, it becomes more natural to start modeling your data as a **graph**.
- A graph consists of two kinds of objects: **vertices** ( aka. nodes or entities ) and **edges** ( aka. relationships or arcs ).

Property Graphs _( 属性图 )_

- _In the property graph model, each vertex consists of:_
    - _A unique identifier_
    - _A set of outgoing edges_
    - _A set of incoming edges_
    - _A collection of properties (key-value pairs)_
- _Each edge consists of:_
    - _A unique identifier_
    - _The vertex at which the edge starts (the tail vertex)_
    - _The vertex at which the edge ends (the head vertex)_
    - _A label to describe the kind of relationship between the two vertices_
    - _A collection of properties (key-value pairs)_
- _Some important aspects of this model are:_
    - _1\. Any vertex can have an edge connecting it with any other vertex. There is no schema that restricts which kinds of things can or cannot be associated._
    - <i>2\. Given any vertex, you can efficiently find both its incoming and its outgoing edges, and thus traverse the graph -- i.e., follow a path through a chain of vertices -- both forward and backward. (That's why Example 2-2 has indexes on both the tail_vertex and head_vertex columns.)</i>
    - _3\. By using different labels for different kinds of relationships, you can store several different kinds of information in a single graph, while still maintaining a clean data model._
- _The Cypher Query Language_
    - _Cypher is a declarative query language for property graphs, created for the Neo4j graph database._
- _Graph Queries in SQL_
    - _可以用关系型数据库实现图查询; 但是查询语句较长, 也更难理解; 说明用关系型模型来实现图模型, 还是不太适合_

_Triple-Stores and SPARQL ( 三元存储 … )_

- The triple-store model is mostly equivalent to the property graph model, using different words to describe the same ideas.
    - _It is nevertheless worth discussing, because there are various tools and languages for triple-stores that can be valuable additions to your toolbox for building applications._
- _Semantic web ( 语义网 )_
    - _The semantic web is fundamentally a simple and reasonable idea_
        - _websites already publish information as text and pictures for humans to read, so why don't they also publish information as machine-readable data for computers to read?_
- _RDF data model_
    - _RDF - Resource Description Framework 资源描述框架_
- _SPARQL query language_
    - _SPARQL is a query language for triple-stores using the RDF data model._
    - _( It is an acronym for SPARQL Protocol and RDF Query Language, pronounced “sparkle.” )_
    - _It predates Cypher, and since Cypher's pattern matching is borrowed from SPARQL, they look quite similar._

_The Foundation: Datalog_

- _Omitted …_

## Storage and Retrival

- _数据存储与检索_

OLTP - Two families of storage engines :

- **log-structured** storage engines
- **page-oriented** storage engines ( such as **B-trees** )

### Data Structures That Power Your Database

Log

- _The word log is often used to refer to application logs, where an application outputs text that describes what's happening._
- _In this book, log is used in the more general sense:_ an append-only sequence of records.
    - _It doesn't have to be human-readable; it might be binary and intended only for other programs to read._

#### Hash Indexes

Possible Indexing Strategy

- _Let's say our data storage consists only of appending to a file._
- Then the simplest possible indexing strategy is this: keep an in-memory hash map where every key is mapped to a byte offset in the data file -- the location at which the value can be found.
- Whenever you append a new key-value pair to the file, you also update the hash map to reflect the offset of the data you just wrote (this works both for inserting new keys and for updating existing keys).
- When you want to look up a value, use the hash map to find the offset in the data file, seek to that location, and read the value.

Disk Space

- … we only ever append to a file -- _so how do we avoid eventually running out of disk space?_
- A good solution is to break the log into segments of a certain size by closing a segment file when it reaches a certain size, and making subsequent writes to a new segment file.

Compaction

- _… since compaction often makes segments much smaller (assuming that a key is overwritten several times on average within one segment), we can also merge several segments together at the same time as performing the compaction._
- Segments are never modified after they have been written, so the merged segment is written to a new file.
- The merging and compaction of frozen segments can be done in a background thread, and while it is going on, we can still continue to serve read and write requests as normal, using the old segment files.
- After the merging process is complete, we switch read requests to using the new merged segment instead of the old segments -- and then the old segment files can simply be deleted.

Each segment has its own in-memory hash table, _mapping keys to file offsets._

- _In order to find the value for a key, we first check the most recent segment's hash map; if the key is not present we check the second-most-recent segment, and so on._
- _The merging process keeps the number of segments small, so lookups don't need to check many hash maps._

_Some of the_ issues that are important in a real implementation _are :_

- File format
    CSV is not the best format for a log. It's faster and simpler to use a binary format that first encodes the length of a string in bytes, followed by the raw string (without need for escaping).
- Deleting records
    If you want to delete a key and its associated value, you have to append a special deletion record to the data file (sometimes called a tombstone). When log seg‐ ments are merged, the tombstone tells the merging process to discard any previ‐ ous values for the deleted key.
- Crash recovery
    If the database is restarted, the in-memory hash maps are lost. In principle, you can restore each segment's hash map by reading the entire segment file from beginning to end and noting the offset of the most recent value for every key as you go along. However, that might take a long time if the segment files are large, which would make server restarts painful. Bitcask speeds up recovery by storing a snapshot of each segment's hash map on disk, which can be loaded into mem‐ ory more quickly.
- Partially written records
    The database may crash at any time, including halfway through appending a record to the log. Bitcask files include checksums, allowing such corrupted parts of the log to be detected and ignored.
- Concurrency control
    As writes are appended to the log in a strictly sequential order, a common imple‐ mentation choice is to have only one writer thread. Data file segments are append-only and otherwise immutable, so they can be read concurrently by multiple threads.

_Why don't you update the file in place, overwriting the old value with the new value? But_ an **append-only design** turns out to be good for several reasons:

- Appending and segment merging are sequential write operations, which are generally much faster than random writes, especially on magnetic spinning-disk hard drives.
- _Concurrency and crash recovery are much simpler if segment files are append-only or immutable._
    - For example, you don't have to worry about the case where a crash happened while a value was being overwritten, leaving you with a file containing part of the old and part of the new value spliced together. _( 不用担心旧值和新值混杂在一起的文件 )_
- Merging old segments avoids the problem of data files getting fragmented over time.

Limitations of Hash Table Index

- The hash table must fit in memory, so if you have a very large number of keys, you're out of luck.
    - In principle, you could maintain a hash map on disk, but unfortunately it is difficult to make an on-disk hash map perform well.
    - It requires a lot of random access I/O, it is expensive to grow when it becomes full, and hash collisions require fiddly _( 要求高精度的/复杂的 )_ logic.
- Range queries _( 范围查询 )_ are not efficient.

#### SSTables and LSM-Trees

SSTable : Sorted String Table

- We also require that each key only appears once within each merged segment file ( the compaction process already ensures that ).

SSTables have several big advantages over log segments with hash indexes:

- Merging segments is simple and efficient, even if the files are bigger than the available memory.
    - _( 方便使用归并算法, 将多个输入段并发合并 ( 成一个输出段 ) )_
- In order to find a particular key in the file, you no longer need to keep an index of all the keys in memory.
    - _( 有序的数据, 可以进行范围查询 )_
- _Since read requests need to scan over several key-value pairs in the requested range anyway, it is possible to group those records into a block and compress it before writing it to disk._
    - Each entry of the sparse _( 稀疏的 )_ in-memory index then points at the start of a compressed block.
    - _Besides saving disk space, compression also reduces the I/O bandwidth use._

Making an LSM-tree out of SSTables

- Lucene, an indexing engine for full-text search used by Elasticsearch and Solr, uses a similar method for storing its term dictionary.
    - _A full-text index is much more complex than a key-value index but is based on a similar idea : given a word in a search query, find all the documents (web pages, product descriptions, etc.) that mention the word._
    - _This is implemented with a key-value structure where the key is a word (a term) and the value is the list of IDs of all the documents that contain the word (the postings list)._
    - In Lucene, this mapping from term to postings list is kept in SSTable-like sorted files, which are merged in the background as needed.

Performance optimizations

- The LSM-tree algorithm can be slow when looking up keys that do not exist in the database : you have to check the memtable, then the segments all the way back to the oldest ( possibly having to read from disk for each one ) before you can be sure that the key does not exist.
    - _In order to optimize this kind of access, storage engines often use additional_ **Bloom filters**.
    - _( A Bloom filter is a memory-efficient data structure for approximating the contents of a set. It can tell you if a key does not appear in the database, and thus saves many unnecessary disk reads for nonexistent keys. )_
- _There are also different strategies to determine the order and timing of how SSTables are compacted and merged._
    - _The most common options are size-tiered and leveled compaction._
    - _LevelDB and RocksDB use leveled compaction ( hence the name of LevelDB ), HBase uses size-tiered, and Cassandra supports both._
    - In **size-tiered compaction**, newer and smaller SSTables are successively merged into older and larger SSTables.
    - In **leveled compaction**, the key range is split up into smaller SSTables and older data is moved into separate "levels", which allows the compaction to proceed more incrementally and use less disk space.

#### B-Tree

- B-trees break the database down into fixed-size blocks or pages, traditionally 4 KB in size ( sometimes bigger ), and read or write one page at a time.
    - _This design corresponds more closely to the underlying hardware, as disks are also arranged in fixed-size blocks._
- _Each page can be identified using an address or location, which allows one page to refer to another -- similar to a pointer, but on disk instead of in memory._
    - _We can use these page references to construct a tree of pages_
- The number of references to child pages in one page of the B-tree is called the **branching factor**.
    - _In practice, the branching factor depends on the amount of space required to store the page references and the range boundaries, but typically it is several hundred._

#### Comparing B-Trees and LSM-Trees

Advantages of LSM-trees

- Log-structured indexes also rewrite data multiple times due to repeated compaction and merging of SSTables.
    - This effect -- one write to the database resulting in multiple writes to the disk over the course of the database's lifetime -- is known as **write amplification**.
    - _It is of particular concern on SSDs, which can only overwrite blocks a limited number of times before wearing out._
- _In write-heavy applications, the performance bottleneck might be the rate at which the database can write to disk._
    - LSM-trees are typically able to sustain higher write throughput than B-trees, partly because they sometimes have lower write amplification ( although this depends on the storage engine configuration and workload ), and partly because they sequentially write compact SSTable files rather than having to overwrite several pages in the tree.
    - _( 写入性能, 部分受制于 "写入放大" 的问题 )_

Downsides of LSM-trees

- The compaction process can sometimes interfere with the performance of ongoing reads and writes.
    - _Even though storage engines try to perform compaction incrementally and without affecting concurrent access, disks have limited resources, so it can easily happen that_ a request needs to wait while the disk finishes an expensive compaction operation.
    - The impact on throughput and average response time is usually small, but at higher percentiles the response time of queries to log-structured storage engines can sometimes be quite high, and B-trees can be more predictable.
    - _( 压缩过程有时会干扰读写; LSM-Tree 写入速度通常很快, 但偶尔会很慢, 而 B-tree 速度更稳定可预测 )_
- _The disk's finite write bandwidth needs to be shared between the initial write ( logging and flushing a memtable to disk ) and the compaction threads running in the background._
    - _When writing to an empty database, the full disk bandwidth can be used for the initial write,_ but the bigger the database gets, the more disk bandwidth is required for compaction.
    - _( 存储的数据越多, 压缩过程需要更多的磁盘I/O带宽, 会导致写入性能下降 )_
- If write throughput is high and compaction is not configured carefully, it can happen that compaction cannot keep up with the rate of incoming writes.
    - _( 压缩速度跟不上写速度 )_
- _An advantage of B-trees is that each key exists in exactly one place in the index, whereas a log-structured storage engine may have multiple copies of the same key in different segments._
    - This aspect makes B-trees attractive in databases that want to offer strong transactional semantics : in many relational databases, **transaction isolation is implemented using locks on ranges of keys**, and in a B-tree index, those locks can be directly attached to the tree.
    - _( B-Tree 比 LSM-Tree 加锁更容易, 便于实现事务 )_

#### Other Indexing Structures

Storing values within the index

- _The key in an index is the thing that queries search for, but the value can be one of two things :_ it could be the actual row (document, vertex) in question, or it could be **a reference to the row stored elsewhere**.
    - In the latter case, the place where rows are stored is known as a **heap file**, and it stores data in no particular order _( it may be append-only, or it may keep track of deleted rows in order to overwrite them with new data later )._
    - _The heap file approach is common because it_ avoids duplicating data when multiple secondary indexes are present : each index just references a location in the heap file, and the actual data is kept in one place.
- _When updating a value without changing the key, the heap file approach can be quite efficient: the record can be overwritten in place, provided that the new value is not larger than the old value._
    - _The situation is more complicated if the new value is larger, as it probably needs to be moved to a new location in the heap where there is enough space._
    - In that case, either all indexes need to be updated to point at the new heap location of the record, or a forwarding pointer _( 间接指针 )_ is left behind in the old heap location.

**Clustered Index** _( 聚集索引 )_

- In some situations, the extra hop _( 跳转 )_ from the index to the heap file is too much of a performance penalty for reads, so it can be desirable to **store the indexed row directly within an index**.
- For example, **in MySQL's InnoDB storage engine, the primary key of a table is always a clustered index, and secondary indexes refer to the primary key ( rather than _( 而不是 )_ a heap file location )

**Covering Index** _( 覆盖索引 )_

- A compromise between a clustered index ( storing all row data within the index ) and a **nonclustered index** ( storing only references to the data within the index ) is known as a **covering index** or index with included columns, which **stores some of a table's columns within the index**.
    - This allows some queries to be answered by using the index alone ( in which case, **the index is said to cover the query** ) .

Multi-column indexes _( 多列索引 )_

- _omitted…_

Keeping everything in memory

- _Products such as VoltDB, MemSQL, and Oracle TimesTen are in-memory databases with a relational model, and the vendors claim that they can offer big performance improvements by removing all the overheads associated with managing on-disk data structures._
    - _RAMCloud is an open source, in-memory key-value store with durability ( using a log-structured approach for the data in memory as well as the data on disk ) ._
    - Redis and Couchbase provide weak durability by writing to disk asynchronously.
- Counterintuitively, the performance advantage of in-memory databases is not due to the fact that they don't need to read from disk.
    - Rather, they can be faster because they can **avoid the overheads of encoding in-memory data structures in a form that can be written to disk**.

### Transaction Processing or Analytics?

**Transaction** : referring to a group of reads and writes that form a logical unit.

- _A transaction needn't necessarily have ACID (atomicity, consis‐ tency, isolation, and durability) properties._
- _Transaction processing just means allowing clients to make low-latency reads and writes -- as opposed to batch processing jobs, which only run periodically (for example, once per day)._

OLTP

- _An application typically looks up a small number of records by some key, using an index. Records are inserted or updated based on the user's input._
    - Because these applications are interactive, the access pattern became known as **online transaction processing ( OLTP )** .

OLAP

- _Queries for data analytics are often written by business analysts, and feed into reports that help the management of a company make better decisions (business intelligence)._
    - In order to differentiate this pattern of using databases from transaction processing, it has been called **online analytic processing ( OLAP )** .

|Property|Transaction processing systems (OLTP)|Analytic systems (OLAP)|
|-|-|-|
|Main read pattern|Small number of records per query, fetched by key|Aggregate over large number of records |
|Main write pattern|Random-access, low-latency writes from user input|Bulk import (ETL) or event stream|
|Primarily used by|End user/customer, via web application|Internal analyst, for decision support |
|What data represents|Latest state of data (current point in time)|History of events that happened over time|
|Dataset size|Gigabytes to terabytes (GB~TB)|Terabytes to petabytes (TB~PB)|

#### Data Warehousing

- These OLTP systems are usually expected to be highly available and to process transactions with low latency, since they are often critical to the operation of the business.
    - They are usually reluctant _( 不情愿的 )_ to let business analysts run ad hoc analytic queries on an OLTP database, since those queries are often expensive, scanning large parts of the dataset, which can harm the performance of concurrently executing transactions.
- A **data warehouse**, by contrast, is a separate database that analysts can query to their hearts' content, without affecting OLTP operations.
    - The data warehouse contains a read-only copy of the data in all the various OLTP systems in the company.
    - Data is extracted from OLTP databases (using either a periodic data dump or a continuous stream of updates), transformed into an analysis-friendly schema, cleaned up, and then loaded into the data warehouse.
    - This process of getting data into the warehouse is known as **Extract–Transform–Load (ETL)**.

The divergence between OLTP databases and data warehouses

- The data model of a data warehouse is most commonly relational, because SQL is generally a good fit for analytic queries.
    - _There are many graphical data analysis tools that generate SQL queries, visualize the results, and allow analysts to explore the data_ ( _through operations such as_ drill-down and slicing and dicing _( 向下钻取 / 切片 / 切丁 )_ ).
- _On the surface, a data warehouse and a relational OLTP database look similar, because they both have a SQL query interface._
    - _However, the internals of the systems can look quite different, because they are optimized for very different query patterns._
    - Many database vendors now focus on supporting either transaction processing or analytics workloads, but not both.

Stars and Snowflakes: Schemas for Analytics

- Many data warehouses are used in a fairly formulaic _( 公式化的 )_ style, known as a **star schema** _( 星型模式 )_ ( also known as dimensional modeling _( 维度建模 )_ ).
    - At the center of the schema is a so-called **fact table** _( 事实表 )_ .
        - _Each row of the fact table represents_ an event that occurred at a particular time.
        - _Usually, facts are captured as individual events, because this allows maximum flexibility of analysis later._
        - _However, this means that the fact table can become extremely large._
        - Some of the columns in the fact table are **attributes**.
    - Other columns in the fact table are foreign key references to other tables, called **dimension tables** _( 维度表 )_.
        - _As each row in the fact table represents an event,_ the dimensions represent the who, what, where, when, how, and why of the event.
- A variation of this template is known as the **snowflake schema** _( 雪花模型 )_, where dimensions are further broken down into subdimensions.
    - Snowflake schemas are more normalized _( 规范化的 )_ than star schemas, but star schemas are often preferred because they are simpler for analysts to work with.
- In a typical data warehouse, tables are often very wide : fact tables often have over 100 columns, sometimes several hundred.
    - Dimension tables can also be very wide, as they include all the metadata that may be relevant for analysis.

### Column-Oriented Storage

_( 列式存储 )_

- If you have trillions of rows and petabytes of data in your fact tables, storing and querying them efficiently becomes a challenging problem.
    - Dimension tables are usually much smaller ( millions of rows ), so in this section we will concentrate primarily on storage of facts.
- Although fact tables are often over 100 columns wide, a typical data warehouse query only accesses 4 or 5 of them at one time ("SELECT *" queries are rarely needed for analytics).
    - _( icehe : 例如 "外卖骑手群组" 的计算就可能需要超过 4~5 个维度 )_

How can we execute the query efficiently?

- In most OLTP databases, storage is laid out in a row-oriented fashion:
    - all the values from one row of a table are stored next to each other.
- Document databases are similar:
    - an entire document is typically stored as one contiguous sequence of bytes.
- The idea behind column-oriented storage is simple:
    - don't store all the values from one row together, but **store all the values from each column together instead**.
- If each column is stored in a separate file, **a query only needs to read and parse those columns that are used in that query**, which can save a lot of work.
- The column-oriented storage layout relies on **each column file containing the rows in the same order**.

Column Compression

- Besides only loading those columns from disk that are required for a query, we can further reduce the demands on disk throughput by compressing data.
    - _Fortunately, column-oriented storage often lends itself very well to compression._
    - _One technique that is particularly effective in data warehouses is_ **bitmap encoding** _( 位图编码 )_ .
- Often, the number of distinct values in a column is small compared to the number of rows.
    - _( For example, a retailer may have billions of sales transactions, but only 100,000 distinct products )_.
    - We can now take a column with n distinct values and turn it into n separate bitmaps :
        - one bitmap for each distinct value, with one bit for each row.
        - The bit is 1 if the row has that value, and 0 if not.
- If n is very small _( for example, a country column may have approximately 200 distinct values )_, those bitmaps can be stored with one bit per row.
    - But if n is bigger, there will be a lot of zeros in most of the bitmaps ( we say that they are sparse _( 稀疏的 )_ ). In that case, the bitmaps can additionally be **run-length encoded** _( 游程编码 )_.
    - _This can make the encoding of a column remarkably compact._

Column-oriented storage and column families _( 面向列的存储和列族 )_

- Cassandra and HBase have a concept of **column families**, which they inherited from Bigtable.
- _However, it is very misleading to call them column-oriented :_
    - within each column family, they store all columns from a row together, along with a row key, and they do not use column compression.
- Thus, the **Bigtable model is still mostly row-oriented**.

<!--

_Memory bandwidth and vectorized processing_ _( 矢量化处理 )_

- _For data warehouse queries that need to scan over millions of rows,_ a big bottleneck is the bandwidth for getting data from disk into memory.
- _Developers of analytical databases also worry about_ efficiently using the bandwidth from main memory into the CPU cache,
    - avoiding branch mispredictions _( 分支错误预测 )_ and bubbles in the CPU instruction processing pipeline, and making use of **single-instruction-multi-data** ( SIMD ) _( 单指令多数据 )_ instructions in modern CPUs.
- …

-->

_Sort Order in Column Storage_

- _Note that it wouldn't make sense to sort each column independently, because then we would no longer know which items in the columns belong to the same row._
    - _We can only reconstruct a row because we know that_ the kth item in one column belongs to the same row as the kth item in another column.
- …

_Writing to Column-Oriented Storage_

- Most of the load consists of large read-only queries run by analysts.
    - Column-oriented storage, compression, and sorting all help to make those read queries faster.
    - _However, they have the downside of_ making writes more difficult.
- An update-in-place approach, like B-trees use, is not possible with compressed columns.
    - If you wanted to insert a row in the middle of a sorted table, you would most likely have to rewrite all the column files.
    - As rows are identified by their position within a column, the insertion has to update all columns consistently.

## Encoding and Evolution

- _数据编码与演化_
    - _REST - Representational State Transfer ( 具象状态传输 )_
    - _RPC - Remote Procedure Calls ( 远程过程调用 )_

_Old and new versions of the code, and old and new data formats, may potentially all coexist in the system at the same time._ In order for the system to continue running smoothly, we need to **maintain compatibility in both directions**:

- **Backward compatibility** _( 向后兼容 / 向过去兼容 )_
    - Newer code can read data that was written by older code.
- **Forward compatibility** _( 向前兼容 / 向未来兼容 )_
    - Older code can read data that was written by newer code.

### Formats for Encoding Data

_Programs usually work with data in (at least) two different representations:_

- 1\. **In memory**, _data is kept in objects, structs, lists, arrays, hash tables, trees, and so on._
    - _These data structures are optimized for efficient access and manipulation by the CPU ( typically using pointers )._
- 2\. _When you want to write data to a file or send it over the network, you have to encode it as some kind of_ self-contained **sequence of bytes** _( for example, a JSON document )._

_Representation Translation_

- The translation from the in-memory representation to a byte sequence is called **encoding**
    - ( aka. **serialization or marshalling** ),
- and the reverse is called **decoding**
    - ( aka. **parsing, deserialization, unmarshalling** ).

_Terminology Clash_

- **Serialization** _is unfortunately also used in the context of transactions, with a completely different meaning._
- _To avoid overloading the word we'll stick with **encoding** ( in this book ) , even though serialization is perhaps a more common term._

### Language-Specific Formats

_Many programming languages come with_ built-in support for encoding in-memory objects into byte sequences. _For example :_

- Java : java.io.Serializable
    - _Third-party : Kryo_
- Ruby : Marshal
- Python : pickle
- …

_Some deep problems of using programming language built-in encoding libraries : ( 详见原书, 以下简述 )_

- _数据编码跟编程语言绑定 : 一个编程语言难以解析另一个编程语言编码的数据_
- _为了能够成功解码, 允许实例化任何类; 这可能导致允许执行任意代码, 破坏程序_
    - _In order to restore data in the same object types, the decoding process needs to_ be able to instantiate arbitrary classes.
    - _This is frequently a source of security problems : if an attacker can get your application to decode an arbitrary byte sequence, they can instantiate arbitrary classes, which in turn often allows them to do terrible things such as remotely executing arbitrary code._
- _比起编码结构的兼容性, 更优先考虑编码过程的快速和简便_
    - Versioning data is often an afterthought _in these libraries :_
        - _as they are intended for quick and easy encoding of data,_
        - _they often neglect the inconvenient problems of forward and backward compatibility._
- Efficiency ( CPU time taken to encode or decode, and the size of the encoded structure ) is also often an afterthought.
    - _For example, Java's built-in serialization is notorious for its bad performance and bloated encoding._

### JSON, XML, and Binary Variants

_JSON, XML, and CSV are textual formats, and thus somewhat human-readable (although the syntax is a popular topic of debate). Besides the superficial syntactic issues, they also have some subtle problems : ( 详见原书, 以下简述 )_

- _浮点数精度丢失问题 : JavaScript 的 Number 只支持 2^53 的精度_
- _支持 Unicode, 但二进制编码只能转换为 Base64 的 ASCII 文本存储, 数据大小膨胀 33%_
- _模式 ( schema ) 支持不够便捷, 需要硬编码适当的编码/解码逻辑_
- _CSV 没有任何 schema, 语法较弱, 不是所有解析器都能正确处理转义符以及逗号的转义_

_Binary encoding ( 二进制编码 )_

- _JSON is less verbose than XML, but both still use a lot of space compared to binary formats._
- _This observation led to the development of a profusion of binary encodings for JSON and for XML._
    - JSON : MessagePack, BSON, BJSON, UBJSON, BISON, Smile / …
    - XML : WBXML / Fast Infoset / …
- _MessagePack format example ( 详见原书例 )_

Thrift and Protocol Buffers

- **Apache Thrift** and **Protocol Buffers (protobuf)** are binary encoding libraries that are based on the same principle.
    - _Protocol Buffers from Google_
    - _Thrift from Facebook_
- Both Thrift and Protocol Buffers require a **schema** for any data that is encoded.
    - Thrift : You would describe the schema in the **Thrift interface definition language ( IDL )**

```cpp
# Thrift interface definition language
struct Person {
    1: required string userName,
    2: optional i64 favoriteNumber,
    3: optional list<string> interests
}

# Protocol Buffers
message Person {
    required string user_name       = 1;
    optional int64  favorite_number = 2;
    repeated string interests       = 3;
}
```

_Confusingly, Thrift has 2 different binary encoding formats :_

- _BinaryProtocol_
- _CompactProtocol_
- _( DenseProtocol 只支持 C++ 实现, 没有跨语言实现 )_ …

_Avro_

- _Apache Avro is another binary encoding format that is interestingly different from Protocol Buffers and Thrift._
- _It was started in 2009 as a subproject of Hadoop, as a result of Thrift not being a good fit for Hadoop's use cases._
- _Avro also uses a schema to specify the structure of the data being encoded._
    - _It has two schema languages : one (Avro IDL) intended for human editing, and one (based on JSON) that is more easily machine-readable._
- _The writer's schema and the reader's schema_
    - The key idea with Avro is that the writer's schema and the reader's schema don't have to be the same -- they only need to be compatible.
    - _When data is decoded (read), the Avro library resolves the differences by looking at the writer's schema and the reader's schema side by side and translating the data from the writer's schema into the reader's schema._
        - _If the writer's schema and the reader's schema have their fields in a different order, because the schema resolution matches up the fields by field name._
        - _If the code reading the data encounters a field that appears in the writer's schema but not in the reader's schema, it is ignored._
        - _If the code reading the data expects some field, but the writer's schema does not contain a field of that name, it is filled in with a default value declared in the reader's schema._
- _( 其它详见原书 )_

### Modes of Dataflow

_The most common ways how data flows between processes:_

- Via databases
- Via service calls _( REST and RPC )_
- Via asynchronous message passing

#### Dataflow Through Services: REST and RPC

- _This approach is often used to decompose a large application into smaller services by area of functionality, such that one service makes a request to another when it requires some functionality or data from that other service._
    - _This way of building applications has traditionally been called a_ **service-oriented architecture (SOA)**, _more recently refined and rebranded as_ **microservices architecture**.
- A key design goal of a service-oriented/microservices architecture is
    - to make the application easier to change and maintain by making services independently deployable and evolvable.
- _For example, each service should be owned by one team, and that team should be able to release new versions of the service frequently, without having to coordinate with other teams._
- _In other words, we should expect old and new versions of servers and clients to be running at the same time, and so the data encoding used by servers and clients must be compatible across versions of the service API— precisely what we've been talking about in this chapter. ( icehe : 注意不要破坏兼容性 )_

_The problems with remote procedure calls (RPCs)_

- The RPC model tries to **make a request to a remote network service look the same as calling a function or method in your programming language, within the same process** ( this abstraction is called **flocation transparency** ).
- _Although RPC seems convenient at first, the approach is fundamentally flawed._

_A network request is very different from a local function call:_

- A local function call is predictable and either succeeds or fails, depending only on parameters that are under your control. _( 不可预测 )_
    - A network request is unpredictable: the request or response may be lost due to a network problem, or the remote machine may be slow or unavailable, and such problems are entirely outside of your control.
    - _Network problems are common, so you have to anticipate them, for example by retrying a failed request._
- _A local function call either returns a result, or throws an exception, or never returns (because it goes into an infinite loop or the process crashes). ( icehe : 意外情况导致更多的返回结果类型, 例如超时失败 )_
    - _A network request has another possible outcome: it may return without a result, due to a timeout._
    - _In that case, you simply don't know what happened: if you don't get a response from the remote service, you have no way of knowing whether the request got through or not._
- If you retry a failed network request, it could happen that the requests are actually getting through, and only the responses are getting lost. _( 幂等性问题 )_
    - In that case, retrying will cause the action to be performed multiple times, unless you build a mechanism for deduplication ( **idempotence** 幂等 ) into the protocol.
    - _Local function calls don't have this problem._
- _Every time you call a local function, it normally takes about the same time to execute. ( 不可控的响应时长 )_
    - _A network request is much slower than a function call, and its latency is also wildly variable: at good times it may complete in less than a millisecond, but when the network is congested or the remote service is overloaded it may take many seconds to do exactly the same thing._
- When you call a local function, you can efficiently pass it references (pointers) to objects in local memory. _( 无法传指针; 可能要传递的参数是很大的对象 )_
    - _When you make a network request, all those parameters need to be encoded into a sequence of bytes that can be sent over the network._
    - _That's okay if the parameters are primitives like numbers or strings, but quickly becomes problematic with larger objects._
- _The client and the service may be implemented in different programming languages, so the RPC framework must translate datatypes from one language into another._
    - _This can end up ugly, since not all languages have the same types -- recall JavaScript's problems with numbers greater than 2^53, for example._
        - _This problem doesn't exist in a single process written in a single language._

#### Message-Passing Dataflow

**Asynchronous message-passing systems** _are somewhere between RPC and databases_

- _They are similar to RPC in that_ a client's request ( usually called a **message** ) is delivered to another process with low latency.
- _They are similar to databases in that_ the message is not sent via a direct network connection, but goes via an intermediary called a **message broker** ( also called a **message queue** or **message-oriented middleware** ), which stores the message temporarily.

_Using a message broker has several advantages compared to direct RPC :_

- It can **act as a buffer** if the recipient is unavailable or overloaded,
    - _and thus improve system reliability._
- It can **automatically redeliver** messages to a process that has crashed,
    - _and thus prevent messages from being lost._
- _It avoids the sender needing to know the IP address and port number of the recipient_
    - _( which is particularly useful in a cloud deployment where virtual machines often come and go )_.
- It allows one message to be **sent to several recipients**.
- It logically **decouples the sender from the recipient**
    - _( the sender just publishes messages and doesn't care who consumes them )._

_Message brokers_

- _omitted…_

_Distributed **actor** frameworks_

- The actor model is a programming model for concurrency in a single process.
    - _Each actor typically represents one client or entity, it may have some local state ( which is not shared with any other actor ), and it communicates with other actors by sending and receiving asynchronous messages._
    - _Message delivery is not guaranteed : in certain error scenarios, messages will be lost._
    - _Since each actor processes only one message at a time, it doesn't need to worry about threads, and each actor can be scheduled independently by the framework._
- **Location transparency** _( 位置透明性 ) works better in the actor model than in RPC, because the actor model already assumes that_ messages may be lost, even within a single process.
- _omitted…_

---

> Part II. Distributed Data

_There are various reasons why you might want to distribute a database across multiple machines:_

- Scalability _( 可伸缩性 / 拓展性 )_
    - If your data volume, read load, or write load grows bigger than a single machine can handle, you can potentially spread the load across multiple machines.
- Fault tolerance / high availability _( 容错性 / 高可用性 )_
    - If your application needs to continue working even if one machine (or several machines, or the network, or an entire datacenter) goes down, you can use multiple machines to give you redundancy.
    - When one fails, another one can take over _( 接管 )_.
- Latency _( 延迟 )_
    - If you have users around the world, you might want to have servers at various locations worldwide so that each user can be served from a datacenter that is geographically close to them.
    - That avoids the users having to wait for network packets to travel halfway around the world.

Scaling to Higher Load

- **Shared-memory** Architecture _( 共享内存架构 )_
    - If all you need is to scale to higher load, the simplest approach is to buy a more powerful machine ( sometimes called **vertical scaling or scaling up** ). _( 垂直拓展 )_
        - _Many CPUs, many RAM chips, and many disks can be joined together under one operating system, and a fast interconnect allows any CPU to access any part of the memory or disk._
        - In this kind of shared-memory architecture, all the components can be treated as a single machine.
    - _The problem with a shared-memory approach is that_ **the cost grows faster than linearly**.
        - _( 设备的性能提升, 不能一定能带来同样比例的负载提升 )_
    - _A shared-memory architecture may offer_ limited fault tolerance.
        - _It is definitely_ limited to a single geographic location.
        - _( 局限于地理位置, 无法提供异地容错能力 )_
- **Shared-disk** Architecture _( 共享存储架构 )_
    - It uses several machines with independent CPUs and RAM,
        - but stores data on an array of disks that is shared between the machines, which are connected via a fast network.
    - This architecture is used for some **data warehousing workloads**,
        - but contention and the overhead of locking limit the scalability of the shared-disk approach.
        - _( 资源竞争以及锁的开销限制了进一步的伸缩性/拓展性 )_
- **Shared-Nothing** Architectures _( 无共享架构 )_
    - It's sometimes called **horizontal scaling or scaling out**. _( 水平拓展 )_
    - _In this approach, each machine or virtual machine running the database software is called a **node**._
        - _Each node uses its CPUs, RAM, and disks independently._
        - Any coordination between nodes is done at the software level, using a conventional network.
    - _No special hardware is required by a shared-nothing system, so you can use whatever machines have the best price/performance ratio._
        - You can potentially distribute data across multiple geographic regions, and thus reduce latency for users and potentially be able to survive the loss of an entire datacenter.
        - _( icehe : 但实际上为了方便运维, 通常只提供少数几种标准配置类型的服务节点实例 : 存储型 / 计算型 / 内存型 / … )_
    - _While a distributed shared-nothing architecture has many advantages,_
        - _it usually also **incurs additional complexity** for applications and sometimes limits the expressiveness of the data models you can use._

Replication Versus Partitioning

- **Replication** _( 复制 )_
    - **Keeping a copy of the same data on several different nodes**, _potentially in different locations._
    - _Replication_ provides redundancy :
        - if some nodes are unavailable, the data can still be served from the remaining nodes.
    - _Replication can also help_ improve performance.
- **Partitioning** _( 分区 )_
    - Splitting a big database into smaller subsets called partitions
        - so that different partitions can be assigned to different nodes ( also known as **sharding** ) _( 分片 )_ .

## Replication

Replication means

- **keeping a copy of the same data on multiple machines that are connected via a network**.

_There are several reasons why you might want to replicate data :_

- To keep data geographically close to your users ( and thus **reduce latency** )
- To allow the system to continue working even if some of its parts have failed ( and thus **increase availability** )
- To scale out the number of machines that can serve read queries ( and thus increase **read throughput** )

_Three popular algorithms for replicating changes between nodes :_

- **Single-leader** replication _( 单主节点复制 -- 主从复制 )_
- **Multi-leader** replication _( 多主节点复制 )_
- **Leaderless** replication _( 无主节点复制 )_

### Leaders and Followers

_( 主节点与从节点 )_

- Each node that stores a copy of the database is called a **replica**.

_How do we ensure that all the data ends up on all the replicas?_

- _Every write to the database needs to be processed by every replica._

The most common solution for this is called **leader-based replication ( aka. active/passive or master–slave replication )** . It works as follows:

- 1\. One of the replicas is designated the **leader ( aka. master or primary )** .
    - When clients want to write to the database, they **must send their requests to the leader**, which first writes the new data to its local storage.
- 2\. The other replicas are known as **followers ( read replicas, slaves, secondaries, or hot standbys )** .
    - Whenever the leader writes new data to its local storage, it also sends the data change to all of its followers as part of a replication log or change stream.
    - Each follower takes the log from the leader and updates its local copy of the database accordingly, by applying all **writes in the same order as they were processed on the leader**.
- 3\. When a client wants to read from the database, it can query either the leader or any of the followers.
    - However, writes are only accepted on the leader ( the followers are read-only from the client's point of view ).

_This mode of replication is a built-in feature of many relational databases_

#### Synchronous Versus Asynchronous Replication

_( 同步复制与异步复制 )_

_In the example of the following image :_

- The replication to follower 1 is **synchronous**.
    - The leader waits until follower 1 has confirmed that it received the write before reporting success to the user, and before making the write visible to other clients.
- The replication to follower 2 is **asynchronous**.
    - The leader sends the message, but doesn't wait for a response from the follower.

![sync_n_async_replication.png](_images/designing-data-intensive-applications/sync_n_async_replication.png)

_For that reason, it is impractical for all followers to be synchronous :_

- _any one node outage would cause the whole system to grind to a halt._
- In practice, if you enable synchronous replication on a database, it usually means that one of the followers is synchronous, and the others are asynchronous.
    - If the synchronous follower becomes unavailable or slow, one of the asynchronous followers is made synchronous.
    - This guarantees that you have an up-to-date copy of the data on at least two nodes : the leader and one synchronous follower.
    - This configuration is sometimes also called **semi-synchronous**. _( 半同步 )_
    - _( 保证主节点和其中一个从节点拥有最新的数据副本 )_

Often, leader-based replication is configured to be completely asynchronous.

- In this case, if the leader fails and is not recoverable, any writes that have not yet been replicated to followers are lost.
    - This means that a write is not guaranteed to be durable, even if it has been confirmed to the client.
    - However, a fully asynchronous configuration has the advantage that the leader can continue processing writes, even if all of its followers have fallen behind.
    - _( 虽然无法保证数据的持久化, 但是写吞吐量更好 )_
- _Weakening durability may sound like a bad trade-off,_
    - _but asynchronous replication is nevertheless widely used, especially if there are many followers or if they are geo‐ graphically distributed._

_Setting Up New Followers_

- _omitted…_

#### Handling Node Outages

- _Any node in the system can go down, perhaps unexpectedly due to a fault, but just as likely due to planned maintenance._
- _Our goal is to keep the system as a whole running despite individual node failures, and to keep the impact of a node outage as small as possible._

_How do you achieve high availability with leader-based replication?_

**Follower failure : Catch-up recovery** _( 从节点失效 : 追赶式恢复 )_

- On its local disk, each follower keeps a log of the data changes it has received from the leader.
- _If a follower crashes and is restarted, or if the network between the leader and the follower is temporarily interrupted, the follower can recover quite easily :_
    - from its log, it knows the last transaction that was processed before the fault occurred.
- Thus, the follower can connect to the leader and request all the data changes that occurred during the time when the follower was disconnected.
    - _When it has applied these changes, it has caught up to the leader and can continue receiving a stream of data changes as before._

**Leader failure : Failover** _( 主节点失效 : 节点切换 )_

- **failover** : _Handling a failure of the leader is trickier ( 棘手的 ) :_
    - one of the followers needs to be promoted to be the new leader,
    - clients need to be reconfigured to send their writes to the new leader,
    - and the other followers need to start consuming data changes from the new leader.
- _Failover can happen manually or automatically. An automatic failover process usually consists of the following steps :_
    - 1\. Determining that the leader has failed.
        - There is no foolproof _( 万无一失的 )_ way of detecting what has gone wrong, so most systems simply use a timeout :
            - nodes frequently bounce messages back and forth between each other,
            - and if a node doesn't respond for some period of time -- say, 30 seconds -- it is assumed to be dead.
            - _( If the leader is deliberately taken down for planned maintenance, this doesn't apply. )_
    - 2\. Choosing a new leader.
        - This could be done through an election process ( where the leader is chosen by a majority of the remaining replicas ), or a new leader could be appointed by a previously elected controller node.
        - The best candidate for leadership is usually the replica with the most up-to-date data changes from the old leader ( to minimize any data loss ).
        - Getting all the nodes to agree on a new leader is a consensus problem.
    - 3\. Reconfiguring the system to use the new leader.
        - Clients now need to send their write requests to the new leader.
        - If the old leader comes back, it might still believe that it is the leader, not realizing that the other replicas have forced it to step down.
        - The system needs to ensure that the old leader becomes a follower and recognizes the new leader.
- _Failover is fraught ( 忧虑的 ) with things that can go wrong: ( 充满很多变数 )_
    - If asynchronous replication is used, the new leader may not have received all the writes from the old leader before it failed.
        - If the former leader rejoins the cluster after a new leader has been chosen, what should happen to those writes?
            - The new leader may have received conflicting writes in the meantime.
        - The most common solution is for the old leader's unreplicated writes to simply be discarded, _which may violate clients' durability expectations._
    - Discarding writes is especially dangerous if other storage systems outside of the database need to be coordinated with the database contents.
        - _omitted…_
    - In certain fault scenarios _( 情景 )_, it could happen that two nodes both believe that they are the leader.
        - This situation is called **split brain** _( 脑裂 )_, and it is dangerous :
            - if both leaders accept writes, and there is no process for resolving conflicts, data is likely to be lost or corrupted.
        - As a safety catch, some systems have a mechanism to shut down one node if two leaders are detected.
        - However, if this mechanism is not carefully designed, you can end up with both nodes being shut down.
    - What is the right timeout before the leader is declared dead?
        - A longer timeout means a longer time to recovery in the case where the leader fails.
        - However, if the timeout is too short, there could be unnecessary failovers.
            - _For example, a temporary load spike could cause a node's response time to increase above the timeout, or a network glitch could cause delayed packets._
        - If the system is already struggling with high load or network problems, an unnecessary failover is likely to make the situation worse, not better.

#### Implementation of Replication Logs

**Statement-based replication** _( 基于语句的复制 )_

- In the simplest case, the leader logs every write request ( statement ) that it executes and sends that statement log to its followers.
    - _For a relational database, this means that every INSERT, UPDATE, or DELETE statement is forwarded to followers, and each follower parses and executes that SQL statement as if it had been received from a client._
- _Although this may sound reasonable, there are various ways in which_ this approach to replication can break down :
    - _Any statement that calls a nondeterministic function, such as NOW() to get the current date and time or RAND() to get a random number, is likely to generate a different value on each replica._
    - _If statements use an autoincrementing column, or if they depend on the existing data in the database ( e.g., UPDATE ... WHERE <some condition> ), they must be executed in exactly the same order on each replica, or else they may have a differ‐ ent effect._
        - _This can be limiting when there are multiple concurrently executing transactions._
    - _Statements that have side effects ( e.g., triggers, stored procedures, user-defined functions ) may result in different side effects occurring on each replica, unless the side effects are absolutely deterministic._
- _It is possible to work around those issues._
    - _For example,_ the leader can replace any nondeterministic function calls with a fixed return value when the statement is logged so that the followers all get the same value.
    - _However, because there are so many edge cases, other replication methods are now generally preferred._
- Statement-based replication was used in MySQL before version 5.1.
    - It is still sometimes used today, as it is quite compact, but **by default MySQL now switches to row-based replication** if there is any nondeterminism in a statement.

**Write-ahead log (WAL) shipping** _( 基于预写日志的传输 )_

- _We found that_ **usually every write is appended to a log** :
    - In the case of a log-structured storage engine, this log is the **main place for storage**.
        - Log segments are compacted and garbage-collected in the background.
    - In the case of a B-tree, which overwrites individual disk blocks, **every modification is first written to a write-ahead log so that the index can be restored to a consistent state after a crash**.
- _The main disadvantage is that the log describes the data on a very low level : a WAL contains details of which bytes were changed in which disk blocks._
    - _This makes replication closely coupled to the storage engine._
    - If the database changes its storage format from one version to another, it is typically not possible to run different versions of the database software on the leader and the followers.

**Logical (row-based) log replication** _( 基于行的逻辑日志复制 )_

- _An alternative is to use different log formats for replication and for the storage engine, which_ allows the replication log to be decoupled from the storage engine internals.
    - This kind of replication log is called a **logical log**, to distinguish it from the storage engine's ( physical ) data representation.
- A logical log for a relational database is usually **a sequence of records describing writes to database tables at the granularity of a row** : _( 一系列记录来描述数据表行级别的请求 )_
    - For an inserted row, the log contains the new values of all columns.
    - For a deleted row, the log contains enough information to uniquely identify the row that was deleted.
        - _Typically this would be the primary key, but if there is no primary key on the table, the old values of all columns need to be logged._
    - For an updated row, the log contains enough information to uniquely identify the updated row, and the new values of all columns ( or at least the new values of all columns that changed ).
- A transaction that modifies several rows generates several such log records, followed by a record indicating that the transaction was committed.
    - _MySQL's **binlog** ( when configured to use row-based replication ) uses this approach._
- _A logical log format is also easier for external applications to parse._
    - _This aspect is useful if you want to send the contents of a database to an external system, such as a data warehouse for offline analysis, or for building custom indexes and caches._
    - This technique is called **change data capture** _( 变更数据捕获 )_ .

Trigger-based replication _( 基于触发器的复制 )_

- _omitted…_

### Problems with Replication Lag

_( 复制滞后问题 )_

The followers will eventually catch up and become consistent with the leader. For that reason, this effect is known as **eventual consistency** _( 最终一致性 )_ .

- _When the lag is so large, the inconsistencies it introduces are not just a theoretical issue but a real problem for applications._

#### Reading Your Own Writes

_( 读自己的写 )_

_( icehe : 很常见的解决思路/套路, 必须记住的常识 )_

_If the user views the data shortly after making a write, the new data may not yet have reached the replica._

- _To the user, it looks as though the data they submitted was lost, so they will be understandably unhappy._

![read-your-own-writes.png](_images/designing-data-intensive-applications/read-your-own-writes.png)

In this situation, we need **read-after-write consistency**, also known as **read-your-writes consistency**.

- This is a guarantee that if the user reloads the page, they will always see any updates they submitted themselves.
- It makes no promises about other users : other users' updates may not be visible until some later time.
    - _However, it reassures the user that their own input has been saved correctly._

_How can we implement read-after-write consistency in a system with leader-based replication?_

- When reading something that the user may have modified, read it from the leader; otherwise, read it from a follower.
    - _This requires that you have some way of knowing whether something might have been modified, without actually querying it._
    - For example, user profile information on a social network is normally only editable by the owner of the profile, not by anybody else.
        - Thus, a simple rule is : always read the user's own profile from the leader, and any other users' profiles from a follower.
- If most things in the application are potentially editable by the user, that approach won't be effective, as most things would have to be read from the leader ( negating the benefit of read scaling ).
    - _( 如果应用的大多数内容都可能被所有用户修改, 那么以上方法不太有效, 因为它将导致大部分内容都必须经由主节点. 这就丧失了读操作的伸缩性/拓展性 )_
    - _In that case, other criteria may be used to decide whether to read from the leader._
    - _For example, you could track the time of the last update and, for one minute after the last update, make all reads from the leader._
        - _You could also monitor the replication lag on followers and prevent queries on any follower that is more than one minute behind the leader._
- The client can remember the timestamp of its most recent write -- then the system can ensure that the replica serving any reads for that user reflects updates at least until that timestamp.
    - _( 客户端可以记住最新更新时的时间戳, 并附在读请求中, 根据此信息, 系统可以确保对该用户提供都服务时, 都至少包含了该时间戳的更新 )_
    - _If a replica is not sufficiently up to date, either the read can be handled by another replica or the query can wait until the replica has caught up._
    - _The timestamp could be a logical timestamp ( something that indicates ordering of writes, such as the log sequence number ) or the actual system clock ( in which case clock synchronization becomes critical ) ._
- _If your replicas are distributed across multiple datacenters ( for geographical proximity to users or for availability ), there is additional complexity._
    - Any request that needs to be served by the leader must be routed to the datacenter that contains the leader.

_Another complication arises_ when the same user is accessing your service from multiple devices, _for example a desktop web browser and a mobile app._

In this case you may want to provide **cross-device read-after-write consistency** _( 跨越设备的 写后读 一致性 )_ :

- if the user enters some information on one device and then views it on another device, they should see the information they just entered.

_In this case, there are some additional issues to consider:_

- _Approaches that require remembering the timestamp of the user's last update become more difficult, because the code running on one device doesn't know what updates have happened on the other device._
    - _This metadata will need to be centralized._
- _If your replicas are distributed across different datacenters, there is no guarantee that connections from different devices will be routed to the same datacenter._
    - _( For example, if the user's desktop computer uses the home broadband connection and their mobile device uses the cellular data network, the devices' network routes may be completely different. )_
    - If your approach requires reading from the leader, you may first need to route requests from all of a user's devices to the same datacenter.
        - _( icehe : 使用用户 ID 来作为路由的依据, 以便路由到同一 数据中心/分片 )_

#### Monotonic Reads

_( 单调读 )_

_( icehe : 保证连续读的情况下, 数据不会来回变化; 展示层常见的缺陷/bug )_

A user first reads from a fresh replica, then from a stale _( 不新鲜的 )_ replica. Time appears to go backward.

- To prevent this anomaly _( 异常/反常 )_ , we need **monotonic reads**.

![monotonic-reads.png](_images/designing-data-intensive-applications/monotonic-reads.png)

Monotonic reads is a guarantee that this kind of anomaly does not happen.

- _It's a lesser guarantee than strong consistency, but a stronger guarantee than eventual consistency._
- When you read data, you may see an old value; monotonic reads only means that if one user makes several reads in sequence, they will not see time go backward .
    - _i.e., they will not read older data after having previously read newer data._

#### Consistent Prefix Reads

_( 前缀一致读 )_

_( icehe : 即时通讯软件必须解决的问题! )_

The example of replication lag anomalies concerns violation of causality. _Imagine the following short dialog between Mr. Poons and Mrs. Cake :_

```text
- Mr. Poons : How far into the future can you see, Mrs. Cake?
- Mrs. Cake : About ten seconds usually, Mr. Poons.
```

- _There is a causal dependency between those two sentences : Mrs. Cake heard Mr. Poons's question and answered it._

_Now, imagine a third person is listening to this conversation through followers._

- _The things said by Mrs. Cake go through a follower with little lag, but the things said by Mr. Poons have a longer replication lag. This observer would hear the following :_

```text
- Mrs. Cake : About ten seconds usually, Mr. Poons.
- Mr. Poons : How far into the future can you see, Mrs. Cake?
```

- _To the observer it looks as though Mrs. Cake is answering the question before Mr. Poons has even asked it. Such psychic powers are impressive, but very confusing._

![consistent-prefix-reads.png](_images/designing-data-intensive-applications/consistent-prefix-reads.png)

Preventing this kind of anomaly requires another type of guarantee : **consistent prefix reads**.

- This guarantee says that **if a sequence of writes happens in a certain order, then anyone reading those writes will see them appear in the same order**.

_This is a particular problem in partitioned ( sharded ) databases._

- If the database always applies writes in the same order, reads always see a consistent prefix, so this anomaly cannot happen.
- However, in many distributed databases, different partitions operate independently, so there is no global ordering of writes :
    - _when a user reads from the database, they may see some parts of the database in an older state and some in a newer state._

One solution is to make sure that **any writes that are causally related to each other are written to the same partition**  -- but in some applications that cannot be done efficiently.

- _There are also algorithms that explicitly keep track of causal dependencies._

Solutions for Replication Lag

- _omitted…_

### Multi-Leader Replication

Leader-based replication has one major downside : there is only one leader, and all writes must go through it.

- If you can't connect to the leader for any reason, for example due to a network interruption between you and the leader, you can't write to the database.

A natural extension of the leader-based replication model is to allow more than one node to accept writes.

- _Replication still happens in the same way : each node that processes a write must forward that data change to all the other nodes._
- We call this a **multi-leader** configuration ( aka. **master–master** or **active/active** replication ).
    - _In this setup, each leader simultaneously acts as a follower to the other leaders._

#### Use Cases for Multi-Leader Replication

- It rarely makes sense to use a multi-leader setup within a single datacenter, because the benefits rarely outweigh the added complexity.
    - _( 单机房内使用 "多主节点" 没有意义 )_
- _However, there are some situations in which this configuration is reasonable._

**Multi-datacenter operation** _( 多数据中心 )_

- _Imagine you have a database with replicas in several different datacenters_ ( perhaps so that you can tolerate failure of an entire datacenter, or perhaps in order to be closer to your users ) .
    - In a multi-leader configuration, you can have a leader in each datacenter.
- _Compare how the single-leader and multi-leader configurations fare in a multi-datacenter deployment :_
    - Performance
        - In a single-leader configuration, every write must go over the internet to the datacenter with the leader.
        - This can add significant latency to writes and might contravene the purpose of having multiple datacenters in the first place.
        - In a multi-leader configuration, every write can be processed in the local datacenter and is replicated asynchronously to the other datacenters.
        - _Thus, the inter-datacenter network delay is hidden from users, which means the perceived performance may be better._
    - Tolerance of datacenter outages
        - In a single-leader configuration, if the datacenter with the leader fails, failover can promote a follower in another datacenter to be leader.
        - In a multi-leader configuration, each datacenter can continue operating independently of the others, and replication catches up when the failed datacenter comes back online.
    - Tolerance of network problems
        - Traffic between datacenters usually goes over the public internet, which may be less reliable than the local network within a datacenter.
        - A single-leader configuration is very sensitive to problems in this inter-datacenter link, because writes are made synchronously over this link.
        - A multi-leader configuration with asynchronous replication can usually tolerate network problems better : a temporary network interruption does not prevent writes being processed.
- _Although multi-leader replication has advantages, it also has a big downside :_ the same data may be concurrently modified in two different datacenters, and those write conflicts must be resolved.

**Clients with offline operation** _( 离线客户端操作 )_

- _Another situation in which multi-leader replication is appropriate is_ if you have an application that needs to continue to work while it is disconnected from the internet.
    - Every device has a local database that acts as a leader ( it accepts write requests ), and there is an asynchronous multi-leader replication process ( sync ) between the replicas of your data on all of your devices.
    - _The replication lag may be hours or even days, depending on when you have internet access available._
- _From an architectural point of view, this setup is essentially the same as multi-leader replication between datacenters, taken to the extreme :_ each device is a "datacenter", and the network connection between them is extremely unreliable.
    - _The multi-leader replication is a tricky thing to get right._

**Collaborative editing** _( 协作编辑 )_

- Real-time collaborative editing applications allow several people to edit a document simultaneously.
    - _We don't usually think of collaborative editing as a database replication problem, but it has a lot in common with the previously mentioned offline editing use case._
- When one user edits a document, the changes are instantly applied to their local replica _( the state of the document in their web browser or client application )_ and asynchronously replicated to the server and any other users who are editing the same document.
    - If you want to guarantee that there will be no editing conflicts, the application must obtain a lock on the document before a user can edit it.
    - _If another user wants to edit the same document, they first have to wait until the first user has committed their changes and released the lock._
    - This collaboration model is equivalent to single-leader replication with transactions on the leader.
- However, for faster collaboration, you may want to **make the unit of change very small and avoid locking**.

#### Handling Write Conflicts

Synchronous versus asynchronous conflict detection

- _omitted…_

**Conflict avoidance**

- _The simplest strategy for dealing with conflicts is to avoid them :_ if the application can ensure that all writes for a particular record go through the same leader, then conflicts cannot occur.
    - _Since many implementations of multi-leader replication handle conflicts quite poorly,_ avoiding conflicts is a frequently recommended approach.
- _For example,_ in an application where a user can edit their own data, you can ensure that requests from a particular user are always routed to the same datacenter and use the leader in that datacenter for reading and writing.
    - _Different users may have different "home" datacenters ( perhaps picked based on geographic proximity to the user ) ,_ but from any one user's point of view the configuration is essentially single-leader.
- However, sometimes you might want to change the designated leader for a record --
    - perhaps because one datacenter has failed and you need to reroute traffic to another datacenter, or
    - perhaps because a user has moved to a different location and is now closer to a different datacenter.
- In this situation, conflict avoidance breaks down, and you have to deal with the possibility of concurrent writes on different leaders.

**Converging toward a consistent state** _( 收敛于一致状态 )_

- A single-leader database applies writes in a sequential order : if there are several updates to the same field, the last write determines the final value of the field.
- In a multi-leader configuration, there is no defined ordering of writes, so it's not clear what the final value should be.
- _There are various ways of_ achieving convergent conflict resolution :
    - Give each write a unique ID ( e.g., a timestamp, a long random number, a UUID, or a hash of the key and value ), pick the write with the highest ID as the winner, and throw away the other writes.
        - If a timestamp is used, this technique is known as **last write wins (LWW)**.
        - Although this approach is popular, it is dangerously prone to data loss.
    - Give each replica a unique ID, and let writes that originated at a higher-numbered replica always take precedence over writes that originated at a lower-numbered replica.
        - _This approach also implies data loss._
    - Somehow **merge the values together**
        - e.g., order them alphabetically and then concatenate them.
    - **Record the conflict** in an explicit data structure that preserves all information, and write application code that **resolves the conflict** at some later time ( perhaps by prompting the user ).

**Custom conflict resolution logic** _( 自定义冲突解决逻辑 )_

- _As the most appropriate way of resolving a conflict may_ depend on the application, most multi-leader replication tools let you write conflict resolution logic using appli‐ cation code.
- _That code may be executed on write or on read:_
    - On write
        - As soon as the database system detects a conflict in the log of replicated changes, it calls the conflict handler.
    - On read
        - When a conflict is detected, all the conflicting writes are stored.
        - The next time the data is read, these multiple versions of the data are returned to the applica‐ tion.
        - The application may prompt the user or automatically resolve the conflict, and write the result back to the database.

#### Multi-Leader Replication Topologies

- _omitted…_
    - Circular topology 环形拓扑
    - Star topology 星型拓扑
    - All-to-all topology 全部至全部型拓扑

### Leaderless Replication

_( 无主节点复制 )_

Single-leader and multi-leader replication -- are based on the idea that **a client sends a write request to one node (the leader)**, and the **database system takes care of copying that write to the other replicas**.

- A leader determines the order in which writes should be processed, and followers apply the leader's writes in the same order.

_Some data storage systems take a different approach, abandoning the concept of a leader and_ **allowing any replica to directly accept writes from clients**.

In some leaderless implementations, the client directly sends its writes to several replicas,

- while in others, a **coordinator** node does this on behalf of the client _( 协调者代表客户端进行写入 )_ .
    - However, unlike a leader database, that **coordinator does not enforce a particular ordering of writes**.

#### Writing to the Database When a Node Is Down

_( 节点失效时写入数据库 )_

- Write
    - It's sufficient for 2 out of 3 replicas to acknowledge the write :
        - after client has received 2 ok responses, we consider its write to be successful.
- Read
    - When a client reads from the database, it doesn’t just send its request to one replica :
        - **read requests are also sent to several nodes in parallel**.
    - The client may get different responses from different nodes;
        - i.e., the up-to-date value from one node and a stale value from another.
    - **Version numbers** are used to determine which value is newer.

**Read repair and anti-entropy** _( 读修复与反熵 )_

- Goal : _The replication scheme should_ ensure that eventually all the data is copied to every replica.
- _Two mechanisms are often used in **Dynamo-style datastores** :_
    - **Read repair**
        - When a client makes a read from several nodes in parallel, it can detect any stale responses.
        - The client sees a stale value and writes the newer value back to that replica.
        - This approach works well for values that are frequently read.
    - **Anti-entropy process**
        - In addition, some datastores have a background process that constantly looks for differences in the data between replicas and copies any missing data from one replica to another.
        - _Unlike the replication log in leader-based replication, this anti-entropy process does not copy writes in any particular order, and there may be a significant delay before data is copied._

![quorum-write-read-n-read-repair.png](_images/designing-data-intensive-applications/quorum-write-read-n-read-repair.png)

**Quorums** for reading and writing _( 法定人数 / 法定票数 / 仲裁 )_

- If there are **n replicas**, **every write must be confirmed by w nodes** to be considered successful, and we must **query at least r nodes for each read**.
    - _( In our example, n = 3, w = 2, r = 2. )_ As long as **w + r > n**, _we expect to get an up-to-date value when reading, because_ at least one of the r nodes we’re reading from must be up to date.
    - Reads and writes that obey these r and w values are called **quorum reads and writes** _( 法定票数读/仲裁读 , 法定票数写/仲裁写 )_ .
    - _You can think of r and w as the minimum number of votes required for the read or write to be valid._
- _In Dynamo-style databases, the parameters n, w, and r are typically configurable._
    - A common choice is to make n an odd number ( typically 3 or 5 ) and to set w = r = (n + 1) / 2 ( rounded up ) _( 向上取整 )_ .
    - _However, you can vary the numbers as you see fit._
        - For example, a workload with few writes and many reads may benefit from setting w = n and r = 1.
        - This makes reads faster, but has the disadvantage that just one failed node causes all database writes to fail.
- The quorum condition, w + r > n, allows the system to tolerate unavailable nodes as follows:
    - _( icehe : 尽可能同时保证 (折衷) 一致性和可用性, 但是系统实现更复杂 )_
    - _If w < n, we can still process writes if a node is unavailable._
    - _If r < n, we can still process reads if a node is unavailable._
    - _With n = 3, w = 2, r = 2 we can tolerate one unavailable node._
    - _With n = 5, w = 3, r = 3 we can tolerate two unavailable nodes._
    - _Normally, reads and writes are always sent to all n replicas in parallel._
        - _The parameters w and r determine how many nodes we wait for -- i.e., how many of the n nodes need to report success before we consider the read or write to be successful._

```plantuml
@startuml
actor write
actor read
folder db as "n = 5, w = 3, r = 3" {
    database rep1 as "Replica 1"
    database rep2 as "Replica 2"
    database rep3 as "Replica 3"
    database rep4 as "Replica 4"
    database rep5 as "Replica 5"
}

write --> rep1
write --> rep2
write --> rep3
write ~~> rep4 : fail
write ~~> rep5 : fail

read ~up~> rep1 : fail
read ~up~> rep2 : fail
read -up-> rep3
read -up-> rep4
read -up-> rep5
@enduml
```

#### Limitations of Quorum Consistency

_If you have n replicas, and you choose w and r such that w + r > n, you can generally expect every read to return the most recent value written for a key._

- This is the case because **the set of nodes to which you've written and the set of nodes from which you've read must overlap**.
- That is, among the nodes you read there must be **at least one node with the latest value**.

_Often, r and w are chosen to be a majority ( more than n/2 ) of nodes, because that ensures w + r > n while still tolerating up to n/2 node failures._

- But quorums are not necessarily majorities -- **it only matters that the sets of nodes used by the read and write operations overlap in at least one node**.
- _Other quorum assignments are possible, which allows some flexibility in the design of distributed algorithms._

You may also set w and r to smaller numbers, so that w + r ≤ n. _( i.e., the quorum condition is not satisfied. )_

- _In this case, reads and writes will still be sent to n nodes, but a smaller number of successful responses is required for the operation to succeed._
- With a smaller w and r you are more likely to read stale values, because it's more likely that your read didn't include the node with the latest value.
- On the upside, this configuration allows lower latency and higher availability:
    - _if there is a network interruption and many replicas become unreachable, there's a higher chance that you can continue processing reads and writes._
- _Only after the number of reachable replicas falls below w or r does the database become unavailable for writing or reading, respectively._

_However, even with w + r > n, there are likely to be edge cases where stale values are returned. These depend on the implementation, but possible scenarios include :_

- If a **sloppy quorum** is used, the w writes may end up on different nodes than the r reads, so there is no longer a guaranteed overlap between the r nodes and the w nodes.
- If two writes occur concurrently, it is not clear which one happened first.
    - In this case, the only safe solution is to merge the concurrent writes.
    - If a winner is picked based on a timestamp ( last write wins ), writes can be lost due to **clock skew** _( 时钟偏差 )_ .
- If a write happens concurrently with a read, the write may be reflected on only some of the replicas.
    - In this case, it's undetermined whether the read returns the old or the new value.
- If a write succeeded on some replicas but failed on others ( for example because the disks on some nodes are full ), and overall succeeded on fewer than w replicas, it is not rolled back on the replicas where it succeeded.
    - This means that if a write was reported as failed, subsequent reads may or may not return the value from that write.
- If a node carrying a new value fails, and its data is restored from a replica carrying an old value, the number of replicas storing the new value may fall below w, breaking the quorum condition.
- _Even if everything is working correctly, there are edge cases in which you can get unlucky with the timing._

**Monitoring staleness** _( 监控旧值 )_

From an operational perspective, it’s important to monitor whether your databases are returning up-to-date results.

- _Even if your application can tolerate stale reads, you need to be aware of the health of your replication._
- If it falls behind significantly, it should alert you so that you can investigate the cause
    - ( for example, a problem in the network or an overloaded node ).

_For leader-based replication, the database typically exposes metrics for the replication lag, which you can feed into a monitoring system._

- This is possible because writes are applied to the leader and to followers in the same order, and each node has a position in the replication log ( the number of writes it has applied locally ).
- By subtracting a follower's current position from the leader's current position, you can measure the amount of replication lag.

_In systems with leaderless replication, there is no fixed order in which writes are applied, which makes monitoring more difficult._

- _If the database only uses read repair ( no anti-entropy ), there is no limit to how old a value might be -- if a value is only infrequently read, the value returned by a stale replica may be ancient._

**Sloppy Quorums and Hinted Handoff** _( 宽松的法定票数 与 数据回传 )_

- _However, quorums ( as described so far ) are not as fault-tolerant as they could be._
    - A network interruption can easily cut off a client from a large number of database nodes.
    - Although those nodes are alive, and other clients may be able to connect to them, to a client that is cut off from the database nodes, they might as well be dead.
    - In this situation, it's likely that fewer than w or r reachable nodes remain, so the client can no longer reach a quorum.
- _In a large cluster ( with significantly more than n nodes ) it's likely that_ the client can connect to some database nodes during the network interruption, just not to the nodes that it needs to assemble a quorum for a particular value.
    - _In that case, database designers face a trade-off :_
        - A. _Is it better to return errors to all requests for which we cannot reach a quorum of w or r nodes?_
        - B. Or should we accept writes anyway, and **write them to some nodes that are reachable but aren't among the n nodes** on which the value usually lives?
    - The latter is known as a **sloppy quorum** _( 宽松的仲裁 )_ :
        - writes and reads still require w and r successful responses,
        - but those may include nodes that are not among the designated n "home" nodes for a value. _( icehe : 我的理解 -- 这些读写可能暂存在原定 n 个节点之外的节点中 )_
    - **Hinted handoff** _( 数据回传 )_
        - Once the network interruption is fixed, any writes that one node temporarily accepted on behalf of another node are sent to the appropriate "home" nodes.
- Sloppy quorums are particularly useful for increasing write availability : _as long as any w nodes are available, the database can accept writes._
    - _However, this means that even when w + r > n, you cannot be sure to read the latest value for a key, because the latest value may have been temporarily written to some nodes outside of n._
    - It's only an assurance of durability _( 保证持久性的措施 )_ , namely that the data is stored on w nodes somewhere.
        - There is no guarantee that a read of r nodes will see it until the hinted handoff has completed.
    - _Sloppy quorums are optional in all common Dynamo implementations._

**Multi-datacenter operation** _( 多数据中心的操作 )_

- _Cassandra and Voldemort implement their multi-datacenter support within the normal leaderless model :_
    - the number of replicas n includes nodes in all datacenters, _and in the configuration you can specify how many of the n replicas you want to have in each datacenter_.
- Each write from a client is sent to all replicas, regardless of datacenter,
    - but **the client usually only waits for acknowledgment from a quorum of nodes within its local datacenter** so that it is unaffected by delays and interruptions on the cross-datacenter link.
- The higher-latency writes to other datacenters are often configured to happen asynchronously, _although there is some flexibility in the configuration._

#### Detecting Concurrent Writes

_( 检测并发写 )_

Dynamo-style databases allow several clients to **concurrently write to the same key**, which means that conflicts will occur even if strict quorums are used.

- _The situation is similar to multi-leader replication, although in Dynamo-style databases conflicts can also arise during read repair or hinted handoff._

The problem is that **events may arrive in a different order at different nodes**, due to variable network delays and partial failures.

![concurrent-writes-in-dynamo-style-datastore.png](_images/designing-data-intensive-applications/concurrent-writes-in-dynamo-style-datastore.png)

_If each node simply overwrote the value for a key whenever it received a write request from a client, the nodes would become permanently inconsistent._

**Last write wins ( discarding concurrent writes )** _( 最后写入者胜利 ( 丢弃并发写入 ) )_

- One approach for achieving eventual convergence is to declare that **each replica need only store the most "recent" value and allow "older" values to be overwritten and discarded**.
    - _Then, as long as we have some way of unambiguously determining which write is more "recent", and every write is eventually copied to every replica, the replicas will eventually converge to the same value._
- As indicated by the quotes around “recent,” this idea is actually quite misleading.
    - We say the writes are concurrent, so their order is undefined.
    - We can **attach a timestamp to each write**, pick the biggest timestamp as the most "recent," and discard any writes with an earlier timestamp.
    - This conflict resolution algorithm, called **last write wins (LWW)**.
- _LWW achieves the goal of eventual convergence, but at the cost of durability._
    - _There are some situations, such as caching, in which lost writes are perhaps acceptable._
    - _If losing data is not acceptable, LWW is a poor choice for conflict resolution._
- _The only safe way of using a database with LWW is to ensure that_ a key is only written once and thereafter treated as immutable, thus avoiding any concurrent updates to the same key.

**The "happens-before" relationship and concurrency**

- _omitted…_

**Capturing the happens-before relationship**

- _( 比较复杂, 详情看原书, 而且有必要搞明白! )_
    - _( icehe : 如何巧妙地靠同时保存一个 key 的多个版本 value, 以及版本号来处理多设备同步 value 并解决冲突的问题! ( 不过只是对一个数据集追加元素的操作场景 ) )_

![capturing-causal-dependencies-between-2-clients-concurrently-editing-a-shopping-cart.png](_images/designing-data-intensive-applications/capturing-causal-dependencies-between-2-clients-concurrently-editing-a-shopping-cart.png)

**Merging concurrently written values**

- _( 比较复杂, 详情看原书, 而且有必要搞明白! )_
    - _( icehe :不只是对一个数据集追加元素, 还得移除元素, 这时还需要 "A deletion marker is known as a **tombstone** ( 墓碑 ) ." )_

**Version vectors** _( 版本矢量 )_

- The collection of version numbers from all the replicas is called a version vector.
    - Version vectors are sent from the database replicas to clients when values are read, and need to be sent back to the database when a value is subsequently written.
- _( 详情看原书 )_

## Partitioning

_( 数据分区 )_

- _Replication -- that is, having multiple copies of the same data on different nodes._
- For very large datasets, or very high query throughput, that is not sufficient :
    - we need to break the data up into **partitions**, aka. **sharding**.
- _Normally, partitions are defined in such a way that_ **each piece of data ( each record, row, or document ) belongs to exactly one partition**.
- The main reason for wanting to partition data is **scalability**.
    - _Different partitions can be placed on different nodes in a shared-nothing cluster._
    - _Thus, a large dataset can be distributed across many disks, and the query load can be distributed across many processors._

_Terminological confusion_

- _What we call a partition here is called_
    - a **shard** in MongoDB, Elasticsearch, and SolrCloud _; it's known as_
    - a **region** in HBase,
    - a **tablet** in Bigtable,
    - a **vnode** in Cassandra and Riak _, and_
    - a **vBucket** in Couchbase.
- _However, **partitioning** is the most established term, so we'll stick with that._

**Partitioning and Replication**

- Partitioning is usually combined with replication so that copies of each partition are stored on multiple nodes.
    - _This means that, even though each record belongs to exactly one partition, it may still be stored on several different nodes for fault tolerance._
- A node may store more than one partition.
    - _Each partition's leader is assigned to one node, and its followers are assigned to other nodes._
    - **Each node may be the leader for some partitions and a follower for other partitions.**

### Partitioning of Key-Value Data
