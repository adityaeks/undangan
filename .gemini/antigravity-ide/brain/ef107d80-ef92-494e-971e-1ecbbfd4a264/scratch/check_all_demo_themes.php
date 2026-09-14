<?php

$dir = 'c:/laragon/www/2026/undangan/resources/views/demo';
$files = glob($dir . '/*.blade.php');

foreach ($files as $file) {
    $content = file_get_contents($file);
    $hasE47 = strpos($content, 'e47b0ce') !== false;
    $hasCalc450 = strpos($content, 'calc(100% - 450px)') !== false;
    echo basename($file) . ": e47b0ce=" . ($hasE47 ? 'YES' : 'NO') . " | calc450=" . ($hasCalc450 ? 'YES' : 'NO') . "\n";
}
