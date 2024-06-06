<?php
require_once('../inc/db_connect.php');
$orderID = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
//Query order items to add
$queryOrderItems = 'SELECT * FROM orderItems WHERE orderID = :orderID';
$statement = $db->prepare($queryOrderItems);
$statement->bindValue(':orderID', $orderID);
$statement->execute();
$orderItems = $statement->fetchAll();
$statement->closeCursor();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Order Items</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<header><h1>Order Items Add</h1></header>
<main>
    <h2>Order Items to Add for order ID: <?php echo htmlspecialchars($orderID); ?></h2>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Item Price</th>
            <th>Discount Amount</th>
            <th>Quantity</th>

        </tr>
        <?php foreach ($orderItems as $orderItem): ?>
        <tr>
                <td><?php echo htmlspecialchars($orderItem['productID']); ?></td>
                <td><?php echo htmlspecialchars($orderItem['itemPrice']); ?></td>
                <td><?php echo htmlspecialchars($orderItem['discountAmount']); ?></td>
                <td><?php echo htmlspecialchars($orderItem['quantity']); ?></td>
        </tr>
        <?php endforeach; ?>
        </table>
        <form action="addOrderItem.php" method="post">
        <input type="hidden" name="orderID" value="<?php echo $orderID; ?>">
        <label>Product ID:</label>
        <input type="text" name="productID"><br>
        <label>Quantity:</label>
        <input type="number" name="quantity"><br>
        <input type="submit" value="Add Item"><br>
        </form>

    
    <p><a href="index.php">View Orders</a></p>
</main>
</body>
</html>