# MySQL

> TODO

## Q & A

Create User

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
