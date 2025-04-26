<?php
    require('../includes/dbcon.php');
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: ../login.php');
        exit();
    }
    $user = $_SESSION['user'];

    if (!isset($_GET['id'])) {
        echo "Product ID missing!";
        exit();
    }

    $id = intval($_GET['id']);
    $query = "SELECT * FROM product WHERE id = $id";
    $result = mysqli_query($con, $query);

    if (!$result || mysqli_num_rows($result) == 0) {
        echo "Product not found!";
        exit();
    }

    $row = mysqli_fetch_assoc($result);
    $images = explode(',', $row['avatar']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - PHURBA</title>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/user/product_detail.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <style>
        /* Your custom styles (already given) */
        .header-icons { position: relative; color: black; }
        .header-icons:hover .dropdown-content { display: block; }
        .dropdown-content {
            padding: 5px 0;
            position: absolute;
            display: none;
            text-align: left;
            background: white;
            width: 100%;
        }
        .dropdown-content > a {
            color: black;
            font-weight: 500;
            padding: 10px;
            display: block;
        }
        .dropdown-content > a:hover { color: var(--main-color); }
        .big-img { width: 400px; height: 400px; border-radius: 10px; overflow: hidden; position: relative; }
        .big-img img { width: 100%; height: 100%; object-fit: cover; }
        .cart-btn, .buy-btn {
            background-color: black;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
        .cart-btn:hover, .buy-btn:hover { background-color: darkgray; }
        .thumb-container {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }
        .thumb-container img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
        }
        .next-btn, .prev-btn {
            position: absolute;
            top: 50%;
            background: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
            transform: translateY(-50%);
        }
        .next-btn { right: 10px; }
        .prev-btn { left: 10px; }
        .next-btn:hover, .prev-btn:hover { background: rgba(0, 0, 0, 0.8); }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <a href="../../user_index.php" class="logo" style="color: black;">PHURBA</a>

        <ul class="navlist">
            <li><a href="../../user_index.php#home" style="color: black;">Home</a></li>
            <li><span class="nav-bar">|</span></li>
            <li><a href="../../user_index.php#featured" style="color: black;">Featured</a></li>
            <li><span class="nav-bar">|</span></li>
            <li><a href="../../user_index.php#new" style="color: black;">New</a></li>
            <li><span class="nav-bar">|</span></li>
            <li><a href="../../user_index.php#contact" style="color: black;">Contact</a></li>
        </ul>

        <div class="search">
            <i class='bx bx-search' id="searchIcon" style="color: black; font-size: 20px;"></i>
            <form id="searchForm" action="../includes/searchProduct.php" method="GET" style="position:relative;">
                <input type="text" id="searchInput" name="search" placeholder="Search a product" style="display: none; position:absolute; right:0; top:30px;" />
            </form>
        </div>

        <div class="header-icons">
            <a href="dashboard.php"><i class='bx bx-shopping-bag' style='color:black;'></i></a>
        </div>

        <div class="header-icons">
            <a href="#"><i class='bx bx-user' style="color: black;"></i></a>
            <a class="navbar-action-btn"><b><?php echo htmlspecialchars($user['username']); ?></b></a>
            <div class="dropdown-content">
                <a href="dashboard.php" class="navbar-action-btn">Dashboard</a>
                <a href="../includes/logout.php" class="navbar-action-btn">Logout</a>
            </div>
        </div>
    </header>

    <!-- Product Details -->
    <div class="flex-box">
        <div class="left">
            <div class="big-img">
                <img src="../../images/product/<?php echo $images[0]; ?>" id="main-img">
                <button class="prev-btn" onclick="prevImage()">←</button>
                <button class="next-btn" onclick="nextImage()">→</button>
            </div>
            <div class="thumb-container">
                <?php foreach ($images as $image): ?>
                    <img src="../../images/product/<?php echo htmlspecialchars($image); ?>" onclick="showImg('<?php echo htmlspecialchars($image); ?>')">
                <?php endforeach; ?>
            </div>
        </div>

        <form action="../includes/addtocart.php" method="POST">
            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
            <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
            <input type="hidden" name="amount" value="<?php echo $row['price']; ?>">
            <div class="right">
                <div class="pname"><?php echo htmlspecialchars($row['name']); ?></div>
                <div class="description"><?php echo nl2br(htmlspecialchars($row['description'])); ?></div>
                <div class="price">Nrs. <span id="price"><?php echo $row['price']; ?></span></div>
                <div class="quantity">
                    <p>Quantity :</p>
                    <input type="number" name="quantity" min="1" max="5" value="1" onchange="priceUpdate(this)">
                </div>
                <div class="btn-box">
                    <button class="cart-btn" type="submit">Add to Cart</button>
                    <button class="buy-btn" type="button" onclick="buyNow()">Buy Now</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let bigImg = document.querySelector('.big-img img');
        let currentImgIndex = 0;
        let images = <?php echo json_encode($images); ?>;

        function showImg(pic) {
            bigImg.src = "../../images/product/" + pic;
            currentImgIndex = images.indexOf(pic);
        }

        function nextImage() {
            currentImgIndex = (currentImgIndex + 1) % images.length;
            bigImg.src = "../../images/product/" + images[currentImgIndex];
        }

        function prevImage() {
            currentImgIndex = (currentImgIndex - 1 + images.length) % images.length;
            bigImg.src = "../../images/product/" + images[currentImgIndex];
        }

        function priceUpdate(elem) {
            let price = <?php echo $row['price']; ?>;
            let amount = price * elem.value;
            document.querySelector("#price").textContent = amount;
            document.querySelector("input[name=amount]").value = amount;
        }

        // Make search icon toggle the search bar
        document.getElementById('searchIcon').addEventListener('click', function() {
            const input = document.getElementById('searchInput');
            if (input.style.display === 'none') {
                input.style.display = 'block';
                input.focus();
            } else {
                if (input.value.trim() !== "") {
                    document.getElementById('searchForm').submit();
                } else {
                    input.style.display = 'none';
                }
            }
        });

        function buyNow() {
            alert("Buying feature not implemented yet.");
        }
    </script>
</body>
</html>
