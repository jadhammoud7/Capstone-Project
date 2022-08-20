<?php

session_start();

include("connection.php");

if (!isset($_SESSION['logged_bool'])) {
    header("Location: ../login/login.php");
}

function GetContent()
{
    include("connection.php");
    if (isset($_GET['type'])) {
        $query = "SELECT product_id,name, price FROM products WHERE category='";
        $stmt = $connection->prepare($query);
        $stmt->execute();
        $results = $stmt->get_result();
        return $results;
    }
}
