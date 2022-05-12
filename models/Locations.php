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

    public function add()
    {
        $query = "INSERT INTO $this->table (location_name) VALUES (:location_name)";

        $stmt = $this->conn->prepare($query);

        $this->location_name = htmlspecialchars(strip_tags($this->location_name));

        $stmt->bindParam(':location_name', $this->location_name);

        if ($stmt->execute()) {
            return true;
        }

        printf('Error: %s.\n', $stmt->error);

        return false;
    }

    public function update()
    {
        $query = "UPDATE $this->table SET location_name = :location_name WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->location_name = htmlspecialchars(strip_tags($this->location_name));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':location_name', $this->location_name);

        if ($stmt->execute()) {
            return true;
        }

        printf('Error: %s.\n', $stmt->error);

        return false;
    }
}
