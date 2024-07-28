<?php
require_once '../config.php';
require_once '../models/Clan.php';

$clan = new Clan($conn);
$result = $clan->read();

$clanovi = [];

while ($row = $result->fetch_assoc()) {
    $clanovi[] = $row;
}

echo json_encode($clanovi);
?>
