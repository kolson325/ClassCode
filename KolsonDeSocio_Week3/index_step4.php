<?php 
    
	//create a sample array called employee salary
	//use the employee's userId as the array key. We call it a key because it is a string.
	//If the key were an integer, we would call it an index
	//The array value is the employee's hourly salary
	
    $error_message_add = "";
	$error_message_update = "";
	$error_message_delete = "";
    $employee_salary = array();
	$employee_salary["jac2233"] = 56.0;
	$employee_salary["abc4530"] = 78.78;
	$employee_salary["ghj1238"] = 34.56;
    	
	var_dump($employee_salary); // test to see the array and its attributes
	
	/*get the action -- which is the common name of all the buttons across the three forms
	the buttons differ by their value.*/
	$action = filter_input(INPUT_GET, 'action');
	
	//switch, or route functions based on the value of button/action
	
	if ($action == "Add_Entry") {
		$userId = filter_input(INPUT_GET, 'userId_txt1'); //this is from the text box in add entry form
		$hourlySalary = filter_input(INPUT_GET, 'hourlySalary_txt1', FILTER_VALIDATE_FLOAT);//this is from the text box in add entry form
		if (empty($userId)) {
			$error_message_add .= "UserID required. ";
		} elseif ($hourlySalary >= 1000) {
			$error_message_add .= "Hourly Salary must be less than 1000. ";
		} elseif (isset($employee_salary[$userId])) {
			$error_message_add .= "User already exists. ";
		} else {
			$employee_salary[$userId] = $hourlySalary;
		}
		var_dump($userId); // test and see
		var_dump($hourlySalary);//test
		var_dump($employee_salary);
	}
	
	if ($action == "Update_Entry") {
		$userId = filter_input(INPUT_GET, 'userId_txt2'); //this is from the text box in update entry form
		$hourlySalary = filter_input(INPUT_GET, 'hourlySalary_txt2', FILTER_VALIDATE_FLOAT);//this is from the text box in update entry form
		if (empty($userId)) {
			$error_message_update .= "UserID required. ";
		} elseif ($hourlySalary >= 1000) {
			$error_message_update .= "Hourly Salary must be less than 1000. ";
		} elseif (!isset($employee_salary[$userId])) {
			$error_message_update .= "User does not exist. ";
		} else {
			$employee_salary[$userId] = $hourlySalary;
		}
		var_dump($userId); // test and see
		var_dump($hourlySalary);//test
		var_dump($employee_salary);//test
	}
	
	if ($action == "Delete_Entry") {
		$userId = filter_input(INPUT_GET, 'userId_txt3'); //this is from the text box in delete entry form
		if (empty($userId)) {
			$error_message_delete .= "UserID required. ";
		} elseif (!isset($employee_salary[$userId])) {
			$error_message_delete .= "User does not exist. ";
		} else {
			unset($employee_salary[$userId]);
			$employee_salary = array_values($employee_salary);
		}
		var_dump($userId); // test and see
		var_dump($employee_salary);
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
			<?php foreach($employee_salary as $userId => $hourlySalary) { ?>
				<tr>
					<td><?php echo $userId; ?></td>
					<td><?php $hourlySalary_f = '$'.number_format($hourlySalary, 2); echo $hourlySalary_f; ?></td>
				</tr>
			<?php } ?>
		</table>
    </div>
		
   </div id="data2">
	<br><br><br>
    <h1>Add an Salary</h1>
	<h3><?php echo $error_message_add; ?></h3>
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
	    </form>
	 
	 <h1>Update a Salary</h1>
	 <h3><?php echo $error_message_update; ?></h3>
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
	 </form>
	 
	 <h1>Delete a Salary</h1>
	 <h3><?php echo $error_message_delete; ?></h3>
	 <form action="index_step4.php" method="get">
        <div id="data">
            <label>UserID to delete:</label>
            <input type="text" name="userId_txt3" value="">
            <br>
			<div id="buttons">
                <label>&nbsp;</label>
                <input type="submit" name="action" value="Delete_Entry"><br>
            </div>
	 </form>
    </div>	
	</main>
</body>
</html>
