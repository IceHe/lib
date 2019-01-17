<?php

require_once('./tools.php');

function quickSort(array &$ary): void {
    $len = count($ary);
    doQuickSort($ary, 0, $len - 1);
}

function doQuickSort(array &$ary, $beg, $end): void {
    if ($beg >= $end) {
        return;
    }

    $privot = floor(($beg + $end) / 2);
    $front = $beg;
    $rear = $end - 1;
    swap($ary, $privot, $end);
    while ($front <= $rear) {
//        while ($front < $end - 1 && $ary[$front] < $ary[$end]) $front++;
//        while ($rear > 0 && $ary[$rear] >= $ary[$end]) $rear--;
        while ($front <= $end - 1 && $ary[$front] < $ary[$end]) $front++;
        while ($rear >= 0 && $ary[$rear] >= $ary[$end]) $rear--;
        swap($ary, $front, $rear);
    }
    swap($ary, $rear, $end);

    $privot = floor(($beg + $end) / 2);
    doQuickSort($ary, $beg, $privot);
    doQuickSort($ary, $privot + 1, $end);

}

testSort("quickSort");

