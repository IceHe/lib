<?php

// https://leetcode.com/problems/unique-morse-code-words/

class Solution {
    function uniqueMorseRepresentations($words) {
        static $map = [
            'a' => ".-", 'b' => "-...", 'c' => "-.-.", 'd' => "-..",
            'e' => ".", 'f' => "..-.", 'g' => "--.", 'h' => "....",
            'i' => "..", 'j' => ".---", 'k' => "-.-", 'l' => ".-..",
            'm' => "--", 'n' => "-.", 'o' => "---", 'p' => ".--.",
            'q' => "--.-", 'r' => ".-.", 's' => "...", 't' => "-",
            'u' => "..-", 'v' => "...-", 'w' => ".--", 'x' => "-..-",
            'y' => "-.--", 'z' => "--..",
        ];

        $transformations = [];
        foreach ($words as $k => $v) {
            $tmp = '';
            for ($i = 0; $i < strlen($v); ++$i) {
                $tmp .= $map[$v[$i]];
            }
            if (!in_array($tmp, $transformations)) {
                $transformations[] = $tmp;
            }
        }
        return count($transformations);
    }
}

$words = ["gin", "zen", "gig", "msg"];
echo (new Solution())->uniqueMorseRepresentations($words);
