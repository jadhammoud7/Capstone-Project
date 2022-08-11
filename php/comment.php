<?php
session_start();
include("connection.php");

$customer_id = $_SESSION['logged_id'];

if(isset($_POST["comment"]) && $_POST["comment"] != ""){
    $comment = $_POST["comment"];
}
else{
    die("ALERT comment");
}

$mysql = $connection->prepare("INSERT INTO comments(customer_id, comment) VALUES (?,?)");
$mysql->bind_param("is", $customer_id, $comment);
$mysql->execute();

echo '<script>alert("Your commen was well received! Thank you."); window.location = "../contactus/contactus.php"</script>';
