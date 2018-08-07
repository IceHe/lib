# 自定义转码

## 需求

### 背景

时常会有业务方需要对一批媒体进行自定义的转码，创建为新的媒体，或者替换原有的媒体。做一个新的「自定义转码」服务，将该处理流程标准化，便于复用，提升效率。

### 功能

业务方提供媒体的 ID 以及自定义配置，即可进行转码；然后创建新的媒体，或替换原有媒体。

- 接入方式
    - 调用「批量添加媒体 ID 自定义转码任务」的接口
- 所需数据
    - 媒体 media_id 列表
    - 转码自定义配置的 ID（config_id）

> 展望：可以考虑囊括转码以外的「自定义的批量操作」
> - 例如：批量修改媒体信息（洗数据？）

## 接口

格式

- API
    - 接口说明
    - 请求方法：GET / POST
    - Host：待定
    - URL
    - 参数

失败返回

- 除非下文特殊说明，均与此类似

```json
{
    "error": "error_mesage", // 错误消息
    "error_code": 500 // 错误码（待定）
}
```

错误码

- TODO

### 添加

通过 media_ids 批量添加自定义转码任务

<!-- - **任务类型** `task_type`：每种类型对应一种自定义的任务需求
- **任务需求**：来自于业务方，通常可以归纳为以下多个操作的组合，包括但不限于
    - 去除 / 添加 / 替换水印
    - 添加清晰度
    - 添加新的媒体文件 / 替换原有的媒体文件
    - ……
- 需求实现：对应每种新的任务需求，需要先做好代码实现（初版）
    - 初版：只支持一两种任务
    - 后续：抽象出多种标准化的操作
        - 抽象复用原有代码
        - 便于组合成满足不同需求的任务，配置成新的任务类型 -->

- **类型** `task_type`：每种类型对应一种自定义的任务需求
- **任务需求**：来自于业务方，通常可以归纳为以下多个操作的组合，包括但不限于
    - 去除 / 添加 / 替换水印
    - 添加清晰度
    - 添加新的媒体文件 / 替换原有的媒体文件
    - ……
- 需求实现：对应每种新的任务需求，需要先做好代码实现（初版）
    - 初版：只支持一两种任务
    - 后续：抽象出多种标准化的操作
        - 抽象复用原有代码
        - 便于组合成满足不同需求的任务，配置成新的任务类型

```http
POST [host]/task/add
```

|参数|必选|类型|备注|
|-|:-:|-|-|
|media_ids|1|string|媒体 ID 列表：用逗号 `,` 分隔，最多 15 个|
|task_type|1|string|定制转码的任务类型：取值范围（待定）|

成功返回

```json
{
    "tasks": [
        {
            "task_id": "1",
            "media_id": "apple",
            "task_type": "transcode_remove_watermark_1",
            "result": true
        },
        {
            "task_id": "2",
            "media_id": "boy",
            "task_type": "transcode_remove_watermark_1",
            "result": true
        },
        ……
    ]
}
```

失败返回

- 部分失败

```json
{
    "tasks": [
        {
            "task_id": "1",
            "media_id": "apple",
            "task_type": "transcode_remove_watermark_1",
            "result": true
        },
        {
            "task_id": null,
            "media_id": "boy",
            "task_type": "transcode_remove_watermark_1",
            "result": false, // 失败
            "cause": "MQ is full"
        },
        ……
    ]
}
```

- 完全失败

```json
{
    "error": "fail to add task",
    "error_code": 110 // 待定
}
```

- 任务类型不存在

```json
{
    "error": "task_type not exist",
    "error_code": 120 // 待定
}
```

### 查询

支持批量

```http
GET [host]/task/get
```

参数

- 传 media_ids 或 task_ids ，二选一

|参数|必选|类型|备注|
|-|:-:|-|-|
|media_ids|1|string|媒体 ID 列表：用逗号 `,` 分隔，最多 15 个|
|task_ids|1|string|任务 ID 列表：用逗号 `,` 分隔，最多 15 个|

成功返回

```json
{
    "tasks": [
        {
            "task_id": "1",
            "media_id": "apple",
            "task_type": "transcode_remove_watermark_1"
        },
        {
            "task_id": "2",
            "media_id": "boy",
            "task_type": "transcode_remove_watermark_1"
        },
        ……
    ]
}
```

### 更新

（暂不实现）

```http
POST [host]/task/update
```

### 删除

（暂不实现）支持批量

```http
POST [host]/task/delete
```

|参数|必选|类型|备注|
|-|:-:|-|-|
|media_ids|1|string|媒体 ID 列表：用逗号 `,` 分隔，最多 15 个|
|task_ids|1|string|任务 ID 列表：用逗号 `,` 分隔，最多 15 个|

### 回调

- 无论被通知操作成功或失败，均记录日志
    - 成功：记录成功日志 callback_suc.log，并执行后续操作，例如创建新的媒体或替换原有的媒体
    - 失败：记录失败日志 callback_fail.log，不执行后续操作

```http
POST [host]/task/callback
```

### 文件添加

（暂不支持）通过包含 media_id 的文件的地址，来添加定制转码任务

- 待议：清单文件如何上传？或使用脚本将清单文件中的 media_id 读出再调用「添加」接口批量写入？

```http
POST [host]/task/add_by_file
```

|参数|必选|类型|备注|
|-|:-:|-|-|
|file_url|1|string|文件地址：文件只能包含 media_id，每行一个 media_id（即使用换行符 `\n` 分隔）|
|task_type|1|string|定制转码的任务类型：取值范围（待定）|

## 架构流程

### 流程

#### 任务添加与执行

以转码任务为例

```plantuml
@startuml

actor biz_partner

folder custom_transcode {
    folder producer {
        folder API_p as "API" {
            component task_add
        }
    }
    folder cusumer {
        folder API_c as "API" {
            component task_callback
        }
        agent polling_executor
    }
    folder task_type {
        agent transcode_task
    }
}

folder storage {
    database task_type [
        task_type
        ===
        task_type1: { }
        ---
        task_type1: { key: value}
        ---
        ……
    ]
    queue MQ [
        MQ: tasks
        ===
        task_id1: {media_id1, task_type1}
        ---
        task_id2: {media_id2, task_type2}
        ---
        ……
    ]
    folder log [
        suc.log
        ---
        fail.log
        ---
        ……
    ]
}

agent services [
    **services**
    ===
    media_lib
    ---
    object_lib
    ---
    story
    ---
    weibovideo
    ---
    ……
]

folder video_center {
    folder API_v as "API" {
        component get_trans_config
        component create_transcode_with_config
    }
    agent caller
}

biz_partner --> task_add : 1. media_ids & task_type

task_add --> transcode_task : 2. exist type?
task_add --> MQ : 3. push task

MQ ---> polling_executor : 4. get task
polling_executor --> transcode_task : 5. call impl
services --> transcode_task : 6. get context\n by media_id
get_trans_config --> transcode_task : 7. get config\n by context
transcode_task --> transcode_task : 8. modify config
transcode_task --> create_transcode_with_config: 9. context \n& config \n& callback_url

caller --> task_callback : 10. tell success \nor failure?
task_callback ..> log : 11. write log

@enduml
```

- TODO
    - create_transcode_with_config
        - 对比直接使用 create_transcode 接口的情况（决定：使用 create_transcode 接口）
        - context 配置在 http://video.admin.intra.weibo.com:8082/endpoint.html 后台中
        - 重试 create_transcode
    - 去掉 configs，context 上下文，customized 都直接存在 task 结构中（暂时的决定）
    - 配置直接从 medialib 中取（理论上是字段齐全的，但是数据还没洗，数据不完全）
        - 配置从 object 库获取配置，然后去各个服务找（story , weibovideo 等）
        - 特别是 object 库里缺 source 这个 context 包含的字段（因为敏感不能直接存到对象库里）
        - 考虑回种找到相关配置后，回种到 medialib 中（可能导致错误，暂时决定：不这么做）

## 存储

### DB

#### Configs

```sql
CREATE TABLE `custom_config` (
  `config_id` varchar(64) NOT NULL DEFAULT '',
  `type` int(11) NOT NULL DEFAULT '0' COMMENT 'todo', // Example
  `extension` varchar(2048) NOT NULL DEFAULT '' COMMENT '其他扩展信息', // Example
  // TODO
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `update_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '更新时间',
  PRIMARY KEY (`media_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='定制转码配置'
```

```json
[
    {
        "config_id": "1",
        "type": …,
        "extension": …,
        ……
    },
    {
        "config_id": "2",
        "type": …,
        "extension": …,
        ……
    },
    ……
]
```

### MQ

#### Tasks

```json
[
    {
        "task_id": "110",
        "media_id": "aBcDe",
        "config_id": "video_7"
    },
    {
        "task_id": "233",
        "media_id": "vWxYz",
        "config_id": "image_5"
    },
    ……
]
```

### Log

#### Fail

```ini
[FAIL] 20180725 23:09:26.196 [custom_transcode] callback - task={"task_id":"aBcDe","media_id":"12345","config_id":"video_120"}, response={……} 3406181d-8074-47bf-8e7d-1cfe7578cd75
```
