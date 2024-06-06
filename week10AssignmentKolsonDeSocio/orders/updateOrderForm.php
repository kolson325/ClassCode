<?php
require_once('../inc/db_connect.php');

$orderID = filter_input(INPUT_GET, 'order_id', FILTER_VALIDATE_INT);
if ($orderID === null || $orderID === false) {
    echo "Invalid order ID.";
    exit;
}

$queryOrder = 'SELECT * FROM orders WHERE orderID = :orderID';
$statement = $db->prepare($queryOrder);
$statement->bindValue(':orderID', $orderID);
$statement->execute();
$order = $statement->fetch();
$statement->closeCursor();

if (!$order) {
    echo "Order not found.";
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Order</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<header><h1>Order Update Form</h1></header>
<main>
    <h2>Order to Update: <?php echo htmlspecialchars($order['orderID']); ?></h2>
    <form action="updateOrder.php" method="get">
        <input type="hidden" name="orderID" value="<?php echo htmlspecialchars($order['orderID']); ?>">
        <input type="hidden" name="action" value="Update Order">
        <div>
            <label>Customer ID:</label>
            <input type="text" name="customerID" value="<?php echo htmlspecialchars($order['customerID']); ?>">
        </div>
        <div>
            <label>Card Type:</label>
            <input type="text" name="cardType" value="<?php echo htmlspecialchars($order['cardType']); ?>">
        </div>
        <div>
            <label>Card Number:</label>
            <input type="text" name="cardNumber" value="<?php echo htmlspecialchars($order['cardNumber']); ?>">
        </div>
        <div>
            <label>Card Expires:</label>
            <input type="text" name="cardExpires" value="<?php echo htmlspecialchars($order['cardExpires']); ?>">
        </div>
        <div><input type="submit" value="Update Order"></div>
    </form>
    <p><a href="updateOrderItemsForm.php?order_id=<?php echo $orderID ?>">Update Order Items for this order</a></p>
</main>

</body>
</html>
