<?php
if (!isset($_SESSION['id'])) {
    session_start();
}
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header("location: ../login.php?error=notLoggedIn");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("location: ../order.php");
    exit();
}

$userId = (int)$_SESSION['id'];

include_once __DIR__ . '/db-connect.php';
include_once __DIR__ . '/cart-functions.php';

$cartId = getOrCreateCart($conn, $userId);
$items  = getCartItems($conn, $cartId);

if (empty($items)) {
    header("location: ../cart.php?error=empty");
    exit();
}

// Calculate total (items + 20 RON shipping)
$subtotal = array_sum(array_column($items, 'subtotal'));
$shipping = 20.00;
$total    = $subtotal + $shipping;

// Insert into orders
$sql  = "INSERT INTO orders (userId, totalAmount) VALUES (?, ?)";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);
mysqli_stmt_bind_param($stmt, "id", $userId, $total);
mysqli_stmt_execute($stmt);
$orderId = mysqli_insert_id($conn);
mysqli_stmt_close($stmt);

// Insert each order_item
$sql  = "INSERT INTO order_item (orderId, productId, quantity, price) VALUES (?, ?, ?, ?)";
$stmt = mysqli_stmt_init($conn);
mysqli_stmt_prepare($stmt, $sql);

foreach ($items as $item) {
    $productId = $item['productId'];
    $quantity  = $item['quantity'];
    $price     = $item['price'];
    mysqli_stmt_bind_param($stmt, "iiid", $orderId, $productId, $quantity, $price);
    mysqli_stmt_execute($stmt);
}
mysqli_stmt_close($stmt);

// Clear the cart
clearCart($conn, $cartId);

header("location: ../order-success.php?orderId=" . $orderId);
exit();
