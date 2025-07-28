<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Section </title>
    <style>
        section {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
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

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: none;
            margin-bottom: 5px;
        }
        input{
            border-left: none;
            border-right: none;
            border-top: none;
        }

        input,
        select {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            box-sizing: border-box;
            border: none;
        }

        .submit-btn {
            background-color: #ffac87;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            width: 100%;
            margin-top: 15px;
        }
        h1{
            color: green;
        }
        .submit-btn:hover {
            background-color: #edb39a  ;
        }
        h2{
            color: #25bd69 ;
        }

        .heading {
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

    <h1 class="heading">Account Dashboard</h1>

    <section>
        <div class="container">
            <!-- First Row: Two forms -->
            <div class="form-container">
                <h2>Enter Course Fees</h2>
                <form action="save_coursefees.php" method="POST">
                    <div class="form-group">
                        <label for="id">Student ID:</label>
                        <input type="number" id="id" name="id" placeholder="Enter Student ID" required>
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
                        <label for="course_name">Course Name:</label>
                        <!-- Dropdown for Course Name -->
                        <select id="course_name" name="course_name" required>
                            <option value="">Select Course</option>
                            <option value="B.Tech">B.Tech</option>
                            <option value="MBA">MBA</option>
                            <option value="Diploma">Diploma</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="course_fees">Course Fees:</label>
                        <input type="number" id="course_fees" name="course_fees" placeholder="Enter Course Fees" required>
                    </div>
                    <div class="form-group">
                        <label for="deposite_date">Deposit Date:</label>
                        <input type="date" id="deposite_date" name="deposite_date" required>
                    </div>
                    <button type="submit" class="submit-btn">Submit Course Fees</button>
                </form>
            </div>

            <!-- Course Fees Form: Update -->
            <div class="form-container">
                <h2>Update Course Fees</h2>
                <form action="update_coursefees.php" method="POST">
                    <div class="form-group">
                        <label for="id_update">Student ID:</label>
                        <input type="number" id="id_update" name="id" placeholder="Enter Student ID" required>
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
                        <label for="course_name_update">Course Name:</label>
                        <!-- Dropdown for Course Name -->
                        <select id="course_name_update" name="course_name" required>
                            <option value="">Select Course</option>
                            <option value="B.Tech">B.Tech</option>
                            <option value="MBA">MBA</option>
                            <option value="Diploma">Diploma</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="course_fees_update">Course Fees:</label>
                        <input type="number" id="course_fees_update" name="course_fees" placeholder="Enter Course Fees" required>
                    </div>
                    <div class="form-group">
                        <label for="deposite_date_update">Deposit Date:</label>
                        <input type="date" id="deposite_date_update" name="deposite_date" required>
                    </div>
                    <button type="submit" class="submit-btn">Update Course Fees</button>
                </form>
            </div>

            <!-- Hostel Fees Form: Store -->
            <div class="form-container">
                <h2>Enter Hostel Fees</h2>
                <form action="save_hostelfees.php" method="POST">
                    <div class="form-group">
                        <label for="id_hostel">Student ID:</label>
                        <input type="number" id="id_hostel" name="id" placeholder="Enter Student ID" required>
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
                        <label for="hostel_fees">Hostel Fees:</label>
                        <input type="number" id="hostel_fees" name="hostel_fees" placeholder="Enter Hostel Fees" required>
                    </div>
                    <div class="form-group">
                        <label for="deposite_date_hostel">Deposit Date:</label>
                        <input type="date" id="deposite_date_hostel" name="deposite_date" required>
                    </div>
                    <button type="submit" class="submit-btn">Submit Hostel Fees</button>
                </form>
            </div>

            <!-- Hostel Fees Form: Update -->
            <div class="form-container">
                <h2>Update Hostel Fees</h2>
                <form action="update_hostelfees.php" method="POST">
                    <div class="form-group">
                        <label for="id_hostel_update">Student ID:</label>
                        <input type="number" id="id_hostel_update" name="id" placeholder="Enter Student ID" required>
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
                        <label for="hostel_fees_update">Hostel Fees:</label>
                        <input type="number" id="hostel_fees_update" name="hostel_fees" placeholder="Enter Hostel Fees" required>
                    </div>
                    <div class="form-group">
                        <label for="deposite_date_hostel_update">Deposit Date:</label>
                        <input type="date" id="deposite_date_hostel_update" name="deposite_date" required>
                    </div>
                    <button type="submit" class="submit-btn">Update Hostel Fees</button>
                </form>
            </div>

        </div>
    </section>
    <div class="dash-footer">
        <p>&copy; 2024 Bhubaneswar Engineering College. All Rights Reserved.</p>
    </div>

</body>

</html>
