# MongoDB (draft)

References

- Official Website : https://www.mongodb.com/
- Guide - ZH Ver. : http://www.mongodb.org.cn/tutorial/3.html

## Database

### Show

```bash
> show dbs
# e.g.
admin  0.000GB
config 0.000GB
local  0.000GB
test   0.052GB
```

### Select

```bash
> use test
switched to db test

# show current db
> db
test
```

### Create

```bash
> use db_name
# if not exist, it wiil be created.
```

### Delete

```bash
# switch to db you want to drop
> use db_name
# drop
> db.dropDatabase()
```

### Dump & Store

> 备份与恢复

- Reference : http://www.mongodb.org.cn/tutorial/22.html

Dump

```bash
mongodump -h <host> --port=<port> -d <db> \
    -u <username> -p <password> \
    -o <output_directory>

# e.g.
mongodump -h 10.2.3.4 --port=27017 -d test \
    -u admin -p 12345 -o dump
```

Restore

```bash
mongorestore -h <host> --port=<port> -d <db> \
    -u <username> -p <password> \
    <output_directory/db_name>
# e.g.
mongorestore -h 127.0.0.1 --port=27017 -d db_name dump/db_name
```

- `<output_directory/db_name>` 备份数据所在位置
    - 例如：/usr/home/icehe/dump/test（test 为 DB 名）
- `--drop` 恢复的时候，先删除当前数据，然后恢复备份的数据
    - 即恢复后，备份后添加修改的数据都会被删除。慎用！

## Collection

### Insert

```bash
# e.g.
> db.collection_name.insert({"name":"hello"})
```

### Find

```bash
> db.collection_name.find()
# e.g.
> db.collection_name.find({name:"icehe"})
> db.collection_name.find({name:"icehe"}).pretty()
```

### Update

- Reference : http://www.mongodb.org.cn/tutorial/11.html

```bash
> db.collection_name.update()
# e.g.
> db.t_collection.update({name:"icehe"},{$set:{age:27}})
> db.t_collection.update({name:"icehe"},{$set:{name:"abc"}})
```

### Delete

```bash
> db.collection_name.remove({……})
```

### Query

- Reference
    - where, and, or : http://www.mongodb.org.cn/tutorial/13.html
    - conditional : http://www.mongodb.org.cn/tutorial/14.html
    - $type : http://www.mongodb.org.cn/tutorial/15.html
    - limit, skip : http://www.mongodb.org.cn/tutorial/16.html
    - sort(1/-1) : http://www.mongodb.org.cn/tutorial/17.html

```bash
# 跳过前 m 个，最多 n 个，倒序列举
> db.collection_name.find({……}).skip(m).limit(n).sort(-1)
```

## Commands

Monitor ( 监控 )

- Reference : http://www.mongodb.org.cn/tutorial/23.html

```bash
# 运行状态监测
mongostat
# 实例监测，统计数据
mongotop
```