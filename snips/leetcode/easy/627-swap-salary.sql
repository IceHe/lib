-- https://leetcode.com/problems/swap-salary/

-- Runtime: 296 ms, faster than 91.99% of MySQL online submissions for Swap Salary.
-- Memory Usage: N/A

update salary set sex = case when sex = 'm' then 'f' else 'm' end;

-- UPDATE salary SET sex =
--   CASE sex
--     WHEN 'm' THEN 'f'
--     ELSE 'm'
--   END;
