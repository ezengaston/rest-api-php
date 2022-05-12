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
}
