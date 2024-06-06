<?php
require_once('../inc/db_connect.php');
//Query all orders for table
$queryOrders = 'SELECT * FROM orders ORDER BY orderID';
$statement1 = $db->prepare($queryOrders);
$statement1->execute();
$orders = $statement1->fetchAll();
$statement1->closeCursor();
?>

<!DOCTYPE html>
<html>
<head>
    <title>My Guitar Shop</title>
    <link rel="stylesheet" type="text/css" href="main.css" />
</head>
<body>
<header><h1>Orders</h1></header>
<main>
    <h1>Order List</h1>
    <h2>Orders</h2>
    <table>
        <tr>
            <th>Order ID</th>
            <th>Customer ID</th>
            <th>OrderDate</th>
            <th>Ship Date</th>
            <th>&nbsp;</th>             
        </tr>
        
        <?php foreach($orders as $order): ?>
        <tr>
            <td><?php echo $order['orderID']; ?></td>
            <td><?php echo $order['customerID']; ?></td>
            <td><?php echo $order['orderDate']; ?></td>
            <td><?php echo $order['shipDate']; ?></td>
            <td>
                <form action="addOrderItemForm.php" method="get">
                    <input type="hidden" name="order_id" value="<?php echo $order['orderID']; ?>">
                    <input type="submit" value="Add/View Order Items">
                </form>
            </td>
        </tr>
        <?php endforeach; ?>

    </table>
    <p><a href="addOrderForm.php">Add Order</a></p>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> My Guitar Shop, Inc.</p>
</footer>
</body>
</html>