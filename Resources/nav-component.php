<?php 
$currentPage = basename($_SERVER['PHP_SELF']);
$pageName = substr($currentPage, 0, -4);
session_start();
?>
<div class="soft-light"></div>
<nav class="navbar w-full shadow-base-100/50 shadow-sm px-6 <?php if($pageName=="index") echo "fixed"; ?> backdrop-blur-sm z-2">
  <div class="flex w-full md:w-3/4 justify-between mx-auto ">
    <div class="flex flex-1 items-center gap-2 ">
      <svg class="icon-[tabler--spray] size-6 hidden sm:flex"></svg>
      <a class="text-base-content text-2xl font-bold no-underline" href="./index.php">ElixirulTineretii</a>
      
      <?php
      if($pageName != "index"){
        echo '<div class="divider divider-horizontal px-2 hidden md:flex"></div>
        <h1 class="text-xl font-bold hidden md:inline">' . ucfirst($pageName) . '</h1>';
      }
      ?>
    </div>
    <div class="navbar-end flex items-center gap-4">
      <div class="dropdown relative hidden md:inline-flex">
          <button id="dropdown-default" type="button" class="dropdown-toggle btn btn-primary btn-outline" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
            <span class="icon-[tabler--droplet] size-6 rtl:rotate-180"></span>
            <h1>Teme</h1>
            <span class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4"></span>
          </button>
          <ul class="dropdown-menu theme-selector dropdown-open:opacity-100 hidden min-w-60" role="menu" aria-orientation="vertical" aria-labelledby="scope-dropdown-nested">
            <li><a class="dropdown-item" id="elixirul-tineretii" href="#"><span class="icon-[tabler--moon] size-6"></span>Dark Mode</a></li>
            <li><a class="dropdown-item" id="elixirul-tineretii-light" href="#"><span class="icon-[tabler--sun] size-6"></span>Light Mode</a></li>
          </ul>
        </div>
      <?php
      if($pageName == "index" || $pageName == "store"|| $pageName == "cart"|| $pageName == "order"){
        echo '';

        if(!isset($_SESSION["email"])){
          echo '<a class="btn btn-primary hidden md:flex" href="./login.php">
            <svg class="icon-[tabler--login-2] size-6"></svg>
            <span class="hidden sm:inline">Logare</span>
          </a>';
          
        } else {
          echo '<div class="dropdown relative hidden md:inline-flex">
          <button id="dropdown-default" type="button" class="dropdown-toggle btn btn-primary" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
            <span class="icon-[tabler--user] size-6 rtl:rotate-180"></span>
            <h1>' . (string)$_SESSION["email"] .'</h1>
            <span class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4"></span>
          </button>
          <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-60" role="menu" aria-orientation="vertical" aria-labelledby="scope-dropdown-nested">
            <li><a class="dropdown-item" href="./profile.php"><span class="icon-[tabler--pencil] size-6"></span>Edit profile</a></li>
            <li><a class="dropdown-item" href="./orders.php"><span class="icon-[tabler--package] size-6"></span>Comenzile mele</a></li>
            <li><a class="dropdown-item" href="./formular.php"><span class="icon-[tabler--award] size-6"></span>Concurs</a></li>
            <div class="divider"></div>  
            <li><a class="dropdown-item bg-error w-full" href="./PHP-Functions/logout.php " id="logout"><span class="icon-[tabler--login] size-6"></span>Log Out</a></li>
          </ul>
        </div>
        <a class="btn btn-primary hidden md:flex" href="./cart.php">
            <svg class="icon-[tabler--garden-cart] size-6"></svg>
          </a>';
        }

        echo '<div class="dropdown relative inline-flex md:hidden">
          <button id="scope-dropdown" type="button" class="dropdown-toggle btn btn-primary" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
            <span class="hidden sm:inline">Meniu</span>
            <span class="icon-[tabler--chevron-down] dropdown-open:rotate-180 size-4"></span>
          </button>
          <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-60" role="menu" aria-orientation="vertical" aria-labelledby="scope-dropdown">';

          if(!isset($_SESSION["email"])){
            echo '<li><a class="dropdown-item" href="./login.php"><svg class="icon-[tabler--login-2] size-6"></svg><span>Logare</span></a></li>';}
          else{
            echo '<li class="dropdown relative flex items-center [--scope:window] [--offset:15] [--placement:bottom]">
              <button id="scope-dropdown-nested" class="dropdown-toggle dropdown-item" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <span class="icon-[tabler--user] size-6"></span>' . $_SESSION["email"] .'
                
                <span class="icon-[tabler--chevron-right] size-6 dropdown-open:rotate-90 ml-auto"></span>
              </button>
              <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-60" role="menu" aria-orientation="vertical" aria-labelledby="scope-dropdown-nested">
                <li><a class="dropdown-item" href="../profile.php"><span class="icon-[tabler--pencil] size-6"></span>Edit profile</a></li>
                 <li><a class="dropdown-item" href="./orders.php"><span class="icon-[tabler--package] size-6"></span>Comenzile mele</a></li>
                 <li><a class="dropdown-item" href="./formular.php"><span class="icon-[tabler--award] size-6"></span>Concurs</a></li>
                 <div class="divider"></div>  
            <li><a class="dropdown-item bg-error w-full" href="./PHP-Functions/logout.php" id="logout"><span class="icon-[tabler--login] size-6"></span>Log Out</a></li>
              </ul>
            </li>';
          }

          echo'
            <div class="divider"></div>
            <li class="dropdown relative flex items-center [--scope:window] [--offset:15] [--placement:bottom]">
              <button id="scope-dropdown-nested" class="dropdown-toggle dropdown-item" aria-haspopup="menu" aria-expanded="false" aria-label="Dropdown">
                <span class="icon-[tabler--droplet] size-6"></span>
                Teme
                <span class="icon-[tabler--chevron-right] size-6 dropdown-open:rotate-90 ml-auto"></span>
              </button>
              <ul class="dropdown-menu dropdown-open:opacity-100 hidden min-w-60 theme-selector-mobile" role="menu" aria-orientation="vertical" aria-labelledby="scope-dropdown-nested">
                <li><a class="dropdown-item" id="elixirul-tineretii" href="#"><span class="icon-[tabler--moon] size-6"></span>Dark Mode</a></li>
                <li><a class="dropdown-item" id="elixirul-tineretii-light" href="#"><span class="icon-[tabler--sun] size-6"></span>Light Mode</a></li>
              </ul>
            </li>
          </ul>
        </div>';
      }
      ?>
    </div>
  </div>
</nav>
