<?php
session_start();
$id = $_GET['Id'];
$_SESSION[$id]+=1;
header("Location: cart.php");
?>