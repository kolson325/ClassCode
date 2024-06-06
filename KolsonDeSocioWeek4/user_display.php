<?php


session_start();
$userType = $_SESSION['userType'];
$userId = $_SESSION['UserId'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Portal</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <main>
        <h1>Welcome to the employee portal</h1>
        <p>Users and User Types</p>

        <?php if ($_SESSION["userType"] == 'admin') { ?>
            <h3>Here are all the employees' userId and their user types</h3>
            <?php 
            
            foreach ($_SESSION['user'] as $id => $userInfo) {
                echo "<p>$id -- {$userInfo['userType']}</p>";
            }
            ?>

        <?php } elseif ($_SESSION["userType"] == 'employee') { ?>
            <h3>Here are the clients:</h3>
            <?php 
            
            foreach ($_SESSION['user'] as $id => $userInfo) {
                if ($userInfo['userType'] == 'client') {
                    echo "<p>$id -- {$userInfo['userType']}</p>";
                }
            }
            ?>

        <?php } elseif ($_SESSION["userType"] == "client") { ?>
            <h3>Welcome to the client portal</h3>
            <p>Please contact your admin: admin@abc.com</p>
        <?php } ?>
    
    </main>
</body>
</html>