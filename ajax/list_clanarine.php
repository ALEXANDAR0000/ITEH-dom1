<?php
require_once '../config.php';
require_once '../models/Clanarina.php';

$clanarina = new Clanarina($conn);
$result = $clanarina->read();

$clanarine = [];

while ($row = $result->fetch_assoc()) {
    $clanarine[] = $row;
}

echo json_encode($clanarine);
?>
