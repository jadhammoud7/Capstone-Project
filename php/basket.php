<?php
session_start();

include("connection.php");

$total_price = 0;
$tax_price = 0;
$total_inc_tax = 0;

if (isset($_GET['productID']) && $_GET['productID'] != "") {
    $product_id = $_GET['productID'];
}
if (isset($_SESSION['logged_id'])) {
    $customer_id = $_SESSION['logged_id'];
}

if(isset($_GET['productBasketID']) && isset($_GET['customerBasketID']) && isset($_GET['quantity'])){
    $product_basket_id = $_GET['productBasketID'];
    $customer_basket_id = $_GET['customerBasketID'];
    $stmt_update_quantity = $connection->prepare("UPDATE baskets_customer_product SET quantity = ? WHERE product_id = '" . $product_basket_id . "' and customer_id = '" . $customer_basket_id ."'");
    $stmt_update_quantity->bind_param("i", $_GET['quantity']);
    $stmt_update_quantity->execute();
    $stmt_select_product_price = $connection->prepare("SELECT price FROM products WHERE product_id = '" . $product_basket_id . "'");
    $stmt_select_product_price->execute();
    $result_select_product_price = $stmt_select_product_price->get_result();
    $row_select_product_price = $result_select_product_price->fetch_assoc();
    $price = $row_select_product_price['price'];
    $stmt_update_price = $connection->prepare("UPDATE baskets_customer_product SET price = ? WHERE product_id = '" . $product_basket_id . "' AND customer_id = '" . $customer_basket_id . "' ");
    $stmt_update_price->bind_param("i", $price * $_GET['quantity']);
    $stmt_update_price->execute();
    header("Location: '../basket/basket.php'");
}


?>
