<?php  
session_start();  
include "functions/func.php";  

if (!isset($_SESSION['id']) && !isset($_SESSION['username'])) {  
    header("Location: login.php?message=Giriş yapmadınız!");  
    die();  
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {    
    if (isset($_SESSION['id'])) {  
        $userId = $_SESSION['id'];  
        $questions = getRandomQuestions($userId);  
        //json dönüşümü yapmazsam console da json dönüşüm hatası alıyorum : Unexpected end of JSON input
        echo json_encode($questions);  
    }
}  

if (isset($_POST['questionId']) && isset($_POST['userAnswer']) && isset($_SESSION['id'])){
    $userId = $_SESSION['id'];  
    $questionId = $_POST['questionId'];  
    $userAnswer = $_POST['userAnswer'];  
    $result = submitAnswer($userId, $questionId, $userAnswer);
}

?>