<?php
session_start();
require_once "db-connect.php"; 


if(!isset($_SESSION['email'])) {
    header("Location: ../index.php?error=notLoggedIn");
    exit();
}

if(isset($_POST['submit'])) {
    $family_name = $_POST['familyname'];
    $first_name = $_POST['firstname'];
    $phone = $_POST['phone'];
    $user_id = $_SESSION['id'];

    if(empty($family_name) || empty($first_name) || empty($phone)) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }

    $sql = "SELECT * FROM giveaway WHERE id=?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../formular.php?error=stmt_error");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $user_id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0) {
        header("location: ../formular.php?error=alreadySignedIn");
        exit();
    }

    $sql = "INSERT INTO giveaway (family_name, first_name, phone, user_id) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../formular.php?error=stmt_error");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sssi", $family_name, $first_name, $phone, $user_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../formular.php?error=none");
    exit();
}

?>