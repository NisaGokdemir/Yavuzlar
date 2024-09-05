<?php  
session_start();  
include "functions/func.php";   

if (isset($_GET["id"])) {  
    $userId = $_GET["id"];
    deleteUser($userId);  
    header("Location: userList.php?message=Kullanıcı başarıyla silindi."); 
    exit;  
} else {  
    header("Location: userList.php?message=Kullancı silinemedi."); 
    exit;  
}  
?>