-- https://leetcode.com/problems/big-countries/submissions/

-- Runtime: 1637 ms, faster than 98.97% of MySQL online submissions for Big Countries.
select name, population, area from World where population > 25000000 or area > 3000000;

-- Runtime: 1664 ms, faster than 93.41% of MySQL online submissions for Big Countries.
select name, population, area from World where population > 25000000
union
select name, population, area from World where area > 3000000;
