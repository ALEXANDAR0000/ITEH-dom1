<?php
require_once '../config.php';
require_once '../models/Clanarina.php';

$clanarina = new Clanarina($conn);

// Dodavanje nove članarine
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $clanarina->clan_id = $_POST['clan_id'];
    $clanarina->datum_pocetka = $_POST['datum_pocetka'];
    $clanarina->datum_kraja = $_POST['datum_kraja'];
    $clanarina->status = $_POST['status'];

    if ($clanarina->create()) {
        echo "Članarina je uspešno dodata.";
    } else {
        echo "Došlo je do greške prilikom dodavanja članarine.";
    }
}

// Ažuriranje članarine
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update'])) {
    $clanarina->id = $_POST['id'];
    $clanarina->clan_id = $_POST['clan_id'];
    $clanarina->datum_pocetka = $_POST['datum_pocetka'];
    $clanarina->datum_kraja = $_POST['datum_kraja'];
    $clanarina->status = $_POST['status'];

    if ($clanarina->update()) {
        echo "Podaci o članarini su uspešno ažurirani.";
    } else {
        echo "Došlo je do greške prilikom ažuriranja podataka o članarini.";
    }
}

// Brisanje članarine
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $clanarina->id = $_POST['id'];

    if ($clanarina->delete()) {
        echo "Članarina je uspešno obrisana.";
    } else {
        echo "Došlo je do greške prilikom brisanja članarine.";
    }
}

// Prikaz svih članarina
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['list'])) {
    $result = $clanarina->read();
    while ($row = $result->fetch_assoc()) {
        echo "ID: " . $row['id'] . " - Član ID: " . $row['clan_id'] . " - Datum početka: " . $row['datum_pocetka'] . " - Datum kraja: " . $row['datum_kraja'] . " - Status: " . $row['status'] . "<br>";
    }
}
?>
