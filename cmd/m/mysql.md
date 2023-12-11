# mysql

MySQL CLI tool ( not a command )

---

References

-   [www.mysql.com](https://www.mysql.com)
    -   [Documentation](https://dev.mysql.com/doc)
        -   [General Infomation](https://dev.mysql.com/doc/refman/8.0/en/introduction.html)

## Install on macOS

Homebrew on

```bash
brew install mysql
```

Or using native packages

-   https://dev.mysql.com/doc/refman/8.0/en/osx-installation-pkg.html

## Commands

References

-   Getting Started with MySQL : https://dev.mysql.com/doc/mysql-getting-started/en/

### Dump

References

-   Dump Data : http://www.runoob.com/mysql/mysql-database-export.html
-   Import Data : http://www.runoob.com/mysql/mysql-database-import.html

Trouble-shooting

-   How should I tackle --secure-file-priv in MySQL? https://stackoverflow.com/a/40419548/5110899

Dump

```bash
mysqldump -u USERNAME -p DATABASE | tee -a dump.sql
# then enter password
```

Import

-   Read & Execute SQL

```bash
mysql -u USERNAME -p DATABASE < dump.sql
# then enter password
```

### Start

```bash
$ mysql.server
Usage: mysql.server  {start|stop|restart|reload|force-reload|status}  [ MySQL server options ]

$ mysql.server start
```

#### Cannot mysql.server start

References

-   [MYSQL Error – Server Quit Without Updating PID File – Quick fix!](https://bobcares.com/blog/mysql-error-server-quit-without-updating-pid-file/)
-   [Can't open and lock privilege tables: Table 'mysql.user' doesn't exist](https://stackoverflow.com/questions/34516664/cant-open-and-lock-privilege-tables-table-mysql-user-doesnt-exist)
-   [Can't open the mysql.plugin table. Please run mysql_upgrade to create it](https://stackoverflow.com/questions/41531225/cant-open-the-mysql-plugin-table-please-run-mysql-upgrade-to-create-it/41532987)

Error Keyword

> MySql server startup error 'The server quit without updating PID file '

-   StackOverflow : https://stackoverflow.com/questions/4963171/mysql-server-startup-error-the-server-quit-without-updating-pid-file

Problem

```bash
$ mysql.server start
Starting MySQL
 ERROR! The server quit without updating PID file (/usr/local/var/mysql/icehe-mbp.local.pid).
```

Steps

```bash
$ cd /usr/local/var/mysql/
$ less icehe-mbp.local.err
# e.g.
…… [FATAL] InnoDB: Table flags are 0 in the data dictionary but the flags in file ./ibdata1 are 0x4000!…
# e.g.
…… Can't open the mysql.plugin table. Please run mysql_upgrade to create it
# e.g.
…… Can't open and lock privilege tables: Table 'mysql.user' doesn't exist
```

```bash
$ pwd
/usr/local/var/mysql
$ rm -rf *
$ mysqld --initialize-insecure
# ommited output
```

### Connect

```bash
$ mysql -h HOST -P PORT -u USERNAME -pPASSWORD
# e.g.
$ mysql -h db.icehe.life -P 5104 -u username -ppassword
```

First time after installing

```bash
$ mysql -u root -p
Enter password:
# then press ENTER ↩ ( as no password )
```

### Version

```bash
mysql> select version();
+-----------+
| version() |
+-----------+
| 8.0.25    |
+-----------+
1 row in set (0.00 sec)
```

### Status

```bash
mysql> status;
# or
mysql> \s
--------------
mysql  Ver 8.0.25 for macos11.3 on x86_64 (Homebrew)

Connection id:          15
Current database:
Current user:           root@localhost
SSL:                    Not in use
Current pager:          less
Using outfile:          ''
Using delimiter:        ;
Server version:         8.0.25 Homebrew
Protocol version:       10
Connection:             Localhost via UNIX socket
Server characterset:    utf8mb4
Db     characterset:    utf8mb4
Client characterset:    utf8mb4
Conn.  characterset:    utf8mb4
UNIX socket:            /tmp/mysql.sock
Binary data as:         Hexadecimal
Uptime:                 2 min 1 sec

Threads: 2  Questions: 13  Slow queries: 0  Opens: 652  Flush tables: 4  Open tables: 36  Queries per second avg: 0.107
--------------
```

### Create User

_仅供参考_

```bash
# login as root user
mysql -u root -p

# create new user
CREATE USER 'icehe'@'localhost' IDENTIFIED BY 'first_password';

# grant privileges to new user ( DML )
GRANT ALL PRIVILEGES ON *.* TO 'icehe'@'localhost';

# if encounter 'Cannot load from mysql.procs_priv, the table is probably corrupted'
mysql_upgrade -u root -p
```

### Change Password

```bash
mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY 'new_password';
Query OK, 0 rows affected (0.02 sec)
mysql> FLUSH PRIVILEGES;
Query OK, 0 rows affected (0.00 sec)

```

### Database

#### Create

```bash
mysql> CREATE DATABASE test_db;
Query OK, 1 row affected (0.11 sec)
```

#### Show

```bash
mysql> SHOW DATABASES;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| mysql              |
| performance_schema |
| sys                |
| test_db            |
+--------------------+
5 rows in set (0.00 sec)
```

#### Use

```bash
mysql> USE test_db;
Database changed
```

### Current DB & User

```bash
mysql> select DATABASE();
+------------+
| DATABASE() |
+------------+
| life_log   |
+------------+
1 row in set (0.00 sec)

mysql> select USER();
+----------------+
| USER()         |
+----------------+
| root@localhost |
+----------------+
1 row in set (0.00 sec)
```

### Table

#### Desc Definition

```bash
desc table_name
```

#### Show Create Table

```bash
show create table table_name
```

### Info

```bash
mysql> show variables like '%version%';
+--------------------------+-------------------------------+
| Variable_name            | Value                         |
+--------------------------+-------------------------------+
| admin_tls_version        | TLSv1,TLSv1.1,TLSv1.2,TLSv1.3 |
| immediate_server_version | 999999                        |
| innodb_version           | 8.0.25                        |
| original_server_version  | 999999                        |
| protocol_version         | 10                            |
| slave_type_conversions   |                               |
| tls_version              | TLSv1,TLSv1.1,TLSv1.2,TLSv1.3 |
| version                  | 8.0.25                        |
| version_comment          | Homebrew                      |
| version_compile_machine  | x86_64                        |
| version_compile_os       | macos11.3                     |
| version_compile_zlib     | 1.2.11                        |
+--------------------------+-------------------------------+
12 rows in set (0.01 sec)
```

### Slow Log

```bash
mysql> set global slow_query_log=1;
Query OK, 0 rows affected (0.00 sec)
```

```
mysql> show variables like '%slow%';
+---------------------------+----------------------------------------+
| Variable_name             | Value                                  |
+---------------------------+----------------------------------------+
| log_slow_admin_statements | OFF                                    |
| log_slow_extra            | OFF                                    |
| log_slow_slave_statements | OFF                                    |
| slow_launch_time          | 2                                      |
| slow_query_log            | OFF                                    |
| slow_query_log_file       | /opt/homebrew/var/mysql/bogon-slow.log |
+---------------------------+----------------------------------------+
6 rows in set (0.00 sec)

mysql> show variables like '%long_query%';
+-----------------+----------+
| Variable_name   | Value    |
+-----------------+----------+
| long_query_time | 0.000000 |
+-----------------+----------+
1 row in set (0.00 sec)

mysql> system tail /opt/homebrew/var/mysql/bogon-slow.log
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
```

### Processlist

Ref : MySQL 慢查询&分析 SQL 执行效率浅谈 - 简书 : https://www.jianshu.com/p/43091bfa8aa7

```bash
mysql> show processlist;
+-----+-----------------+-----------------+---------+---------+---------+------------------------+------------------+
| Id  | User            | Host            | db      | Command | Time    | State                  | Info             |
+-----+-----------------+-----------------+---------+---------+---------+------------------------+------------------+
|   7 | event_scheduler | localhost       | NULL    | Daemon  | 2367989 | Waiting on empty queue | NULL             |
| 344 | icehe           | localhost       | NULL    | Query   |       0 | init                   | show processlist |
| 385 | icehe           | localhost:56775 | example | Sleep   |       3 |                        | NULL             |
+-----+-----------------+-----------------+---------+---------+---------+------------------------+------------------+
3 rows in set (0.00 sec)
```

### Kill Connection

```bash
mysql> kill connection 385;
Query OK, 0 rows affected (0.00 sec)
```

### Warnings

```bash
mysql> show warnings;
+-------+------+-----------------------------------------------------------------------------------------------------------------------------------------------------------+
| Level | Code | Message                                                                                                                                                   |
+-------+------+-----------------------------------------------------------------------------------------------------------------------------------------------------------+
| Error | 1064 | You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'warning' at line 1 |
+-------+------+-----------------------------------------------------------------------------------------------------------------------------------------------------------+
1 row in set (0.00 sec)
```

### Lock

References

-   MySQL Transactional and Locking Commands - MySQL Reference Manual [Book] : https://www.oreilly.com/library/view/mysql-reference-manual/0596002653/ch06s07.html

```sql
> lock table table_name write;
Query OK, 0 rows affected (0.00 sec)

> unlock tables;
Query OK, 0 rows affected (0.00 sec)
```

### Isolation Level

隔离级别

```bash
# MySQL 8.0+
mysql> select @@global.transaction_isolation, @@transaction_isolation, version();
+--------------------------------+-------------------------+-----------+
| @@GLOBAL.transaction_isolation | @@transaction_isolation | version() |
+--------------------------------+-------------------------+-----------+
| REPEATABLE-READ                | REPEATABLE-READ         | 8.0.25    |
+--------------------------------+-------------------------+-----------+
1 row in set (0.00 sec)

# MySQL 5.7

mysql> select @@global.tx_isolation, @@tx_isolation, version();
+-----------------------+-----------------+-----------+
| @@global.tx_isolation | @@tx_isolation  | version() |
+-----------------------+-----------------+-----------+
| REPEATABLE-READ       | REPEATABLE-READ | 5.7.24    |
+-----------------------+-----------------+-----------+
1 row in set, 2 warnings (0.01 sec)
```

### \G \g

References

-   MySQL :: MySQL 8.0 Reference Manual :: 4.5.1.2 mysql Client Commands : https://dev.mysql.com/doc/refman/8.0/en/mysql-commands.html

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
query_attributes Sets string parameters (name1 value1 name2 value2 ...) for the next query to pick up.

For server side help, type 'help contents'
```

### UTF8 & UTF8MB4

References

-   [清官谈 MySQL 中 utf8 和 utf8mb4 区别](http://blogread.cn/it/article/7546?f=wb_blogread)

### Binlog

References

-   [mysql 中如何开启 binlog?](https://www.cnblogs.com/chuanzhang053/p/9335924.html)

```bash
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
+---------------+-----+----------------+-----------+-------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| Log_name      | Pos | Event_type     | Server_id | End_log_pos | Info                                                                                                                                                                             |
+---------------+-----+----------------+-----------+-------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| binlog.000001 |   4 | Format_desc    |         1 |         125 | Server ver: 8.0.25, Binlog ver: 4                                                                                                                                                |
| binlog.000001 | 125 | Previous_gtids |         1 |         156 |                                                                                                                                                                                  |
| binlog.000001 | 156 | Anonymous_Gtid |         1 |         233 | SET @@SESSION.GTID_NEXT= 'ANONYMOUS'                                                                                                                                             |
| binlog.000001 | 233 | Query          |         1 |         353 | create database icehe_db /* xid=20 */                                                                                                                                            |
| binlog.000001 | 353 | Anonymous_Gtid |         1 |         432 | SET @@SESSION.GTID_NEXT= 'ANONYMOUS'                                                                                                                                             |
| binlog.000001 | 432 | Query          |         1 |         682 | use `icehe_db`; CREATE USER 'icehe'@'localhost' IDENTIFIED WITH 'caching_sha2_password' AS '$A$005$;eAeK*ZBv&
                                                          qWat;0X3Yn48OhUlYGq04dz3taa2Dnd.t4gLGjgf3vxBLKi8' /* xid=29 */ |
+---------------+-----+----------------+-----------+-------------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
6 rows in set (0.00 sec)
```

```bash
# e.g.
$ mysqlbinlog -vv mysql-bin.000001 --start-position=2078
```

### sql_safe_updates

```bash
mysql> show variables like '%sql_safe_update%';
+------------------+-------+
| Variable_name    | Value |
+------------------+-------+
| sql_safe_updates | OFF   |
+------------------+-------+
1 row in set (0.00 sec)

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

### Batched Key Access

References

-   35 | join 语句怎么优化？: https://time.geekbang.org/column/article/80147

优化算法，开启方法

-   依赖 MRR

```sql
set optimizer_switch='mrr=on,mrr_cost_based=off,batched_key_access=on';
```

### innodb_lock_wait_timeout

**锁等待超时时间**

```sql
set Innodb_lock_wait_timeout = 5;
```

### Avg Row Len

References

-   [Avg_row_length 是怎么计算的？](https://www.cnblogs.com/sunss/p/6122997.html)
-   Q & A ( on MySQL Forums )
    -   [How Avg_row_length is calculated?](https://forums.mysql.com/read.php?22,219129)
    -   [Re: How Avg_row_length is calculated?](https://forums.mysql.com/read.php?22,219129,224296#msg-224296)

Command

-   Avg_row_length 顾名思义是：平均每行的长度
    -   e.g. 查询命令 & 输出，如下

```sql
show table status like 'tb_name'\G
```

```sql
*************************** 1. row ***************************
           Name: tb_name
         Engine: InnoDB
        Version: 10
     Row_format: Compact
           Rows: 3425
 Avg_row_length: 138
    Data_length: 475136
Max_data_length: 0
   Index_length: 1572864
      Data_free: 3145728
 Auto_increment: 6894011508
    Create_time: 2016-10-12 15:03:25
    Update_time: NULL
     Check_time: NULL
      Collation: utf8mb4_general_ci
       Checksum: NULL
 Create_options:
        Comment: NULL
row in set (0.00 sec)
```

该值是如何计算得出？

-   InnoDB 的行数是一个近似值
-   平均每行长度 = 数据大小 / 行数
-   大部分都是超过了每行的长度
    -   因为在 InnoDB 的老版本中为了页对齐都自动的往上增加了
    -   比如有一行行长 29 bytes 为了保证页对齐，往上加了 1 或 2 bytes
-   在经历了多次块分裂后，认为「块」到达约 69% 满了

## SQL

### Data Type

#### NUMERIC

The `DECIMAL` and `NUMERIC` types **store exact numeric data values**.

-   These types are used when it is important to **preserve exact precision**,
    for example with monetary data.
-   _In MySQL, NUMERIC is implemented as DECIMAL,_
    _so the following remarks about DECIMAL apply equally to NUMERIC._
-   _MySQL stores DECIMAL values in binary format._

```sql
salary DECIMAL(5,2)
```

In this example, **5 is the precision and 2 is the scale**.

-   The precision represents the number of significant digits that are stored for values,
-   and the scale represents the number of digits that can be stored following the decimal point.

Standard SQL requires that `DECIMAL(5,2)` be able to store any value with five digits and two decimals,
so values that can be stored in the salary column range **from -999.99 to 999.99**.

#### DATEIME

Rferences

-   [The DATE, DATETIME, and TIMESTAMP Types](https://dev.mysql.com/doc/refman/8.0/en/datetime.html)

`DATE`

-   The DATE type is used for values with a date part but no time part.
-   MySQL retrieves and displays DATE values in **'YYYY-MM-DD'** format.
-   The supported range is **'1000-01-01' to '9999-12-31'**.

`DATETIME`

-   The DATETIME type is used for values that contain both date and time parts.
-   MySQL retrieves and displays DATETIME values in **'YYYY-MM-DD hh:mm:ss'** format.
-   The supported range is **'1000-01-01 00:00:00' to '9999-12-31 23:59:59'**.

`TIMESTAMP`

-   The TIMESTAMP data type is used for values that contain both date and time parts.
-   TIMESTAMP has a range of **'1970-01-01 00:00:01' UTC to '2038-01-19 03:14:07' UTC**.

**Precision**

A DATETIME or TIMESTAMP value **can include a trailing fractional seconds part in up to microseconds (6 digits) precision.**

-   _In particular, any fractional part in a value inserted into a DATETIME or TIMESTAMP column is stored rather than discarded._
-   With the fractional part included,
    -   the format for these values is **'YYYY-MM-DD hh:mm:ss[.fraction]'**,
    -   the range for DATETIME values is **'1000-01-01 00:00:00.000000' to '9999-12-31 23:59:59.999999'**,
    -   and the range for TIMESTAMP values is **'1970-01-01 00:00:01.000000' to '2038-01-19 03:14:07.999999'**.
-   The fractional part should always be separated from the rest of the time by a decimal point;
    no other fractional seconds delimiter is recognized.
-   _See [Fractional Seconds in Time Values](https://dev.mysql.com/doc/refman/8.0/en/fractional-seconds.html)_

The **TIMESTAMP and DATETIME data types offer automatic initialization and updating to the current date and time.**

-   _See [Automatic Initialization and Updating for TIMESTAMP and DATETIME](https://dev.mysql.com/doc/refman/8.0/en/timestamp-initialization.html)_

Time Zone

**MySQL converts TIMESTAMP values from the current time zone to UTC for storage,**
**and back from UTC to the current time zone for retrieval.**
**(This does not occur for other types such as DATETIME.)**

_By default, the current time zone for each connection is the server's time._
_The time zone can be set on a per-connection basis._

_As long as the time zone setting remains constant, you get back the same value you store._
If you store a TIMESTAMP value, and then change the time zone and retrieve the value,
the retrieved value is different from the value you stored.
_This occurs because the same time zone was not used for conversion in both directions._

#### VARCHAR

References

-   [The CHAR and VARCHAR Types](https://dev.mysql.com/doc/refman/8.0/en/char.html)

`CHAR`

-   The length of a CHAR column is fixed to the length that you declare when you create the table.
-   The length can be any value **from 0 to 255**.
-   When CHAR values are stored, they are right-padded with spaces to the specified length.

`VARCHAR`

-   Values in VARCHAR columns are variable-length strings.
-   The length can be specified as a value **from 0 to 65,535**.
-   The **effective maximum length of a VARCHAR is subject to the [maximum row size](https://dev.mysql.com/doc/refman/8.0/en/column-count-limit.html)** ( 65,535 bytes, which is shared among all columns ) and the character set used.

In contrast to CHAR, VARCHAR values are stored as a 1-byte or 2-byte length prefix plus data.

-   The length prefix indicates the number of bytes in the value.
-   A column uses one length byte if values require no more than 255 bytes,
    -   two length bytes if values may require more than 255 bytes.

If strict SQL mode is not enabled
and you **assign a value to a CHAR or VARCHAR column**
**that exceeds the column's maximum length,**
**the value is truncated to fit** and a warning is generated.

-   For truncation of nonspace characters, you can cause an error to occur ( rather than a warning ) and suppress insertion of the value by using strict SQL mode.

#### TEXT

References

-   [The BLOB and TEXT Types](https://dev.mysql.com/doc/refman/8.0/en/blob.html)

The four `TEXT` types are **`TINYTEXT`, `TEXT`, `MEDIUMTEXT`, and `LONGTEXT`**. …

_`BLOB` values are treated as binary strings (byte strings)._
_They have the binary character set and collation,_
_and comparison and sorting are based on the numeric values of the bytes in column values._

_`TEXT` values are treated as nonbinary strings (character strings)._
_They have a character set other than binary,_
_and values are sorted and compared based on the collation of the character set._

_In most respects, you can regard a BLOB column as a VARBINARY column that can be as large as you like._
_Similarly, you can regard a TEXT column as a VARCHAR column._
_BLOB and TEXT differ from VARBINARY and VARCHAR in the following ways:_

-   For indexes on BLOB and TEXT columns,
    you must specify an index prefix length.
-   For CHAR and VARCHAR, a prefix length is optional.

**`BLOB` and `TEXT` columns cannot have `DEFAULT` values.**

Each BLOB or TEXT value is **represented internally by a separately allocated object.**

_This is in contrast to all other data types, for which storage is allocated once per column when the table is opened._

#### JSON

References

-   [The JSON Data Type](https://dev.mysql.com/doc/refman/8.0/en/json.html)

MySQL supports a native JSON data type _defined by RFC 7159_
that **enables efficient access to data in JSON** _(JavaScript Object Notation)_ documents.

---

_The JSON data type provides these advantages over storing JSON-format strings in a string column:_

-   **Automatic validation of JSON documents** stored in JSON columns.
    **Invalid documents produce an error.**
-   Optimized storage format.
    JSON documents stored in JSON columns are
    **converted to an internal format that permits quick read access to document elements**.

    _When the server later must read a JSON value stored in this binary format,_
    _the value need not be parsed from a text representation._

    The binary format is
    **structured to enable the server to look up subobjects or nested values directly**
    **by key or array index without reading all values**
    before or after them in the document.

---

**The space required to store a JSON document is roughly the same as for `LONGBLOB` or `LONGTEXT`**.

It is important to keep in mind that
the **size of any JSON document stored in a JSON column is limited to the value of the [max_allowed_packet](https://dev.mysql.com/doc/refman/8.0/en/server-system-variables.html#sysvar_max_allowed_packet) system variable**.

( When the server is manipulating a JSON value internally in memory, it can be larger than this; the limit applies when the server stores it. )

You can obtain the amount of space required to store a JSON document using the `JSON_STORAGE_SIZE()` function;
_note that for a JSON column, the storage size — and thus the value returned by this function — is that used by the column prior to any partial updates that may have been performed on it._

---

**Prior to MySQL 8.0.13, a JSON column cannot have a non-NULL default value.**

---

Partial Updates of JSON Values

In MySQL 8.0, the optimizer can
**perform a partial, in-place update of a JSON column instead of removing the old document and**
**writing the new document in its entirety to the column**.

This optimization can be performed for an update that meets the following conditions:

#### Storage Requirements

References

-   [Data Type Storage Requirements](https://dev.mysql.com/doc/refman/8.0/en/storage-requirements.html)

##### Numeric

-   `TINYINT` 1 bytes

-   `SMALLINT` 2 bytes

-   `MIDIUMINT` 3 bytes

-   `INT`, `INTEGER` 4 bytes

    -   `INT(11)` 中的 11 表示显示宽度，使用了 zerofille(0) 后，未满的宽度会用 0 填充

-   `BIGINT` 8 bytes

-   `FLOAT(p)` 4 bytes

    -   if 0 <= p <= 24, 8 bytes if 25 <= p <= 53

-   `FLOAT` 4 bytes

-   `DOUBLE [PRECISION]`, `REAL` 8 bytes

-   `BIT(M)` approximately (M+7)/8 bytes

-   `DECIMAL(M, D)`, `NUMERIC(M, D)` Varies ( it depends )

    -   **M** is the precision and **D** is the scale

        -   **precision** : the number of significant digits that are stored for values.
        -   **scale** : the number of digits that can be stored following the decimal point.

    -   Storage for the **integer and fractional parts of each value are determined separately**.

    -   Each multiple of nine digits requires four bytes,
        and the "leftover" digits require some fraction of four bytes.

##### Date Time

_For TIME, DATETIME, and TIMESTAMP columns,_
_the storage required for tables created before MySQL 5.6.4 differs from tables created from 5.6.4 on._

_This is due to a change in 5.6.4 that permits these types to have a fractional part,_
_which requires from 0 to 3 bytes._

| Data Type | Storage Required Before MySQL 5.6.4 | Storage Required as of MySQL 5.6.4   |
| --------- | ----------------------------------- | ------------------------------------ |
| YEAR      | 1 byte                              | 1 byte                               |
| DATE      | 3 bytes                             | 3 bytes                              |
| TIME      | 3 bytes                             | 3 bytes + fractional seconds storage |
| DATETIME  | 8 bytes                             | 5 bytes + fractional seconds storage |
| TIMESTAMP | 4 bytes                             | 4 bytes + fractional seconds storage |

…

##### String

In the following table,

-   `M` represents the **declared column length in characters**
    for nonbinary string types and bytes for binary string types.
-   `L` represents the **actual length in bytes** of a given string value.

---

-   `CHAR(M)`

    The compact family of InnoDB row formats optimize storage for variable-length character sets.

    See [COMPACT Row Format Storage Characteristics](https://dev.mysql.com/doc/refman/8.0/en/innodb-row-format.html#innodb-compact-row-format-characteristics).

    Otherwise, **M × w** bytes, 0 <= M <= 255,
    where **w** is the number of bytes required for the maximum-length character in the character set.

-   `BINARY(M)`

    **M** bytes, 0 <= M <= 255

-   `VARCHAR(M)`, `VARBINARY(M)`

    -   **L + 1** bytes if column values require 0 − 255 bytes
    -   **L + 2** bytes if values may require more than 255 bytes

-   `TINYBLOB`, `TINYTEXT`

    **L + 1** bytes, where **L < 28** ( 1 byte for saving text-size )

-   `BLOB`, `TEXT`

    **L + 2** bytes, where **L < 216** ( 2 bytes for saving text-size )

-   `MEDIUMBLOB`, `MEDIUMTEXT`

    **L + 3 bytes**, where **L < 224** ( 3 bytes for saving text-size )

-   `LONGBLOB`, `LONGTEXT`

    **L + 4 bytes**, where **L < 232** ( 4 bytes for saving text-size )

-   `ENUM('value1','value2',...)`

    1 or 2 bytes, depending on the number of enumeration values ( 65,535 values maximum )

-   `SET('value1','value2',...)`

    1, 2, 3, 4, or 8 bytes, depending on the number of set members ( 64 members maximum )

### Pagenation

-   `LIMIT length`
-   `LIMIT offset, length` = `LIMIT length OFFSET offset`

### ON DUPLICATE KEY UPDATE

-   References
    -   [INSERT ... ON DUPLICATE KEY UPDATE Statement - MySQL 8.0](https://dev.mysql.com/doc/refman/8.0/en/insert-on-duplicate.html)

### Prepare

-   References
    -   [理解 Mysql prepare 预处理语句](https://www.cnblogs.com/simpman/p/6510604.html)
    -   [MySQL :: MySQL 8.0 Reference Manual :: 13.5 Prepared SQL Statement Syntax](https://dev.mysql.com/doc/refman/8.0/en/sql-syntax-prepared-statements.html)

### Explain

-   References
    -   [MySQL 性能优化神器 Explain 使用分析](https://segmentfault.com/a/1190000008131735)

### SERIAL

`SERIAL` SQL TYPE

-   an alias for `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE`

### binlog_row_image

References

-   [MySQL 5.7 贴心参数之 binlog_row_image](http://www.cnblogs.com/gomysql/p/6155160.html)

### Index & Key

References

-   [mysql 中 index 和 key 的区别](https://blog.csdn.net/kusedexingfu/article/details/78347354)

> KEY | INDEX
>
> -   KEY is normally a synonym for INDEX. The key attribute PRIMARY KEY can also be specified as just KEY when given in a column definition. This was implemented for compatibility with other database systems.

### Multi-Range Read

References

-   [35 | join 语句怎么优化？](https://time.geekbang.org/column/article/80147)

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

### Union

-   `union` : 去重
-   `union all` : 不去重
