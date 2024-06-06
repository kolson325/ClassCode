<?php
$error_message= '';
$user_id = filter_input(INPUT_GET, 'user_id');
$salary_amount = filter_input(INPUT_GET, 'salary_amount', FILTER_VALIDATE_FLOAT);
$hours_per_week = filter_input(INPUT_GET, 'hours_per_week', FILTER_VALIDATE_FLOAT);
$days_per_week = filter_input(INPUT_GET, 'days_per_week', FILTER_VALIDATE_INT);
$holidays_per_year = filter_input(INPUT_GET, 'holidays_per_year', FILTER_VALIDATE_INT);
$vacation_days_per_year = filter_input(INPUT_GET, 'vacation_days_per_year', FILTER_VALIDATE_INT);

if($user_id === FALSE){
    $error_message= "User ID is invalid";
}else if($salary_amount <= 0){
    $error_message= "Salary amount must be a number over 0";
}else if($hours_per_week <= 0){
    $error_message= "Hours per week must be greater than 0";
}else if($days_per_week === FALSE){
    $error_message= "Days per week must be a valid whole number";
}else if($holidays_per_year === FALSE){
    $error_message= " Holidays per year must be a valid whole number";
}else if($vacation_days_per_year === FALSE){
    $error_message="Vacation days per year must be a valid whole number";
}else{
    $error_message= '';
}
if($error_message != ''){
    include('index.php');
    exit();
}
$annual_salary = $salary_amount * $hours_per_week * 52.0;
$daily_salary = $annual_salary / 260;
$days_worked_per_year = 260 - ($vacation_days_per_year + $holidays_per_year);
$hours_worked_per_day = $hours_per_week / $days_per_week;

$adj_annual_salary = $daily_salary * $days_worked_per_year;
$adj_daily_salary = $adj_annual_salary / 260;
$adj_hourly_salary = $adj_daily_salary / $hours_worked_per_day;
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
        #var_dump($user_id);
        #var_dump($salary_amount);
        #var_dump($hours_per_week);
        #var_dump($days_per_week);
        #var_dump($holidays_per_year);
        #var_dump($vacation_days_per_year);
        #var_dump($annual_salary);
        #var_dump($daily_salary);
        #var_dump($days_worked_per_year);
        #var_dump($hours_worked_per_day);
        #var_dump($adj_annual_salary);
        #var_dump($adj_daily_salary);
        #var_dump($adj_hourly_salary);
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
        <table>
            <tr>
                <th>**************</th>
                <th>Unadjusted</th>
                <th>Adjusted</th>
            </tr>
            <tr>
                <td>Hourly:</td>
                <td><?php echo '$' . number_format($hourly_salary, 2); ?></td>
                <td><?php echo '$' . number_format($adj_hourly_salary, 2); ?></td>
            </tr>
            <tr>
                <td>Daily:</td>
                <td><?php echo '$' . number_format($daily_salary, 2); ?></td>
                <td><?php echo '$' . number_format($adj_daily_salary, 2); ?></td>
            </tr>
            <tr>
                <td>Annual</td>
                <td><?php echo '$' . number_format($annual_salary, 2); ?></td>
                <td><?php echo '$' . number_format($adj_annual_salary, 2); ?></td>
            </tr>
        </table>

    </main>
</body>
</html>