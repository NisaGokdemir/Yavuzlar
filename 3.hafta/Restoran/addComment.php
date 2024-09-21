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

if (isset($_POST['userId']) && isset($_POST['restaurantId']) && isset($_POST['surname']) && isset($_POST['commentTitle']) && isset($_POST['userComment']) && isset($_POST['scoreSelect'])) {
    $userId = $_POST['userId'];  
    $restaurantId = $_POST['restaurantId'];   
    $surname = $_POST['surname'];
    $commentTitle = $_POST['commentTitle'];
    $userComment = $_POST['userComment'];
    $score = $_POST['scoreSelect'];
    addComment($userId, $restaurantId, $surname, $commentTitle, $userComment, $score);   
    header("Location: index.php?message=Yorum başarılı bir şekilde eklendi!");  
    exit;  
} else {  
    header("Location: index.php?message=Tüm alanları doldurmalısınız!");  
    exit;  
}  
 
?> 