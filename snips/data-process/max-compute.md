# MaxCompute

> - 大数据计算服务（MaxCompute，原名 ODPS）是一种快速、完全托管的TB/PB级数据仓库解决方案。
> - MaxCompute 向用户提供了完善的数据导入方案，以及多种经典的分布式计算模型。

## Data Flow

DTS -> MaxCompute

## References

References 1

- MaxCompute_大数据计算服务_阿里云数加大数据仓库解决方案 : https://cn.aliyun.com/product/odps
    - 学习路径图_快速入门_操作指南 : https://help.aliyun.com/learn/learningpath/maxcompute.html?spm=5176.7944453.751670.btn16.528772eet44gHq
    - 全套攻略 : https://yq.aliyun.com/articles/78108?spm=5176.7944453.751674.1.528772eet44gHq
    - 百问集锦 : https://yq.aliyun.com/ask/55867?spm=5176.7944453.751674.2.528772eet44gHq
    - 最佳实践 : https://yq.aliyun.com/teams/6/type_blog-cid_106-page_1?spm=5176.7944453.751674.3.528772eet44gHq
    - 更多精彩内容 : https://yq.aliyun.com/teams/6/?spm=5176.7944453.751674.4.528772eet44gHq

References 2 ( appended on 2019-03-19~20 )

- 阿里云数加大数据体验馆-构建百亿数据毫秒级响应的日志分析系统 : https://data.aliyun.com/experience/case10?spm=5176.7944453.751670.btn5.34236c1fXjoHsc
    - 用户指南 : https://helpcdn.aliyun.com/document_detail/73783.html?spm=a2c4g.11186623.2.23.2d8235f33TRgOY
- 什么是MaxCompute_产品简介_MaxCompute-阿里云 : https://help.aliyun.com/document_detail/27800.html?spm=5176.208367.1107645.2.42f64918yhrcGH
- 视频介绍
    - DataWorks调度配置分享_功能介绍_视频专区_MaxCompute-阿里云 : https://help.aliyun.com/video_detail/87887.html?spm=a2c4g.11174359.2.6.6caa4ca0xj8T7j
    - MaxCompute 2.0新功能介绍_功能介绍_视频专区_MaxCompute-阿里云 : https://help.aliyun.com/video_detail/89937.html?spm=a2c4g.11174359.2.1.6caa4ca0xj8T7j

## Features

Intro ( [ref](https://help.aliyun.com/document_detail/27800.html?spm=5176.208367.1107645.2.42f64918yhrcGH) )

- 数据通道
    - 批量、历史数据通道：Tunnel 提供Java编程接口，实现本地文件和服务数据的互通
    - 实时、增量数据通道：DataHub 适合增量数据导入
        - 支持多种数据传输插件 Logstash、Fluentd
- 计算分析
    - SQL
        - 不支持事务、索引、Update/Delete
        - 语法与 MySQL 等有差异
        - 响应时间：在使用方式上，MaxCompute SQL **最快可以在分钟、乃至秒级别完成查询，无法在毫秒级别返回结果**
    - 「用户自定义函数」：满足自定义的计算需求
        - UDF / UDAF / UDTF / UDT / UDJ
    - 「MapReduce」：提供 [Java 编程接口](https://help.aliyun.com/document_detail/27883.html?spm=a2c4g.11186623.6.686.c6097b56IAdWgR)（MapBase/ReduceBase/……）
    - 「Graph」：图计算框架，利用图进行建模
- SDK - [Java](https://help.aliyun.com/document_detail/34614.html?spm=a2c4g.11186623.2.29.1c9d1536rQWZxC#concept-utw-vvc-5db)

Tech Detail

- 支持「分区表」partition
    - 「动态分区」( [detail](https://helpcdn.aliyun.com/document_detail/73779.html?spm=a2c4g.11186623.2.10.78327a71NlDfQR) )
- 多路输出 ( [detail](https://helpcdn.aliyun.com/document_detail/73776.html?spm=a2c4g.11186623.2.17.32155f20skrxZC) )
- Lateral View : 将一行拆成多行数据 ( [detail](https://helpcdn.aliyun.com/document_detail/87722.html?spm=a2c4g.11186623.2.18.602a10d0yevW4A) )
- SEMI JOIN : 右表只用来过滤左表的数据而不出现在结果集中 ( [detail](https://helpcdn.aliyun.com/document_detail/73784.html?spm=a2c4g.11186623.2.15.6c813acbZcQQZA) )
    - 支持 LEFT SEMI JOIN 和 LEFT ANTI JOIN 两种语法

Usage

- DataWorks : 数据控制台
    - 可以将 DataWorks 理解成 MaxCompute 的 web 客户端
    - 与其它阿里云服务的集成使用_产品简介_MaxCompute-阿里云 : https://help.aliyun.com/document_detail/57151.html?spm=a2c4g.11186623.6.545.39a2d603yQm5hO

## Glossary

- 数据倾斜
- 长尾
- 伏羲 fuxi：是飞天平台内核中负责「资源管理、任务调度」的模块
- 实例 instance：对应 Hadoop 中的 job
- UDF : User Defined Function
    - 狭义的 UDF : User Defined Scalar Function
        - 输入与输出是一对一的关系
- UDAF : User Defined Aggregation Function 自定义聚合函数
    - 输入和输出是多对一的关系
- UDTF : User Defined Table Valued Function 自定义表值函数
    - 一次函数调用输出多行数据（唯一能返回多个字段的自定义函数）
- UDT : User Defined Type
    - UDT允许在SQL中直接引用第三方语言的类或者对象，获取其数据内容或者调用其方法！
    - UDT_SQL_用户指南_MaxCompute-阿里云 : https://helpcdn.aliyun.com/document_detail/92652.html?spm=a2c4g.11186623.6.665.66455a25xaxvdK
- 生命周期 Life Cycle : 数据表的存活时间，（经历指定时间后没有变动）过期会被自动回收
    - 可以禁用 ( [detail](https://helpcdn.aliyun.com/document_detail/73769.html?spm=a2c4g.11186623.2.53.20316aaaV4AKrw) )

## SQL Limit

- SQL限制项汇总_SQL_用户指南_MaxCompute-阿里云 : https://helpcdn.aliyun.com/document_detail/51823.html?spm=a2c4g.11186623.2.14.539d4090zcJ4kU#concept-yjp-crl-vdb
    - 分区 partition
        - 表分区层级，max 6 层
        - 单表分区数，max 6w 个
        - 一次查询最多查询分区数，max 1w 个
        - string 分区类型的分区值，不支持中文
            - 列的别名，可以为中文
    - 表列定义，max 1200 个
    - 表分区，max 6w 个
    - SELECT 语句屏显时，目前最多只能显示 1w 行
        - 作为子查询语句时，无此限制
        - SELECT 分区表时，禁止全表扫描
    - WHERE 子语句条件个数，max 256
    - JOIN 不支持 cross join 无条件连接（笛卡尔积）
        - 注意：它和 full outer join 的区别 ( [detail](https://stackoverflow.com/questions/3228871/sql-server-what-is-the-difference-between-cross-join-and-full-outer-join) )
    - IN 参数，max 1024 个
    - 数据类型：字符串/Binary，长度限制 8M
- 与其他SQL语法的差异_SQL_用户指南_MaxCompute-阿里云 : https://helpcdn.aliyun.com/document_detail/54051.html?spm=a2c4g.11186623.4.2.35953e05mlRBsR

## SQL Differences

- INSERT INTO 与 INSERT OVERWRITE 的区别是：
    - INSERT INTO 会向表或表的分区中追加数据
    - 而INSERT OVERWRITE 会在向表或分区中插入数据前清空表中的原有数据
- insert overwrite 不支持 values 语法
- except（和 union 有关）跟 left anti join 不同
    - except 需要两个数据集的全部字段一致？
    - left anti join 只是指定的字段一致就行？
- Explain 的效果和 MySQL 不太一样 ( [detail](https://helpcdn.aliyun.com/document_detail/73787.html?spm=a2c4g.11186623.2.10.36ad47c5O2ZU2p) )

## SQL Optimize

- SQL优化示例_计算优化_最佳实践_MaxCompute-阿里云 : https://helpcdn.aliyun.com/document_detail/102614.html?spm=a2c4g.11186623.2.13.539d4090zcJ4kU#concept-eq5-sgq-kgb
- 长周期指标的计算优化方案_计算优化_最佳实践_MaxCompute-阿里云 : https://helpcdn.aliyun.com/document_detail/58740.html?spm=a2c4g.11186623.2.22.373f6fa69SlDbz
- 表操作_DDL语句_SQL_用户指南_MaxCompute-阿里云 : https://helpcdn.aliyun.com/document_detail/73768.html?spm=a2c4g.11186623.2.7.484c1d44Fma7SF#concept-l3j-w31-wdb

## Question

- MAPJOIN ?
    - 一般 JOIN 只支持：and 连接的等值条件
    - MAPJOIN 支持：不等式连接，或者使用 or 连接多个条件！
- DUAL 表 ? ( [detail](https://helpcdn.aliyun.com/document_detail/27819.html?spm=a2c4g.11186623.6.574.7d5d2df25wtAKg) )
