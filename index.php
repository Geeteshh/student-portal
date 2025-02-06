<?php
session_start();
include('config.php');

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch student details
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM students WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// Fetch enrolled courses
$query = "SELECT courses.name, courses.schedule FROM enrollments 
          JOIN courses ON enrollments.course_id = courses.id 
          WHERE enrollments.student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$enrolled_courses = $stmt->get_result();

// Fetch attendance records
$query = "SELECT courses.name, attendance.date, attendance.status FROM attendance 
          JOIN courses ON attendance.course_id = courses.id 
          WHERE attendance.student_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$attendance_records = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Portal</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($student['name']); ?>!</h1>
        <a href="logout.php">Logout</a>
    </header>
    
    <section>
        <h2>Enrolled Courses</h2>
        <ul>
            <?php while ($course = $enrolled_courses->fetch_assoc()) { ?>
                <li><?php echo htmlspecialchars($course['name']) . " - " . htmlspecialchars($course['schedule']); ?></li>
            <?php } ?>
        </ul>
    </section>

    <section>
        <h2>Attendance Records</h2>
        <table>
            <tr>
                <th>Course</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
            <?php while ($attendance = $attendance_records->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($attendance['name']); ?></td>
                    <td><?php echo htmlspecialchars($attendance['date']); ?></td>
                    <td><?php echo htmlspecialchars($attendance['status']); ?></td>
                </tr>
            <?php } ?>
        </table>
    </section>
</body>
</html>

