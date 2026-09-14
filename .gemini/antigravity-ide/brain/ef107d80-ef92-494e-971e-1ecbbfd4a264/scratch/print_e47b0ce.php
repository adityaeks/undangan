<?php

$raw = file_get_contents('c:/laragon/www/2026/undangan/resources/views/demo/new/l01-index.html');

if (preg_match('/<section[^>]*elementor-element-e47b0ce[^>]*>.*<\/section>/s', $raw, $m)) {
    echo $m[0];
}
