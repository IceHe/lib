<?php

require_once("./tools.php");
require_once("./insertion-sort.php");

function binarySearch(array &$ary, int $val): int {
}

line();
$ary = rndAry();
insertionSort($ary);
line(ary2str($ary));

$rndKey = mt_rand(0, count($ary) - 1);
$searchVal = $ary[$rndKey];
line("\$searchVal = $searchVal");
line(binarySearch($ary, $searchVal));

$searchVal = mt_rand(0, 100);
line("\$searchVal = $searchVal");
line(binarySearch($ary, $searchVal));
