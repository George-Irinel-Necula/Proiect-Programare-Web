<!DOCTYPE html>
<html lang="en">
<?php 
include_once './PHP-Functions/functions.php';
?>
<head>
  <?php require "./PHP-Functions/live-server.php" ?>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Elixirul Tineretii</title>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="./index.css">
  <link rel="stylesheet" href="./theme.css">
    <link rel="stylesheet" href="dist/assets/main.css">
  <script src="dist/assets/main.js"></script>
</head>

<body data-theme="elixirul-tineretii">
  <?php include "./Resources/nav-component.php"?>
  <?php checkUserLoggedIn()?>
  <main class="px-6">
    <div class="container bg-base-200 w-3/4 mx-auto mt-12 p-8 rounded-lg shadow-lg">
      <h1 class="text-3xl font-semibold mb-2"><span class="icon-[tabler--user] size-6 mr-2"></span>Profil</h1>
      <form class="space-y-4 mt-4" action="./PHP-Functions/edit-profile.php" method="POST">
        <label for="email">Email:</label><input type="email" name="email" id="email" placeholder="Email" <?php echo 'value="' . $_SESSION["email"] . '"';?> class="input">
        <label for="username">Username:</label><input type="text" name="username" id="nume" placeholder="Nume" <?php echo 'value="' . $_SESSION["username"] . '"';?> class="input">
        <button type="submit" name="submit" class="btn btn-primary"><span class="icon-[tabler--reload] size-6"></span>Actualizeaza</button>
      </form>

    </div>
    <div class="container bg-base-200 w-3/4 mx-auto mt-8 p-8 rounded-lg shadow-lg">
      <h1 class="text-3xl font-semibold mb-2"><span class="icon-[tabler--key] size-6 mr-2"></span>Parola</h1>

      <form class="space-y-4 mt-4" action="./PHP-Functions/edit-profile.php" method="POST">
        <label for="password">Parola:</label><input type="password" name="password" id="password" placeholder="New password" class="input">
        <button type="submit" name="submit2" class="btn btn-primary"><span class="icon-[tabler--reload] size-6"></span>Actualizeaza</button>
      </form>
    </div>
  </main>
  <script type="module" src="/main.js"></script>
</body>

</html>