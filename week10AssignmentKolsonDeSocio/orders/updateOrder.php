<?php
require_once('../inc/db_connect.php');

$action = filter_input(INPUT_GET, 'action');
if ($action == 'Update Order') {
    $orderID = filter_input(INPUT_GET, 'orderID', FILTER_VALIDATE_INT);
    $customerID = filter_input(INPUT_GET, 'customerID', FILTER_VALIDATE_INT);
    $cardType = filter_input(INPUT_GET, 'cardType');
    $cardNumber = filter_input(INPUT_GET, 'cardNumber');
    $cardExpires = filter_input(INPUT_GET, 'cardExpires');


    $errors = '';
    if ($orderID === false){

     $errors = "Invalid order ID.";
    }
    if ($customerID === false){ 
        $errors = "Invalid customer ID.";
    }
    if (empty($cardType)){

     $errors = "Invalid card type.";
    }
    if (empty($cardNumber)){

     $errors = "Invalid card number.";
    }
    if (empty($cardExpires)) {
        $errors = "Invalid card expiry.";
    }
    if (empty($errors)) {
        $query = 'UPDATE orders SET customerID = :customerID, cardType = :cardType, cardNumber = :cardNumber, cardExpires = :cardExpires WHERE orderID = :orderID';
        $statement = $db->prepare($query);
        $statement->bindValue(':orderID', $orderID);
        $statement->bindValue(':customerID', $customerID);
        $statement->bindValue(':cardType', $cardType);
        $statement->bindValue(':cardNumber', $cardNumber);
        $statement->bindValue(':cardExpires', $cardExpires);
        $statement->execute();
        $statement->closeCursor();
        
    } else {
        
            echo $errors . "<br/>";
        }
    }
include('index.php');
?>