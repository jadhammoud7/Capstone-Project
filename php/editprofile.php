<?php
session_start();
include("../php/connection.php");
 $customer_id = $_SESSION['logged_id'];
 if(isset($_POST["firstname_editprofile"])  && $_POST["firstname_editprofile"] != ""){
    $first_name = $_POST["firstname_editprofile"];
}
$query1 = $connection->prepare("UPDATE customers SET first_name=? WHERE customer_id='".$customer_id."'");
$query1->bind_param("s",$first_name);
$query1->execute();
?>
