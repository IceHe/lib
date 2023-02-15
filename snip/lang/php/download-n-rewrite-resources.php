<?php

// Notice: It should be executed in the project root directory.
// `php docsify/download-n-rewrite-resources.php [-d|--download] [-r|--rewrite]`

echo var_export($argv, true)."\n\n";

// Download resources to directory `docsify/resources/`
$toDownload = false;
// Rewrite links of resources to local files
$toRewrite = false; // default

foreach ($argv as $arg) {
    if (in_array($arg, ['--download', '-d'])) {
        $toDownload = true;
    } elseif (in_array($arg, ['--rewrite', '-r'])) {
        $toRewrite = true;
    } elseif (in_array($arg, ['--simplify', '-s'])) {
        $toSimplify = true;
    }
}

echo 'toDownload: '.intval($toDownload)."\n";
echo 'toRewrite: '.intval($toRewrite)."\n";
echo "\n";

// Get content of `index.html`
$originalContent = file_get_contents("index.raw.html");
echo $originalContent."\n\n";

$modifiedContent = $originalContent;

if ($toSimplify) {
    // 移除被 `<!-- -->` 注释的 HTML 元素
    $modifiedContent = preg_replace('/<!--([\s\S]*?)-->\s*/m', '', $modifiedContent);
    // 移除被 `//` 注释的单行 JavaScript 代码
    $modifiedContent = preg_replace('/^\s*\/\/[^\n]*/m', "", $modifiedContent);
    $modifiedContent = preg_replace('/((?<!["\':])\/\/[^\n]*)/', "", $modifiedContent);
    // 移除空行
    $modifiedContent = preg_replace('/\n+/s', "\n", $modifiedContent);
}

// Extract URLs of resources from `index.html`
// $count = preg_match_all('/ (?:href|src)="((?!_docsify|_files|_images|http(s)?:\/\/)[^"]+)"/', $originalContent, $resources);
$count = preg_match_all('/ (?:href|src)="((?!docsify|http(s)?:\/\/)[^"]+)"/', $modifiedContent, $resources);
echo var_export($resources, true)."\n";
echo $count."\n\n";

if ($toRewrite) {
    foreach ($resources[1] ?? [] as $resource) {
        echo $resource."\n";

        $localFileName = str_replace('/', '_', $resource);
        echo $localFileName."\n";

        $localFilePath = "docsify/resource/{$localFileName}";

        // Download resources
        if ($toDownload) {
            echo $cmd = "curl -Lo {$localFilePath} http:{$resource}\n";
            shell_exec($cmd);
        }

        $replacePath = $localFilePath;

        // Replace links to resources in `index.html`
        $modifiedContent = str_replace($resource, $replacePath, $modifiedContent);

        echo "\n";
    }
}

echo $modifiedContent."\n\n";

// Save new `index.html` with links to local resources
file_put_contents('index.html', $modifiedContent);

echo "Fin.\n\n";
