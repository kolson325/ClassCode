<!DOCTYPE html>
<html>
<head>
    <title>Log In To OptiFit Portal</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <div class="container"> 
        <header>
            <h1>Welcome to OptiFit!</h1>
            <a href="logout.php" class="logout-button">Logout</a> 
        </header>

        <main>
            <h2>Login Below</h2>
            <form action="login.php" method="post">
                <label for="UserId">UserID:</label>
                <input type="text" id="UserId" name="UserId" required>
                <br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <br>
                <button type="submit">Log In</button>
            </form>
            <p style="color: black">Don't have an account? <a href="register.php">Register here</a></p>
        </main>

        <footer>
            <p>&copy; <?php echo date("Y"); ?> OptiFit, Inc. All rights reserved.</p>
        </footer>
    </div>
</body>
</html>

