<?php

require_once('../inc/db_connect.php');


$orderID = filter_input(INPUT_GET, 'orderID', FILTER_VALIDATE_INT);
$productID = filter_input(INPUT_GET, 'productID', FILTER_VALIDATE_INT);
$itemPrice = filter_input(INPUT_GET, 'itemPrice', FILTER_VALIDATE_FLOAT);
$discountAmount = filter_input(INPUT_GET, 'discountAmount', FILTER_VALIDATE_FLOAT);
$quantity = filter_input(INPUT_GET, 'quantity', FILTER_VALIDATE_INT);


$errors = '';
if ($orderID === null || $orderID === false) {
    $errors = "Invalid order ID.";
}
if ($productID === null || $productID === false) {
    $errors = "Invalid product ID.";
}
if ($itemPrice === null || $itemPrice === false) {
    $errors = "Invalid item price.";
}
if ($discountAmount === null || $discountAmount === false) {
    $errors = "Invalid discount amount.";
}
if ($quantity === null || $quantity === false) {
    $errors = "Invalid quantity.";
}

if (empty($errors)) {
    $query = "UPDATE orderItems SET itemPrice = :itemPrice, discountAmount = :discountAmount, quantity = :quantity WHERE orderID = :orderID AND productID = :productID";
    $statement = $db->prepare($query);
    $statement->bindValue(':orderID', $orderID);
    $statement->bindValue(':productID', $productID);
    $statement->bindValue(':itemPrice', $itemPrice);
    $statement->bindValue(':discountAmount', $discountAmount);
    $statement->bindValue(':quantity', $quantity);
    $statement->execute();
    $statement->closeCursor();
    
 
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Order Item Updated</title>
        <link rel="stylesheet" type="text/css" href="main.css">
    </head>
    <body>
        <h1>Order Item Successfully Updated</h1>
        <p>The order item has been successfully updated.</p>
        <p><a href="index.php">Back to Orders</a></p>
    </body>
    </html>
    <?php
} else {
   
    echo $errors . "<br/>";
}
?>