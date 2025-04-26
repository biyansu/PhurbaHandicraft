<?php
require('dbcon.php');

print_r($_POST);
$email = $_POST['email'];
$password = $_POST['password'];

$query = "SELECT * FROM `users` WHERE email='$email'";
$result = mysqli_query($con, $query);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);

    session_start();

    if (password_verify($password, $user["password"])) {
        if ($user['role'] == 'admin') {
            $_SESSION['admin'] = $user;
            $msg = "Login successful";
            header("location: http://localhost/project/html/admin/dashboard.php?msg=$msg");
        } else {
            $_SESSION['user'] = $user;
            $msg = "Login successful";
            header("location: http://localhost/project/user_index.php?msg=$msg");
        }
    } else {
        $msg = "Login unsuccessful";
        header("location: http://localhost/project/html/forms/login.php?msg=$msg");
    }
} else {
    $msg = "Login unsuccessful";
    header("location: http://localhost/project/html/forms/login.php?msg=$msg");
}
?>
