<?php

    try {
        $pdo = new PDO("sqlite:C:\\xampp\\htdocs\\QuizApp_PHP\\src\\db\\quizapp.db");

        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    } catch (\Throwable $th) {
        echo "Hata " . $th;
    }



?>