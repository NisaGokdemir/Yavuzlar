<?php
    error_reporting(E_ALL);  
    ini_set('display_errors', 1);

    function Login($nickname,$passwd){
        include "db.php";
        $query = "SELECT *,COUNT(*) as count FROM users WHERE nickname = :nickname AND passwd = :passwd";
        $statement = $pdo->prepare($query);
        $statement->execute([':nickname' => $nickname, ':passwd' => $passwd]);
        $result = $statement->fetch();
        return $result;
    }

    function getUsers() {
        include "db.php";
        $query = "SELECT * FROM users";
        $statement = $pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    function deleteUser($id) {
        include "db.php";
        $query = "DELETE FROM users WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->execute([':id' => $id]);
    }

    function addUser($username, $surname, $nickname, $email, $passwd, $isAdmin = 0) {
        include "db.php";
        $query = "INSERT INTO users (username, surname, nickname, email, passwd, isAdmin) VALUES (:username, :surname, :nickname, :email, :passwd, :isAdmin)";
        $statement = $pdo->prepare($query);
        $statement->execute([':username' => $username,':surname' => $surname,':nickname' => $nickname,':email' => $email,':passwd' => $passwd,':isAdmin' => $isAdmin]);
    }

    function getQuestions() {
        include "db.php";
        $query = "SELECT * FROM questions";
        $statement = $pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    function getQuestionById($id) {  
        include "db.php";  
        $query = "SELECT * FROM questions WHERE id = :id";  
        $statement = $pdo->prepare($query);  
        $statement->execute([':id' => $id]);  
        return $statement->fetch();  
    }

    function addQuestion($question_text, $choice_a, $choice_b, $choice_c, $choice_d, $correct_choice, $difficulty = "basic") {
        include "db.php";
        $query = "INSERT INTO questions (question_text, choice_a, choice_b, choice_c, choice_d, correct_choice, difficulty) VALUES (:question_text, :choice_a, :choice_b, :choice_c, :choice_d, :correct_choice, :difficulty)";
        $statement = $pdo->prepare($query);
        $statement->execute([':question_text' => $question_text,':choice_a' => $choice_a,':choice_b' => $choice_b,':choice_c' => $choice_c,':choice_d' => $choice_d,':correct_choice' => $correct_choice,'difficulty' => $difficulty]);
    }

    function deleteQuestion($id) {
        include "db.php";
        $query = "DELETE FROM questions WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->execute([':id' => $id]);
    }

    function editQuestion($id, $question_text, $choice_a, $choice_b, $choice_c, $choice_d, $correct_choice, $difficulty = "basic") {
        include "db.php";
        $query = "UPDATE questions SET question_text = :question_text, choice_a = :choice_a, choice_b = :choice_b, choice_c = :choice_c, choice_d = :choice_d, correct_choice = :correct_choice, difficulty = :difficulty WHERE id = :id";
        $statement = $pdo->prepare($query);
        $statement->execute([':id' => $id,':question_text' => $question_text,':choice_a' => $choice_a,':choice_b' => $choice_b,':choice_c' => $choice_c,':choice_d' => $choice_d,':correct_choice' => $correct_choice,':difficulty' => $difficulty]);
    }

    function getScoreboard() {
        include "db.php";
        $query = "SELECT * FROM users ORDER BY score DESC";
        $statement = $pdo->prepare($query);
        $statement->execute();
        return $statement->fetchAll();
    }

    function getRandomQuestions($userId, $limit = 5){
        include "db.php";
        $query = "SELECT q.* 
            FROM questions q
            LEFT JOIN submissions s ON q.id = s.question_id AND s.user_id = :userId
            WHERE s.question_id IS NULL
            ORDER BY RANDOM()
            LIMIT :limit";
        $statement = $pdo->prepare($query);
        $statement->execute([
            ':userId' => $userId,
            ':limit' => $limit
        ]);
        return $statement->fetchAll();
    }

    function submitAnswer($userId, $questionId, $userAnswer) {
        include "db.php";

        $query = "SELECT correct_choice FROM questions WHERE id = :questionId";
        $statement = $pdo->prepare($query);
        $statement->execute([':questionId' => $questionId]);
        $correct_choice = $statement->fetchColumn();
        $isCorrect = ($userAnswer === $correct_choice) ? 1 : 0;


        $query = "INSERT INTO submissions (user_id, question_id, is_correct) 
                VALUES (:userId, :questionId, :isCorrect)";
        $statement = $pdo->prepare($query);
        $statement->execute([
            ':userId' => $userId,
            ':questionId' => $questionId,
            ':isCorrect' => $isCorrect
        ]);

        if ($isCorrect) {
            $query = "UPDATE users SET score = score + 1 WHERE id = :userId";
            $statement = $pdo->prepare($query);
            $statement->execute([':userId' => $userId]);
        }
        return $isCorrect;
    }



?>
