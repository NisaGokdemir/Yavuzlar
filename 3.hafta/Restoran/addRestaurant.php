<?php  
session_start();  
include "functions/func.php";  
if (!$_SESSION['role'] == 'company') {
    header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");
    die();
}
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
header("Location: login.php?message=Giriş yapmadınız!");
}  

if (isset($_POST['restaurantName']) && isset($_POST['restaurantDesc']) && isset($_POST['companyId']) && isset($_FILES['restaurantLogo']) && $_FILES['restaurantLogo']['error'] === UPLOAD_ERR_OK) {
        $restaurantName = $_POST['restaurantName'];  
        $restaurantDesc = $_POST['restaurantDesc']; 
        $companyId = $_POST['companyId']; 
        $fileTmpPath = $_FILES['restaurantLogo']['tmp_name'];  
        //bunları eklemezsem hata alıyorum
        $fileName = $_FILES['restaurantLogo']['name'];  
        $fileSize = $_FILES['restaurantLogo']['size'];  
        $fileType = $_FILES['restaurantLogo']['type'];  
        
        $uploadFileDir = './uploads/';  
        $dest_path = $uploadFileDir . $fileName;  

        if(move_uploaded_file($fileTmpPath, $dest_path)) {  
            addRestaurant($companyId, $restaurantName, $restaurantDesc, $dest_path);
            header("Location: restaurant.php?message=Restoran başarıyla eklendi!");  
            exit;  
        } else {  
            header("Location: restaurant.php?message=Dosya yüklenirken bir hata oluştu.");  
            exit;  
        }  
} else {  
    header("Location: restaurant.php?message=Logo yüklenemedi.");  
    exit;  
}  
 
?> 