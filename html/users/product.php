<?php
    session_start();
    $user = $_SESSION['user'];
    print_r($user);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="../../css/product/product.css">
    <link rel="stylesheet" href="../../css/user/style.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
<div class="sidebar">
    <div class="logo-details">
      <span class="logo_name">PHURBA</span>
      <a href="../../user_index.php"></a> 
    </div>
      <ul class="nav-links">
        <li>
          <a href="dashboard.php">
            <i class='bx bx-grid-alt' ></i>
            <span class="links_name">Dashboard</span>
          </a>
        </li>
        <li>
          <a href="product.php" class="active">
            <i class='bx bx-box' ></i>
            <span class="links_name">Product</span>
          </a>
        </li>
        <li>
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
        <span class="user_name">User</span>
        <i class='bx bxs-user-circle' ></i>
      </div>
    </nav>
    <div class="home-content">
      <div class="gallery">
          <div class="content">
              <img src="ruses/tren1.jpg">
              <h3>Black Jacket</h3>
              <p>Black Hoodie</p>
              <h6>Nrs. 1600</h6>
              <center><button class="buy1">Buy Now</button></center>
          </div>
          
          <div class="content">
              <img src="ruses/tren2.jpg">
              <h3>Joggers</h3>
              <p>Black Joggers</p>
              <h6>Nrs. 1600</h6>
              <button class="buy2">Buy Now</button>
          </div>

          <div class="content">
              <img src="ruses/tren3.jpg">
              <h3>Hoodie</h3>
              <p> Plain Hoodie</p>
              <h6>Nrs.2000</h6>
              <button class="buy3">Buy Now</button>
          </div>

          <div class="content">
              <img src="ruses/tren4.jpg">
              <h3>Joggers</h3>
              <p>Plain Joggers</p>
              <h6>Nrs. 1600</h6>
              <center><button class="buy4">Buy Now</button></center>
          </div>

          <div class="content">
              <img src="ruses/fea4.jpg.jpg">
              <h3>Sweaters</h3>
              <p>Plain Sweater</p>
              <h6>Nrs. 1600</h6>
              <button class="buy2">Buy Now</button>
          </div>

          <div class="content">
              <img src="ruses/fea2.jpg.jpg">
              <h3>Jackets</h3>
              <p>Bomber Jacket</p>
              <h6>Nrs. 1600</h6>
              <button class="buy2">Buy Now</button>
          </div>

          <div class="content">
              <img src="ruses/fea3.jpg.jpg">
              <h3>Full Coat</h3>
              <p>Plain Coat</p>
              <h6>Nrs. 1600</h6>
              <button class="buy2">Buy Now</button>
          </div>

          <div class="content">
              <img src="ruses/fea6.jpg.jpg">
              <h3>Sweaters</h3>
              <p>Plain Sweater</p>
              <h6>Nrs. 1600</h6>
              <button class="buy2">Buy Now</button>
          </div>

          <div class="content">
              <img src="ruses/fea7.jpg.jpg">
              <h3>Shirts</h3>
              <p>Plain Shirt</p>
              <h6>Nrs. 1600</h6>
              <button class="buy2">Buy Now</button>
          </div>

          <div class="content">
              <img src="ruses/fea8.jpg.jpg">
              <h3>Hoodie</h3>
              <p>Blue Hoodie</p>
              <h6>Nrs. 1600</h6>
              <button class="buy2">Buy Now</button>
          </div>        
          
      </div>
    </div>
</body>
</html>