<?php  
session_start();  
include "functions/func.php";  
if (!$_SESSION['role'] == 'customer') {
    header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");
    die();
}
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
header("Location: login.php?message=Giriş yapmadınız!");
}  


if (isset($_POST['id']) && isset($_POST['newBalance'])) {
    $id = $_POST['id'];  
    $newBalance = $_POST['newBalance'];   
    updateUserBalance($id, $newBalance);   
    header("Location: userBalance.php?message=Bakiye başarılı bir şekilde eklendi!");  
    exit;  
} else {  
    header("Location: userBalance.php?message=Tüm alanları doldurmalısınız!");  
    exit;  
}  
 
?> 