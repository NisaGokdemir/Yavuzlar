<?php
  session_start();
  include "functions/func.php";
  if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    header("Location: login.php?message=Giriş yapmadınız!");
  }

  $result = getScoreboard();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/scoreboard.css">
    <link rel="stylesheet" href="./css/utilities.css">
    <title>Skor Tablosu</title>
</head>
<body>
    <div class="scoreBoard">
        <h1>Skor Tablosu</h1>
        <div class="scores">
            <?php foreach ($result as $user): ?>
                <div class="score">
                    <span><?php echo $user['nickname']; ?></span>
                    <div>
                        <div class="scoreValue"><?php echo $user['score']; ?></div>
                    </div>
                </div> 
            <?php endforeach; ?>
        </div>         
        <button class="btn backHome" onClick="backHomePage()">Geri Dön</button>     
    </div>
    <script src="./js/script.js"></script>
</body>
</html>
