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

$lines = [];
foreach ($cases as $index => $case) {
    // 缩短展示变量的那一列的宽度
    $title = (is_array($case) ? '' : gettype($case))
        .' '.str_replace(["\n", ' '], '', var_export($case, true));

    // 统一前两列的宽度，对齐数据以便查看
    $line = [
        str_pad(''.$index, 2),
        str_pad(trim($title), 14),
    ];

    foreach ($exprs as $desc => $expr) {
        $line[] = $desc.' '.($expr($case) ? 1 : 0);
    }

    $lines[] = join(' | ', $line);
}
echo join("\n", $lines);
