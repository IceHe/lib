# 基础知识

## 技术

\*Auth

- 调用接口时使用的认证方式，目前平台使用的认证方式有
    - Basic Auth：用户名密码认证，HTTP header 里增加用户名密码
    - Cookie Auth：浏览器 cookie 认证
    - OAuth
    - OAuth2：参数增加 access_token
    - TAuth：用于后端不同服务器间互相调用接口的认证协议，HTTP header 里增加 Token
    - TAuth2：用于后端不同服务器间互相调用接口的认证协议（ 替代 TAuth ），HTTP header 里增加 Token

前端机

- 处理 web 请求的机器

队列机

- 处理消息队列的机器

长尾数据

- 冷门数据

## 存储

### 数据库

- [MySQL](https://www.mysql.com/)
- [HBase](https://hbase.apache.org/)
- [pika](https://github.com/pika/pika)

### 缓存

[Redis](https://redis.io)

- 开源的 k-v 缓存

[Memcached](https://memcached.org/)（简称 MC）

- 开源的 k-v 缓存

### 消息队列

[kafka](https://kafka.apache.org/)

- 分布式流平台，可用作消息队列

MCQ

## 框架

[Spring Boot](https://spring.io/projects/spring-boot)

- 便捷快速的构建 Spring 项目

[Hystrix](https://github.com/Netflix/Hystrix)

- 服务保护

[Spock](http://spockframework.org/spock/docs/1.1/index.html)

- 测试框架

[Protocol Buffers](https://developers.google.com/protocol-buffers/)

- Google 出品的序列化框架（简称 pb）

[Graphite](https://graphiteapp.org/) / [Grapana](https://grafana.com/)

- 服务监控

## 工具

### 命令行

- 文本处理 : grep / awk / sed / cut
- 系统状态 : top / kill / ps / df
- 文件相关 : whereis / locate / find / du
- 网络状态 : netstat / traceroute / ping
    - `dig` ：网络管理工具，用于查询 DNS 服务器
    - `tcpdump` ：常用的网络包分析工具
- 文件传输 : nc / rsync
- 系统服务 : tomcat / sshd
    - `jstack` ：Stack Trace 打印追踪 Java 线程的栈信息
    - `jmap` ：Memory Map 打印共享内存分布、堆内存细节等（ [ref](https://docs.oracle.com/javase/7/docs/technotes/tools/share/jmap.html) ）
- [命令行的艺术](https://github.com/jlevy/the-art-of-command-line/blob/master/README-zh.md#%E5%89%8D%E8%A8%80)

### 其它

[Docker](https://www.docker.com/)

[Markdown](https://www.markdownguide.org/)

- 文档编辑

[Git](https://git-scm.com/) / [GitLab](https://about.gitlab.com/)

- 代码 & 项目管理

[Maven](https://maven.apache.org/) / [Gradle](https://gradle.org/)

- 构建工具

[正则表达式](https://zh.wikipedia.org/zh-hans/%E6%AD%A3%E5%88%99%E8%A1%A8%E8%BE%BE%E5%BC%8F)

- 文本匹配 & 操作

[Groovy](https://baike.baidu.com/item/Groovy/180590)

- 能够运行在 JVM 上的脚本语言

[log4j2](https://logging.apache.org/log4j/)

- 日志
