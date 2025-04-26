<?php
require('../includes/dbcon.php');

// Check if product ID is provided in the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Construct the SQL DELETE query
    $sql = "DELETE FROM product WHERE id = $product_id";

    // Execute the query
    $result = mysqli_query($con, $sql);

    if ($result) {
        // Product deleted successfully
        header("Location: stock.php"); // Redirect back to the stock page
        exit();
    } else {
        // Error deleting product
        echo "Error: " . mysqli_error($con);
    }
} else {
    // Redirect back to the stock page if product ID is not provided in the URL
    header("Location: stock.php");
    exit();
}
?>
