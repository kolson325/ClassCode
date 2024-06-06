

<!DOCTYPE html>
<html>
<head>
    <title>Salary Calculator</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <main>
        <h1>Salary Calculator</h1>
        <?php if (!empty($error_message)) { ?>
        <p style="color: red; font-weight: bold;"><?php echo htmlspecialchars($error_message); ?></p>
        <?php } ?>

        <form action="display_results.php" method="get"> 
            <div id="data">
                <label>User ID:</label>
                <input type="string" name="user_id"
                value="<?php echo htmlspecialchars($user_id); ?>">
                <br>
                <label>Hourly Salary Amount:</label>
                <input type="float" name="salary_amount"
                value="<?php echo htmlspecialchars($salary_amount); ?>">
                <br>
                <label>Hours Per Week:</label>
                <input type="float" name="hours_per_week"
                value="<?php echo htmlspecialchars($hours_per_week); ?>">
                <br>
                <label>Days Per Week:</label>
                <input type="integer" name="days_per_week"
                value="<?php echo htmlspecialchars($days_per_week); ?>">
                <br>
                <label>Holidays Per Year:</label>
                <input type="integer" name="holidays_per_year"
                value="<?php echo htmlspecialchars($holidays_per_year); ?>">
                <br>
                <label>Vacation Days Per Year:</label>
                <input type="integer" name="vacation_days_per_year"
                value="<?php echo htmlspecialchars($vacation_days_per_year); ?>">
                <br>
            </div>
            <div id="button">
                <input type="submit" value="Calculate"><br>
            </div>
        </form>
    </main>
</body>
</html>