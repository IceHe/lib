# MongoDB

References

- Official Website : https://www.mongodb.com/
- Guide - ZH Ver. : http://www.mongodb.org.cn/tutorial/3.html

## Database

Create

```bash
> use db_name
# if not exist, it wiil be created.
```

Delete

```bash
# switch to db you want to drop
> use db_name
# drop
> db.dropDatabase()
```

## Collection

Insert

```bash
# e.g.
> db.collection_name.insert({"name":"hello"})
```

List (Find)

```bash
> db.collection_name.find()
# e.g.
> db.collection_name.find({name:"icehe"})
> db.collection_name.find({name:"icehe"}).pretty()
```

Update

- Reference : http://www.mongodb.org.cn/tutorial/11.html

```bash
> db.collection_name.update()
# e.g.
> db.t_collection.update({name:"icehe"},{$set:{age:27}})
> db.t_collection.update({name:"icehe"},{$set:{name:"abc"}})
```

Delete

```bash
> db.collection_name.remove({……})
```

Query

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