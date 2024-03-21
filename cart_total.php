<?php
include 'includes/session.php';

$response = array(); // Initialize response array

if (isset($_SESSION['user'])) {
	$conn = $pdo->open();

	$stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.id = cart.product_id WHERE user_id = :user_id");
	$stmt->execute(['user_id' => $user['id']]);

	$total = 0;

	foreach ($stmt as $row) {
		$subtotal = $row['price'] * $row['quantity'];
		$total += $subtotal;
	}

	$response['success'] = true;
	$response['total'] = $total;

	$pdo->close();
} else {
	$response['success'] = false;
	$response['message'] = 'User not logged in';
}

echo json_encode($response);
