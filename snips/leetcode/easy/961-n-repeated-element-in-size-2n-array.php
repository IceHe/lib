<?php

// https://leetcode.com/problems/n-repeated-element-in-size-2n-array/

class Solution {
    function repeatedNTimes($A) {
        $nums = [];
        foreach ($A as $num) {
            if (in_array($num, $nums)) {
                return $num;
            } else {
                $nums[] = $num;
            }
        }
        return false;
    }
}

$A = [5,1,5,2,5,3,5,4];
echo (new Solution())->repeatedNTimes($A);
