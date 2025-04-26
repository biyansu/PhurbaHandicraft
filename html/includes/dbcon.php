
<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $db = "endll";

    $con = mysqli_connect($server, $username, $password,$db);

    if(!$con){
        die("connection to this db failed due to").
        mysqli_connect_error();
    }
?>






