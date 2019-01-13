<?php

require_once('./tools.php');

function selectionSort(array $ary): array {
    $len = count($ary);
    for ($i = 0; $i < $len; $i++) {
        $minIdx = $i;
        for ($j = $len - 1; $j > $i; $j--) {
            if ($ary[$j] < $ary[$minIdx]) {
                $minIdx = $j;
            }
        }
        if ($minIdx != $i) swap($ary, $i, $minIdx);
    }
    return $ary;
}

testSort("selectionSort");
