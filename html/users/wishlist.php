<?php
// Database connection
require('../includes/dbcon.php');

// Check if productID is sent via POST
if(isset($_POST['productID'])) {
    // Retrieve productID sent via POST
    $productID = $_POST['productID'];

    // Fetch product details from the product table
    $sql = "SELECT * FROM product WHERE id = $productID";
    $result = mysqli_query($con, $sql);

    // Check if the query executed successfully
    if ($result) {
        // Check if any rows were returned
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            
            // Extract product details
            $productName = $row['product_name'];
            $productPrice = $row['product_price'];
            $productImage = $row['product_image'];
            
            // Insert product into the wishlist table
            $insertSql = "INSERT INTO wishlist (product_name, product_price, product_image) VALUES ('$productName', '$productPrice', '$productImage')";
            
            if (mysqli_query($con, $insertSql)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'error' => mysqli_error($con)]);
            }
        } else {
            echo json_encode(['success' => false, 'error' => 'Product not found']);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Query execution failed']);
    }

    // Close database connection
    mysqli_close($con);
} else {
    echo json_encode(['success' => false, 'error' => 'productID not provided in POST request']);
}
?>



