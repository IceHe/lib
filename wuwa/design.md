# 声骸副词条统计系统

## 需求

-   记录副词条 substat 属于哪个声骸 echo_id
-   记录声骸 echo 属于哪个玩家 user_id
-   记录声骸 echo 和 substat 属于哪个套装 clazz

-   记录调谐时间 tuned_at 而非记录时间 logged_at，
    保持相对时间顺序即可，即可以手动调整调谐日期。

    考虑：给定日期，剩下时分秒部分跟据当天时间来？
    好像跨天记录就会出问题？
    那么再给顺延一天的日期不就行了？
    有点不严谨，但是时间顺序好像解决了？
    至少新加的数据不会出问题。

-   查询和切换到最近开过的声骸，然后继续开剩下的副词条。

    考虑：跟据副词条位置、类型、档位确定，找最近的，
    如果有多个一样的怎么处理？

-   查询包含哪些词条

-   看数据库就能明白表意 or 使用数字枚举值 or 两者都用

## 存储方案

字段原则

-   可读性：中文名称+档位

    缺点：加索引不方便

-   可检索：bitmap 64 bits?

    -   词条种类：13 种 -> 13 bits
    -   档位：8 或 4 档 -> 8 bits
    -   词条位置：5 个 -> 5 bits（可选：分字段处理）
    -   套装 16 种 -> 16 bits? (可选：目前 16 种)
    -   暂时 bitmap 长度最多需要：13 + 8 + 5 + 16 = 42

### 声骸 echo

字段

-   id：echo_id
-   substat1: 第 1 个副词条 bitmap
-   substat2: 第 2 个副词条 bitmap
-   substat3: 第 3 个副词条 bitmap
-   substat4: 第 4 个副词条 bitmap
-   substat5: 第 5 个副词条 bitmap
-   s1_desc: 第一个副词条，中文名称+档位（可选）
-   s2_desc: 第二个副词条，中文名称+档位（可选）
-   s3_desc: 第三个副词条，中文名称+档位（可选）
-   s4_desc: 第四个副词条，中文名称+档位（可选）
-   s5_desc: 第五个副词条，中文名称+档位（可选）
-   clazz: 声骸套装，中文名称
-   user_id：鸣潮玩家 ID
-   tunned_at：调谐日期（在具体哪天调谐，只区分相对顺序）
-   created_at：记录创建日期（该条记录在数据库创建的时间）
-   update_at：记录更新时间（该条记录在数据库更新的日期）

索引

-   primary key id
-   index_substat (substat1, substat2, substat3, substat4, substat5)

建表

```sql
CREATE TABLE wuwa_echo_log (
    id SERIAL PRIMARY KEY,                            -- 声骸 ID，自动递增
    substat1 BIGINT,                                  -- 第 1 个副词条（64 位 bitmap）
    substat2 BIGINT,                                  -- 第 2 个副词条（64 位 bitmap）
    substat3 BIGINT,                                  -- 第 3 个副词条（64 位 bitmap）
    substat4 BIGINT,                                  -- 第 4 个副词条（64 位 bitmap）
    substat5 BIGINT,                                  -- 第 5 个副词条（64 位 bitmap）
    s1_desc TEXT,                                     -- 第 1 个副词条描述（名称+档位）
    s2_desc TEXT,                                     -- 第 2 个副词条描述（名称+档位）
    s3_desc TEXT,                                     -- 第 3 个副词条描述（名称+档位）
    s4_desc TEXT,                                     -- 第 4 个副词条描述（名称+档位）
    s5_desc TEXT,                                     -- 第 5 个副词条描述（名称+档位）
    clazz TEXT,                                       -- 声骸套装名称
    user_id INTEGER NOT NULL,                         -- 鸣潮玩家 ID（整数型）
    deleted INTEGER DEFAULT 0,                        -- 删除标记: 0 未删除 1已删除
    tuned_at TIMESTAMP WITH TIME ZONE,               -- 调谐日期（只区分相对顺序）
    created_at TIMESTAMP WITH TIME ZONE DEFAULT now(),-- 记录创建时间
    updated_at TIMESTAMP WITH TIME ZONE DEFAULT now() -- 记录更新时间
);

-- 创建联合索引，优化针对 substat1 到 substat5 的查询
CREATE INDEX idx_substat_all ON echo (substat1, substat2, substat3, substat4, substat5);

```
