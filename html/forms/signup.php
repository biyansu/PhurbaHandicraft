<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700;900&display=swap" rel="stylesheet">
    <link href="../../login.css" rel="stylesheet">

    <!-- Font Awesome for eye icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        /* Password strength message */
        #strengthMessage {
            margin-top: 5px;
            font-size: 14px;
            font-weight: bold;
        }

        /* Eye icon styling */
        .password-container {
            position: relative;
        }
        .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 18px;
            color: #555;
        }

        /* Error message styling */
        .error {
            color: red;
            font-size: 13px;
            margin-top: 3px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="contact-form">
        <h2>Registration Form</h2>
        <form id="signupForm" action="../includes/signup.php" method="post" novalidate>
            <p>Username</p>
            <input type="text" id="username" name="username">
            <div id="usernameError" class="error"></div>

            <p>Email</p>
            <input type="email" id="email" name="email">
            <div id="emailError" class="error"></div>

            <p>Contact</p>
            <input type="number" id="contact" name="contact">
            <div id="contactError" class="error"></div>

            <p>Address</p>
            <input type="text" id="address" name="address">
            <div id="addressError" class="error"></div>

            <p>Password</p>
            <div class="password-container">
                <input type="password" id="password" name="password" onkeyup="checkPasswordStrength()">
                <i class="fa-solid fa-eye toggle-password" id="togglePassword" onclick="togglePassword('password', 'togglePassword')"></i>
            </div>
            <div id="strengthMessage"></div>
            <div id="passwordError" class="error"></div>

            <p>Re-password</p>
            <div class="password-container">
                <input type="password" id="repassword" name="repassword">
                <i class="fa-solid fa-eye toggle-password" id="toggleRepassword" onclick="togglePassword('repassword', 'toggleRepassword')"></i>
            </div>
            <div id="repasswordError" class="error"></div>

            <input type="submit" value="Sign up" name="submit">

            <p>Already have an account? <a href="login.php" style="color:rgb(0, 0, 0)">Login Here</a>.</p>
            <p><a href="../../index.php" style="color:rgb(0, 0, 0)">Go Back</a></p>
        </form>
    </div>

    <script>
        function togglePassword(fieldId, iconId) {
            var passwordField = document.getElementById(fieldId);
            var icon = document.getElementById(iconId);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordField.type = "password";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        function checkPasswordStrength() {
            var password = document.getElementById("password").value;
            var strengthMessage = document.getElementById("strengthMessage");

            var strongPattern = new RegExp("^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[\\W_]).{8,}$");
            var mediumPattern = new RegExp("^(((?=.*[a-z])(?=.*[A-Z]))|((?=.*[a-z])(?=.*[0-9]))|((?=.*[A-Z])(?=.*[0-9]))).{6,}$");

            if (strongPattern.test(password)) {
                strengthMessage.style.color = "green";
                strengthMessage.innerHTML = "Strong Password";
            } else if (mediumPattern.test(password)) {
                strengthMessage.style.color = "orange";
                strengthMessage.innerHTML = "Medium Password";
            } else {
                strengthMessage.style.color = "red";
                strengthMessage.innerHTML = "Weak Password";
            }
        }

        document.getElementById('signupForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Prevent actual form submit
            validateForm();
        });

        function validateForm() {
            let isValid = true;

            // Clear all error messages
            document.querySelectorAll('.error').forEach(function(el) {
                el.innerHTML = "";
            });

            var username = document.getElementById("username").value.trim();
            var email = document.getElementById("email").value.trim();
            var contact = document.getElementById("contact").value.trim();
            var address = document.getElementById("address").value.trim();
            var password = document.getElementById("password").value;
            var repassword = document.getElementById("repassword").value;

            // Username validation
            if (username == "") {
                document.getElementById("usernameError").innerHTML = "Username is required.";
                isValid = false;
            }

            // Email validation
            var emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailPattern.test(email)) {
                document.getElementById("emailError").innerHTML = "Please enter a valid email address.";
                isValid = false;
            }

            // Contact validation
            var contactPattern = /^[0-9]{10}$/;
            if (!contactPattern.test(contact)) {
                document.getElementById("contactError").innerHTML = "Contact must be exactly 10 digits.";
                isValid = false;
            }

            // Address validation
            if (address == "") {
                document.getElementById("addressError").innerHTML = "Address is required.";
                isValid = false;
            }

            // Password validation
            var passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
            if (!passwordPattern.test(password)) {
                document.getElementById("passwordError").innerHTML = "Password must be 8+ chars with uppercase, lowercase, number, and special character.";
                isValid = false;
            }

            // Re-password match
            if (password !== repassword) {
                document.getElementById("repasswordError").innerHTML = "Passwords do not match.";
                isValid = false;
            }

            if (isValid) {
                document.getElementById("signupForm").submit(); // Submit the form if valid
            }
        }
    </script>
</body>
</html>
