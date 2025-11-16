<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// calculate total qty in cart
$cartQty = 0;
if (!empty($_SESSION['cart'])) {
    foreach ($_SESSION['cart'] as $item) {
        $cartQty += $item['qty'];
    }
}
?>

<header class="header">
<!-- Custom CSS file link -->
   <link rel="stylesheet" href="../style_sheets/header_styles.css">
    <div class="logo">
        <a href="home_page.php">
            <img src="../assets/Logo large  version.png" alt="Logo">
        </a>
    </div>

    <nav class="nav" id="nav">
        <ul class="nav-list">
            <li><a href="home_page.php" class="nav-link" id="home">Home</a></li>
            <li><a href="products.php" class="nav-link" id="teachers">Products</a></li>
            <li><a href="about_us.php" class="nav-link" id="about-us">About Us</a></li>
            <li><a href="contact_us.php" class="nav-link" id="contact-us">Contact Us</a></li>
            <li><a href="user_profile.php" class="nav-link" id="user_profile">Profile</a></li>

            <!-- MY CART -->
            <li class="cart-nav-item">
                <a href="cart.php" class="nav-link cart-nav-link" id="cart-link">
                    <ion-icon name="cart-outline" class="cart-icon"></ion-icon>
                    <span class="cart-label">My Cart</span>
                    <span class="cart-badge"><?php echo $cartQty; ?></span>
                </a>
            </li>
        </ul>
    </nav>

    <div class="menu-toggle" id="menu-toggle">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </div>
</header>
