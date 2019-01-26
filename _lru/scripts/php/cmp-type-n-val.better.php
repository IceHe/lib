<?php
// error_reporting(~E_ALL);

$cases = [
    /* usual */
    null, '', [], [0],
    /* num */
    2, 1, 0, -1, '2', '1', '0', '-1',
    /* bool */
    true, false, 'true', 'false', 'str',
];

$exprs = [
    'is_null' => function ($v) { return is_null($v); },
    'isset' => function ($v) { return isset($v); },
    //'!isset' => function ($v) { return !isset($v); },
    'empty' => function ($v) { return empty($v); },
    //'!empty' => function ($v) { return !empty($v); },
    'boolval()' => function ($v) { return boolval($v); },
    // 'if' => function ($v) { if ($v) { return true; } return false; },
    // 'if(!)' => function ($v) { return !$v; },
    // 'is_array' => function ($v) { return is_array($v); },
    // 'is_string' => function ($v) { return is_string($v); },
    'intval()' => function ($v) { return intval($v); },
    '==1' => function ($v) { return ($v == 1); },
    "=='1'" => function ($v) { return ($v == '1'); },
    // '!=1' => function ($v) { return ($v != 1); },
    // 'strlen!=0' => function ($v) { return strlen($v) != 0; },
    // "=='true'" => function ($v) { if ($v == 'true') { return true; } return false; },
];

// 设置表头
$header = array_keys($exprs);
array_unshift($header, 'n', 'cases');

$lines = [$header];
$maxTitleLen = 0;
foreach ($cases as $index => $case) {
    // 缩短展示变量的那一列的宽度
    $title = trim((is_array($case) ? '' : gettype($case)).' '.str_replace(["\n", ' '], '', var_export($case, true)));
    $maxTitleLen = ($len = strlen($title)) > $maxTitleLen ? $len : $maxTitleLen;

    $line = [''.$index, $title];
    foreach ($exprs as $expr) {
        $line[] = $expr($case) ? '1' : '0';
    }

    $lines[] = $line;
}

// 计算每一列的宽度
$colLens = [strlen(''.count($cases)), $maxTitleLen];
foreach (array_keys($exprs) as $desc) {
    $colLens[] = strlen($desc);
}

foreach ($lines as $k => $line) {
    foreach ($line as $index => $value) {
        // 统一每一列的宽度，对齐数据以便查看
        $line[$index] = str_pad($value, $colLens[$index]);
    }
    $lines[$k] = join(' | ', $line);
}
echo join("\n", $lines);
