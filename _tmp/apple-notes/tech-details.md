# Tech Details

替换 Redis 实例

用域名调用 Redis 实例，
在 DNS 上修改域名对应的 IP 即可。

---

阅读数的实现

阅读数完全存在 Redis 里，
用线性拟合的策略来寸

用 Redis 自带内含的功能去实现

1~100  每次写 +1
100~1,000 每 5 次要写读数，随机丢弃其中 4 次，然后命中的那一次 + 5
1,000~10,000 … 依次类推，类似的算法，避免过多的写法。

现在希望变成可以完全每次 +1 的模式。
例如从 8 台机器，散点哈希到 128 台实例上，以分担写压力，看能不能行

---

发微博 用队列

- MPS 发推送 用队列
- mid 用统一的发号器，避免 mid 重复。
- 微博 用多层的 缓存来顶住压力！
- 找文章来看！(微博技术新兵训练营)

发号器：生成唯一的 ID 号

- Twitter 的 雪花算法 (snowflake)

服务机型要标准化

* Facebook 只有六种标准机型
* Google 只有十种标准机型

机型：（自己的猜想）

* 计算密集型（CPU型？显卡型）
* 内存型（缓存性）
* IO型（存储型？硬盘型？）
* GPU型（显卡型）

FB 机型：OCP 六种（肖鹏截图提供）？
（OCP: Open Compute Project）

* 网络
* 数据中心
* Hadoop
* 小文件存储
* 高速缓存
* 冷存储

https://en.wikipedia.org/wiki/Open_Compute_Project

![](ocp.png)

---
技术细节速记

头部用户分级 C1、C2、C3

统计 30 天内发的微博的总阅读数
C1 是 1000W 阅读数
C2 是 100W
C3 是 10W

每天发博数

按照经验来看的话，大概是 10 ~ 50 条

---

cache value

protocol buffer 序列化/反序列化
quicklz 解压

加起来不到1ms

Redis 内存碎片，重启
Memcached 钙化

---

feed cache

3 days max 50 条
30 days 1 month max 200 条

---

MAPI QPS 峰值

12:30 午高峰 40w
22:30 晚高峰 55w

（中午）鹿晗公开女友事件峰值 118w

---

微博 feed QPS

日常 1w+
春节 2.4~2.5w (?)

---

微博 评论 QPS

日常 2w+（忘了）
春节 ????

---

替换 Redis 实例

用域名调用 Redis 实例，
在 DNS 上修改域名对应的 IP 即可。
