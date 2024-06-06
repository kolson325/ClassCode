<?php
require_once('../inc/db_connect.php');

//validate orders
$orderID = filter_input(INPUT_POST, 'orderID', FILTER_VALIDATE_INT);
$productID = filter_input(INPUT_POST, 'productID', FILTER_VALIDATE_INT);
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

//query listPrice and discountPercent from products
$queryProduct = "SELECT listPrice, discountPercent FROM products WHERE productID = :productID";
$statement = $db->prepare($queryProduct);
$statement->bindValue(':productID', $productID);
$statement->execute();
$product = $statement->fetch();
$statement->closeCursor();


if ($product) {
    $listPrice = $product['listPrice'];
    $discountPercent = $product['discountPercent'];
    $itemPrice = $listPrice - ($listPrice * $discountPercent / 100);
    $discountAmount = $listPrice * $discountPercent / 100;

    //insert query for orderItems
    $queryInsertItem = "INSERT INTO orderItems (orderID, productID, itemPrice, discountAmount, quantity) VALUES (:orderID, :productID, :itemPrice, :discountAmount, :quantity)";
    $statement = $db->prepare($queryInsertItem);
    $statement->bindValue(':orderID', $orderID);
    $statement->bindValue(':productID', $productID);
    $statement->bindValue(':itemPrice', $itemPrice);
    $statement->bindValue(':discountAmount', $discountAmount);
    $statement->bindValue(':quantity', $quantity);
    $statement->execute();
    $statement->closeCursor();

   //adds selected orderID to addOrderItemForm.php header
    header("Location: addOrderItemForm.php?order_id=$orderID");
} else {
    echo "Product not found.";
}

    ?>