<?php
require_once '../config.php';
require_once '../models/Clanarina.php';

$data = json_decode(file_get_contents("php://input"));

$clanarina = new Clanarina($conn);
$clanarina->clan_id = $data->clan_id;
$clanarina->datum_pocetka = $data->datum_pocetka;
$clanarina->datum_kraja = $data->datum_kraja;
$clanarina->status = $data->status;

if ($clanarina->create()) {
    echo json_encode(["message" => "Članarina je uspešno dodata."]);
} else {
    echo json_encode(["message" => "Došlo je do greške prilikom dodavanja članarine."]);
}
?>
