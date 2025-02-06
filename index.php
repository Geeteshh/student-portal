<?php
// Start session
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $studentName = $_POST['name'];
    $course = $_POST['course'];
    $attendance = $_POST['attendance'];

    // Save details in the session
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
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
        }

        .container {
            width: 80%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        header {
            text-align: center;
            padding: 20px;
            background-color: #4CAF50;
            color: white;
        }

        h1 {
            font-size: 36px;
        }

        section {
            margin-top: 20px;
        }

        .student-details {
            background-color: #f9f9f9;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .enrollment-form {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            font-size: 14px;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 8px;
            font-size: 14px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button.btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button.btn:hover {
            background-color: #45a049;
        }

        @media screen and (max-width: 768px) {
            .container {
                width: 100%;
                padding: 10px;
            }

            header h1 {
                font-size: 28px;
            }

            .form-group label {
                font-size: 12px;
            }

            input[type="text"],
            input[type="number"] {
                font-size: 12px;
            }

            button.btn {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>Student Portal</h1>
        </header>

        <section class="student-details">
            <?php
            if (isset($_SESSION['student'])) {
                echo "<h2>Student Details:</h2>";
                echo "<p><strong>Name:</strong> " . $_SESSION['student']['name'] . "</p>";
                echo "<p><strong>Course:</strong> " . $_SESSION['student']['course'] . "</p>";
                echo "<p><strong>Attendance:</strong> " . $_SESSION['student']['attendance'] . "%</p>";
            }
            ?>
        </section>

        <section class="enrollment-form">
            <h2>Enroll in a Course</h2>
            <form action="index.php" method="POST">
                <div class="form-group">
                    <label for="name">Student Name:</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div class="form-group">
                    <label for="course">Course:</label>
                    <input type="text" name="course" id="course" required>
                </div>
                <div class="form-group">
                    <label for="attendance">Attendance Percentage:</label>
                    <input type="number" name="attendance" id="attendance" required min="0" max="100">
                </div>
                <button type="submit" class="btn">Enroll</button>
            </form>
        </section>
    </div>
</body>
</html>
