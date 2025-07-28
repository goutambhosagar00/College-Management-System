<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: 'Poppins', sans-serif;
            box-sizing: border-box;
        }

        h3 {
            margin-bottom: 1rem;
            color: #4747d1;
        }

        .dash-container {
            width: 96%;
            max-width: 1200px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            border: none; /* Border around the full container */
            padding: 20px;
            background-color: #e5e5ff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto; /* Ensure it's centered on the page */
        }

        .content-box {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            width: 50%;
            margin-bottom: 20px;
        }

        .box-btn {
            
            display: flex;
            justify-content: center;
            align-items: center;
            border: none;
            border-radius: 8px;
            height: 150px;
            background: white;
            box-shadow: 0 0 10px rgba(137, 137, 137, 0.284);
            transition: all 0.3s ease;
            transform: scale(1); /* Default scale */
        }

        .box-btn button {
            width: 50%;
            height: 50%;
            background-color: #9999ff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }

        .box-btn button:hover {
            background-color: #ff9999;
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }

        .show-results {
            width: 100%;
            min-height: 200px;
            border: 2px solid #ccc;
            border-radius: 8px;
            padding: 20px;
            background-color: #f9f9f9;
            text-align: center;
        }

        .dash-footer {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 23px;
            background-color: white;
            color: #87a0bf;
            margin-top: 2rem;
        }

        .dash-footer  p {
            color: black;
            

        }
  

        /* Responsive Design */
        @media (max-width: 768px) {
            .box-btn button {
                font-size: 8px;
            }

            .box-btn {
                width: 100px;
                height: 100px;
            }

            .content-box {
                margin-right: 4.8rem;
            }
            .dash-footer{
                font-size: 10px;
            }
            .show-results p{
                font-size: 12px;
            }
          
        }

        @media (min-width: 400px) and (max-width: 1000px) {
            .dash-footer > p {
                font-size: 10px;

                
            }
            .content-box {
                margin-right: -0.1rem;
            }
           
           
           
        }
        @media (min-width: 300px){
            .dash-footer p{
            font-size: 7px;
        }
        }

        /* Animation when clicked */
        .zoom-out {
            transform: scale(0.5); /* Shrinks the button */
            transition: transform 0.2s ease; /* Smooth transition */
        }
    </style>
</head>

<body>
    
<?php
    include_once('header.php');
  ?>


<div class="account-icon" id="accountIcon">
  <i class="fa-regular fa-user"></i>
</div>

<div class="account-container" id="accountContainer" style="display: none;">
  <div class="hamburger-btn" id="hamburgerBtn">
    <i class="fa-solid fa-xmark"></i>
  </div>

  <div class="profile">
    <i class="fa-regular fa-user"></i>
    <h7>My Profile</h7>
  </div>

  <div class="content-list">
    <ul>
      <li><a href="#">Student Details</a></li>
      <li><a href="change-pass.php">Change Password</a></li>
      <li><a href="#">Log Out</a></li>
    </ul>
  </div>
</div>













<div class="dash-container">
    <h3>Student Dashboard</h3>

    <div class="content-box">
        <div class="box-btn">
            <button type="button" class="clickable">Attendance</button>
        </div>

        <div class="box-btn">
            <button type="button" class="clickable">Internal Marks</button>
        </div>

        <div class="box-btn">
            <button type="button" class="clickable">Course Fees</button>
        </div>

        <div class="box-btn">
            <button type="button" class="clickable">Hostel Fees</button>
        </div>
    </div><!-- end content box -->

    <div class="show-results">
        <p>Results will be displayed here.</p>
    </div><!-- end results box -->

</div><!-- end dash container -->



    <div class="dash-footer">
        <p>&copy; 2024 Bhubaneswar Engineering College. All Rights Reserved.</p>
    </div>


    <script>
 // Get elements
const accountIcon = document.getElementById('accountIcon');
const accountContainer = document.getElementById('accountContainer');
const hamburgerBtn = document.getElementById('hamburgerBtn');

// Show the account container when clicking on the account icon
accountIcon.addEventListener('click', function() {
    accountContainer.style.display = 'block';
});

// Hide the account container when clicking on the hamburger button (close button)
hamburgerBtn.addEventListener('click', function() {
    accountContainer.style.display = 'none';
});

const buttons = document.querySelectorAll('.clickable');

// Loop through each button and add a click event listener
buttons.forEach(button => {
    button.addEventListener('click', function () {
        // Add zoom-out class on click for animation effect
        this.parentElement.classList.add('zoom-out');

        // After the animation, remove the class to reset the effect for future clicks
        setTimeout(() => {
            this.parentElement.classList.remove('zoom-out');
        }, 300); // The timeout should match the transition duration (0.3s)

        // Determine what data to fetch based on the button clicked
        const buttonText = this.innerText;
        let endpoint = '';

        // Determine which endpoint to use based on button click
        switch (buttonText) {
            case 'Attendance':
                endpoint = 'attendance.php';
                break;
            case 'Internal Marks':
                endpoint = 'internal_marks.php';
                break;
            case 'Course Fees':
                endpoint = 'course_fees.php';
                break;
            case 'Hostel Fees':
                endpoint = 'hostel_fees.php';
                break;
            default:
                endpoint = '';
        }


        // Only make the fetch call if an endpoint is set
        if (endpoint) {
            // Get the registrationId value
            const registrationId = document.getElementById('$registrationId') ? document.getElementById('$registrationId').value : '';

            // Make the fetch call with the studentId
            fetch(endpoint, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: `studentId=${registrationId}` // Send the studentId in the request body
            })
            .then(response => response.text())
            .then(data => {
                // Insert the response data into the show-results div
                document.querySelector('.show-results').innerHTML = data;
            })
            .catch(error => console.error('Error:', error));
        }
    });
});

</script>




</body>
</html>


