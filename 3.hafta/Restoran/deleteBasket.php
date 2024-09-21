<?php  
session_start();  
include "functions/func.php";   

if (isset($_GET["id"])) {  
    $basketId = $_GET["id"];
    deleteFromBasket($basketId);  
    header("Location: basket.php?message=Yemek başarıyla silindi."); 
    exit;  
} else {  
    header("Location: basket.php?message=Yemek silinemedi."); 
    exit;  
}  
?>