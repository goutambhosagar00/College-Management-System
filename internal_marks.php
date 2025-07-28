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

// Bind the student ID parameter (assuming it's a string)
$stmt->bind_param("s", $studentId);

// Execute the query and check if successful
if (!$stmt->execute()) {
    echo "<p>Error executing query: " . $stmt->error . "</p>";
    exit;
}

// Get the result of the query
$result = $stmt->get_result();

// Start HTML output
echo '<style>
.table-container {
    background-color: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    margin-bottom: 20px;
    overflow-x: auto; /* Add horizontal scrolling for small screens */
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
    echo '<div class="table-container">
            <h2>GET YOUR RESULT</h2>
            <table>
                <tr><th>Full Name</th><td>' . htmlspecialchars($student['fullname']) . '</td></tr>
                <tr><th>Registration ID</th><td>' . htmlspecialchars($student['id']) . '</td></tr>
                <tr><th>Branch</th><td>' . htmlspecialchars($student['branch']) . '</td></tr>
                <tr><th>Semester</th><td>' . htmlspecialchars($student['semester']) . '</td></tr>
            </table>
          </div>';
} else {
    echo "<p class='error'>No student found with ID: " . htmlspecialchars($studentId) . "</p>";
}

// Query to fetch internal marks (subject_name and marks)
$queryMarks = "SELECT subject_name, marks FROM internal_marks WHERE student_id = ?";
$stmtMarks = $conn->prepare($queryMarks);

// Check if the query preparation was successful
if (!$stmtMarks) {
    die("SQL preparation failed: " . $conn->error);
}

// Bind the student ID parameter for internal marks
$stmtMarks->bind_param("s", $studentId);

// Execute the query for internal marks
if (!$stmtMarks->execute()) {
    echo "<p class='error'>Error executing query: " . $stmtMarks->error . "</p>";
    exit;
}

// Get the result for internal marks
$resultMarks = $stmtMarks->get_result();

if ($resultMarks->num_rows > 0) {
    echo '<div class="table-container">
            <h3>Internal Marks</h3>
            <table>
                <tr><th>Subject</th><th>Marks</th></tr>';
    while ($row = $resultMarks->fetch_assoc()) {
        echo "<tr><td>" . htmlspecialchars($row['subject_name']) . "</td><td>" . htmlspecialchars($row['marks']) . "</td></tr>";
    }
    echo '</table></div>';
} else {
    echo "<p class='error'>No internal marks found for Registration ID: " . htmlspecialchars($studentId) . "</p>";
}

// Query to fetch lab marks (lab_name and marks)
$queryLabMarks = "SELECT lab_name, marks FROM lab_marks WHERE student_id = ?";
$stmtLabMarks = $conn->prepare($queryLabMarks);

// Check if the query preparation was successful
if (!$stmtLabMarks) {
    die("SQL preparation failed: " . $conn->error);
}

// Bind the student ID parameter for lab marks
$stmtLabMarks->bind_param("s", $studentId);

// Execute the query for lab marks
if (!$stmtLabMarks->execute()) {
    echo "<p class='error'>Error executing query: " . $stmtLabMarks->error . "</p>";
    exit;
}

// Get the result for lab marks
$resultLabMarks = $stmtLabMarks->get_result();

if ($resultLabMarks->num_rows > 0) {
    echo '<div class="table-container">
            <h3>Lab Marks</h3>
            <table>
                <tr><th>Lab Subject</th><th>Marks</th></tr>';
    while ($row = $resultLabMarks->fetch_assoc()) {
        echo "<tr><td>" . htmlspecialchars($row['lab_name']) . "</td><td>" . htmlspecialchars($row['marks']) . "</td></tr>";
    }
    echo '</table></div>';
} else {
    echo "<p class='error'>No lab marks found for Registration ID: " . htmlspecialchars($studentId) . "</p>";
}

// Close the database connection
$stmt->close();
$stmtMarks->close();
$stmtLabMarks->close();
$conn->close();
?>
