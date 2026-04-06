<?php

function isNotEmpty($email, $username, $password, $password_repeat)
{
    if (empty($email) || empty($username) || empty($password) || empty($password_repeat)) {
        return false;
    }
    return true;
}

function isNotEmptyLogIn($email, $password)
{
    if (empty($email) || empty($password)) {
        return false;
    }
    return true;
}

function passwordMatch($password, $password_repeat)
{
    if ($password == $password_repeat) {
        return true;
    } else
        return false;
}

function emailExists($conn,$email){
    $sql="SELECT * FROM users WHERE email = ?";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../register.php?error=stmt_error");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);
    if ($row) {
        return $row;
    } else {
        return false;
    }
}


function userNameExists($conn, $username){
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../formular.php?error=stmt_error");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    mysqli_stmt_close($stmt);

    if ($row) {
        return $row;
    } else {
        return false;
    }
}


function createUser($conn,$username,$email,$password,$password_repeat){
    $sql="INSERT INTO users (username,email,password) VALUES (?,?,?)";
    $stmt=mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header("location: ../register.php?error=stmt_error");
        exit();
    }

    $password_hash = password_hash($password, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $password_hash);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location: ../login.php?");
    exit();
}

function logInUser($conn,$email,$password){
    $emailExists = emailExists($conn,$email);

    if($emailExists==false){
        header("location: ../login.php?error=incorrectLogin");
        exit();
    }
    $hashedPassword=$emailExists["password"];
    $passwordVerify=password_verify($password,$hashedPassword);

    if ($passwordVerify == false) {
        header("location: ../login.php?error=incorrectLogin");
        exit();
    }else if($passwordVerify==true){
    session_start();
    $_SESSION["email"]=$emailExists["email"];
    $_SESSION["username"]=$emailExists["username"];
    $_SESSION["id"]=$emailExists["id"];
        header("location: ../index.php?login=success");
        exit();
    }
}


function updateUserInfo($conn, $newEmail, $newUsername) {
    session_start();
    $currentEmail = $_SESSION['email'];

    $sql = "UPDATE users SET email = ? , username = ? WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../profile.php?error=stmt_error");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "sss", $newEmail, $newUsername, $currentEmail);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    $_SESSION['username'] = $newUsername;
    $_SESSION['email'] = $newEmail;

    header("location: ../profile.php?error=none");
    exit();
}

function updateUserPassword($conn, $newPassword) {
    session_start();
    $email = $_SESSION['email'];
    
    $sql = "UPDATE users SET password = ? WHERE email = ?";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../profile.php?error=stmt_error");
        exit();
    }

    $hashedPassword=password_hash($newPassword,PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ss", $hashedPassword,$email);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("location: ../profile.php?error=none");
    exit();
}

function checkUserLoggedIn() {
    if (!isset($_SESSION["email"]) || empty($_SESSION["email"])) {
        header("location: ./index.php?error=notLoggedIn");
        exit();
    }
}

function getCount() {
    include_once __DIR__ . '/db-connect.php';
    $sql = "SELECT COUNT(*) as total FROM giveaway";
    $result = mysqli_query($conn, $sql);

    if($result) {
        $row = mysqli_fetch_assoc($result);
        return $row['total'];
    } else {
        return 0;
    }
}

?>
