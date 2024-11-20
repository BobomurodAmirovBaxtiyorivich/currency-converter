<?php

require 'src/Bot.php';

require 'Weather.php';

$weather = new Weather();

$weather_info = $weather->getWeather();

$bot = new Bot();

$update = json_decode(file_get_contents('php://input'));

$start = '/weather => shows weather info of the Tashkent';

if ($update->message->text == '/start') {
    var_dump($bot->makeRequest('sendMessage', ['chat_id' => $update->message->chat->id, 'text' => $start]));
} else if ($update->message->text == '/weather') {
    $info = "Temperatur: " . round($weather_info['main']->temp - 273.15, 2) . "°C" . " - " . "Weather: " . $weather_info['weather'][0]->main;

    $info2 = "Click to this url and you can now more info about weather
https://9636-89-236-218-41.ngrok-free.app/currency-converter/views/weatherInfo.php";

    var_dump($bot->makeRequest('sendMessage', ['chat_id' => $update->message->chat->id, 'text' => $info]));

    var_dump($bot->makeRequest('sendMessage', ['chat_id' => $update->message->chat->id, 'text' => $info2]));
}