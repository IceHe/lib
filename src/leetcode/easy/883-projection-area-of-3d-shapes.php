<?php

// https://leetcode.com/problems/projection-area-of-3d-shapes/

//没审清题意这是个 N*N 的矩阵，还有更简洁的解法……
//Runtime: 28 ms, faster than 100.00% of PHP online submissions for Projection Area of 3D Shapes.
//Memory Usage: 15 MB, less than 100.00% of PHP online submissions for Projection Area of 3D Shapes.

//class Solution {
//
//    /**
//     * @param Integer[][] $grid
//     * @return Integer
//     */
//    function projectionArea($grid) {
//        $xy = 0;
//        $xzMaxAry = [];
//        $yzMaxAry = [];
//
//        foreach ($grid as $x => $ary) {
//            foreach ($ary as $y => $h) {
//                if ($h > 0) {
//                    $xy++;
//                }
//                if ($h > ($xzMaxAry[$x] ?? 0)) {
//                    $xzMaxAry[$x] = $h;
//                }
//                if ($h > ($yzMaxAry[$y] ?? 0)) {
//                    $yzMaxAry[$y] = $h;
//                }
//            }
//        }
//
//        $xz = 0;
//        foreach ($xzMaxAry as $h) {
//            $xz += $h;
//        }
//
//        $yz = 0;
//        foreach ($yzMaxAry as $h) {
//            $yz += $h;
//        }
//
//        return $xy + $xz + $yz;
//    }
//}

//代码更简洁了，效率基本差不多
//Runtime: 28 ms, faster than 100.00% of PHP online submissions for Projection Area of 3D Shapes.
//Memory Usage: 15.2 MB, less than 100.00% of PHP online submissions for Projection Area of 3D Shapes.

//class Solution {
//
//    /**
//     * @param Integer[][] $grid
//     * @return Integer
//     */
//    function projectionArea($grid) {
//        $ans = 0;
//        $len = count($grid);
//
//        for ($x = 0; $x < $len; $x++) {
//            $highestXZ = 0;
//            $highestYZ = 0;
//            for ($y = 0; $y < $len; $y++) {
//                if ($grid[$x][$y] > 0) {
//                    $ans++;
//                }
//                if ($highestXZ < $grid[$x][$y]) {
//                    $highestXZ = $grid[$x][$y];
//                }
//                if ($highestYZ < $grid[$y][$x]) {
//                    $highestYZ = $grid[$y][$x];
//                }
//            }
//            $ans += $highestYZ;
//            $ans += $highestXZ;
//        }
//
//        return $ans;
//    }
//}

//代码差不多，又简洁了些（感觉一定要写，还有函数调用开销，没那么好……）
//Runtime: 28 ms, faster than 100.00% of PHP online submissions for Projection Area of 3D Shapes.
//Memory Usage: 15.3 MB, less than 100.00% of PHP online submissions for Projection Area of 3D Shapes.

class Solution {

    /**
     * @param Integer[][] $grid
     * @return Integer
     */
    function projectionArea($grid) {
        $ans = 0;
        $len = count($grid);

        for ($x = 0; $x < $len; $x++) {
            $highestXZ = 0;
            $highestYZ = 0;
            for ($y = 0; $y < $len; $y++) {
                if ($grid[$x][$y] > 0) {
                    $ans++;
                }
                $highestXZ = max($highestXZ, $grid[$x][$y]);
                $highestYZ = max($highestYZ, $grid[$y][$x]);
            }
            $ans += $highestYZ;
            $ans += $highestXZ;
        }

        return $ans;
    }
}

$grid = [[1,2],[3,4]];
$solution = new Solution();
echo $solution->projectionArea($grid)."\n";
