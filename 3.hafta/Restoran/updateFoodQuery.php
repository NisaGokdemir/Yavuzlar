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

if (isset($_POST['id']) && isset($_POST['foodName']) && isset($_POST['foodDesc']) && isset($_POST['foodPrice']) && isset($_POST['foodDiscount']) && isset($_POST['restaurantId']) && isset($_FILES['foodLogo']) && $_FILES['foodLogo']['error'] === UPLOAD_ERR_OK) {
        $id = $_POST['id'];
        $foodName = $_POST['foodName'];  
        $foodDesc = $_POST['foodDesc'];  
        $foodPrice = $_POST['foodPrice'];  
        $foodDiscount = $_POST['foodDiscount'];
        $restaurantId = $_POST['restaurantId'];  
        $foodLogo = $_POST['foodLogo'];

        $fileTmpPath = $_FILES['foodLogo']['tmp_name'];         
        $fileName = $_FILES['foodLogo']['name'];  
        $fileSize = $_FILES['foodLogo']['size'];  
        $fileType = $_FILES['foodLogo']['type'];
        $uploadFileDir = './uploads/';  
        $dest_path = $uploadFileDir . $fileName;  

        if(move_uploaded_file($fileTmpPath, $dest_path)) {  
            updateFoodById($id, $foodName, $foodDesc, $foodPrice, $foodDiscount, $restaurantId, $dest_path);  
            header("Location: companyFood.php?message=Yemek başarıyla güncellendi!");  
            exit;  
        } else {  
            header("Location: companyFood.php?message=Dosya yüklenirken bir hata oluştu.");  
            exit;  
        }  
} else {  
    header("Location: companyFood.php?message=Logo yüklenemedi.");  
    exit;  
}  
 
?> 