# Hive

References

- Apache Hive TM : https://hive.apache.org/

> The Apache Hive data warehouse software facilitates reading, writing, and managing large datasets residing in distributed storage using SQL.
>
> - Structure can be projected onto data already in storage.
> - A command line tool and JDBC driver are provided to connect users to Hive.

问题（背景如下）

> 数据存储方面：它能够存储很大的数据集，并且对数据完整性、格式要求并不严格。

- 为什么能存很大？因为 HDFS 能存很大？
- 为什么对完整性和格式要求不严格？

> 数据处理方面：因为Hive语句最终会生成MapReduce任务去计算，所以不适用于实时计算的场景，它适用于离线分析。

- 为什么生成 MapReduce 任务，就不适用于实时计算？
