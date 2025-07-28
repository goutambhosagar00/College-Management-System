<?php
// Database connection
include('config.php');
// Start session for the teacher's branch
session_start();

// Check if the teacher is logged in and has a branch session variable
if (!isset($_SESSION['branch'])) {
    echo "You are not authorized to perform this action.";
    exit;
}

// Retrieve and sanitize form data
$studentId = isset($_POST['studentId']) ? (int)$_POST['studentId'] : 0;
$attendance = isset($_POST['attendance']) ? (float)$_POST['attendance'] : 0;

// Ensure attendance is within a valid range (e.g., 0-100)
if ($attendance < 0 || $attendance > 100) {
    echo "<script>alert('Attendance must be between 0 and 100.'); window.history.back();</script>";
    exit;
}

// Retrieve teacher's branch from session
$teacherBranch = $_SESSION['branch'];

// Fetch the student's branch from the database
$sql = "SELECT branch FROM students_details WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $studentId);
$stmt->execute();
$stmt->store_result();
$stmt->bind_result($studentBranch);
$stmt->fetch();

// Check if the student is from the same branch as the teacher
if ($teacherBranch !== $studentBranch) {
    echo "<script>alert('You are not authorized to enter attendance for this student.'); window.history.back();</script>";
    exit;
}

// Insert attendance into the attendance table
$sql = "INSERT INTO attendance (student_id, attendance, branch) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ids", $studentId, $attendance, $teacherBranch);

// Execute the query
if ($stmt->execute()) {
    echo "<script>alert('attendance successful!'); window.location.href='teacher_dashboard.php';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='login.php';</script>";
}
// Close connection
$stmt->close();
$conn->close();
?>
