<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
 body {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh; /* Viewport height */
  margin: 0;
  font-family: 'Poppins', sans-serif;
  background-image: linear-gradient(#becefd, #fff);
}

.c-input-group {
  width: 500px;
  height: 50vh; /* Set the form width */
  padding: 50px;
  background-color: #fff;
  border-radius: 8px;
  box-shadow: 0 0 10px rgba(137, 137, 137, 0.284);
  transition: 1s;
}

/* Style for the input fields */
.c-input-field {
  position: relative;
}

.c-input-field input {
  width: 100%;
  height: 5vh;
  padding: 20px;
  margin: 15px 0;
  border: 1px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  transition: all 0.3s ease;
}

/* Hover effect for input fields */
.c-input-field input:hover {
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Focus effect when input is clicked */
.c-input-field input:focus {
  outline: none;
  border-color: #007bff;
  box-shadow: 0 0 5px rgba(0, 123, 255, 0.8);
}

/* Icon inside input fields */
.c-input-field i {
  position: absolute;
  right: 10px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  color: #001194;
  font-size: 15px;
}

/* Hover effect on the eye icon */
.c-input-field i:hover {
  color: #0056b3;
}

/* Style for the submit button */
.c-btn input[type="submit"] {
  width: 50%;
  padding: 10px;
  margin-left: 95px;
  margin-top: 20px;
  background-color: #0029be;
  color: white;
  border: none;
  border-radius: 4px;
  font-size: 15px;
  cursor: pointer;
  transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

/* Hover effect for the button */
.c-btn input[type="submit"]:hover {
  background-color: #0056b3;
  box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
}

/* Button focus outline */
.c-btn input[type="submit"]:focus {
  outline: none;
}
</style>
</head>
<body>
    
<form action="">
    <div class="c-input-group">
        <div class="c-input-field">
            <input type="password" id="oldpass" placeholder="Old Password" name="oldpass">
            <i class="fa fa-eye toggle-password" toggle="#oldpass"></i>
        </div>

        <div class="c-input-field">
            <input type="password" id="newpass" placeholder="New Password" name="newpass">
            <i class="fa fa-eye toggle-password" toggle="#newpass"></i>
        </div>

        <div class="c-input-field">
            <input type="password" id="conpass" placeholder="Confirm Password" name="conpass">
            <i class="fa fa-eye toggle-password" toggle="#conpass"></i>
        </div>

        <div class="c-btn">
            <input type="submit" value="Change Password" name="submit">
        </div>
    </div>
</form>

<!-- Add the Font Awesome CDN for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">




<script>
   // Select all the toggle icons
const togglePasswordIcons = document.querySelectorAll('.toggle-password');

togglePasswordIcons.forEach(function(icon) {
    icon.addEventListener('click', function() {
        // Get the related input field
        const input = document.querySelector(icon.getAttribute('toggle'));
        const inputType = input.getAttribute('type') === 'password' ? 'text' : 'password';

        // Toggle the input type between 'password' and 'text'
        input.setAttribute('type', inputType);

        // Toggle the eye/eye-slash icons
        if (inputType === 'text') {
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    });
});

</script>

    
</body>
</html>