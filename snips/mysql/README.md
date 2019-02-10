# MySQL (WIP)

## Features

### Lock

References

- 何登成的技术博客 &raquo; MySQL 加锁处理分析 : http://hedengcheng.com/?p=771

### Replica

一主多从的架构：写操作执行多次，**整个系统的性能取决于写入最慢的部分**。

binlog (binary log)

- 基于行的复制
- 基于逻辑语句的复制

（复制不是备份，复制不能替代备份。）

复制过程概述

- 从库先与主库同步，IO 到本地 relay log 文件中
    - relay log 中继日志
- 再从 relay log 文件中获得事件，然后重放到从库

## SQL

References

- https://www.w3schools.com/sql/sql_syntax.asp

### Basic Grammar

TODO : abstract

- `LIMIT length`
- `LIMIT offset, length` = `LIMIT length OFFSET offset`

### ON DUPLICATE KEY UPDATE

- Reference : https://sql.sh/cours/insert-into/on-duplicate-key

## CLI

Sth. was moved to [init.md](/snips/mysql/init.md).

### Interact

#### Databases

Show

```bash
show databases
```

Select

```bash
use db_name
```

#### Tables

Show

```bash
show tables
```

Show Table Definition

```bash
desc table_name
```

Show Create Table

```bash
show create table <table_name>
# e.g.
show create table jobs
```

#### Slow Log

e.g.

```bash
mysql> set global slow_query_log=1;
Query OK, 0 rows affected (0.00 sec)

mysql> mysql> show variables like '%slow%';
+---------------------------+--------------------------------------------+
| Variable_name             | Value                                      |
+---------------------------+--------------------------------------------+
| log_slow_admin_statements | OFF                                        |
| log_slow_slave_statements | OFF                                        |
| slow_launch_time          | 2                                          |
| slow_query_log            | ON                                         |
| slow_query_log_file       | /usr/local/var/mysql/icehe-laptop-slow.log |
+---------------------------+--------------------------------------------+
5 rows in set (0.00 sec)

mysql> show variables like '%long_query%';
+-----------------+----------+
| Variable_name   | Value    |
+-----------------+----------+
| long_query_time | 0.000000 |
+-----------------+----------+
1 row in set (0.00 sec)

mysql> system tail /usr/local/var/mysql/icehe-laptop-slow.log
# Time: 2019-02-05T02:05:43.401259Z
# User@Host: root[root] @ localhost []  Id:    20
# Query_time: 0.000048  Lock_time: 0.000000 Rows_sent: 0  Rows_examined: 0
SET timestamp=1549332343;
show processlist;
# Time: 2019-02-05T02:06:47.968559Z
# User@Host: root[root] @ localhost []  Id:    20
# Query_time: 0.001060  Lock_time: 0.000100 Rows_sent: 5  Rows_examined: 1032
SET timestamp=1549332407;
show variables like '%slow%';

mysql> select @@global.tx_isolation,@@tx_isolation,version(),"custom content";
+-----------------------+-----------------+-----------+----------------+
| @@global.tx_isolation | @@tx_isolation  | version() | custom content |
+-----------------------+-----------------+-----------+----------------+
| REPEATABLE-READ       | REPEATABLE-READ | 5.7.24    | custom content |
+-----------------------+-----------------+-----------+----------------+
1 row in set, 2 warnings (0.01 sec)
```

#### Processlist

Ref : MySQL慢查询&分析SQL执行效率浅谈 - 简书 : https://www.jianshu.com/p/43091bfa8aa7

```bash
mysql> show processlist;
+----+------+-----------------+----------+---------+------+----------+------------------+
| Id | User | Host            | db       | Command | Time | State    | Info             |
+----+------+-----------------+----------+---------+------+----------+------------------+
| 16 | root | localhost:62050 | life_log | Sleep   |   27 |          | NULL             |
| 17 | root | localhost:62051 | NULL     | Sleep   |   27 |          | NULL             |
| 20 | root | localhost       | life_log | Query   |    0 | starting | show processlist |
+----+------+-----------------+----------+---------+------+----------+------------------+
3 rows in set (0.00 sec)
```

#### Warnings

```bash
mysql> show warnings;
ERROR 2006 (HY000): MySQL server has gone away
No connection. Trying to reconnect...
Connection id:    21
Current database: life_log

+---------+------+------------------------------------------------------------------------------------------------------------------------+
| Level   | Code | Message                                                                                                                |
+---------+------+------------------------------------------------------------------------------------------------------------------------+
| Warning | 1287 | 'COM_FIELD_LIST' is deprecated and will be removed in a future release. Please use SHOW COLUMNS FROM statement instead |
| Warning | 1287 | 'COM_FIELD_LIST' is deprecated and will be removed in a future release. Please use SHOW COLUMNS FROM statement instead |
| Warning | 1287 | 'COM_FIELD_LIST' is deprecated and will be removed in a future release. Please use SHOW COLUMNS FROM statement instead |
| Warning | 1287 | 'COM_FIELD_LIST' is deprecated and will be removed in a future release. Please use SHOW COLUMNS FROM statement instead |
+---------+------+------------------------------------------------------------------------------------------------------------------------+
4 rows in set (0.01 sec)
```

#### Prepare

References

- 理解Mysql prepare预处理语句 : https://www.cnblogs.com/simpman/p/6510604.html
- MySQL :: MySQL 8.0 Reference Manual :: 13.5 Prepared SQL Statement Syntax : https://dev.mysql.com/doc/refman/8.0/en/sql-syntax-prepared-statements.html

#### Explain

References

- MySQL 性能优化神器 Explain 使用分析 : https://segmentfault.com/a/1190000008131735

#### Lock

References

- MySQL Transactional and Locking Commands - MySQL Reference Manual [Book] : https://www.oreilly.com/library/view/mysql-reference-manual/0596002653/ch06s07.html

```sql
> lock table t write;
Query OK, 0 rows affected (0.00 sec)

> unlock tables;
Query OK, 0 rows affected (0.00 sec)
```

#### Isolation

隔离级别

```bash
mysql> select @@tx_isolation;
+-----------------+
| @@tx_isolation  |
+-----------------+
| REPEATABLE-READ |
+-----------------+
1 row in set, 1 warning (0.00 sec)

mysql> select @@global.tx_isolation;
+-----------------------+
| @@global.tx_isolation |
+-----------------------+
| REPEATABLE-READ       |
+-----------------------+
```

## Others

### SERIAL

`SERIAL` SQL TYPE

- an alias for `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE`

### Troubleshooting

ERROR

> MySql server startup error 'The server quit without updating PID file '

- StackOverflow : https://stackoverflow.com/questions/4963171/mysql-server-startup-error-the-server-quit-without-updating-pid-file

### Change Buffer

- 从 Buffer Pool 中分配的
- 只针对更新操作进行缓存，目的是：减少更新操作对磁盘的随机 IO，从而提高效率。
    - 特别注意：它不是应用在读缓存的场景！
    - 对于在 change buffer 的数据来说，对它们的读操作只会导致要先将 change buffer 回写到磁盘的数据页（merge 过程），然后再读取。

> - 写唯一索引要检查记录是不是存在，所以在修改唯一索引之前，必须把修改的记录相关的索引页读出来才知道是不是唯一。
> - 这样的话，Insert buffer 就没意义了，反正要读出来 (读带来随机 IO) ，所以只对非唯一索引有效。

对比

- redo log : 提升对磁盘的顺序写的 IO 消耗
- change buffer : 提升对磁盘的随机 IO 的消耗？（出发点不同）

### Data Type

> 数据类型

INT

- tinyint 1
- smallint 2
- midiumint 3
- int 4
    - `INT(11)` 中的 11 表示显示宽度，使用了 zerofille(0) 后，未满的宽度会用 0 填充
- bigint 8

### binlog_row_image

References

- MySQL 5.7贴心参数之binlog_row_image : http://www.cnblogs.com/gomysql/p/6155160.html

### \G \g

References

- MySQL :: MySQL 8.0 Reference Manual :: 4.5.1.2 mysql Client Commands : https://dev.mysql.com/doc/refman/8.0/en/mysql-commands.html

```bash
mysql> help

For information about MySQL products and services, visit:
   http://www.mysql.com/
For developer information, including the MySQL Reference Manual, visit:
   http://dev.mysql.com/
To buy MySQL Enterprise support, training, or other products, visit:
   https://shop.mysql.com/

List of all MySQL commands:
Note that all text commands must be first on line and end with ';'
?         (\?) Synonym for `help'.
clear     (\c) Clear the current input statement.
connect   (\r) Reconnect to the server. Optional arguments are db and host.
delimiter (\d) Set statement delimiter.
edit      (\e) Edit command with $EDITOR.
ego       (\G) Send command to mysql server, display result vertically.
exit      (\q) Exit mysql. Same as quit.
go        (\g) Send command to mysql server.
help      (\h) Display this help.
nopager   (\n) Disable pager, print to stdout.
notee     (\t) Don't write into outfile.
pager     (\P) Set PAGER [to_pager]. Print the query results via PAGER.
print     (\p) Print current command.
prompt    (\R) Change your mysql prompt.
quit      (\q) Quit mysql.
rehash    (\#) Rebuild completion hash.
source    (\.) Execute an SQL script file. Takes a file name as an argument.
status    (\s) Get status information from the server.
system    (\!) Execute a system shell command.
tee       (\T) Set outfile [to_outfile]. Append everything into given outfile.
use       (\u) Use another database. Takes database name as argument.
charset   (\C) Switch to another charset. Might be needed for processing binlog with multi-byte charsets.
warnings  (\W) Show warnings after every statement.
nowarning (\w) Don't show warnings after every statement.
resetconnection(\x) Clean session context.

For server side help, type 'help contents'
```

### Index & Key

References

- mysql中index和key的区别 : https://blog.csdn.net/kusedexingfu/article/details/78347354

> KEY | INDEX
>
> - KEY is normally a synonym for INDEX. The key attribute PRIMARY KEY can also be specified as just KEY when given in a column definition. This was implemented for compatibility with other database systems.

### utf8 & utf8mb4

References

- 清官谈 MySQL 中 utf8 和 utf8mb4 区别 : http://blogread.cn/it/article/7546?f=wb_blogread

### Binlog

References

- mysql中如何开启binlog? : https://www.cnblogs.com/chuanzhang053/p/9335924.html

```bash
# e.g.
mysql> set @@binlog_format=row;
Query OK, 0 rows affected (0.00 sec)

mysql> select @@binlog_format;
+-----------------+
| @@binlog_format |
+-----------------+
| ROW             |
+-----------------+
1 row in set (0.00 sec)

mysql> select @@binlog_row_image;
+--------------------+
| @@binlog_row_image |
+--------------------+
| FULL               |
+--------------------+
1 row in set (0.00 sec)

mysql> show binlog events;
```

```bash
# e.g.
$ mysqlbinlog -vv mysql-bin.000001 --start-position=2078
```

### sql_safe_updates

```bash
mysql> set sql_safe_updates=1;
Query OK, 0 rows affected (0.00 sec)

mysql> show variables like '%sql_safe_updates%';
+------------------+-------+
| Variable_name    | Value |
+------------------+-------+
| sql_safe_updates | ON    |
+------------------+-------+
1 row in set (0.00 sec)
```

保护：如果忘记在 update/delete 语句添加 where 条件，或者索引字段的话，执行会报错

### Multi-Range Read

References

- 35 | join语句怎么优化？: https://time.geekbang.org/column/article/80147

优化开启语句

```bash
mysql> set optimizer_switch="mrr_cost_based=off";
Query OK, 0 rows affected (0.00 sec)

# e.g. `Using MRR`
mysql> explain select * from t1 where a>=1 and a<=100;
+----+-------------+-------+------------+-------+---------------+------+---------+------+------+----------+----------------------------------+
| id | select_type | table | partitions | type  | possible_keys | key  | key_len | ref  | rows | filtered | Extra                            |
+----+-------------+-------+------------+-------+---------------+------+---------+------+------+----------+----------------------------------+
|  1 | SIMPLE      | t1    | NULL       | range | a             | a    | 5       | NULL |  100 |   100.00 | Using index condition; Using MRR |
+----+-------------+-------+------------+-------+---------------+------+---------+------+------+----------+----------------------------------+
1 row in set, 1 warning (0.00 sec)
```

### Batched Key Access

References

- 35 | join语句怎么优化？: https://time.geekbang.org/column/article/80147

优化算法，开启方法

- 依赖 MRR

```sql
set optimizer_switch='mrr=on,mrr_cost_based=off,batched_key_access=on';
```

### Union

- union : 去重
- union all : 不去重
