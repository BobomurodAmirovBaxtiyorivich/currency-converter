<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

class Bot
{
    const API_URL = 'https://api.telegram.org/bot';

    private $token = '7776743440:AAFpwjGbihOyYZDhDQCBl-jA7x7KK673PQs';

    public $client;

    public function makeRequest($method, $data = [])
    {
        $this->client = new Client([
            'base_uri' => self::API_URL . $this->token . '/',
            'timeout'  => 2.0,
        ]);

        $request = $this->client->request('POST', $method . '?' . http_build_query($data));

        return $request;
    }
}