   <!--
      Week 7 Assignment

      Author: Kolson DeSocio     
      Date: 2-29-24   

      Filename: index.php
   -->
<?php 
require_once('db_connect.php'); //This calls the db_connect code - connects to database


$queryAllproducts = 'SELECT * FROM products ORDER BY productID';
$statement2 = $db->prepare($queryAllproducts);
$statement2->execute();
$products = $statement2->fetchAll();
$statement2->closeCursor();



$action = filter_input(INPUT_GET, 'action');
$msg2 = '';
$msg3 = '';

/*If conditions based on $action */
if ($action == 'TableSelect') {
   $prodID = filter_input(INPUT_GET, 'prodID', FILTER_VALIDATE_INT);
  
   $msg3 = "Selected Product ID: " . $prodID;
}else {
   $msg3 = "Invalid product selected.";
}

if ($action == 'ListSelect') {
   $selectedProductId = filter_input(INPUT_GET, 'product_list', FILTER_VALIDATE_INT);
   if ($selectedProductId) {
       $msg2 = "Selected Product ID from Dropdown: " . $selectedProductId;
   }else {
      $msg2 = "Invalid product selected.";
  }
}
?>

<!DOCTYPE html>
<html>
<head></head>
    <title>Week 7 Assignment</title>
    <link rel="stylesheet" href="main.css" />
    <body>
   <main>

<?php include('viewProducts.php'); ?>
</body>
</html>