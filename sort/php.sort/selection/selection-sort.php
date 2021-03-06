<?php

require_once("../_utils/utils.php");

function selectionSort(array &$ary): void {
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
}

testSort("selectionSort");
