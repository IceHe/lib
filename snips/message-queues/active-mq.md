# ActiveMQ

**Flexible & Powerful** Open Source **Multi-Protocol Messaging**

---

References

- Apache ActiveMQ : http://activemq.apache.org
    - ActiveMQ 5 : http://activemq.apache.org/components/classic
        - Getting Started : http://activemq.apache.org/getting-started
        - FAQ : http://activemq.apache.org/faq
    - ActiveMQ Artemis : http://activemq.apache.org/components/artemis
        - _( maybe future ActiveMQ 6 )_
        - Documentation : http://activemq.apache.org/components/artemis/documentation
            - Latest ( HTML ) : http://activemq.apache.org/components/artemis/documentation/latest/
- Difference Between ActiveMQ and RabbitMQ : https://www.educba.com/activemq-vs-rabbitmq

## Comparison

**Difference Between ActiveMQ and RabbitMQ**

- **RabbitMQ** is the **best implementation of the AMQP protocol**.
    - It executes a broker architecture where the messages are **queued on the central nodes** before sending them to the destination.
- **ActiveMQ** works on middle ground _( 在中间地带 )_ and **deployed with a broker and P2P architecture**.
    - It is known as the swiss army knife _( 瑞士军刀 )_ of messaging.

### Head to Head Comparison of ActiveMQ and RabbitMQ

Programming Language

- ActiveMQ : Java
- RabbitMQ : Erlang or [OTP](https://en.wikipedia.org/wiki/Open_Telecom_Platform#:~:text=OTP%20is%20a%20collection%20of,Erlang%2FOTP%20as%20open%20source.) language

Working Principle

- ActiveMQ is used in enterprise projects to **store multiple instances and supports clustering environments**.
    - _( icehe : 不太理解这句话 )_
- RabbitMQ is a message broker which is **executed in low-level AMQP protocol and acts as an intermediator between two application** in the communication process.

Multiple Languages

- ActiveMQ supports Java(?), C, C#, Haxe, Node.js, Perl, Racket, Python, and Ruby on Rails
- RabbitMQ supports multiple languages such as Java, Ruby, Python, PHP, Perl, Rust, Go, JavaScript, C and C++

Applied Protocols

- ActiveMQ : OpenWire, STOMP, WSIF, **WS**, AUTO, **AMQP**, and MQTT
- RabbitMQ : **HTTP**, MQTT, STOMP, and **AMQP**

Number of Brokers

- ActiveMQ can be complemented with **2 brokers along with P2P architecture**.
- RabbitMQ : **One broker is required**.

Need for Administration

- ActiveMQ is based on Web Console which is a web-based administration tool.
- RabbitMQ requires administration tool support.

### Comparison of Table Between ActiveMQ and RabbitMQ

|Basis of Comparison|ActiveMQ|RabbitMQ|
|-|-|-|
|Programming Language|Java|written by Erlang or OTP language|
|Working Principle|It is used in enterprise projects to store multiple instances and supports clustering environments.|RabbitMQ is a message broker which is executed in low-level AMQP protocol and acts as an intermediator between two application in the communication process.|
|Accessible to Opensource|Yes, it is accessible to open source.|Yes, RabbitMQ is accessible to open source.|
|Multiple Languages|It supports C, C#, Haxe, Node.js, Perl, Racket, Python, and Ruby on Rails.|It supports multiple languages such as Java, Ruby, Python, PHP, Perl Rust, Go, JavaScript, C and C++.|
|Preferred companies|Dopplr, gnip, CSC, STG and the University of Washington.|It is mainly used by Redsit, Vine, CircleCl, 9GAG and Code School|
|Applied Protocols|OpenWire, Stomp, WSIF, WS, AUTO, AMQP and MQTT are the applied protocols.|HTTP, MQTT, STOMP, and AMQP are the implemented protocols.|
|Number of Brokers|It can be implemented with two brokers along with P2P architecture.|One broker is required.|
|Need for Administration|It is based on Web Console which is a web-based administration tool.|It requires administration tool support.|
|Tools used|It is a multi-protocol supported message broker.|RabbitMQ HTTP-works on management plugin.|RabbitMQ admin-browser works on the user interface.|
|Training Programs|Attune, Savoir, NobleProg, and TytoEASE.|Pivotal Software, Erlang solutions, LearnQuest and Open source Architect|
|Cost|It is freely available.|It is freely available.|
|Methods of synchronization|It is configured with the synchronous method but it can be modified into asynchronous by modifying the setting panel.|It works on both synchronous and asynchronous methods.|
|Message patterns|PUB-SUB and message queue are available message patterns.|It has general message patterns such as Message Queue, PUB-SUB and RPC and Routing.|
|Future directions|The development team of ActiveMQ and Active Artemis which the progress made in each step can be reflected in the Apache website.|The update details can be checked in RabbitMQ's changelog and developers make constant updates fixing the bugs and enhanced performance.|
|Cross-Platform|Yes, it is applicable.|Yes, it is possible.|

<!--

### Key Difference between ActiveMQ and RabbitMQ

1\. Basics

- ActiveMQ is an open-source message broker is **scripted in Java which is based on Java Message Service client**
    - whereas RabbitMQ is **implemented on Advanced Message Queueing protocol.**

2\. License

- omitted…

3\. Strengths

- RabbitMQ works based on the center which makes this a unique approach.
    - RabbitMQ is very portable and user-friendly.
    - Because the **huge actions such as load balancing or persistent message queuing runs only on a limited line of code.**
    - But this approach is **less scalable and slow because of its latency addition from the central node and size of the message envelope.**
- ActiveMQ is **easier to implement and provides advanced features** such as clustering, caching, logging, and message storage.

4\.

- RabbitMQ is **embedded in applications and acts as midway services.**
    - It differentiates support encryption, storing data in the disk as pre-planned in case of an outage, making of clusters, duplication of services to have high reliability.
    - It is deployed on the OTP platform that assures maximum scalability and stability of the queue that acts as a key node of the entire system.

5\.

- ActiveMQ comprises of Java Message Service client which has the ability to supports multiple clients or servers.
    - The attributes like computer clustering support the ActiveMQ to manage the communication system.
    - _The versions of ActiveMQ are ActiveMQ Artemis and ActiveMQ 5 Classic._
- RabbitMQ is implemented to design the Advanced Message Queuing Protocol.
    - It is stretched out to support different protocols such as MQTT and STOMP.
    - Some of the features of RabbitMQ are rapid synchronous messaging, advanced tools and plugin, distributed deployment, developer-friendly, and centralized management.

6\.

- ActiveMQ 5 Classic is implemented with Java Message Service 1.1 with a pluggable architecture.
    - Here there is a separate network of brokers allotted for distribution load.
- ActiveMQ Artemis gives an amazing performance and deployed in non-blocking architecture for event flow of messaging applications with 1.1 and 2.0 of JMS.
    - It has an adaptable clustering for distributing the load.
    - It is a powerful addressing method that provides easy migration.

7\.

- RabbitMQ has many advantages that support multiple messaging protocols, delivering acknowledgment and message queue.
    - It is enabled with various languages such as Python, .NET, and Java.
    - It can also make the developer use applications such as Chef, Docker, and Puppet.
    - It gives high throughput and availability by developing possible clusters.
    - It can easily handle the public and private cloud by the support of pluggable authentication and authorization.
    - The HTTP-API is a command-line tool and its user interface helps in managing and monitoring the RabbitMQ.

-->

## Intro

- Apache ActiveMQ™ is the most popular open source, **multi-protocol, Java-based messaging server.**
    - It supports industry standard protocols so users get the benefits of client choices across a broad range of languages and platforms.
    - Connectivity from C, C++, Python, .Net, and more is available.
    - Integrate your multi-platform applications using the ubiquitous AMQP protocol.
    - **Exchange messages between your web applications <u>using STOMP over websockets</u>.**
    - Manage your IoT devices using MQTT.
    - Support your existing JMS infrastructure and beyond.
    - ActiveMQ offers the power and flexibility to support any messaging use-case.
- There are currently two "flavors" of ActiveMQ available :
    - the **"classic" 5.x broker** and
    - the **"next generation" Artemis broker**.
- **Once Artemis reaches a sufficient level of feature parity with the 5.x code-base it will become ActiveMQ 6.**
    - Initial migration documentation is available.

## ActiveMQ 5

Reference

- ActiveMQ 5 : http://activemq.apache.org/components/classic

Features

- Supports a variety of Cross Language Clients and Protocols from Java, C, C++, C#, Ruby, Perl, Python, PHP
    - OpenWire for high performance clients in Java, C, C++, C#
    - Stomp support so that clients can be written easily in C, Ruby, Perl, Python, PHP, ActionScript/Flash, Smalltalk to talk to ActiveMQ as well as any other popular Message Broker
    - AMQP v1.0 support
    - MQTT v3.1 support allowing for connections in an IoT environment.
- full support for the **Enterprise Integration Patterns** both in the JMS client and the Message Broker
- Supports many advanced features such as **Message Groups**, **Virtual Destinations**, **Wildcards** and **Composite Destinations**
- Fully supports JMS 1.1 and J2EE 1.4 with support for **transient, persistent, transactional and XA messaging**
- Spring Support so that ActiveMQ can be **easily embedded into Spring applications** and configured using Spring’s XML configuration mechanism
- Tested inside popular J2EE servers such as TomEE, Geronimo, JBoss, GlassFish and WebLogic
- Includes JCA 1.5 resource adaptors for inbound & outbound messaging so that ActiveMQ should auto-deploy in any J2EE 1.4 compliant server
- **Supports pluggable transport protocols** such as in-VM, TCP, SSL, NIO, UDP, multicast, JGroups and JXTA transports
- Supports very **fast persistence using JDBC along with a high performance journal**
- Designed for high performance clustering, client-server, peer based communication
- REST API to provide technology agnostic and language neutral web based API to messaging
- Ajax to support web streaming support to web browsers using pure DHTML, allowing web browsers to be part of the messaging fabric
- CXF and Axis Support so that ActiveMQ can be easily dropped into either of these web service stacks to provide reliable messaging
- Can be used as an in memory JMS provider, ideal for unit testing JMS

[Find out more](http://activemq.apache.org/features)

## ActiveMQ Artemis

_( maybe future ActiveMQ 6 )_

Reference

- ActiveMQ Artemis : http://activemq.apache.org/components/artemis
