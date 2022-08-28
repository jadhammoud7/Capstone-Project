<?php

session_start();
include("connection.php");

if (isset($_GET['productID']) && isset($_SESSION['logged_id'])) {
    $customer_id = $_SESSION['logged_id'];
    $product_id = $_GET['productID'];
    $delete_stmt = $connection->prepare("DELETE FROM baskets_customer_product WHERE product_id = '" . $product_id . "' AND customer_id = '" . $customer_id . "' ");
    $delete_stmt->execute();
    echo "<script>window.location.href = '../basket/basket.php?remove_product=true';</script>";
}

$stmt_select_all_prices = $connection->prepare("SELECT price FROM baskets_customer_product WHERE customer_id = '" . $customer_id . "' ");
$stmt_select_all_prices->execute();
$select_prices_results = $stmt_select_all_prices->get_result();

if ($select_prices_results == false) {
    unset($_SESSION['total_price']);
    unset($_SESSION['tax_price']);
    unset($_SESSION['total_price_including_tax']);
} else {
    //sum all prices in basket
    while ($row_select_prices = $select_prices_results->fetch_assoc()) {
        $total_price = $total_price + $row_select_prices['price'];
    }
    //tax is 10% total price
    $tax_price = $total_price * 0.1;

    $total_inc_tax = $total_price + $tax_price;

    $_SESSION['total_price'] = $total_price;
    $_SESSION['tax_price'] = $tax_price;
    $_SESSION['total_price_including_tax'] = $total_inc_tax;
}
