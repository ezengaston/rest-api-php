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

    public function add()
    {
        $query = "INSERT INTO $this->table (name, email, location_id) VALUES (:name, :email, :location_id)";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->location_id = htmlspecialchars(strip_tags($this->location_id));

        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':location_id', $this->location_id);

        if ($stmt->execute()) {
            return true;
        }

        printf('Error: %s.\n', $stmt->error);

        return false;
    }

    public function update()
    {
        $query = "UPDATE $this->table SET name = :name, email = :email, location_id = :location_id WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->location_id = htmlspecialchars(strip_tags($this->location_id));

        $stmt->bindParam(':id', $this->id);
        $stmt->bindParam(':name', $this->name);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':location_id', $this->location_id);

        if ($stmt->execute()) {
            return true;
        }

        printf('Error: %s.\n', $stmt->error);

        return false;
    }

    public function delete()
    {
        $query = "DELETE FROM $this->table WHERE id = :id";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }

        printf('Error: %s.\n', $stmt->error);

        return false;
    }
}
