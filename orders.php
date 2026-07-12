<!DOCTYPE html>
<html lang="en">
<?php
include_once './PHP-Functions/functions.php';
include_once './PHP-Functions/db-connect.php';
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comenzile Mele</title>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
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
    $userId = (int)$_SESSION['id'];


    $sql  = "SELECT orderId, totalAmount, createdAt FROM orders WHERE userId = ? ORDER BY createdAt DESC";
    $stmt = mysqli_stmt_init($conn);
    mysqli_stmt_prepare($stmt, $sql);
    mysqli_stmt_bind_param($stmt, "i", $userId);
    mysqli_stmt_execute($stmt);
    $ordersResult = mysqli_stmt_get_result($stmt);
    $orders = [];
    while ($row = mysqli_fetch_assoc($ordersResult)) {
        $orders[] = $row;
    }
    mysqli_stmt_close($stmt);


    $orderItems = [];
    if (!empty($orders)) {
        $sql  = "SELECT oi.orderId, oi.quantity, oi.price, p.product_name, p.photo
                 FROM order_item oi
                 JOIN products p ON oi.productId = p.id
                 WHERE oi.orderId = ?";
        $stmt = mysqli_stmt_init($conn);
        mysqli_stmt_prepare($stmt, $sql);
        foreach ($orders as $order) {
            $oid = $order['orderId'];
            mysqli_stmt_bind_param($stmt, "i", $oid);
            mysqli_stmt_execute($stmt);
            $res = mysqli_stmt_get_result($stmt);
            $orderItems[$oid] = [];
            while ($item = mysqli_fetch_assoc($res)) {
                $orderItems[$oid][] = $item;
            }
        }
        mysqli_stmt_close($stmt);
    }
  ?>

  <main class="px-4 sm:px-6 py-8">
    <div class="container w-full lg:w-3/4 mx-auto">

      <h1 class="text-2xl sm:text-3xl font-semibold mb-8 flex items-center gap-2">
        <span class="icon-[tabler--package] size-7"></span>
        Comenzile Mele
      </h1>

      <?php if (empty($orders)): ?>
        <div class="bg-base-200 rounded-xl shadow p-16 flex flex-col items-center gap-4 text-base-content/60">
          <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24"
               fill="none" stroke="currentColor" stroke-width="1.5"
               stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M12 3l8 4.5v9l-8 4.5l-8 -4.5v-9l8 -4.5"/>
            <path d="M12 12l8 -4.5"/>
            <path d="M12 12v9"/>
            <path d="M12 12l-8 -4.5"/>
          </svg>
          <p class="text-xl font-semibold">Nu ai plasат nicio comanda inca</p>
          <a href="./store.php" class="btn btn-primary mt-2">Mergi la magazin</a>
        </div>

      <?php else: ?>

        <div class="space-y-6">
          <?php foreach ($orders as $order):
            $oid   = $order['orderId'];
            $items = $orderItems[$oid] ?? [];
            $date  = date('d.m.Y H:i', strtotime($order['createdAt']));
            $totalItems = array_sum(array_column($items, 'quantity'));
          ?>

    
            <div class="bg-base-200 rounded-xl shadow-md overflow-hidden">

   
              <button
                class="w-full text-left py-4 px-4 flex flex-col sm:flex-row sm:items-center justify-between gap-3 hover:bg-base-300 transition-colors"
                onclick="toggleOrder(<?php echo $oid; ?>)"
              >
                <div class="flex flex-col sm:flex-row sm:items-center gap-3 sm:gap-6">
                  <div class="flex items-center gap-2">
                    <span class="font-bold text-lg">Comanda #<?php echo $oid; ?></span>
                  </div>
                  <span class="badge badge-primary badge-outline">
                    <?php echo $totalItems; ?> <?php echo $totalItems === 1 ? 'produs' : 'produse'; ?>
                  </span>
                  <span class="text-base-content/60 text-sm"><?php echo $date; ?></span>
                </div>

                <div class="flex items-center gap-4">
                  <span class="font-bold text-lg text-primary">
                    <?php echo number_format($order['totalAmount'], 2); ?> RON
                  </span>
                  <span class="icon-[tabler--chevron-down] size-5 transition-transform" id="chevron-<?php echo $oid; ?>"></span>
                </div>
              </button>

   
              <div id="order-<?php echo $oid; ?>" class="hidden border-t border-base-300">
                <div class="p-5 sm:p-6 space-y-3">
                  <?php foreach ($items as $item): ?>
                    <div class="flex items-center gap-4 bg-base-100 rounded-lg p-4">
                      <?php if (!empty($item['photo'])): ?>
                        <img width="64" height="64"
                          src="<?php echo htmlspecialchars($item['photo']); ?>"
                          alt="<?php echo htmlspecialchars($item['product_name']); ?>"
                          class="object-cover rounded-md shrink-0"
                        >
                      <?php endif; ?>
                      <div class="flex-1 min-w-0">
                        <p class="font-semibold text-sm line-clamp-2">
                          <?php echo htmlspecialchars($item['product_name']); ?>
                        </p>
                        <p class="text-base-content/60 text-sm mt-0.5">
                          <?php echo $item['quantity']; ?> &times;
                          <?php echo number_format($item['price'], 2); ?> RON
                        </p>
                      </div>
                      <span class="font-bold text-sm shrink-0">
                        <?php echo number_format($item['price'] * $item['quantity'], 2); ?> RON
                      </span>
                    </div>
                  <?php endforeach; ?>

 
                  <div class="flex flex-col items-end gap-1 px-4 py-4 border-t border-base-300 text-sm">
                    <div class="flex justify-between w-48">
                      <span class="text-base-content/60">Subtotal</span>
                      <span><?php echo number_format($order['totalAmount'] - 20, 2); ?> RON</span>
                    </div>
                    <div class="flex justify-between w-48">
                      <span class="text-base-content/60">Transport</span>
                      <span>20.00 RON</span>
                    </div>
                    <div class="flex justify-between w-48 font-bold text-base pt-1">
                      <span>Total</span>
                      <span class="text-primary"><?php echo number_format($order['totalAmount'], 2); ?> RON</span>
                    </div>
                  </div>
                </div>
              </div>

            </div>

          <?php endforeach; ?>
        </div>

      <?php endif; ?>

    </div>
  </main>

  <script>
    function toggleOrder(id) {
      const panel   = document.getElementById('order-' + id);
      const chevron = document.getElementById('chevron-' + id);
      const isOpen  = !panel.classList.contains('hidden');
      panel.classList.toggle('hidden', isOpen);
      chevron.style.transform = isOpen ? '' : 'rotate(180deg)';
    }
  </script>

</body>
</html>
