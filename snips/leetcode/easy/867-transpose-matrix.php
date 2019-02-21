<?php

// https://leetcode.com/problems/transpose-matrix/

//Runtime: 32 ms, faster than 100.00% of PHP online submissions for Transpose Matrix.
//Memory Usage: 16.3 MB, less than 100.00% of PHP online submissions for Transpose Matrix.

//class Solution {
//
//    /**
//     * @param Integer[][] $A
//     * @return Integer[][]
//     */
//    function transpose($A) {
//        $result = [];
//        foreach ($A as $x => $xAry) {
//            foreach ($xAry as $y => $v) {
//                if ($x === $y) {
//                    $result[$x][$y] = $v;
//                } else {
//                    $result[$y][$x] = $v;
//                }
//            }
//        }
//        return $result;
//    }
//}

// 上面的思路秀逗了，这里是简化更正
//Runtime: 56 ms, faster than 100.00% of PHP online submissions for Transpose Matrix.
//Memory Usage: 16.3 MB, less than 100.00% of PHP online submissions for Transpose Matrix.

class Solution {

    /**
     * @param Integer[][] $A
     * @return Integer[][]
     */
    function transpose($A) {
        $matrix = [];
        foreach ($A as $x => $xAry) {
            foreach ($xAry as $y => $v) {
                $matrix[$y][$x] = $v;
            }
        }
        return $matrix;
    }
}
