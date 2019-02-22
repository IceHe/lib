<?php

// https://leetcode.com/problems/shortest-distance-to-a-character/

//Runtime: 28 ms, faster than 100.00% of PHP online submissions for Shortest Distance to a Character.
//Memory Usage: 14.9 MB, less than 100.00% of PHP online submissions for Shortest Distance to a Character.

//class Solution {
//
//    /**
//     * @param String $S
//     * @param String $C
//     * @return Integer[]
//     */
//    function shortestToChar($S, $C) {
//        $cIndexAry = [];
//        $sLen = strlen($S);
//        for ($i = 0; $i < $sLen; $i++) {
//            if ($S{$i} === $C) {
//                $cIndexAry[] = $i;
//            }
//        }
//
//        $distances = [];
//        for ($i = 0; $i < $sLen; $i++) {
//            $minDistance = $sLen; // MAX
//            foreach ($cIndexAry as $cIndex) {
//                $minDistance = min($minDistance, abs($cIndex - $i));
//            }
//            $distances[] = $minDistance;
//        }
//
//        return $distances;
//    }
//}

//Runtime: 20 ms, faster than 100.00% of PHP online submissions for Shortest Distance to a Character.
//Memory Usage: 14.8 MB, less than 100.00% of PHP online submissions for Shortest Distance to a Character.

class Solution {

    /**
     * @param String $S
     * @param String $C
     * @return Integer[]
     */
    function shortestToChar($S, $C) {
        $cIndexAry = [];
        $sLen = strlen($S);
        for ($i = 0; $i < $sLen; $i++) {
             if ($S{$i} === $C) {
                 $cIndexAry[] = $i;
             }
        }

        $distances = [];
        for ($i = 0; $i < $sLen; $i++) {
            $minDistance = $sLen; // MAX
            foreach ($cIndexAry as $cIndex) {
                $delta = $i - $cIndex;
                $isRight = $delta > 0; // 游标在左边
                $dist = abs($delta);

                if ($dist === 0) {
                    $minDistance = 0;
                    break;
                } else if ($isRight) {
                    $minDistance = $dist;
                } else {
                    $minDistance = min($minDistance, $dist);
                    break;
                }
            }
            $distances[] = $minDistance;
        }

        return $distances;
    }
}

$S = "loveleetcode";
$C = "e";

$solution = new Solution();
echo var_export($solution->shortestToChar($S, $C), true)."\n";
