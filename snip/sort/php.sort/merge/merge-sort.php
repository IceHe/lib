<?php

require_once("../_utils/utils.php");

function mergeSortRecur(array &$ary): void {
    $len = count($ary);
    if ($len <= 1) {
        return;
    }

    $privot = floor($len / 2);
    $aryA = array_slice($ary, 0, $privot);
    $aryB = array_slice($ary, $privot);
    mergeSortRecur($aryA);
    mergeSortRecur($aryB);

    $k = 0;
    while ($k < $len) {
        if (empty($aryA)) {
            $ary[$k] = array_shift($aryB);
        } else if (empty($aryB)) {
            $ary[$k] = array_shift($aryA);
        } else if (reset($aryA) < reset($aryB)) {
            $ary[$k] = array_shift($aryA);
        } else {
            $ary[$k] = array_shift($aryB);
        }
        $k++;
    }
}

function mergeSortRecur2(array &$ary): void {
    $len = count($ary);
    if ($len <= 1) {
        return;
    }

    $privot = floor($len / 2);

    $aryA = array_slice($ary, 0, $privot);
    $aryB = array_slice($ary, $privot);

    mergeSortRecur2($aryA);
    mergeSortRecur2($aryB);

    $a = 0;
    $b = 0;
    $k = 0;
    while ($k < $len) {
        if ($a >= $privot) {
            $ary[$k] = $aryB[$b++];
        } else if ($b >= $len - $privot) {
            $ary[$k] = $aryA[$a++];
        } else if ($aryA[$a] < $aryB[$b]) {
            $ary[$k] = $aryA[$a++];
        } else {
            $ary[$k] = $aryB[$b++];
        }
        ++$k;
    }
}

function mergeSortIter(array &$ary): void {
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
            assistMergeSortIter($ary, $head1, $head2, $tail2);
        }
    }
}

function assistMergeSortIter(array &$ary, $head1, $head2, $tail2) {
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

testSort("mergeSortRecur");
testSort("mergeSortRecur2");
testSort("mergeSortIter");

