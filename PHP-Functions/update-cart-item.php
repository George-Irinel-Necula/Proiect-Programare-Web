<?php
if (!isset($_SESSION['id'])) {
    session_start();
}
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header("location: ../login.php?error=notLoggedIn");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['cartItemId'], $_POST['quantity'])) {
    header("location: ../cart.php");
    exit();
}

$cartItemId = (int)$_POST['cartItemId'];
$quantity   = (int)$_POST['quantity'];
$userId     = (int)$_SESSION['id'];

include_once __DIR__ . '/db-connect.php';
include_once __DIR__ . '/cart-functions.php';

$cartId = getOrCreateCart($conn, $userId);
updateCartItemQty($conn, $cartItemId, $cartId, $quantity);

header("location: ../cart.php");
exit();
