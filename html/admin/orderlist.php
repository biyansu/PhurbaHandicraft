<?php
// Start the session to manage user sessions
session_start();

// Retrieve the 'admin' session variable
$admin = $_SESSION['admin'];

// Include the database connection file
include_once '../includes/dbcon.php';

// Function to calculate total amount with delivery charge
function calculateTotalAmount($quantity, $price) {
    $deliveryCharge = 100; // Delivery charge is Rs 100
    $totalPrice = $quantity * $price;
    $totalAmount = $totalPrice + $deliveryCharge;
    return $totalAmount;
}

// Check if the form is submitted for updating order status
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['order_id']) && isset($_POST['status'])) {
        $order_id = $_POST['order_id'];
        $status = $_POST['status'];

        // Update the order status in the database
        $updateStatusQuery = "UPDATE orders SET status = '$status' WHERE id = $order_id";
        if ($con->query($updateStatusQuery) === TRUE) {
            // Status updated successfully
        } else {
            echo "Error updating order status: " . $con->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <!-- Include external CSS file for styling -->
    <link rel="stylesheet" href="../../css/admin/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- Set viewport for responsive design -->
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
    <!-- Sidebar for navigation -->
    <div class="sidebar">
    <div class="logo-container">
    <div class="logo-details">
    <span class="logo_name" style="font-family: 'Arial', sans-serif; font-size: 30px;">PHURBA</span>
    </div>
</div>
        <ul class="nav-links">
            <!-- Dashboard link -->
            <li>
                <a href="dashboard.php">
                    <i class='bx bx-grid-alt' ></i>
                    <span class="links_name">Dashboard</span>
                </a>
            </li>
            <!-- Product link -->
            <li>
                <a href="product.php">
                    <i class='bx bx-box' ></i>
                    <span class="links_name">Product</span>
                </a>
            </li>
            <!-- Order list link (active) -->
            <li>
                <a href="orderlist.php" class="active">
                    <i class='bx bx-list-ul' ></i>
                    <span class="links_name">Order list</span>
                </a>
            </li>
            <!-- Stock link -->
            <li>
                <a href="stock.php">
                    <i class='bx bx-coin-stack' ></i>
                    <span class="links_name">Stock</span>
                </a>
            </li>
            <!-- Logout link (displayed if admin is authenticated) -->
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

    <!-- Main content section -->
    <section class="home-section">
        <!-- Navigation bar with admin profile details -->
        <nav>
            <div class="profile-details">
                <span class="admin_name">Admin</span>
                <i class='bx bxs-user-circle' ></i>
            </div>
        </nav>

        <!-- Home content, including sales boxes and recent sales details -->
        <div class="home-content">
    <div class="sales-boxes">
        <div class="recent-sales">
            <h2>Order List</h2>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>User Name</th>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Checkout Mode</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Modified SQL query to fetch both current and historical orders, and checkout mode
                        $sql = "SELECT orders.id, users.username, product.name AS product_name, orders.quantity, orders.created_at, orders.status, orders.checkout_mode, product.price
                                FROM orders
                                INNER JOIN users ON orders.user_id = users.id
                                INNER JOIN product ON orders.product_id = product.id
                                ORDER BY orders.created_at DESC"; // Order by creation date to show recent orders first
                        $result = $con->query($sql);

                        if ($result->num_rows > 0) {
                            // Output data of each row
                            while ($row = $result->fetch_assoc()) {
                                // Calculate total price
                                $total_price = $row["quantity"] * $row["price"];
                                echo "<tr>
                                        <td>" . $row["id"] . "</td>
                                        <td>" . $row["username"] . "</td>
                                        <td>" . $row["product_name"] . "</td>
                                        <td>" . $row["quantity"] . "</td>
                                        <td>" . $total_price . "</td>
                                        <td>" . $row["created_at"] . "</td>
                                        <td>" . $row["status"] . "</td>
                                        <td>" . $row["checkout_mode"] . "</td>
                                        <td>
                                            <form method='post' style='display: inline-block;'>
                                                <input type='hidden' name='order_id' value='" . $row["id"] . "'>
                                                <select name='status'>
                                                    <option value='Pending' " . ($row["status"] == 'Pending' ? 'selected' : '') . ">Pending</option>
                                                    <option value='Delivered' " . ($row["status"] == 'Delivered' ? 'selected' : '') . ">Delivered</option>
                </select>
                                                <button type='submit'>Update</button>
                                            </form>
                                            <form method='post' action='generate_bill.php' style='display: inline-block;'>
                                                <input type='hidden' name='order_id' value='" . $row["id"] . "'>
                                                <button type='submit'>Generate Invoice</button>
                                            </form>
                                        </td>
                                      </tr>";
                            }
                        } else {
                            echo "<tr><td colspan='9'>No orders found.</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
        </div>
   </div>
     </div>
        </div>
    </section>
</body>
</html>
