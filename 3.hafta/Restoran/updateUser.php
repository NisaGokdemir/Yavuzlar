<?php  

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();  
include "functions/func.php";  
if (!$_SESSION['role'] == 'customer') {
    header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");
    die();
}
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
header("Location: login.php?message=Giriş yapmadınız!");
}  


if (isset($_POST['id']) && isset($_POST['customerName']) && isset($_POST['customerSurname']) && isset($_POST['customerUsername']) && isset($_FILES['customerLogo']) && $_FILES['customerLogo']['error'] === UPLOAD_ERR_OK) {
        $id = $_POST['id'];
        $name = $_POST['customerName'];  
        $surname = $_POST['customerSurname'];  
        $user = $_POST['customerUsername'];  
        $fileTmpPath = $_FILES['customerLogo']['tmp_name'];         
        $fileName = $_FILES['customerLogo']['name'];  
        $fileSize = $_FILES['customerLogo']['size'];  
        $fileType = $_FILES['customerLogo']['type'];
        $uploadFileDir = './uploads/';  
        $dest_path = $uploadFileDir . $fileName;  

        if(move_uploaded_file($fileTmpPath, $dest_path)) {  
            updateUserById($id, $name, $surname, $user, $dest_path);  
            header("Location: profile.php?message=Kullanıcı başarıyla güncellendi!");  
            exit;  
        } else {  
            header("Location: profile.php?message=Dosya yüklenirken bir hata oluştu.");  
            exit;  
        }  
} else {  
    header("Location: profile.php?message=Logo yüklenemedi.");  
    exit;  
}  
 
?> 