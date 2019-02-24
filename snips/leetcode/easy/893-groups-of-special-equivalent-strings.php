<?php

// https://leetcode.com/problems/groups-of-special-equivalent-strings/

//Runtime: 16 ms, faster than 100.00% of PHP online submissions for Groups of Special-Equivalent Strings.
//Memory Usage: 15.2 MB, less than 100.00% of PHP online submissions for Groups of Special-Equivalent Strings.

//class Solution {
//
//    /**
//     * @param String[] $A
//     * @return Integer
//     */
//    function numSpecialEquivGroups($A) {
//        foreach ($A as &$a) {
//            $evenChars = [];
//            $oddChars = [];
//
//            $len = strlen($a);
//            for ($i = 0; $i < $len; $i++) {
//                if ($i % 2 === 0) {
//                    $evenChars[] = $a{$i};
//                } else {
//                    $oddChars[] = $a{$i};
//                }
//            }
//
//            sort($evenChars);
//            sort($oddChars);
//
//            for ($i = 0; $i < $len; $i++) {
//                if ($i % 2 === 0) {
//                    $a{$i} = $evenChars[(int)floor($i / 2)];
//                } else {
//                    $a{$i} = $oddChars[(int)floor($i / 2)];
//                }
//            }
//        }
////        unset($a);
//
//        return count(array_unique($A));
//    }
//}

//优化了不必要的步骤
//Runtime: 20 ms, faster than 100.00% of PHP online submissions for Groups of Special-Equivalent Strings.
//Memory Usage: 16.5 MB, less than 100.00% of PHP online submissions for Groups of Special-Equivalent Strings.

class Solution {

    /**
     * @param String[] $A
     * @return Integer
     */
    function numSpecialEquivGroups($A) {
        foreach ($A as &$a) {
            $evenChars = [];
            $oddChars = [];

            $len = strlen($a);
            for ($i = 0; $i < $len; $i++) {
                if ($i % 2 === 0) {
                    $evenChars[] = $a{$i};
                } else {
                    $oddChars[] = $a{$i};
                }
            }

            sort($evenChars);
            sort($oddChars);

            $a = implode('', $evenChars).implode('', $oddChars);
        }

        return count(array_unique($A));
    }
}

//参考原题 solution 之后尝试一下
//Runtime: 24 ms, faster than 100.00% of PHP online submissions for Groups of Special-Equivalent Strings.
//Memory Usage: 16.5 MB, less than 100.00% of PHP online submissions for Groups of Special-Equivalent Strings.

//class Solution {
//
//    /**
//     * @param String[] $A
//     * @return Integer
//     */
//    function numSpecialEquivGroups($A) {
//        $collection = [];
//        foreach ($A as $a) {
//            $counter = [];
//
//            $len = strlen($a);
//            for ($i = 0; $i < $len; $i++) {
//                $index = ord($a{$i}) - ord('a') + ($i % 2) * 26;
//
//                if (!isset($counter[$index])) {
//                    $counter[$index] = 1;
//                } else {
//                    $counter[$index]++;
//                }
//            }
//
//            $str = $this->counter2str($counter);
//            $collection[] = $str;
//        }
//
//        return count(array_unique($collection));
//    }
//
//    private function counter2str(array $counter) {
//        $str = '';
//        for ($i = 0; $i < 52; $i++) {
//            $str .= $counter[$i] ?? '0';
//        }
//        return $str;
//    }
//}

$solution = new Solution();

$As = [
    ["a","b","c","a","c","c"],
    ["aa","bb","ab","ba"],
    ["abc","acb","bac","bca","cab","cba"],
    ["abcd","cdab","adcb","cbad"],
];

foreach ($As as $A) {
    echo $solution->numSpecialEquivGroups($A)."\n";
}
