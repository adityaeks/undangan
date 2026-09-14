<?php

$blade = file_get_contents('c:/laragon/www/2026/undangan/resources/views/demo/luxury-01.blade.php');

preg_match_all('/<\/?footer[^>]*>/i', $blade, $footers, PREG_OFFSET_CAPTURE);
foreach ($footers[0] as $f) {
    echo "Footer tag at offset " . $f[1] . ": " . $f[0] . "\n";
}
