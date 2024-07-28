<?php
class Clan {
    private $conn;
    private $table_name = "clanovi";

    public $id;
    public $ime;
    public $prezime;
    public $email;
    public $telefon;
    public $datum_rodjenja;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (ime, prezime, email, telefon, datum_rodjenja) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssss", $this->ime, $this->prezime, $this->email, $this->telefon, $this->datum_rodjenja);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Read
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->get_result();
    }

    // Update
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET ime=?, prezime=?, email=?, telefon=?, datum_rodjenja=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("sssssi", $this->ime, $this->prezime, $this->email, $this->telefon, $this->datum_rodjenja, $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Delete
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Get single clan
    public function getSingle() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $this->ime = $row['ime'];
        $this->prezime = $row['prezime'];
        $this->email = $row['email'];
        $this->telefon = $row['telefon'];
        $this->datum_rodjenja = $row['datum_rodjenja'];
    }
}
?>
