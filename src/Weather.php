<?php

require_once "vendor/autoload.php";

use GuzzleHttp\Client;

class Weather
{
    const CURRENCY_API_URL = "https://api.openweathermap.org/data/2.5/weather?q=Tashkent,Uzbekistan&appid=85f97a056d8c5f1ff72860becb88fed4";
    public $ch;
    public $output;
    public $client;
    public $weather_datas = [];

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::CURRENCY_API_URL,
            'timeout'  => 2.0,
        ]);

        $request = $this->client->request('GET');

        $this->weather_datas = json_decode($request->getBody()->getContents());
    }

    public function getWeather()
    {
        $separated_datas = [];

        foreach ($this->weather_datas as $key => $value) {
            $separated_datas[$key] = $value;
        }

        return $separated_datas;
    }
}