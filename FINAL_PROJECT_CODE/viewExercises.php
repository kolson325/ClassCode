<?php
    require_once('db_connect.php');
    session_start();
if (!isset($_SESSION['UserId'])) {
    header('Location: login.php');
    exit;
}

$setRepitionsMessage = '';
$workoutID = filter_input(INPUT_GET, 'workoutID', FILTER_VALIDATE_INT);
if ($workoutID != NULL) {
    $query = $db->prepare('SELECT * FROM Exercises e
                            INNER JOIN ExerciseInWorkout eiw ON e.exerciseID = eiw.exerciseID
                            WHERE eiw.workoutID = :workoutID');
    $query->bindValue(':workoutID', $workoutID);
    $query->execute();
    $exercises = $query->fetchAll();
}
$exerciseID = filter_input(INPUT_POST, 'exercise_id', FILTER_VALIDATE_INT);
if ($exerciseID != NULL) {
    $detailsQuery = $db->prepare('SELECT setRepitions FROM ExerciseInWorkout WHERE exerciseID = :exerciseID');
    $detailsQuery->bindValue(':exerciseID', $exerciseID);
    $detailsQuery->execute();
    $detail = $detailsQuery->fetch();
    
    if ($detail) {
        $setRepitions = $detail['setRepitions'];
        $setRepitionsMessage = "Perform this workout for $setRepitions set(s) throughout the workout.";
    } else {
        $setRepitionsMessage = "Details not found for the selected exercise.";
    }
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
    <h1>Exercises in Workout</h1>
    <a href="logout.php" class="logout-button">Logout</a>
</header>
    <main>
        <h1>Exercise List</h1>
        <section>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Time (minutes)</th>
                    <th>Reps</th>
                    <th>Primary Muscle</th>
                    <th>Sub Muscle</th>
                    <th>&nbsp;</th>
                </tr>
                <?php foreach ($exercises as $exercise) : ?>
                <tr>
                    <td><?php echo htmlspecialchars($exercise['exerciseName']); ?></td>
                    <td><?php echo htmlspecialchars($exercise['exerciseTime']); ?></td>
                    <td><?php echo htmlspecialchars($exercise['exerciseReps']); ?></td>
                    <td><?php echo htmlspecialchars($exercise['primaryMuscle']); ?></td>
                    <td><?php echo htmlspecialchars($exercise['subMuscle']); ?></td>
                    <td>
                    <form action="" method="post">
                        <input type="hidden" name="exercise_id" value="<?php echo $exercise['exerciseID']; ?>">
                        <input type="submit" value="View Details">
                    </form>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php echo $setRepitionsMessage; ?>
            </table>
        </section>
        <p><a href="workoutSelection.php">Back to Workout Selection</a></p>
    </main>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> OptiFit Gym, Inc.</p>
    </footer>
</body>
</html>
