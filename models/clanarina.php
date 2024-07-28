<?php
class Clanarina {
    private $conn;
    private $table_name = "clanarine";

    public $id;
    public $clan_id;
    public $datum_pocetka;
    public $datum_kraja;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (clan_id, datum_pocetka, datum_kraja, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isss", $this->clan_id, $this->datum_pocetka, $this->datum_kraja, $this->status);
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
        $query = "UPDATE " . $this->table_name . " SET clan_id=?, datum_pocetka=?, datum_kraja=?, status=? WHERE id=?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("isssi", $this->clan_id, $this->datum_pocetka, $this->datum_kraja, $this->status, $this->id);
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

    // Get single clanarina
    public function getSingle() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id=? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $this->clan_id = $row['clan_id'];
        $this->datum_pocetka = $row['datum_pocetka'];
        $this->datum_kraja = $row['datum_kraja'];
        $this->status = $row['status'];
    }
}
?>
