<?php
require('db_connect.php'); 
session_start();


if (!isset($_SESSION['UserId'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>OptiFit Workout Manager</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<header>
    <h1>Workout Manager</h1>
    <a href="logout.php" class="logout-button">Logout</a>
</header>
<main>
    <h1>Workout List</h1>
    <?php
    // Link only for admins
    if (isset($_SESSION['userType']) && $_SESSION['userType'] === 'admin') {
        echo '<p><a href="adminWorkoutDashboard.php">Back to Admin View</a></p>';
    }
    ?>
    <section>
        <table>
            <tr>
                <th>Name</th>
                <th>Repetition</th>
                <th>Length (minutes)</th>
                <th>Focus</th>
                <th>&nbsp;</th>
            </tr>
            <?php
            $query = 'SELECT * FROM Workouts';
            $statement = $db->prepare($query);
            $statement->execute();
            $workouts = $statement->fetchAll();
            $statement->closeCursor();

            foreach ($workouts as $workout) {
            ?>
                <tr>
                    <td><?php echo htmlspecialchars($workout['workoutName']); ?></td>
                    <td><?php echo htmlspecialchars($workout['workoutRepetition']); ?></td>
                    <td><?php echo htmlspecialchars($workout['workoutLength']); ?></td>
                    <td><?php echo htmlspecialchars($workout['workoutFocus']); ?></td>
                    <td>
                        <form action="viewExercises.php" method="get">
                            <input type="hidden" name="workoutID" value="<?php echo $workout['workoutID']; ?>">
                            <input type="submit" value="View Details">
                        </form>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </section>
</main>
<footer>
    <p>&copy; <?php echo date("Y"); ?> OptiFit Gym, Inc.</p>
</footer>
</body>
</html>