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

## Basic

### 文档关系

- 嵌入式关系

```json
{
    "_id":ObjectId("52ffc33cd85242f436000001"),
    "contact": "987654321",
    "dob": "01-01-1991",
    "name": "Tom Benzamin",
    "address": [
        {
            "building": "22 A, Indiana Apt",
            "pincode": 123456,
            "city": "Los Angeles",
            "state": "California"
        },
        {
            "building": "170 A, Acropolis Apt",
            "pincode": 456789,
            "city": "Chicago",
            "state": "Illinois"
        }
    ]
}
```

- 引用式关系

```json
{
    "_id":ObjectId("52ffc33cd85242f436000001"),
    "contact": "987654321",
    "dob": "01-01-1991",
    "name": "Tom Benzamin",
    "address_ids": [
        ObjectId("52ffc4a5d85242602e000000"),
        ObjectId("52ffc4a5d85242602e000001")
    ]
}
```

Ref : http://www.mongodb.org.cn/tutorial/28.html

## Others

覆盖索引查询

- Ref : http://www.mongodb.org.cn/tutorial/30.html
- 概念
- 建立索引
- 查询
- 分析查询：索引是否有效，性能如何？
    - explain()
    - hint()
- 限制 : http://www.mongodb.org.cn/tutorial/34.html

原子操作

- Ref : http://www.mongodb.org.cn/tutorial/32.html
- 常用命令

ObjectId

- Ref : http://www.mongodb.org.cn/tutorial/35.html

固定集合（Capped Collections）

- Ref : http://www.mongodb.org.cn/tutorial/41.html
