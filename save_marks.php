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

// Sanitize and validate form data
$marksType = isset($_POST['marksType']) ? $_POST['marksType'] : '';
$studentId = isset($_POST['studentId']) ? (int)$_POST['studentId'] : 0;
$subjectName = isset($_POST['subjectName']) ? trim($_POST['subjectName']) : '';
$marks = isset($_POST['marks']) ? (float)$_POST['marks'] : 0;

// Ensure marks is within a valid range (e.g., 0-100)
if ($marks < 0 || $marks > 100) {
    echo "<script>alert('Marks must be between 0 and 100.'); window.history.back();</script>";
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
    echo "<script>alert('You are not authorized to enter marks for this student.'); window.history.back();</script>";
    exit;
}

// Check if internal or lab marks
if ($marksType === 'internal') {
    // Insert into internal_marks table
    $sql = "INSERT INTO internal_marks (student_id, subject_name, marks) VALUES (?, ?, ?)";
} else {
    // Insert into lab_marks table
    $sql = "INSERT INTO lab_marks (student_id, lab_name, marks) VALUES (?, ?, ?)";
}

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("isd", $studentId, $subjectName, $marks);

// Execute the query
if ($stmt->execute()) {
    echo "<script>alert('coursefees successful!'); window.location.href='teacher_dashboard.php';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='login.php';</script>";
}

// Close connection
$stmt->close();
$conn->close();
?>
