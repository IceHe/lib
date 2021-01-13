<?php

// https://leetcode.com/problems/squares-of-a-sorted-array/

// Runtime: 108 ms, faster than 25.00% of PHP online submissions for Squares of a Sorted Array.

//class Solution {
//    function sortedSquares($A) {
//        foreach ($A as $k => $v) {
//            if ($v < 0) {
//                $A[$k] = -$v;
//            }
//            $A[$k] *= $A[$k];
//        }
//        sort($A);
//        return $A;
//    }
//}

// Runtime: 100 ms, faster than 25.00% of PHP online submissions for Squares of a Sorted Array.

class Solution {
    function sortedSquares($A) {
        $lf = 0;
        $rg = count($A) - 1;

        $result = [];
        while ($lf <= $rg) {
            $lfVal = $A[$lf] * $A[$lf];
            $rgVal = $A[$rg] * $A[$rg];
            if ($lfVal > $rgVal) {
                array_push($result, $lfVal);
                $lf++;
            } else {
                array_push($result, $rgVal);
                $rg--;
            }
        }

        return array_reverse($result);
    }
}

echo var_export($A = [-4,-1,0,3,10], true);
echo "\n";
echo var_export((new Solution())->sortedSquares($A), true);
echo "\n";
