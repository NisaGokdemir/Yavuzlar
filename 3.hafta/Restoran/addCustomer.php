<?php  
session_start();  
include "functions/func.php";  
//  if (!$_SESSION['role'] == 'admin') {
//      header("Location: index.php?message=Bu sayfayı görüntüleme izniniz yok!");
//     die();
// }
//  if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
//  header("Location: login.php?message=Giriş yapmadınız!");
// }  


if (isset($_POST['customerName']) && isset($_POST['customerSurname']) && isset($_POST['customerUsername']) && isset($_POST['customerPasswd']) && isset($_POST['customerBalance']) && isset($_POST['customerRole']) && isset($_FILES['customerLogo']) && $_FILES['customerLogo']['error'] === UPLOAD_ERR_OK) {
        $name = $_POST['customerName'];  
        $surname = $_POST['customerSurname'];  
        $user = $_POST['customerUsername'];  
        $password = $_POST['customerPasswd'];  
        $balance = $_POST['customerBalance'];
        $role = $_POST['customerRole'];
        //buralar yoksa hata var
        $fileTmpPath = $_FILES['customerLogo']['tmp_name'];         
        $fileName = $_FILES['customerLogo']['name'];  
        $fileSize = $_FILES['customerLogo']['size'];  
        $fileType = $_FILES['customerLogo']['type'];
        $uploadFileDir = './uploads/';  
        $dest_path = $uploadFileDir . $fileName;  

        if(move_uploaded_file($fileTmpPath, $dest_path)) {  
            addCustomer($name, $surname, $user, $password, $balance, $dest_path, $role);  
            header("Location: customer.php?message=Kullanıcı başarıyla eklendi!");  
            exit;  
        } else {  
            header("Location: customer.php?message=Dosya yüklenirken bir hata oluştu.");  
            exit;  
        }  
} else {  
    header("Location: customer.php?message=Logo yüklenemedi.");  
    exit;  
}  
 
?> 