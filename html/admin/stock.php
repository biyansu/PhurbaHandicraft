<?php
require('../includes/dbcon.php');
session_start();
$admin = $_SESSION['admin'];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../css/admin/style.css">
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
    .logo-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100px; /* Set an appropriate height for the container */
}
.sidebar {
           
           background-color: black; /* Change this to your desired brown color */
         
       }


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
                <a href="dashboard.php">
                    <i class='bx bx-grid-alt' ></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="product.php">
                    <i class='bx bx-box' ></i>
                    <span class="links_name">Product</span>
                </a>
            </li>
            <li>
                <a href="orderlist.php">
                    <i class='bx bx-list-ul' ></i>
                    <span class="links_name">Order list</span>
                </a>
            </li>
            <li>
                <a href="stock.php" class="active">
                    <i class='bx bx-coin-stack' ></i>
                    <span class="links_name">Stock</span>
                </a>
            </li>
            <li class="log_out">
                <?php
                if (isset($admin)) {
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
                <span class="admin_name">Admin</span>
                <i class='bx bxs-user-circle' ></i>
            </div>
        </nav>
        <div class="home-content">
            <table class="table">
                <thead>
                    <tr>
                        <th class="text-center">S.N.</th>
                        <th class="text-center">Product Name</th>
                        <th class="text-center">Quantity</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <?php
                $sql = "SELECT * FROM `product`";

                $result = mysqli_query($con, $sql);
                $count = 1;
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                ?>
                        <tr>
                            <td class="text-center"><?= $count ?></td>
                            <td class="text-center"><?= isset($row['name']) ? $row['name'] : 'N/A' ?></td>
                            <td class="text-center"><?= isset($row['quantity']) ? $row['quantity'] : 'N/A' ?></td>
                            <td class="text-center">
                                <a href="edit_product.php?id=<?= $row['id'] ?>">Edit</a> |
                                <a href="delete_product.php?id=<?= $row['id'] ?>" onclick="return confirm('Are you sure you want to delete this product?')">Delete</a>
                            </td>
                        </tr>
                <?php
                        $count++;
                    }
                } else {
                    echo "<tr><td colspan='4' class='text-center'>No Product Found!!!</td></tr>";
                }
                ?>
            </table>
        </div>
    </section>
</body>

</html>
