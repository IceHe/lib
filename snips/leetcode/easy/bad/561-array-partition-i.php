<?php

// https://leetcode.com/problems/array-partition-i/

//Runtime: 128 ms, faster than 100.00% of PHP online submissions for Array Partition I.
//Memory Usage: 17.7 MB, less than 100.00% of PHP online submissions for Array Partition I.

class Solution {

    /**
     * @param Integer[] $nums
     * @return Integer
     */
    function arrayPairSum($nums) {
        sort($nums);
        $sum = 0;
        $len = count($nums);
        for ($i = 0; $i < $len; $i += 2) {
            $sum += $nums[$i];
        }
        return $sum;
    }
}
