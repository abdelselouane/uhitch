<?php

include("../application/core/Database.php");
$db = new database();

$latitude   = $_GET['lat'];
$longitude  = $_GET['lon'];

$rides = $db->searchByLocation($latitude, $longitude);

echo $rides;
