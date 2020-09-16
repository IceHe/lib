# id

> 发号器（不知道英文怎么说）

References

* 一步步带你了解ID发号器是什么、为什么、如何做！ - Java后端技术 - CSDN博客 : [https://blog.csdn.net/bntX2jSQfEHy7/article/details/80059147](https://blog.csdn.net/bntX2jSQfEHy7/article/details/80059147)

## Intro

最简单使用 UUID，但是（缺点）

* 趋势并非递增
  * 作为 DB 主键时，可能需要 insert（可能导致页分裂），而非 append
* 占用长度过大（128bit，8-4-4-4-12 = 32 个 16 进制字符）
  * 即 16B，两个 uint64 / long
* 作为主键查询效率低

雪花算法

* timestamp
  * 时间跳回，判断系统时间出问题，就继续用上一个 timestamp 继续加上 sequence，sequence 溢出就加到 timestamp 上去~（误差还算不大，还行）
* data-center id
* machine id \(服务器\)
* sequence

