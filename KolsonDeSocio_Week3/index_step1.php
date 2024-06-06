<?php
$employee_salary = array(); // creates an empty array
$employee_salary["jac2233"] = 56.0; // adds an element with the given key
$employee_salary["abc4530"] = 78.78; // add another element
$employee_salary["ghj1238"] = 34.56; // add another element

var_dump($employee_salary["jac2233"]);
var_dump($employee_salary["abc4530"]);
var_dump($employee_salary["ghj1238"]);
var_dump($employee_salary);
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
                <th>Hourly Pay</th>
            </tr>

            <?php foreach ($employee_salary as $userId => $hourlySalary) { ?>
                <tr>
                    <td><?php echo $userId; ?></td>
                    <td><?php echo '$' . number_format($hourlySalary, 2); ?></td>
                </tr>
            <?php } ?>

        </table>
    </div>

    <div id="data2">
        <br>
        <br>
        <br>
    </div>
</main>
</body>
</html>