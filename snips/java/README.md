# Java

Basic

- [Glossary](/snips/java/glossary.md)

Coding

- [Snippets](/snips/java/snippets.md)

Framework

- [Spock](/snips/java/spock.md) - Unit Tests
- [Spring](/snips/java/spring.md)

Package Manager

- [Maven](/snips/java/maven.md)

Command Line Tools

- jconsole : VM Performance Statistics
- jmap : Stack & Heap

Install Java 8 on CentOS

- Reference : https://www.digitalocean.com/community/tutorials/how-to-install-java-on-centos-and-fedora
- Download Java 8 - Binary Installation : https://www.oracle.com/technetwork/java/javase/downloads/jdk8-downloads-2133151.html

```bash
# 下载
curl -L -b "oraclelicense=a" -O <official_jdk_download_url>
# e.g.
curl -L -b "oraclelicense=a" -O
https://download.oracle.com/otn-pub/java/jdk/8u191-b12/2787e4a523244c269598db4e85c51e0c/jdk-8u191-linux-x64.rpm

# 本地二进制安装
yum localinstall jdk-8u161-linux-x64.rpm

# 更换使用的 Java 版本
alternatives --config java
```
