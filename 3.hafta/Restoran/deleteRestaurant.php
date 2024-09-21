<?php  
session_start();  
include "functions/func.php";   

if (isset($_GET["id"])) {  
    $restaurantId = $_GET["id"];
    deleteRestaurantById($restaurantId);  
    header("Location: restaurant.php?message=Restoran başarıyla silindi."); 
    exit;  
} else {  
    header("Location: restaurant.php?message=Restoran silinemedi."); 
    exit;  
}  
?>