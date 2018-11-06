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
$ mysql -h HOST -P PORT -u USERNAME -pPASSWORD
```

## CLI

Databases

```bash
> show databases;
> use DB_NAME;
> show tables;
```

Show Table Definition

```bash
desc TABLE_NAME;
```