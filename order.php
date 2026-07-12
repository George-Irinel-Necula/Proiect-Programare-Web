<!DOCTYPE html>
<html lang="en">
<?php
include_once './PHP-Functions/functions.php';
include_once './PHP-Functions/db-connect.php';
include_once './PHP-Functions/cart-functions.php';
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Finalizeaza Comanda</title>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./src/index.css">
  <link rel="stylesheet" href="./src/theme.css">
    <link rel="stylesheet" href="dist/assets/main.css">
  <script src="dist/assets/main.js"></script>
</head>

<body data-theme="elixirul-tineretii">

  <?php include "./Resources/nav-component.php" ?>
  <?php checkUserLoggedIn() ?>

  <?php
    $userId   = (int)$_SESSION['id'];
    $cartId   = getOrCreateCart($conn, $userId);
    $items    = getCartItems($conn, $cartId);

    if (empty($items)) {
        header("location: ./cart.php?error=empty");
        exit();
    }

    $subtotal = array_sum(array_column($items, 'subtotal'));
    $shipping = 20.00;
    $total    = $subtotal + $shipping;
  ?>

  <main class="px-4 sm:px-6 py-8">

    <div class="mx-auto max-w-7xl">

      <div class="flex flex-col lg:flex-row gap-8 items-start">

       
        <div class="bg-base-200 p-6 sm:p-8 rounded-lg shadow-lg w-full lg:w-3/4">

          <h1 class="text-2xl sm:text-3xl font-semibold mb-8">
            Finalizare Comanda
          </h1>

          <form action="./PHP-Functions/place-order.php" method="POST" class="space-y-6">

            <div>
              <label class="label"><span class="label-text">Nume complet</span></label>
              <input type="text" name="fullname" class="input input-bordered w-full" required>
            </div>

            <div>
              <label class="label"><span class="label-text">Telefon</span></label>
              <input type="tel" name="phone" class="input input-bordered w-full" required>
            </div>

            <div>
              <label class="label"><span class="label-text">Email</span></label>
              <input type="email" name="email"
                class="input input-bordered w-full"
                value="<?php echo htmlspecialchars($_SESSION['email']); ?>"
                required>
            </div>

            <div>
              <label class="label"><span class="label-text">Adresa livrare</span></label>
              <textarea name="address" class="textarea textarea-bordered w-full h-32" required></textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <div>
                <label class="label"><span class="label-text">Oras</span></label>
                <input type="text" name="city" class="input input-bordered w-full" required>
              </div>
              <div>
                <label class="label"><span class="label-text">Cod postal</span></label>
                <input type="text" name="postal_code" class="input input-bordered w-full" required>
              </div>
            </div>

            <div>
              <label class="label"><span class="label-text">Metoda plata</span></label>
              <div class="space-y-3 mt-2">
                <label class="flex items-center gap-3 cursor-pointer">
                  <input type="radio" name="payment" value="card" class="radio radio-primary" checked>
                  <span>Plata cu cardul</span>
                </label>
                <label class="flex items-center gap-3 cursor-pointer">
                  <input type="radio" name="payment" value="cash" class="radio radio-primary">
                  <span>Plata ramburs</span>
                </label>
              </div>
            </div>

            <button type="submit" class="btn btn-primary w-full">
              Plaseaza comanda
            </button>

          </form>
        </div>


        <div class="bg-base-200 p-6 sm:p-8 rounded-lg shadow-lg w-full lg:w-1/4 h-fit">

          <h2 class="text-2xl font-semibold mb-6">
            Sumar Comanda
          </h2>

          <div class="space-y-4">
            <?php foreach ($items as $item): ?>
              <div class="flex justify-between gap-2">
                <div class="min-w-0">
                  <h3 class="font-semibold text-sm line-clamp-2">
                    <?php echo htmlspecialchars($item['product_name']); ?>
                  </h3>
                  <p class="text-sm text-base-content/70">
                    Cantitate: <?php echo $item['quantity']; ?>
                  </p>
                </div>
                <span class="font-bold text-sm shrink-0">
                  <?php echo number_format($item['subtotal'], 2); ?> RON
                </span>
              </div>
            <?php endforeach; ?>
          </div>

          <div class="divider"></div>

          <div class="space-y-2 text-sm">
            <div class="flex justify-between">
              <span>Subtotal</span>
              <span><?php echo number_format($subtotal, 2); ?> RON</span>
            </div>
            <div class="flex justify-between">
              <span>Transport</span>
              <span><?php echo number_format($shipping, 2); ?> RON</span>
            </div>
            <div class="flex justify-between text-lg font-bold pt-2">
              <span>Total</span>
              <span><?php echo number_format($total, 2); ?> RON</span>
            </div>
          </div>

        </div>

      </div>

    </div>

  </main>

</body>
</html>
