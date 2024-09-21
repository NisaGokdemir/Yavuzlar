<?php  
session_start();  
include "functions/func.php";   

if (isset($_GET["id"])) {  
    $cuponId = $_GET["id"];
    softDeleteCupon($cuponId);  
    header("Location: cupon.php?message=Kupon başarıyla silindi."); 
    exit;  
} else {  
    header("Location: cupon.php?message=Kupon silinemedi."); 
    exit;  
}  
?>