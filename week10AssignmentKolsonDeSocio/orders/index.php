<?php
require_once('../inc/db_connect.php');

$queryOrders = 'SELECT * FROM orders ORDER BY orderID';
$statement = $db->prepare($queryOrders);
$statement->execute();
$orders = $statement->fetchAll();
$statement->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<header><h1>Order List</h1></header>
<main>
    <table>
        <tr>
            <th>OrderID</th>
            <th>CustomerID</th>
            <th>OrderDate</th>
            <th>ShipDate</th>
            <th>CardType</th>
            <th>Card Number</th>
            <th>Card Expiry</th>
            <th>&nbsp;</th>
        </tr>
        <?php foreach ($orders as $order) : ?>
            <tr>
                <td><?php echo $order['orderID']; ?></td>
                <td><?php echo $order['customerID']; ?></td>
                <td><?php echo $order['orderDate']; ?></td>
                <td><?php echo $order['shipDate']; ?></td>
                <td><?php echo $order['cardType']; ?></td>
                <td><?php echo $order['cardNumber']; ?></td>
                <td><?php echo $order['cardExpires']; ?></td>
                <td>
                    <form action="updateOrderForm.php" method="get">
                        <input type="hidden" name="order_id" value="<?php echo $order['orderID']; ?>">
                        <input type="submit" value="Update">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</main>
</body>
</html>