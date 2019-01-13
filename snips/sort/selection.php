<?php

require_once('./tools.php');

function selectionSort(array $ary): array {
    $len = count($ary);
    for ($i = 0; $i < $len; $i++) {
        $maxIdx = $i;
        for ($j = $len - 1; $j > $i; $j--) {
            if ($ary[$j] > $ary[$maxIdx]) {
                $maxIdx = $j;
            }
        }
        if ($maxIdx != $i) swap($ary, $i, $maxIdx);
    }
    return $ary;
}

testSort("selectionSort");
