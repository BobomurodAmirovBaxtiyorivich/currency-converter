<?php

class Bot
{
    const API_URL = 'https://api.telegram.org/bot';

    private $token = '7776743440:AAFpwjGbihOyYZDhDQCBl-jA7x7KK673PQs';

    public function makeRequest($method, $data = []){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, self::API_URL . $this->token . '/' . $method . '?' . http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }
}