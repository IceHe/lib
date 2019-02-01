# Load Balance

> 负载均衡

## 调度

Ref

- 负载均衡-LVS介绍、DR搭建 : https://www.jianshu.com/p/93636c195b40

静态调度

- rb - round robin : 轮询调度
- wrr - weight : 加权，性能好的服务器获得更多的流量
- dh - destination hashing : 目标地址散列（感觉意义不大，直接 DNS 到固定 IP 就好）
- sh - source hashing : 源地址散列
    - 有利于根据 ip / uid 维持 session 信息

动态调度

- lc - least connection : 最少连接
    - e.g. 简单公式：active * 256 + inactive
- wlc - weighted least-connection scheduling : 加权最少连接
    - e.g. 简单公式：active * 256 + inactive / weight（谁小挑谁）
- sed - shortest expected delay : 最短期望延迟（基于 wlc）
    - e.g. 简单公式：(active + 1 ) * 256 / weight（谁小挑谁）
- nq - never queue : 永不排队（没看懂思路……?）
    - 懵逼「无需队列，如果有台realserver的连接数＝0就直接分配过去，不需要在进行sed运算」？
- LBLC - Locality-Based Least Connection : 基于局部性的最少连接（没说怎么实现？看起来比较麻烦）
    - 大概理解？常用于 Cache 系统，同一目标 IP 的请求尽量打到同一个台服务器，提高缓存命中率