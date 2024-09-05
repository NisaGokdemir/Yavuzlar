<?php  
session_start();  
include "functions/func.php";  

if (!$_SESSION['isAdmin']) {  
    header("Location: home.php?message=Bu sayfayı görüntüleme izniniz yok!");  
    die();  
}  
if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {  
    header("Location: login.php?message=Giriş yapmadınız!");  
    die();  
}  

if (isset($_POST['quest']) && isset($_POST['answer1']) && isset($_POST['answer2']) && isset($_POST['answer3']) && isset($_POST['answer4']) && isset($_POST['difficulty']) && isset($_POST['correctAnswer'])) {  
    $question_text = $_POST['quest'];  
    $choice_a = $_POST['answer1'];  
    $choice_b = $_POST['answer2'];  
    $choice_c = $_POST['answer3'];  
    $choice_d = $_POST['answer4'];  
    $difficulty = $_POST['difficulty'];  
    $correct_choice = $_POST['correctAnswer'];  
    addQuestion($question_text, $choice_a, $choice_b, $choice_c, $choice_d, $correct_choice, $difficulty);   
    header("Location: questList.php?message=Soru başarılı bir şekilde eklendi!");  
    exit;  
} else {  
    header("Location: addQuest.php?message=Tüm alanları doldurmalısınız!");  
    exit;  
}   
?>