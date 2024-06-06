<?php 
    unset($_SESSION['employee_salary']);
    $error_msg = "";
    $status = session_status();
	
    if($status == PHP_SESSION_NONE){ 
        //there is no active session
        session_start();
    }
	$_SESSION['employee_salary'] = array(); // create the empty array for employee salary
    if(empty($_SESSION['employee_salary'])){  //we have a super-super-key called "employee_salary" as our array identifier in the session
        //now create your employee salary starter array like you did before
        
        $_SESSION['employee_salary']["jac2233"] = array("hourlySalary"=> 56.0 , "hrsPerWeek" => 40 , "daysPerWeek" => 5 );
        $_SESSION['employee_salary']["abc4530"] = array("hourlySalary"=> 78.78 , "hrsPerWeek" => 32 , "daysPerWeek" => 4 ); 
        $_SESSION['employee_salary']["ghj1238"] = array("hourlySalary"=> 34.56 , "hrsPerWeek" => 20 , "daysPerWeek" => 4 ); 
        
        //put this $employee_salary into the session array:
   
        var_dump($_SESSION['employee_salary']); // test to see if array is populated
       
    }
	var_dump($_SESSION['employee_salary']);
	//var_dump($_SESSION['userId']);
    $action = filter_input(INPUT_GET, 'action');

    if ($action == "Add Entry") {
        
        $userId = filter_input(INPUT_GET, 'userId_txt1');
        $hourlySalary = filter_input(INPUT_GET, 'hourlySalary_txt1', FILTER_VALIDATE_FLOAT);
        $hrsPerWeek = filter_input(INPUT_GET, 'hrsPerWeek_txt1', FILTER_VALIDATE_INT);
        $daysPerWeek = filter_input(INPUT_GET, 'daysPerWeek_txt1', FILTER_VALIDATE_INT);

        
        if (empty($userId)) {
            $error_msg .= "User ID cannot be empty. ";
        } elseif (array_key_exists($userId, $_SESSION['employee_salary'])) {
            $error_msg .= "User ID already exists. ";
        }
        if ($hourlySalary === false || $hourlySalary >= 1000) {
            $error_msg .= "Hourly salary must be numeric and less than 1000. ";
        }
        if ($hrsPerWeek === false || $hrsPerWeek > 100) {
            $error_msg .= "Hours per week should not exceed 100. ";
        }
        if ($daysPerWeek === false || $daysPerWeek > 7) {
            $error_msg .= "Days per week should not exceed 7. ";
        }

        
        if (empty($error_msg)) { 
            $_SESSION['employee_salary'][$userId] = array(
				"hourlySalary" => $hourlySalary, 
                "hrsPerWeek" => $hrsPerWeek,
                "daysPerWeek" => $daysPerWeek
            );
        }
       
    }


    if ($action == "Delete Entry") {
        
        $userId = filter_input(INPUT_GET, 'userId_txt3');

        if (empty($userId)) {
            $error_msg .= "User ID cannot be empty. "; 
        } elseif (!array_key_exists($userId, $_SESSION['employee_salary'])) {
            $error_msg .= "User ID does not exist. "; 
        }

       
        if (empty($error_msg)) { 
            unset($_SESSION['employee_salary'][$userId]); 
        }
    }

/*In week 3 asisgnments you had created a sample array called $employee_salary
	This array was created each time you ran this page.
	This array was non-persistent - it couldn't save the changes beyond a button click
	This is how you had created the 2D array
	
    $employee_salary = array();
	$employee_salary["jac2233"] = array("hourlySalary"=> 56.0 , "hrsPerWeek" => 40 , "daysPerWeek" => 5 );
	$employee_salary["abc4530"] = array("hourlySalary"=> 78.78 , "hrsPerWeek" => 32 , "daysPerWeek" => 4 );
	$employee_salary["ghj1238"] = array("hourlySalary"=> 34.56 , "hrsPerWeek" => 20 , "daysPerWeek" => 4 );*/
	
	
	/*In week 4 assignment, we will make the $employee_Salary persistent by putting in a session
	We will add the contents of the 2D array into a $_SESSION array
	We will identify our 2D array ($employee_salary ) with the $_SESSION array using a special key
	So now we have a $_SESSION array --- this carried the $employee_salary array--which in turn,
	carries the associative array that consititutes its elemets.
	We now have a complex array at various levels $_SESSION, in which you have the $_employee_salary, in which you have 
	the associative arrays that forms the rows of $employee_salary.*/
	
	//first, initialize the $_SESSION array create an empty $_SESSION array : $_SESSION['employee salary2D'] if there is none
	
	//second, initialize an entry in the $_SESSION array- this will be the space for your 2D employee_salary array
	
	
	
	
    // filter the value of button called action :  $action = filter_input(INPUT_GET, 'action');
	
	/*write if condition to check if the action is equal to "Add Entry"
      {
		//filter all the attribute values from the textboxes in the form
		//var_dump and check all teh attributes -- just to test
		//validate the inputs
		// to add a row use the statement: $_SESSION['employee salary2D'][$userId] = array("hourlySalary" => $hourlySalary , "hrsPerWeek" => $hrsPerWeek , "daysPerWeek" => $daysPerWeek );
       
	}*/
	
	
	/*write if condition to check if the action is equal to "Delete Entry"
		
		//filter the userId attribute values from the textboxe in the form
		//var_dump and check  -- just to test
		//validate the input
		// to delete a row use the two statements:
		     //unset($_SESSION['employee salary'][$userId]);
			

	*/
	?>
<!DOCTYPE html>
<html>
<head>
    <title>Employee Salary Portal</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
    <h1>Employee Salary</h1>
    <div id = "data">
        <table>
        <tr>
        <th>UserID</th>
        <th>Hourly Salary </th>
        <th>Hrs/Week </th>
        <th>Days/Week </th>
        </tr>
        
        <?php foreach($_SESSION['employee_salary'] as $userId => $salaryAttributes) { ?>
                <tr>
                    <td><?php echo $userId; ?></td>
                    <td><?php echo '$'.number_format($salaryAttributes["hourlySalary"], 2); ?></td>
                    <td><?php echo $salaryAttributes["hrsPerWeek"]; ?></td>    
                    <td><?php echo $salaryAttributes["daysPerWeek"]; ?></td>    
                </tr>
		<?php } ?>
        
        </table>
        </div>
        
        <h3><?php echo $error_msg; ?></h3> 
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