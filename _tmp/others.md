# others

## wireshark

https://www.wireshark.org/#learnWS

http://blogread.cn/it/article/7294?f=wb_blogread

## diff HTTP API & RPC API

## PPT Template

Reveal.js : https://github.com/hakimel/reveal.js

Others : https://ppt.baomitu.com/editor#/

## 设计模式

Design Patterns : 个人化的简要笔记。

- 大四华为实习期间（加班可忙了… 抽空）看完了国人写的《[大话设计模式](https://book.douban.com/subject/2334288/)》，以及最经典的《[设计模式](https://book.douban.com/subject/1099305/)》。
    - 《大话设计模式》试图列举更简明的例子让读者更快速上手设计模式，但是例子并不到位，看完之后还是对部分设计模式不明所以。所以说这本重新演绎「设计模式」的书并不成功…
    - 《[设计模式](https://book.douban.com/subject/1099305/)》更高明，解说得更清楚明了，例子更精到。我先看完的《大话设计模式》，再看的《设计模式》，才对之前不理解的设计模式恍然大悟。
    - __建议：只看最经典《[设计模式](https://book.douban.com/subject/1099305/)》就够了。__
- 由于华为的保密条例和措施，电子文本笔记是不能带出来的，手写笔记太麻烦就算了。现在后悔了，毕竟学到的知识要总结，然后消化了才算是自己的！
- 为了总结、复习设计模式写下本文。以下只会简单地以我自己能够理解的语言来总结，可能只有简单的一段话甚至一句话，顶多只有一个简单的例子。
    - 一切以简便快捷地激活、辅助我对设计模式的记忆为目的。（可能你们会看得云里雾里）

TODO

## 北京落户

先排居住证

需要在公司排队办（申请北京积分落户的前提）

【链接】北京市居住证服务平台
https://www.bjjzz.gov.cn/bjsjzzfwpt/usernew/space

【链接】居住证办理服务-首都之窗-北京市政务门户网
http://www.beijing.gov.cn/zhuanti/jzz/

【链接】申领《北京市居住证》
http://www.beijing.gov.cn/zhuanti/jzz/blzn/t1458442.htm

在 HR 门户，个人信息里，可以找到一个链接
http://www.bjrbj.gov.cn/jflh/

## Axb Quotation

> boss 技术语录：记录内容并非原话

缓存

> 只要 DB 能活下来，缓存（内存消耗）越小越好

可用性

> 既然队列是持久化的，也需要写到硬盘上，那么 MySQL 也是写到硬盘上的。那为什么不直接让数据更分散一些，让服务器直接将数据写到 MySQL 上，反正花销也是差不多差不多的。网络连接带宽消耗更少。那是为什么呢？我不想告诉你答案。但是我会提出这个问题。

单主键 id

> - 大翻页：page_count
> - 游标：cursor 根据阅读到哪来决定输出的数据
> - id 解析出时间：方便向前、向后翻页

## 文档套路背景的写法！

scheme

- why you need it（需要 id 唯一标识某个东西）（痛点）
    - 因为没有 id 就没法唯一标识一个媒体
    - 所以我们需要 id
- what you need from it（id 可以用来查询相关信息）（需求）
    - id 可以用来查询媒体信息
    - id 可以直接算出创建日期
- what it should be（id 该是啥样子的）（功能：可能包含技术实现）
    - id 是 long 类型，包含创建日期

## Smart 法则

* S 代表具体( Specific )，描述不能笼统；
* M 代表可度量( Measurable )，指任务可数量化或者行为化；
* A 代表可实现( Attainable )，指任务在付出努力的情况下可以实现，避免设立过高或过低的目标；
* R 代表相关性( Relevant ），指任务与其它目标相关联；
* T 代表有时限( Time-bound )，注重完成绩效指标的特定期限。

## 概率论/统计学

平均数 mean
中位数 median
众数 mode {of the set of numbers}

## Service 101

https://mp.weixin.qq.com/s?__biz=MzA3NDM0ODQwMw==&mid=2649827699&idx=1&sn=e97071f2f049b8027c3105b8bd4ade70&chksm=8704ab6fb0732279f3c1b463653a812bbaef4d921fe65fe82cfb397765b01a9c5552a18307fe&scene=21#wechat_redirect

## 软件工程师需要了解的网络知识：从铜线到HTTP

https://weibo.com/2277420203/G06QNi9zC?type=comment#_rnd1537542666970

## 0基础想转行的朋友通过Java入行

https://weibo.com/2387178543/G6hNpFPNk?type=comment

## spring boot 空实现 QPS 压力测试

## 工作：使用 transcode 项目的 center 模块来上手
