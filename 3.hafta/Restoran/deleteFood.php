<?php  
session_start();  
include "functions/func.php";   

if (isset($_GET["id"])) {  
    $foodId = $_GET["id"];
    softDeleteFoodById($foodId);  
    header("Location: companyFood.php?message=Yemek başarıyla silindi."); 
    exit;  
} else {  
    header("Location: companyFood.php?message=Yemek silinemedi."); 
    exit;  
}  
?>