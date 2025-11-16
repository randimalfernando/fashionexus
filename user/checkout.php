<?php
require '../vendor/autoload.php';   // Composer autoload – adjust path if needed
@include '../config.php';

session_start();

// if cart is empty, go back to cart
if (empty($_SESSION['cart'])) {
    header('Location: cart.php');
    exit;
}

// 1. Set your Stripe secret key (TEST key)
\Stripe\Stripe::setApiKey('sk_test_51STOBdAGkdEoo8JR69uGvPGLryDsGJrCgScxlcOBDyhVE1hTHt1EJRztQhq2AXO0erppYUVrIATsBBThlrdw5mEa0095rWNCga'); 
// 2. Build line items for Stripe from session cart
$cartItems = $_SESSION['cart'];
$line_items = [];

foreach ($cartItems as $item) {
    $line_items[] = [
        'price_data' => [
            'currency' => 'aud',
            'product_data' => [
                'name' => $item['name'],  // from your cart structure
            ],
            // Stripe expects amount in cents
            'unit_amount' => (int) round($item['price'] * 100),
        ],
        'quantity' => $item['qty'],
    ];
}

// 3. Create Checkout Session
    try {
        $session = \Stripe\Checkout\Session::create([
        'mode' => 'payment',
        'line_items' => $line_items,
        'success_url' => 'http://localhost/FashioNexus/user/success.php',
        'cancel_url'  => 'http://localhost/FashioNexus/user/cart.php',
    ]);
    // 4. Redirect to Stripe-hosted Checkout page
    header('Location: ' . $session->url);
    exit;

} catch (\Stripe\Exception\ApiErrorException $e) {
    // Handle error nicely
    echo "Stripe API error: " . htmlspecialchars($e->getMessage());
    exit;
}
