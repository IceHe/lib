<?php

// https://leetcode.com/problems/number-of-recent-calls/
// 题目很费解，不是好题目……
// 题意详见 https://leetcode.com/problems/number-of-recent-calls/discuss/204560/Confused

//Runtime: 288 ms, faster than 100.00% of PHP online submissions for Number of Recent Calls.
//Memory Usage: 26.8 MB, less than 100.00% of PHP online submissions for Number of Recent Calls.

class RecentCounter {
    private $queue = [];

    /**
     */
    function __construct() {
    }

    /**
     * @param Integer $t
     * @return Integer
     */
    function ping($t) {
        array_push($this->queue, $t);
        while (reset($this->queue) < $t - 3000) {
            array_shift($this->queue);
        }
        return count($this->queue);
    }
}

/**
 * Your RecentCounter object will be instantiated and called as such:
 * $obj = RecentCounter();
 * $ret_1 = $obj->ping($t);
 */
