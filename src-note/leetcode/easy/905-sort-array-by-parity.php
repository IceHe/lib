<?php

// https://leetcode.com/problems/sort-array-by-parity/

// Runtime: 32 ms, faster than 94.74% of PHP online submissions for Sort Array By Parity.

class Solution {
    function swap(&$ary, $i, $j) {
        $tmp = $ary[$i];
        $ary[$i] = $ary[$j];
        $ary[$j] = $tmp;
    }
    function sortArrayByParity($A) {
        $len = count($A);
        for ($i = 0, $j = 0; $j < $len; ++$j) {
            if ($A[$j] % 2 == 0) {
                $this->swap($A, $i++, $j);
            }
        }
        return $A;
    }
}

// Runtime: 32 ms, faster than 94.74% of PHP online submissions for Sort Array By Parity.

//class Solution {
//    function swap(&$ary, $i, $j) {
//        $tmp = $ary[$i];
//        $ary[$i] = $ary[$j];
//        $ary[$j] = $tmp;
//    }
//    function sortArrayByParity($A) {
//        $len = count($A);
//        $lf = -1;
//        $rg = $len;
//        while ($lf < $rg) {
//            while ($lf < $len - 1 && ($A[++$lf] % 2 == 0));
//            while ($rg > 0 && ($A[--$rg] % 2 == 1));
//            $this->swap($A, $lf, $rg);
//        }
//        $this->swap($A, $lf, $rg);
//        return $A;
//    }
//}

//$A = [3,1,2,4];
$A = [3,1,5,2,4];
echo var_export((new Solution)->sortArrayByParity($A), true);