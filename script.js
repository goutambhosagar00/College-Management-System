/*let logInbtn = document.querySelector('.lbtn');
let registrationbtn = document.querySelector('.rbtn');
let Title = document.querySelector('.title');
let rForm = document.querySelector('.rform');
let lForm = document.querySelector('.lform');

logInbtn.addEventListener('click', () => {
    rForm.style.display = 'none';  // Hide the registration form
    lForm.style.display = 'block'; // Show the login form
    Title.innerHTML = 'Login';  // Update the title to 'Login'
});

registrationbtn.addEventListener('click', () => {
    lForm.style.display = 'none';  // Hide the login form
    rForm.style.display = 'block'; // Show the registration form
    Title.innerHTML = 'Registration';  // Update the title to 'Registration'
});*/

let logInbtn = document.querySelector('.lbtn');
let registrationbtn = document.querySelector('.rbtn');
let Title = document.querySelector('.title');
let rForm = document.querySelector('.rform');
let lForm = document.querySelector('.lform');

logInbtn.addEventListener('click', () => {
    rForm.style.display = 'none';  // Hide the registration form
    lForm.style.display = 'block'; // Show the login form
    Title.innerHTML = 'Login';  // Update the title to 'Login'

     
    logInbtn.classList.add('.active');  // Add active class to login button
    registrationbtn.classList.remove('.active');  // Remove active class from registration button
});

registrationbtn.addEventListener('click', () => {
    lForm.style.display = 'none';  // Hide the login form
    rForm.style.display = 'block'; // Show the registration form
    Title.innerHTML = 'Registration';  // Update the title to 'Registration'
    
    registrationbtn.classList.add('.active');  // Add active class to registration button
    logInbtn.classList.remove('.active');  // Add active class to login button
});

/*
let logInbtn = document.querySelector('.lbtn');
let registrationbtn = document.querySelector('.rbtn');
let Title = document.querySelector('.title');
let rForm = document.querySelector('.rform');
let lForm = document.querySelector('.lform');

logInbtn.addEventListener('click', () => {
    rForm.style.display = 'none';  // Hide the registration form
    lForm.style.display = 'block'; // Show the login form
    Title.innerHTML = 'Login';  // Update the title to 'Login'
    
    logInbtn.classList.add('active');  // Add active class to login button
    registrationbtn.classList.remove('active');  // Remove active class from registration button
});

registrationbtn.addEventListener('click', () => {
    lForm.style.display = 'none';  // Hide the login form
    rForm.style.display = 'block'; // Show the registration form
    Title.innerHTML = 'Registration';  // Update the title to 'Registration'
    
    registrationbtn.classList.add('active');  // Add active class to registration button
    logInbtn.classList.remove('active');  // Remove active class from login button
});
*/


/*student dashboard account work*/


