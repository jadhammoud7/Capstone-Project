<?php

session_start();

include("connection.php");

$customer_id = $_SESSION['logged_id'];
$first_name = "";
$last_name = "";
$email = "";
$phone_number = "";
$address = "";

if (isset($_POST["firstname_editprofile"])  && $_POST["firstname_editprofile"] != "") {
    $first_name = $_POST["firstname_editprofile"];
}

if (isset($_POST["lastname_editprofile"]) && $_POST["lastname_editprofile"] != "") {
    $last_name = $_POST["lastname_editprofile"];
}

if (isset($_POST["email_editprofile"]) && $_POST["email_editprofile"] != "") {
    $email = $_POST["email_editprofile"];
}

if (isset($_POST["phonenumber_editprofile"]) && $_POST["phonenumber_editprofile"] != "") {
    $phone_number = $_POST["phonenumber_editprofile"];
}

if (isset($_POST["address_editprofile"]) && $_POST["address_editprofile"] != "") {
    $address = $_POST["address_editprofile"];
}

if ($first_name != "") {
    $query1 = $connection->prepare("UPDATE customers SET first_name=? WHERE customer_id='" . $customer_id . "'");
    $query1->bind_param("s", $first_name);
    $query1->execute();
}

if ($last_name != "") {
    $query1 = $connection->prepare("UPDATE customers SET last_name=? WHERE customer_id='" . $customer_id . "'");
    $query1->bind_param("s", $last_name);
    $query1->execute();
}

if ($email != "") {
    $query1 = $connection->prepare("UPDATE customers SET email=? WHERE customer_id='" . $customer_id . "'");
    $query1->bind_param("s", $email);
    $query1->execute();
}

if ($phone_number != "") {
    $query1 = $connection->prepare("UPDATE customers SET phone_number=? WHERE customer_id='" . $customer_id . "'");
    $query1->bind_param("s", $phone_number);
    $query1->execute();
}

if ($address != "") {
    $query1 = $connection->prepare("UPDATE customers SET address=? WHERE customer_id='" . $customer_id . "'");
    $query1->bind_param("s", $address);
    $query1->execute();
}

echo "<script>alert('Your changes are saved'); window.location='../profile/profile.php';</script>";
