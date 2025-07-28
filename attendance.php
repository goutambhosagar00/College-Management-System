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

// Query to fetch student details (fullname, id, branch, semester)
$query = "SELECT fullname, id, branch, semester FROM students_details WHERE id = ?";
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

// Query to fetch attendance
$attendanceQuery = "SELECT attendance FROM attendance WHERE student_id = ?";
$attendanceStmt = $conn->prepare($attendanceQuery);
$attendanceStmt->bind_param("s", $studentId);
$attendanceStmt->execute();
$attendanceResult = $attendanceStmt->get_result();
$attendance = 0;
if ($attendanceResult->num_rows > 0) {
    $attendanceRow = $attendanceResult->fetch_assoc();
    $attendance = $attendanceRow['attendance'];
}

// Start HTML output
echo '<style>
    .table-container {
        background-color: white;
        padding: 2px;
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
    .attendance-circle {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-weight: bold;
        font-size: 10px;
        color: black; /* Text inside circle will be black */
        margin: auto;
        border: 6px solid; /* Border color */
        background-color: white; /* Circle color remains white */
    }
    .attendance-yellow {
        border-color: yellow; /* Yellow border */
    }
    .attendance-red {
        border-color: red; /* Red border */
    }
    .attendance-green {
        border-color: green; /* Green border */
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
    echo '<div class="table-container">
            <h2>YOUR ATTENDANCE</h2>
            <table>
                <tr><th>Full Name</th><td>' . htmlspecialchars($student['fullname']) . '</td></tr>
                <tr><th>Registration ID</th><td>' . htmlspecialchars($student['id']) . '</td></tr>
                <tr><th>Branch</th><td>' . htmlspecialchars($student['branch']) . '</td></tr>
                <tr><th>Semester</th><td>' . htmlspecialchars($student['semester']) . '</td></tr>';

    // Display attendance with circle and color
    echo '<tr><th>Attendance</th><td>';
    
    if ($attendance < 50) {
        echo '<div class="attendance-circle attendance-red">' . $attendance ."%". '</div>';
    } elseif ($attendance >= 50 && $attendance < 75) {
        echo '<div class="attendance-circle attendance-yellow">' . $attendance ."%". '</div>';
    } else {
        echo '<div class="attendance-circle attendance-green">' . $attendance ."%".'</div>';
    }

    echo '</td></tr>';
    echo '</table>
          </div>';
} else {
    echo "<p class='error'>No student found with ID: " . htmlspecialchars($studentId) . "</p>";
}
?>
