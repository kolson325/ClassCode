<?php 
    
    /*create an sample array called employee salary
    use the employee's userId as the array key. We call it a key because it is a string.
    If the key were an integer , we would call it an index
    The array value is now an antire row conistsing of employee's keyed attributes such as
    days worked, hours per week etc 
    We now need an array for each row. This is a 2-D array that resembles a table*/
    
    $employee_salary = array();
    $employee_salary["jac2233"] = array("hourlySalary"=> 56.0 , "hrsPerWeek" => 40 , "daysPerWeek" => 5 );
    $employee_salary["abc4530"] = array("hourlySalary"=> 78.78 , "hrsPerWeek" => 32 , "daysPerWeek" => 4 );
    $employee_salary["ghj1238"] = array("hourlySalary"=> 34.56 , "hrsPerWeek" => 20 , "daysPerWeek" => 4 );
    
    $error_message = "";

    
    $action = filter_input(INPUT_GET, 'action');

    if ($action == "Add Entry") {
        
        $userId = filter_input(INPUT_GET, 'userId_txt1');
        $hourlySalary = filter_input(INPUT_GET, 'hourlySalary_txt1', FILTER_VALIDATE_FLOAT);
        $hrsPerWeek = filter_input(INPUT_GET, 'hrsPerWeek_txt1', FILTER_VALIDATE_INT);
        $daysPerWeek = filter_input(INPUT_GET, 'daysPerWeek_txt1', FILTER_VALIDATE_INT);

        
        if (empty($userId)) {
            $error_message .= "User ID cannot be empty. ";
        } elseif (array_key_exists($userId, $employee_salary)) {
            $error_message .= "User ID already exists. ";
        }
        if ($hourlySalary === false || $hourlySalary >= 1000) {
            $error_message .= "Hourly salary must be numeric and less than 1000. ";
        }
        if ($hrsPerWeek === false || $hrsPerWeek > 100) {
            $error_message .= "Hours per week should not exceed 100. ";
        }
        if ($daysPerWeek === false || $daysPerWeek > 7) {
            $error_message .= "Days per week should not exceed 7. ";
        }

        
        if (empty($error_message)) {
            $employee_salary[$userId] = array(
                "hourlySalary" => $hourlySalary,
                "hrsPerWeek" => $hrsPerWeek,
                "daysPerWeek" => $daysPerWeek
            );
        }
       
    }

    
    if ($action == "Delete Entry") {
        
        $userId = filter_input(INPUT_GET, 'userId_txt3');

        if (empty($userId)) {
            $error_message .= "User ID cannot be empty. ";
        } elseif (!array_key_exists($userId, $employee_salary)) {
            $error_message .= "User ID does not exist. ";
        }

       
        if (empty($error_message)) {
            unset($employee_salary[$userId]);
        }
    }
	

	
// filter the value of button called action :  $action = filter_input(INPUT_GET, 'action');
	
	/*write if condition to check if the action is equal to "Add Entry"
      {
		//filter all the attribute values from the textboxes in the form
		//var_dump and check all teh attributes -- just to test
		//validate the inputs
		// to add a row use the statement: $employee_salary[$userId] = array("hourlySalary" => $hourlySalary , "hrsPerWeek" => $hrsPerWeek , "daysPerWeek" => $daysPerWeek );
        //var_dump the array $employee_salary
	}*/
	
	
	/*write if condition to check if the action is equal to "Delete Entry"
		
		//filter the userId attribute values from the textboxe in the form
		//var_dump and check  -- just to test
		//validate the input
		// to delete a row use the two statements:
		     //unset($employee_salary[$userId]);
			//$employee_salary = array_values($employee_salary); 
		//var_dump the array $employee_salary
	}*/
	
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
        <th>Hourly Salary </th>
        <th>Hrs/Week </th>
        <th>Days/Week </th>
        </tr>
        
        <?php foreach($employee_salary as $userId => $salaryAttributes) { ?>
        <tr>
        <td><?php echo $userId;?></td>
        <td><?php echo '$'.number_format($salaryAttributes["hourlySalary"], 2);?></td>
        <td><?php echo $salaryAttributes["hrsPerWeek"]; ?></td>    
        <td><?php echo $salaryAttributes["daysPerWeek"]; ?></td>    
        </tr>
        <?php } ?>
        
        </table>
    </div>
    <h3><?php echo $error_message; ?></h3>
    <h1>Add a Salary</h1>
    <form action="" method="get">
        <label>UserID:</label>
        <input type="text" name="userId_txt1" value=""><br>
        <label>Hourly Pay:</label>
        <input type="text" name="hourlySalary_txt1" value=""><br>
        <label>Hours per Week:</label>
        <input type="text" name="hrsPerWeek_txt1" value=""><br>
        <label>Days per Week:</label>
        <input type="text" name="daysPerWeek_txt1" value=""><br>
        <input type="submit" name="action" value="Add Entry"><br>
    </form>  
    <h1>Delete a Salary</h1>
    <form action="" method="get">
        <label>UserID to delete:</label>
        <input type="text" name="userId_txt3" value=""><br>
        <input type="submit" name="action" value="Delete Entry"><br>
    </form>
    </main>
</body>
</html>