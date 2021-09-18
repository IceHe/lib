<?php

var_dump($argv);

$beg = $argv[1];
$end = $argv[2];

if ($beg > $end) {
    echo "invalid: beg=${beg}, end=${end}";
    exit(1);
}

$beg *= 10000;
$end *= 10000;

for ($idx = $beg; $idx <= $end; ++$idx) {
    $idxStr = str_pad("${idx}", 10, '0', STR_PAD_LEFT);
    $cmd = "redis-cli HMSET video_wall_count_${idxStr} all_count 3000 horizontal_count 2000 vertical_count 1000";
    echo $cmd."\n";
    passthru($cmd);
}

echo "fin.";
