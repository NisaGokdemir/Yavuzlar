<?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    try {
        $host = 'db';
        $dbname = 'food_management';
        $username = 'admin';
        $password = 'admin';
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Bağlantı hatası: " . $e->getMessage();
    }
?>
