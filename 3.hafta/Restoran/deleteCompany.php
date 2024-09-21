<?php  
session_start();  
include "functions/func.php";   

if (isset($_GET["id"])) {  
    $companyId = $_GET["id"];
    deleteCompanyById($companyId);  
    header("Location: company.php?message=Firma başarıyla silindi."); 
    exit;  
} else {  
    header("Location: company.php?message=Firma silinemedi."); 
    exit;  
}  
?>