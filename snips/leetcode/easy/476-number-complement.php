<?php

// https://leetcode.com/problems/number-complement/

//Runtime: 8 ms, faster than 100.00% of PHP online submissions for Number Complement.
//Memory Usage: 16.4 MB, less than 100.00% of PHP online submissions for Number Complement.

//class Solution {
//
//    /**
//     * @param Integer $num
//     * @return Integer
//     */
//    function findComplement($num): int {
//        $numStr = decbin($num);
//
//        $highest1BitPos = strpos($numStr, "1");
//        if ($highest1BitPos === false) {
//            return (int)0b11111111111111111111111111111111; // -1
//        }
//
//        $len = strlen($numStr);
//        for ($i = 0; $i < $len; $i++) {
//            $numStr{$i} = $numStr{$i} === '0' ? '1' : '0'; // flip
//        }
//
//        return bindec($numStr);
//    }
//}

//结果更慢……
//Runtime: 16 ms, faster than 50.00% of PHP online submissions for Number Complement.
//Memory Usage: 16.5 MB, less than 100.00% of PHP online submissions for Number Complement.

class Solution {
    private static $POWER2 = [];
    private static $MASK = [];

    /**
     * @param Integer $num
     * @return Integer
     */
    function findComplement($num): int {
        if (empty(self::$MASK) || empty(self::$POWER2)) {
            self::initStaticVariables();
        }

        $i = 31;
        for (; $i >= 0; $i--) {
            if (($num & self::$POWER2[$i]) > 0) {
                break;
            }
        }

        if ($i === -1) {
            return 0b11111111111111111111111111111111; // -1
        }

        return $num ^ self::$MASK[$i];
    }

    private static function initStaticVariables() {
        self::$POWER2[0] = 1;
        self::$MASK[0] = 1;
        for ($i = 1; $i < 32; $i++) {
            self::$POWER2[$i] = (1 << $i);
            self::$MASK[$i] = self::$MASK[$i - 1] | self::$POWER2[$i];
        }
    }
}

$solution = new Solution();

$num = 0b101; // 5 -> 2
echo $solution->findComplement($num)."\n";

$num = 0b100; // 8 -> 3
echo $solution->findComplement($num)."\n";

$num = 0b001; // 1 -> 0
echo $solution->findComplement($num)."\n";

$num = 0b010; // 2 -> 1
echo $solution->findComplement($num)."\n";

//function index32($x){
//    $n = 0;
//    $o = $x;
//    if (($o = $o >> 16) > 0) {
//        $n += 15;
//    }
//    if (($o = $o)) {
//
//    }
//    return $x + 1;
//}
//
//echo "\n";
//$t = 0b00000000000000000000000000000001;
//echo clp2($t)."\n";
//$t = 0b00000000000000000000000000000011;
//echo clp2($t)."\n";
//$t = 0b00000000000000000000000000000111;
//echo clp2($t)."\n";
//$t = 0b00000000000000000000000000001111;
//echo clp2($t)."\n";

