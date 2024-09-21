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


if (isset($_POST['foodId']) && isset($_POST['note']) && isset($_POST['quantity'])) {
    $userId = $_SESSION['id'];
    $foodId = $_POST['foodId'];
    $note = $_POST['note'];
    $quantity = $_POST['quantity'];
    addToBasket($userId, $foodId, $note, $quantity);
    header("Location: index.php?message=Sepete başarılı bir şekilde eklendi!");  
    exit;  
} else {  
    header("Location: index.php?message=Tüm alanları doldurmalısınız!");  
    exit;  
}  
 
?> 