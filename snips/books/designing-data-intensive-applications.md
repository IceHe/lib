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

- _A document is usually stored as a single continuous string, encoded as JSON, XML, or a binary variant thereof (such as MongoDB’s BSON)._
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
    - _Higher-level query languages like SQL can be implemented as a pipeline of MapReduce operations, but there are also many distributed implementations of SQL that don’t use MapReduce._

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
    - <i>2\. Given any vertex, you can efficiently find both its incoming and its outgoing edges, and thus traverse the graph -- i.e., follow a path through a chain of vertices -- both forward and backward. (That’s why Example 2-2 has indexes on both the tail_vertex and head_vertex columns.)</i>
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
        - _websites already publish information as text and pictures for humans to read, so why don’t they also publish information as machine-readable data for computers to read?_
- _RDF data model_
    - _RDF - Resource Description Framework 资源描述框架_
- _SPARQL query language_
    - _SPARQL is a query language for triple-stores using the RDF data model._
    - _( It is an acronym for SPARQL Protocol and RDF Query Language, pronounced “sparkle.” )_
    - _It predates Cypher, and since Cypher’s pattern matching is borrowed from SPARQL, they look quite similar._

_The Foundation: Datalog_

- _Omitted …_

## Storage and Retrival

- _数据存储与检索_

TODO

Summary ( TODO )

- OLTP
    - 日志结构流派 : …
    - 原地更新流派 : B-Tree
- OLAP

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
- _To avoid overloading the word we’ll stick with **encoding** ( in this book ) , even though serialization is perhaps a more common term._

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
    - _For example, Java’s built-in serialization is notorious for its bad performance and bloated encoding._

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
- _It was started in 2009 as a subproject of Hadoop, as a result of Thrift not being a good fit for Hadoop’s use cases._
- _Avro also uses a schema to specify the structure of the data being encoded._
    - _It has two schema languages : one (Avro IDL) intended for human editing, and one (based on JSON) that is more easily machine-readable._
- _The writer’s schema and the reader’s schema_
    - The key idea with Avro is that the writer’s schema and the reader’s schema don’t have to be the same -- they only need to be compatible.
    - _When data is decoded (read), the Avro library resolves the differences by looking at the writer’s schema and the reader’s schema side by side and translating the data from the writer’s schema into the reader’s schema._
        - _If the writer’s schema and the reader’s schema have their fields in a different order, because the schema resolution matches up the fields by field name._
        - _If the code reading the data encounters a field that appears in the writer’s schema but not in the reader’s schema, it is ignored._
        - _If the code reading the data expects some field, but the writer’s schema does not contain a field of that name, it is filled in with a default value declared in the reader’s schema._
- _( 其它详见原书 )_

### Modes of Dataflow

_The most common ways how data flows between processes:_

- Via databases
- Via service calls _( REST and RPC )_
- Via asynchronous message passing

_Dataflow Through Services: REST and RPC_

- _This approach is often used to decompose a large application into smaller services by area of functionality, such that one service makes a request to another when it requires some functionality or data from that other service._
    - _This way of building applications has traditionally been called a_ **service-oriented architecture (SOA)**, _more recently refined and rebranded as_ **microservices architecture**.
