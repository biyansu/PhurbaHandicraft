<?php
    require('dbcon.php');
    print_r($_POST);

    $product_id = $_POST['product_id'];
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    $quantity = $_POST['quantity'];

    $sql = "INSERT INTO `cart`( `quantity`, `amount`, `product_id`,`user_id`) VALUES ('$quantity','$amount','$product_id','$user_id')";
    $result = mysqli_query($con,$sql);
    if ($result==1){
        $msg = "added to cart";
    }
    else{
        $msg  = "not added to cart";
    }
    header("location:../users/dashboard.php?msg=$msg");
?>