# RabbitMQ

> RabbitMQ is the most widely deployed open source message broker.

References

- RabbitMQ 总结 : https://cloud.tencent.com/developer/article/1654903
- RabbitMQ 的应用场景以及基本原理介绍 | Laravel China 社区  : https://learnku.com/articles/27446
- 官网 : Messaging that just works - RabbitMQ : https://www.rabbitmq.com/

## 应用场景以及基本原理介绍

Reference

- RabbitMQ 的应用场景以及基本原理介绍 | Laravel China 社区  : https://learnku.com/articles/27446

AMQP 协议

- Advanced Message Queuing Protocol

### 核心概念

- **Server : 又称 Broker** _( 掮客 )_ , 接受客户端连接, 实现 AMQP 实体服务
- **Connection** : 与具体 Broker 网络连接
- **Channel** : 网络信道, 几乎所有操作都在 Channel 中进行, Channel 是消息读写的通道
    - **客户端可以建立多个 Channel, 每个 Channel 表示一个会话任务**
- Message : 消息, 服务器和应用程序之间传递的数据, **由 Properties 和 Body 组成**
    - **Properties 可以对消息进行修饰, 比如消息的优先级, 延迟等高级特性**
    - Body 是消息实体内容
- **Virtual Host** : 虚拟主机, 用于逻辑隔离, 最上层消息的路由
    - 一个 Virtual Host 可以若干个 Exchange 和 Queue
    - 同一个 Virtual Host 不能有同名的 Exchange 或 Queue
- **Exchange : 交换机, 接受消息，根据路由键转发消息到绑定的队列上**
- **Binding : Exchange 和 Queue 之间的虚拟连接, binding 中可以包括 routing key**
- **Routing Key : 一个路由规则, 虚拟机根据他来确定如何路由一条消息**
- Queue : 消息队列, 用来存放消息的队列

### Exchange

![rabbit-mq-exchange.jpeg](_images/rabbit-mq-exchange.jpeg)

**Exchange 类型**

![rabbit-mq-direct-exchange.png](_images/rabbit-mq-direct-exchange.png)

- **Direct Exchange : 所有发送到 Direct Exchange 的消息被转发到 Routing Key 中指定的 Queue**
    - Direct Exchange 可以使用 default Exchange
    - 默认的 Exchange 会绑定所有的队列, 所以 Direct 可以直接使用 Queue 名 ( 作为 Routing Key ) 绑定
    - 或者消费者和生产者的 Routing Key 完全匹配

![rabbit-mq-topic-exchange.png](_images/rabbit-mq-topic-exchange.png)

- **Topic Exchange : 发送到 Topic Exchange 的消息被转发到所有关心的 Routing Key 中指定 Topic 的 Queue 上**
    - Exchange 将 Routing Key 和某 Topic 进行模糊匹配, 此时队列需要绑定一个 Topic
    - 所谓模糊匹配就是可以使用通配符, `#` 可以匹配一个或多个词, 只匹配一个词比如 `log.#` 可以匹配 `log.info.test` `log.` 就只能匹配 `log.error`

![rabbit-mq-fanout-exchange.png](_images/rabbit-mq-fanout-exchange.png)

- **Fanout Exchange : 不处理路由键, 只需简单的将队列绑定到交换机上**
    - 发送到改 Exchange 上的消息都会被发送到与该 Exchange 绑定的 queues 上
    - Fanout 转发是最快的

- _Headers Exchange : 允许你匹配 AMQP 消息的 headers 而非路由键_
    - _除此之外, Headers Excahnge 和 Direct Exchange 完全一致, 但性能会差很多_
    - 因此它 **并不太实用，而且几乎再也用不到了**

其它配置

- durability : 是否需要持久化, true 为需要
- auto delete : 当最后一个绑定 Exchange 上的队列被删除时, 该 Exchange 也会被删除

### 保证消息 100% 投递

什么是生产端的可靠性投递？

- 保证消息的成功发出
- 保证 MQ 节点的成功接收
- 发送端 MQ 节点 ( broker ) 收到消息确认应答
- 完善消息进行补偿机制

#### 可靠性投递保障方案

- A. 消息落库, 对消息进行打标

![rabbit-mq-save-msgs.jpeg](_images/rabbit-mq-save-msgs.jpeg)

- B. 消息的延迟投递
    - 在高并发场景下，每次进行 DB 的操作都是每场消耗性能的
    - 使用延迟队列来减少一次数据库的操作
    - _( icehe : 这里看图不太理解 )_

![rabbit-mq-deferred-delivery.jpeg](_images/rabbit-mq-deferred-delivery.jpeg)

#### 消息幂等性

- 对一个动作进行操作, 肯定要能执行 100次 甚至 1000 次, 对于这 1000 次执行的结果都必须一样的
    - 例如, 单线程方式下执行 `update count - 1` 的操作执行 1000 次结果都是一样的, 这时这个更新操作就是幂等的
    - 如果是在并发不做线程安全的处理的情况下 update 一千次操作结果可能就不是一样的, 这时并发情况下的 update 操作就不是幂等的
    - 对应到消息队列上来, 就是 **即使受到了多条一样的消息, 也和消费一条消息效果是一样的**

_( icehe : 意思是可以能够去重么? 是不是也允许重复给同一个消费者投递相同的消息多次? 感觉有点歧义 )_

#### 高并发的情况下避免消息重复消费

- A. 唯一ID + 加指纹码, 利用数据库主键去重
    - 优点 : 实现简单
    - 缺点 : 高并发下有数据写入瓶颈
- B. 利用 Redis 的原子性来实现去重
    - 使用 Redis 进行幂等是需要考虑的问题

其它问题

- 是否 DB 落库, 落库后 DB 和 Cache 如何做到保证幂等 ( Redis 和 DB 如何同时成功同时失败 ) ?
- 如果不 DB 落库, 都放在 Redis 中, 如何实现 Redis 和 DB 的数据同步策略? 还有放在缓存中就能百分之百的成功吗?

#### Confirm 确认消息 Return 返回消息

Confirm 消息确认机制

- 消息的确认, 指生产者收到投递消息后, 如果 Broker 收到消息就会给生产者一个应答, 生产者接受应答来确认 Broker 是否收到消息

如何实现 Confirm 确认消息?

- 在 Channel 上开启确认模式 : `channel.confirmSelect()`
- 在 Channel 上添加监听者 : `addConfirmListener` , 根据监听成功和失败的结果, 决定重新发送消息或者记录日志

Return 消息返回机制

- **Return 消息机制处理一些不可路由的消息, 生产者通过指定一个 Exchange 和Routing Key, 把消息送达到某一个队列中去, 然后消费者监听该队列进行消费处理!**
    - _( icehe : Dead Message Queue 死信队列? )_
- 在某些情况下，如果在发送消息的时候当 Exchange 不存在或者指定的 Routing Key 路由找不到, 这个时候如果需要监听这种不可到达的消息, 就要使用 **Return Listener** !
- Mandatory 设置为 true 则会监听器会接受到路由不可达的消息, 然后处理
    - 如果设置为 false, Broker 将会自动删除该消息

#### 消费端限流

假设我们有个场景，首先，我们有个rabbitMQ服务器上有上万条消息未消费，然后我们随便打开一个消费者客户端，会出现：巨量的消息瞬间推送过来，但是我们的消费端无法同时处理这么多数据。

这时就会导致你的服务崩溃。其他情况也会出现问题，比如你的生产者与消费者能力不匹配，在高并发的情况下生产端产生大量消息，消费端无法消费那么多消息。

## 总结

Reference

- RabbitMQ 总结 : https://cloud.tencent.com/developer/article/1654903

### Intro

- RabbitMQ : 一个由 erlang 开发的 **AMQP ( Advanced Message Queuing Protocol )** 的开源实现
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
- _Tracing_ _( 跟踪机制 )_
    - _如果消息异常, 提供了消息跟踪机制, 使用者可以找出发生了什么_
- _Plugin System_ _( 插件机制 )_
    - _提供了许多插件, 从多方面进行扩展, 也可以编写自己的插件_
