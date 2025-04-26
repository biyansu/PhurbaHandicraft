<?php
    require('dbcon.php');
    print_r($_POST);
    $email=$_POST['email'];
    $password=$_POST['password'];
    $username=$_POST['username'];
    $contact=$_POST['contact'];
    $address=$_POST['address'];

    $password = password_hash($password,PASSWORD_BCRYPT);
    
    $query ="INSERT INTO `users`(`email`, `username`, `contact`, `address`, `password`) VALUES ('$email','$username','$contact','$address','$password')";
    $result = mysqli_query($con,$query);
    if($result==1)
    {
        $msg="Account Created";
    }
    else{
        $msg="Something went wrong";
    }
    header("location: http://localhost/project/html/forms/login.php?msg=$msg");
?>