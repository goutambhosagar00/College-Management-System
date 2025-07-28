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
$newAttendance = isset($_POST['attendance']) ? (float)$_POST['attendance'] : 0;
$newSemester = isset($_POST['semester']) ? trim($_POST['semester']) : '';

// Ensure new attendance is within a valid range (e.g., 0-100)
if ($newAttendance < 0 || $newAttendance > 100) {
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
    echo "<script>alert('You are not authorized to update attendance for this student.'); window.history.back();</script>";
    exit;
}

// Update the semester in the students_details table
$updateSemesterSql = "UPDATE students_details SET semester = ? WHERE id = ?";
$semesterStmt = $conn->prepare($updateSemesterSql);
$semesterStmt->bind_param("si", $newSemester, $studentId);

// Execute the semester update query
if (!$semesterStmt->execute()) {
    echo "<script>alert('Error updating semester: " . $semesterStmt->error . "'); window.history.back();</script>";
    exit;
}

// Update the attendance record
$sql = "UPDATE attendance SET attendance = ? WHERE student_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("di", $newAttendance, $studentId);

// Execute the attendance update query
if ($stmt->execute()) {
    echo "<script>alert('Update successful!'); window.location.href='account_dashboard.php';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='login.php';</script>";
}

// Close connections
$semesterStmt->close();
$stmt->close();
$conn->close();
?>
