<?php
require_once '../config.php';
require_once '../models/Clan.php';

$data = json_decode(file_get_contents("php://input"));

$clan = new Clan($conn);
$clan->ime = $data->ime;
$clan->prezime = $data->prezime;
$clan->email = $data->email;
$clan->telefon = $data->telefon;
$clan->datum_rodjenja = $data->datum_rodjenja;

if ($clan->create()) {
    echo json_encode(["message" => "Član je uspešno dodat."]);
} else {
    echo json_encode(["message" => "Došlo je do greške prilikom dodavanja člana."]);
}
?>
