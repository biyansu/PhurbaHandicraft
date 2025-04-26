<?php
require('../includes/dbcon.php');
session_start();
$user = $_SESSION['user'];

// Check if the user is logged in
if (!isset($user)) {
    // Redirect to login page or handle as needed
    header("Location: ../login.php");
    exit();
}

// Get the user ID
$user_id = $user['id'];

// Fetch orders for the user
$sql = "SELECT orders.*, product.name
        FROM orders
        INNER JOIN product ON orders.product_id = product.id
        WHERE user_id = $user_id";
$result = mysqli_query($con, $sql);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>User Orders</title>
    <link rel="stylesheet" href="../../css/user/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    .sidebar .nav-links li a.active{
  background: darkgray;
}
.sidebar .nav-links li a:hover{
  background: darkgray;
}
        /* Add this CSS to change the color of the sidebar to brown */
        .sidebar {
           
            background-color: black; /* Change this to your desired brown color */
          
        }
        .logo-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100px; /* Set an appropriate height for the container */
    }


        /* Add any additional styling for the sidebar as needed */
    </style>
<body>
    <div class="sidebar">
    <div class="logo-container">
    <div class="logo-details">
        <span class="logo_name" style="font-family: 'Arial', sans-serif; font-size: 30px;">PHURBA</span>
    </div>
</div>
        <ul class="nav-links">
            <li>
                <a href="../../user_index.php">
                <i class='bx bx-grid-alt' ></i>
                    <span class="links_name">Home</span>
                </a>
            </li>
            <li>
                <a href="dashboard.php">
                <i class='bx bx-shopping-bag'></i>
               <span class="links_name">Cart</span>
                </a>
            </li>
            <li class="active">
                <a href="orders.php">
                    <i class='bx bx-cart'></i>
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
                <?php
                }
                ?>
            </li>
        </ul>
    </div>
    <section class="home-section">
        <nav>
            <div class="profile-details">
                <span class="user_name"><?php echo $user['username'] ?></span>
                <i class='bx bxs-user-circle'></i>
            </div>
        </nav>
        <div class="home-content">
            <h1>Your Orders</h1>
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">Order ID</th>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Amount</th>
                        <th class="text-center">Order Date</th>
                        <th class="text-center">Status</th>
                        <!-- Add more headers as needed -->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Check if there are any orders
                    if (mysqli_num_rows($result) > 0) {
                        // Loop through the orders and display them
                        while ($row = mysqli_fetch_assoc($result)) {
                            ?>
                            <tr>
                                <td class="text-center"><?= $row['id'] ?></td>
                                <td class="text-center"><?= $row['name'] ?></td>
                                <td class="text-center"><?= $row['quantity'] ?></td>
                                <td class="text-center"><?= $row['amount'] ?></td>
                                <td class="text-center"><?= $row['created_at'] ?></td>
                                <td class="text-center"><?= $row['status'] ?></td>
                                <!-- Add more columns as needed -->
                            </tr>
                        <?php
                        }
                    } else {
                        ?>
                        <tr>
                            <td colspan="7" class="text-center">No orders found.</td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
    <!-- Add any additional scripts at the end if required -->
</body>
</html>
