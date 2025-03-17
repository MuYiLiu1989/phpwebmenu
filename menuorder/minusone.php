<?php
session_start();
$id = $_GET['Id'];
$_SESSION[$id]-=1;
if ($_SESSION[$id]==0){unset($_SESSION[$id]);}
header("Location: cart.php");
?>