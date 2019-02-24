<?php

// https://leetcode.com/problems/keyboard-row/

//Runtime: 4 ms, faster than 100.00% of PHP online submissions for Keyboard Row.
//Memory Usage: 16.4 MB, less than 100.00% of PHP online submissions for Keyboard Row.

class Solution {
    private static $kbRow = [
        'qwertyuiop',
        'asdfghjkl',
        'zxcvbnm',
    ];

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
        $prevRow = null;
        $len = strlen($word);
        for ($i = 0; $i < $len; $i++) {
            foreach (self::$kbRow as $row => $rowKeys) {
                if (strpos($rowKeys, $word{$i}) !== false) {
                    if (!isset($prevRow)) {
                        $prevRow = $row;
                    } else if ($prevRow != $row) {
                        return false;
                    }
                }
            }
        }
        return true;
    }
}

$solution = new Solution();

//$words = ["Hello", "Alaska", "Dad", "Peace"];
$words = ["qz","wq","asdddafadsfa","adfadfadfdassfawde"];
echo var_export($solution->findWords($words), true)."\n";
