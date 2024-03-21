<?php
session_start();

// Check if cart total is set in session
if (isset($_SESSION['cart_total'])) {
    // Retrieve necessary parameters for initiating eSewa payment
    $amount = $_SESSION['cart_total'];
    $transaction_uuid = uniqid(); // Generate a unique transaction ID

    // You may adjust the following values according to your actual implementation
    $product_code = "EPAYTEST"; // Replace with your actual product code
    $success_url = "http://localhost/ecommerce/esewa_success.php"; // Replace with your actual success URL
    $failure_url = "http://localhost/ecommerce/esewa_failure.php"; // Replace with your actual failure URL

    // Construct the form for eSewa payment
    $redirect_url = "https://rc-epay.esewa.com.np/epay/main";
    $esewa_params = http_build_query(array(
        "amt" => $amount,
        "txAmt" => $amount,
        "psc" => 0,
        "pdc" => 0,
        "tAmt" => $amount,
        "pid" => $product_code,
        "scd" => "EPAYTEST",
        "su" => urlencode($success_url), // Encode the URL parameters
        "fu" => urlencode($failure_url), // Encode the URL parameters
        "req" => $transaction_uuid
    ));
    $esewa_payment_url = $redirect_url . "?" . $esewa_params;

    // Redirect the user to eSewa payment page
    header("Location: $esewa_payment_url");
    exit;
} else {
    // Handle case where cart total is not set in session
    echo "Cart total not found in session. Please add items to your cart first.";
    exit;
}
