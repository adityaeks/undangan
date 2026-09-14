<?php

foreach (['luxury-01', 'luxury-02', 'luxury-07'] as $theme) {
    $file = "c:/laragon/www/2026/undangan/resources/views/demo/{$theme}.blade.php";
    $lines = file($file);
    echo "=== $theme ===\n";
    foreach ($lines as $num => $l) {
        if (strpos($l, 'e47b0ce') !== false) {
            echo "e47b0ce at line " . ($num + 1) . "\n";
        }
        if (strpos($l, 'data-elementor-type="footer"') !== false || strpos($l, 'class="elementor-shortcode"><footer') !== false) {
            echo "footer at line " . ($num + 1) . "\n";
        }
        if (strpos($l, 'sample-luxury-') !== false || strpos($l, '0-PEMBUKA') !== false) {
            // first couple background image candidate
            preg_match('/\/themes\/[^\s"\']+\.(jpg|jpeg|png|webp)/i', $l, $img);
            if ($img) {
                echo "Cover image found at line " . ($num + 1) . ": " . $img[0] . "\n";
            }
        }
    }
}
