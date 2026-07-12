<!DOCTYPE html>
<html lang="en">

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
  <div class="soft-light">
  </div>
  <nav class="navbar w-full shadow-base-100/50 shadow-sm px-6 backdrop-blur-sm">
    <div class="flex w-full justify-between mx-auto">
      <div class="flex flex-1 items-center gap-2 ">
        <svg class="icon-[tabler--spray] size-6"></svg>
        <a class="text-base-content text-2xl font-bold no-underline" href="./index.html">
          ElixirulTineretii
        </a>
        <div class="divider divider-horizontal px-2 hidden md:flex"></div>
        <h1 class="text-xl font-bold hidden md:inline">Chestionar</h1>
      </div>

    </div>
  </nav>
  <main class="px-6">
    <div class="container bg-base-200 w-3/4 mx-auto mt-8 p-6 rounded-lg shadow-lg">
      <h1 class="text-3xl font-semibold">Intrebare</h1>
      <div class="questions mt-4">
        <div class="flex items-center gap-1 mb-2">
          <input type="radio" name="radio-0" class="radio radio-primary" id="defaultRadio1" />
          <label class="label-text text-xl" for="defaultRadio1"> Default </label>
        </div>
        <div class="flex items-center gap-1 mb-2">
          <input type="radio" name="radio-0" class="radio radio-primary" id="defaultRadio1" />
          <label class="label-text text-xl" for="defaultRadio1"> Default </label>
        </div>
        <div class="flex items-center gap-1 mb-2">
          <input type="radio" name="radio-0" class="radio radio-primary" id="defaultRadio1" />
          <label class="label-text text-xl" for="defaultRadio1"> Default </label>
        </div>
        <div class="flex items-center gap-1 mb-2">
          <input type="radio" name="radio-0" class="radio radio-primary" id="defaultRadio1" />
          <label class="label-text text-xl" for="defaultRadio1"> Default </label>
        </div>
      </div>
    </div>
  </main>
  <script type="module" src="./main.js"></script>
</body>

</html>