<?php
// Database connection
include('config.php');

// Sanitize input data
$id = $_POST['id'];
$hostel_fees = $_POST['hostel_fees'];
$deposite_date = $_POST['deposite_date'];

// SQL query to insert data
$sql = "INSERT INTO hostel_fees (id, hostel_fees, deposite_date) VALUES (?, ?, ?)";

// Prepare and bind
$stmt = $conn->prepare($sql);
$stmt->bind_param("iis", $id, $hostel_fees, $deposite_date);

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
