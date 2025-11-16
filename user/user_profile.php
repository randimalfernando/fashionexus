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
    <title>user profile</title>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="../style_sheets/other_userpages_styles.css">

    <!-- Display a confirmation dialog box -->
    <script>
        function confirmLogout(id) {
            if (confirm("Are You Sure To logout From Your Account?")) {
                window.location.href = `../logout.php`;
            }
        }
    </script>

</head>

<body>

    <!---------------------------------------------header section--------------------------------------------->
    <?php
    include_once("../components/header.php");
    ?>

    <!---------------------------------------------hero section--------------------------------------------->
    <div class="banner">
        <div class="hero-image" style="background-image: url('../assets/profile cover.png');">
            <div class="content">
                <h1 class="wel">Your Profile</h1>
                <p>"Honored to Have Your Interest With Us"</p>
            </div>
        </div>
    </div>

    <!------------------------------------ Dynamic Content for Settings ------------------------------------>
    <div class="profile">

        <div class="profile_container">

            <div class="profile-icon">
                <img src="../assets/profileIcon.png" alt="User Profile">
            </div>

            <div class="user_profile_content">
                <h3>Hi, <span>User</span></h3>
                <h1>welcome <span><?php echo $_SESSION['user_name'] ?></span></h1>
                <p>This is your user account. Thank you for choosing us.</p>
                <a href="../register_form.php" class="btn">register another account</a>
                <a href="javascript:void(0);" class="btn" onclick="confirmLogout()">logout</a>

            </div>

        </div>
    </div>


    <!---------------------------------------------footer section--------------------------------------------->
    <?php include_once("../components/footer.php"); ?>

    <!-- Scripts for Free Icons In Ionicons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>