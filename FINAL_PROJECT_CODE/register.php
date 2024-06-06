<?php
session_start();
require_once 'db_connect.php';

$userId = $password = $password2 = $userType = '';
$errors = array();


if (isset($_GET['register'])) {
    $userId = filter_input(INPUT_GET, 'userId', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_GET, 'password', FILTER_SANITIZE_STRING);
    $password2 = filter_input(INPUT_GET, 'password2', FILTER_SANITIZE_STRING);
    $userType = filter_input(INPUT_GET, 'userType', FILTER_SANITIZE_STRING);

    if (empty($userId)) {
        $errors['userId'] = 'User ID is required';
        echo $errors['userId'];
    }
    if (empty($password)) {
        $errors['password'] = 'Password is required';
        echo $errors['password'];
    }
    if ($password != $password2) {
        $errors['password2'] = 'Passwords do not match';
        echo $errors['password2'];
    }
    if (empty($errors)) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);


        $query = 'INSERT INTO Users (UserId, password, userType) 
                  VALUES (:UserId, :password, :userType)';
        $statement = $db->prepare($query);
        $statement->bindParam(':UserId', $userId);
        $statement->bindParam(':password', $hashedPassword);
        $statement->bindParam(':userType', $userType);
        
        if ($statement->execute()) {
            echo "Account Created";
            header('Location: login.php');
            exit();
        } else {
            $errors['registration'] = 'Registration failed. Please try again later.';
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Account Registration</title>
    <link rel="stylesheet" type="text/css" href="main.css">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <header><h1>Account Registration</h1></header>

    <main>
        <form method="GET" action="register.php">
            <label for="userId">User ID:</label>
            <input type="text" name="userId" id="userId" value="<?php echo $userId; ?>">
            <br>
            <label for="password">Password:</label>
            <input type="password" name="password" id="password">
            <br>
            <label for="password2">Confirm Password:</label>
            <input type="password" name="password2" id="password2">
            <br>
            <label for="userType">User Type:(User or Admin)</label>
            <input type="text" name="userType" id="userType" value="<?php echo $userType; ?>">
            <br>
            <button type="submit" name="register">Register</button>
        </form>
        <p style="color: black">Already have an account? <a href="login.php">Log in here</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> OptiFit, Inc. All rights reserved.</p>
    </footer>
</body>
</html>
