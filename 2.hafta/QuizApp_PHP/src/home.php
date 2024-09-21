<?php
session_start();
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
  header("Location: login.php?message=Giriş yapmadınız!");
} else {
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./css/home.css">
        <link rel="stylesheet" href="./css/utilities.css">
        <title>Anasayfa</title>
    </head>
    <body>
        <div class="home">
            <img src="./assets/logo.png" alt="logo" class="logo">
            <div class="button-group">
                <?php if ($_SESSION['isAdmin']): ?>
                    <button class="btnMenu"  onClick="questListPage()">Sorular</button>
                <?php endif; ?>
                <?php if ($_SESSION['isAdmin']): ?>
                    <button class="btnMenu" onClick="userListPage()">Kullanıcılar</button>
                <?php endif; ?>
                    <button class="btnMenu" onClick="scoreboardPage()">Skor Tablosu</button>
                    <button class="btnMenu" onClick="startPage()">Başlat</button>
            </div>
            <form action="logout.php" method="post">
                <button class="logout btn">Çıkış Yap</button>
            </form>
        </div>
        <script src="./js/script.js"></script>
    </body>
    </html>
<?php } ?>
