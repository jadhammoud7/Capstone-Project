<?php
session_start();
include("../php/connection.php");
$customer_id = $_SESSION['logged_id'];
if (isset($_POST["first_name"])  && $_POST["first_name"] != "") {
    $first_name = $_POST["first_name"];
    $query = $mysqli->prepare("UPDATE customers SET first_name=? WHERE customer_id=$customer_id");
    $query->bind_param("s", $first_name);
    $query->execute();
}
