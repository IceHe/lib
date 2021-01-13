-- https://leetcode.com/problems/not-boring-movies/

-- create table cinema (
--     id int not null auto_increment,
--     movie varchar(20) default '',
--     description varchar(30) default '',
--     rating float default 0.0,
--     primary key(id)
-- ) engine=innodb default charset=utf8mb4;

-- insert into cinema value(1, "War", "great 3D", 8.9);
-- insert into cinema values(2, "Science", "fiction", 8.5),
-- (3, "irish", "boring", 6.2),
-- (4, "Ice song", "Fantacy", 8.6),
-- (5, "House card", "Interesting", 9.1);

-- Runtime: 148 ms, faster than 31.85% of MySQL online submissions for Not Boring Movies.
-- Memory Usage: N/A

select * from cinema where description != "boring" and id % 2 = 1 order by rating desc;

-- `mod()` 通用性更好，可以用在 Oracle 中；而 `id % 2 = 1` 只能用在 MySQL 中用（not generic SQL）
-- <> 才是标准的不等于号

select * from cinema where mod(id, 2) = 1 and description <> "boring" order by rating desc;

-- 添加索引，看起来没达到优化效果

-- alter table cinema add index(rating);
-- alter table cinema add index `rating`(`rating`); -- 等价于上一句
-- alter table `cinema` drop index `rating`;

-- explain select * from cinema where mod(id, 2) = 1 and description <> "boring" order by rating desc;
-- +----+-------------+--------+------------+------+---------------+------+---------+------+------+----------+-----------------------------+
-- | id | select_type | table  | partitions | type | possible_keys | key  | key_len | ref  | rows | filtered | Extra                       |
-- +----+-------------+--------+------------+------+---------------+------+---------+------+------+----------+-----------------------------+
-- |  1 | SIMPLE      | cinema | NULL       | ALL  | NULL          | NULL | NULL    | NULL |    5 |    80.00 | Using where; Using filesort |
-- +----+-------------+--------+------------+------+---------------+------+---------+------+------+----------+-----------------------------+
-- 1 row in set, 1 warning (0.00 sec)
