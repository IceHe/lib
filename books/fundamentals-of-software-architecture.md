# Fundamentals of Software Architecture

《软件架构基础》（影印版）Mark Richards, Neal Ford 著

---

References

- Book "Fundamentals of Software Architecture"
    - 《软件架构基础》（影印版）
    - [TOC](/books/fundamentals-of-software-architecture-toc.md)

## Table of Contents

-   Preface: Invalidating Axioms _( 公理 )_

-   1\. Introduction

    - Defining Software Architecture
    - Expectations of an Architect
        - Continually Analyze the Archituecture
        - Keep Current with Latest Trends
        - Ensure Compliance _( 服从 )_ with Decisions
        - Diverse _( 不同的 )_ Exposure _( 显露? )_ and Experience
        - Have Bussines Domain Knowledge
        - Understand and Navigate _( 操纵 )_ Politics
    - Intersection _( 交叉点 )_ of Architecture and …
        - **Engineering Practices**
        - **Operations / DevOps**
        - **Process**
        - **Data**
    - **Laws of Software Architecutre**

### Part 1. Foundations

-   2\. Architectural _( 建筑学上的 )_ Thinking

    - Architecture Versus Design
    - Technical Breadth
    - Analyze Trade-Offs
    - Understanding Business Drivers
    - Balancing Architecutre and Hands-On Coding

-   3\. **Modularity _( 模块性 )_**

    - Definition
    - Measuring Modularity
        - **Cohesion**
        - **Coupling**
        - **Abstractness, Instability, and Distance from the Main Sequence**
        - **Distance from the Main Sequence**
        - **Connascence _( 共生性 )_**
        - **Unifying Coupling and Connascence Metrics**
    - **From Modules to Components**

-   4\. **Architecture Characteristics _( 特征 )_** Defined

    - Architectural Characteristics ( Partially ) Listed
        - **Operational** Architecture Characteristics
        - **Structural** Architecture Characteristics
        - **Cross-Cutting** Architecture Characteristics
    - Trade-Offs and Least Worst Architecture

-   5\. Indentifying Architectural Characteristics

    - Extracting Architecture Characteristics from Domain Concerns
    - Extracting Architecture Characteristics from Requirements
    - Case Study: Silicon Sandwiches
        - Explicit Characteristics
        - Implicit Characteristics

-   6\. Measuring and Governing Architecture Characteristics

    - Measuring Architecture Characteristics
        - Operational Measures
        - Structural Measures
        - Process Measures
    - Governance _( 管理 )_ and Fitness _( 适当 )_ Function
        - Governing Architecture Characteristics
        - Fitness Functions

-   7\. **Scope** of Architecture Characteristics

    - **Coupling and Connascence**
    - **Architectural Quanta _( 量 )_ and Granularity _( 粒度 )_**
        - Case Study: Going, Going, Gone

-   8\. Component-Based Thinking

    - Component Scope
    - **Architect Role _( 职责 )_**
        - **Architecture Partitioning _( 分割 )_**
        - Case Study: Silicon Sanwiches: Partitioning
    - **Developer Role**
    - Component Identification Flow
        - Identifying Initial Components
        - Assign Requirements to Components
        - Analyze Roles and Responsibilities
        - Analyze Architecture Characteristics
        - Restructure Components
    - Component Granularity
    - Component Design
        - Discovering Components
    - Case Study: Going, Going, Gone: Discovering Components
    - Architecture Quantum Redux: Choosing Between Monolithic Versus Distributed Architectures

### Part 2. Architure Styles

-   9\. Foundations

    - Fundamental Patterns
        - Big Ball of Mud
        - Unitary _( 统一的 )_ Architecture
        - Client / Server
    - **Monolithic Versus Distributed Architectures**
        - **Fallacy _( 谬误 )_ #1: The Network Is Reliable**
        - **Fallacy #2: Latency Is Zero**
        - **Fallacy #3: Bandwidth Is Infinite**
        - **Fallacy #4: The Network Is Secure**
        - **Fallacy #5: The Topology Never Changes**
        - **Fallacy #6: There Is Only One Administrator**
        - **Fallacy #7: Transport Cost Is Zero**
        - **Fallacy #8: The Network Is Homogeneous**
        - Other Distributed Considerations

-   10\. **Layered** Architecture Style

    - Topology
    - **Layers of Isolation**
    - Adding Layers
    - Other Considerations
    - Why Use This Architecture Style
    - Architecture Characteristics Ratings

-   11\. **Pipeline** Architecture Style

    - Topology
        - **Pipes**
        - **Filters**
    - Example
    - Architecture Characteristics Ratings

-   12\. **Microkernel** Architecture Style

    - Topology
        - **Core System**
        - **Plug-In Components**
    - **Registry**
    - **Contracts**
    - Examples of Use Cases
    - Architecture Characteristics Ratings

-   13\. **Service-Based** Architecture Style

    - Topology
    - Topology Variants
    - Service Design and Granularity
    - **Database Partitioning**
    - Example Architecture
    - Architecture Characteristics Ratings
    - When to Use This Architecture Style

-   14\. **Event-Driven** Architecture Style

    - Topology
    - **Broker** Topology
    - **Mediator** Topology
    - **Asynchronous Capabilities**
    - **Error Handling**
    - **Prevent Data Loss**
    - **Broadcast Capabilities**
    - **Request-Reply**
    - Choosing Between Request-Reply and **Event-Based**
    - **Hybrid** Event-Driven Architectures
    - Architecture Characteristics Ratings

-   15\. **Space-Based** Architecture Style

    - General Topology
        - **Processing Unit**
        - **Virtualized Middleware**
        - **Data Pumps _( 泵 )_**
        - **Data Writers**
        - **Data Readers**
    - **Data Collisions**
    - **Cloud Versus On-Premises _( 内部部署 )_ Implementations**
    - **Replicated Versus Distributed Caching**
    - **Near-Cahce** Considerations
    - Implementation Examples
        - Correct Ticketing System
        - Online Auction System
    - Architecture Characteristics Ratings

-   16\. **Orchestration-Driven Service-Oriented** Architecture

    - History and Philosophy
    - Topology
    - Taxonomy
        - **Business** Services
        - **Enterprise** Services
        - **Application** Services
        - **Infrastructure** Services
        - **Orchestration** Services
        - **Message Flow**
    - **Reuse … and Coupling**
    - Architecture Characteristics Ratings

-   17\. **Microservices** Architecture

    - History
    - Topology
    - **Distributed**
    - **Bounded Context**
        - **Granularity**
        - **Data Isolation**
    - **API Layer**
    - Operational Reuse
    - **Frontends _( 前端的 )_**
    - Communication
        - **Choreography _( 舞蹈舞蹈设计 )_ and Orchestration**
        - **Transactions and Sages _( 圣人, 智者 )_**
    - Architecture Characteristics Ratings
    - Additional References

-   18\. Choosing the Appropriate Architecture Style

    - Shifting "Fashion" in Architecture
    - **Decision Criteria _( 标准, 条件 )_**
    - Monolith Case Study: Silicon Sandwiches
        - Modular Monolith
        - Microkernel
    - Distributed Case Study: Going, Going, Gone

### Part 3. Techniques and Soft Skills

-   19\. **Architecture Decisions**

    - Architecture Decision **Anti-Patterns**
        - **Governing Your Assets** Anti-Pattern
        - **Groundhog Day _( 土拨鼠日 )_** Anti-Pattern
        - **Email-Driven** Architecture Anti-Pattern
    - Architecturally Significant
    - Architecture Decision Records
        - Basic Structure
        - Storing ADRs
        - ADRs as Documentation
        - Using ADRs for Standards
        - Example

-   20\. Analyzing Architecture **Risk**

    - Risk Matrix
    - Risk Assessments _( 估价 )_
    - Risk Storming
        - Identification
        - Consensus
    - Agile Story Risk Analysis
    - Risk Storming Examples
        - Availability
        - **Elasticity _( 弹性 )_**
        - Security

-   21\. Diagramming and Presenting Architecture

    - Diagramming
        - Tools
        - Diagramming Standards: **UML, C4, and ArchiMate**
        - Diagram Guidelines
    - Presenting
        - Manipulating Time
        - Incremental Builds
        - **Infodecks Versus Presentations**
        - **Slides Are Half of the Story**
        - Invisibility

-   22\. Making Teams Effective

    - Team Boundaries
    - Architect Personalities
        - Control Freak _( 怪物; 反常的事 )_
        - Armchair _( 扶手椅 )_ Architect
        - Effective Architect
    - How Much Control?
    - Team Warning Signs
    - **Leveraging Checklists**
        - **Developer Code Completion** Checklist
        - **Unit and Functional Testing** Checklist
        - **Software Release** Checklist
    - Providing Guidance
    - Summary

-   23\. Negotiation and Leadership Skills

    - **Negotiation and Facilitation** _( 助长, 简易化 )_
        - Negotiating with Business Stakeholders
        - Negotiating with Other Architects
        - Negotiating with Developers
    - The Software Architect as a Leader
        - The 4 C's of Architecture
        - Be Pragmatic, Yet Visionary _( 有眼光的, 有远见的 )_
        - Leading Teams By Example
    - Integrating with the Development Team
    - Summary

-   24\. Developing a Career Path

    - The 20-Minute Rule
    - Developing a Personal Radar
        - The ThoughtWorks Technology Radar
        - Open Source Visualization Bits
    - Using Social Media
    - Parting Words of Advice

-   Appendix. Self-Assessment Questions

-   Index

## Preface: Invalidating Axioms

Architecture characteristics referes to the "-illities" that the system must support

- Availability 可用性
- Reliability 可靠性
    - _Software Reliability is the probability of failure-free software operation for a specified period of time in a specified environment. ( [ref](https://users.ece.cmu.edu/~koopman/des_s99/sw_reliability/#:~:text=Software%20Reliability%20is%20the%20probability,important%20factor%20affecting%20system%20reliability.&text=Measurement%20in%20software%20is%20still%20in%20its%20infancy.) )_
- Testability 可测试性
- Scalability 可伸缩性
    - _Scalability handles the changing needs of an application within the confines of the infrastructure via statically adding or removing resources to meet applications demands if needed. ( [ref](https://blog.turbonomic.com/blog/on-technology/cloud-elasticity-vs-cloud-scalability#:~:text=The%20purpose%20of%20Elasticity%20is,meet%20applications%20demands%20if%20needed.) )_
- Security 安全性
- Agility 敏捷性
- Fault Tolerance 错误容忍性
- Elasticity 弹性
    - _The purpose of Elasticity is to match the resources allocated with actual amount of resources needed at any given point in time. ( [ref](https://blog.turbonomic.com/blog/on-technology/cloud-elasticity-vs-cloud-scalability#:~:text=The%20purpose%20of%20Elasticity%20is,meet%20applications%20demands%20if%20needed.) )_
- Recoverability 可恢复性
- Performance 性能
- Deployability 可部署性
- Learnability 可学习性?

_( [Scalability vs. Elasticity](https://blog.turbonomic.com/blog/on-technology/cloud-elasticity-vs-cloud-scalability#:~:text=The%20purpose%20of%20Elasticity%20is,meet%20applications%20demands%20if%20needed.) )_

## C1. Introduction

Laws of Software Architecture

> Everything in software architecture is a trade-off.

_—— First Law of SOftware Architecture_

> If an architect thinks they discovered something that isn't a trade-off, more likely they just haven't identified the trade-off yet.

_—— Corollary 1_

> Why is more important than how.

_—— Second Law of SOftware Architecture_

# Part 1. Foundations

## C2. Architectureal Thinking

# Part 2. Architeure Styles

# Part 3. Techniques and Soft Skills