<?php

require 'src/Bot.php';

require 'Weather.php';

require 'currency.php';

require 'src/DB.php';

require 'src/Users.php';

$db = new DB();

$user = new Users($db->conn);

$weather = new Weather();

$weather_info = $weather->getWeather();

$bot = new Bot();

$currency = new Currency;

$update = json_decode(file_get_contents('php://input'));

$text = $update->message->text;

$id = $update->message->chat->id;

if ($text == '/start') {
    $start = '/weather => shows weather info of the Tashkent
/currencies => show currency info';

    $bot->makeRequest('sendMessage', ['chat_id' => $id, 'text' => $start]);

    $user->store($id);
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