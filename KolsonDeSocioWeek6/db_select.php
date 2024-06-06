<?php
require_once('db_connect.php');

$queryAllcategories= 'SELECT productID, productName FROM products';
$statement2= $db->prepare($queryAllcategories);
$statement2->execute();//$statement2 is PDOStatement
$products= $statement2->fetchAll();
$statement2->closeCursor();

foreach($products as $product){
    echo "<p>".$product["productID"]." , ".$product["productName"]."</p>";
}
?>