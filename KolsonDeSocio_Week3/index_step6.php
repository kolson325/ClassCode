<?php 
    	
    
	//create an sample array called employee salary
	//use the employee's userId as the array key. We call it a key because it is a string.
	//If the key were an integer , we would call it an index
	//The array value is the employee's hourly salary
	
    
    $employee_salary = array();
	$employee_salary["jac2233"] = 56.0;
	$employee_salary["abc4530"] = 78.78;
	$employee_salary["ghj1238"] = 34.56;
    	
	var_dump($employee_salary);
	
	$action = filter_input(INPUT_GET, 'action');
	
	
	if($action == "Add_Entry"){
		 $userId = filter_input(INPUT_GET, 'userId_txt1'); //this is from the text box in add entry form
		 $hourlySalary = filter_input(INPUT_GET, 'hourlySalary_txt1', FILTER_VALIDATE_FLOAT);//this is from the text box in add entry form
		//validation code and adidng a new row - code is same as in index_step4.php
	}
	
	if($action == "Update_Entry"){
		 $userId = filter_input(INPUT_GET, 'userId_list1'); //this is from the drop down list in the update entry form
		 $hourlySalary = filter_input(INPUT_GET, 'hourlySalary_txt2', FILTER_VALIDATE_FLOAT);//this is from the text box in update entry form
		 //validation code , and updating a row - same code as in index_step5.php. Only difference: You do not need to check to see if userId exists
	}
	
	if($action == "Delete_Entry"){
		$userId = filter_input(INPUT_GET, 'userId_list2'); //this is from the drop down list in delete entry form
		//validation code , and deleting a row - same code as in index_step4.php. Only difference: You do not need to check to see if userId exists
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
					<th>Salary </th>
				</tr>
		
			<?php foreach($employee_salary as $userId => $hourlySalary) { ?>
				<tr>
					<td><?php echo $userId;?></td>
					<td><?php $hourlySalary_f = '$'.number_format($hourlySalary, 2);
						echo $hourlySalary_f;?></td>
				</tr>
			<?php } ?>
		
		</table>
    </div>
		
		

    </div id = "data2">
	</br>
	</br>
	</br>
     <h1>Add a new entry into the array</h1>
	 <form action="index_step6.php" method="get">

      <div id="data">
            <label>UserID:</label>
            <input type="text" name="userId_txt1"
                   value="">
            <br>

            <label>Hourly Pay:</label>
            <input type="text" name="hourlySalary_txt1"
                   value="">
            <br>
			
			 			
			<div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" name= "action" value="Add_Entry"><br>
        </div>
	   </form>
	 
	 <h1>Update a Salary </h1>
	   <form action="index_step6.php" method="get">

        <div id="data">
            <label>Select UserID to update:</label>
				 <select name="userId_list1">
						<?php foreach( $employee_salary as $id => $salary ) :  
						/*this loop is needed to generate the rows. 
						   We split the super-key and the element/salary. 
							key is in variabe $userID, the  value lies in the variable $salary*/
						?>
							<option value="<?php echo $id; 
											/* we usually put the key /super-key in as the id in the option value */
											 ?>">
										   <?php echo $id; 
										   /* what the user sees could be either the $id or the $salary. We choose $id here */
										   ?>
							</option>
						
					    <?php endforeach; //just another fancy way of ending the foreach loop
					    ?>
				 </select>
            <br>

            <label>New Hourly Pay:</label>
            <input type="text" name="hourlySalary_txt2"
                   value="">
            <br>
			
			 			
			<div id="buttons">
            <label>&nbsp;</label>
            <input type="submit" name= "action" value="Update_Entry"><br>
            </div>
	    </form>
	 
	 <h1>Delete a Salary </h1>
		<form action="index_step6.php" method="get">

			<div id="data">
				<label>Select UserID to delete:</label>
				<select name="userId_list2">
					<?php foreach( $employee_salary as $id => $salary ) : //same procedure as the drop down list in update entry form above
					?>
						<option value="<?php echo $id; ?>">
							<?php echo $id; ?>
						</option>
					<?php endforeach; ?>
				</select>
				</br>
				
			<div id="buttons">
				<label>&nbsp;</label>
				<input type="submit" name= "action" value="Delete_Entry"><br>
			</div>
		</form>
	 
    </div>	
	</main>
</body>
</html>