<?php

require_once("../_utils/utils.php");

function quickSort(array &$ary): void {
    doQuickSort($ary, 0, count($ary) - 1);
}

function doQuickSort(array &$ary, $beg, $end): void {
    if ($beg >= $end) {
        return;
    }

//    $privot = floor(($beg + $end) / 2);
    $privot = mt_rand($beg, $end);
    swap($ary, $beg, $privot);

    $k = $beg;
    for ($i = $beg + 1; $i <= $end; ++$i) {
        if ($ary[$i] < $ary[$beg]) {
            swap($ary, $i, ++$k);
        }
    }

    swap($ary, $beg, $k);

    doQuickSort($ary, $beg, $k - 1);
    doQuickSort($ary, $k + 1, $end);
}

function quickSort2(array &$ary): void {
    $len = count($ary);
    doQuickSort2($ary, 0, $len - 1);
}

function doQuickSort2(array &$ary, $first, $last): void {
    if ($first >= $last) {
        return;
    }

    $privot = mt_rand($first, $last);
    swap($ary, $privot, $last);

    $left = $first - 1;
    $right = $last;
    do {
        while ($ary[++$left] < $ary[$last]);
        while ($right > 0 && $ary[--$right] > $ary[$last]);
        swap($ary, $left, $right);
    } while ($left < $right);

    swap($ary, $left, $right);
    swap($ary, $left, $last);

    doQuickSort($ary, $first, $left - 1);
    doQuickSort($ary, $left + 1, $last);
}

testSort("quickSort", 10);
testSort("quickSort2", 10);

