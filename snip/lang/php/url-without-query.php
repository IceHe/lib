<?php

$fns = [
    'strtok ' => function ($url) {
        return strtok($url, '?');
    },
    'regex  ' => function ($url) {
        return preg_replace('/(.*)\?.*/', '$1', $url);
    },
    'substr ' => function ($url) {
        return ($pos = strpos($url, '?')) === false ? $url : substr($url, 0, $pos);
    },
    'explode' => function ($url) {
        $ary = explode('?', $url);
        return reset($ary);
    },
];

$keys = [
    'https://icehe.me/about?from=gist.github.com',
    'https://icehe.me/about',
];

$runTimes = 1000 * 1000;
echo "Benchmark ({$runTimes} runs):\n";

foreach ($fns as $desc => $fn) {
    $startTime = microtime(true);
    foreach ($keys as $key) {
        for ($i = 0; $i < $runTimes; ++$i) {
            if (0 == $i) {
                echo "{$desc}('{$key}') === '".$fn($key)."'\n";
            } else {
                $fn($key);
            }
        }
    }
    echo $desc.' : '.(microtime(true) - $startTime)." s\n";;
}
