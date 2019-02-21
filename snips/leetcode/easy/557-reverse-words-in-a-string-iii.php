<?php

// https://leetcode.com/problems/reverse-words-in-a-string-iii/

//Runtime: 40 ms, faster than 33.33% of PHP online submissions for Reverse Words in a String III.
//Memory Usage: 15.3 MB, less than 100.00% of PHP online submissions for Reverse Words in a String III.

//class Solution {
//
//    /**
//     * @param String $s
//     * @return String
//     */
//    function reverseWords($s) {
//        $slices = explode(' ', $s);
//
//        foreach ($slices as &$slice) {
//            $len = strlen($slice);
//            for ($i = 0; $i < $len / 2; $i++) {
//                $tmp = $slice[$i];
//                $slice[$i] = $slice[$len - 1 - $i];
//                $slice[$len - 1 - $i] = $tmp;
//            }
//        }
//        unset($slice);
//
//        return implode(' ', $slices);
//    }
//}

//没有明显的优化效果……还不如原来的代码清晰
//Runtime: 40 ms, faster than 33.33% of PHP online submissions for Reverse Words in a String III.
//Memory Usage: 15.1 MB, less than 100.00% of PHP online submissions for Reverse Words in a String III.

//class Solution {
//
//    /**
//     * @param String $s
//     * @return String
//     */
//    function reverseWords($s) {
//        $left = 0;
//        $right = null;
//
//        $len = strlen($s);
//        while (($spaceIndex = strpos($s, ' ', $left)) !== false
//            || $left < $len
//        ) {
//            $isLastPart = $spaceIndex === false;
//
//            $right = !$isLastPart
//                ? $spaceIndex - 1
//                : $len - 1;
//
//            while ($left < $right) {
//                $this->swapChar($s, $left++, $right--);
//            }
//
//            $left = !$isLastPart
//                ? $spaceIndex + 1
//                : $len;
//        }
//
//        return $s;
//    }
//
//    private function swapChar(string &$str, $a, $b): void {
//        $tmp = $str{$a};
//        $str{$a} = $str{$b};
//        $str{$b} = $tmp;
//    }
//}

class Solution {

    /**
     * @param String $s
     * @return String
     */
    function reverseWords($s)
    {
        $len = strlen($s);
        for ($i = 0; $i < $len; $i++) {
            if ($s{$i} != ' ') {
                $j = $i;
                for (; $j < $len && $s{$j} != ' '; $j++) ;

                $left = $i;
                $right = $j - 1;
                while ($left < $right) {
                    $this->swapChar($s, $left++, $right--);
                }
                $i = $j;
            }
        }

        return $s;
    }

    private function swapChar(string &$str, $a, $b): void {
        $tmp = $str{$a};
        $str{$a} = $str{$b};
        $str{$b} = $tmp;
    }
}

$s = "Let's take LeetCode contest";
$solution = new Solution();
echo '"'.$solution->reverseWords($s)."\"\n";
