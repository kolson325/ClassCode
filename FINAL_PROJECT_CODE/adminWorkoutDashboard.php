<?php
require_once('db_connect.php');

// Add Workout
$add = filter_input(INPUT_POST, 'add', FILTER_SANITIZE_SPECIAL_CHARS);
if ($add) {
    $workoutName = filter_input(INPUT_POST, 'workoutName', FILTER_SANITIZE_STRING);
    $workoutRepetition = filter_input(INPUT_POST, 'workoutRepetition', FILTER_VALIDATE_INT);
    $workoutLength = filter_input(INPUT_POST, 'workoutLength', FILTER_VALIDATE_INT);
    $workoutFocus = filter_input(INPUT_POST, 'workoutFocus', FILTER_SANITIZE_STRING);

    if ($workoutName && $workoutRepetition !== false && $workoutLength !== false && $workoutFocus) {
        $stmt = $db->prepare("INSERT INTO Workouts (workoutName, workoutRepetition, workoutLength, workoutFocus) VALUES (:workoutName, :workoutRepetition, :workoutLength, :workoutFocus)");
        $stmt->bindValue(':workoutName', $workoutName);
        $stmt->bindValue(':workoutRepetition', $workoutRepetition);
        $stmt->bindValue(':workoutLength', $workoutLength);
        $stmt->bindValue(':workoutFocus', $workoutFocus);
        $stmt->execute();
    }
}

// Delete Workout
$delete = filter_input(INPUT_POST, 'delete', FILTER_SANITIZE_SPECIAL_CHARS);
if ($delete) {
    $workoutID = filter_input(INPUT_POST, 'workoutID', FILTER_VALIDATE_INT);
    if ($workoutID !== false) {
        $stmt = $db->prepare("DELETE FROM Workouts WHERE workoutID = :workoutID");
        $stmt->bindValue(':workoutID', $workoutID);
        $stmt->execute();
    }
}

// Update Workout
$update = filter_input(INPUT_POST, 'update', FILTER_SANITIZE_SPECIAL_CHARS);
if ($update) {
    $workoutID = filter_input(INPUT_POST, 'workoutID', FILTER_VALIDATE_INT);
    $workoutName = filter_input(INPUT_POST, 'workoutName', FILTER_SANITIZE_STRING);
    $workoutRepetition = filter_input(INPUT_POST, 'workoutRepetition', FILTER_VALIDATE_INT);
    $workoutLength = filter_input(INPUT_POST, 'workoutLength', FILTER_VALIDATE_INT);
    $workoutFocus = filter_input(INPUT_POST, 'workoutFocus', FILTER_SANITIZE_STRING);

    if ($workoutID !== false && $workoutName && $workoutRepetition !== false && $workoutLength !== false && $workoutFocus) {
        $stmt = $db->prepare("UPDATE Workouts SET workoutName = :workoutName, workoutRepetition = :workoutRepetition, workoutLength = :workoutLength, workoutFocus = :workoutFocus WHERE workoutID = :workoutID");
        $stmt->bindValue(':workoutName', $workoutName);
        $stmt->bindValue(':workoutRepetition', $workoutRepetition);
        $stmt->bindValue(':workoutLength', $workoutLength);
        $stmt->bindValue(':workoutFocus', $workoutFocus);
        $stmt->bindValue(':workoutID', $workoutID);
        $stmt->execute();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    
    <title>OptiFit Workout Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>
<body>
    <header>
    <h1>Workout Admin Dashboard</h1>
</header>

    <!-- Add Workout Section -->
    <section>
    <h2>Add Workout</h2>
    <form method="post">
        <input type="text" name="workoutName" placeholder="Workout Name" required>
        <input type="number" name="workoutRepetition" placeholder="Repetition" required>
        <input type="number" name="workoutLength" placeholder="Length (min)" required>
        <input type="text" name="workoutFocus" placeholder="Focus" required>
        <input type="submit" name="add" value="Add Workout">
    </form>
    </section>

    <!-- Delete Workout Section -->
    <section>
    <h2>Delete Workout</h2>
    <form method="post">
        <input type="number" name="workoutID" placeholder="Workout ID" required>
        <input type="submit" name="delete" value="Delete Workout">
    </form>
</section>

    <!-- Update Workout Section -->
    <section>
    <h2>Update Workout</h2>
    <form method="post">
        <input type="number" name="workoutID" placeholder="Enter ID to Update" required>
        <input type="text" name="workoutName" placeholder="Workout Name" required>
        <input type="number" name="workoutRepetition" placeholder="Repetition" required>
        <input type="number" name="workoutLength" placeholder="Length (min)" required>
        <input type="text" name="workoutFocus" placeholder="Focus" required>
        <input type="submit" name="update" value="Update Workout">
    </form>
</section>
    <p><a href="adminExercisesDashboard.php">Edit Exercises</a></p>
    <p><a href="workoutSelection.php">User View</a></p>
    <footer>
        <p>&copy; <?php echo date("Y"); ?> OptiFit, Inc. All rights reserved.</p>
    </footer>
</body>
</html>