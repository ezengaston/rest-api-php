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

    public function getSingle()
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(':id', $this->id);

        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result == false) {
            return $this->name = NULL;
        }

        $this->name = $result['name'];
        $this->email = $result['email'];
        $this->location_id = $result['location_id'];
    }
}
