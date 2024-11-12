<?php

class Currency{
    const CURRENCY_API_URL = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/";
    public $ch;
    public $output;

    public function __construct()
    {
        $this->ch = curl_init();

        curl_setopt($this->ch, CURLOPT_URL, self::CURRENCY_API_URL);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

        $this->output = curl_exec($this->ch);

        curl_close($this->ch);

        $this->output = json_decode($this->output, 1);

        return $this->output;
    }
}

$currency = new Currency;

foreach ($currency->output as $key => $value) {
    print_r($value);
    echo "<br>";
}