<?php

@include '../config.php';

// session to check the user login
session_start();

if (!isset($_SESSION['user_name'])) {
    header('Location: ../index.php');
}

// php function to add new message
$message = "";

if (isset($_POST["submit"])) {
    $fullName = $_POST['full_name'];
    $contactNo = $_POST['contact_no'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // insert quary
    $sql = "INSERT INTO `user_messages_tbl` (`id`, `full_name`, `contact_no`, `email`, `message`) VALUES ('NULL', '$fullName', '$contactNo', '$email', '$message')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        $message = "Academic staff has received your message and will respond to you shortly.";
    } else {
        $message = "Failed: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact us</title>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="../style_sheets/other_userpages_styles.css">
    <link rel="stylesheet" href="../style_sheets/admin_main_form_styles.css">


</head>

<body>

    <!---------------------------------------------header section--------------------------------------------->
    <?php
    include_once("../components/header.php");
    ?>

    <!---------------------------------------------hero section--------------------------------------------->
    <div class="banner">
        <div class="hero-image" style="background-image: url('../assets/contactus_cover.webp');">
            <div class="content">
                <h1 class="wel">Contact Us</h1>
                <p>"Have Questions? Get in Touch Today"</p>
            </div>
        </div>
    </div>

    <!---------------------------------------------contact cards section--------------------------------------------->
    <div class="contact-cards">
        <div class="card">
            <div class="icon">
                <ion-icon name="location"></ion-icon>
            </div>
            <h3>Address</h3>
            <p>Queen St, Melbourne, VIC</p>
        </div>
        <div class="card">
            <div class="icon">
                <ion-icon name="call"></ion-icon>
            </div>
            <h3>Phone</h3>
            <p>0481202967</p>
        </div>
        <div class="card">
            <div class="icon">
                <ion-icon name="mail"></ion-icon>
            </div>
            <h3>Email</h3>
            <p>contact@fashionexus.com</p>
        </div>
    </div>

    <!---------------------------------------------contact form section--------------------------------------------->
    <div class="heading_container">
        <h1>Send Us Your Questions</h1>
    </div>

    <div class="container">

        <!-- add new message form -->
        <form action="contact_us.php" method="post">
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" name="full_name" id="full_name" placeholder="Enter your full name" required>
            </div>

            <div class="form-group">
                <label for="contact_no">Contact No:</label>
                <input type="text" name="contact_no" id="contact_no" placeholder="Enter your contact number" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Enter your email" required>
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <input type="message" name="message" id="message" placeholder="Enter your message" required>
            </div>

            <div class="button-group">
                <button type="submit" class="btn-success" name="submit">Send Message</button>
            </div>
        </form>

        <!-- To display status message -->
        <div id="statusMessage" class="message-box">
            <?= $message ?>
        </div>
    </div>

    <!---------------------------------------------footer section--------------------------------------------->
    <?php include_once("../components/footer.php"); ?>

    <!-- Scripts for Free Icons In Ionicons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>