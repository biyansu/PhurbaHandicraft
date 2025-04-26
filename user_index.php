<?php
    // Include the database connection file
    require('html/includes/dbcon.php');
    
    // Start a new or resume an existing session
    session_start();
    
    // Retrieve user information from the session
    $user = $_SESSION['user'];

    // SQL query to select all rows from the 'product' table
    $query = "SELECT * FROM product";

    // Execute the query and store the result
    $result = mysqli_query($con, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Meta tags and title for the HTML document -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PHURBA</title>
    
    <!-- Linking CSS stylesheets and external libraries -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/userindex.css">

    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    .wishlist {
    list-style-type: none;
    padding: 0;
}

.wishlist li {
    margin-bottom: 10px;
    display: flex;
    align-items: center;
}

.wishlist li img {
    width: 50px;
    height: 50px;
    margin-right: 10px;
}

.wishlist li button {
    background-color: black;
    color: white;
    border: none;
    padding: 5px 10px;
    cursor: pointer;
    margin-left: auto; /* Align the button to the right */
}

</style>  

   
</head>

<body>
    <!-- Header section -->
<header>
          <!-- Logo (with black color) -->
    <a href="user_index.php" class="logo" style="color: black;">PHURBA</a>

<!-- Navigation Links -->
<ul class="navlist">
<li><a href="#home" style="color: black;">Home</a></li>
<li><span class="nav-bar">|</span></li>
<li><a href="#featured" style="color: black;">Featured</a></li>
<li><span class="nav-bar">|</span></li>
<li><a href="#new" style="color: black;">New</a></li>
<li><span class="nav-bar">|</span></li>
<li><a href="#contact" style="color: black;">Contact</a></li>
</ul>
       <!-- Search Bar -->
    <div class="search">
        <!-- Search Icon (with adjusted style) -->
        <i class='bx bx-search' id="searchIcon" style="color: black; font-size: 20px;"></i>
        <!-- Search Input (Initially Hidden) -->
        <form id="searchForm" action="html/includes/searchProduct.php" method="GET">
            <input type="text" id="searchInput" name="search" placeholder="Search a product" style="display: none;" />
        </form>
    </div>

     <!-- Wishlist Sidebar -->
     <div id="wishlistSidebar" class="sidebar">
    <button onclick="closeWishlistSidebar()" class="close-button">Close</button>
    <!-- Wishlist content goes here -->
    <h3>My Wishlist</h3>
    <ul id="wishlistItems" class="wishlist" ></ul>

</div>

<!-- Wishlist Icon -->
<div class="header-icons">
    <a href="#" onclick="openWishlistSidebar()">
        <i id="wishlistIcon" class='bx bx-heart' style='color:black;' data-count="0"></i>
    </a>
</div>
    <!-- Cart Icon -->
    <div class="header-icons">
        <a href="html/users/dashboard.php"><i class='bx bx-shopping-bag' style='color:black;'></i></a>
    </div>
        <!-- User icons and dropdown menu -->
        <div class="header-icons">
            <?php if(isset($user['username'])): ?>
                <a class="navbar-action-btnn"><b><?php echo $user['username'] ?></b></a>
                <div class="dropdown-content">
                    <a href="html/users/dashboard.php" class="navbar-action-btn">My Account</a>
                    <a href="html/includes/logout.php" class="navbar-action-btn">Logout</a>
                </div>
            <?php else: ?>
                <a href="html/forms/login.php" class="navbar-action-btn">Log In</a>
            <?php endif; ?>
        </div>
</header>
    <!-- Home section -->
    <section class="home" style="    background-image: url('images/h.jpg');">
    <div class="home-text">
        <br><br><br><br><h2><i>PHURBA!</i></h2>
        <p><b>Your one-stop destination for all things crafty.</b></p>
        <blockquote>
            "Unleash your creativity<br>and let your imagination soar<br>with Phurba."
        </blockquote>
        <a href="#featured" class="btn">Shop Now</a>
    </div>
</section>

<!-- Section for Gift Ideas -->
<section class="idea" style="background-image: url('images/h1.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="container ">
        <div class="text22">
            <h2 class="gift">Gift Ideas That Last Longer</h2>
            <p class="lead">Sale Up to 10%</p>
            <a href="#" class="btn1">Let's Go</a>
        </div>
        <!-- New div with an image
        <div class="image-container">
            <img src="images/idea.jpg" alt="Gift Idea Image">
            <img src="images/p9.jpg" alt="Gift Idea Image">
        </div> -->
    </div>
</section>

<section class="featured" id="featured">
    <div class="center-text">
        <h2>Featured Categories</h2>
    </div>
    <div class="featured-content">
        <?php
            // Query to fetch products
            $query = "SELECT * FROM `product` LIMIT 6"; // Fetch the first 6 products (can be adjusted)
            $result = mysqli_query($con, $query);
            
            // Check if any products exist
            if(mysqli_num_rows($result) > 0){
                // Loop through each product
                while($row = mysqli_fetch_assoc($result)){
                    // Extract the first image from the stored image string (assuming avatar contains comma-separated values)
                    $images = explode(",", $row['avatar']);
                    $firstImage = $images[0]; // Get the first image
        ?>
        <div class="image-box">
            <!-- Display the product image -->
            <img src="images/product/<?php echo htmlspecialchars($firstImage); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
            <h3><?php echo htmlspecialchars($row['name']); ?></h3>
            <h4><?php echo htmlspecialchars($row['description']); ?></h4>
            <h4>Nrs. <?php echo htmlspecialchars($row['price']); ?></h4>
            <a href="html/users/product_detail.php?id=<?php echo $row['id']; ?>"><button class="buy1">Buy Now</button></a>
        </div>
        <?php
                }
            }
        ?>
    </div>
</section>



<section class="new" id="new">
        <div class="center-text">
            <h2>New Featured Products</h2>
            <p>Here you can check out new featured products</p>
        </div>

        <div class="new-content">
            <div class="box">
                <img src="images/pp4.jpg">
                <h5>Angel wallhanging</h5>
                    <h6>Nrs.2000</h6>
            </div>

            <div class="box">
                <img src="images/p3.jpg" >
                <h5>Coasters</h5>
                <h6>Nrs.500</h6>
            </div>

            <div class="box">
                <img src="images/p6.jpg">
                <h5>Moon shaped dream catcher</h5>
                <h6>Nrs.1500</h6>
            </div>

            <div class="box">
                <img src="images/p7.jpg">
                <h5>Macrame Bottle Holder</h5>
                <h6>Nrs.1600</h6>
            </div>

        </div>
    </section>



    <!-- Contact section -->
    <section class="contact" id="contact">
        <!-- Contact content here -->
        <div class="main-contact">
            <h3>Phurba</h3>
            <h5>Let's Connect</h5>
            <div class="icons">
                <a href="" target="_blank"><i class='bx bxl-instagram-alt'></i></a>
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
            <h3>Our Services</h3>
            <li><a href="#">Pricing</a></li>
        </div>
        <div class="main-contact">
            <h3>Shopping</h3>
            <li><a href="#">Handicraft</a></li>
        </div>
        <!-- Feedback form--> 
        <div class="contact-form" style="text-align: center; /* Center align the content */
    margin-left: 300px; /* Center the div horizontally */
    max-width: 400px; /* Set maximum width for better readability */">
        <h2 style="color: aliceblue;"><u>Send us your feedback</u></h2>
       <p> <a href="mailto:phurba@example.com" style="color:aliceblue"> <i class="fa-solid fa-envelopes-bulk"></i>click here </a></p>
    </div>
    </section>

    <!-- Footer section -->
    <div class="last-text">
        <!-- Footer content here -->
        <p>&copy; <?php echo date("Y"); ?> Phurba. All Rights Reserved.</p>
    </div>

    <!-- Scroll to top button -->
    <a href="#" class="top"><i class='bx bx-up-arrow-alt' ></i></a>

    <!-- ScrollReveal library -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- Custom JavaScript file -->
    <script src="js/script.js"></script>
    <script>
    // JavaScript to toggle search input visibility when search icon is clicked
    document.getElementById("searchIcon").addEventListener("click", function() {
        var searchInput = document.getElementById("searchInput");
        if (searchInput.style.display === "none") {
            searchInput.style.display = "inline-block";
        } else {
            searchInput.style.display = "none";
        }
    });
</script>
<script>
// JavaScript for opening and closing the wishlist sidebar
function openWishlistSidebar() {
    document.getElementById("wishlistSidebar").classList.add("open");
}

function closeWishlistSidebar() {
    document.getElementById("wishlistSidebar").classList.remove("open");
}

// Function to load wishlist items from local storage and populate the wishlist sidebar
function loadWishlistItems() {
    const wishlistItems = localStorage.getItem('wishlistItems');
    if (wishlistItems) {
        const parsedItems = JSON.parse(wishlistItems);
        const wishlistElement = document.getElementById('wishlistItems');
        parsedItems.forEach(item => {
            // Create list item
            const listItem = document.createElement('li');

            // Create image element for product image
            const imageElement = document.createElement('img');
            imageElement.src = item.productImage;
            imageElement.width = 50; // Set the width of the image
            imageElement.height = 50; // Set the height of the image
            listItem.appendChild(imageElement);

            // Create text node for product name and price
            listItem.appendChild(document.createTextNode(`${item.productName} - ${item.productPrice}`));

            // Add "Add to Cart" button
            const addToCartButton = document.createElement('button');
            addToCartButton.textContent = 'Add to Cart';
            addToCartButton.addEventListener('click', function() {
                // Implement functionality to add the product to the cart
                // For now, let's just log a message
                console.log(`Adding ${item.productName} to cart`);
            });
            listItem.appendChild(addToCartButton);

            // Add delete button
            const deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.addEventListener('click', function() {
                // Remove the item from the wishlist
                const itemIndex = parsedItems.findIndex(wishlistItem => wishlistItem.productName === item.productName && wishlistItem.productPrice === item.productPrice);
                if (itemIndex !== -1) {
                    parsedItems.splice(itemIndex, 1);
                    localStorage.setItem('wishlistItems', JSON.stringify(parsedItems));
                    // Remove the item from the DOM
                    listItem.remove();
                }
            });
            listItem.appendChild(deleteButton);

            // Append list item to wishlist
            wishlistElement.appendChild(listItem);
        });
    }
}

// Call loadWishlistItems if defined to load wishlist items when the page loads
if (typeof loadWishlistItems === 'function') {
    loadWishlistItems();
}

</script>
</body>
</html>
