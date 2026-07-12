<!DOCTYPE html>
<html lang="en">

<head>
<?php require "./PHP-Functions/live-server.php"?>
<?php require "./PHP-Functions/functions.php"?>
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
  <main>
    <div class="main-container px-6 w-3/4  min-h-[calc(100vh-72px)] lg:flex justify-center items-center gap-12 mx-auto">

                <div class="card lg:w-2/5 bg-base-200 rounded-xl mt-6">
                     <figure><img class="w-full" src="./Resources/pexels-kevin-malik-8762311.jpg" alt="headphone" /></figure>
                    <div class="form-container p-6">
                        <h1 class="text-2xl font-semibold mb-6">Inscrieti-va la tragerea la sorti pentru sansa de a castiga 10.000 lei!</h1>
                        <form class="form space-y-4" action="./PHP-Functions/formular-logic.php" method="post">
                                <label for="familyname">Nume de familie:</label><input class="input" placeholder="Nume de familie" name="familyname" type="text">
                                <label for="firstname">Prenume:</label><input class="input" placeholder="Prenume" name="firstname" type="text">
                                <label for="phone">Nr de telefon:</label><input class="input" placeholder="Nr de telefon" name="phone" type="text">
                                <button class="btn btn-primary" type="submit" name="submit">Inscrie-te</button>
                        </form>
                    </div>
                </div>
                <div class="signups lg:w-2/5 bg-base-200 p-6 rounded-xl my-6">
                    <h1 class="text-2xl" >Numarul participantilor inscrisi:</h1>
                    <div class="w-full">
                        <h3 class="text-6xl font-bold text-center p-6" ><?php echo getCount(); ?></h3>
                    </div>
                    <div class="badges flex justify-between">
                        <h1 class="badge badge-secondary badge-soft text-md p-2">Data Extrageri:03-03-2025</h1>
                        <h1 class="badge badge-error badge-soft text-md p-2">18+</h1>
                    </div>
                </div>
                        </div>
  </main>
</body>
</html>