<?php
// Start session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $studentName = $_POST['name'];
    $course = $_POST['course'];
    $attendance = $_POST['attendance'];

    // Save details (could be saved in a database, here we are just displaying them)
    $_SESSION['student'] = [
        'name' => $studentName,
        'course' => $course,
        'attendance' => $attendance
    ];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
</head>
<body>
    <h1>Welcome to the Student Portal</h1>

    <!-- Display the current student details if available -->
    <?php
    if (isset($_SESSION['student'])) {
        echo "<h2>Student Details:</h2>";
        echo "Name: " . $_SESSION['student']['name'] . "<br>";
        echo "Course: " . $_SESSION['student']['course'] . "<br>";
        echo "Attendance: " . $_SESSION['student']['attendance'] . "%<br>";
    }
    ?>

    <h2>Enroll in a Course</h2>
    <form action="index.php" method="POST">
        <label for="name">Student Name:</label>
        <input type="text" name="name" id="name" required><br><br>

        <label for="course">Course:</label>
        <input type="text" name="course" id="course" required><br><br>

        <label for="attendance">Attendance Percentage:</label>
        <input type="number" name="attendance" id="attendance" required min="0" max="100"><br><br>

        <input type="submit" value="Enroll">
    </form>
</body>
</html>
