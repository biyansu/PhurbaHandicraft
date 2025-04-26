<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Phurba</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">


    <link rel="stylesheet"
  href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
<header>
    <!-- Logo (with black color) -->
    <a href="#" class="logo" style="color: black;">PHURBA</a>

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
        <a href="#"><i class='bx bx-shopping-bag' style='color:black;'></i></a>
    </div>

    <!-- User Login -->
    <div class="header-icons">
    <a href="html/forms/login.php"><i class='bx bx-user' style='color:black;'></i></a>
    </div>

</header>


    
    <section class="home" style="    background-image: url('images/h.jpg');">
    <div class="home-text">
        <br><br><br><br><h2><i>PHURBA!</i></h2>
        <p><b>Your one-stop destination for all things crafty.</b></p>
        <blockquote>
            "Unleash your creativity<br>and let your imagination soar<br>with Phurba."
        </blockquote>
        <a href="html/forms/login.php" class="btn">Shop Now</a>
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
    </div>
</section>






    <!----featured--->
    <section class="featured" id="featured">
        <div class="center-text">
            <h2>Featured Categories</h2>
        </div>

        <div class="featured-content">
            <div class="row">
                <img src="images/pp1.jpg" style="width: 400px; height: 400px;">
                <center><h3>Minimal White Mirror</h3>
                <h4>Nrs.3000</h4></center>
                <div class="wishlist-icon">
        <a href="#" onclick="addToWishlist(event)">
            <i class='bx bx-heart'></i>
        </a>
    </div>

                <div class="arrow">
                    <a href="html/forms/login.php"><i class='bx bx-right-arrow-alt' ></i></a>
                </div>
            </div>

            <div class="row">
                <img src="images/pp2.jpg"style="width: 400px; height: 400px;">
                <center><h3>Macrame wall decor</h3>
                <h4>Nrs.2500</h4></center>
                <div class="wishlist-icon">
        <a href="#" onclick="addToWishlist(event)">
            <i class='bx bx-heart'></i>
        </a>
    </div>

                <div class="arrow">
                    <a href="html/forms/login.php"><i class='bx bx-right-arrow-alt' ></i></a>
                </div>
            </div>

            <div class="row">
                <img src="images/pp3.jpg" style="width: 400px; height: 400px;">
            <center><h3>Macrame Plant Hanger</h3>
                <h4>Nrs.1600</h4></center>
                <div class="wishlist-icon">
        <a href="#" onclick="addToWishlist(event)">
            <i class='bx bx-heart'></i>
        </a>
    </div>

                <div class="arrow">
                    <a href="html/forms/login.php"><i class='bx bx-right-arrow-alt' ></i></a>
                </div>
            </div>

            <div class="row">
                <img src="images/pp5.jpg" style="width: 400px; height: 400px;">
                <center><h3>Macrame Magnets</h3>
                <h4>Nrs.200</h4></center>
                <div class="wishlist-icon">
        <a href="#" onclick="addToWishlist(event)">
            <i class='bx bx-heart'></i>
        </a>
    </div>

                <div class="arrow">
                    <a href="html/forms/login.php"><i class='bx bx-right-arrow-alt' ></i></a>
                </div>
            </div>

            <div class="row">
                <img src="images/pp6.jpg" style="width: 400px; height: 400px;">
                <center><h3>Evil Eye decor</h3>
                <h4>Nrs.2000</h4></center>
                <div class="wishlist-icon">
        <a href="#" onclick="addToWishlist(event)">
            <i class='bx bx-heart'></i>
        </a>
    </div>

                <div class="arrow">
                    <a href="html/forms/login.php"><i class='bx bx-right-arrow-alt' ></i></a>
                </div>
            </div>

            <div class="row">
                <img src="images/pp7.jpg" style="width: 400px; height: 400px;">
            <center><h3>Macrame selves</h3>
                <h4>Nrs.2000</h4></center>
                <div class="wishlist-icon">
        <a href="#" onclick="addToWishlist(event)">
            <i class='bx bx-heart'></i>
        </a>
    </div>

                <div class="arrow">
                    <a href="#"><i class='bx bx-right-arrow-alt' ></i></a>
                </div>
            </div>

        </div>
    </section>

    
    <!----new--->
    <section class="new" id="new">
        <div class="center-text">
            <h2>New Featured Products</h2>
            <p>Here you can check out new featured products</p>
        </div>

        <div class="new-content">
            <div class="box">
                <img src="images/a1.jpg">
                <h5>Reversable doll bouquet</h5>
                    <h6>Nrs.2500</h6>
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

     <!----contact--->
<section class="contact" id="contact">
    <div class="main-contact">
        <h3>PHURBA</h3>
        <h5>Let's Connect</h5>
        <div class="icons">
            <a href="https://www.instagram.com/endlessloop_nepal/" target="_blank"><i class='bx bxl-instagram-alt' ></i></a>
            
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
        <li><a href="#">Delivery</a></li>
    </div>

    <div class="main-contact">
        <h3>Contact Us</h3>
        <li><a href="#">+977 9856874512</a></li>
        <li><a href="#">+977 9764581230</a></li>
    </div>

    <!-- Feedback form--> 
    <div class="contact-form" style="text-align: center; /* Center align the content */
    margin-left: 300px; /* Center the div horizontally */
    max-width: 400px; /* Set maximum width for better readability */">
        <h2 style="color: aliceblue;"><u>Send us your feedback</u></h2>
       <p> <a href="mailto:phurba@example.com" style="color:aliceblue"> <i class="fa-solid fa-envelopes-bulk"></i>click here </a></p>
    </div>
</section>

<!-- 
    <div class="last-text">
        <p>Copyright © 2023</p>
    </div> -->

    <!----scroll top--->
    <a href="#" class="top"><i class='bx bx-up-arrow-alt' ></i></a>


    <script src="https://unpkg.com/scrollreveal"></script>

    <!----custom js link--->
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

// Function to load wishlist items from local storage
function addToWishlist(event) {
    // Prevent the default action of the anchor tag
    event.preventDefault();

    // Find the closest parent row element
    const row = event.target.closest('.row');

    // Extract product details
    const productName = row.querySelector('h3').textContent;
    const productPrice = row.querySelector('h4').textContent;
    const productImage = row.querySelector('img').src; // Assuming img tag contains product image URL

    // Add the product to the wishlist array
    const wishlistItems = localStorage.getItem('wishlistItems');
    const items = wishlistItems ? JSON.parse(wishlistItems) : [];
    items.push({ productName, productPrice, productImage });
    localStorage.setItem('wishlistItems', JSON.stringify(items));

    // Update the wishlist sidebar with the new item
    const wishlistElement = document.getElementById('wishlistItems');
    const listItem = document.createElement('li');
    const imageElement = document.createElement('img');
    imageElement.src = productImage;
    imageElement.width = 50; // Set the width of the image
    imageElement.height = 50; // Set the height of the image
    listItem.appendChild(imageElement);
    listItem.appendChild(document.createTextNode(`${productName} - ${productPrice}`));

    // Add delete button
    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.addEventListener('click', function() {
        // Remove the item from the wishlist
        const itemIndex = items.findIndex(item => item.productName === productName && item.productPrice === productPrice);
        if (itemIndex !== -1) {
            items.splice(itemIndex, 1);
            localStorage.setItem('wishlistItems', JSON.stringify(items));
            // Remove the item from the DOM
            listItem.remove();
        }
    });
    listItem.appendChild(deleteButton);

    wishlistElement.appendChild(listItem);

    // Open the wishlist sidebar if defined
    if (typeof openWishlistSidebar === 'function') {
        openWishlistSidebar();
    }
}

// Call loadWishlistItems if defined to load wishlist items when the page loads
if (typeof loadWishlistItems === 'function') {
    loadWishlistItems();
}



</script>

    
</body>
</html>
