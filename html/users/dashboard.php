<?php
require('../includes/dbcon.php');
    session_start();
    $user = $_SESSION['user'];
    // print_r($user);

  if(isset($_POST["action"])){

    if($_POST['action'] == "delete"){
      $id = $_POST['id'];
      $sql = "DELETE FROM cart where id = $id";
  
      $result = mysqli_query($con, $sql);
      if($result == 1){
        $msg = "Cart Deleted";
      }else{
        $msg = "Something went wrong";
      } 
    }

    else if($_POST['action'] == "delete_all"){
      $sql = "DELETE FROM cart";
  
      $result = mysqli_query($con, $sql);
      if($result == 1){
        $msg = "All Cart Deleted";
      }else{
        $msg = "Something went wrong";
      } 
    }
    // Get the number of orders for the user
$user_id = $user['id'];
$sql = "SELECT COUNT(*) as num_orders FROM orders WHERE user_id = $user_id";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$num_orders = $row['num_orders'];
  }

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>Shopping cart</title>
    <link rel="stylesheet" href="../../css/user/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>

     <style>
      .sidebar .nav-links li a.active{
  background: darkgray;
}
.sidebar .nav-links li a:hover{
  background: darkgray;
}
        /* Your existing styles */
        .checkout{
            height: 100vh;
            position: absolute;
            width: 100%;
            background: white;
            display: none;
        }
        .checkout-active{
            display: block;
        }
        .sidebar {
            background-color: black; /* Change this to your desired brown color */
        }
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px; /* Set an appropriate height for the container */
        }
        .btn {
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn.bg-primary {
            background-color: black; /* Blue color */
            color: #fff;
        }
        .btn.bg-primary:hover {
            background-color: black; /* Darker shade of blue on hover */
        }
        .btn.bg-danger {
            background-color: black; /* Red color */
            color: #fff;
        }
        .btn.bg-danger:hover {
            background-color: black; /* Darker shade of red on hover */
        }
        .btn.white-text {
            color: #fff; /* White text color */
        }
        .same-size {
            width: 150px; /* Adjust as needed */
        }
        /* Adjustments for section spacing */
        .home-section {
            margin-bottom: 20px; /* Adjust the spacing between sections */
        }
    </style>
</head>

<body>

  <div class="sidebar">
    <div class="logo-container">
      <div class="logo-details">
            <span class="logo_name" style="font-family: 'Arial', sans-serif; font-size: 30px;">PHURBA</span>
        </div>
      </div>
        <ul class="nav-links">
          <li>
            <a href="../../user_index.php" class="">
              <i class='bx bx-grid-alt' ></i>
              <span class="links_name">Home</span>
            </a>
          </li>
          <li>
            <a href="dashboard.php" class="active">
            <i class='bx bx-shopping-bag'></i>
              <span class="links_name">Cart</span>
            </a>
          </li>
          <li>
            <a href="orders.php">
              <i class='bx bx-cart' ></i>
              <span class="links_name">Orders</span>
            </a>
          </li>
          <li class="log_out">
            <?php
            
                if(isset($user)){
            
            ?>
            <a href="../includes/logout.php">
              <i class='bx bx-log-out'></i>
              <span class="links_name">Log out</span>
            </a>
            <?php }  ?>
          </li>
        </ul>
    </div>
  </div>

  <section class="home-section">
    <nav>
        <div class="profile-details">
            <span class="user_name"><?php echo $user['username'] ?></span>
            <i class='bx bxs-user-circle'></i>
        </div>
    </nav>
    <div class="home-content">
      <h2> Your Cart </h2>
    <table class="table">
        <thead>
            <tr>
                <th class="text-center">S.N.</th>
                <th class="text-center">Avatar</th>
                <th class="text-center">Product Name</th>
                <th class="text-center">Quantity</th>
                <th class="text-center">Amount</th>
                <th class="text-center" colspan="2">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Initialize count variable
            $count = 1;
            $user_id = $user['id'];
            // Total Sum amount cart
            $sql = "SELECT SUM(amount) as total FROM `cart` ";
            $result = mysqli_query($con, $sql);
            $row = mysqli_fetch_assoc($result);
            $total = $row['total'];
            // Set delivery charge to 0 initially
            $delivery_charge = 0;
            // Set grand total to 0 initially
            $grand_total = 0;
            // Displaying delivery charge preview if there are products in the cart
            $sql = "SELECT * FROM `cart` WHERE user_id = $user_id";
            $result = mysqli_query($con, $sql);
            if(mysqli_num_rows($result) > 0){
                $delivery_charge = 100;
                $grand_total = $total + $delivery_charge;
                while($row = mysqli_fetch_assoc($result)){
                    $product_id = $row['product_id'];
                    $product_sql = "SELECT * FROM product WHERE id = $product_id";
                    $product_result = mysqli_query($con, $product_sql);
                    $product = mysqli_fetch_assoc($product_result);
            ?>
            <tr>
                <td class="text-center"><?= $count ?></td>
                <td class="text-center"><img src="../../images/product/<?= $product['avatar'] ?>" width="200px" alt=""></td>
                <td class="text-center"><?= $product['name'] ?></td>
                <td class="text-center"><?= $row['quantity'] ?></td>     
                <td class="text-center"><?= $row['amount'] ?></td> 
                <td class="text-center">
                    <form action="" method="POST">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                        <button class="bg-danger btn text-light" onclick="variationDelete('')">Delete</button>  
                    </form>
                </td>
            </tr>
            <?php
                $count++;
                }
            } else {
                echo "Nothing in Cart!!!";
            }
            ?>
        </tbody>
        <tr>
            <th colspan="4" style="cursor: pointer;">
                <a href="checkoutt.php">
                  <button onclick="toggleCheckOut()" class="btn bg-primary white-text" style="width: 100%;">Checkout</button>
                </a>
            </th>
            <th colspan="2" style="cursor: pointer;">
                <form action="" method="POST">
                    <input type="hidden" name="action" value="delete_all">
                    <button type="submit" class="btn bg-danger white-text" style="width: 100%;">Delete All</button>
                </form>
            </th>
        </tr>
        <tr>
            <th colspan="4" class="text-center">Total</th>
            <th class="text-center"><?= $total ?></th>
        </tr>
        <tr>
            <th colspan="4" class="text-center">Delivery charge</th>
            <th class="text-center"><?= $delivery_charge ?></th>
        </tr>
        <tr>
            <th colspan="4" class="text-center">Grand Total</th>
            <th class="text-center"><?= $grand_total ?></th>
        </tr>
    </table>
  </div>
</section>
</body>
</html>