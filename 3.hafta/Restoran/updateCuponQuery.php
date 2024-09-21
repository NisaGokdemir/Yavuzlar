<?php  
   error_reporting(E_ALL);
   ini_set('display_errors', 1);

   session_start();
   include "functions/func.php";
   if (!$_SESSION['role'] == 'admin') {
       header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");
       die();
   }
   if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
   header("Location: login.php?message=Giriş yapmadınız!");
   }  

if (isset($_POST['id']) && isset($_POST['cuponName']) && isset($_POST['cuponDiscount'])) {  
    $id = $_POST['id']; 
    $cuponName = $_POST['cuponName'];
    $cuponDiscount = $_POST['cuponDiscount'];
    updateCupon($id, $cuponName, $cuponDiscount);   
    header("Location: cupon.php?message=Kupon başarılı bir şekilde güncellendi!");  
    exit;  
} else {  
    header("Location: cupon.php?message=Tüm alanları doldurmalısınız!");  
    exit;  
}   
?>