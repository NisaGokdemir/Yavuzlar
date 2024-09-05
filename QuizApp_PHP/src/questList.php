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

  $result = getQuestions();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/questList.css">
    <link rel="stylesheet" href="./css/utilities.css">
    <title>Soru Listesi</title>
</head>
<body>
    <div class="questList">
        <form action="">
            <input type="text" placeholder="Soru Ara" class="searchInput">
            <button class="btn search" onClick="searchQuestion()">Ara</button>
        </form>
        <div class="questions">
            <?php foreach ($result as $question): ?>
                <div class="question">
                    <span><?php echo $question['question_text']; ?></span>
                    <div class="button-group">
                        <a href="editQuest.php?id=<?php echo $question['id']; ?>" class="btn editPage">Düzenle</a>
                        <a href="deleteQuestion.php?id=<?php echo $question['id']; ?>" class="btn delete">Sil</a> 
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="button-group">
            <button class="btn addPage" onClick="addQuestPage()">Soru Ekle</button>
            <button class="btn backHome" onClick="backHomePage()">Geri Dön</button>
        </div>
    </div>

    <script src="./js/script.js"></script>
</body>
</html>
