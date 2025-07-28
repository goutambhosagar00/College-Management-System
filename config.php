<?php
// Database connection settings
$host = 'localhost';  // Host name (use 'localhost' if running locally)
$username = 'root';   // Your MySQL username (default for XAMPP is 'root')
$password = '';       // Your MySQL password (default for XAMPP is empty)
$database = 'college_db';  // Your database name

// Create a new MySQLi connection
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
?>
