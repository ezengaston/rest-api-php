<?php

class Locations
{
    private $conn;
    private $table = 'locations';

    public $id;
    public $location_name;

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
            return $this->location = NULL;
        }

        $this->location_name = $result['location_name'];
    }
}
