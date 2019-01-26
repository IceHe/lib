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
    doQuickSort($ary, 0, $len - 1);
}

function doQuickSort2(array &$ary, $beg, $end): void {
    if ($beg >= $end) {
        return;
    }

    $privot = floor(($beg + $end) / 2);
    swap($ary, $privot, $end);

    $front = $beg;
    $rear = $end - 1;
    do {
        while (/*$front <= $end - 1 &&*/ $ary[$front] < $ary[$end]) $front++;
        while ($rear >= 0 && $ary[$rear] >= $ary[$end]) $rear--;
        swap($ary, $front, $rear);
    } while ($front <= $rear);
    swap($ary, $front, $rear);

    swap($ary, $privot, $end);

    $privot = floor(($beg + $end) / 2);
    doQuickSort($ary, $beg, $privot - 1);
    doQuickSort($ary, $privot + 1, $end);

}

testSort("quickSort", 10);
testSort("quickSort2", 10);

