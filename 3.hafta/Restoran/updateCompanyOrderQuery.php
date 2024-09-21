<?php  
   error_reporting(E_ALL);
   ini_set('display_errors', 1);

   session_start();
   include "functions/func.php";
   if (!$_SESSION['role'] == 'company') {
       header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");
       die();
   }
   if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
   header("Location: login.php?message=Giriş yapmadınız!");
   }  

if (isset($_POST['id']) && isset($_POST['statusSelect'])) {  
    $id = $_POST['id']; 
    $statusSelect = $_POST['statusSelect'];
    updateOrderStatus($id, $statusSelect);   
    header("Location: companyOrder.php?message=Durum başarılı bir şekilde güncellendi!");  
    exit;  
} else {  
    header("Location: companyOrder.php?message=Tüm alanları doldurmalısınız!");  
    exit;  
}   
?>