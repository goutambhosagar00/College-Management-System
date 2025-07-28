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
$semester = isset($_POST['semester']) ? trim($_POST['semester']) : '';

// Ensure marks are within a valid range (e.g., 0-100)
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
    echo "<script>alert('You are not authorized to update marks for this student.'); window.history.back();</script>";
    exit;
}

// Update the semester only in the students_details table
$updateSemesterSql = "UPDATE students_details SET semester = ? WHERE id = ?";
$updateSemesterStmt = $conn->prepare($updateSemesterSql);
$updateSemesterStmt->bind_param("si", $semester, $studentId);

// Execute the query to update the semester
if (!$updateSemesterStmt->execute()) {
    echo "<script>alert('Error updating semester: " . $updateSemesterStmt->error . "'); window.history.back();</script>";
    exit;
}

// Check if internal or lab marks need to be updated
if ($marksType === 'internal') {
    // Update internal marks
    $sql = "UPDATE internal_marks SET marks = ? WHERE student_id = ? AND subject_name = ?";
} else {
    // Update lab marks
    $sql = "UPDATE lab_marks SET marks = ? WHERE student_id = ? AND lab_name = ?";
}

// Prepare and bind parameters
$stmt = $conn->prepare($sql);
$stmt->bind_param("dis", $marks, $studentId, $subjectName);

// Execute the query
if ($stmt->execute()) {
    echo "<script>alert('Update successful!'); window.location.href='account_dashboard.php';</script>";
} else {
    echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='login.php';</script>";
}

// Close connection
$stmt->close();
$updateSemesterStmt->close();
$conn->close();
?>
