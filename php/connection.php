<?php

$server = "localhost";
$username = "root";
$password = "1807";
$dbname = "newbies_gamers_db";

$connection = new mysqli($server, $username, $password, $dbname);

if ($connection->connect_error) {
    die("Failed connecting to database");
}

?>