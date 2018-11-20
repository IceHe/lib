# MySQL

## Create User

```bash
# login as root user
mysql -u root -p

# create new user
create user 'springuser'@'localhost' identified by 'ThePassword';

# grant privileges to new user
GRANT ALL PRIVILEGES ON *.* TO 'username'@'localhost' IDENTIFIED BY 'password';

# if encounter 'Cannot load from mysql.procs_priv, the table is probably corrupted'
mysql_upgrade -u root -p
```

## SERIAL

`SERIAL` SQL TYPE

- an alias for `BIGINT UNSIGNED NOT NULL AUTO_INCREMENT UNIQUE`

## Connect

```bash
mysql -h HOST -P PORT -u USERNAME -pPASSWORD
# e.g.
$ mysql -h db.icehe.xyz -P 5104 -u username -ppassword
```

## CLI

### Databases

Show

```bash
show databases;
```

Select

```bash
use DB_NAME;
```

### Tables

Show

```bash
show tables;
```

Show Table Definition

```bash
desc TABLE_NAME;
```

Show Create Table

```bash
show create table <table_name>
# e.g.
show create table jobs
```

## Troubleshooting

ERROR

> MySql server startup error 'The server quit without updating PID file '

- StackOverflow : https://stackoverflow.com/questions/4963171/mysql-server-startup-error-the-server-quit-without-updating-pid-file

## TODO

- Upgrade macOS MySQL from version 5.7 to 8+
- `mysqldump` backup
