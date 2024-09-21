<?php  
session_start();  
include "functions/func.php";   

if (isset($_GET["id"])) {  
    $questionId = $_GET["id"];
    deleteQuestion($questionId);  
    header("Location: questList.php?message=Soru başarıyla silindi."); 
    exit;  
} else {  
    header("Location: questList.php?message=Soru silinemedi."); 
    exit;  
}  
?>