<?php

class Currency
{
    const CURRENCY_API_URL = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/";
    public $ch;
    public $output;
    public array $currencies = [];

    public function __construct()
    {
        $this->ch = curl_init();

        curl_setopt($this->ch, CURLOPT_URL, self::CURRENCY_API_URL);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);

        $this->output = curl_exec($this->ch);

        curl_close($this->ch);

        $this->currencies = json_decode($this->output);
    }

    public function getCurrenciesInfo()
    {
        return $this->currencies;
    }

    public function getCurrencies()
    {
        $separated_data = [];

        $currencies_info = $this->getCurrenciesInfo();

        foreach ($currencies_info as $currency) {
            $separated_data[$currency->Ccy] = $currency->Rate;
        }

        return $separated_data;
    }

    public function exchange($value, $ccy, $ccy2)
    {
        if ($ccy == 'UZS') {
            $exchanged = round($value / $this->getCurrencies()[$ccy2]);
            return [$value, $ccy, $ccy2, $exchanged];
        } else {
            $exchanged = round($value * $this->getCurrencies()[$ccy]);
            return [$value, $ccy, $ccy2, $exchanged];
        }
    }
}
