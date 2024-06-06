<?php
session_start(); 

unset($_SESSION['user']);
$errorMsg = ""; 
$status = session_status();
$isUser = false;
if ($status == PHP_SESSION_NONE) {
    // There is no active session
    session_start();
}

$_SESSION['user'] = array();

if (empty($_SESSION['user'])) {
    $_SESSION['user']['abc123'] = array("password" => "pass1", "userType" => "admin");
    $_SESSION['user']['efg123'] = array("password" => "pass2", "userType" => "employee");
    $_SESSION['user']['hjk123'] = array("password" => "pass3", "userType" => "admin");
    $_SESSION['user']['mnb123'] = array("password" => "pass4", "userType" => "employee");
    $_SESSION['user']['xyz123'] = array("password" => "pass5", "userType" => "client");
    $_SESSION['user']['bbn123'] = array("password" => "pass6", "userType" => "client");
}

if (isset($_GET['UserId']) && isset($_GET['password'])) {
    $UserId = $_GET['UserId'];
    $password = $_GET['password'];

    if (isset($_SESSION['user'][$UserId]) && $_SESSION['user'][$UserId]['password'] === $password) {
        $_SESSION['UserId'] = $UserId;
		$_SESSION['userType'] = $_SESSION['user'][$UserId]['userType'];
		$isUser = true;
    } else {
        $errorMsg = "Invalid UserId or password. Please try again.";
    }
}

//first, initialize the $_SESSION array 
	//create an empty $_SESSION array if there is none
	
//lets now load a test array of userId , password and user type
	
	
	//var_dump($_SESSION['user']);


//filter inputs


//initialize error msg


//check/validate userID and password combination by looping and checking the session array. IF validation fails display the login form

	

    


?>

<!DOCTYPE html>
<html>
<head>
    <title>Log In To Employee Salary Portal</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <main>
        <?php if ($isUser) { ?>
            <div id="data">
                <h3>Welcome to the employee portal. You are logged in.</h3>
				
				<form action="user_display.php" method="get">
                    <button type="submit">Get Info</button>
                </form> 
            </div>
        <?php } else { ?>  
            <h1>Login</h1>
            <?php if (!empty($errorMsg)){ ?>
                <p style="color:red;"><?php echo $errorMsg; ?></p>
            <?php } ?>
            <form action="login.php" method="get">
                <label for="UserId">UserId:</label>
                <input type="text" id="UserId" name="UserId">
                <br>
                <label for="password">Password:</label>
                <input type="text" id="password" name="password"> 
                <br>
                <button type="submit">Log In</button>
            </form>
        <?php } ?>
    </main>
</body>
</html>