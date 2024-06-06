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
	
	
	$action = filter_input(INPUT_GET, 'action');
	if($action == "Add Entry"){
		 //filter all the attribute values from the textboxes in the form
		//var_dump and check all teh attributes -- just to test
		//validate the inputs
		// to add a row use the statement: $employee_salary[$userId] = array("hourlySalary" => $hourlySalary , "hrsPerWeek" => $hrsPerWeek , "daysPerWeek" => $daysPerWeek );
        //var_dump the array $employee_salary
	}
	
	if($action == "Delete Entry"){
		$userId = filter_input(INPUT_GET, 'userId_list2'); //this is from the drop down list in delete entry form
		
		//var_dump and check  -- just to test
		//validate the input
		// to delete a row use the two statements:
		     //unset($employee_salary[$userId]);
			//$employee_salary = array_values($employee_salary); 
		//var_dump the array $employee_salary
	}
	
	if($action == "Update Entry"){
		$userId = filter_input(INPUT_GET, 'userId_list3');//this is from the 1st drop down list in update entry form
		$subKey = filter_input(INPUT_GET, 'userId_list4'); //this is from the 2nd drop down list in the update etry form
		
		//check to see if($subKey == "hourlySalary"){
		     // set $newValue by filtering from 'attribute' textbox ,  validate accordingly
		//}
		//else if($subKey == "daysPerWeek")   {
			// set $newValue by filtering from 'attribute' textbox ,  validate accordingly
		//}
		//else it must be "hrsPerWeek, so set $newValue by filtering from 'attribute' textbox , filter validate accordingly
		//  then update at the super-key , sub-key location on the array as : 
		       //$employee_salary[$userId][$subKey] = $newValue;
		//var_dump the variables 
		
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
	<div id = "data">
		<table>
		<tr>
		<th>UserID</th>
		<th>Hourly Salary </th>
		<th>Hrs/Week </th>
		<th>Days/Week </th>
		</tr>
		
		
		
		</table>
        </div>

    </div id = "data2">
     </br>
	 </br>
	 </br>
	 

			
		
	</main>
</body>
</html>