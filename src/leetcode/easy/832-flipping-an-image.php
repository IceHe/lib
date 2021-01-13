<?php

// https://leetcode.com/problems/flipping-an-image/

// Runtime: 20 ms, faster than 58.33% of PHP online submissions for Flipping an Image.
// 教训：对于一些语言，没事别自己翻转数组，老实用库函数就好……

//class Solution {
//    function swap(&$ary, $i, $j) {
//        $tmp = $ary[$i];
//        $ary[$i] = $ary[$j];
//        $ary[$j] = $tmp;
//    }
//
//    /**
//     * @param Integer[][] $A
//     * @return Integer[][]
//     */
//    function flipAndInvertImage(&$A) {
//        foreach ($A as &$ary) {
//            $len = count($ary);
//            $privot = floor($len / 2);
//            for ($i = 0; $i < $privot; $i++) {
//                $k = $len - 1 - $i;
//                $this->swap($ary, $i, $k);
//                $ary[$i] = $ary[$i] == 0 ? 1 : 0;
//                $ary[$k] = $ary[$k] == 0 ? 1 : 0;
//            }
//
//            if ($len % 2 == 1) {
//                $ary[$privot] = $ary[$privot] == 0 ? 1 : 0;
//            }
//        }
//        return $A;
//    }
//}

// Runtime: 16 ms, faster than 100.00% of PHP online submissions for Flipping an Image.

class Solution {
    /**
     * @param Integer[][] $A
     * @return Integer[][]
     */
    function flipAndInvertImage(&$A) {
        foreach ($A as &$ary) {
            $ary = array_reverse($ary);
            $len = count($ary);
            for ($i = 0; $i < $len; ++$i) {
                $ary[$i] = $ary[$i] == 0 ? 1 : 0;
            }
        }
        return $A;
    }
}

$solution = new Solution();

$A1 = [[1,1,0],[1,0,1],[0,0,0]];
echo var_export($solution->flipAndInvertImage($A1), true)."\n";

//$A2 = [[1,1,0,0],[1,0,0,1],[0,1,1,1],[1,0,1,0]];
//echo var_export($solution->flipAndInvertImage($A2), true)."\n";
