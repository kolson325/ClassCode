<?php 
// In week 3 assignments, you created a sample array called $employee_salary
// This array was non-persistent - it couldn't save changes beyond a button click
// Here's how you initially created the array:
/*
$employee_salary = array();
$employee_salary["jac2233"] = 56.0;
$employee_salary["abc4530"] = 78.78;
$employee_salary["ghj1238"] = 34.56;
*/

// In week 4 assignment, we will make $employee_salary persistent by using a session
// We will add the contents of the $employee_salary array into a $_SESSION array
// This way, $_SESSION now carries $employee_salary, which in turn contains the associative array.

// First, initialize the $_SESSION array if it hasn't been already
unset($_SESSION['employee_salary']);
$status = session_status();
if($status == PHP_SESSION_NONE){ 
    session_start();
}
$_SESSION['employee_salary'] = array();// Create the empty array for employee salary
// Second, initialize an entry in the $_SESSION array for employee_salary
if(empty($_SESSION['employee_salary'])){ // Use "employee_salary" as our array identifier in the session
    
    
    // Create your employee salary starter array like you did before
    $_SESSION['employee_salary']["jac2233"] = 56.0;
    $_SESSION['employee_salary']["abc4530"] = 78.78;
    $_SESSION['employee_salary']["ghj1238"] = 34.56;
    
    // Test to see if array is populated
    var_dump($_SESSION['employee_salary']);
}

// Get the action -- the common name of all buttons across the forms
$action = filter_input(INPUT_GET, 'action');
$error_msg = ""; // Initialize error message variable correctly

// Switch or route functions based on the value of the action button
if($action == "Add_Entry"){
    $userId = filter_input(INPUT_GET, 'userId_txt1');
    $hourlySalary = filter_input(INPUT_GET, 'hourlySalary_txt1', FILTER_VALIDATE_FLOAT);
    
    if(array_key_exists($userId, $_SESSION['employee_salary'])) {
        $error_msg = "key exists"; 
    } else {
        $_SESSION['employee_salary'][$userId] = $hourlySalary;
    }
    // Test outputs
    var_dump($userId);
    var_dump($hourlySalary);
}

if($action == "Update_Entry"){
    $userId = filter_input(INPUT_GET, 'userId_txt2');
    $hourlySalary = filter_input(INPUT_GET, 'hourlySalary_txt2', FILTER_VALIDATE_FLOAT);
    
    if(array_key_exists($userId, $_SESSION['employee_salary'])) {
        $_SESSION['employee_salary'][$userId] = $hourlySalary;
    } else {
        $error_msg = "key does not exist"; 
    }
    // Test outputs
    var_dump($userId);
    var_dump($hourlySalary);
}

if($action == "Delete_Entry"){
    $userId = filter_input(INPUT_GET, 'userId_txt3');
    if(array_key_exists($userId, $_SESSION['employee_salary'])) {
        unset($_SESSION['employee_salary'][$userId]);
    } else {
        $error_msg = "key does not exist"; 
    }
    // Test output
    var_dump($userId);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Employee Salary Portal</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <main>
    <h1>Employee Salaries</h1>
    <div id="data">
        <table>
            <tr>
                <th>UserID</th>
                <th>Salary</th>
            </tr>
            <?php foreach($_SESSION['employee_salary'] as $userId => $hourlySalary) { ?>
                <tr>
                    <td><?php echo $userId; ?></td>
                    <td><?php echo '$'.number_format($hourlySalary, 2); ?></td>
                </tr>
            <?php } ?>
        </table>
    </div>

    <h1>Add a new entry into the array</h1>
    <h3><?php echo $error_msg; ?></h3> 
    <form action="index_step4.php" method="get">
        <div id="data">
            <label>UserID:</label>
            <input type="text" name="userId_txt1" value="">
            <br>

            <label>Hourly Pay:</label>
            <input type="text" name="hourlySalary_txt1" value="">
            <br>

            <div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" name="action" value="Add_Entry"><br>
            </div>
        </div>
    </form>

    <h1>Update a Salary</h1>
    <h3><?php echo $error_msg; ?></h3> 
    <form action="index_step4.php" method="get">
        <div id="data">
            <label>UserID to update:</label>
            <input type="text" name="userId_txt2" value="">
            <br>

            <label>New Hourly Pay:</label>
            <input type="text" name="hourlySalary_txt2" value="">
            <br>

            <div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" name="action" value="Update_Entry"><br>
            </div>
        </div>
    </form>

    <h1>Delete a Salary</h1>
    <form action="index_step4.php" method="get">
        <div id="data">
            <label>UserID to delete:</label>
            <input type="text" name="userId_txt3" value="">
            <br>

            <div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" name="action" value="Delete_Entry"><br>
            </div>
        </div>
    </form>
    </main>
</body>
</html>