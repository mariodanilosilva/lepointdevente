<?php

require_once __DIR__ . '/../vendor/autoload.php';

$model = file_get_contents('https://dev.lpdv.co/sandbox/test-php/tag/schema.json');
$payloads = ['https://dev.lpdv.co/sandbox/test-php/tag/data-valid-1.json', 'https://dev.lpdv.co/sandbox/test-php/tag/data-valid-2.json', 'https://dev.lpdv.co/sandbox/test-php/tag/data-invalid-1.json', 'https://dev.lpdv.co/sandbox/test-php/tag/data-invalid-2.json', 'https://dev.lpdv.co/sandbox/test-php/tag/data-invalid-3.json'];
$validator = new \App\Validator($model);

foreach ($payloads as $url) {
    $payload = file_get_contents($url);
    $valid = $validator->validate($payload);
    print_r($valid, true);
}

echo "-----------------------------------<br />";

$model = file_get_contents('https://dev.lpdv.co/sandbox/test-php/contact_name/schema.json');
$payloads = ['https://dev.lpdv.co/sandbox/test-php/contact_name/data-valid-1.json', 'https://dev.lpdv.co/sandbox/test-php/contact_name/data-invalid-1.json'];
$validator = new \App\Validator($model);

foreach ($payloads as $url) {
    $payload = file_get_contents($url);
    $valid = $validator->validate($payload);
    print_r($valid, true);
}

