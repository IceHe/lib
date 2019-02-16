<?php

// https://leetcode.com/problems/sum-of-even-numbers-after-queries/

// Time Limit Exceeded

//class Solution {
//    /**
//     * @param Integer[] $A
//     * @param Integer[][] $queries
//     * @return Integer[]
//     */
//    function sumEvenAfterQueries($A, $queries) {
//        $result = [];
//        foreach ($queries as $query) {
//            $A[$query[1]] += $query[0];
//
//            $evenNumSum = 0;
//            foreach ($A as $val) {
//                if ($val % 2 === 0) {
//                    $evenNumSum += $val;
//                }
//            }
//            $result[] = $evenNumSum;
//        }
//
//        return $result;
//    }
//}

//Runtime: 300 ms, faster than 23.53% of PHP online submissions for Sum of Even Numbers After Queries.
//Memory Usage: 28.9 MB, less than 100.00% of PHP online submissions for Sum of Even Numbers After Queries.

//class Solution {
//    /**
//     * @param Integer[] $A
//     * @param Integer[][] $queries
//     * @return Integer[]
//     */
//    function sumEvenAfterQueries($A, $queries) {
//        $sum = 0;
//        foreach ($A as $val) {
//            if ($val % 2 === 0) {
//                $sum += $val;
//            }
//        }
//
//        $result = [];
//        foreach ($queries as $query) {
//            $delta = $query[0];
//
//            $ori = $A[$query[1]];
//            $cur = $ori + $delta;
//
//            $isOriEven = ($ori % 2 == 0);
//            $isCurEven = ($cur % 2 == 0);
//
//            if ($isOriEven && $isCurEven) {
//                $sum += $delta;
//            } else if ($isOriEven && !$isCurEven) {
//                $sum -= $ori;
//            } else if (!$isOriEven && $isCurEven) {
//                $sum += $cur;
//            } // else if (!$isOriEven && !$isCurEven) { do nothing }
//
//            $A[$query[1]] = $cur;
//
//            $result[] = $sum;
//        }
//
//        return $result;
//    }
//}

//Runtime: 244 ms, faster than 70.59% of PHP online submissions for Sum of Even Numbers After Queries.
//Memory Usage: 28.9 MB, less than 100.00% of PHP online submissions for Sum of Even Numbers After Queries.

class Solution {
    /**
     * @param Integer[] $A
     * @param Integer[][] $queries
     * @return Integer[]
     */
    function sumEvenAfterQueries($A, $queries) {
        $sum = 0;
        foreach ($A as $val) {
            if ($val % 2 === 0) {
                $sum += $val;
            }
        }

        $result = [];
        foreach ($queries as $query) {
            $index = $query[1];
            $delta = $query[0];

            $ori = $A[$index];
            $cur = $ori + $delta;

            $A[$index] = $cur;

            if ($ori % 2 == 0) {
                $sum -= $ori;
            }
            if ($cur % 2 == 0) {
                $sum += $cur;
            }

            $result[] = $sum;
        }

        return $result;
    }
}

$A = [1,2,3,4];
$queries = [[1,0],[-3,1],[-4,0],[2,3]];

$solution = new Solution();
echo var_export($solution->sumEvenAfterQueries($A, $queries), true)."\n";
