<?php

require_once("../_utils/utils.php");

function mergeSort(array &$ary): void {
    $len = count($ary);
    if ($len <= 1) {
        return;
    }

    for ($step = 1; $step <= $len; $step *= 2) {
        $offset = $step * 2;
        for ($i = 0; $i < $len; $i += $offset) {
            $head1 = $i;
            $head2 = min($i + $step, $len - 1);
            $tail2 = min($i + $offset - 1, $len - 1);
            assistMergeSort($ary, $head1, $head2, $tail2);
        }
    }
}

function assistMergeSort(array &$ary, $head1, $head2, $tail2) {
    $tmpAry = $ary;
    $tail1 = $head2 - 1;

    $i = $head1;
    $j = $head2;
    $k = $head1;
    while ($k <= $tail2) {
        if ($i > $tail1) {
            $ary[$k] = $tmpAry[$j++];
        } else if ($j > $tail2) {
            $ary[$k] = $tmpAry[$i++];
        } else if ($tmpAry[$i] < $tmpAry[$j]) {
            $ary[$k] = $tmpAry[$i++];
        } else {
            $ary[$k] = $tmpAry[$j++];
        }
        $k++;
    }
}

testSort("mergeSort", 10);
