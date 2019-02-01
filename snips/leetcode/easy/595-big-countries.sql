# https://leetcode.com/problems/big-countries/submissions/

# 1
select name, population, area from World where population > 25000000 or area > 3000000;

# 2
select name, population, area from World where population > 25000000
union
select name, population, area from World where area > 3000000;
