# MySQL Notes

- Version : 8+

## Change Buffer

- 从 Buffer Pool 中分配的
- 只针对更新操作进行缓存，目的是：减少更新操作对磁盘的随机 IO，从而提高效率。
    - 特别注意：它不是应用在读缓存的场景！
    - 对于在 change buffer 的数据来说，对它们的读操作只会导致要先将 change buffer 回写到磁盘的数据页（merge 过程），然后再读取。

> - 写唯一索引要检查记录是不是存在，所以在修改唯一索引之前，必须把修改的记录相关的索引页读出来才知道是不是唯一。
> - 这样的话，Insert buffer 就没意义了，反正要读出来 (读带来随机 IO) ，所以只对非唯一索引有效。

对比

- redo log : 提升对磁盘的顺序写的 IO 消耗
- change buffer : 提升对磁盘的随机 IO 的消耗？（出发点不同）

## TODO

- References
    - 『浅入浅出』MySQL 和 InnoDB : https://draveness.me/mysql-innodb
    - 为什么 MySQL 使用 B+ 树 : draveness.me/whys-the-design-mysql-b-plus-tree
    - 为什么 MySQL 的自增主键不单调也不连续 : https://draveness.me/whys-the-design-mysql-auto-increment
    - 为什么数据库不应该使用外键 : https://draveness.me/whys-the-design-database-foreign-key
    - MySQL 索引设计概要 : https://draveness.me/sql-index-intro
        - 《数据库索引设计与优化》: https://www.amazon.cn/%E5%9B%BE%E4%B9%A6/dp/B00ZH27RH0
