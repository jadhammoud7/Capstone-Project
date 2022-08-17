<?php

session_start();

include("connection.php");

if(isset($_GET['customerID']) && $_GET['customerID'] != ""){
    $customer_id = $_GET['customerID'];
    $select_customer = $connection->prepare("SELECT first_name, last_name, email, phone_number FROM customers WHERE customer_id = '" . $customer_id . "'");
    $select_customer->execute();
    $select_customer_results = $select_customer->get_result();
    $row_customer = $select_customer_results->fetch_assoc();
    $_SESSION['first_name'] = $row_customer['first_name'];
    $_SESSION['last_name'] = $row_customer['last_name'];
    $_SESSION['email'] = $row_customer['email'];
    $_SESSION['phone_number'] = $row_customer['phone_number']; 
}

if(isset($_POST['first_name']) && $_POST['first_name'] != ""){
    $first_name = $_POST['first_name'];
    $_SESSION['first_name'] = $first_name;
    for($i = 0; $i < strlen($first_name); $i++){
        if(is_numeric($first_name[$i])){
            $_SESSION['first_name_error'] = "First Name should not contain numbers";
            header("Location: ../checkout/checkout.php");
            die("WRONG first name");
        }
    }
}

if(isset($_POST['last_name']) && $_POST['last_name'] != ""){
    $last_name = $_POST['last_name'];
    $_SESSION['last_name'] = $last_name;
    for($i = 0; $i < strlen($last_name); $i++){
        if(is_numeric($last_name[$i])){
            $_SESSION['last_name_error'] = "Last Name should not contain numbers";
            header("Location: ../checkout/checkout.php");
            die("WRONG last name");
        }
    }
}

if(isset($_POST['email']) && $_POST['email'] != ""){
    $email = $_POST['email'];
    $_SESSION['email'] = $email;
    if(!str_contains($email, ".com") && !str_contains($email, "@")){
        $_SESSION['email_error'] = "Email is invalid";
        header("Location: ../checkout/checkout.php");
        die("WRONG email");
    }
}

if (isset($_POST["phone_number"]) && $_POST["phone_number"] != "") {
    $phone_number = $_POST["phone_number"];
    $_SESSION['phone_number'] = $phone_number;
}

if(isset($_POST['shipping_country']) && $_POST['shipping_country'] != ""){
    $shipping_country = $_POST['shipping_country'];
    $_SESSION['shipping_country'] = $shipping_country;
    if(strlen($shipping_country) < 3 || strlen($shipping_country) > 30 || str_contains($shipping_country, ",")){
        $_SESSION['shipping_country_error'] = "Country invalid";
        header("Location: ../checkout/checkout.php");
        die("WRONG shipping country");
    }
}

if(isset($_POST['shipping_location']) && $_POST['shipping_location'] != ""){
    $shipping_location = $_POST['shipping_location'];
    $_SESSION['shipping_location'] = $shipping_location;
    if(strlen($shipping_location) < 10 && !str_contains($shipping_location, ",")){
        $_SESSION['shipping_location_error'] = "Shipping Location should be brief, should be of size 10 minimum and contain \",\" ";
        header("Location: ../checkout/checkout.php");
        die("WRONG shipping location");
    }
}

if(isset($_POST['shipping_company'])){
    if($_POST['shipping_company'] == ''){
        $shipping_company = "none";
    }
    else{
        $shipping_company = $_POST['shipping_company'];
        $_SESSION['shipping_company'] = $shipping_company;
    }
}

if(isset($_POST['postcode']) && $_POST['postcode'] != ""){
    $postcode = $_POST['postcode'];
    $_SESSION['postcode'] = $postcode;
    if(strlen($postcode) < 5 && strlen($postcode) > 7){
        $_SESSION['postcode_error'] = "Postcode is invalid. Should be of lenght between 5 and 7.";
        header("Location: ../checkout/checkout.php");
        die("WRONG postcode");
    }
}

if(isset($_POST['order_notes'])){
    if($_POST['order_notes'] == ''){
        $order_notes = "none";
    }
    else{
        $order_notes = $_POST['order_notes'];
    }
}

$mysql = $connection->prepare("INSERT INTO checkouts(first_name, last_name, email, phone_number, shipping_country, shipping_location, shipping_company, postcode, order_notes) VALUES (?,?,?,?,?,?,?,?,?)");
$mysql->bind_param("sssssssss", $first_name, $last_name, $email, $phone_number, $shipping_country, $shipping_location, $shipping_company, $postcode, $order_notes);
$mysql->execute();
$mysql->close();

function checkout_products_connection($name, $quantity, $price){
    $element = "
    <tr>
        <td>$name</td>
        <td>$quantity</td>
        <td>$price$</td>
    </tr>";

    echo $element;
}

?>
