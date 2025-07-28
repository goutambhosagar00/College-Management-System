<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BEC-Students-Portal</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
  <?php
    include_once('header.php');
  ?>
 
    <div class="container">
        
    <div class="form-box">
    <h1 class="title">Registration</h1>
   
    <form action="register_student.php"  method="post"   class="r-form-disable rform">
        <div class="input-group">

                    <div class="input-field">

                        <input type="text" placeholder="First Name" name="fname">

                    </div><!--end input field-->

                    <div class="input-field">

                        <input type="text" placeholder="Middle Name" name="mname">

                    </div><!--end input field-->

                    <div class="input-field">

                        <input type="text" placeholder="Last Name" name="lname">

                    </div><!--end input field-->

                    <div class="input-field">

                        <input type="text" placeholder="Registration ID" name="rid">

                    </div><!--end input field-->

                    <div class="input-field">

                        <input type="email" placeholder="Gmail ID " name="gid">

                    </div><!--end input field-->

                    <div class="input-field">

                        <input type="text" placeholder="Phone Number" name="pn">

                    </div><!--end input field-->

                    <div class="input-field">

                        <input type="date" placeholder="DOB" name="dob">

                    </div><!--end input field-->

                    <div class="input-fied">

                        <input type="radio"  name="gender">
                        <label>Male</label>
                        <input type="radio"  name="gender">
                        <label>Female</label>
                        

                    </div><!--end input field-->

                    <div class="input-field">
    <select class="form-control" id="course" name="course" required>
        <option value="" disabled selected>Select Course</option>
        <option value="MBA">MBA</option>
        <option value="B TECH">B TECH</option>
        <option value="DIPLOMA">DIPLOMA</option>
    </select>
</div><!--end input field-->

<div class="input-field">
    <select class="form-control" id="branch" name="branch" required>
        <option value="" disabled selected>Select Branch</option>
        <option value="CSE">CSE</option>
        <option value="EEE">EEE</option>
        <option value="ECE">ECE</option>
        <option value="CIVIL">CIVIL</option>
        <option value="MECH">MECH</option>
        <option value="AERO">AERO</option>
    </select>
</div><!--end input field-->


<div class="input-field">
    <select class="form-control" id="semester" name="semester" required>
        <option value="" disabled selected>Select Semester</option>
        <option value="Semester 1">Semester 1</option>
        <option value="Semester 2">Semester 2</option>
        <option value="Semester 3">Semester 3</option>
        <option value="Semester 4">Semester 4</option>
        <option value="Semester 5">Semester 5</option>
        <option value="Semester 6">Semester 6</option>
        <option value="Semester 7">Semester 7</option>
        <option value="Semester 8">Semester 8</option>
    </select>
</div><!--end input field-->
                    <div class="input-field">

                        <input type="password" placeholder="Create Password" name="createpass">

                    </div><!--end input field-->

                    <div class="input-field">

                        <input type="password" placeholder="Confirm Password" name="confirmpass">

                    </div><!--end input field-->

                    
         </div><!--end input group -->
         <div class="input-btn">

            <input type="submit" value="Submit" name="submit">

        </div><!--end input field-->

        <div class="login-page">
            <a href="login.php">login</a>
        </div>

        
    </form>


 
   
    
    </div><!--end form box-->
    
    </div><!--end container-->

    <?php
    include_once('footer.php');
  ?>
    
    
    <script src="script.js"></script>
</body>
</html>