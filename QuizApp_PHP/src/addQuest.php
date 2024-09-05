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
    <link rel="stylesheet" href="./css/addQuest.css">
    <link rel="stylesheet" href="./css/utilities.css">
    <title>Soru Ekle</title>
</head>
<body>
    <div class="addQuest">
        <h1>Soru Ekle</h1>
        <form action="addQuestQuery.php" method="post" enctype="multipart/form-data">
            <div class="inputs">
                <input type="text" name="quest" id="quest" placeholder="Soru" required>
                <input type="text" name="answer1" id="answer1" placeholder="Şık" required>
                <input type="text" name="answer2" id="answer2" placeholder="Şık" required>
                <input type="text" name="answer3" id="answer3" placeholder="Şık" required>
                <input type="text" name="answer4" id="answer4" placeholder="Şık" required>
                <div class="difficulty-container">
                    <label for="difficulty">Zorluk:</label>
                    <select name="difficulty" id="difficulty" class="difficulty" required>
                        <option value="basic">Basit</option>
                        <option value="medium">Orta</option>
                        <option value="hard">Zor</option>
                    </select>
                </div>
                <div class="answer-container">
                    <label for="correctAnswer">Doğru Şık:</label>
                    <select name="correctAnswer" id="correctAnswer" class="correctAnswer" required>
                        <option value="choice_a">1</option>
                        <option value="choice_b">2</option>
                        <option value="choice_c">3</option>
                        <option value="choice_d">4</option>
                    </select>
                </div>
            </div>
            <div class="button-group">
                <button  type="submit" class="btn add">Ekle</button>
                <button class="btn back" onClick="questListPage()">Geri Dön</button>
            </div>
        </form>
    </div>

    <script src="./js/script.js"></script>
</body>
</html>