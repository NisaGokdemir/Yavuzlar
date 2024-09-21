<?php  
session_start();  
include "functions/func.php";  

if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {  
    header("Location: login.php?message=Giriş yapmadınız!");  
    exit;  
}  

if ($_SESSION['role'] !== 'admin') {  
    header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");  
    exit;  
}  

if (isset($_POST['id']) && isset($_POST['companyName']) && isset($_POST['companyDesc']) && isset($_FILES['companyLogo']) && $_FILES['companyLogo']['error'] === UPLOAD_ERR_OK) {  
    $id = $_POST['id'];  
    $name = $_POST['companyName'];  
    $description = $_POST['companyDesc'];   

    $fileTmpPath = $_FILES['companyLogo']['tmp_name'];  
    $fileName = $_FILES['companyLogo']['name'];  
    $fileSize = $_FILES['companyLogo']['size'];  
    $uploadFileDir = './uploads/';  
    $dest_path = $uploadFileDir . $fileName;  

    if(move_uploaded_file($fileTmpPath, $dest_path)) {   
        $updatedRows = updateCompany($id, $name, $description, $dest_path);   
        if ($updatedRows > 0) {  
            header("Location: company.php?message=Firma başarıyla güncellendi!");  
            exit;  
        } else {  
            header("Location: company.php?message=Güncellenen firma bulunamadı veya değişiklik yapılmadı.");  
            exit;   
        }    
    } else {  
        header("Location: updateCompany.php?message=Dosya yüklenirken bir hata oluştu.");  
        exit;  
    }  
} else {  
    header("Location: updateCompany.php?message=Tüm alanları doldurmalısınız!");  
    exit;  
}   
?>