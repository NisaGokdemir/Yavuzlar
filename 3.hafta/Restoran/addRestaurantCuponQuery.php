<?php  
session_start();  
include "functions/func.php";  
if (!$_SESSION['role'] == 'company') {
    header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");
    die();
}
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
header("Location: login.php?message=Giriş yapmadınız!");
}  


if (isset($_POST['restaurantId']) && isset($_POST['cuponId'])) {
    $restaurantId = $_POST['restaurantId'];  
    $cuponId = $_POST['cuponId'];   
    updateCuponRestaurantById($cuponId, $restaurantId);   
    header("Location: companyFood.php?message=Kupon başarılı bir şekilde eklendi!");  
    exit;  
} else {  
    header("Location: companyFood.php?message=Tüm alanları doldurmalısınız!");  
    exit;  
}  
 
?> 