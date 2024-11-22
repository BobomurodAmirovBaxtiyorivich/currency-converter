<?php

class DB
{
    public $conn;

    public function __construct()
    {
        $this->conn = new PDO("mysql:host=localhost;dbname=bot", "root", 'My$par0l');

        return $this->conn;
    }
}