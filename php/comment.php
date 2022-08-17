<?php
session_start();
include("connection.php");

$customer_id = $_SESSION['logged_id'];

if (isset($_POST["comment"]) && $_POST["comment"] != "") {
    $comment = $_POST["comment"];
} else {
    die("ALERT comment");
}

$query = "SELECT username from customers WHERE customer_id = $customer_id";
$stmt = $connection->prepare($query);
$stmt->execute();
$result = $stmt->get_result();
$data = $result->fetch_assoc();
$username = $data["username"];

$mysql = $connection->prepare("INSERT INTO comments(customer_id,username,comment) VALUES (?,?,?)");
$mysql->bind_param("iss", $customer_id, $username, $comment);
$mysql->execute();

echo '<script>alert("Your comment was well received! Thank you."); window.location = "../contactus/contactus.php";</script>';

?>