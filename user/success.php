<?php
session_start();

// clear cart after successful payment
if (isset($_SESSION['cart'])) {
    unset($_SESSION['cart']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment Successful</title>
    <link rel="stylesheet" href="../style_sheets/other_userpages_styles.css">
</head>
<body>

<?php include_once("../components/header.php"); ?>

<div style="max-width: 800px; margin: 80px auto; text-align: center;">
    <h1>Thank you!</h1>
    <p>Your payment was successful. A confirmation email will be sent to you shortly.</p>
    <a href="/FashioNexus/user/products.php"
   style="display:inline-block;margin-top:20px;color:#1e69ff;text-decoration:none;font-weight:600;">
    Back to shop
</a>
</div>

<?php include_once("../components/footer.php"); ?>

</body>
</html>
