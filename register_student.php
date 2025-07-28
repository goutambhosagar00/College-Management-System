<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection
include('config.php');

// Handle form submission
if (isset($_POST['submit'])) {
    // Collect form data
    $first_name = isset($_POST['fname']) ? $_POST['fname'] : '';
    $middle_name = isset($_POST['mname']) ? $_POST['mname'] : '';
    $last_name = isset($_POST['lname']) ? $_POST['lname'] : '';
    $fullname = trim($first_name . " " . $middle_name . " " . $last_name); // Combine names
    $registration_id = isset($_POST['rid']) ? $_POST['rid'] : '';
    $gmail = isset($_POST['gid']) ? $_POST['gid'] : '';
    $phone = isset($_POST['pn']) ? $_POST['pn'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $gender = isset($_POST['gender']) ? $_POST['gender'] : '';
    $course = isset($_POST['course']) ? $_POST['course'] : '';
    $branch = isset($_POST['branch']) ? $_POST['branch'] : '';
    $semester = isset($_POST['semester']) ? $_POST['semester'] : '';
    $create_password = isset($_POST['createpass']) ? $_POST['createpass'] : '';
    $confirm_password = isset($_POST['confirmpass']) ? $_POST['confirmpass'] : '';

    // Check if passwords match
    if ($create_password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.'); window.location.href='index.php';</script>";
    } else {
        // Hash the password for security
        $hashed_password = password_hash($create_password, PASSWORD_DEFAULT);

        // Prepare and bind
        $stmt = $conn->prepare("INSERT INTO students_details (fullname, id, gmail, phone, dob, gender, course, branch, semester, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        if ($stmt === false) {
            echo "<script>alert('Database error: " . htmlspecialchars($conn->error) . "'); window.location.href='index.php';</script>";
            exit();
        }

        $stmt->bind_param("ssssssssss", $fullname, $registration_id, $gmail, $phone, $dob, $gender, $course, $branch, $semester, $hashed_password);

        // Execute the statement
        if ($stmt->execute()) {
            echo "<script>alert('Registration successful!'); window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Error: " . $stmt->error . "'); window.location.href='index.php';</script>";
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>
