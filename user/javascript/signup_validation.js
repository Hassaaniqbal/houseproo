// Function to validate the form fields
function validateForm() {
    var firstName = document.getElementById("name").value.trim();
    var lastName = document.getElementById("lastname").value.trim();
    var phoneNumber = document.getElementById("number").value.trim();
    var email = document.getElementById("email").value.trim();
    var password = document.getElementById("password").value.trim();
    var confirmPassword = document.getElementById("password_confirmation").value.trim();

    // Flag to track if any validation error occurs
    var isValid = true;

    // Resetting previous error messages
    var errorMessages = document.querySelectorAll('.error-message');
    errorMessages.forEach(function (element) {
        element.textContent = '';
    });

    // Validating first name
    if (firstName === '') {
        document.getElementById('name-error').textContent = 'First name is required';
        isValid = false;
    }

    // Validating last name
    if (lastName === '') {
        document.getElementById('lastname-error').textContent = 'Last name is required';
        isValid = false;
    }

    // Validating phone number
    if (phoneNumber === '') {
        document.getElementById('number-error').textContent = 'Phone number is required';
        isValid = false;
    }

    // Validating email
    if (email === '') {
        document.getElementById('email-error').textContent = 'Email is required';
        isValid = false;
    } else if (!isValidEmail(email)) {
        document.getElementById('email-error').textContent = 'Please enter a valid email address';
        isValid = false;
    }

    // Validating password
    if (password === '') {
        document.getElementById('password-error').textContent = 'Password is required';
        isValid = false;
    } else if (password.length < 8) {
        document.getElementById('password-error').textContent = 'Password must be at least 8 characters';
        isValid = false;
    } else if (!/\d/.test(password) || !/[a-zA-Z]/.test(password)) {
        document.getElementById('password-error').textContent = 'Password must contain at least one letter and one number';
        isValid = false;
    }

    // Validating password confirmation
    if (confirmPassword === '') {
        document.getElementById('password-confirm-error').textContent = 'Please confirm your password';
        isValid = false;
    } else if (password !== confirmPassword) {
        document.getElementById('password-confirm-error').textContent = 'Passwords do not match';
        isValid = false;
    }

    return isValid;
}

// Function to validate email format
function isValidEmail(email) {
    var emailRegex = /\S+@\S+\.\S+/;
    return emailRegex.test(email);
}
