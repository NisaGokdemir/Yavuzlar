<?php  
session_start();  
include "functions/func.php";  

if (!isset($_POST['username']) || !isset($_POST['password'])) {  
    header("Location: login.php?message=Kullanıcı adı ve şifre boş bırakılamaz!");  
    die();  
} else {  
    $username = $_POST['username'];  
    $password = $_POST['password'];  

    include "functions/db.php";  

    $result = Login($username, $password);  
    $rowCount = $result['count'];  

    if ($rowCount == 1) {  
        $userInfo = $result;  
        $_SESSION["id"] = $result["id"];  
        $_SESSION["isAdmin"] = $result["isAdmin"];  
        $_SESSION["username"] = $result["nickname"];  
        header("Location:home.php");  
        exit();  
    } else {  
        header("Location:login.php?message=Kullanıcı adı veya şifre hatalı!");  
        exit();  
    }  

    die();  
}  
?>