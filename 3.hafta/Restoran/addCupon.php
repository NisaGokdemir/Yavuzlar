<?php  
session_start();  
include "functions/func.php";  
if (!$_SESSION['role'] == 'admin') {
    header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");
    die();
}
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
header("Location: login.php?message=Giriş yapmadınız!");
}  

if (isset($_POST['cuponName']) && isset($_POST['cuponDiscount'])) {
    $cuponName = $_POST['cuponName'];  
    $cuponDiscount = $_POST['cuponDiscount'];   
    addCupon($cuponName, $cuponDiscount);   
    header("Location: cupon.php?message=Kupon başarılı bir şekilde eklendi!");  
    exit;  
} else {  
    header("Location: cupon.php?message=Tüm alanları doldurmalısınız!");  
    exit;  
}  
 
?> 