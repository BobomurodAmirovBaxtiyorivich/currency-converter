<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;

require 'DB.php';

class Bot
{
    const API_URL = 'https://api.telegram.org/bot';

    private string $token = '7776743440:AAFpwjGbihOyYZDhDQCBl-jA7x7KK673PQs';

    public $client;

    public function makeRequest($method, $data = [])
    {
        $this->client = new Client([
            'base_uri' => self::API_URL . $this->token . '/',
            'timeout' => 2.0,
        ]);

        $request = $this->client->request('POST', $method . '?' . http_build_query($data));

        return $request;
    }

    public function save_user(int $id, string $first_name): void
    {
        $conn = new DB();

        $result = $conn->conn->query("SELECT * FROM users");

        $check = true;

        foreach ($result as $row) {
            if ($row['user_id'] == $id) {
                $check = false;
            }
        }

        if ($check) {
            $conn->conn->query("INSERT INTO users (first_name, user_id) VALUES ('$first_name', $id)");
        }
    }
}