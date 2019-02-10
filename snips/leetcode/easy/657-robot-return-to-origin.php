<?php

// https://leetcode.com/problems/robot-return-to-origin/

// Runtime: 24 ms, faster than 83.33% of PHP online submissions for Robot Return to Origin.
// Memory Usage: 4.9 MB, less than 100.00% of PHP online submissions for Robot Return to Origin.

class Solution1 {
    /**
     * @param String $moves
     * @return Boolean
     */
    function judgeCircle($moves) {
        $x = 0;
        $y = 0;

        $len = strlen($moves);
        for ($i = 0; $i < $len; ++$i) {
            switch ($moves[$i]) {
                case 'U': $y++; break;
                case 'D': $y--; break;
                case 'L': $x--; break;
                case 'R': $x++; break;
                default: return false;
            }
        }

        return $x == 0 && $y == 0;
    }
}

class Solution {
    /**
     * @param String $moves
     * @return Boolean
     */
    function judgeCircle($moves) {
        $x = 0;
        $y = 0;

        $len = strlen($moves);
        for ($i = 0; $i < $len; ++$i) {
            $ch = $moves[$i];
            if ($ch == 'U') {
                $y++;
            } else if ($ch == 'D') {
                $y--;
            } else if ($ch == 'L') {
                $x--;
            } else if ($ch == 'R') {
                $x++;
            } else {
                // invalid movement
                return false;
            }
        }

        return $x == 0 && $y == 0;
    }
}

$solution = new Solution();

$moves = 'UDLR';
echo var_export($solution->judgeCircle($moves))."\n";
