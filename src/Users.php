<?php

class Users
{
    public $query;
    public $stmt;
    public $conn;

    public function __construct($conn){
        $this->conn = $conn;
    }

    public function select()
    {
        $this->query = "SELECT * FROM users";
        $this->stmt = $this->conn->query($this->query);

        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function store(int $id)
    {
        $info = $this->select();

        $check = false;

        foreach ($info as $key => $value) {
            if ($value['user_id'] == $id) {
                $check = true;
            }
        }

        if ($check == false) {
            $this->query = "INSERT INTO users(user_id) VALUES ($id)";
            $this->stmt = $this->conn->prepare($this->query);
            $this->stmt->execute();
        }
    }
}
