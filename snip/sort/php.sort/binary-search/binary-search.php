<?php

require_once("../_utils/utils.php");
require_once("../insertion/insertion-sort.php");

function binarySearch($ary, $val): int {
    $len = count($ary);
    if ($len <= 0) {
        return -1;
    }

    $left = 0;
    $right = $len - 1;

    while ($left <= $right) {
        $mid = floor(($left + $right) / 2);
        if ($ary[$mid] === $val) {
            return $mid;
        } else if ($ary[$mid] < $val) {
            $left = $mid + 1;
        } else {
            $right = $mid - 1;
        }
    }

    return -1;
}

line();
$ary = rndAry();
insertionSort($ary);
line(ary2str($ary));

$rndKey = mt_rand(0, count($ary) - 1);
$searchVal = $ary[$rndKey];
line("\$searchVal = $searchVal\n");
line(binarySearch($ary, $searchVal));
