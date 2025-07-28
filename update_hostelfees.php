<?php
// Database connection
include('config.php');
// Sanitize and validate input data
$id = isset($_POST['id']) ? (int)$_POST['id'] : 0;
$hostel_fees = isset($_POST['hostel_fees']) ? (int)$_POST['hostel_fees'] : 0;
$deposite_date = isset($_POST['deposite_date']) ? trim($_POST['deposite_date']) : '';
$semester = isset($_POST['semester']) ? trim($_POST['semester']) : '';

// Ensure the deposit date is in a valid format (YYYY-MM-DD)
if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $deposite_date)) {
    echo "<script>alert('Invalid date format. Please use YYYY-MM-DD.'); window.history.back();</script>";
    exit;
}

// Update the semester in students_details table
$updateSemesterSql = "UPDATE students_details SET semester = ? WHERE id = ?";
$semesterStmt = $conn->prepare($updateSemesterSql);
$semesterStmt->bind_param("si", $semester, $id); // 'si': string, integer

// Execute the semester update query
if (!$semesterStmt->execute()) {
    echo "<script>alert('Error updating semester: " . $semesterStmt->error . "'); window.history.back();</script>";
    exit;
}

// Update hostel fees and deposit date
$sql = "UPDATE hostel_fees SET hostel_fees = ?, deposite_date = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("isi", $hostel_fees, $deposite_date, $id); // 'isi': integer, string, integer

// Execute the hostel fees update query
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
