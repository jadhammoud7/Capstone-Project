<?php

include("connection.php");

if(isset($_POST["first_name"]) && $_POST["first_name"] != ""){
    $first_name = $_POST["first_name"];}
else{
    die("ALERT first_name");
}

if(isset($_POST["last_name"]) && $_POST["last_name"] != ""){
    $last_name = $_POST["last_name"];
}
else{
    die("ALERT last_name");
}

if(isset($_POST["email"]) && $_POST["email"] != ""){
    $email = $_POST["email"];}
else{
    die("ALERT email");
}

if(isset($_POST["date_of_birth"]) && $_POST["date_of_birth"] != ""){
    $date_of_birth = $_POST["date_of_birth"];
}
else{
    die("ALERT date_of_birth");
}

if(isset($_POST["phone_number"]) && $_POST["phone_number"] != ""){
    $phone_number = $_POST["phone_number"];
}
else{
    die("ALERT phone_number");
}

if(isset($_POST["address"]) && $_POST["address"] != ""){
    $address = $_POST["address"];
}
else{
    die("ALERT address");
}

if(isset($_POST["username"]) && $_POST["username"] != ""){
    $username = $_POST["username"];
}
else{
    die("ALERT username");
}

if(isset($_POST["password"]) && $_POST["password"] != ""){
    $password = hash("sha256", $_POST["password"]);
}
else{
    die("ALERT password");
}

$mysql = $connection->prepare("INSERT INTO customers(first_name, last_name, email, date_of_birth, phone_number, address, username, password) VALUES (?,?,?,?,?,?,?,?)");
$mysql->bind_param("ssssssss", $first_name, $last_name, $email, $date_of_birth, $phone_number, $address, $username, $password);
$mysql->execute();
$mysql->close();
header("Location:../home-page/home-page.php");
?>