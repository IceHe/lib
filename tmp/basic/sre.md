# SRE

> Site Reliable Engineering

## 日志收集

现在

- PHP -socket-> rsyslog -script-> kafka -> consumer -> ES -> Kibana
    - PHP 用 socket 发到本地的 rsyslog 模块
        - 较短的用 udp 传
        - 较长的用 tcp 传
    - 脚本决定哪些日志的处理
        - 丢弃就好
        - 格式化
        - 抽样（1%/?）
    - kafka
        - 持久化
        - 可重复消费
        - 解耦
    - 消费者 Java / Python

以前

- rsyslog 传给另一个 rsyslog
    - 中心 rsyslog 服务的处理逻辑较多，处理不过来，导致缓冲区满了之后，会丢失日志。

## 慢速比

> 简单地说，超过 2s（RTT）响应的请求占所有请求的比例

过滤条件

- 时间太长的 RT（>30s），很可能是网络中断了（切换 WiFi/移动网络，乘坐交通工具）
- 成功的响应的慢速比，跟失败的响应分开算。

## 机器管理

Marathon <-> Mesos Master <-> Mesos Slave

- Marathon 知道有哪些资源：CPU/mem/硬盘
    - 也知道具体服务需要多少资源（cpu/mem/硬盘）
- Marathon 告诉 Mesos Master 在哪些机器部署哪些服务，资源限制是（cpu/mem/硬盘）
- Mesos Master 对 Mesos Slave 进行操作

为什么不用 k8s？

- 当年 k8s 还不成熟，就用了 Marathon + Mesos + DCP（微博自研的）

## Nginx 负载均衡

- 简单粗暴：轮询（稳定，没有额外的消耗；而且其他复杂的策略并不能更好）
- 有哪些主机提供服务，由 consul 获取

## 机器核数

物理机 32 核，开超线程变成 64 核

- nginx
    - worker_processes auto
        - 线上看这样设置，进程数跟 CPU 核数差不多
    - cpu_affiity auto
- php-fpm
    - Ref : http://php.net/manual/en/install.fpm.configuration.php
    - pm : static
        - 常驻进程，对突如其来的峰值有利
    - max_children
        - 以前 300
        - 现在 200
    - max_requests 1500

References

- Nginx 與 PHP-FPM 最佳化效能設定教學與技巧 - G. T. Wang : https://blog.gtwang.org/linux/nginx-php-fpm-configuration-optimization/

---

cgroups 资源限制

- CPU
- Memeory
    - 已关闭 swap（避免 IO 骤然上升，导致性能急速下降）
    - 内存超过限制，系统通常会 kill 掉 php-fpm 的紫禁城
        - 当然也可能
- ……

## 降级

### PHP

- ini 配置文件用 rsync 推到线上机器
- yaconf 读取到 ini 文件发生变化，重新加载配置内容到内存
- PHP 代码读到降级开关的最新值

### Java

- HTTP 接口控制开关
- 获得服务池中服务的所有相关 IP 和 Port
- curl 它们改变开关值

## Weibo DCP

其实是用 puppet（自动化运维工具）来管理一堆机器

- 上线管理都是一台 puppet 的

后来也有部门用 k8s，不过还没铺开

## 扩缩容算法

https://zh.numberempire.com/graphingcalculator.php

（详见相册）
