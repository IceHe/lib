# Cache Patterns

缓存模式

---

References

- [缓存更新套路](https://coolshell.cn/articles/17416.html)
- [AxiaEpoch 2021-08-27 21:23 的微博](https://weibo.com/1671040287/KvqWpmgqd)

## Intro

> ~~先删除缓存, 然后再更新数据库, 而后续的操作会把数据再装载的缓存中.~~

这个是逻辑是错误的. 因为两个并发操作, 一个是更新操作, 另一个是查询操作:

1. 更新操作删除缓存后
1. 查询操作没有命中缓存
1. 先把老数据读出来后放到缓存中
1. 然后更新操作更新了数据库

于是, 在缓存中的数据还是老的, 导致缓存中的数据是脏的, 而且在 expire 或 evict 之前该数据将一直脏下去.

先不讨论更新缓存和更新数据这两个操作应该是一个事务的事, 或是事务失败的可能性，
我们先假设更新数据库和更新缓存都可以成功的情况( 先保证成功情况的代码逻辑的正确性 ) .

更新缓存的的 Design Pattern 有 4 种:

- Cache Aside
- Read Through
- Write Through
- Write behind caching

## Cache Aside

- 失效: 应用程序先从cache取数据，没有得到，则从数据库中取数据，成功后，放到缓存中。
- 命中: 应用程序从cache中取数据，取到后返回。
- 更新: 先把数据存到数据库中，成功后，再让缓存失效。

![Cache-Aside-Design-Pattern-Flow.png](_images/Cache-Aside-Design-Pattern-Flow.png)

![Updating-Data-using-the-Cache-Aside-Pattern-Flow.png](_images/Updating-Data-using-the-Cache-Aside-Pattern-Flow.png)

## Read/Write Through

### Read Through

### Write Through

## Write Behind Caching

## from 伍凯

概述:
缓存模式主要分为两种，一是Cache-aside，二是Cache-as-Sor，Sor是system of record的简称，简单来说就是数据存储，常见的就是数据库了。在Cache-as-Sor模式中，包含两种模式，一是Read-through，二是Write-through或Write-behind（也可以叫做Write-back），下面介绍下这几种模式。

一: Cache-aside
简单来说就是缓存可以看作是个独立的模块，可以认为缓存的操作是业务流程的一部分。
读流程:
从cahce读，如果cache miss，从Sor中读，然后写入cache，然后返回。
更新流程:
写入Sor，将cache失效。

二: Cache-as-SoR
简单来说是把缓存看作数据存储，业务流程中不会关心缓存的处理，缓存由数据存储逻辑来处理。
1. Read-through
这个和Cache-aside的读流程一样，只不过这个逻辑放在数据存储层做。
2. Write-through
写入缓存的时候，同时去更新后面真实的存储，成功后才返回。
3. Write-behind（也可以叫做Write-back）
写入缓存之后即可返回，之后去异步更新后面真实的存储。这个模式的优势就是写入很快。

一般来说，使用上面几种模式，缓存加上过期时间（为了保证最终一致性），一些需要强一致的业务操作绕过缓存直接访问存储，就不会有太大问题。

但是，系统设计里充满了Trade-off，我们需要清晰的知道，我们是在什么东西上做了什么样的权衡。

下面说下这些模式在分布式系统中的一些场景中存在的问题:
一: Cache-aside模式
1. 这个模式要求Sor是强一致的，否则，写流程 将cache失效后，读流程 可能从Sor中读到旧数据写入到cache中。
2. 如果要求Sor是强一致的，根据分布式系统的CAP理论，Sor只能是CP的。那么这个时候问题就落到了数据存储层，存储层的CP怎么做。

二: Cache-as-SoR
1. Read-through
这个和Cache-aside所面临的问题一样。
2. Write-through
写缓存，写真实的存储，这是两步操作，这意味什么，分布式事务。
3. Write-behind（也可以叫做Write-back）
这个就更复杂一些了，比如如何保证数据不丢，如何保证CP等等

Write-through和Write-behind还涉及到一个问题是，如果修改的是cache中的一小部分数据，这个时候cache miss的话采用什么策略，这里还有两个模式:
1. Write allocate (又叫fetch on write)
先从存储里把数据读到缓存中，然后修改缓存，通常在Write-behind模式下使用。
2. No-write allocate (又叫write-no-allocate or write around)
不管缓存，直接写存储，通常在Write-through模式下使用。