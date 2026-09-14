<?php

$html = file_get_contents('c:/laragon\www\2026\undangan/resources/views/demo/luxury-01.blade.php');
$raw = file_get_contents('c:/laragon\www\2026\undangan/resources/views/demo/new/l01-index.html');

echo "=== TOP SECTIONS IN luxury-01.blade.php ===\n";
preg_match_all('/<section[^>]*elementor-top-section[^>]*>/i', $html, $m1);
foreach ($m1[0] as $i => $s) {
    preg_match('/class="([^"]*)"/', $s, $c);
    preg_match('/data-id="([^"]*)"/', $s, $id);
    echo "$i: id=" . ($id[1] ?? '') . " | class=" . ($c[1] ?? '') . "\n";
}

echo "\n=== TOP SECTIONS IN l01-index.html ===\n";
preg_match_all('/<section[^>]*elementor-top-section[^>]*>/i', $raw, $m2);
foreach ($m2[0] as $i => $s) {
    preg_match('/class="([^"]*)"/', $s, $c);
    preg_match('/data-id="([^"]*)"/', $s, $id);
    echo "$i: id=" . ($id[1] ?? '') . " | class=" . ($c[1] ?? '') . "\n";
}
