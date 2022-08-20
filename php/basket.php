<?php
session_start();

include("connection.php");

$total_price = 0;
$tax_price = 0;
$total_inc_tax = 0;

if (isset($_SESSION['logged_id'])) {
    $customer_id = $_SESSION['logged_id'];
}

//get all products in current user basket
$select_products_stmt = $connection->prepare("SELECT product_id FROM baskets_customer_product WHERE customer_id = '" . $customer_id . "'");
$select_products_stmt->execute();
$select_products_results = $select_products_stmt->get_result();

while ($select_products_row = $select_products_results->fetch_assoc()) {
    $product_id = $select_products_row['product_id'];
    $product_stmt = strval($product_id);
    $quantity_stmt = $product_id.'-quantity';
    //check if user changed quantity for this product
    if (isset($_POST[$quantity_stmt])) {
        $quantity = $_POST[$quantity_stmt];
        //update quantity
        $stmt_update_quantity = $connection->prepare("UPDATE baskets_customer_product SET quantity = ? WHERE product_id = '" . $product_id . "' and customer_id = '" . $customer_id . "'");
        $stmt_update_quantity->bind_param("i", $quantity);
        $stmt_update_quantity->execute();
        //update price
        $stmt_select_product_price = $connection->prepare("SELECT price FROM products WHERE product_id = '" . $product_id . "'");
        $stmt_select_product_price->execute();
        $result_select_product_price = $stmt_select_product_price->get_result();
        $row_select_product_price = $result_select_product_price->fetch_assoc();
        $price = $row_select_product_price['price'];
        $stmt_update_price = $connection->prepare("UPDATE baskets_customer_product SET price = ? WHERE product_id = '" . $product_id . "' AND customer_id = '" . $customer_id . "' ");
        $new_price = $price * $quantity;
        $stmt_update_price->bind_param("i", $new_price);
        $stmt_update_price->execute();
    }
}
//loop over all new prices to update all total prices
$stmt_select_all_prices = $connection->prepare("SELECT price FROM baskets_customer_product WHERE customer_id = '" . $customer_id . "' ");
$stmt_select_all_prices->execute();
$select_prices_results = $stmt_select_all_prices->get_result();
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
header("Location:../basket/basket.php");
