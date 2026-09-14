<?php

$html = file_get_contents('c:/laragon\www\2026\undangan/resources/views/demo/luxury-01.blade.php');
$css = file_get_contents('c:/laragon\www\2026\undangan/public/themes/luxury-01/uploads/elementor/css/post-22504.css');

echo "=== CSS FOR 875d96b ===\n";
preg_match_all('/[^{}]*875d96b[^{}]*\{[^}]*\}/i', $css, $m);
print_r($m[0]);

echo "=== CSS FOR 52f6b538 (left col of 875d96b) ===\n";
preg_match_all('/[^{}]*52f6b538[^{}]*\{[^}]*\}/i', $css, $m);
print_r($m[0]);

echo "=== CSS FOR 49f92c84 (right col of 875d96b) ===\n";
preg_match_all('/[^{}]*49f92c84[^{}]*\{[^}]*\}/i', $css, $m);
print_r($m[0]);

echo "=== CSS FOR d28a23a ===\n";
preg_match_all('/[^{}]*d28a23a[^{}]*\{[^}]*\}/i', $css, $m);
print_r($m[0]);

echo "=== CSS FOR e47b0ce ===\n";
preg_match_all('/[^{}]*e47b0ce[^{}]*\{[^}]*\}/i', $css, $m);
print_r($m[0]);
