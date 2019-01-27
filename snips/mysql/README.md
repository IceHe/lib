# MySQL (WIP)

## Features

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
- https://sql.sh/cours

### Basic Grammar

TODO : abstract

### ON DUPLICATE KEY UPDATE

- Reference : https://sql.sh/cours/insert-into/on-duplicate-key

## CLI

### Create User

```bash
# login as root user
mysql -u root -p

# create new user
create user 'springuser'@'localhost' identified by 'ThePassword';

# grant privileges to new user ( DML )
GRANT ALL PRIVILEGES ON *.* TO 'username'@'localhost' IDENTIFIED BY 'password';

# if encounter 'Cannot load from mysql.procs_priv, the table is probably corrupted'
mysql_upgrade -u root -p
```

### Connect

```bash
mysql -h HOST -P PORT -u USERNAME -pPASSWORD
# e.g.
$ mysql -h db.icehe.xyz -P 5104 -u username -ppassword
```

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

### Dump

References

- Dump Data : http://www.runoob.com/mysql/mysql-database-export.html
- Import Data : http://www.runoob.com/mysql/mysql-database-import.html

Trouble-shooting

- How should I tackle --secure-file-priv in MySQL? https://stackoverflow.com/a/40419548/5110899

Dump

```bash
mysqldump -u USERNAME -p DATABASE | tee -a dump.sql
# then enter password
```

Import

- Read & Execute SQL

```bash
mysql -u USERNAME -p DATABASE < dump.sql
# then enter password
```

## Others

### SERIAL

`SERIAL` SQL TYPE

- an alias for `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE`

### Troubleshooting

ERROR

> MySql server startup error 'The server quit without updating PID file '

- StackOverflow : https://stackoverflow.com/questions/4963171/mysql-server-startup-error-the-server-quit-without-updating-pid-file
