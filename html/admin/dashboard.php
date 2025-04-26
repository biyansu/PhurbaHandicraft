
<?php
  // Include your database connection file
  require('../includes/dbcon.php');

  session_start();
  $admin = $_SESSION['admin'];

  // Total Products
  $totalProductsQuery = "SELECT SUM(quantity) AS totalProducts FROM product";
  $totalProductsResult = mysqli_query($con, $totalProductsQuery);
  $totalProductsData = mysqli_fetch_assoc($totalProductsResult);
  $totalProducts = $totalProductsData['totalProducts'];

  // Total Orders and Revenue
  // Assuming your order table has a 'created_at' column storing the order creation date
  // Fetch total number of orders
$totalOrdersQuery = "SELECT COUNT(*) AS totalOrders FROM orders";
$totalOrdersResult = mysqli_query($con, $totalOrdersQuery);
$totalOrdersData = mysqli_fetch_assoc($totalOrdersResult);
$totalOrders = $totalOrdersData['totalOrders'];

  // Total Revenue
$totalRevenueQuery = "SELECT SUM(amount) AS totalRevenue FROM orders";
$totalRevenueResult = mysqli_query($con, $totalRevenueQuery);
$totalRevenueData = mysqli_fetch_assoc($totalRevenueResult);
$totalRevenue = $totalRevenueData['totalRevenue'];
?>




<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <!-- Meta tags and title for the HTML document -->
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>

    <!-- Link to the stylesheet -->
    <link rel="stylesheet" href="../../css/admin/style.css">
    <link rel="stylesheet" href="../../css/admindashboard.css">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


    <!-- Link to Boxicons library -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <!-- Viewport meta tag for responsive design -->
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
    <!-- Sidebar Section -->
    <div class="sidebar">
    <div class="logo-container">
    <div class="logo-details">
        <span class="logo_name" style="font-family: 'Arial', sans-serif; font-size: 30px;">PHURBA</span>
    </div>
</div>
<ul class="nav-links">
        <!-- Navigation links with icons -->
        <!-- The 'class="active"' indicates the current active page -->
        <li>
          <a href="dashboard.php" class="active">
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
          <a href="stock.php">
            <i class='bx bx-coin-stack' ></i>
            <span class="links_name">Stock</span>
          </a>
        </li>
        <li class="log_out">
            <?php
                // Check if admin is set in the session
                if(isset($admin)){
            ?>
          <!-- Logout link if admin is set -->
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

    <!-- Main Content Section -->
  <section class="home-section">
    <!-- Navigation and profile details -->
    <nav>
      <div class="profile-details">
        <span class="admin_name">Admin</span>
        <i class='bx bxs-user-circle'></i>
      </div>
    </nav>
  <!-- Dashboard Content -->
  <div class="dashboard-content">
    <h2>Welcome to the Admin Dashboard</h2>
    <p>Here are some statistics and information:</p>

    <!-- Example Statistics -->
<div class="statistics">
  <div class="statistic">
    <h3>Total Products</h3>
    <p><?php echo $totalProducts; ?></p>
  </div>
  <div class="statistic">
    <h3>Total Orders</h3>
    <p><?php echo $totalOrders; ?></p>
  </div>
  <div class="statistic">
    <h3>Total Revenue</h3>
    <p>Nrs. <?php echo $totalRevenue; ?></p>
  </div>
</div>


    <!-- Example Recent Activities -->
    <div class="recent-activities">
    <canvas id="orderSalesChart"></canvas>

      <h3>Recent Activities</h3>
      <ul>
        <li>Added new product: Macrame Wall Hanging</li>
        <li>Updated order status: Order #1234</li>
        <li>Deleted product: Plant Hanger</li>
      </ul>
    </div>
  </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Fetch data for total orders and sales in a month
        function fetchData() {
            // You can fetch the data from PHP variables directly
            return {
                totalOrders: <?php echo $totalOrders; ?>,
                totalSales: <?php echo $totalRevenue; ?> // Assuming total revenue represents sales
            };
        }

        // Get the canvas element
        var ctx = document.getElementById('orderSalesChart').getContext('2d');

        // Fetch data
        var data = fetchData();

        // Render the bar graph
        var orderSalesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Total Orders', 'Total Sales'],
                datasets: [{
                    label: 'Total Orders and Sales in a Month',
                    data: [data.totalOrders, data.totalSales],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>


  </body>
</html>
