<?php
  session_start();
  include "functions/func.php";
  
  if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {
    header("Location: login.php?message=Giriş yapmadınız!");
  }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz App</title>
    <link rel="stylesheet" href="./css/quizapp.css">
    <link rel="stylesheet" href="./css/utilities.css">
</head>
<body>
    <div class="quizapp">
        <div class="quiz">
            <h2 id="question">Soru</h2>
            <div id="answerBtns">
                <button class="ansBtn">Cevap1</button>
                <button class="ansBtn">Cevap2</button>
                <button class="ansBtn">Cevap3</button>
                <button class="ansBtn">Cevap4</button>
            </div>
            <button id="nextBtn">Next</button>
        </div>
    </div>
    <script src="./js/quizapp.js"></script>
</body>
</html>