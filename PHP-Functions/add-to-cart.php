<?php

if (!isset($_SESSION['id'])) {

    session_start();
}
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    header("location: ../login.php?error=notLoggedIn");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['productId'])) {
    header("location: ../store.php");
    exit();
}

$productId = (int)$_POST['productId'];
$quantity  = isset($_POST['quantity']) ? max(1, (int)$_POST['quantity']) : 1;
$userId    = (int)$_SESSION['id'];

include_once __DIR__ . '/db-connect.php';
include_once __DIR__ . '/cart-functions.php';

$cartId = getOrCreateCart($conn, $userId);
addToCart($conn, $cartId, $productId, $quantity);

header("location: ../cart.php?added=1");
exit();
