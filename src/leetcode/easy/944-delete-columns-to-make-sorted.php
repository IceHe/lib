<?php

// https://leetcode.com/problems/delete-columns-to-make-sorted/

class Solution {

    /**
     * @param String[] $A
     * @return Integer
     */
    function minDeletionSize($A) {
        $cnt = 0;
        $len = strlen($A[0] ?? '');
        for ($col = 0; $col < $len; $col++) {
            $char = '';
            foreach ($A as $str) {
//                if ($str[$col] > ) {
                    continue;
//                }
            }
            $cnt++;
        }
        return $cnt;
    }
}

$solution = new Solution();

$A = ["cba","daf","ghi"];

echo var_export($A, true)."\n";
echo $solution->minDeletionSize($A)."\n";
