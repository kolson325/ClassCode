<?php
$user_id = filter_input(INPUT_GET, 'user_id');
$salary_amount = filter_input(INPUT_GET, 'salary_amount', FILTER_VALIDATE_FLOAT);
$hours_per_week = filter_input(INPUT_GET, 'hours_per_week', FILTER_VALIDATE_FLOAT);
$days_per_week = filter_input(INPUT_GET, 'days_per_week', FILTER_VALIDATE_INT);
$holidays_per_year = filter_input(INPUT_GET, 'holidays_per_year', FILTER_VALIDATE_INT);
$vacation_days_per_year = filter_input(INPUT_GET, 'vacation_days_per_year', FILTER_VALIDATE_INT);

$annual_salary = $salary_amount*$hours_per_week*52.0;
$daily_salary = $annual_salary/260;
$days_worked_per_year = 260 - ($vacation_days_per_year + $holidays_per_year);
$hours_worked_per_day = $hours_per_week/$days_per_week;

$adj_annual_salary = $daily_salary * $days_worked_per_year;
$adj_daily_salary = $adj_annual_salary/260;
$adj_hourly_salary = $adj_daily_salary/$hoursWorkedPerDay;




?>

<!DOCTYPE html>
<html>
<head>
    <title>Salary Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Salary Calculator</h1>
        <?php
        var_dump($user_id);
        var_dump($salary_amount);
        var_dump($hours_per_week);
        var_dump($days_per_week);
        var_dump($holidays_per_year);
        var_dump($vacation_days_per_year);
        var_dump($annual_salary);
        var_dump($daily_salary);
        var_dump($days_worked_per_year);
        var_dump($hours_worked_per_day);
        var_dump($adj_annual_salary);
        var_dump($adj_daily_salary);
        var_dump($adj_hourly_salary);
        ?>
        <label>User ID:</label>
        <span><?php echo $user_id; ?></span><br>
        <label>Hourly Salary Amount:</label>
        <span><?php echo '$' . number_format($salary_amount, 2); ?></span><br>
        <label>Hours Per Week:</label>
        <span><?php echo $hours_per_week; ?></span><br>
        <label>Days Per Week:</label>
        <span><?php echo $days_per_week; ?></span><br>
        <label>Holidays Per Year:</label>
        <span><?php echo $holidays_per_year; ?></span><br>
        <label>Vacation Days Per Year:</label>
        <span><?php echo $vacation_days_per_year; ?></span><br>
    </main>
</body>
</html>
