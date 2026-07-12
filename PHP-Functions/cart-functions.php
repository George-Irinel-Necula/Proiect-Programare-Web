<?php


function getOrCreateCart($conn, $userId) {
    $sql = "SELECT cartId FROM cart WHERE userId = ? LIMIT 1";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($row) {
        return $row['cartId'];
    }

    // No cart yet — create one
    $sql = "INSERT INTO cart (userId) VALUES (?)";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $cartId = mysqli_insert_id($conn);
    mysqli_stmt_close($stmt);
    return $cartId;
}

function getCartItems($conn, $cartId) {
    $sql = "SELECT ci.cartItemId, ci.productId, p.product_name, p.photo, p.price, ci.quantity,
                   (p.price * ci.quantity) AS subtotal
            FROM cart_item ci
            JOIN products p ON ci.productId = p.id
            WHERE ci.cartId = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $cartId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $items = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }
    mysqli_stmt_close($stmt);
    return $items;
}


function addToCart($conn, $cartId, $productId, $quantity = 1) {
   
    $sql = "SELECT cartItemId, quantity FROM cart_item WHERE cartId = ? AND productId = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $cartId, $productId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $existing = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($existing) {
        $newQty = $existing['quantity'] + $quantity;
        $sql = "UPDATE cart_item SET quantity = ? WHERE cartItemId = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "ii", $newQty, $existing['cartItemId']);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        $sql = "INSERT INTO cart_item (cartId, productId, quantity) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        mysqli_stmt_bind_param($stmt, "iii", $cartId, $productId, $quantity);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
}


function removeCartItem($conn, $cartItemId, $cartId) {
    $sql = "DELETE FROM cart_item WHERE cartItemId = ? AND cartId = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "ii", $cartItemId, $cartId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

function updateCartItemQty($conn, $cartItemId, $cartId, $quantity) {
    if ($quantity <= 0) {
        removeCartItem($conn, $cartItemId, $cartId);
        return;
    }
    $sql = "UPDATE cart_item SET quantity = ? WHERE cartItemId = ? AND cartId = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "iii", $quantity, $cartItemId, $cartId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


function clearCart($conn, $cartId) {
    $sql = "DELETE FROM cart_item WHERE cartId = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $cartId);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}


function getCartItemCount($conn, $userId) {
    $sql = "SELECT COALESCE(SUM(ci.quantity), 0) as total
            FROM cart c
            JOIN cart_item ci ON c.cartId = ci.cartId
            WHERE c.userId = ?";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    return (int)$row['total'];
}
