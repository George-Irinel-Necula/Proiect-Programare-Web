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
  <title>Cos de Cumparaturi</title>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="dist/assets/main-CJxdbvAm.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./src/index.css">
  <link rel="stylesheet" href="./src/theme.css">
  <link rel="stylesheet" href="dist/assets/main.css">
  <script src="dist/assets/main.js"></script>
</head>

<body data-theme="elixirul-tineretii">

  <?php include "./Resources/nav-component.php" ?>
  <?php checkUserLoggedIn() ?>

  <?php
    $userId  = (int)$_SESSION['id'];
    $cartId  = getOrCreateCart($conn, $userId);
    $items   = getCartItems($conn, $cartId);

    $subtotal = array_sum(array_column($items, 'subtotal'));
    $shipping = count($items) > 0 ? 20.00 : 0.00;
    $total    = $subtotal + $shipping;
    $itemCount = array_sum(array_column($items, 'quantity'));
  ?>

  <main class="px-4 sm:px-6 py-8">

    <div class="container bg-base-200 w-full lg:w-3/4 mx-auto p-4 sm:p-8 rounded-lg shadow-lg">

      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <h1 class="text-2xl sm:text-3xl font-semibold flex items-center gap-2">
          <svg class="icon-[tabler--garden-cart] size-7"></svg>
          Cosul Meu
        </h1>
        <span class="badge badge-primary badge-lg self-start sm:self-auto">
          <?php echo $itemCount; ?> Produse
        </span>
      </div>

      <?php if (isset($_GET['added'])): ?>
        <div class="alert alert-success mb-4">
          <svg class="icon-[tabler--circle-check] size-5"></svg>
          <span>Produsul a fost adaugat in cos!</span>
        </div>
      <?php endif; ?>

      <?php if (isset($_GET['error']) && $_GET['error'] === 'empty'): ?>
        <div class="alert alert-warning mb-4">
          <svg class="icon-[tabler--alert-circle] size-5"></svg>
          <span>Cosul tau este gol. Adauga produse inainte de a plasa comanda.</span>
        </div>
      <?php endif; ?>

      <?php if (empty($items)): ?>
        <div class="flex flex-col items-center justify-center py-16 gap-4 text-base-content/60">
          <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none"
               stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
            <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0"/>
            <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2 -1.61l1.6 -8.39h-16.32"/>
          </svg>
          <p class="text-xl font-semibold">Cosul tau este gol</p>
          <a href="./store.php" class="btn btn-primary">Mergi la magazin</a>
        </div>
      <?php else: ?>

        <?php foreach ($items as $item): ?>
          <div class="bg-base-100 rounded-lg p-4 flex flex-col sm:flex-row sm:items-center justify-between gap-4 mb-4 shadow">

            <div class="flex items-center gap-4">
              <?php if (!empty($item['photo'])): ?>
                <img width="64" height="64" src="<?php echo htmlspecialchars($item['photo']); ?>"
                     alt="<?php echo htmlspecialchars($item['product_name']); ?>"
                     class="object-cover rounded-md shrink-0">
              <?php endif; ?>
              <div>
                <h2 class="text-base sm:text-lg font-semibold line-clamp-2">
                  <?php echo htmlspecialchars($item['product_name']); ?>
                </h2>
                <p class="text-lg font-bold mt-1">
                  <?php echo number_format($item['price'], 2); ?> RON
                </p>
              </div>
            </div>

            <div class="flex items-center justify-between sm:justify-end gap-4 w-full sm:w-auto">

              <!-- Quantity update form -->
              <form action="./PHP-Functions/update-cart-item.php" method="POST" class="flex items-center gap-2">
                <input type="hidden" name="cartItemId" value="<?php echo $item['cartItemId']; ?>">
                <input
                  type="number"
                  name="quantity"
                  value="<?php echo $item['quantity']; ?>"
                  min="1"
                  max="99"
                  class="input input-sm w-20 text-center"
                  onchange="this.form.submit()"
                >
              </form>

              <span class="font-semibold text-sm text-base-content/70 min-w-[70px] text-right">
                = <?php echo number_format($item['subtotal'], 2); ?> RON
              </span>

              <!-- Remove form -->
              <form action="./PHP-Functions/remove-cart-item.php" method="POST">
                <input type="hidden" name="cartItemId" value="<?php echo $item['cartItemId']; ?>">
                <button type="submit" class="btn btn-primary btn-sm sm:btn-md" title="Sterge">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                       fill="none" stroke="currentColor" stroke-width="2"
                       stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                    <path d="M4 7l16 0"/>
                    <path d="M10 11l0 6"/>
                    <path d="M14 11l0 6"/>
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12"/>
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3"/>
                  </svg>
                </button>
              </form>

            </div>

          </div>
        <?php endforeach; ?>

        <div class="divider"></div>

        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mt-6">

          <div class="w-full lg:w-auto">
            <p class="text-lg flex justify-between gap-6">
              <span>Subtotal:</span>
              <span class="font-bold"><?php echo number_format($subtotal, 2); ?> RON</span>
            </p>
            <p class="text-lg flex justify-between gap-6">
              <span>Transport:</span>
              <span class="font-bold"><?php echo number_format($shipping, 2); ?> RON</span>
            </p>
            <p class="text-2xl font-bold mt-2 flex justify-between gap-6">
              <span>Total:</span>
              <span><?php echo number_format($total, 2); ?> RON</span>
            </p>
          </div>

          <div class="flex flex-col sm:flex-row w-full lg:w-auto gap-4">

            <a href="./store.php" class="btn btn-outline btn-secondary w-full sm:w-auto">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                   fill="none" stroke="currentColor" stroke-width="2"
                   stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M5 12l14 0"/>
                <path d="M5 12l4 4"/>
                <path d="M5 12l4 -4"/>
              </svg>
              Continua cumparaturile
            </a>

            <a href="./order.php" class="btn btn-primary w-full sm:w-auto">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                   fill="none" stroke="currentColor" stroke-width="2"
                   stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <path d="M12 19h-6a3 3 0 0 1 -3 -3v-8a3 3 0 0 1 3 -3h12a3 3 0 0 1 3 3v4.5"/>
                <path d="M3 10h18"/>
                <path d="M16 19h6"/>
                <path d="M19 16l3 3l-3 3"/>
                <path d="M7.005 15h.005"/>
                <path d="M11 15h2"/>
              </svg>
              Finalizeaza comanda
            </a>

          </div>

        </div>

      <?php endif; ?>

    </div>

  </main>

</body>
</html>
