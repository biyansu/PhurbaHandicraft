<?php
require('../includes/dbcon.php');
session_start();
$user = $_SESSION['user'];

// Check if the user is logged in
if (!isset($user)) {
    // Redirect to login page or handle as needed
    header("Location: ../login.php");
    exit();
}

// Get the user ID
$user_id = $user['id'];

// Fetch orders for the user
$sql = "SELECT orders.*, product.name
        FROM orders
        INNER JOIN product ON orders.product_id = product.id
        WHERE user_id = $user_id";
$result = mysqli_query($con, $sql);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="UTF-8">
    <title>User Orders</title>
    <link rel="stylesheet" href="../../css/user/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://khalti.s3.ap-south-1.amazonaws.com/KPG/dist/2020.12.17.0.0.0/khalti-checkout.iffe.js"></script>

</head>
<style>
        /* Add this CSS to change the color of the sidebar to brown */
        .sidebar {
           
            background-color: black; /* Change this to your desired brown color */
          
        }
        .logo-container {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100px; /* Set an appropriate height for the container */
}
        /* Your existing styles */
        .checkout{
            height: 100vh;
            position: absolute;
            width: 100%;
            background: white;
            display: none;
        }
        .checkout-active{
            display: block;
        }
        .sidebar {
            background-color: black; /* Change this to your desired brown color */
        }
        .logo-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100px; /* Set an appropriate height for the container */
        }
        .btn {
            padding: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn.bg-primary {
            background-color: black; /* Blue color */
            color: #fff;
        }
        .btn.bg-primary:hover {
            background-color: black; /* Darker shade of blue on hover */
        }
        .btn.bg-danger {
            background-color: black; /* Red color */
            color: #fff;
        }
        .btn.bg-danger:hover {
            background-color: black; /* Darker shade of red on hover */
        }
        .btn.white-text {
            color: #fff; /* White text color */
        }
        .same-size {
            width: 150px; /* Adjust as needed */
        }
        /* Adjustments for section spacing */
        .home-section {
            margin-bottom: 20px; /* Adjust the spacing between sections */
        }
    </style>
<body>
    <div class="sidebar">
    <div class="logo-container">
    <div class="logo-details">
        <span class="logo_name" style="font-family: 'Arial', sans-serif; font-size: 30px;">PHURBA</span>
    </div>
</div>
        <ul class="nav-links">
            <li>
                <a href="../../user_index.php">
                <i class='bx bx-grid-alt' ></i>
                    <span class="links_name">Home</span>
                </a>
            </li>
            <li>
                <a href="dashboard.php">
                <i class='bx bx-shopping-bag'></i>
               <span class="links_name">Cart</span>
                </a>
            </li>
            <li class="active">
                <a href="orders.php">
                    <i class='bx bx-cart'></i>
                    <span class="links_name">Orders</span>
                </a>
            </li>
           
            <li class="log_out">
                <?php
                if(isset($user)){
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
                <span class="user_name"><?php echo $user['username'] ?></span>
                <i class='bx bxs-user-circle'></i>
            </div>
        </nav>
        <div class="home-content">
    <h1>Checkout</h1>
    <form action="../includes/checkout.php?id=0" method="POST">
        <table style="margin: 0 auto; width: 50%;"> 
            <tr>
                <td colspan="2"><h3>1. General Information</h3></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label for="phone">Phone Number:</label></td>
                <td><input type="text" id="phone" name="phone" style="width: 100%;" required></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label for="order_note">Order Note:</label></td>
                <td><textarea id="order_note" name="order_note" style="width: 100%;" required></textarea></td>
            </tr>
            <tr>
                <td colspan="2"><h3>2. Delivery Address</h3></td>
            </tr>
            <tr>
                <td style="text-align: right;"><label for="landmark">Landmark:</label></td>
                <td><input type="text" id="landmark" name="landmark" style="width: 100%;" required></td>
            </tr>
            <tr>
                <td colspan="2"><h3>3. Payment Method</h3></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <button class="btn bg-primary same-size" type="submit">
                        <i class='bx bx-money' style="font-size: 24px;"></i></br> Cash on Delivery
                    </button>

                    <button type="button"   id="payment-button" class="btn bg-primary same-size">
                        <i class='bx bx-wallet' style="font-size: 24px;"></i></br> Khalti Wallet
                    </button>

                    <button class="btn bg-danger same-size" onclick="cancelCheckout()">
                        <i class='bx bx-x' style="font-size: 24px;"></i> </br>Cancel
                    </button>

                    


                </td>
            </tr>
        </table>
    </form>
</div>

  
<script>

  function checkoutMode(elem){
    let value = elem.value;
    let qr_img = document.querySelector("#qr-img");

    if(value == "qr"){

      console.dir(qr_img);
      qr_img.classList.add("qr-active");
    }else{
      qr_img.classList.remove("qr-active");

    }
    console.log(value);
  }

  function toggleCheckOut() {
        let checkoutform = document.querySelector("#checkout");
        let checkoutOptions = document.querySelector("#checkoutOptions");

        checkoutform.classList.toggle("checkout-active");
        checkoutOptions.style.display = checkoutform.classList.contains("checkout-active") ? "block" : "none";
    }
    

        var config = {
            // replace the publicKey with yours
            "publicKey": "test_public_key_fe0817252cbc4d419f4287d33c92bf39",
            "productIdentity": "1234567890",
            "productName": "Dragon",
            "productUrl": "http://gameofthrones.wikia.com/wiki/Dragons",
            "paymentPreference": [
                "KHALTI",
                
                
                ],
            "eventHandler": {
                onSuccess (payload) {
                    // hit merchant api for initiating verfication
                    console.log(payload);
                    window.location.href="../includes/checkout.php?id=1";
                },
                onError (error) {
                    console.log(error);
                },
                onClose () {
                    console.log('widget is closing');
                }
            }
        };

        var checkout = new KhaltiCheckout(config);
        var btn = document.getElementById("payment-button");
        btn.onclick = function () {
            // minimum transaction amount must be 10, i.e 1000 in paisa.
            checkout.show({amount: 1000});
        }
    </script>
    </section>
    <!-- Add any additional scripts at the end if required -->
</body>
</html>
