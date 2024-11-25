<?php

ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);


require 'vendor/autoload.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($uri == '/currency') {
    require 'resource/views/currency-converter.php';
} elseif ($uri == '/weather') {
    require 'resource/views/weatherInfo.php';
} elseif ($uri == '/telegram') {
    require 'app/bot.php';
} else {
    echo "<h1 align='center'>404</h1>";
}