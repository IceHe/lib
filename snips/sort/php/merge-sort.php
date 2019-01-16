<?php

require_once('./tools.php');

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

// wrong
function mergeSort1(array &$ary): void {
    $len = count($ary);
    if ($len <= 1) {
        return;
    }

    $privot = floor($len / 2);
    $aryA = array_slice($ary, 0, $privot);
    $aryB = array_slice($ary, $privot);
    mergeSort1($aryA);
    mergeSort1($aryB);

    $k = 0;

    while (!empty($aryA) && !empty($aryB)) {
        if (reset($aryA) < reset($aryB)) {
            $ary[$k++] = array_shift($aryA);
        } else {
            $ary[$k++] = array_shift($aryB);
        }
    }

    while (!empty($aryB)) {
        $ary[$k++] = array_shift($aryB);
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

    doMergeSort2($ary, 0, $privot);
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

function doMergeSort3(array &$ary, int $beg, int $end): void {
    if ($beg >= $end) {
        return;
    }

    $privot = floor(($beg + $end) / 2);

    doMergeSort3($ary, 0, $privot);
    doMergeSort3($ary, $privot + 1, $end);

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

testSort("mergeSort");
testSort("mergeSort1");
testSort("mergeSort2");
//testSort("mergeSort3");

