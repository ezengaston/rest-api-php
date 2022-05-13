<?php

class Users
{
    private $conn;
    private $table = 'users';

    public $id;
    public $name;
    public $email;
    public $location_id;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT * FROM $this->table";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        return $stmt;
    }
}
