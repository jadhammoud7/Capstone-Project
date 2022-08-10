<?php

include("connection.php");

$customer_id = $_SESSION['logged_user'];

if(isset($_POST["comment"]) && $_POST["comment"] != ""){
    $comment = $_POST["comment"];
}
else{
    die("ALERT comment");
}

$mysql = $connection->prepare("INSERT INTO comments(customer_id, comment) VALUES (?,?)");
$mysql->bind_param("is", $customer_id, $comment);
$mysql->execute();

header("Location: ../contatus/contactus.php");
echo "<script>Your comment was well received! Thank you.</script>";

?>