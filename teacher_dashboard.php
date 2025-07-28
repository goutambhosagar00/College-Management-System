<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        section {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap; /* Allow content to wrap to multiple rows */
            height: 100vh;
        }

        .container {
            display: flex;
            flex-wrap: wrap;
            width: 80%;
            max-width: 1200px;
            gap: 20px;
            padding: 15px;
        }

        .form-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            flex: 1 1 48%; /* Ensures two forms per row */
        }
        h1{
            color: #FF5733 ;
        }
        h2{
            color: #605bcc;
        }
        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: none;
            margin-bottom: 5px;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            
            
        }
        input{
            border-left: none;
            border-right: none;
            border-top: none;
        }
        .submit-btn {
            background-color: blue;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
        }

        .submit-btn:hover {
            background-color: #0085ff;
        }
        .heading{
            display: flex;
            justify-content: center;
            margin-top: 50px;

        }
        .dash-footer {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 23px;
            background-color: white;
            color: #87a0bf;
            margin-top: 10rem;
        }

        .dash-footer > p {
            color: black;
        }
        .mob-warring{
            display: none;
        }
        @media (max-width: 700px){
            .mob-warring{
                display: block;
                width: 100%;
               

                
            }
            .mob-warring p{
                color: red;
                font-size: 12px;
                
            }

        }
        @media (max-width: 990px) {
            section {
                display: none;
            }
            .dash-footer{
                display: none;
            }
            .heading{
                display: none;
            }
        }
    </style>
</head>

<body>
    <?php
    include_once('header.php');
    ?>
    <div class="mob-warring">
    <p>
    Dashboard access is not available on mobile devices. Please use a desktop or tablet and laptop for full functionality 

    </p>
    </div>

        <h1 class="heading">Teacher Dashboard</h1>
       

    <section>
        <div class="container">
            <!-- First Row: Two forms -->
            <div class="form-container">
                <h2>Enter Student Marks</h2>
                <form action="save_marks.php" method="POST">
                    <div class="form-group">
                        <label for="marksType">Marks Type:</label>
                        <select id="marksType" name="marksType" required>
                            <option value="">Select Type</option>
                            <option value="internal">Internal Marks</option>
                            <option value="lab">Lab Marks</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="studentId">Student ID:</label>
                        <input type="number" id="studentId" name="studentId" placeholder="Enter Student ID" required>
                    </div>
                    <div class="form-group">
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
</div>
                    <div class="form-group">
                        <label for="subjectName">Subject/Lab Name:</label>
                        <input type="text" id="subjectName" name="subjectName" placeholder="Enter Subject or Lab Name" required>
                    </div>
                    <div class="form-group">
                        <label for="marks">Marks:</label>
                        <input type="number" step="0.01" id="marks" name="marks" placeholder="Enter Marks" required>
                    </div>
                    <button type="submit" class="submit-btn">Submit Marks</button>
                </form>
            </div>

            <div class="form-container">
                <h2>Update Student Marks</h2>
                <form action="update_marks.php" method="POST">
                    <div class="form-group">
                        <label for="marksTypeRight">Marks Type:</label>
                        <select id="marksTypeRight" name="marksType" required>
                            <option value="">Select Type</option>
                            <option value="internal">Internal Marks</option>
                            <option value="lab">Lab Marks</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="studentIdRight">Student ID:</label>
                        <input type="number" id="studentIdRight" name="studentId" placeholder="Enter Student ID" required>
                    </div>
                    <div class="form-group">
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
</div>
                    <div class="form-group">
                        <label for="subjectNameRight">Subject/Lab Name:</label>
                        <input type="text" id="subjectNameRight" name="subjectName" placeholder="Enter Subject or Lab Name" required>
                    </div>
                    <div class="form-group">
                        <label for="marksRight">New Marks:</label>
                        <input type="number" step="0.01" id="marksRight" name="marks" placeholder="Enter New Marks" required>
                    </div>
                    <button type="submit" class="submit-btn">Update Marks</button>
                </form>
            </div>

            <!-- Second Row: Two forms -->
            <div class="form-container">
                <h2>Enter Student Attendance</h2>
                <form action="save_attendance.php" method="POST">
                    <div class="form-group">
                        <label for="attendanceType">Attendance Type:</label>
                        <select id="attendanceType" name="attendanceType" required>
                            <option value="">Select Type</option>
                            <option value="attendance">Attendance</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="studentIdAttendance">Student ID:</label>
                        <input type="number" id="studentIdAttendance" name="studentId" placeholder="Enter Student ID" required>
                    </div>
                    <div class="form-group">
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
</div>
                    <div class="form-group">
                        <label for="attendance">Attendance:</label>
                        <input type="number" step="0.01" id="attendance" name="attendance" placeholder="Enter Attendance" required>
                    </div>
                    <button type="submit" class="submit-btn">Submit Attendance</button>
                </form>
            </div>

            <div class="form-container">
                <h2>Update Student Attendance</h2>
                <form action="update_attendance.php" method="POST">
                    <div class="form-group">
                        <label for="attendanceTypeRight">Attendance Type:</label>
                        <select id="attendanceTypeRight" name="attendanceType" required>
                            <option value="">Select Type</option>
                            <option value="attendance">Attendance</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="studentIdAttendanceRight">Student ID:</label>
                        <input type="number" id="studentIdAttendanceRight" name="studentId" placeholder="Enter Student ID" required>
                    </div>
                    <div class="form-group">
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
</div>
                    <div class="form-group">
                        <label for="newAttendance">New Attendance:</label>
                        <input type="number" step="0.01" id="newAttendance" name="attendance" placeholder="Enter New Attendance" required>
                    </div>
                    <button type="submit" class="submit-btn">Update Attendance</button>
                </form>
            </div>
        </div>
       
    </section>

   
    <div class="dash-footer">
        <p>&copy; 2024 Bhubaneswar Engineering College. All Rights Reserved.</p>
    </div>

    
</body>

</html>
