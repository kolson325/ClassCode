<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once('db_connect.php'); 
$errorMsg = "";


$UserId = filter_input(INPUT_POST, 'UserId', FILTER_SANITIZE_STRING);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
if ($UserId !== NULL && $password !== NULL) {
    $query = 'SELECT password, userType FROM Users WHERE UserId = :UserId';
    $statement = $db->prepare($query);
    $statement->bindValue(':UserId', $UserId);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();

    if ($user) {
        if (password_verify($password, $user['password'])) {
            $_SESSION['UserId'] = $UserId;
            $_SESSION['userType'] = $user['userType'];

            if ($_SESSION['userType'] === 'admin') {
                header('Location: adminWorkoutDashboard.php');
                exit;
            } else {
                header('Location: workoutSelection.php');
                exit;
            }
        } else {
            $errorMsg = "Invalid password. Please try again.";
            echo $errorMsg;
        }
    } else {
        $errorMsg = "Invalid UserID.";
        echo $errorMsg;
    }
}
if (!isset($_SESSION['UserId'])) {
    include('login_form.php');
} else {
    echo '<p>You are already logged in.</p>';
    header("Location: workoutSelection.php");
}
?>