<?php

// https://leetcode.com/problems/hamming-distance/

//Runtime: 12 ms, faster than 60.00% of PHP online submissions for Hamming Distance.
//Memory Usage: 4.8 MB, less than 100.00% of PHP online submissions for Hamming Distance.

//class Solution {
//
//    /**
//     * @param Integer $x
//     * @param Integer $y
//     * @return Integer
//     */
//    function hammingDistance($x, $y) {
//        $diff = $x ^ $y;
//        $cnt = 0;
//        $bit = 1;
//        while ($diff > 0) {
//            if ($diff & $bit) {
//                $cnt++;
//            }
//            $diff &= ~$bit;
//            $bit <<= 1;
//        }
//        return $cnt;
//    }
//}

//（看情况 LeetCode 使用低峰时，可以刷出比较快的运行速度……）
//Runtime: 8 ms, faster than 100.00% of PHP online submissions for Hamming Distance.
//Memory Usage: 4.8 MB, less than 100.00% of PHP online submissions for Hamming Distance.

//class Solution {
//
//    /**
//     * @param Integer $x
//     * @param Integer $y
//     * @return Integer
//     */
//    function hammingDistance($x, $y) {
//        $diff = $x ^ $y;
//        $cnt = 0;
//        $bit = 1;
//        while ($diff > 0) {
//            if ($diff & $bit) {
//                $cnt++;
//            }
//            $diff &= ~$bit;
//            $bit *= 2;
//        }
//        return $cnt;
//    }
//}

// 这不是最优雅的标准答案，怎么更慢了……（好像只是 LeetCode 有时运行会比较慢）
//Runtime: 12 ms, faster than 60.00% of PHP online submissions for Hamming Distance.
//Memory Usage: 4.8 MB, less than 100.00% of PHP online submissions for Hamming Distance.

class Solution {

    /**
     * @param Integer $x
     * @param Integer $y
     * @return Integer
     */
    function hammingDistance($x, $y) {
        $diff = $x ^ $y;
        $cnt = 0;
        while ($diff > 0) {
            $diff &= $diff - 1;
            $cnt++;
        }
        return $cnt;
    }
}

$solution = new Solution();

$x = 0b01011;
$y = 0b00101;

echo $x."\n";
echo $y."\n";
echo $solution->hammingDistance($x, $y)."\n";
