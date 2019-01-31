<?php

// https://leetcode.com/problems/squares-of-a-sorted-array/

class Solution {
    function sortedSquares($A) {
        $lf = 0;
        $rg = count($A) - 1;

        $result = [];
        while ($lf <= $rg) {
            $lfVal = $A[$lf] * $A[$lf];
            $rgVal = $A[$rg] * $A[$rg];
            if ($lfVal > $rgVal) {
                array_push($result, $lfVal);
                $lf++;
            } else {
                array_push($result, $rgVal);
                $rg--;
            }
        }

        return array_reverse($result);
    }
}


echo var_export($A = [-4,-1,0,3,10], true);
echo "\n";
echo var_export((new Solution())->sortedSquares($A), true);
echo "\n";
