
<!DOCTYPE html>
<html lang="en">

<head>
   <?php require "./PHP-Functions/live-server.php"?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elixirul Tineretii</title>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="dist/assets/main.css">
  <script src="dist/assets/main.js"></script>
</head>

<body data-theme="elixirul-tineretii">
  <?php include "./Resources/nav-component.php"?>
  <?php include "./PHP-Functions/products.php"?>
  <h1 class="w-full flex justify-center py-12 text-5xl font-bold text-center">Produsule noastre:</h1>
  <main class="w-full flex justify-center py-12 px-6">

            <div class="card-container md:w-3/4 w-4/4">
                <?php
                renderProductsFromDB()
                ?>
            </div>
  </main>
  <footer class="footer bg-base-200 px-6 py-4">
    <div class="flex flex-wrap items-center justify-between w-3/4 mx-auto">
      <div class="flex items-center gap-2 text-xl font-bold text-base-content">
        <span class="icon-[tabler--spray] size-5"></span>
        <span>ElixirulTineretii</span>
      </div>
      <aside class="grid-flow-col items-center">
        <p> ©2025 <a class="link link-hover font-medium" href="#">ElixirulTineretii</a> </p>
      </aside>
      <div class="flex h-5 gap-4">
        <a href="https://github.com/George-Irinel-Necula" class="link" aria-label="Github Link">
          <span class="icon-[tabler--brand-github] size-5"></span>
        </a>
        <a href="#" class="link" aria-label="Facebook Link">
          <span class="icon-[tabler--brand-facebook] size-5"></span>
        </a>
        <a href="#" class="link" aria-label="X Link">
          <span class="icon-[tabler--brand-x] size-5"></span>
        </a>
        <a href="#" class="link" aria-label="Google Link">
          <span class="icon-[tabler--brand-google] size-5"></span>
        </a>
      </div>
    </div>
  </footer>
</body>
</html>