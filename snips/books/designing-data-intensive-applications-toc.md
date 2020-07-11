# Designing Data-Intensive Applications ( TOC )

> **Table of Contents**

References

- Book "Designing Data-Intensive Applications"
    - ZH Ver. :《 数据密集型应用系统设计 》

## Part I. Foundations of Data Systems

### 1. Reliable, Scalable, and Maintainable Applications

_Thinking About Data Systems_

Reliability _( 可靠性 )_

- Hardware Faults
- Software Errors
- Human Errors
- _How Important Is Reliability?_

**Scalability** _( 可伸缩性 )_

- **Describing Load**
- **Describing Performance**
- **Approaches for Coping with Load**

Maintainability _( 可维护性 )_

- Operability: Making Life Easy for Operations _( 可运维性 )_
- Simplicity: Managing Complexity _( 简单性 )_
- Evolvability: Making Change Easy _( 可演化性 )_

### 2. Data Models and Query Languages

**Relational Model Versus Document Model** _( 关系模型 / 文档模型 )_

- **The Birth of NoSQL**
- **The Object-Relational Mismatch**
- **Many-to-One and Many-to-Many Relationships**
- Are Document Databases Repeating History?
- Relational Versus Document Databases Today

Query Languages for Data

- Declarative Queries on the Web _( 声明式查询 )_
- MapReduce Querying

**Graph-Like Data Models** _( 图模型 )_

- **Property Graphs**
- The Cypher Query Language
- Graph Queries in SQL
- Triple-Stores and SPARQL
- The Foundation: Datalog

### 3. Storage and Retrieval

**Data Structures That Power Your Database**

- Hash Indexes
- **SSTables and LSM-Trees** _( 日志结构合并树 )_
- **B-Trees**
- Comparing B-Trees and LSM-Trees
- Other Indexing Structures

**Transaction Processing or Analytics?**

- Data Warehousing _( 数据仓库 )_
- **Stars and Snowflakes: Schemas for Analytics Column-Oriented Storage**

**Column-Oriented Storage** _( 列式存储 )_

- **Column Compression**
- **Sort Order in Column Storage**
- Writing to Column-Oriented Storage
- Aggregation: Data Cubes and Materialized Views

### 4. Encoding and Evolution

**Formats for Encoding Data**

- Language-Specific Formats
- JSON, XML, and Binary Variants
- **Thrift and Protocol Buffers**
- _Avro_
- The Merits of Schemas

**Modes of Dataflow**

- Dataflow Through Databases
- Dataflow Through Services: REST and RPC
- Message-Passing Dataflow

## Part II. Distributed Data

### 5. Replication

Leaders and Followers

- Synchronous Versus Asynchronous Replication
- Setting Up New Followers
- Handling Node Outages
- Implementation of Replication Logs

Problems with Replication Lag

- Reading Your Own Writes
- Monotonic Reads
- Consistent Prefix Reads

Solutions for Replication Lag

- Multi-Leader Replication
- Use Cases for Multi-Leader Replication
- Handling Write Conflicts

Multi-Leader Replication Topologies

- Leaderless Replication
- Writing to the Database When a Node Is Down
- Limitations of Quorum Consistency
- Sloppy Quorums and Hinted Handoff
- Detecting Concurrent Writes

### 6. Partitioning

Partitioning and Replication

Partitioning of Key-Value Data

- Partitioning by Key Range
- Partitioning by Hash of Key
- Skewed Workloads and Relieving Hot Spots

Partitioning and Secondary Indexes

- Partitioning Secondary Indexes by Document
- Partitioning Secondary Indexes by Term

Rebalancing Partitions

- Strategies for Rebalancing
- Operations: Automatic or Manual Rebalancing

Request Routing

- Parallel Query Execution

### 7. Transactions

The Slippery Concept of a Transaction

- The Meaning of ACID
- Single-Object and Multi-Object Operations

Weak Isolation Levels

- Read Committed
- Snapshot Isolation and Repeatable Read
- Preventing Lost Updates
- Write Skew and Phantoms

Serializability

- Actual Serial Execution
- Two-Phase Locking (2PL)
- Serializable Snapshot Isolation (SSI)

### 8. The Trouble with Distributed Systems

Faults and Partial Failures

- Cloud Computing and Supercomputing

Unreliable Networks

- Network Faults in Practice
- Detecting Faults
- Timeouts and Unbounded Delays
- Synchronous Versus Asynchronous Networks

Unreliable Clocks

- Monotonic Versus Time-of-Day Clocks
- Clock Synchronization and Accuracy
- Relying on Synchronized Clocks
- Process Pauses

Knowledge, Truth, and Lies

- The Truth Is Defined by the Majority
- Byzantine Faults
- System Model and Reality

### 9. Consistency and Consensus

Consistency Guarantees

Linearizability

- What Makes a System Linearizable?
- Relying on Linearizability
- Implementing Linearizable Systems
- The Cost of Linearizability

Ordering Guarantees

- Ordering and Causality
- Sequence Number Ordering
- Total Order Broadcast

Distributed Transactions and Consensus

- Atomic Commit and Two-Phase Commit (2PC)
- Distributed Transactions in Practice
- Fault-Tolerant Consensus
- Membership and Coordination Services

## Part III. Derived Data

### 10. Batch Processing

Batch Processing with Unix Tools

- Simple Log Analysis
- The Unix Philosophy

MapReduce and Distributed Filesystems

- MapReduce Job Execution
- Reduce-Side Joins and Grouping
- Map-Side Joins
- The Output of Batch Workflows
- Comparing Hadoop to Distributed Databases

Beyond MapReduce

- Materialization of Intermediate State
- Graphs and Iterative Processing
- High-Level APIs and Languages

### 11. Stream Processing

Transmitting Event Streams

- Messaging Systems
- Partitioned Logs

Databases and Streams

- Keeping Systems in Sync
- Change Data Capture
- Event Sourcing
- State, Streams, and Immutability

Processing Streams

- Uses of Stream Processing
- Reasoning About Time
- Stream Joins
- Fault Tolerance

### 12. The Future of Data Systems

Data Integration

- Combining Specialized Tools by Deriving Data
- Batch and Stream Processing

Unbundling Databases

- Composing Data Storage Technologies
- Designing Applications Around Dataflow
- Observing Derived State

Aiming for Correctness

- The End-to-End Argument for Databases
- Enforcing Constraints
- Timeliness and Integrity
- Trust, but Verify

Doing the Right Thing

- Predictive Analytics
- Privacy and Tracking 536 Summary

## Ending

- Glossary
- _读者跋_
