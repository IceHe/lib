# Test MySQL on macOS

- Version : 8+

## Install

Homebrew

```bash
brew install mysql
```

Or using native packages

- https://dev.mysql.com/doc/refman/8.0/en/osx-installation-pkg.html

## Init

References

- Getting Started with MySQL : https://dev.mysql.com/doc/mysql-getting-started/en/

### Connect

```bash
mysql -h HOST -P PORT -u USERNAME -pPASSWORD
# e.g.
$ mysql -h db.icehe.xyz -P 5104 -u username -ppassword
```

e.g.

```bash
$ mysql -u root -p
Enter password:
# then press ENTER ↩ ( as no password )

Welcome to the MySQL monitor.  Commands end with ; or \g.
Your MySQL connection id is 21
Server version: 8.0.13 Homebrew

Copyright (c) 2000, 2018, Oracle and/or its affiliates. All rights reserved.

Oracle is a registered trademark of Oracle Corporation and/or its
affiliates. Other names may be trademarks of their respective
owners.

Type 'help;' or '\h' for help. Type '\c' to clear the current input statement.
```

#### Create User

- 仅供参考

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

### Change Password

```bash
mysql> ALTER USER 'root'@'localhost' IDENTIFIED BY 'new_password';
Query OK, 0 rows affected (0.02 sec)
```

### Create Database

```bash
mysql> CREATE DATABASE test_db;
Query OK, 1 row affected (0.11 sec)
```

### Show Database

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

### Use Database

```bash
mysql> USE test_db;
Database changed
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
