<?php

$raw = file_get_contents('c:/laragon/www/2026/undangan/resources/views/demo/new/l01-index.html');

echo "=== INSIDE 52f6b538 in l01-index.html ===\n";
if (preg_match('/<div[^>]*elementor-element-52f6b538[^>]*>(.*?)<\/div>\s*<div[^>]*elementor-element-49f92c84/s', $raw, $m)) {
    echo substr($m[1], 0, 1000) . "\n";
} else {
    echo "Pattern not matched\n";
}

echo "=== INSIDE d28a23a in l01-index.html ===\n";
if (preg_match('/<section[^>]*elementor-element-d28a23a[^>]*>(.*?)<\/section>/s', $raw, $m)) {
    echo substr($m[0], 0, 2000) . "\n";
}

echo "=== INSIDE e47b0ce in l01-index.html ===\n";
if (preg_match('/<section[^>]*elementor-element-e47b0ce[^>]*>(.*?)<\/section>/s', $raw, $m)) {
    echo substr($m[0], 0, 2000) . "\n";
}
