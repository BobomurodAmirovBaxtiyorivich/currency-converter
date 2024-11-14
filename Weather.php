<?php

class Weather
{
    const CURRENCY_API_URL = "https://api.openweathermap.org/data/2.5/weather?q=Tashkent,Uzbekistan&appid=85f97a056d8c5f1ff72860becb88fed4";
    public $ch;
    public $output;

    public $weather_datas = [];

    public function __construct()
    {
        $this->ch = curl_init();

        curl_setopt($this->ch, CURLOPT_URL, self::CURRENCY_API_URL);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

        $this->output = curl_exec($this->ch);

        curl_close($this->ch);

        $this->weather_datas = json_decode($this->output);
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