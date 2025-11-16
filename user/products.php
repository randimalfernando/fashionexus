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
    <title>Products page</title>

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
        <div class="hero-image" style="background-image: url('../assets/products_Cover.jpg');">
            <div class="content">
                <h1 class="wel">All Products</h1>
                <p>"The Greatest Fashion Collection"</p>
            </div>
        </div>
    </div>

    <!---------------------------------------------all products section--------------------------------------------->
    <div class="heading_container">
        <h1>Our Products</h1>
    </div>

    <div class="container">
        <?php include '../components/products_card.php'; ?>
    </div>



    <!---------------------------------------------footer section--------------------------------------------->
    <?php include_once("../components/footer.php"); ?>

    <!-- Scripts for Free Icons In Ionicons-->
   <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
   <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>