<?php

// https://leetcode.com/problems/n-repeated-element-in-size-2n-array/

// Runtime: 104 ms, faster than 18.18% of PHP online submissions for N-Repeated Element in Size 2N Array.

//class Solution {
//    function repeatedNTimes($A) {
//        $nums = [];
//        foreach ($A as $num) {
//            if (in_array($num, $nums)) {
//                return $num;
//            } else {
//                $nums[] = $num;
//            }
//        }
//        return false;
//    }
//}

// Runtime: 80 ms, faster than 90.91% of PHP online submissions for N-Repeated Element in Size 2N Array.

class Solution {
    function repeatedNTimes($A) {
        $len = count($A);
        for ($k = 1; $k <= 3; ++$k) {
            for ($i = 0; $i < $len - $k; $i++) {
                if ($A[$i] == $A[$i + $k]) {
                    return $A[$i];
                }
            }
        }
        return false;
    }
}

$A = [5,1,5,2,5,3,5,4];
echo (new Solution())->repeatedNTimes($A);
