<?php

require_once("../_utils/utils.php");

function mergeSort(array &$ary): void {
    $len = count($ary);
    if ($len <= 1) {
        return;
    }

    $privot = floor($len / 2);
    $aryA = array_slice($ary, 0, $privot);
    $aryB = array_slice($ary, $privot);
    mergeSort($aryA);
    mergeSort($aryB);

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

function mergeSort2(array &$ary): void {
    doMergeSort2($ary, 0, count($ary) - 1);
}

function doMergeSort2(array &$ary, int $beg, int $end): void {
    if ($beg >= $end) {
        return;
    }

    $privot = floor(($beg + $end) / 2);

    doMergeSort2($ary, $beg, $privot);
    doMergeSort2($ary, $privot + 1, $end);

    $bakAry = $ary;

    $i = $beg;
    $j = $privot + 1;
    $k = $beg;
    while ($k <= $end) {
        if ($i > $privot) {
            $ary[$k] = $bakAry[$j++];
        } else if ($j > $end) {
            $ary[$k] = $bakAry[$i++];
        } else if ($bakAry[$i] < $bakAry[$j]) {
            $ary[$k] = $bakAry[$i++];
        } else {
            $ary[$k] = $bakAry[$j++];
        }
        $k++;
    }
}

function mergeSort3(array &$ary): void {
    $len = count($ary);
    if ($len <= 1) {
        return;
    }

    $privot = floor($len / 2);

    $aryA = array_slice($ary, 0, $privot);
    $aryB = array_slice($ary, $privot);
    
    mergeSort($aryA);
    mergeSort($aryB);

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

testSort("mergeSort");
testSort("mergeSort2");
testSort("mergeSort3");

