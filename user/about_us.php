<?php

@include '../config.php';

// session to check the user login
session_start();

if (!isset($_SESSION['user_name'])) {
    header('Location: ../index.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>about us</title>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="../style_sheets/other_userpages_styles.css">

</head>

<body>

    <!---------------------------------------------header section--------------------------------------------->
    <?php
    include_once("../components/header.php");
    ?>

    <!---------------------------------------------hero section--------------------------------------------->
    <div class="banner">
        <div class="hero-image" style="background-image: url('../assets/aboutus_cover.jpg');">
            <div class="content">
                <h1 class="wel">About Us</h1>
                <p>"Building a Better Tomorrow Through Knowledge"</p>
            </div>
        </div>
    </div>

    <!---------------------------------------------about us section--------------------------------------------->
    <br>
    <div class="about">
        <div class="inner-section">
            <p class="text">
                Welcome to Fashionexus, where fashion meets innovation. We bring together the latest trends, modern styles, and high-quality products to create a seamless online shopping experience for everyone.
                <br><br>
                Our mission is to connect people with fashion they love effortlessly. At Fashionexus, we focus on affordability, quality, and a smooth customer journey from browsing to checkout. Every collection is carefully curated to help you express your identity with confidence and style.
                <br><br>
                Fashion is constantly evolving, and so are we. Discover your style. Explore your nexus of fashion only at Fashionexus.
            </p>
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
<br><br>

    <!---------------------------------------------footer section--------------------------------------------->
    <?php include_once("../components/footer.php"); ?>

    <!-- Scripts for Free Icons In Ionicons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>