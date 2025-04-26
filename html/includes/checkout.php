<?php
require('../includes/dbcon.php');
session_start();
$user = $_SESSION['user'];

if (isset($_GET['id']) && ($_GET['id'] == 0)) {
    $checkout_mode = 'Cash On Delivery'; //retrive from cheeckout
}
if (isset($_GET['id']) && ($_GET['id'] == 1)) {
    $checkout_mode = 'Khalti Wallet'; //retrive from cheeckout
}// Get the products from the cart table
$user_id = $user['id'];
$sql = "SELECT * FROM `cart` WHERE user_id = ?";
$stmt = $con->prepare($sql);

// Check for preparation errors
if (!$stmt) {
    die('Error preparing statement: ' . $con->error);
}

// Bind parameters
$stmt->bind_param("i", $user_id);

// Execute the statement
$stmt->execute();

// Check for execution errors
if ($stmt->error) {
    die('Error executing statement: ' . $stmt->error);
}

// Get the result set
$result = $stmt->get_result();

// Insert the products into the orders table
while ($row = $result->fetch_assoc()) {
    $product_id = $row['product_id'];
    $quantity = $row['quantity'];
    $amount = $row['amount'];

    $sql = "INSERT INTO orders (user_id, product_id, quantity, amount, checkout_mode) VALUES (?, ?, ?, ?, ?)";
    $stmt2 = $con->prepare($sql);

    // Check for preparation errors
    if (!$stmt2) {
        die('Error preparing statement: ' . $con->error);
    }

    // Bind parameters
    $stmt2->bind_param("iiids", $user_id, $product_id, $quantity, $amount, $checkout_mode);

    // Execute the statement
    $stmt2->execute();

    // Check for execution errors
    if ($stmt2->error) {
        die('Error executing statement: ' . $stmt2->error);
    }
}

// Clear the cart
$sql = "DELETE FROM cart WHERE user_id = ?";
$stmt3 = $con->prepare($sql);

// Check for preparation errors
if (!$stmt3) {
    die('Error preparing statement: ' . $con->error);
}

// Bind parameters
$stmt3->bind_param("i", $user_id);

// Execute the statement
$stmt3->execute();

// Check for execution errors
if ($stmt3->error) {
    die('Error executing statement: ' . $stmt3->error);
}

// Redirect to the dashboard
header('location:../users/dashboard.php');
exit;
?>
