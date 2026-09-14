<?php

$lines = file('c:/laragon/www/2026/undangan/resources/views/demo/luxury-01.blade.php');
foreach ($lines as $num => $line) {
    if (preg_match('/data-id="(875d96b|d28a23a|e47b0ce|52f6b538|49f92c84|848e89d|a932614)"/', $line, $m)) {
        echo ($num + 1) . ": " . trim($line) . "\n";
    }
}
