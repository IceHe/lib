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

//class Solution {
//    function repeatedNTimes($A) {
//        $len = count($A);
//        for ($k = 1; $k <= 3; ++$k) {
//            for ($i = 0; $i < $len - $k; $i++) {
//                if ($A[$i] == $A[$i + $k]) {
//                    return $A[$i];
//                }
//            }
//        }
//        return false;
//    }
//}

$A = [1,2,3,3];
echo (new Solution())->repeatedNTimes($A)."\n";
