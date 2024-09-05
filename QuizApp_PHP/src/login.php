<?php 
  session_start();
  if (isset($_SESSION['id']) && isset($_SESSION['username']) ) {
    header("Location: home.php?message=Giriş yaptınız!");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/login.css">
    <link rel="stylesheet" href="./css/utilities.css">
    <title>Login</title>
</head>
<body>
  <div class="login">
      <img src="./assets/logo.png" alt="logo" class="logo">
      <form action="loginQuery.php" method="post">
        <div class="inputs">
            <input type="text" name="username" id="surname" placeholder="Kullanıcı Adı">
            <input type="password" name="password" id="password" placeholder="Şifre">
        </div>
        <button type="submit" class="btn loginBtn">Giriş Yap</button>
      </form>
  </div>
</body>
</html>