<?php

$themes = ['luxury-01', 'luxury-02', 'luxury-07'];

foreach ($themes as $t) {
    $f = "c:/laragon/www/2026/undangan/resources/views/demo/{$t}.blade.php";
    $content = file_get_contents($f);
    echo "=== $t ===\n";
    // Check left column id in e47b0ce
    if (preg_match('/<section[^>]*elementor-element-e47b0ce[^>]*>.*?<div[^>]*class="[^"]*elementor-top-column[^"]*elementor-element-([a-f0-9]+)[^"]*"/s', $content, $m)) {
        echo "e47b0ce left column id: " . $m[1] . "\n";
    }
    // Check background slideshow gallery in that column
    if (preg_match('/elementor-element-' . ($m[1] ?? 'xyz') . '[^>]*data-settings="([^"]*)"/', $content, $m2)) {
        $settings = html_entity_decode($m2[1]);
        echo "Left col data-settings: " . substr($settings, 0, 200) . "\n";
    }
}
