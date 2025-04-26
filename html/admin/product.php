<?php
session_start();
$admin = $_SESSION['admin'];

require('../includes/dbcon.php');

// Process form submission for adding a new product
if (isset($_POST['add_product'])) {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    
    // Handling multiple image uploads
    $upload_dir = "../../images/product/";
    $image_names = [];

    // Loop through each uploaded image
    if (!empty($_FILES['product_images']['name'][0])) {
        foreach ($_FILES['product_images']['name'] as $key => $filename) {
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            $image_name = md5($filename . time() . $key) . '.' . $ext;
            $upload_path = $upload_dir . $image_name;

            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES['product_images']['tmp_name'][$key], $upload_path)) {
                $image_names[] = $image_name; // Store the image name in the array
            }
        }

        // Convert the image names array to a comma-separated string
        $image_names_str = implode(",", $image_names);

        // Add a new product with multiple images
        $query = "INSERT INTO `product` (`name`, `description`, `price`, `quantity`, `avatar`) 
                  VALUES ('$product_name', '$product_description', '$product_price', '$product_quantity', '$image_names_str')";

        $result = mysqli_query($con, $query);

        if ($result) {
            $msg = "Product Added Successfully";
            header("Location: dashboard.php");
            exit(); // Important to prevent further execution after redirection
        } else {
            $msg = "Something went wrong.";
        }
    } else {
        $msg = "Please upload at least one image.";
    }
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../../css/admin/style.css">
    <link rel="stylesheet" href="../../css/adminaddproduct.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .sidebar .nav-links li a.active {
            background: darkgray;
        }
        .sidebar .nav-links li a:hover {
            background: darkgray;
        }

        /* Style for the image preview */
        .image-preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .image-preview-container img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 10px;
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
            <a href="dashboard.php">
                <i class='bx bx-grid-alt'></i>
                <span class="links_name">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="product.php" class="active">
                <i class='bx bx-box'></i>
                <span class="links_name">Product</span>
            </a>
        </li>
        <li>
            <a href="orderlist.php">
                <i class='bx bx-list-ul'></i>
                <span class="links_name">Order list</span>
            </a>
        </li>
        <li>
            <a href="stock.php">
                <i class='bx bx-coin-stack'></i>
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
            <i class='bx bxs-user-circle'></i>
        </div>
    </nav>
    <div class="home-content">
        <div class="container">
            <div class="admin-product-form-container">
                <form action="" method="post" enctype="multipart/form-data">
                    <h3>Add new product</h3>
                    <input type="text" placeholder="Enter product name" name="product_name" class="box" required>
                    <input type="text" placeholder="Enter product description" name="product_description" class="box" required>
                    <input type="number" placeholder="Enter product price" name="product_price" class="box" required>
                    <input type="number" placeholder="Enter product quantity" name="product_quantity" class="box" required>
                    <!-- Allow multiple file uploads -->
                    <input type="file" accept="image/png, image/jpeg, image/jpg" name="product_images[]" class="box" multiple required>
                    
                    <!-- Image preview container -->
                    <div class="image-preview-container" id="image-preview-container"></div>

                    <input type="submit" class="btn" name="add_product" value="Add Product">
                </form>
            </div>
        </div>
    </div>
</section>

<script>
    // Function to handle the image preview
    document.querySelector('input[type="file"]').addEventListener('change', function(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('image-preview-container');
        previewContainer.innerHTML = ''; // Clear previous previews

        // Check if the number of selected files exceeds 5
        if (files.length > 5) {
            alert('You can only upload up to 5 images.');
            event.target.value = ""; // Clear the file input
            return;
        }

        // Loop through the selected files and preview them
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                // Create an img element for each image preview
                const imgElement = document.createElement('img');
                imgElement.src = e.target.result;
                previewContainer.appendChild(imgElement);
            }

            reader.readAsDataURL(file); // Read the file as a data URL
        }
    });
</script>
</body>
</html>
