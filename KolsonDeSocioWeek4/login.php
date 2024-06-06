<?php
session_start();
?>
    
<!DOCTYPE html>
<html>
<head>
    <title>Log In To Employee Salary Portal</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <main>
    <h1>Login</h1>
    <form action="display_login.php" method="get">
        <label for="UserId">UserId:</label>
        <input type="text" id="UserId" name="UserId">
        <br>
        <label for="password">Password:</label>
        <input type="text" id="password" name="password">
        <br>
        <button type="submit">Log In</button>
	
	</main>
</body>
</html>