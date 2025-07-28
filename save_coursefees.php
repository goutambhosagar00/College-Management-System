<?php
// Database connection
include('config.php');
// Sanitize input data
$id = $_POST['id'];
$course_name = $_POST['course_name'];
$course_fees = $_POST['course_fees'];
$deposite_date = $_POST['deposite_date'];

// SQL query to insert data
$sql = "INSERT INTO course_fees (id, course_name, course_fees, deposite_date) VALUES (?, ?, ?, ?)";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssis", $id, $course_name, $course_fees, $deposite_date);

// Execute the query
 if ($stmt->execute()) {
            echo "<script>alert('coursefees successful!'); window.location.href='account_dashboard.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='login.php';</script>";
        }

// Close connection
$stmt->close();
$conn->close();
?>
