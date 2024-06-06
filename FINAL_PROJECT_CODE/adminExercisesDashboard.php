<?php
require_once('db_connect.php');

// Add Exercise
$add = filter_input(INPUT_POST, 'add', FILTER_SANITIZE_SPECIAL_CHARS);
if ($add) {
    $exerciseName = filter_input(INPUT_POST, 'exerciseName', FILTER_SANITIZE_STRING);
    $exerciseTime = filter_input(INPUT_POST, 'exerciseTime', FILTER_VALIDATE_INT);
    $exerciseReps = filter_input(INPUT_POST, 'exerciseReps', FILTER_VALIDATE_INT);
    $primaryMuscle = filter_input(INPUT_POST, 'primaryMuscle', FILTER_SANITIZE_STRING);
    $subMuscle = filter_input(INPUT_POST, 'subMuscle', FILTER_SANITIZE_STRING);

    if ($exerciseName && $exerciseTime !== false && $exerciseReps !== false && $primaryMuscle && $subMuscle) {
        $stmt = $db->prepare("INSERT INTO Exercises (exerciseName, exerciseTime, exerciseReps, primaryMuscle, subMuscle) VALUES (:exerciseName, :exerciseTime, :exerciseReps, :primaryMuscle, :subMuscle)");
        $stmt->bindValue(':exerciseName', $exerciseName);
        $stmt->bindValue(':exerciseTime', $exerciseTime);
        $stmt->bindValue(':exerciseReps', $exerciseReps);
        $stmt->bindValue(':primaryMuscle', $primaryMuscle);
        $stmt->bindValue(':subMuscle', $subMuscle);
        $stmt->execute();
    }
}

// Delete Exercise
$delete = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_SPECIAL_CHARS);
if ($delete) {
    $exerciseID = filter_input(INPUT_POST, 'exerciseID', FILTER_VALIDATE_INT);
    if ($exerciseID !== false) {
        $stmt = $db->prepare("DELETE FROM Exercises WHERE exerciseID = :exerciseID");
        $stmt->bindValue(':exerciseID', $exerciseID);
        $stmt->execute();
    }
}

// Update Exercise
$update = filter_input(INPUT_POST, 'update', FILTER_SANITIZE_SPECIAL_CHARS);
if ($update) {
    $exerciseID = filter_input(INPUT_POST, 'exerciseID', FILTER_VALIDATE_INT);
    $exerciseName = filter_input(INPUT_POST, 'exerciseName', FILTER_SANITIZE_STRING);
    $exerciseTime = filter_input(INPUT_POST, 'exerciseTime', FILTER_VALIDATE_INT);
    $exerciseReps = filter_input(INPUT_POST, 'exerciseReps', FILTER_VALIDATE_INT);
    $primaryMuscle = filter_input(INPUT_POST, 'primaryMuscle', FILTER_SANITIZE_STRING);
    $subMuscle = filter_input(INPUT_POST, 'subMuscle', FILTER_SANITIZE_STRING);

    if ($exerciseID !== false && $exerciseName && $exerciseTime !== false && $exerciseReps !== false && $primaryMuscle && $subMuscle) {
        $stmt = $db->prepare("UPDATE Exercises SET exerciseName = :exerciseName, exerciseTime = :exerciseTime, exerciseReps = :exerciseReps, primaryMuscle = :primaryMuscle, subMuscle = :subMuscle WHERE exerciseID = :exerciseID");
        $stmt->bindValue(':exerciseName', $exerciseName);
        $stmt->bindValue(':exerciseTime', $exerciseTime);
        $stmt->bindValue(':exerciseReps', $exerciseReps);
        $stmt->bindValue(':primaryMuscle', $primaryMuscle);
        $stmt->bindValue(':subMuscle', $subMuscle);
        $stmt->bindValue(':exerciseID', $exerciseID);
        $stmt->execute();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>OptiFit Exercise Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
<header>
    <h1>Exercise Admin Dashboard</h1>
</header>

    <!-- Add Exercise Section -->
    <section>
    <h2>Add Exercises</h2>
    <form method="post">
        <input type="text" name="exerciseName" placeholder="Exercise Name" required>
        <input type="number" name="exerciseTime" placeholder="Time (sec)" required>
        <input type="number" name="exerciseReps" placeholder="Reps" required>
        <input type="text" name="primaryMuscle" placeholder="Primary Muscle" required>
        <input type="text" name="subMuscle" placeholder="Sub Muscle" required>
        <input type="submit" name="add" value="Add Exercise">
    </form>
</section>

    <!-- Delete Exercise Section -->
    <section>
    <h2>Delete Exercises</h2>
    <form method="post">
        <input type="number" name="exerciseID" placeholder="Exercise ID" required>
        <input type="submit" name="delete" value="Delete Exercise">
    </form>
</section>

    <!-- Update Exercise Section -->
    <section>
    <h2>Update Exercises</h2>
    <form method="post">
        <input type="number" name="exerciseID" placeholder="Enter ID to Update" required>
        <input type="text" name="exerciseName" placeholder="New Exercise Name" required>
        <input type="number" name="exerciseTime" placeholder="New Time (sec)" required>
        <input type="number" name="exerciseReps" placeholder="New Reps" required>
        <input type="text" name="primaryMuscle" placeholder="New Primary Muscle" required>
        <input type="text" name="subMuscle" placeholder="New Sub Muscle" required>
        <input type="submit" name="update" value="Update Exercise">
    </form>
</section>

    <p><a href="adminWorkoutDashboard.php">Edit Workouts</a></p>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> OptiFit, Inc. All rights reserved.</p>
    </footer>
</body>
</html>

