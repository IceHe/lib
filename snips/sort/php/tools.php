<?php

function swap(array &$ary, int $idxA, int $idxB): void {
    $tmp = $ary[$idxA];
    $ary[$idxA] = $ary[$idxB];
    $ary[$idxB] = $tmp;
}

function rndAry(int $len = 10, int $min = 0, int $max = 100): array {
    while ($len--) $ary[] = rand($min, $max);
    return $ary ?? [];
}

function ary2str(array $ary): string {
    $str = '[ ';
    for ($i = 0; $i < count($ary); $i++) {
        $str .= ($i ? ', ' : '') . $ary[$i];
    }
    $str .= " ]";
    return $str;
}

function chkSortedAry(array $ary): void {
    $len = count($ary);
    if ($len == 1) {
        line('sorted.');
    }

    for ($i = 0; $i < $len - 1; $i++) {
        if ($ary[$i] > $ary[$i + 1]) {
            line('not sorted!');
            return;
        }
    }

    line('sorted.');
}

function testSort(string $sortFnName, int $len = 10, int $min = 0, int $max = 100): void {
    echo "<<sort : ${sortFnName}>>\n";

    $ary = rndAry($len, $min, $max);
    line(ary2str($ary));
    chkSortedAry($ary);

    $sortFnName($ary);
    line(ary2str($ary));
    chkSortedAry($ary);
}

function line($str = ''): void {
    echo "${str}\n";
}
