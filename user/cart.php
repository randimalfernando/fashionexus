<?php
@include '../config.php';

session_start();

// session to check the user login
if (!isset($_SESSION['user_name'])) {
    header('Location: ../index.php');
    exit;
}

// ---------------- CART ACTIONS ----------------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $action = $_POST['action'] ?? '';
    $product_id = isset($_POST['product_id']) ? (int)$_POST['product_id'] : 0;

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if ($action === 'increase' && isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['qty'] += 1;
    }

    if ($action === 'decrease' && isset($_SESSION['cart'][$product_id])) {
        if ($_SESSION['cart'][$product_id]['qty'] > 1) {
            $_SESSION['cart'][$product_id]['qty'] -= 1;
        } else {
            unset($_SESSION['cart'][$product_id]);
        }
    }

    if ($action === 'remove' && isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }

    if ($action === 'clear') {
        unset($_SESSION['cart']);
    }

    header('Location: cart.php');
    exit;
}

$cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my cart</title>

    <!-- Custom CSS file link -->
    <link rel="stylesheet" href="../style_sheets/cart_styles.css">

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
                <h1 class="wel">My Cart</h1>
                <p>"Building a Better Tomorrow Through Knowledge"</p>
            </div>
        </div>
    </div> 

    <!-- CART CONTENT -->
    <div class="cart-wrapper">

        <?php if (empty($cartItems)): ?>
            <div class="empty-cart">
                Your cart is empty.
            </div>
        <?php else: ?>

            <!-- header row -->
            <div class="cart-header-row">
                <div>Product</div>
                <div style="text-align:right;">Price</div>
                <div style="text-align:center;">Quantity</div>
                <div style="text-align:right;">Total</div>
            </div>

            <?php
            $grandTotal = 0;
            foreach ($cartItems as $item):
                $lineTotal = $item['price'] * $item['qty'];
                $grandTotal += $lineTotal;
            ?>
                <div class="cart-item-row">

                    <!-- PRODUCT + REMOVE -->
                    <div class="cart-product">
                        <form method="post" style="margin-right: 10px;">
                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                            <button type="submit" name="action" value="remove" class="cart-remove-btn">&times;</button>
                        </form>

                        <div class="cart-product-img">
                            <img src="../products_pics/<?php echo htmlspecialchars($item['pic']); ?>" alt="product">
                        </div>

                        <div class="cart-product-info">
                            <span class="cart-product-title">
                                <?php echo htmlspecialchars($item['name']); ?>
                            </span>
                            <span class="cart-product-meta">
                                COLOR: Default<br>
                                WEIGHT: 1 Unit
                            </span>
                        </div>
                    </div>

                    <!-- PRICE -->
                    <div class="cart-price">
                        A$<?php echo number_format($item['price'], 2); ?>
                    </div>

                    <!-- QUANTITY CONTROL -->
                    <div>
                        <form method="post" class="qty-form">
                            <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                            <div class="qty-control">
                                <button type="submit" name="action" value="decrease" class="qty-btn">-</button>
                                <span class="qty-display"><?php echo $item['qty']; ?></span>
                                <button type="submit" name="action" value="increase" class="qty-btn">+</button>
                            </div>
                        </form>
                    </div>

                    <!-- TOTAL -->
                    <div class="cart-total">
                        A$<?php echo number_format($lineTotal, 2); ?>
                    </div>
                </div>
            <?php endforeach; ?>

            <!-- GRAND TOTAL -->
            <div class="cart-summary">
                Grand Total: A$<?php echo number_format($grandTotal, 2); ?>
            </div>

            
            <!-- CHECKOUT BUTTON -->
            <form action="checkout.php" method="post" style="text-align: right; margin-top: 10px;">
                <button type="submit" class="checkout-btn">
                    Proceed to Checkout
                </button>
            </form>

            <!-- CONTINUE / CLEAR -->
            <div class="cart-footer-row">
                <a href="products.php" class="cart-continue">Continue shopping</a>

                <form method="post" style="margin:0;">
                    <button type="submit" name="action" value="clear" class="cart-clear">
                        Clear Cart
                    </button>
                </form>
            </div>

        <?php endif; ?>


    </div>


    <!---------------------------------------------footer section--------------------------------------------->
    <?php include_once("../components/footer.php"); ?>

</body>

</html>