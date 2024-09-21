<?php  
session_start();  
include "functions/func.php";  

if (!$_SESSION['isAdmin']) {  
    header("Location: home.php?message=Bu sayfayı görüntüleme izniniz yok!");  
    die();  
}  
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {  
    header("Location: login.php?message=Giriş yapmadınız!");  
    die();  
}  

if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['nickname']) && isset($_POST['email']) && isset($_POST['passwd']) && isset($_POST['rol'])) {  
    $name = $_POST['name'];  
    $surname = $_POST['surname'];  
    $nickname = $_POST['nickname'];  
    $email = $_POST['email'];    
    $password = $_POST['passwd'];  
    $role = $_POST['rol'];  
    $isAdmin = ($role === 'admin') ? 1 : 0;  
    AddUser($name, $surname, $nickname, $email, $password, $isAdmin);   
    header("Location: userList.php?message=Kullanıcı başarılı bir şekilde eklendi!");  
    exit;  
} else {  
    header("Location: addUser.php?message=Tüm alanları doldurmalısınız!");  
    exit;  
}   
?>