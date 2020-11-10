# ActiveMQ

> **Flexible & Powerful** Open Source **Multi-Protocol Messaging**

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
