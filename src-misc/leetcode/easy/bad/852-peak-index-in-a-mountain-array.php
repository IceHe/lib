<?php

// https://leetcode.com/problems/peak-index-in-a-mountain-array/

//Runtime: 32 ms, faster than 100.00% of PHP online submissions for Peak Index in a Mountain Array.
//Memory Usage: 16 MB, less than 100.00% of PHP online submissions for Peak Index in a Mountain Array.

class Solution {
    /**
     * @param Integer[] $A
     * @return Integer
     */
    function peakIndexInMountainArray($A) {
        $len = count($A);

        for ($i = 0; $i < $len - 1; $i++) {
            if ($A[$i] > $A[$i + 1]) {
                return $i;
            }
        }

        return $len - 1;
    }
}
