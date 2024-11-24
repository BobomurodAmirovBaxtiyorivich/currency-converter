<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

class Currency
{
    const CURRENCY_API_URL = "https://cbu.uz/uz/arkhiv-kursov-valyut/json/";
    public $client;
    public $ch;
    public $output;
    public array $currencies = [];

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => self::CURRENCY_API_URL,
            'timeout' => 2.0,
        ]);

        $request = $this->client->request('GET');

        $this->currencies = json_decode($request->getBody()->getContents());
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

    public function exchange($value, $ccy, $ccy2): array|string
    {
        if ($ccy == 'UZS' && $ccy2 != 'UZS') {
            $exchanged = round($value / $this->getCurrencies()[$ccy2]);
            return [$value, $ccy, $ccy2, $exchanged];
        } elseif ($ccy2 == 'UZS' && $ccy != 'UZS') {
            $exchanged = round($value * $this->getCurrencies()[$ccy]);
            return [$value, $ccy, $ccy2, $exchanged];
        } elseif ($ccy == $ccy2) {
            return "2 ta bir xil valyuta convert qilinmaydi !!!";
        } else {
            return "Bu loyiha faqat so'm dan boshqa valyutaga va boshqa valyutadan so'm ga convert qiladi !!!";
        }
    }
}
