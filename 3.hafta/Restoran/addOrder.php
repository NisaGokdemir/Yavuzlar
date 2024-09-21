<?php
session_start();
include "functions/func.php";


$userId = $_SESSION['id'];  
$orderId = createOrder($userId);
header("Location: index.php");
exit(); 

?>
