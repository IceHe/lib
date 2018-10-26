# awk-sed-grep 应用

- 获取测试数据：<git clone ssh://git@git.intra.weibo.com:2222/im/workshop.git>

## 返回时间大于某值的日志

获得大于返回时间 200ms 的日志

- 返回时间在 `^.*cost=((\d+)\).*$`（正则表达式）

### 方案 Z

``` shell
awk -F '[=)]' '$2 > 200' access
```

`-F` 分割符
`'[=)]'` 正则表达式，`=` 和 `)` 都能匹配

### 方案 C

``` shell
egrep 'cost=([2-9][0-9]{2,}|[0-9]{3,})' access
```

### 答案

``` shell
awk -F'cost=' 'int($2)>200' access
```

## 获取时间与相关信息

获得时间 + uid + content

### 方案 Y

``` shell
awk '{print $2,$3,$12,$20}' content| awk -F '[=, ]' '{print $1,$2,$5,$8}'
```

### 方案 Z

``` shell
sed -E "s/.* ([0-9]{8} [0-9:.]{12}) .*uid=([0-9]+).*content='([^']+)'.*/\1 \2 \3/g" content
```

存在问题如果 content 中有 = 等号和空格之类，content 内容的截取会出问题

### 改良

``` shell
sed -E "s/.* ([0-9]{8} [0-9:.]{12}) .*uid=([0-9]+).*content='([^']*)'.*/\1 \2 \3/g" content
```

test:
sed -E "s/.* \d{4}(\d{4} [0-9:.]{12}) .*uid=([0-9]+).*content='([^']*)'.*/\1 \2 \3/g" content

---

## 每种状态的线程数量

获取 jstack 的线程状态，统计每种状态有多少个线程

``` shell
grep 'java.lang.Thread.State' jstack | sort | uniq -c | sort
```

## 线程池占比最高的代码

统计 catalina 线程池中占比最高的代码

``` shell
cat jstack| grep cata -A5  | sort | uniq -c | sort
```

### grep 的选项参数 -A

``` man
-A num, --after-context=num
        Print num lines of trailing context after each match.  See also the -B and -C options.
```

## 进出房间人数

统计加入、退出房间的「时间 + 人 + join/logout」

### try

- work partly

``` shell
head -n 1 client | jq '.'
head -1 client | jq '.'
head -1 client | jq '.medialive_qa_datas'
head -1 client | jq -r .medialive_qa_datas
```

- cannot work

``` shell
sed -E "s/.* --([^-]*)--加入直播间成功.*/\1/g" client
head client | egrep -o "--([^-]*)--加入直播间成功"
```

### official try (tips)

``` shell
#!/bin/bash

#echo '…' | while read line; do
    # do something
#done

while read a; do
    uid=`echo "%a" | jq -r .medialive_qa_datas`
    echo $uid
    content=`head`
done
```

### 答案 Z

``` shell
cat client \
    | jq -r '.medialive_qa_uid as $uid | .medialive_qa_datas | split("\n") | .[] | $uid + " " + . ' \
    | grep '直播间成功' \
    | awk -F '[ -]+' '{print $1, $3, $5}'
```
