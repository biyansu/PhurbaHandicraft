<?php
require('dbcon.php');
session_start();  // Start the session

// Set session timeout duration (e.g., 30 minutes)
$timeout_duration = 30 * 60;  // 30 minutes in seconds

// Check if the session has timed out
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout_duration) {
    // If session has timed out, destroy the session and redirect to login page
    session_unset();
    session_destroy();
    header("Location: http://localhost/project/html/forms/admin.php?msg=Session timeout, please log in again");
    exit();
}

// Update last activity time
$_SESSION['last_activity'] = time();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $query = "SELECT * FROM `admin` WHERE email='$email'";
    $result = mysqli_query($con, $query);

    if (mysqli_num_rows($result) > 0) {
        $admin = mysqli_fetch_assoc($result);

        if (password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = $admin;
            $_SESSION['last_activity'] = time();  // Set last activity time to current time
            $msg = "Admin login successful";
            header("location: http://localhost/project/html/admin/dashboard.php?msg=$msg");
        } else {
            $msg = "Incorrect password";
        }
    } else {
        $msg = "Admin not found";
    }

    header("location: http://localhost/project/html/forms/admin.php?msg=$msg");
}
?>
