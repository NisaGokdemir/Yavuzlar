<?php
  session_start();
  if (!$_SESSION['isAdmin']) {
    header("Location: home.php?message=Bu sayfayı görüntüleme izniniz yok!");
    die();
  }
  if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    header("Location: login.php?message=Giriş yapmadınız!");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/addUser.css">
    <link rel="stylesheet" href="./css/utilities.css">
    <title>Kullanıcı Ekle</title>
</head>
<body>
    <div class="addUser">
        <h1>Kullanıcı Ekle</h1>
        <form action="addUserQuery.php" method="POST" enctype="multipart/form-data">
            <div class="inputs">
                <input type="text" id="name" name="name" placeholder="İsim" required>
                <input type="text" id="surname" name="surname" placeholder="Soyisim" required>
                <input type="text" id="nickname" name="nickname" placeholder="Kullanıcı Adı" required>
                <input type="email" id="email" name="email" placeholder="Email" required>
                <input type="password" id="passwd" name="passwd" placeholder="Şifre" required>
                <div class="rol-container">
                    <label for="rol">Yetki:</label>
                    <select name="rol" id="rol" class="rol">
                        <option value="admin">Admin</option>
                        <option value="student">Öğrenci</option>
                    </select>
                </div>
            </div>
            <div class="button-group">
                <button type="submit" class="btn add">Ekle</button>
                <button class="btn back" onClick="userListPage()">Geri Dön</button>
            </div>
        </form>
        
    </div>
    <script src="./js/script.js"></script>
</body>
</html>