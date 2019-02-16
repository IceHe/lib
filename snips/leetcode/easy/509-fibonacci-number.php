<?php

// https://leetcode.com/problems/fibonacci-number/

//Runtime: 68 ms, faster than 26.67% of PHP online submissions for Fibonacci Number.
//Memory Usage: 14.6 MB, less than 100.00% of PHP online submissions for Fibonacci Number.

//class Solution {
//    private static $cache = [0, 1, 1, 2, 3, 5];
//
//    /**
//     * @param Integer $N
//     * @return Integer
//     */
//    function fib($N) {
//        if (isset(self::$cache[$N])) {
//            return self::$cache[$N];
//        }
//
//        $result = $this->fib($N - 2) + $this->fib($N - 1);
//
//        if (empty(self::$cache[$N])) {
//            self::$cache[$N] = $result;
//        }
//
//        return $result;
//    }
//}

//Runtime: 12 ms, faster than 46.67% of PHP online submissions for Fibonacci Number.
//Memory Usage: 14.9 MB, less than 100.00% of PHP online submissions for Fibonacci Number.

//class Solution {
//    private static $cache = [0, 1, 1, 2, 3, 5, 8];
//
//    /**
//     * @param Integer $N
//     * @return Integer
//     */
//    function fib($N) {
//        if (isset(self::$cache[$N])) {
//            return self::$cache[$N];
//        }
//
//        $cacheLen = count(self::$cache);
//
//        for ($i = $cacheLen; $i <= $N; $i++) {
//            $sum = self::$cache[$i - 2] + self::$cache[$i - 1];
//
//            if (!isset(self::$cache[$i])) {
//                self::$cache[$i] = $sum;
//            }
//        }
//
//        return self::$cache[$N];
//    }
//}

//Runtime: 12 ms, faster than 46.67% of PHP online submissions for Fibonacci Number.
//Memory Usage: 14.7 MB, less than 100.00% of PHP online submissions for Fibonacci Number.

class Solution {
    private static $cache = [
        0, 1, 1, 2, 3, 5, 8, 13, 21, 34, 55, 89,
        144, 233, 377, 610, 987, 1597, 2584, 4181,
        6765, 10946, 17711, 28657, 46368, 75025,
        121393, 196418, 317811, 514229, 832040,
    ];

    /**
     * @param Integer $N
     * @return Integer
     */
    function fib($N) {
        if (isset(self::$cache[$N])) {
            return self::$cache[$N];
        }

        $cacheLen = count(self::$cache);

        for ($i = $cacheLen; $i <= $N; $i++) {
            $sum = self::$cache[$i - 2] + self::$cache[$i - 1];

            if (!isset(self::$cache[$i])) {
                self::$cache[$i] = $sum;
            }
        }

        return self::$cache[$N];
    }
}

$solution = new Solution();

echo $solution->fib(0)."\n";
echo $solution->fib(7)."\n";
echo $solution->fib(8)."\n";
echo $solution->fib(9)."\n";
echo $solution->fib(10)."\n";
echo $solution->fib(11)."\n";
echo $solution->fib(12)."\n";
echo $solution->fib(13)."\n";
echo $solution->fib(14)."\n";
echo $solution->fib(15)."\n";
//echo $solution->fib(22)."\n";
//echo $solution->fib(33)."\n";
//echo $solution->fib(44)."\n";
