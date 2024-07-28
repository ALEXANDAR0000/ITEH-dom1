<?php
require_once '../config.php';
require_once '../models/Clan.php';

$clan = new Clan($conn);

// Dodavanje novog člana
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $clan->ime = $_POST['ime'];
    $clan->prezime = $_POST['prezime'];
    $clan->email = $_POST['email'];
    $clan->telefon = $_POST['telefon'];
    $clan->datum_rodjenja = $_POST['datum_rodjenja'];

    if ($clan->create()) {
        echo "Član je uspešno dodat.";
    } else {
        echo "Došlo je do greške prilikom dodavanja člana.";
    }
}

// Ažuriranje člana
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $clan->id = $_POST['id'];
    $clan->ime = $_POST['ime'];
    $clan->prezime = $_POST['prezime'];
    $clan->email = $_POST['email'];
    $clan->telefon = $_POST['telefon'];
    $clan->datum_rodjenja = $_POST['datum_rodjenja'];

    if ($clan->update()) {
        echo "Podaci o članu su uspešno ažurirani.";
    } else {
        echo "Došlo je do greške prilikom ažuriranja podataka o članu.";
    }
}

// Brisanje člana
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $clan->id = $_POST['id'];

    if ($clan->delete()) {
        echo "Član je uspešno obrisan.";
    } else {
        echo "Došlo je do greške prilikom brisanja člana.";
    }
}

// Prikaz svih članova
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['list'])) {
    $result = $clan->read();
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . " - Ime: " . $row['ime'] . " - Prezime: " . $row['prezime'] . "<br>";
    }
}
?>
