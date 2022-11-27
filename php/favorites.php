<?php

session_start();

include("connection.php");

if (isset($_SESSION['logged_id'])) {
  $customer_id = $_SESSION['logged_id'];
}

//handle remove from favorites in profile favorites list
if (isset($_GET['productRemoveID'])) {
  $product_id = $_GET['productRemoveID'];
  $delete_stmt = $connection->prepare("DELETE FROM favorites_customer_product WHERE product_id = '" . $product_id . "' AND customer_id = '" . $customer_id . "' ");
  $delete_stmt->execute();
  echo "<script>window.location = '../profile/profile.php';</script>";
}

if (isset($_GET['productID'])) {
  $product_id = $_GET['productID'];
  $select_stmt = $connection->prepare("SELECT product_id FROM favorites_customer_product WHERE product_id = '" . $product_id . "' ");
  $select_stmt->execute();
  $select_results = $select_stmt->get_result();
  $row_select = $select_results->fetch_assoc();

  //check if product added to favorites list before
  if (empty($row_select)) {
    $stmt_add_to_favorites = $connection->prepare("INSERT INTO favorites_customer_product(customer_id, product_id) VALUES (?,?)");
    $stmt_add_to_favorites->bind_param("ii", $customer_id, $product_id);
    $stmt_add_to_favorites->execute();
    $stmt_add_to_favorites->close();
    echo "<script>window.location = '../shop/shop.php?added_to_favorites=true';</script>";
  } else {
    echo "<script>window.location = '../shop/shop.php?found_in_favorites=true';</script>";
  }
}
