<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
include "functions/func.php";
include "functions/db.php";

if (!isset($_POST['username']) || !isset($_POST['password'])) {
    header("Location: login.php?message=Kullanıcı adı ve şifre boş bırakılamaz!");
    exit();
} else {
    $user = $_POST['username'];
    $password = $_POST['password'];

    $result = Login($user, $password);

    if ($result !== false) {
        $_SESSION["id"] = $result["id"];
        $_SESSION["name"] = $result["name"];
        $_SESSION["surname"] = $result["surname"];
        $_SESSION["username"] = $result["username"];
        $_SESSION["role"] = $result["role"];
        $_SESSION["balance"] = $result["balance"];
        $_SESSION["company_id"] = $result["company_id"];

        header("Location: index.php");
        exit();
    } else {
        header("Location: login.php?message=Kullanıcı adı veya şifre hatalı!");
        exit();
    }
}
?>