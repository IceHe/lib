<?php

// https://leetcode.com/problems/reverse-string/

class Solution {

    /**
     * @param String[] $s
     * @return NULL
     */
    function reverseString(&$s) {
        $len = count($s);
        for ($i = 0; $i <= $len / 2; $i++) {
            $this->swapChar($s, $i, $len - 1 - $i);
        }
    }

    private function swapChar(array &$str, $a, $b): void {
        $tmp = $str[$a];
        $str[$a] = $str[$b];
        $str[$b] = $tmp;
    }
}

$s = ["h","e","l","l","o"];

$solution = new Solution();
$solution->reverseString($s);
echo var_export($s, true)."\n";
