<?php

// https://leetcode.com/problems/toeplitz-matrix/

//思路比较烂，代码不优雅…… 关键要找到规律！
//Runtime: 44 ms, faster than 100.00% of PHP online submissions for Toeplitz Matrix.
//Memory Usage: 16.5 MB, less than 100.00% of PHP online submissions for Toeplitz Matrix.

//class Solution {
//
//    /**
//     * @param Integer[][] $matrix
//     * @return Boolean
//     */
//    function isToeplitzMatrix($matrix) {
//        if (empty($matrix)) {
//            return false;
//        }
//
//        $m = count($matrix);
//        $n = count($matrix[0] ?? []);
//
//        for ($y = $n - 1; $y >= 1; $y--) {
//            if (!$this->isDiagonalSame($matrix, 0, $y, $m, $n)) {
//                return false;
//            }
//        }
//
//        for ($x = 0; $x < $m; $x++) {
//            if (!$this->isDiagonalSame($matrix, $x, 0, $m, $n)) {
//                return false;
//            }
//        }
//
//        return true;
//    }
//
//    private function isDiagonalSame($matrix, $x, $y, $m, $n): bool {
//        $i = $x;
//        $j = $y;
//
//        while ($i + 1 < $m && $j + 1 < $n) {
//            if ($matrix[$i][$j] != $matrix[$i + 1][$j + 1]) {
//                return false;
//            }
//            $i++;
//            $j++;
//        }
//
//        return true;
//    }
//}

//参考答案一：需要借助暂存 map，注意对角线的数字规律……
//Runtime: 32 ms, faster than 100.00% of PHP online submissions for Toeplitz Matrix.
//Memory Usage: 14.9 MB, less than 100.00% of PHP online submissions for Toeplitz Matrix.

//class Solution {
//
//    /**
//     * @param Integer[][] $matrix
//     * @return Boolean
//     */
//    function isToeplitzMatrix($matrix) {
//        $m = count($matrix);
//        $n = count($matrix[0] ?? []);
//
//        $map = [];
//        for ($r = 0; $r < $m; $r++) {
//            for ($c = 0; $c < $n; $c++) {
//                if (!array_key_exists($r - $c, $map)) {
//                    $map[$r - $c] = $matrix[$r][$c];
//                } else if ($map[$r - $c] !== $matrix[$r][$c]) {
//                    return false;
//                }
//            }
//        }
//
//        return true;
//    }
//}

// 参考答案二：内存使用更少
//Runtime: 32 ms, faster than 100.00% of PHP online submissions for Toeplitz Matrix.
//Memory Usage: 16.4 MB, less than 100.00% of PHP online submissions for Toeplitz Matrix.

class Solution {

    /**
     * @param Integer[][] $matrix
     * @return Boolean
     */
    function isToeplitzMatrix($matrix) {
        $m = count($matrix);
        $n = count($matrix[0] ?? []);

        for ($r = 0; $r < $m; $r++) {
            for ($c = 0; $c < $n; $c++) {
                if ($r + 1 < $m && $c + 1 < $n
                    && ($matrix[$r][$c] !== $matrix[$r + 1][$c + 1])
                ) {
                    return false;
                }
            }
        }

        return true;
    }
}

$solution = new Solution();

$matrix = [
    [1,2,3,4],
    [5,1,2,3],
    [9,5,1,2]
];

echo ($solution->isToeplitzMatrix($matrix) ? '1' : '0')."\n";
