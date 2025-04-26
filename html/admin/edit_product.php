<?php
require('../includes/dbcon.php');
session_start();
$admin = $_SESSION['admin'];

if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Fetch product details based on the ID
    $query = "SELECT * FROM `product` WHERE id = $product_id";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        // Redirect to the product.php page if the product is not found
        header("Location: product.php");
        exit();
    }
} else {
    // Redirect to the product.php page if no ID is provided
    header("Location: product.php");
    exit();
}

// Handle form submission for updating the product
if (isset($_POST['update_product'])) {
    $new_quantity = $_POST['new_quantity'];

    // Update product quantity in the database
    $update_query = "UPDATE `product` SET `quantity` = $new_quantity WHERE id = $product_id";
    mysqli_query($con, $update_query);

    // Redirect back to the product.php page after updating
    header("Location: stock.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Edit Product - Admin Dashboard</title>
    <link rel="stylesheet" href="../../css/admin/style.css">
    <link rel="stylesheet" href="../../css/edit_product.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .sidebar .nav-links li a.active{
  background: darkgray;
}
.sidebar .nav-links li a:hover{
  background: darkgray;
}
    </style>
</head>
<body>
    <div class="sidebar">
        <div class="logo-details">
            <span class="logo_name" style="font-family: 'Arial', sans-serif; font-size: 30px;">PHURBA</span>
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
            <div class="container">
                <h2>Edit Product</h2>
                <form action="" method="post">
                    <label for="new_quantity">New Quantity:</label>
                    <input type="number" name="new_quantity" value="<?= $product['quantity'] ?>" required>
                    <input type="submit" name="update_product" value="Update Product">
                </form>
            </div>
        </div>
    </section>
</body>

</html>