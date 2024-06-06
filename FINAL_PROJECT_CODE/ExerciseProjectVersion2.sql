-- Added database creation command as per peer review
CREATE DATABASE IF NOT EXISTS OptiFit;
USE OptiFit;

DROP TABLE IF EXISTS ExerciseInWorkout;
DROP TABLE IF EXISTS Exercises;
DROP TABLE IF EXISTS Workouts;
DROP TABLE IF EXISTS Users;

DROP USER IF EXISTS 'optifit_user'@'localhost';
DROP USER IF EXISTS 'optifit_admin'@'localhost';

CREATE TABLE Exercises (
    exerciseID INT AUTO_INCREMENT PRIMARY KEY,
    exerciseName VARCHAR(25) NOT NULL,
    exerciseTime INT NOT NULL,
    exerciseReps INT NOT NULL,
    primaryMuscle VARCHAR(25) NOT NULL,
    subMuscle VARCHAR(25) NOT NULL
);

CREATE TABLE Workouts (
    workoutID INT AUTO_INCREMENT PRIMARY KEY,
    workoutName VARCHAR(25) NOT NULL,
    workoutRepetition INT NOT NULL,
    workoutLength INT NOT NULL,
    workoutFocus VARCHAR(255) NOT NULL
);

CREATE TABLE ExerciseInWorkout (
    exerciseID INT NOT NULL,
    workoutID INT NOT NULL,
    setRepitions INT NOT NULL,
    exerciseCount INT NOT NULL,
    PRIMARY KEY (exerciseID, workoutID),
    FOREIGN KEY (exerciseID) REFERENCES Exercises(exerciseID),
    FOREIGN KEY (workoutID) REFERENCES Workouts(workoutID)
);

CREATE TABLE Users (
    UserId VARCHAR(50) PRIMARY KEY,
    password VARCHAR(255) NOT NULL,
    userType VARCHAR(255) NOT NULL
);



INSERT INTO Workouts (workoutName, workoutRepetition, workoutLength, workoutFocus) VALUES
('Push Day', 2, 45, 'Chest, Triceps, Shoulders'), 
('Pull Day', 2, 30, 'Back, Biceps, Forearms'), 
('Leg Day', 1, 20, 'Legs'), 
('Cardio Day', 1, 20, 'Endurance'),
('Recovery Day', 1, 30, 'Recovery');

INSERT INTO Exercises (exerciseName, exerciseTime, exerciseReps, primaryMuscle, subMuscle) VALUES
('Push-up', 10, 15, 'Chest', 'Triceps'), 
('Squat', 5, 20, 'Legs', 'Glutes'),
('Pull-up', 15, 10, 'Back', 'Biceps'), 
('Bench Press', 15, 8, 'Chest', 'Triceps'),  
('Curls', 5, 12, 'Biceps', 'Forearms'),
('Rows', 15, 10, 'Back', 'Biceps'),
('Dips', 15, 8, 'Triceps', 'Shoulders'), 
('Military Press', 15, 8, 'Shoulders', 'Triceps'), 
('Run', 20, 1, 'Legs', 'Heart'), 
('Lunges', 12, 12, 'Legs', 'Core'),
('Box Jumps', 20, 25, 'Cardio', 'Legs'), 
('Sauna', 20, 1, 'Recovery', 'Recovery');

INSERT INTO ExerciseInWorkout (exerciseID, workoutID, setRepitions, exerciseCount) VALUES 
(1, 1, 3, 2),    -- Push-up on Push Day
(2, 3, 5, 3),    -- Squat on Leg Day
(3, 2, 3, 2),    -- Pull-up on Pull Day
(4, 1, 3, 2),    -- Bench Press on Push Day
(5, 2, 3, 2),    -- Curls on Pull Day
(6, 2, 3, 2),    -- Rows on Pull Day
(7, 1, 5, 1),    -- Dips on Push Day
(8, 1, 5, 1),    -- Military Press on Push Day
(9, 4, 1, 1),    -- Run on Cardio Day
(10, 3, 3, 1),   -- Lunges on Leg Day
(11, 3, 3, 2),   -- Box Jumps on Leg Day
(12, 5, 1, 1);

CREATE USER 'optifit_user'@'localhost' IDENTIFIED BY 'password';
CREATE USER 'optifit_admin'@'localhost' IDENTIFIED BY 'password';
GRANT SELECT, INSERT, UPDATE, DELETE, CREATE, DROP, INDEX, ALTER ON OptiFit.* TO 'optifit_admin'@'localhost';
GRANT SELECT ON OptiFit.* TO 'optifit_user'@'localhost';
