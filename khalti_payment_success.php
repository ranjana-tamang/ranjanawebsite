
<?php include 'includes/session.php'; ?>
<?php
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$amountInPaisa = $_GET['amount']; // This is 122500 in your example, which is in paisa
$totalAmountInPaisa = $_GET['total_amount'];


// Convert the amounts back to rupees (or your base currency)
$amountInRupees = $amountInPaisa / 100;
$totalAmountInRupees = $totalAmountInPaisa / 100;


// Retrieve query parameters
$pidx = isset($_GET['pidx']) ? $_GET['pidx'] : '';
$transaction_id = isset($_GET['transaction_id']) ? $_GET['transaction_id'] : '';
$tidx = isset($_GET['tidx']) ? $_GET['tidx'] : '';
$amount = isset($_GET['amount']) ? $_GET['amount'] : 0;
$total_amount = isset($_GET['total_amount']) ? $_GET['total_amount'] : 0;
$mobile = isset($_GET['mobile']) ? $_GET['mobile'] : '';
$status = isset($_GET['status']) ? $_GET['status'] : '';
$purchase_order_id = isset($_GET['purchase_order_id']) ? $_GET['purchase_order_id'] : '';
$purchase_order_name = isset($_GET['purchase_order_name']) ? $_GET['purchase_order_name'] : '';

// Display the details
echo "<h2>Order Details</h2>";
echo "<p>Payment Index: " . htmlspecialchars($pidx) . "</p>";
echo "<p>Transaction ID: " . htmlspecialchars($transaction_id) . "</p>";
echo "<p>Transaction Index: " . htmlspecialchars($tidx) . "</p>";
echo "Amount: " . $amountInRupees . "<br>";
echo "Total Amount: " . $totalAmountInRupees . "<br>";
echo "<p>Mobile: " . htmlspecialchars($mobile) . "</p>";
echo "<p>Status: " . htmlspecialchars($status) . "</p>";
echo "<p>Purchase Order ID: " . htmlspecialchars($purchase_order_id) . "</p>";
echo "<p>Purchase Order Name: " . htmlspecialchars($purchase_order_name) . "</p>";

// Show success message
echo "<h3>Order Placed Successfully</h3>";



// Fetch the order details
// $query = $conn->prepare("SELECT * FROM order_details WHERE order_id = ?");
// $query->bind_param("s", $purchase_order_id); // Assuming 'order_id' is a string
// $query->execute();
// $query->store_result();

// if ($query->num_rows > 0) {
//     $query->bind_result($orderId, $productsOrdered);
//     while ($query->fetch()) {
//         // Process your data here
//         echo "<p>Order ID: " . htmlspecialchars($orderId) . "</p>";
//         // Assuming 'products_ordered' contains a comma-separated list of product IDs
//         $productsOrderedArray = explode(',', $productsOrdered);
//         foreach ($productsOrderedArray as $productId) {
//             // Fetch and display product details
//         }
//     }
// } else {
//     echo "<p>Order details not found.</p>";
// }
// $query->close();
// $conn->close();
?>
