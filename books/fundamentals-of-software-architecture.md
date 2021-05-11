# Fundamentals of Software Architecture

《软件架构基础》（影印版）Mark Richards, Neal Ford 著

---

References

- Book "Fundamentals of Software Architecture"
    - 《软件架构基础》（影印版）

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
        - Engineering Practices
        - Operations / DevOps
        - Process
        - Data
    - Laws of Software Architecutre

### Part 1. Foundations

-   2\. Architectural _( 建筑学上的 )_ Thinking

    - Architecture Versus Design
    - Technical Breadth
    - Analyze Trade-Offs
    - Understanding Business Drivers
    - Balancing Architecutre and Hands-On Coding

-   3\. Modularity _( 模块性 )_

    - Definition
    - Measuring Modularity
        - Cohesion
        - Coupling
        - Abstractness, Instability, and Distance from the Main Sequence
        - Distance from the Main Sequence
        - Connascence _( 共生性 )_
        - Unifying Coupling and Connascence Metrics
    - From Modules to Components

-   4\. Architecture Characteristics _( 特征 )_ Defined

    - Architectural Characteristics ( Partially ) Listed
        - Operational Architecture Characteristics
        - Structural Architecture Characteristics
        - Cross-Cutting Architecture Characteristics
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

-   7\. Scope of Architecture Characteristics

    - Coupling and Connascence
    - Architectural Quanta _( 量 )_ and Granularity _( 粒度 )_
        - Case Study: Going, Going, Gone

-   8\. Component-Based Thinking

    - Component Scope
    - Architect Role _( 职责 )_
        - Architecture Partitioning _( 分割 )_
        - Case Study: Silicon Sanwiches: Partitioning
    - Developer Role
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
    - Monolithic Versus Distributed Architectures
        - Fallacy _( 谬误 )_ #1: The Network Is Reliable
        - Fallacy #2: Latency Is Zero
        - Fallacy #3: Bandwidth Is Infinite
        - Fallacy #4: The Network Is Secure
        - Fallacy #5: The Topology Never Changes
        - Fallacy #6: There Is Only One Administrator
        - Fallacy #7: Transport Cost Is Zero
        - Fallacy #8: The Network Is Homogeneous
        - Other Distributed Considerations

-   10\. Layered Architecture Style
