<?php
session_start();

$amount = isset($_GET['amount']) ? $_GET['amount'] : 0; // Retrieve the amount from the URL parameter
$transaction_uuid = uniqid(); // Generate a unique transaction ID

// You may adjust the following values according to your actual implementation
$product_code = "EPAYTEST"; // Replace with your actual product code
$success_url = "http://localhost/ecommerce/sales.php"; // Replace with your actual success URL
$failure_url = "http://localhost/ecommerce/failure.php"; // Replace with your actual failure URL

// Calculate the total amount (without considering taxes or additional charges)
$total_amount = $amount;

// Construct the form for eSewa payment
echo '<form id="esewa_payment_form" action="https://rc-epay.esewa.com.np/api/epay/main/v2/form" method="POST">';
echo '<input type="hidden" id="amount" name="amount" value="' . $total_amount . '" required>';
echo '<input type="hidden" id="total_amount" name="total_amount" value="' . $total_amount . '" required>';
echo '<input type="hidden" id="transaction_uuid" name="transaction_uuid" value="' . $transaction_uuid . '" required>';
echo '<input type="hidden" id="product_code" name="product_code" value="' . $product_code . '" required>';
echo '<input type="hidden" id="success_url" name="success_url" value="' . $success_url . '" required>';
echo '<input type="hidden" id="failure_url" name="failure_url" value="' . $failure_url . '" required>';
echo '<input type="hidden" id="signed_field_names" name="signed_field_names" value="total_amount,transaction_uuid,product_code" required>';
echo '<input type="hidden" id="signature" name="signature" required>';
echo '<input type="submit" value="Proceed to eSewa Payment">';
echo '</form>';
