# RabbitMQ

> RabbitMQ is the most widely deployed open source message broker.

References

- RabbitMQ 的应用场景以及基本原理介绍 | Laravel China 社区  : https://learnku.com/articles/27446
- 官网 : Messaging that just works - RabbitMQ : https://www.rabbitmq.com/

## Intro

- RabbitMQ : 一个由 erlang 开发的 AMQP ( Advanced Message Queuing Protocol ) 的开源实现
    - _最初起源于金融系统, 用于在分布式系统中存储转发消息, 在易用性 / 扩展性 / 高可用性 等方面表现不俗_
- AMQP : 高级消息队列协议, 是应用层协议的一个开放标准, 为面向消息的中间件设计
    - _消息中间件主要用于组件之间的解耦, 消息的发送者无需知道消息使用者的存在, 反之亦然_
    - _AMQP 的主要特征是面向消息、队列、路由 ( 包括点对点和发布 / 订阅 ) 、可靠性、安全_

Features

- Reliability ( 可靠性 )
    - 持久化 / 传输确认 / 发布确认
- Flexible Routing ( 灵活的路由 )
    - 在消息进入队列之前, 通过 Exchange 来路由消息
        - 对于典型的路由功能, 已经提供了一些内置的 Exchange 来实现
        - 针对更复杂的路由功能, 可以将多个 Exchange 绑定在一起
        - 也通过插件机制实现自己的 Exchange
- Clustering _( 消息集群 )_
    - 多个 RabbitMQ 服务器可以组成一个集群, 形成一个逻辑 Broker
- _Highly Available Queues_ _( 高可用 )_
    - 队列可以在集群中的机器上进行镜像 _( icehe : 错字? )_ , 使得在部分节点出问题的情况下队列仍然可用
- _Multi-protocol_ _( 多种协议 )_
    - 支持多种消息队列协议, 比如 STOMP / MQTT 等
- Many Clients _( 多语言客户端 )_
    - 几乎支持所有常用语言, 比如 Java / .NET / Ruby 等
- _Management UI_ _( 管理界面 )_
    - _RabbitMQ 提供了一个易用的用户界面, 使得用户可以监控和管理消息 Broker 的许多方面_
- Tracing _( 跟踪机制 )_
    - 如果消息异常, 提供了消息跟踪机制, 使用者可以找出发生了什么
- _Plugin System_ _( 插件机制 )_
    - _提供了许多插件, 从多方面进行扩展, 也可以编写自己的插件_
