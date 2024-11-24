<?php

require "currency.php";

require 'vendor/autoload.php';

use GuzzleHttp\Client;

$currency = new Currency;

$currencies = $currency->getCurrencies();

require "views/currency-converter.php";