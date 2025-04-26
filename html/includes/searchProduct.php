<?php
// Start the session
session_start();

// Include database connection
require('../includes/dbcon.php');

// Check if user session exists
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
} else {
    exit("User not logged in");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Products | Phurba</title>

    <!-- External CSS -->
    <link rel="stylesheet" href="../../css/searchproduct.css">

    <!-- Fonts and Icons -->
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>

<!-- Header Section -->
<header>
    <a href="../../user_index.php" class="logo" style="color: black;">PHURBA</a>

    <!-- Navigation -->
    <ul class="navlist">
        <li><a href="../../user_index.php" style="color: black;">Home</a></li>
        <li><span class="nav-bar">|</span></li>
        <li><a href="#featured" style="color: black;">Featured</a></li>
        <li><span class="nav-bar">|</span></li>
        <li><a href="#new" style="color: black;">New</a></li>
        <li><span class="nav-bar">|</span></li>
        <li><a href="#contact" style="color: black;">Contact</a></li>
    </ul>

    <!-- Search Bar -->
    <div class="search">
        <i class='bx bx-search' id="searchIcon" style="color:green; font-size: 20px; cursor:pointer;"></i>
        <form id="searchForm" action="../includes/searchProduct.php" method="GET">
            <input type="text" id="searchInput" name="search" placeholder="Search a product" style="display: none;" />
            <div id="searchError" style="color: red; font-size: 14px; margin-top: 5px;"></div>
        </form>
    </div>

    <!-- Wishlist Sidebar -->
    <div id="wishlistSidebar" class="sidebar">
        <button onclick="closeWishlistSidebar()" class="close-button">Close</button>
        <h3>My Wishlist</h3>
        <ul id="wishlistItems"></ul>
    </div>

    <!-- Wishlist Icon -->
    <div class="header-icons">
        <a href="#" onclick="openWishlistSidebar()">
            <i id="wishlistIcon" class='bx bx-heart' style='color:black;' data-count="0"></i>
        </a>
    </div>

    <!-- Cart Icon -->
    <div class="header-icons">
        <a href="../users/dashboard.php"><i class='bx bx-shopping-bag' style='color:black;'></i></a>
    </div>

    <!-- User Section -->
    <div class="header-icons">
        <?php if (isset($user['username'])): ?>
            <a class="navbar-action-btnn"><b><?php echo htmlspecialchars($user['username']); ?></b></a>
            <div class="dropdown-content">
                <a href="../users/dashboard.php" class="navbar-action-btn">My Account</a>
                <a href="../includes/logout.php" class="navbar-action-btn">Logout</a>
            </div>
        <?php else: ?>
            <a href="../forms/login.php" class="navbar-action-btn">Log In</a>
        <?php endif; ?>
    </div>
</header>

<!-- Search Results Section -->
<section>
    <div class="container">
        <h1>Search Results</h1>
        <div class="product-grid">
            <?php
            if (isset($_GET['search'])) {
                $search = mysqli_real_escape_string($con, $_GET['search']);
                $query = "SELECT * FROM product WHERE name LIKE '%$search%'";
                $result = mysqli_query($con, $query);

                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<div class='product'>";
                        
                        // Display product image
                        $avatar = explode(',', $row['avatar'])[0]; // Get the first image from the list
                        echo "<div class='product-img'>";
                        echo "<img src='../../images/product/" . htmlspecialchars($avatar) . "' alt='" . htmlspecialchars($row['name']) . "' />";
                        echo "</div>";
                        
                        // Display product name and description
                        echo "<h2>" . htmlspecialchars($row['name']) . "</h2>";
                        echo "<p>" . htmlspecialchars($row['description']) . "</p>";
                        echo "<p>Price: Nrs. " . htmlspecialchars($row['price']) . "</p>";
                        
                        // Add to Cart and Buy Now buttons
                        echo "<form action='../users/dashboard.php' method='POST'>";
                        echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
                        echo "<input type='hidden' name='user_id' value='" . $user['id'] . "'>";
                        echo "<input type='hidden' name='amount' value='" . $row['price'] . "'>";
                        echo "<input type='hidden' name='quantity' value='1'>";
                        echo "<div class='btn-box'>";
                        echo "<button type='submit' class='cart-btn' style='background-color:black'>Add to Cart</button>";
                        echo "<button type='submit' class='buy-btn' style='background-color:black'>Buy Now</button>";
                        echo "</div>";
                        echo "</form>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No products found matching your search.</p>";
                }
            } else {
                echo "<p>Search query not provided.</p>";
            }
            ?>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact" id="contact">
    <div class="main-contact">
        <h3>PHURBA</h3>
        <h5>Let's Connect</h5>
        <div class="icons">
            <a href="#" target="_blank"><i class='bx bxl-instagram-alt'></i></a>
        </div>
    </div>
    <div class="main-contact">
        <h3>Explore</h3>
        <li><a href="#home">Home</a></li>
        <li><a href="#featured">Featured</a></li>
        <li><a href="#new">New</a></li>
        <li><a href="#contact">Contact</a></li>
    </div>
    <div class="main-contact">
        <h3>Legal</h3>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms of Service</a></li>
    </div>
</section>

<!-- Footer -->
<footer>
    <p>&copy; 2024 Phurba. All rights reserved.</p>
</footer>

<!-- JavaScript -->
<script>
    // Wishlist Sidebar
    function openWishlistSidebar() {
        document.getElementById("wishlistSidebar").classList.add("open");
    }
    function closeWishlistSidebar() {
        document.getElementById("wishlistSidebar").classList.remove("open");
    }

    // Search functionality
    document.getElementById('searchIcon').addEventListener('click', function() {
        const searchInput = document.getElementById('searchInput');
        if (searchInput.style.display === 'none' || searchInput.style.display === '') {
            searchInput.style.display = 'block';
            searchInput.focus();
        } else {
            searchInput.style.display = 'none';
        }
    });

    document.getElementById('searchForm').addEventListener('submit', function(event) {
        const searchInput = document.getElementById('searchInput').value.trim();
        const searchError = document.getElementById('searchError');

        if (searchInput === '') {
            event.preventDefault();
            searchError.textContent = "Please enter a search term.";
        } else {
            searchError.textContent = "";
        }
    });
</script>

</body>
</html>
