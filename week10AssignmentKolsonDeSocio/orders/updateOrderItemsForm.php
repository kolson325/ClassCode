<?php
require_once('../inc/db_connect.php');

$orderID = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
if ($orderID === null || $orderID === false) {
    echo "Invalid order ID.";
    exit;
}

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
<header><h1>Order Items Update</h1></header>
<main>
    <h2>Order Items to Update for order ID: <?php echo htmlspecialchars($orderID); ?></h2>
    <table>
        <tr>
            <th>Product ID</th>
            <th>Item Price</th>
            <th>Discount Amount</th>
            <th>Quantity</th>
            <th>Update</th>
        </tr>
        <?php foreach ($orderItems as $orderItem): ?>
        <tr>
            <form action="updateOrderItem.php" method="get">
                <td><?php echo htmlspecialchars($orderItem['productID']); ?></td>
                <td><input type="text" name="itemPrice" value="<?php echo htmlspecialchars($orderItem['itemPrice']); ?>"></td>
                <td><input type="text" name="discountAmount" value="<?php echo htmlspecialchars($orderItem['discountAmount']); ?>"></td>
                <td><input type="text" name="quantity" value="<?php echo htmlspecialchars($orderItem['quantity']); ?>"></td>
                <td>
                    <input type="hidden" name="orderID" value="<?php echo $orderItem['orderID']; ?>">
                    <input type="hidden" name="productID" value="<?php echo $orderItem['productID']; ?>">
                    <input type="submit" value="Update">
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>
    <p><a href="index.php">View Orders</a></p>
</main>
</body>
</html>