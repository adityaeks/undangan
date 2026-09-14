<?php

$lines = file('c:/laragon/www/2026/undangan/resources/views/demo/luxury-02.blade.php');
for ($i = 2300; $i < 2360; $i++) {
    if (isset($lines[$i]) && strpos($lines[$i], 'section') !== false) {
        echo ($i + 1) . ": " . trim($lines[$i]) . "\n";
    }
}
