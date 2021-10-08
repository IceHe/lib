<?php

// https://leetcode.com/problems/number-of-lines-to-write-string/

//Runtime: 8 ms, faster than 100.00% of PHP online submissions for Number of Lines To Write String.
//Memory Usage: 14.9 MB, less than 100.00% of PHP online submissions for Number of Lines To Write String.

//class Solution {
//    const MAX_LINE_WIDTH = 100;
//
//    /**
//     * @param Integer[] $widths
//     * @param String $S
//     * @return Integer[]
//     */
//    function numberOfLines($widths, $S) {
//        if (empty($S)) {
//            return [0, 0];
//        }
//        // 如果 widths 中，有值超过 100，就是异常了，注意处理
//
//        $lineCount = 1;
//        $lineWidth = 0;
//
//        $strLen = strlen($S);
//        for ($i = 0; $i < $strLen; $i++) {
//            $charIndex = ord($S{$i}) - ord('a');
////            $charIndex = (int) ($S{$i} - 'a'); // 错误示范……
//            $charWidth = $widths[$charIndex];
//            if ($lineWidth + $charWidth <= self::MAX_LINE_WIDTH) {
//                $lineWidth += $charWidth;
//            } else {
//                $lineCount++;
//                $lineWidth = $charWidth;
//            }
//        }
//
//        return [$lineCount, $lineWidth];
//    }
//}

class Solution {
    const MAX_LINE_WIDTH = 100;
    const A_ASCII_CODE = 97; // ord('a');

    /**
     * @param Integer[] $widths
     * @param String $S
     * @return Integer[]
     */
    function numberOfLines($widths, $S) {
        if (empty($S)) {
            return [0, 0];
        }
        // 如果 widths 中，有值超过 100，就是异常了，注意处理

        $lineCount = 1;
        $lineWidth = 0;

        $strLen = strlen($S);
        for ($i = 0; $i < $strLen; $i++) {
            $charWidth = $widths[ord($S{$i}) - self::A_ASCII_CODE];

            // 曾经觉得这种写法比较好，后来觉得上面的 if else 写法更清晰
            $exceedLimit = ($lineWidth + $charWidth > self::MAX_LINE_WIDTH);
            $lineWidth = $exceedLimit ? $charWidth : $charWidth + $lineWidth;
            $lineCount = $exceedLimit ? $lineCount + 1 : $lineCount;
        }

        return [$lineCount, $lineWidth];
    }
}

$widths = [10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10,10];
$S = "abcdefghijklmnopqrstuvwxyz";

$solution = new Solution();
echo var_export($solution->numberOfLines($widths, $S))."\n";
