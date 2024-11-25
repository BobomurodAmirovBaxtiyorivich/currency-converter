<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require 'src/Bot.php';
require 'src/Weather.php';
require 'src/currency.php';

$weather = new Weather();

$weather_info = $weather->getWeather();

$bot = new Bot();

$currency = new Currency;

$update = json_decode(file_get_contents('php://input'));

if (isset($update)) {
    $text = $update->message->text;

    $id = $update->message->chat->id;

    if ($text == '/start') {
        $first_name = $update->message->from->first_name;
        $id = $update->message->from->id;

        $start = '/weather => shows weather info of the Tashkent
/currencies => show currency info';

        $bot->makeRequest('sendMessage', ['chat_id' => $id, 'text' => $start]);

        $bot->save_user($id, $first_name);
    } else if ($text == '/weather') {
        $info = "Temperatur: " . round($weather_info['main']->temp - 273.15, 2) . "°C" . " - " . "Weather: " . $weather_info['weather'][0]->main;

        $bot->makeRequest('sendMessage', ['chat_id' => $id, 'text' => $info]);
    } else if ($text == '/currencies') {
        $currency_list = "";

        $currencies = $currency->getCurrencies();

        foreach ($currencies as $ccy => $rate) {
            $currency_list .= "1 " . $ccy . ' = ' . $rate . " UZS" . "\n";
        }
        $bot->makeRequest('sendMessage', ['chat_id' => $id, 'text' => $currency_list]);
    }
}