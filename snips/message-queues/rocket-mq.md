# RocketMQ

> A unified messaging engine，lightweight data processing platform.

References

- https://rocketmq.apache.org
    - Quick Start : https://rocketmq.apache.org/docs/quick-start
    - How to Support More Queues in RocketMQ? : https://rocketmq.apache.org/rocketmq/how-to-support-more-queues-in-rocketmq

## Intro

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

### Why RocketMQ ?

- Based on our research, with increased queues and virtual topics in use, **ActiveMQ IO module reaches a bottleneck**.
    - We tried our best to solve this problem through throttling, circuit breaker or degradation, but it did not work well.
    - So we begin to focus on the popular messaging solution Kafka at that time.
    - Unfortunately, **Kafka can not meet our requirements especially in terms of low latency and high reliability**, see [here](https://rocketmq.apache.org/rocketmq/how-to-support-more-queues-in-rocketmq/) for details.
- In this context, we decided to invent a new messaging engine to handle a broader set of use cases, ranging from traditional pub/sub scenarios to high volume real-time zero-loss tolerance transaction system.
    - We believe this solution can be beneficial, so we would like to open source it to the community.
    - Today, more than 100 companies are using the open source version of RocketMQ in their business.
- The following table demonstrates the comparison between RocketMQ, ActiveMQ and Kafka (Apache’s most popular messaging solutions according to awesome-java):

RocketMQ vs. ActiveMQ vs. Kafka

Please note this documentation is written by the RocketMQ team. Although the ideal is a disinterested comparison of technology and features, the authors’ expertise and biases obviously favor RocketMQ.

The table below is a handy quick reference for spotting the differences among RocketMQ and its most popular alternatives at a glance.