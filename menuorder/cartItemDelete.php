<?php
session_start();

$id = $_GET['Id'];
unset($_SESSION[$id]);

echo "<script>window.alert('購物車刪除item成功！')</script>";
echo "<script type='text/javascript'>".
     "window.location.href = 'cart.php';".
     "</script>";
?>