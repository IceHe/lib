<?php

// https://leetcode.com/problems/keyboard-row/

//有 bug 忘记了大写字母……
//Runtime: 4 ms, faster than 100.00% of PHP online submissions for Keyboard Row.
//Memory Usage: 16.4 MB, less than 100.00% of PHP online submissions for Keyboard Row.

//class Solution {
//    private static $kbRow = [
//        'qwertyuiop',
//        'asdfghjkl',
//        'zxcvbnm',
//    ];
//
//    /**
//     * @param String[] $words
//     * @return String[]
//     */
//    function findWords($words) {
//        $result = [];
//        foreach ($words as $word) {
//            if ($this->isInOneRow($word)) {
//                $result[] = $word;
//            }
//        }
//        return $result;
//    }
//
//    private function isInOneRow(string $word): bool {
//        $prevRow = null;
//        $len = strlen($word);
//        for ($i = 0; $i < $len; $i++) {
//            foreach (self::$kbRow as $row => $rowKeys) {
//                if (strpos($rowKeys, $word{$i}) !== false) {
//                    if (!isset($prevRow)) {
//                        $prevRow = $row;
//                    } else if ($prevRow != $row) {
//                        return false;
//                    }
//                }
//            }
//        }
//        return true;
//    }
//}

//顺风的写法，我也自己重写了一下
//Runtime: 8 ms, faster than 100.00% of PHP online submissions for Keyboard Row.
//Memory Usage: 16.5 MB, less than 100.00% of PHP online submissions for Keyboard Row.

class Solution {
    /**
     * @param String[] $words
     * @return String[]
     */
    function findWords($words) {
        $result = [];
        foreach ($words as $word) {
            if ($this->isInOneRow($word)) {
                $result[] = $word;
            }
        }
        return $result;
    }

    private function isInOneRow(string $word): bool {
        $len = strlen($word);
        for ($i = 1; $i < $len; $i++) {
            if ($this->computeRowNum($word{0}) !== $this->computeRowNum($word{$i})) {
                return false;
            }
        }
        return true;
    }

    private function computeRowNum(string $char): int {
        $char = strtolower($char); // 遗漏的边界情况……
        if (strpos('qwertyuiop', $char) !== false) {
            return 1;
        } else if (strpos('asdfghjkl', $char) !== false) {
            return 2;
        } else if (strpos('zxcvbnm', $char) !== false) {
            return 3;
        } else {
            return 4; // meaningless
        }
    }
}

$solution = new Solution();

$words = ["Hello", "Alaska", "Dad", "Peace"];
//$words = ["qz","wq","asdddafadsfa","adfadfadfdassfawde"];
echo var_export($solution->findWords($words), true)."\n";
