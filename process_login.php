<?php 
// Include database connection
include('config.php');

// Start session for storing session data (if needed)
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Get the input values
    $registrationId = $_POST['registrationId'] ?? '';
    $password = $_POST['password'] ?? '';
    $userType = $_POST['userType'] ?? '';
    $branch = $_POST['branch'] ?? '';
    $branchCode = $_POST['branchCode'] ?? '';

    // Prepare the SQL query based on user type
    if ($userType == 'student') {
        $sql = "SELECT * FROM students_details WHERE id = ?";
    } elseif ($userType == 'teacher') {
        $sql = "SELECT * FROM admin WHERE branch = ? AND branchcode = ?";
    } elseif ($userType == 'account' || $userType == 'admin') {
        $sql = "SELECT * FROM admin WHERE reg_id = ? AND user_type = ?";
    } else {
        echo "<script>alert('Invalid user type!'); window.history.back();</script>";
        exit;
    }

    // Debugging: Check the SQL query
    echo "Executing SQL Query: $sql<br>";

    // Create prepared statement
    if ($stmt = $conn->prepare($sql)) {
        // Bind the parameters based on user type
        if ($userType == 'student') {
            $stmt->bind_param('s', $registrationId);
        } elseif ($userType == 'teacher') {
            $stmt->bind_param('ss', $branch, $branchCode);
        } elseif ($userType == 'account' || $userType == 'admin') {
            $stmt->bind_param('ss', $registrationId, $userType);
        }

        // Execute the query
        $stmt->execute();

        // Get the result
        $result = $stmt->get_result();

        // Debugging: Check if the query returned any results
        if ($result) {
            echo "Number of rows returned: " . $result->num_rows . "<br>";
        } else {
            echo "Query execution failed: " . $mysqli->error . "<br>";
        }

        // Check if the user exists
        if ($result && $result->num_rows > 0) {
            // Fetch user data
            $row = $result->fetch_assoc();

            // Debugging: Check fetched data
            echo "Fetched Data: " . print_r($row, true) . "<br>";

            // Verify the password based on user type
            if ($userType == 'teacher') {
                // No password check required for teachers
                echo "Teacher login detected. Skipping password verification.<br>";
                $passwordVerified = true;
            } elseif ($userType == 'admin') {
                // For admin, perform plain text comparison
                $passwordVerified = ($password === $row['password']);
                if ($passwordVerified) {
                    echo "Admin password verification successful!<br>";
                } else {
                    echo "Admin password verification failed.<br>";
                    echo "Entered Password: " . htmlspecialchars($password) . "<br>";
                    echo "Stored Password in Database: " . htmlspecialchars($row['password']) . "<br>";
                }
            } else {
                // For other user types (students, etc.), use password_verify
                $passwordVerified = password_verify($password, $row['password']);
                if ($passwordVerified) {
                    echo "Password verification successful!<br>";
                } else {
                    echo "Password verification failed.<br>";
                    echo "Entered Password: " . htmlspecialchars($password) . "<br>";
                    echo "Stored Hash in Database: " . htmlspecialchars($row['password']) . "<br>";
                }
            }

            // Redirect based on user type if verification succeeds
            if ($passwordVerified) {
                // Store registration ID in session for later access
                $_SESSION['registrationId'] = $registrationId; 

                if ($userType == 'student') {
                    $_SESSION['registrationId'] = $registrationId;
                    // Redirect to the student dashboard
                    header('Location: http://localhost:8080/BEC-Students-portal-projects/student.dashboard.php');
                } elseif ($userType == 'teacher') {
                    // Store teacher's branch info in session
                    $_SESSION['branch'] = $row['branch'];
                    $_SESSION['branchcode'] = $row['branchcode'];
                    // Redirect to the teacher dashboard
                    header('Location: teacher_dashboard.php');
                } elseif ($userType == 'account') {
                    // Redirect to the account section dashboard
                    header('Location: account_dashboard.php');
                } elseif ($userType == 'admin') {
                    // Redirect to the admin dashboard
                    header('Location: http://localhost:8080/admin/');
                }
                exit();
            } else {
                // Invalid password
                echo "<script>alert('Invalid password! Please try again.'); window.history.back();</script>";
            }
        } else {
            // No matching user found
            echo "<script>alert('No user found with the given credentials! Please try again.'); window.history.back();</script>";
        }

        // Close the statement
        $stmt->close();
    } else {
        // Error preparing the SQL query
        echo "Error preparing SQL query: " . $mysqli->error . "<br>";
        echo "<script>alert('Error! Please try again.'); window.history.back();</script>";
    }

    // Close the database connection
    $mysqli->close();
}
?>
