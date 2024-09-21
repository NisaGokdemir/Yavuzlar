<?php  
session_start();  
include "functions/func.php";  

if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {  
    header("Location: login.php?message=Giriş yapmadınız!");  
    exit;  
}  

if ($_SESSION['role'] !== 'company') {  
    header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");  
    exit;  
}  

if (isset($_POST['restaurantName']) && isset($_POST['restaurantDesc']) && isset($_POST['companyId']) && isset($_FILES['restaurantLogo']) && $_FILES['restaurantLogo']['error'] === UPLOAD_ERR_OK) {  
    $id = $_POST['id'];  
    $restaurantName = $_POST['restaurantName'];  
    $restaurantDesc = $_POST['restaurantDesc']; 
    $companyId = $_POST['companyId']; 
    $fileTmpPath = $_FILES['restaurantLogo']['tmp_name'];  
    $fileName = $_FILES['restaurantLogo']['name'];  
    $fileSize = $_FILES['restaurantLogo']['size'];  
    $fileType = $_FILES['restaurantLogo']['type'];  
    
    $uploadFileDir = './uploads/';  
    $dest_path = $uploadFileDir . $fileName;    

    if(move_uploaded_file($fileTmpPath, $dest_path)) {   
        $updatedRows =  updateRestaurant($id, $restaurantName,  $restaurantDesc, $companyId, $dest_path);   
        if ($updatedRows > 0) {  
            header("Location: restaurant.php?message=Restoran başarıyla güncellendi!");  
            exit;  
        } else {  
            header("Location: restaurant.php?message=Restoran firma bulunamadı veya değişiklik yapılmadı.");  
            exit;   
        }    
    } else {  
        header("Location: updateRestaurant.php?message=Dosya yüklenirken bir hata oluştu.");  
        exit;  
    }  
} else {  
    header("Location: updateRestaurant.php?message=Tüm alanları doldurmalısınız!");  
    exit;  
}   
?>