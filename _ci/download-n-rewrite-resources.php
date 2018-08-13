<?php

// Notice: It should be executed in the project root directory.
// `php _docsify/download-n-rewrite-resources.php [-d|--download] [-r|--rewrite]`

echo var_export($argv, true)."\n\n";

// Download resources to directory `_docsify/resources/`
$toDownload = false;
// Rewrite links of resources to local files
$toRewriteOriginal = false;

foreach ($argv as $arg) {
    if (in_array($arg, ['--download', '-d'])) {
        $toDownload = true;
    } elseif (in_array($arg, ['--rewrite', '-r'])) {
        $toRewriteOriginal = true;
    }
}

echo 'toDownload: '.intval($toDownload)."\n";
echo 'toRewriteOriginal: '.intval($toRewriteOriginal)."\n";
echo "\n";

// Get content of `index.html`
$content = file_get_contents("index.html");
echo $content."\n\n";

// Extract URLs of resources from `index.html`
$count = preg_match_all('/ (?:href|src)="((?!_docsify|_files|_images)[^"]+)"/', $content, $resources);
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

    // Replace links to resources in `index.html`
    $contectImproved = str_replace($resource, $localFilePath, $contectImproved);

    echo "\n";
}

echo $contectImproved."\n\n";

// Save new `index.html` with links to local resources
if ($toRewriteOriginal) {
    file_put_contents("index.original.html", $content);
    file_put_contents("index.html", $contectImproved);
} else {
    file_put_contents("index.improved.html", $contectImproved);
}

echo "Fin.\n\n";
