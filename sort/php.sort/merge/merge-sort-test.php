<?php

$startMemSize = memory_get_usage();

require_once("../_utils/utils.php");

function mergeSortRecur(array &$ary): void {

}

function mergeSortIter(array &$ary): void {

}

testSort("mergeSortRecur", 10);
testSort("mergeSortIter", 10);

$endMemSize = memory_get_usage();
echo $startMemSize." bytes \n";
echo $endMemSize." bytes \n";
echo ($endMemSize - $startMemSize)." bytes \n";
