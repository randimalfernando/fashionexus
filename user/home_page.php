<?php
@include '../config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// optional: check login
if (!isset($_SESSION['user_name'])) {
    header('Location: ../index.php');
    exit;
}

// ---------------- ADD TO CART LOGIC ----------------
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {

    $product_id = (int)$_POST['product_id'];
    $qty = 1; // you can later change to read from a quantity input

    // get product from DB using your real table/columns
    $stmt = $conn->prepare("SELECT id, item_name, item_price, item_pic FROM products_tbl WHERE id = ?");
    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if ($product) {
        // ensure cart exists
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // if already in cart → increase qty, otherwise add new
        if (isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$product_id] = [
                'id'    => $product['id'],
                'name'  => $product['item_name'],
                'price' => (float)$product['item_price'],
                'pic'   => $product['item_pic'],
                'qty'   => $qty
            ];
        }
    }

    // prevent resubmit on refresh
    header("Location: products.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>home page</title>

   <!-- Custom CSS file link -->
   <link rel="stylesheet" href="../style_sheets/homepage_styles.css">
   <link rel="stylesheet" href="../style_sheets/other_userpages_styles.css">

</head>

<body>

   <!---------------------------------------------header section--------------------------------------------->
   <?php
   include_once("../components/header.php");
   ?>

   <!---------------------------------------------welcome section--------------------------------------------->

   <div class="banner">
      <div class="slider" id="slider">
         <!-- Each slide is represented by a div -->
         <div class="slide"></div>
         <div class="slide"></div>
         <div class="slide"></div>
      </div>

      <div class="content">
         <h1 class="wel">Welcome To FashioNexus</h1>
         <p>"Connecting You to Trend"</p>

         <div>
            <!-- <button type="button" class="btns"><span></span><a href="about_us.php">ABOUT US</a></button>
            <button type="button" class="btns"><span></span><a href="contact_us.php">CONTACT US</a></button> -->
         </div>
      </div>
   </div>

   <!---------------------------------------------details cards section--------------------------------------------->
   <div class="contact-cards">
      <div class="card">
         <div class="icon">
            <ion-icon name="star"></ion-icon>
         </div>
         <h3>Our Vision</h3>
         <p>At Fashionexus, our mission is to make fashion simple, accessible, and enjoyable for everyone. We aim to provide high-quality, trend-focused products while ensuring a smooth and secure online shopping experience.</p>
      </div>
      <div class="card">
         <div class="icon">
            <ion-icon name="star"></ion-icon>
         </div>
         <h3>Our Mission</h3>
         <p>Our vision is to become a leading digital fashion destination where innovation meets style. We strive to build a platform that connects people with fashion they love, powered by modern technology, seamless user experience, and a commitment to continuous improvement.</p>
      </div>
      <div class="card">
         <div class="icon">
            <ion-icon name="help"></ion-icon>
         </div>
         <h3>Why Us</h3>
         <p>Choosing Fashionexus means choosing quality, convenience, and trust. We offer curated collections, stylish designs, affordable pricing, and secure payment options all in one place.</p>
      </div>
   </div>

   <!---------------------------------------------products section--------------------------------------------->
   <div class="heading_container">
      <h1>Our Trending Products</h1>
   </div>

   <div class="container">

      <div class="button-container">
         <a href="products.php" class="view-more-btn">View More</a>
      </div>

      <?php include '../components/homepage_products_card.php'; ?>
   </div>


   <!---------------------------------------------about us section--------------------------------------------->
   <div class="heading_container">
      <h1>About Us</h1>
   </div>
   <div class="about">
      <div class="inner-section">
         <p class="text">
                Welcome to Fashionexus, where fashion meets innovation. We bring together the latest trends, modern styles, and high-quality products to create a seamless online shopping experience for everyone.
                <br><br>
                Our mission is to connect people with fashion they love effortlessly. At Fashionexus, we focus on affordability, quality, and a smooth customer journey from browsing to checkout. Every collection is carefully curated to help you express your identity with confidence and style.
                <br><br>
                Fashion is constantly evolving, and so are we. Discover your style. Explore your nexus of fashion only at Fashionexus.
            </p>
         <div class="button-container">
            <a href="about_us.php" class="view-more-btn">View More</a>
         </div>

      </div>
   </div>

   <!---------------------------------------------footer section--------------------------------------------->
   <?php include_once("../components/footer.php"); ?>

   <!-- Scripts -->
   <script src="../js/homepage_slider.js"></script>

   <!-- Scripts for Free Icons In Ionicons-->
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>