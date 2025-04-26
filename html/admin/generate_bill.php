<?php
// Start the session to manage user sessions
session_start();

// Include the database connection file
include_once '../includes/dbcon.php';

// Check if the form is submitted for generating invoice
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];

    // Fetch order details from the database
    $sql = "SELECT orders.*, product.name AS product_name, product.price, users.username
            FROM orders
            INNER JOIN product ON orders.product_id = product.id
            INNER JOIN users ON orders.user_id = users.id
            WHERE orders.id = $order_id";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Calculate total price including delivery charge
        $total_price = ($row["quantity"] * $row["price"]) + 100; // Assuming delivery charge is Rs. 100

        // Generate and display invoice HTML
        echo "<!DOCTYPE html>";
        echo "<html lang='en'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<title>Invoice</title>";
        echo "<style>";
        echo "body { font-family: Arial, sans-serif; }";
        echo ".invoice { max-width: 800px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 10px; }";
        echo "h2 { text-align: center; }";
        echo "p { margin: 5px 0; }";
        echo "table { width: 100%; border-collapse: collapse; }";
        echo "table, th, td { border: 1px solid #ccc; padding: 8px; }";
        echo "th { background-color: #f2f2f2; }";
        echo "tfoot { font-weight: bold; }";
        echo "button { padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 5px; cursor: pointer; }";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<div class='invoice'>";
        echo "<h2>Invoice</h2>";
        echo "<p><strong>Order ID:</strong> " . $row["id"] . "</p>";
        echo "<p><strong>User Name:</strong> " . $row["username"] . "</p>";
        echo "<table>";
        echo "<thead>";
        echo "<tr>";
        echo "<th>Product</th>";
        echo "<th>Quantity</th>";
        echo "<th>Unit Price (Rs.)</th>";
        echo "<th>Total Price (Rs.)</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        echo "<tr>";
        echo "<td>" . $row["product_name"] . "</td>";
        echo "<td>" . $row["quantity"] . "</td>";
        echo "<td>" . $row["price"] . "</td>";
        echo "<td>" . ($row["quantity"] * $row["price"]) . "</td>";
        echo "</tr>";
        echo "</tbody>";
        echo "<tfoot>";
        echo "<tr>";
        echo "<td colspan='3'><strong>Delivery Charge:</strong></td>";
        echo "<td>100</td>"; // Assuming delivery charge is Rs. 100
        echo "</tr>";
        echo "<tr>";
        echo "<td colspan='3'><strong>Total:</strong></td>";
        echo "<td>" . $total_price . "</td>";
        echo "</tr>";
        echo "</tfoot>";
        echo "</table>";
        echo "<p><strong>Order Date:</strong> " . $row["created_at"] . "</p>";
        echo "<p><strong>Checkout Mode:</strong> " . $row["checkout_mode"] . "</p>";
        echo "<button onclick='window.print()' style='background-color:black'>Print Invoice</button>";
        echo "</div>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "No order found with the specified ID.";
    }
} else {
    echo "Invalid request.";
}
?>
