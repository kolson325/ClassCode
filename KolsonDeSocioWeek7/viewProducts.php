   <!--
      Week 7 Assignment

      Author: Kolson DeSocio
      Date:   2-29-24

      Filename: view_products.php
   -->

   <?php
include('db_connect.php');
$queryProducts= 'SELECT * FROM products ORDER BY productID';
$statement= $db->prepare($queryProducts);
$statement->execute();
$products = $statement->fetchAll(); 
$statement->closeCursor();
$msg2='';
$msg3='';
   ?>
   <!DOCTYPE html>
   <html>
   <head>
      <title>Week 7 Assignment</title>
      <link rel="stylesheet" href="main.css" />
      <h1>Week 7 Assignment</h1>
   </head>
   <body>
      <main>
         <h2>Display Static Info</h2>
         <?php foreach ($products as $product) : ?>
         <p><?php echo 'ID: ' . $product['productID'] . ', Name: ' . $product['productName']; ?></p>
      <?php endforeach; ?>
         <h2>Display Categories as List</h2>
         <ul>
            <?php foreach($products as $product){ ?>
               <li><?php echo 'Name: ' . $product['productName'] . ', Code: ' . $product['productCode']; ?></li> 
            <?php } ?>
         </ul>
         <h2>Display Drop-Down</h2>
      <p><?php echo $msg2; ?></p>
      <form action="index.php" method="get">
         <label>Select Product:</label>
         <select name="product_list">
            <?php foreach ($products as $product) : ?>
               <option value="<?php echo $product['productID']; ?>">
                  <?php echo $product['productName']; ?>
               </option>
            <?php endforeach; ?>
         </select>
         <input type="submit" name="action" value="ListSelect"><br>
      </form>
         <h2>Display Table</h2>
         <p><?php echo $msg3; ?>
         <table>
         <tr>
            <th>Product Name</th>
            <th>List Price</th>
            <th></th>
         </tr>
         <?php foreach($products as $product){ ?>
            <tr>
               <td><?php echo $product['productName']; ?></td>
               <td><?php echo $product['listPrice']; ?></td>
               <td>
                  <form action='index.php' method='get'>
                     <input type='hidden' name='prodID' value='<?php echo $product['productID']; ?>'>
                     <input type='submit' name='action' value='TableSelect'>
                  </form>
               </td>
            </tr>
         <?php } ?>
      </table>
      </main>
   </body>
   </html>
