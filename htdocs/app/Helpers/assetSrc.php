<?php

// Get the asset src with hash

function assetSrc($file = null)
{
    // Return md5 of unix time when in debug mode
    if (config('app.debug') || !$file) {
        return str_replace('.min', '', $file) . '?' . md5(time());
    }

    // Create unique asset hash
    $publicPath = public_path();
    $filePath = $publicPath . $file;

    $assetHash = file_exists($filePath) ? filemtime($filePath) : date('Ymd');
    $assetHash = substr(md5($assetHash), 0, 4);

    return $file . '?' . $assetHash;
}
