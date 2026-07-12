<!DOCTYPE html>
<html lang="en">
<?php
include_once './PHP-Functions/functions.php';
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comanda Plasata</title>
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
    $orderId = isset($_GET['orderId']) ? (int)$_GET['orderId'] : 0;
  ?>

  <main class="px-4 sm:px-6 py-16 flex justify-center items-center">
    <div class="max-w-lg mx-auto bg-base-200 rounded-xl shadow-lg text-center py-4 px-4">

      <div class="flex justify-center mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" width="72" height="72" viewBox="0 0 24 24"
             fill="none" stroke="currentColor" stroke-width="1.5"
             stroke-linecap="round" stroke-linejoin="round" class="text-success">
          <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
          <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0"/>
          <path d="M9 12l2 2l4 -4"/>
        </svg>
      </div>

      <h1 class="text-3xl font-bold mb-3">Comanda plasata cu succes!</h1>

      <?php if ($orderId > 0): ?>
        <p class="text-base-content/70 mb-2">Numarul comenzii tale este:</p>
        <p class="text-2xl font-bold text-primary mb-6">#<?php echo $orderId; ?></p>
      <?php endif; ?>

      <p class="text-base-content/60 mb-8">
        Iti multumim pentru comanda! Vei primi o confirmare pe email in scurt timp.
      </p>

      <div class="flex flex-col sm:flex-row justify-center gap-4">
        <a href="./store.php" class="btn btn-primary">
          Continua cumparaturile
        </a>
        <a href="./index.php" class="btn btn-secondary">
          Acasa
        </a>
      </div>

    </div>
  </main>

</body>
</html>
