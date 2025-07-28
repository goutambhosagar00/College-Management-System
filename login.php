<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
  /* Reset and basic styling */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: rgb(245, 247, 255);
    
    height: 100vh;
}

.login-container {
    width: 100%;
    max-width: 400px;
    padding: 20px;
    background-color: rgb(255, 255, 255);
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    border-radius: 8px;
    text-align: center;
    
}
.l-page{
    display: flex;
    justify-content: center;
    margin-top: 100px;
}

.r-page{
    display: flex;
    justify-content: center;
    align-items: center;
}
.r-page a {
    margin-top: 20px;
    font-weight: 50;
    font-size: 15px;
    text-decoration: none;
    color: #078bff;
}

.r-page a:hover{
    color: #87a0bf;
}


.login-container h2 {
    margin-bottom: 20px;
    color: #333;
}

form {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

input[type="text"],
input[type="password"],
select {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border: 1px solid #ccc;
    border-radius: 4px;
    outline: none;
    transition: border-color 0.2s ease;
    margin-top: 12px;
    cursor: pointer;
}

input[type="text"]:focus,
input[type="password"]:focus,
select:focus {
    border-color: #007bff;
}

/* Placeholder styles for the <select> */
select option[value=""][disabled] {
    color: #888;
}

button {
    padding: 10px;
    font-size: 16px;
    font-weight: bold;
    color: #fff;
    background-color: #007bff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #0056b3;
}

.r-page{
    margin-top: 15px;
}
.r-page a {
    text-decoration: none;
    
}

/* Responsive for mobile view */
@media (max-width: 768px) {
    .login-container{
        margin: 10px;
    }
    .desktop-only {
        display: none;
    }
}

    </style>
</head>
<body>
    <?php
    include_once('header.php');
  ?>
  <section class="l-page">

  
    <div class="login-container">
        <h2>Login</h2>
        <form id="loginForm" method="POST" action="process_login.php">
            <!-- User Type Select with Placeholder -->
            <select id="userType" name="userType" onchange="showRoleFields()">
    <option value="" disabled selected>Select User Type</option>
    <option value="student">Students</option>
    <option value="teacher">Teachers</option>
    <option value="account">Account Section</option>
    <option value="admin">Admin</option>
</select>
    
            <!-- Registration ID and Password for Student, Account Section, and Admin -->
            <div id="commonFields" class="common-fields">
            <input type="text" id="registrationId" name="registrationId" placeholder="Registration ID">
            <input type="password" id="password" name="password" placeholder="Enter Password">
            </div>
    
            <!-- Branch Select for Teacher Only -->
            <div id="teacherFields" class="role-fields" style="display: none;">
                <select id="branch" name="branch">
                    <option value="" disabled selected>Select Branch</option>
                    <option value="cse">CSE</option>
                    <option value="ece">ECE</option>
                    <option value="eee">EEE</option>
                    <option value="mech">Mechanical</option>
                    <option value="civil">civil</option>
                </select>
                <input type="text" id="branchCode" name="branchCode" placeholder="Enter Branch Code">
            </div>
    
            <!-- Submit Button -->
            <button type="submit">Login</button>
        </form>
        <div class="r-page">
            <a href="index.php">Registration</a>
        </div>
    </div>
    
    </section>



    
    <script>
        // Function to handle visibility based on selected user type
function showRoleFields() {
    const userType = document.getElementById("userType").value;
    const commonFields = document.getElementById("commonFields");
    const teacherFields = document.getElementById("teacherFields");

    // Show/hide fields based on user type selection
    if (userType === "student" || userType === "account" || userType === "admin") {
        commonFields.style.display = "block";
        teacherFields.style.display = "none";
    } else if (userType === "teacher") {
        commonFields.style.display = "none";
        teacherFields.style.display = "block";
    } else {
        commonFields.style.display = "none";
        teacherFields.style.display = "none";
    }
}

// Function to adjust options based on screen size (desktop vs. mobile)
function adjustUserTypeOptions() {
    const userTypeSelect = document.getElementById("userType");
    const screenWidth = window.innerWidth;

    // If mobile view, only show "Student" option
    if (screenWidth <= 768) {
        Array.from(userTypeSelect.options).forEach(option => {
            option.style.display = option.value === "student" || option.value === "" ? "block" : "none";
        });
        // Automatically select "Student" option in mobile view
        userTypeSelect.value = "student";
        showRoleFields();
    } else {
        // Show all options in desktop view
        Array.from(userTypeSelect.options).forEach(option => {
            option.style.display = "block";
        });
        userTypeSelect.value = ""; // Reset selection on desktop view
    }
}

// Initial adjustment and listener for window resizing
adjustUserTypeOptions();
window.addEventListener("resize", adjustUserTypeOptions);

    </script>






</body>
</html>