# DB

## ACID

atomicity 原子性
consistency 一致性
isolation 隔离性
duration 持久性

SOLID

## 索引

https://kb.cnblogs.com/page/45712/

常见的数据库系统，其索引使用的数据结构多是B-Tree或者B+Tree。
例如，MsSql使用的是B+Tree，Oracle及Sysbase使用的是B-Tree。

## Oracle

https://www.2cto.com/database/201710/688377.html

Oracle和Mysql的区别？
1）库函数不同。 2）Oracle是用表空间来管理的，Mysql不是。 3）显示当前所有的表、用户、改变连接用户、显示当前连接用户、执行外部脚本的语句的不同。 4）分页查询时候时候，mysql用limit oracle用rownum

oracle分页查询语句
使用rownum，两种如下： 第一种： select * from (select t.*,rownum row_num from mytable t) b where b.row_num between 1 and 10 第二种： select * from ( select a.*, rownum rn from mytable a where rownum <= 10 ) where rn >= 1 使用rowid， 如下： select * from scott.emp where rowid in (select rd from (select rowid as rd ,rownum as rn from scott.emp ) where rn<=6 and rn>3)

什么是PL/SQL？
PL/SQL是一种程序语言，叫做过程化SQL语言（Procedural Language/SQL）。PL/SQL是Oracle数据库对SQL语句的扩展。在普通SQL语句的使用上增加了编程语言的特点，所以PL/SQL把数据操作和查询语句组织在PL/SQL代码的过程性单元中，通过逻辑判断、循环等操作实现复杂的功能或者计算。PL/SQL 只有 Oracle 数据库有。 MySQL 目前不支持 PL/SQL 的。

truncate与 delete区别
TRUNCATE TABLE ：删除内容、释放空间但不删除定义。
DELETE TABLE: 删除内容不删除定义，不释放空间。
DROP TABLE ：删除内容和定义，释放空间。

## 悲观锁、乐观锁

（事务隔离）https://zh.wikipedia.org/wiki/%E4%BA%8B%E5%8B%99%E9%9A%94%E9%9B%A2

http://www.open-open.com/lib/view/open1452046967245.html

不要把乐观并发控制和悲观并发控制狭义的理解为DBMS中的概念，
更不要把他们和数据中提供的锁机制（行锁、表锁、排他锁、共享锁）混为一谈。
其实，在DBMS中，悲观锁正是利用数据库本身提供的锁机制来实现的。

悲观锁：PCC 悲观并发控制 pessimistic concurrency control
如果一个事务执行的操作都某行数据应用了锁，那只有当这个事务把锁释放，其他事务才能够执行与该锁冲突的操作。
（成功加了锁，才进行处理，否则等待或者抛出异常（开发者决定），如果是等待，可能会导致死锁）

在数据竞争激烈的环境使用，发生并发冲突时，使用锁保护数据的成本要低于回滚事务的成本的环境中。

悲观锁，正如其名，它指的是对数据被外界（包括本系统当前的其他事务，以及来自外部系统的事务处理）修改持保守态度(悲观)，因此，在整个数据处理过程中，将数据处于锁定状态。 悲观锁的实现，往往依靠数据库提供的锁机制 （也只有数据库层提供的锁机制才能真正保证数据访问的排他性，否则，即使在本系统中实现了加锁机制，也无法保证外部系统不会修改数据）

使用 select…for update 会把数据给锁住，不过我们需要注意一些锁的级别，MySQL InnoDB默认行级锁。行级锁都是基于索引的，如果一条SQL语句用不到索引是不会使用行级锁的，会使用表级锁把整张表锁住，这点需要注意。

悲观并发控制实际上是“先取锁再访问”的保守策略，为数据处理的安全提供了保证。但是在效率方面，处理加锁的机制会让数据库产生额外的开销，还有增加产生死锁的机会；另外，在只读型事务处理中由于不会产生冲突，也没必要使用锁，这样做只能增加系统负载；还有会降低了并行性，一个事务如果锁定了某行数据，其他事务就必须等待该事务处理完才可以处理那行数据。

乐观锁：OCC 乐观并发处理 optimistic concurrency control
它假设多用户并发的事务在处理时不会彼此互相影响，各事务能够在不产生锁的情况下处理各自影响的那部分数据。在提交数据更新之前，每个事务会先检查在该事务读取数据后，有没有其他事务又修改了该数据。如果其他事务有更新的话，正在提交的事务会进行回滚。

相对于悲观锁，在对数据库进行处理的时候，乐观锁并不会使用数据库提供的锁机制。一般的实现乐观锁的方式就是记录数据版本。

数据版本,为数据增加的一个版本标识。当读取数据时，将版本标识的值一同读出，数据每更新一次，同时对版本标识进行更新。当我们提交更新的时候，判断数据库表对应记录的当前版本信息与第一次取出来的版本标识进行比对，如果数据库表当前版本号与第一次取出来的版本标识值相等，则予以更新，否则认为是过期数据。

实现数据版本有两种方式，第一种是使用版本号，第二种是使用时间戳。

乐观并发控制相信事务之间的数据竞争(data race)的概率是比较小的，因此尽可能直接做下去，直到提交的时候才去锁定，所以不会产生任何锁和死锁。但如果直接简单这么做，还是有可能会遇到不可预期的结果，例如两个事务都读取了数据库的某一行，经过修改以后写回数据库，这时就遇到了问题。

## 1~3NF、BCNF

https://www.zhihu.com/question/24696366
