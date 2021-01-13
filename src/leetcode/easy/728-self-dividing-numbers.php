<?php

// https://leetcode.com/problems/self-dividing-numbers/

//Runtime: 20 ms, faster than 100.00% of PHP online submissions for Self Dividing Numbers.
//Memory Usage: 14.9 MB, less than 100.00% of PHP online submissions for Self Dividing Numbers.

class Solution {
    /**
     * @param Integer $left
     * @param Integer $right
     * @return Integer[]
     */
    function selfDividingNumbers($left, $right) {
        if ($left > $right) {
            return [];
        }

        $matches = [];
        for ($i = $left; $i <= $right; ++$i) {
            $tmp = $i;
            $isMatch = true;

            while ($tmp > 0) {
                $position = $tmp % 10;

                if ($position === 0) {
                    $isMatch = false;
                    break;
                }

                if ($i % $position != 0) {
                    $isMatch = false;
                    break;
                }

                $tmp = (int)($tmp / 10);
            }

            if ($isMatch) {
                $matches[] = $i;
            }
        }

        return $matches;
    }
}

$solution = new Solution();
echo var_export($solution->selfDividingNumbers(1, 22), true)."\n";
