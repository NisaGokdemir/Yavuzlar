<?php
  session_start();
  include "functions/func.php";
  if (!$_SESSION['isAdmin']) {
    header("Location: home.php?message=Bu sayfayı görüntüleme izniniz yok!");
    die();
  }
  if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    header("Location: login.php?message=Giriş yapmadınız!");
  }

  $result = getUsers();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/userList.css">
    <link rel="stylesheet" href="./css/utilities.css">
    <title>KullanıcıListesi</title>
</head>
<body>
    <div class="userList">
        <h1>Kullanıcılar</h1>
        <div class="users">
            <?php foreach ($result as $user): ?>
                <div class="user">
                    <span><?php echo $user['nickname']; ?></span>
                    <div>
                        <a href="deleteUser.php?id=<?php echo $user['id']; ?>" class="btn delete">Sil</a>
                    </div>
                </div> 
            <?php endforeach; ?>
        </div>
        <div class="button-group">
            <button class="btn addPage" onClick="addUserPage()">Kullanıcı Ekle</button>
            <button class="btn backHome" onClick="backHomePage()">Geri Dön</button>
        </div>
    </div>
    <script src="./js/script.js"></script>
</body>
</html>
