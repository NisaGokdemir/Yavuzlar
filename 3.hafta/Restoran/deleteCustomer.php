<?php  
session_start();  
include "functions/func.php";   

if (isset($_GET["id"])) {  
    $customerId = $_GET["id"];
    softDeleteCustomer($customerId);  
    header("Location: customer.php?message=Kullanıcı başarıyla silindi."); 
    exit;  
} else {  
    header("Location: customer.php?message=Kullancı silinemedi."); 
    exit;  
}  
?>