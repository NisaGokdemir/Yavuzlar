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
 
if (isset($_GET['id'])) {  
    $question_id = $_GET['id'];  
    $question = getQuestionById($question_id);
}
?>  
<!DOCTYPE html>  
<html lang="en">  
<head>  
    <meta charset="UTF-8">  
    <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" href="./css/editQuest.css">  
    <link rel="stylesheet" href="./css/utilities.css">  
    <title>Soru Düzenle</title>  
</head>  
<body>  
    <div class="editQuest">  
        <h1>Soru Düzenle</h1>  
        <form action="editQuestQuery.php" method="post" enctype="multipart/form-data">  
            <input type="hidden" name="id" value="<?php echo $question['id']; ?>">   
            <div class="inputs">  
                <input type="text" id="quest" name="quest" placeholder="Soru" value="<?php echo $question['question_text']; ?>" required>  
                <input type="text" id="answer1" name="answer1" placeholder="Şık 1" value="<?php echo $question['choice_a']; ?>" required>  
                <input type="text" id="answer2" name="answer2" placeholder="Şık 2" value="<?php echo $question['choice_b']; ?>" required>  
                <input type="text" id="answer3" name="answer3" placeholder="Şık 3" value="<?php echo $question['choice_c']; ?>" required>  
                <input type="text" id="answer4" name="answer4" placeholder="Şık 4" value="<?php echo $question['choice_d']; ?>" required>  
                <div class="difficulty-container">  
                    <label for="difficulty">Zorluk:</label>  
                    <select name="difficulty" id="difficulty" class="difficulty" required>  
                        <option value="basic" <?php echo ($question['difficulty'] == 'basic') ? 'selected' : ''; ?>>Basit</option>  
                        <option value="medium" <?php echo ($question['difficulty'] == 'medium') ? 'selected' : ''; ?>>Orta</option>  
                        <option value="hard" <?php echo ($question['difficulty'] == 'hard') ? 'selected' : ''; ?>>Zor</option>  
                    </select>  
                </div>  
                <div class="answer-container">  
                    <label for="correctAnswer">Doğru Şık:</label>  
                    <select name="correctAnswer" id="correctAnswer" class="correctAnswer" required>  
                        <option value="choice_a" <?php echo ($question['correct_choice'] == 'choice_a') ? 'selected' : ''; ?>>1</option>  
                        <option value="choice_b" <?php echo ($question['correct_choice'] == 'choice_b') ? 'selected' : ''; ?>>2</option>  
                        <option value="choice_c" <?php echo ($question['correct_choice'] == 'choice_c') ? 'selected' : ''; ?>>3</option>  
                        <option value="choice_d" <?php echo ($question['correct_choice'] == 'choice_d') ? 'selected' : ''; ?>>4</option>  
                    </select>  
                </div>  
            </div>  
            <div class="button-group">  
                <button class="btn edit" type="submit">Düzenle</button>  
                <a href="questList.php" class="btn back">Geri Dön</a>  
            </div>  
        </form>       
    </div>  
    <script src="./js/script.js"></script>  
</body>  
</html>