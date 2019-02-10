<?php

// https://leetcode.com/problems/di-string-match/

//Runtime: 2852 ms, faster than 0.00% of PHP online submissions for DI String Match.
//Memory Usage: 6.8 MB, less than 100.00% of PHP online submissions for DI String Match.

//class Solution {
//    /**
//     * @param String $S
//     * @return Integer[]
//     */
//    function diStringMatch($S): ?array {
//        $len = strlen($S);
//        $ary = [0];
//        for ($i = 0; $i < $len; ++$i) {
//            if ($S[$i] == 'I') {
//                $ary[$i + 1] = $i + 1;
//            } else if ($S[$i] == 'D') {
//                foreach ($ary as $k => $v) {
//                    $ary[$k]++;
//                }
//                $ary[$i + 1] = 0;
//            } else {
//                return null;
//            }
//        }
//
//        return $ary;
//    }
//}

//Runtime: 28 ms, faster than 42.86% of PHP online submissions for DI String Match.
//Memory Usage: 6.2 MB, less than 100.00% of PHP online submissions for DI String Match.

//class Solution {
//    /**
//     * @param String $S
//     * @return Integer[]
//     */
//    function diStringMatch($S): ?array {
//        $len = strlen($S);
//        $dCnt = 0;
//        for ($i = 0; $i < $len; ++$i) {
//            if ($S[$i] == 'I') {
//            } else if ($S[$i] == 'D') {
//                $dCnt++;
//            } else {
//                return null;
//            }
//        }
////        $dCnt = substr_count($S, 'D'); // a little slower
//
//        $ary = [$dCnt];
//        $iNumMin = $dCnt + 1;
//        $dNumMax = $dCnt - 1;
//        for ($i = 0; $i < $len; ++$i) {
//            if ($S[$i] == 'I') {
//                $ary[$i + 1] = $iNumMin++;
//            } else if ($S[$i] == 'D') {
//                $ary[$i + 1] = $dNumMax--;
//            }
//        }
//
//        return $ary;
//    }
//}

// Standard Answer ……
//Runtime: 20 ms, faster than 100.00% of PHP online submissions for DI String Match.
//Memory Usage: 6.3 MB, less than 100.00% of PHP online submissions for DI String Match.

class Solution {
    /**
     * @param String $S
     * @return Integer[]
     */
    function diStringMatch($S): ?array {
        $len = strlen($S);
        $max = $len;
        $min = 0;

        $ary = [];
        for ($i = 0; $i < $len; ++$i) {
            if ($S[$i] == 'I') {
                $ary[$i + 1] = $min++;
            } else {
                $ary[$i + 1] = $max--;
            }
        }

        $ary[] = $min;

        return $ary;
    }
}

$solution = new Solution();

$S = 'IDID';
echo var_export($S, true)."\n";
echo var_export($solution->diStringMatch($S), true)."\n";
