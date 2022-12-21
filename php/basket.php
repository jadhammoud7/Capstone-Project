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
    $quantity_stmt = $product_id . '-quantity';
    //check if user changed quantity for this product
    if (isset($_POST[$quantity_stmt])) {
        $quantity = $_POST[$quantity_stmt];

        //if quantity is 0 remove from basket
        if ($quantity == 0) {
            $stmt_delete_from_basket = $connection->prepare("DELETE FROM baskets_customer_product WHERE product_id = '"  . $product_id . "' AND customer_id = '" . $customer_id . "'");
            $stmt_delete_from_basket->execute();
        } else {
            //update quantity
            $stmt_update_quantity = $connection->prepare("UPDATE baskets_customer_product SET quantity = ? WHERE product_id = '" . $product_id . "' and customer_id = '" . $customer_id . "'");
            $stmt_update_quantity->bind_param("i", $quantity);
            $stmt_update_quantity->execute();
            //update price
            //check if product is in offer
            $currentDate = (new DateTime())->format('Y-m-d');
            $stmt_select_product_offer = $connection->prepare("SELECT * FROM products_offers WHERE product_id = '" . $product_id . "' AND '" . $currentDate . "' BETWEEN offer_begin_date AND offer_end_date");
            $stmt_select_product_offer->execute();
            $result_select_product_offer = $stmt_select_product_offer->get_result();
            $row_select_product_offer = $result_select_product_offer->fetch_assoc();

            $price = 0;

            //if product not in offer, then select current price
            if (empty($row_select_product_offer)) {
                $stmt_select_product_price = $connection->prepare("SELECT unit_price FROM products WHERE product_id = '" . $product_id . "' ");
                $stmt_select_product_price->execute();
                $result_select_product_price = $stmt_select_product_price->get_result();
                $row_select_product_price = $result_select_product_price->fetch_assoc();
                $price = $row_select_product_price['unit_price'];
            } else {
                //select new price in offer
                $price = $row_select_product_offer['new_price'];
            }

            $stmt_update_price = $connection->prepare("UPDATE baskets_customer_product SET price = ? WHERE product_id = '" . $product_id . "' AND customer_id = '" . $customer_id . "' ");
            $new_price = $price * $quantity;
            $stmt_update_price->bind_param("i", $new_price);
            $stmt_update_price->execute();
        }
    }
}

header("Location:../basket/basket.php");
