<?php
// Display errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings
include('config.php');
// Start the session
session_start();

// Get the registration ID from the session or POST request
$studentId = $_SESSION['registrationId'] ?? $_POST['registrationId'] ?? '';

// Validate if the student ID is provided
if (!$studentId) {
    echo "<p>Please provide a valid Student ID.</p>";
    exit;
}

// Query to fetch student details (fullname, id, branch, semester, course)
$query = "SELECT fullname, id, branch, semester, course FROM students_details WHERE id = ?";
$stmt = $conn->prepare($query);

// Check if the query preparation was successful
if (!$stmt) {
    die("SQL preparation failed: " . $conn->error);
}

// Bind the student ID parameter
$stmt->bind_param("s", $studentId);

// Execute the query and check if successful
if (!$stmt->execute()) {
    echo "<p>Error executing query: " . $stmt->error . "</p>";
    exit;
}

// Get the result of the query
$result = $stmt->get_result();

// Query to fetch course details (course fees, deposite date)
$courseQuery = "SELECT course_fees, deposite_date FROM course_fees WHERE id = ?";
$courseStmt = $conn->prepare($courseQuery);
$courseStmt->bind_param("s", $studentId);
$courseStmt->execute();
$courseResult = $courseStmt->get_result();
$courseFees = null;
$depositDate = null;

if ($courseResult->num_rows > 0) {
    $courseRow = $courseResult->fetch_assoc();
    $courseFees = $courseRow['course_fees'] ?? null;  // Handle missing key
    $depositDate = $courseRow['deposite_date'] ?? null; // Handle missing key
}

// Start HTML output
echo '<style>
    .table-container {
        background-color: white;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin: 20px 0;
    }
    th, td {
        padding: 10px;
        text-align: left;
        border: 1px solid #ddd;
    }
    th {
        background-color: rgb(59, 121, 227);
        color: white;
    }
    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    h2, h3 {
         color: #080808;
    }
    .error {
        color: red;
        font-weight: bold;
    }
    /* Responsive adjustments */
@media screen and (max-width: 768px) {
    .table-container {
        padding: 15px;
    }
    
    th, td {
        padding: 8px;
        font-size: 14px;
    }
}

@media screen and (max-width: 480px) {
    th, td {
        padding: 6px;
        font-size: 9px;
    }
    
    h2, h3 {
        font-size: 13px;
    }
}
</style>';

if ($result->num_rows > 0) {
    // Output student details
    $student = $result->fetch_assoc();
    $courseName = $student['course'] ?? 'N/A'; // Adjusted to match query

    echo '<div class="table-container">
            <h2>COURSE FEES INFORMATION</h2>
            <table>
                <tr><th>Full Name</th><td>' . htmlspecialchars($student['fullname'] ?? 'N/A') . '</td></tr>
                <tr><th>Registration ID</th><td>' . htmlspecialchars($student['id'] ?? 'N/A') . '</td></tr>
                <tr><th>Branch</th><td>' . htmlspecialchars($student['branch'] ?? 'N/A') . '</td></tr>
                <tr><th>Semester</th><td>' . htmlspecialchars($student['semester'] ?? 'N/A') . '</td></tr>
                <tr><th>Course Name</th><td>' . htmlspecialchars($courseName) . '</td></tr>';

    // Display course fees and deposit date if available
   // Display course fees and deposit date if available
echo '<tr><th>Course Fees</th><td>' . htmlspecialchars($courseFees ?   $courseFees : 'N/A').'₹ ' . '</td></tr>';

    echo '<tr><th>Deposit Date</th><td>' . htmlspecialchars($depositDate ?? 'N/A') . '</td></tr>';

    echo '</table>
          </div>';
} else {
    echo "<p class='error'>No student found with ID: " . htmlspecialchars($studentId) . "</p>";
}
?>
