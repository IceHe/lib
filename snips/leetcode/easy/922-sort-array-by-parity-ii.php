<?php

// https://leetcode.com/problems/sort-array-by-parity-ii/

//Runtime: 84 ms, faster than 100.00% of PHP online submissions for Sort Array By Parity II.
//Memory Usage: 18.4 MB, less than 100.00% of PHP online submissions for Sort Array By Parity II.

//class Solution {
//
//    /**
//     * @param Integer[] $A
//     * @return Integer[]
//     */
//    function sortArrayByParityII($A) {
//        $len = count($A);
//        // ignored
////        if ($len <= 1) {
////            return;
////        }
//
//        $evenIndex = 0;
//        $oddIndex = 1;
//        while ($evenIndex < $len && $oddIndex < $len) {
//            while ($evenIndex < $len && $A[$evenIndex] % 2 === 0) {
//                $evenIndex += 2;
//            }
//
//            while ($oddIndex < $len && $A[$oddIndex] % 2 === 1) {
//                $oddIndex += 2;
//            }
//
//            if ($evenIndex < $len && $oddIndex < $len) {
//                $this->swap($A, $evenIndex, $oddIndex);
//            }
//        }
//
//        return $A;
//    }
//
//    function swap(array &$ary, $a, $b): void {
//        $tmp = $ary[$a];
//        $ary[$a] = $ary[$b];
//        $ary[$b] = $tmp;
//    }
//}

//Runtime: 84 ms, faster than 100.00% of PHP online submissions for Sort Array By Parity II.
//Memory Usage: 18.1 MB, less than 100.00% of PHP online submissions for Sort Array By Parity II.

//class Solution {
//
//    /**
//     * @param Integer[] $A
//     * @return Integer[]
//     */
//    function sortArrayByParityII($A) {
//        $len = count($A);
//
//        $evenIndex = 0;
//        $oddIndex = 1;
//        while (1) {
//            while ($evenIndex < $len && $A[$evenIndex] % 2 === 0) {
//                $evenIndex += 2;
//            }
//
//            while ($oddIndex < $len && $A[$oddIndex] % 2 === 1) {
//                $oddIndex += 2;
//            }
//
//            if ($evenIndex < $len && $oddIndex < $len) {
//                $this->swap($A, $evenIndex, $oddIndex);
//            } else {
//                break;
//            }
//        }
//
//        return $A;
//    }
//
//    function swap(array &$ary, $a, $b): void {
//        $tmp = $ary[$a];
//        $ary[$a] = $ary[$b];
//        $ary[$b] = $tmp;
//    }
//}

//Runtime: 84 ms, faster than 100.00% of PHP online submissions for Sort Array By Parity II.
//Memory Usage: 18 MB, less than 100.00% of PHP online submissions for Sort Array By Parity II.

//class Solution {
//
//    /**
//     * @param Integer[] $A
//     * @return Integer[]
//     */
//    function sortArrayByParityII($A) {
//        $len = count($A);
//
//        $evenIndex = 0;
//        $oddIndex = 1;
//
//        while ($evenIndex < $len && $oddIndex < $len) {
//            if ($A[$evenIndex] % 2 === 0) {
//                $evenIndex += 2;
//                continue;
//            }
//
//            while ($oddIndex < $len) {
//                if ($A[$oddIndex] % 2 === 1) {
//                    $oddIndex += 2;
//                    continue;
//                }
//
//                $this->swap($A, $evenIndex, $oddIndex);
//                break;
//            }
//
//            $evenIndex += 2;
//        }
//
//        return $A;
//    }
//
//    function swap(array &$ary, $a, $b): void {
//        $tmp = $ary[$a];
//        $ary[$a] = $ary[$b];
//        $ary[$b] = $tmp;
//    }
//}

//Runtime: 92 ms, faster than 100.00% of PHP online submissions for Sort Array By Parity II.
//Memory Usage: 18.1 MB, less than 100.00% of PHP online submissions for Sort Array By Parity II.

class Solution {

    /**
     * @param Integer[] $A
     * @return Integer[]
     */
    function sortArrayByParityII($A) {
        $len = count($A);

        for ($i = 0, $j = 1;
             $i < $len && $j < $len;
             $i += 2, $j += 2
        ) {
            while ($i < $len && $A[$i] % 2 === 0) {
                $i += 2;
            }

            while ($j < $len && $A[$j] % 2 === 1) {
                $j += 2;
            }

            if ($i < $len && $j < $len) {
                $this->swap($A, $i, $j);
            }
        }

        return $A;
    }

    function swap(array &$ary, $a, $b): void {
        $tmp = $ary[$a];
        $ary[$a] = $ary[$b];
        $ary[$b] = $tmp;
    }
}

$A = [4,2,5,7];

$solution = new Solution();
echo var_export($solution->sortArrayByParityII($A), true)."\n";
