# Glossary

## JEE

Java technology is both programming language & a platform

- Java EE: Java Platform, Enterprise Edition
- Java SE: Java Platform, Standard Edition
- Java ME: Java Platform, Micro Edition
- Java FX: …

All Java platforms consist of Java Virtual Machine (VM) & an application programming interface (API).

## JDK / JRE

- JRE : Java Runtime Environment
- JDK : Java Development Kit

## EJB

Enterprise JavaBeans

- one of several Java APIs for modular construction of enterprise software.
- a development architecture for building highly scalable and robust enterprise level applications to be deployed on J2EE compliant Application Server such as JBOSS, Web Logic etc.

## JAR

Java Archive

- a package file format typically used to aggregate many Java class files and associated metadata and resources (text, images, etc.) into one file for distribution.

### jar war ear

Created for different purposes.

- .jar : contains __libs, resources, accessories__ files
- .war : contains the web application (that can be deployed on any servlet/jsp container)
    - contains __jsp, html, js__ & other necessary files (for development of web app)
- .ear : .jar & .war are packaged as JAR file with .ear (enterprise archive)

ref : https://stackoverflow.com/questions/5871053/java-war-vs-jar-what-is-the-difference

## Java Data Acces

- JPA : Java Persistence API
- ORM : Object Relational Mapping
- DAO : Data Access Object
    - ref : https://en.wikipedia.org/wiki/Data_access_object
- JDO : Java Data Objects
    - a specification of Java object persistence.

## POJO

POJO: Plain Old Java Object

- Normal Class: A Java class
- Java Beans:
    - All properties private (use getters/setters)
    - A public no-argument constructor
    - Implements Serializable
- A Java object not bound by any restriction other than those forced by the Java Language Specification.
    - Extend prespecified classes
    - Implement prespecified interface
    - Contain prespecified annotations

## JDBC

JDBC : Java Database Connectivity

## Jedis

A client for controlling Reids

## JMS

JMS : Java Message Service

## Maven

- a software project management and comprehension tool.
    - based on POM, it can manage a project's build, reporting & documentation from a central piece of information.
    - ref : https://maven.apache.org/
- a tool that is used for building and managing any Java-based project.
    - ref :  https://maven.apache.org/what-is-maven.html
- others : ant, gradle, make

### Maven Wrapper

- an easy way to ensure a user of your Maven build has everything necessary to run your Maven build.
- ref : https://github.com/takari/maven-wrapper
- can be replaced by IDE (ItelliJ IDEA)

## POM

POM : Project Object Model

- an XML file that contains information about the project and configuration details used by Maven to build the project.
- an XML representation of a Maven project held in a file named `pom.xml`.
- ref : https://maven.apache.org/guides/introduction/introduction-to-the-pom.html

## Hibernate

- It's Hibernate ORM in short.
- a high-performance Object/Relational persistence and query service, which is licensed under the open source LGPL and is free to download.
- not only takes care of the mapping from Java classes to database tables (and from Java data types to SQL data types), but also provides data query and retrieval facilities.
- ref : https://www.tutorialspoint.com/hibernate/index.htm

H2 Database Engine

- a relational database management system written in Java.
- ref : https://en.wikipedia.org/wiki/H2_(DBMS)

Getter & Setter

- https://stackoverflow.com/questions/1568091/why-use-getters-and-setters-accessors/1568230#1568230

## JBoss

- 一个基于J2EE的开放源代码的应用服务器。
- 需要的内存和硬盘空间比较小。
- 安装非常简单。先解压缩JBoss打包文件再配置一些环境变量就可以了。
- 能够"热部署"，部署BEAN只是简单拷贝BEAN的JAR文件到部署路径下就可以了。如果没有加载就加载它；如果已经加载了就自动更新。
- JBoss与Web服务器在同一个Java虚拟机中运行，Servlet调用EJB不经过网络，从而大大提高运行效率，提升安全性能。
- Jboss支持集群。

## Slf4j

- Causes lombok to generate a logger field.
- ref : https://projectlombok.org/api/lombok/extern/slf4j/Slf4j.html

## Lombok

- It's a Java library that automatically plugs into your editor and build tools, spicing up your java.
- __Never write another getter or equals method again.__
    - (Early access to future Java features such as `val`, and much more.)
- ref : https://projectlombok.org/

## Groovy

- Groovy 是 用于 Java 虚拟机的一种敏捷的动态语言，它是一种成熟的面向对象编程语言，既可以用于面向对象编程，又可以用作纯粹的脚本语言。使用该种语言不必编写过多的代码，同时又具有闭包和动态语言中的其他特性。
- Groovy 是 JVM 的一个替代语言（替代是指可以用 Groovy 在 Java 平台上进行 Java 编程），使用方式基本与使用  Java 代码的方式相同，该语言特别适合与 Spring 的动态语言支持一起使用，设计时充分考虑了 Java 集成，这使 Groovy 与 Java 代码的互操作很容易。
- ref : https://baike.baidu.com/item/Groovy/180590

## BlueJ

A free Java Development Environment designed for beginners, used by millions worldwide.

## Others

JNDI : Java Naming and Directory Interface

- API for a directory service

JTA : Java Transaction API

- for distributed transaction.

JAXP : Java API for XML files