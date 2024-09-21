<?php  
session_start();  
include "functions/func.php";  
if (!$_SESSION['role'] == 'admin') {
    header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");
    die();
}
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
header("Location: login.php?message=Giriş yapmadınız!");
}  


if (isset($_POST['companyName']) && isset($_POST['companyDesc']) && isset($_FILES['companyLogo']) && $_FILES['companyLogo']['error'] === UPLOAD_ERR_OK) {
        $companyName = $_POST['companyName'];  
        $companyDesc = $_POST['companyDesc']; 
        $fileTmpPath = $_FILES['companyLogo']['tmp_name'];  
        //buralar yoksa hata var
        $fileName = $_FILES['companyLogo']['name'];  
        $fileSize = $_FILES['companyLogo']['size'];  
        $fileType = $_FILES['companyLogo']['type'];  
        
        $uploadFileDir = './uploads/';  
        $dest_path = $uploadFileDir . $fileName;  

        if(move_uploaded_file($fileTmpPath, $dest_path)) {  
            addCompany($companyName, $companyDesc, $dest_path);  
            header("Location: company.php?message=Firma başarıyla eklendi!");  
            exit;  
        } else {  
            header("Location: company.php?message=Dosya yüklenirken bir hata oluştu.");  
            exit;  
        }  
} else {  
    header("Location: company.php?message=Logo yüklenemedi.");  
    exit;  
}  
 
?> 