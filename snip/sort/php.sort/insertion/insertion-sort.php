<?php

require_once("../_utils/utils.php");

function insertionSort(array &$ary): void {
    $len = count($ary);
    for ($i = 1; $i < $len; $i++) {
        for ($j = $i; $j > 0 && $ary[$j - 1] > $ary[$j]; $j--) {
            swap($ary, $j - 1, $j);
        }
    }
}

testSort("insertionSort");
