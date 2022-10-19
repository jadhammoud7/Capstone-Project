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
if (isset($_POST["city_editprofile"]) && $_POST["city_editprofile"] != "") {

    $city = $_POST["city_editprofile"];
    $city1 = "";
    $city1 = strtolower($city);
}


if ($first_name != "") {
    $stmt_update_first_name = $connection->prepare("UPDATE customers SET first_name=? WHERE customer_id='" . $customer_id . "'");
    $stmt_update_first_name->bind_param("s", $first_name);
    $stmt_update_first_name->execute();
}

if ($last_name != "") {
    $stmt_update_last_name = $connection->prepare("UPDATE customers SET last_name=? WHERE customer_id='" . $customer_id . "'");
    $stmt_update_last_name->bind_param("s", $last_name);
    $stmt_update_last_name->execute();
}

if ($email != "") {
    $stmt_update_email = $connection->prepare("UPDATE customers SET email=? WHERE customer_id='" . $customer_id . "'");
    $stmt_update_email->bind_param("s", $email);
    $stmt_update_email->execute();
}

if ($phone_number != "") {
    $stmt_update_phone_number = $connection->prepare("UPDATE customers SET phone_number=? WHERE customer_id='" . $customer_id . "'");
    $stmt_update_phone_number->bind_param("s", $phone_number);
    $stmt_update_phone_number->execute();
}

if ($address != "") {
    $stmt_update_address = $connection->prepare("UPDATE customers SET address=? WHERE customer_id='" . $customer_id . "'");
    $stmt_update_address->bind_param("s", $address);
    $stmt_update_address->execute();
}
if ($city1 != "") {
    $stmt_update_city = $connection->prepare("UPDATE customers SET city=? WHERE customer_id='" . $customer_id . "'");
    $stmt_update_city->bind_param("s", $city1);
    $stmt_update_city->execute();
}


if ($_FILES['customer_image']['name'] != "") {
    $stmt_select_username = $connection->prepare("SELECT username FROM customers WHERE customer_id = '" . $customer_id . "'");
    $stmt_select_username->execute();
    $result_username = $stmt_select_username->get_result();
    $row_username = $result_username->fetch_assoc();

    $target_dir = '../images/' . $row_username['username'] . '/';
    $filename = basename($_FILES['customer_image']['name']);
    $target_file = $target_dir . $filename;
    $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES['customer_image']['tmp_name'], $target_file)) {
            $customer_image = $filename;
            $stmt_update_customer_image = $connection->prepare("UPDATE customers SET customer_image=? WHERE customer_id='" . $customer_id . "'");
            $stmt_update_customer_image->bind_param("s", $customer_image);
            $stmt_update_customer_image->execute();
        }
    }
}

echo "<script>window.location='../profile/profile.php?edit_profile=true'; OpenEditProfilePopUp();</script>";
