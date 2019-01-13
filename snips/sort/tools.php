<?php

function randAry(int $len = 10, int $min = 0, int $max = 100): array {
    while ($len--) $ary[] = rand($min, $max);
    return $ary ?? [];
}

function aryToLine(array $ary): string {
    $str = '[ ';
    for ($i = 0; $i < count($ary); $i++) {
        $str .= ($i ? ', ' : '') . $ary[$i];
    }
    $str .= " ]\n";
    return $str;
}

echo aryToLine(randAry());
