# Glossary

## Common

Java

> Java technology is both programming language & a platform
> - Java EE: Java Platform, Enterprise Edition
> - Java SE: Java Platform, Standard Edition
> - Java ME: Java Platform, Micro Edition
> - Java FX: ?
> All Java platforms consist of Java Virtual Machine (VM) & an application programming interface (API).

JRE: Java Runtime Environment

JDK: Java Development Kit

EJB: Enterprise JavaBeans

> one of several Java APIs for modular construction of enterprise software.

JAR: Java Archive

> a package file format typically used to aggregate many Java class files and associated metadata and resources (text, images, etc.) into one file for distribution.

.jar .war .ear

- Created for different purposes.
- .jar: contains __libs, resources, accessories__ files
- .war: contains the web application (that can be deployed on any servlet/jsp container)
    - contains __jsp, html, js__ & other necessary files (for development of web app)
- .ear: .jar & .war are packaged as JAR file with .ear (enterprise archive)
- <https://stackoverflow.com/questions/5871053/java-war-vs-jar-what-is-the-difference>

ORM: Object Relational Mapping

JPA: Java Persistence API

DAO: Data Access Object

> <https://en.wikipedia.org/wiki/Data_access_object>

JDO: Java Data Objects

> a specification of Java object persistence.

POJO: Plain Old Java Object

- Normal Class: A Java class

- Java Beans:
    - All properties private (use getters/setters)
    - A public no-argument constructor
    - Implements Serializable

- POJO:
    - A Java object not bound by any restriction other than those forced by the Java Language Specification.
        - Extend prespecified classes
        - Implement prespecified interface
        - Contain prespecified annotations

Hibernate

> It's Hibernate ORM in short.
> a high-performance Object/Relational persistence and query service, which is licensed under the open source LGPL and is free to download.
> not only takes care of the mapping from Java classes to database tables (and from Java data types to SQL data types), but also provides data query and retrieval facilities.
- <https://www.tutorialspoint.com/hibernate/index.htm>

H2 Database Engine

> a relational database management system written in Java.
- <https://en.wikipedia.org/wiki/H2_(DBMS)>

Getter & Setter

- <https://stackoverflow.com/questions/1568091/why-use-getters-and-setters-accessors/1568230#1568230>

SQL `SERIAL` TYPE

> an alias for `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE`

Data Types (TODO)

- ArrayList
- Map

JDBC: Java Database Connectivity

JNDI: Java Naming and Directory Interface

> API for a directory service

JTA: Java Transaction API

> for distributed transaction.

JAXP: Java API for XML files

JMS: Java Message Service

Jedis

- A client for controlling Reids

Maven

> a software project management and comprehension tool.
> Based on POM, it can manage a project's build, reporting & documentation from a central piece of information.
- <https://maven.apache.org/>
> a tool that is used for building and managing any Java-based project.
- <https://maven.apache.org/what-is-maven.html>
- others: ant, gradle, make

POM: Project Object Model

> an XML file that contains information about the project and configuration details used by Maven to build the project.
> an XML representation of a Maven project held in a file named `pom.xml`.
- <https://maven.apache.org/guides/introduction/introduction-to-the-pom.html>

Maven Wrapper

> an easy way to ensure a user of your Maven build has everything necessary to run your Maven build.
- <https://github.com/takari/maven-wrapper>
- can be replaced by IDE (ItelliJ IDEA)

JBoss

> 一个基于J2EE的开放源代码的应用服务器。
> 需要的内存和硬盘空间比较小。
> 安装非常简单。先解压缩JBoss打包文件再配置一些环境变量就可以了。
> 能够"热部署"，部署BEAN只是简单拷贝BEAN的JAR文件到部署路径下就可以了。如果没有加载就加载它；如果已经加载了就自动更新。
> JBoss与Web服务器在同一个Java虚拟机中运行，Servlet调用EJB不经过网络，从而大大提高运行效率，提升安全性能。
> Jboss支持集群。

Slf4j

> Causes lombok to generate a logger field.
- <https://projectlombok.org/api/lombok/extern/slf4j/Slf4j.html>

Lombok

> It's a Java library that automatically plugs into your editor and build tools, spicing up your java.
> __Never write another getter or equals method again.__
> (Early access to future Java features such as `val`, and much more.)
- <https://projectlombok.org/>

Groovy

> Groovy 是 用于 Java 虚拟机的一种敏捷的动态语言，它是一种成熟的面向对象编程语言，既可以用于面向对象编程，又可以用作纯粹的脚本语言。使用该种语言不必编写过多的代码，同时又具有闭包和动态语言中的其他特性。
> Groovy 是 JVM 的一个替代语言（替代是指可以用 Groovy 在 Java 平台上进行 Java 编程），使用方式基本与使用  Java 代码的方式相同，该语言特别适合与 Spring 的动态语言支持一起使用，设计时充分考虑了 Java 集成，这使 Groovy 与 Java 代码的互操作很容易。
- <https://baike.baidu.com/item/Groovy/180590>

Other Tips

> StringUtils.isBlank(str)

``` java
@Slf4j
……
log.warn("updateObject tryLock fail, objectId={}", objectId);
```

## Others

ACL: Access Control List

> 访问控制列表，是路由器和交换机接口的指令列表，用来控制端口进出的数据包。ACL 适用于所有的被路由协议，如 IP、IPX、AppleTalk 等

BlueJ

> A free Java Development Environment designed for beginners, used by millions worldwide.

LVS: Linus Virtual Server

OSGi: Open Services Gateway initiative

> Java 动态化模块化系统的一系列规范。可以认为是 Java 平台的模块层。

reverse proxy

> 反向代理方式，是指以代理服务器来接受internet上的连接请求，然后将请求转发给内部网络上的服务器，并将从服务器上得到的结果返回给internet上请求连接的客户端，此时代理服务器对外就表现为一个反向代理服务器。
> In computer networks, a reverse proxy is a type of proxy server that retrieves resources on behalf of a client from one or more servers. These resources are then returned to the client as if they originated from the Web server itself.

RESTful

> an application program interface (API) that uses HTTP requests to GET, PUT, POST & DELETE data.
> REST: REpresentational State Transfer

SOAP: Simple Object Access Protocol

> a messaging protocol specification for exchanging structured information in the implementation of web services in computer networks.
> based on XML

SSL: Secure Sockets Layer

TLS: Transport Layer Security

Varnish Cache: a cach

> a web application accelerator aka. __a caching HTTP reverse proxy__

RAID

> Redundant Array of Independent Disks
> originally Redundant Array of Inexpensive Disks

Redis

> RDB: Redis DataBase
> AOF: Append Only File
> 执行过的 __写指令__ 都记录下来，在数据恢复时按照从前到后的顺序再将指令都执行一遍

MySQL

> binlog: Binary Log（感觉好像 Redis AOF 就是参考它来实现的，过往的最佳实践）
- <https://dev.mysql.com/doc/refman/8.0/en/binary-log.html>
- 整型数据 <https://dev.mysql.com/doc/refman/5.5/en/integer-types.html>

- Java Composity Key 联合主键
    Differ JpaRepository & CrudRepository
    <https://stackoverflow.com/questions/14014086/what-is-difference-between-crudrepository-and-jparepository-interfaces-in-spring>

- SQL Time Type? `timestamp` vs `datetime`
    <https://www.codeproject.com/Tips/1215635/MySQL-DATETIME-vs-TIMESTAMP>
    <https://stackoverflow.com/questions/409286/should-i-use-the-datetime-or-timestamp-data-type-in-mysql>

Protocol Buffer

> serialize 序列化 协议
<https://developers.google.com/protocol-buffers/>

unsigned long/int not found in Java?

> unsigned 应该在 Java 中不存在，Long 和 Integer 覆盖了相关的使用场景？
> 注意 Long、Integer 等都有 Long.parseLong() 和 Long.parseUnsignedLong() 等方法，
>   然后直接给声明 long 类型的变量进行赋值。

MCQ : MemcacheQ

> Simple Queue Service over Memcache
- <http://memcachedb.org/memcacheq/>
- MemcacheDB <http://memcachedb.org/>
- Memcached <http://memcached.org/>

Redis : REmote DIctionary Server

> 部分基本知识：
>
> 1. 任何二进制的序列都可以作为 key 使用
> 2. Redis 有统一的规则来设计 key
> 3. 对 key-value 允许的最大长度是 512MB
>
> 应用场景：
>
> 1. 最常用的就是 __会话缓存__
> 2. __消息队列__，比如支付
> 3. 活动 __排行榜__ 或 __计数__
> 4. __发布、订阅__ 消息（消息通知）（pubsub？）
> 5. 商品列表、评论列表等

- <https://www.itcodemonkey.com/article/3506.html>

kafka

> 使用 __消息系统__ 的好处：
> 1. 解耦：
>   允许你独立的扩展或修改两边的处理过程，只要确保它们遵守同样的接口约束。
> 2. 冗余：
>   消息队列把数据进行持久化直到它们已经被完全处理，通过这一方式规避了数据丢失风险。许多消息队列所采用的"插入-获取-删除"范式中，在把一个消息从队列中删除之前，需要你的处理系统明确的指出该消息已经被处理完毕，从而确保你的数据被安全的保存直到你使用完毕。
> 3. 扩展性：
>   因为消息队列解耦了你的处理过程，所以增大消息入队和处理的频率是很容易的，只要另外增加处理过程即可。
> 4. 灵活性 & 峰值处理能力：
>   在访问量剧增的情况下，应用仍然需要继续发挥作用，但是这样的突发流量并不常见。如果为以能处理这类峰值访问为标准来投入资源随时待命无疑是巨大的浪费。使用消息队列能够使关键组件顶住突发的访问压力，而不会因为突发的超负荷的请求而完全崩溃。
> 5. 可恢复性：
>   系统的一部分组件失效时，不会影响到整个系统。消息队列降低了进程间的耦合度，所以即使一个处理消息的进程挂掉，加入队列中的消息仍然可以在系统恢复后被处理。
> 6. 顺序保证：
>   在大多使用场景下，数据处理的顺序都很重要。大部分消息队列本来就是排序的，并且能保证数据会按照特定的顺序来处理。（Kafka 保证一个 Partition 内的消息的有序性）
> 7. 缓冲：
>   有助于控制和优化数据流经过系统的速度，解决生产消息和消费消息的处理速度不一致的情况。
> 8. 异步通信：
>   很多时候，用户不想也不需要立即处理消息。消息队列提供了异步处理机制，允许用户把一个消息放入队列，但并不立即处理它。想向队列中放入多少消息就放多少，然后在需要的时候再去处理它们。
>
> kafka 相关术语：
> 1. producer：
>   消息生产者，发布消息到 kafka 集群的终端或服务。
> 2. broker：
>   kafka 集群中包含的服务器。
> 3. topic：
>   每条发布到 kafka 集群的消息属于的类别，即 kafka 是面向 topic 的。
> 4. partition：
>   partition 是物理上的概念，每个 topic 包含一个或多个 partition。kafka 分配的单位是 partition。
> 5. consumer：
>   从 kafka 集群中消费消息的终端或服务。
> 6. Consumer group：
>   high-level consumer API 中，每个 consumer 都属于一个 consumer group，每条消息只能被 consumer group 中的一个 Consumer 消费，但可以被多个 consumer group 消费。
> 7. replica：
>   partition 的副本，保障 partition 的高可用。
> 8. leader：
>   replica 中的一个角色， producer 和 consumer 只跟 leader 交互。
> 9. follower：
>   replica 中的一个角色，从 leader 中复制数据。
> 10. controller：
>   kafka 集群中的其中一个服务器，用来进行 leader election 以及 各种 failover。
> 12. zookeeper：
> kafka 通过 zookeeper 来存储集群的 meta 信息。
- 很棒的笔记总结！<https://www.cnblogs.com/cyfonly/p/5954614.html>
- 官方文档 <https://kafka.apache.org/documentation/#introduction>
- benchmark <https://engineering.linkedin.com/kafka/benchmarking-apache-kafka-2-million-writes-second-three-cheap-machines>

haproxy

keepalived

SDWAN

> Software-Defined WAN (SDWAN)
> An SD-WAN simplifies the management and operation of a WAN by decoupling (separating) the networking hardware from its control mechanism. This concept is similar to how software-defined networking implements virtualization technology to improve data center management and operation.
- <https://en.wikipedia.org/wiki/SD-WAN>

PowerDNS

> PowerDNS, founded in the late 1990s, is a premier supplier of open source DNS software, services and support.
- <https://www.powerdns.com/>
