<?php
require_once('../inc/db_connect.php');

//validate
$customerID = filter_input(INPUT_POST, 'customerEmail', FILTER_VALIDATE_INT);
$cardType = filter_input(INPUT_POST, 'card_type', FILTER_VALIDATE_INT);
$cardNumber = filter_input(INPUT_POST, 'card_number', FILTER_VALIDATE_INT);
$cardExpires = filter_input(INPUT_POST, 'card_expires');
$orderDate = date("Y-m-d H:i:s");
//shipAmount and taxAmount cannot be null values
$shipAmount = 10.00;
$taxAmount = 0.00;

//query all customers
$queryCustomerID = 'SELECT * FROM customers
                    WHERE customerID = :customerID';
$statement1 = $db->prepare($queryCustomerID);
$statement1->bindValue(':customerID', $customerID);
$statement1->execute();
$customer = $statement1->fetch();
$statement1->closeCursor();

//shipAddress and billingAddress from customer array
$shipAddress = $customer['shipAddressID'];
$billingAddress = $customer['billingAddressID'];


if ($customerID == null || $customerID == false 
|| $cardType == null || $cardType == false 
|| $cardNumber == null || $cardNumber == false
|| $cardExpires == null || $cardExpires == false) {
    $error = "Invalid order. Try again.";
    echo $error;
}
//insert query without shipDate as that should be null
$queryInsertOrders = 'INSERT INTO orders
    (customerID, orderDate, shipAddressID, billingAddressID, cardType, cardNumber, cardExpires, shipAmount, taxAmount)
    VALUES
    (:customerID, :orderDate, :shipAddress, :billingAddress, :cardType, :cardNumber, :cardExpires, :shipAmount, :taxAmount)';
$statement = $db->prepare($queryInsertOrders);
$statement->bindValue(':customerID', $customerID);
$statement->bindValue(':orderDate', $orderDate);
$statement->bindValue(':shipAddress', $shipAddress);
$statement->bindValue(':billingAddress', $billingAddress);
$statement->bindValue(':cardType', $cardType);
$statement->bindValue(':cardNumber', $cardNumber);
$statement->bindValue(':cardExpires', $cardExpires);
$statement->bindValue(':shipAmount', $shipAmount);
$statement->bindValue(':taxAmount', $taxAmount);
$statement->execute();
$statement->closeCursor();

echo 'Order added successfully.';
include('index.php');


?>