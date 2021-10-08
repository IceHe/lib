<?php

// https://leetcode.com/problems/reverse-string/

//Runtime: 76 ms, faster than 100.00% of PHP online submissions for Reverse String.
//Memory Usage: 38.9 MB, less than 16.67% of PHP online submissions for Reverse String.

class Solution {

    /**
     * @param String[] $s
     * @return NULL
     */
    function reverseString(&$s) {
        // bug 记录 —— 原因：边界问题！
//        for ($i = 0; $i <= count($s) / 2; $i++) {
//        for ($i = 0; $i < count($s) / 2; $i++) {
        for ($i = 0; $i < (int)(count($s) / 2); $i++) {
            $this->swapChar($s, $i, count($s) - 1 - $i);
        }
    }

    private function swapChar(array &$str, $a, $b): void {
        $str[$a] = $str[$a] ^ $str[$b];
        $str[$b] = $str[$a] ^ $str[$b];
        $str[$a] = $str[$a] ^ $str[$b];
    }
}

$s = ["h","e","l","l","o"];

$solution = new Solution();
$solution->reverseString($s);
echo var_export($s, true)."\n";
