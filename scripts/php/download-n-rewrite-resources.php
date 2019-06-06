<?php

// Notice: It should be executed in the project root directory.
// `php _docsify/download-n-rewrite-resources.php [-d|--download] [-r|--rewrite]`

echo var_export($argv, true)."\n\n";

// Download resources to directory `_docsify/resources/`
$toDownload = false;
// Rewrite links of resources to local files
$toRewrite = true; // default

foreach ($argv as $arg) {
    if (in_array($arg, ['--download', '-d'])) {
        $toDownload = true;
    } elseif (in_array($arg, ['--rewrite', '-r'])) {
        $toRewrite = true;
    }
}

echo 'toDownload: '.intval($toDownload)."\n";
echo 'toRewrite: '.intval($toRewrite)."\n";
echo "\n";

// Get content of `index.html`
$content = file_get_contents("index.raw.html");
echo $content."\n\n";

// Extract URLs of resources from `index.html`
$count = preg_match_all('/ (?:href|src)="((?!_docsify|_files|_images|https:\/\/)[^"]+)"/', $content, $resources);
echo var_export($resources, true)."\n";
echo $count."\n\n";

$contectImproved = $content;

foreach ($resources[1] ?? [] as $resource) {
    echo $resource."\n";

    $localFileName = str_replace('/', '_', $resource);
    echo $localFileName."\n";

    $localFilePath = "_docsify/resources/{$localFileName}";

    // Download resources
    if ($toDownload) {
        echo $cmd = "curl -Lo {$localFilePath} http:{$resource}\n";
        shell_exec($cmd);
    }

    // $replacePath = $localFilePath;
    $replacePath = "https://cdn.icehe.xyz/{$localFilePath}";

    // Replace links to resources in `index.html`
    $contectImproved = str_replace($resource, $replacePath, $contectImproved);

    echo "\n";
}

echo $contectImproved."\n\n";

// Save new `index.html` with links to local resources
file_put_contents($toRewrite ? 'index.html' : 'index.improved.html', $contectImproved);

echo "Fin.\n\n";
