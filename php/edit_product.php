<?php

session_start();
include("../php/connection.php");
require('../php/admin_page_php.php');

$product_id = 0;
$product_name = "";
$product_price = 0;
$product_type = "";
$product_category = "";
$product_description = "";
$product_age = "";
$product_inventory = 0;
$product_sales = 0;

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
}
if (isset($_POST['product_name'])) {
    $product_name = $_POST['product_name'];
}

if (isset($_POST['price'])) {
    $product_price = $_POST['price'];
}

if (isset($_POST['type'])) {
    $product_type = $_POST['type'];
}

if (isset($_POST['category'])) {
    $product_category = $_POST['category'];
}

if (isset($_POST['description'])) {
    $product_description = $_POST['description'];
}

if (isset($_POST['age'])) {
    $product_age = $_POST['age'];
}

if (isset($_POST['inventory'])) {
    $product_inventory = $_POST['inventory'];
}

if (isset($_POST['sales_number'])) {
    $product_sales = $_POST['sales_number'];
}

if ($product_id != 0 && $product_name != "" && $product_price != 0 && $product_type != "" && $product_category != "" && $product_description != "" && $product_age != "") {
    if (!empty($_FILES['product_image']['name'])) {
        $target_dir = "../images/";
        $filename = basename($_FILES['product_image']['name']);
        $target_file = $target_dir . $filename;
        $fileType = pathinfo($target_file, PATHINFO_EXTENSION);
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif', 'pdf');
        if (in_array($fileType, $allowTypes)) {
            if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
                $product_image = $filename;
                $stmt_update_product = $connection->prepare("UPDATE products SET name = ?, price = ?, type = ?, category = ?, description = ?, age = ?, image = ?, inventory = ?, sales_number = ? WHERE product_id = ?");
                $stmt_update_product->bind_param("sisssssiii", $product_name, $product_price, $product_type, $product_category, $product_desciption, $product_age, $product_image, $product_inventory, $sales_number, $product_id);
                $stmt_update_product->execute();
                $stmt_update_product->close();
                header("Location: ../product-admin/product-details.php?product-id=$product_id&product-updated=1");
            }
        }
    } else {
        // echo $product_sales;
        $stmt_update_product = $connection->prepare("UPDATE products SET name='" . $product_name . "', price= '" . $product_price . "', type='" . $product_type . "', category='" . $product_category . "', description='" . $product_description . "', age='" . $product_age . "', inventory='" . $product_inventory . "', sales_number='" . $product_sales . "' WHERE product_id='" . $product_id . "'");
        $stmt_update_product->execute();
        $stmt_update_product->close();
        header("Location: ../product-admin/product-details.php?product-id=$product_id&product-updated=1");
    }
}
