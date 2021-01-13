<?php

// https://leetcode.com/problems/k-closest-points-to-origin

//Runtime: 6456 ms, faster than 100.00% of PHP online submissions for K Closest Points to Origin.
//Memory Usage: 28.4 MB, less than 100.00% of PHP online submissions for K Closest Points to Origin.

//class Solution {
//
//    /**
//     * @param Integer[][] $points
//     * @param Integer $K
//     * @return Integer[][]
//     */
//    function kClosest($points, $K) {
//        $distances = [];
//        foreach ($points as $i => $point) {
//            $distances[$i] = $point[0] * $point[0] + $point[1] * $point[1];
//        }
//
//        $result = [];
//        $len = count($distances);
//        for ($i = 0; $i < $K; $i++) {
//            $minIdx = $i;
//            for ($j = $i + 1; $j < $len; $j++) {
//                if ($distances[$j] < $distances[$minIdx]) {
//                    $minIdx = $j;
//                }
//            }
//
//            $result[] = $points[$minIdx];
//
//            if ($minIdx != $i) {
//                $this->swap($distances, $i, $minIdx);
//                $this->swap($points, $i, $minIdx);
//            }
//        }
//
//        return $result;
//    }
//
//    private function swap(array &$ary, $a, $b) {
//        $tmp = $ary[$a];
//        $ary[$a] = $ary[$b];
//        $ary[$b] = $tmp;
//    }
//}

// 为啥能快这么多…… 尴尬了。
//Runtime: 472 ms, faster than 100.00% of PHP online submissions for K Closest Points to Origin.
//Memory Usage: 28.6 MB, less than 100.00% of PHP online submissions for K Closest Points to Origin.

class Solution {

    /**
     * @param Integer[][] $points
     * @param Integer $K
     * @return Integer[][]
     */
    function kClosest($points, $K) {
        usort($points, function ($a, $b) {
            $aLen = $a[0] * $a[0] + $a[1] * $a[1];
            $bLen = $b[0] * $b[0] + $b[1] * $b[1];
            return $aLen <=> $bLen;
        });
        return array_slice($points, 0, $K);
    }

}

$solution = new Solution();

$points = [[1,3],[-2,2]];
$K = 1;
echo var_export($solution->kClosest($points, $K))."\n";

$points = [[3,3],[5,-1],[-2,4]];
$K = 2;
echo var_export($solution->kClosest($points, $K))."\n";
