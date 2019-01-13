<?php

require_once('./tools.php');

function bubbleSort(array $ary): void {
    $len = count($ary);
    for ($i = 0; $i < $len; $i++) {
        $isSorted = true;
        for ($j = $len - 1; $j > $i; $j--) {
            if ($ary[$j - 1] > $ary[$j]) {
                swap($ary, $j - 1, $j);
                $isSorted && $isSorted = false;
            }
        }
        if ($isSorted) {
            break;
        }
    }
}

testSort("bubbleSort");
