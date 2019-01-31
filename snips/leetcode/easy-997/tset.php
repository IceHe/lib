<?php

// https://leetcode.com/problems/squares-of-a-sorted-array/

class Solution {
    function sortedSquares($A) {
        foreach ($A as $k => $v) {
            if ($v < 0) {
                $A[$k] = -$v;
            }
            $A[$k] *= $A[$k];
        }
        sort($A);
        return $A;
    }
}

echo var_export($A = [-4,-1,0,3,10], true);
echo "\n";
echo var_export((new Solution())->sortedSquares($A), true);
echo "\n";
