-- https://leetcode.com/problems/swap-salary/

-- Runtime: 296 ms, faster than 91.99% of MySQL online submissions for Swap Salary.
-- Memory Usage: N/A

-- UPDATE salary SET sex =
--   CASE sex
--     WHEN 'm' THEN 'f'
--     ELSE 'm'
--   END;

---------------------------------------------------

update salary set sex = case when sex = 'm' then 'f' else 'm' end;

-- Runtime: 300 ms, faster than 85.21% of MySQL online submissions for Swap Salary.
-- Memory Usage: N/A

update salary set sex = if(sex = 'm', 'f', 'm')

---------------------------------------------------

-- 以下方法可能看起来巧妙，但是可读性不好，而且性能也没有提升，没有必要！

update salary set sex = CHAR(ASCII('f') ^ ASCII('m') ^ ASCII(sex));
update salary set sex = CHAR(ASCII('f') + ASCII('m') - ASCII(sex));
