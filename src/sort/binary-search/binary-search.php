<?php

require_once("../_utils/utils.php");
require_once("../insertion/insertion-sort.php");

function binarySearch($ary, $val): int {
    $len = count($ary);
    if ($len <= 0) {
        return -1;
    }

    $beg = 0;
    $end = $len - 1;
    while ($beg <= $end) {
        $privot = floor(($beg + $end) / 2);
        if ($ary[$privot] === $val) {
            return $privot;
        } else if ($ary[$privot] < $val) {
            $beg = $privot + 1;
        } else { // $ary[$privot] > $val
            $end = $privot - 1;
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
