<?php
//ini_set('session.cookie_lifetime', 86400);
session_start();
//session_regenerate_id();
session_destroy();
//session_unset();
echo "<script type='text/javascript'>".
         "window.alert('清空購物車成功！');".
         "window.location.href = 'menu.php';".
     "</script>";
#header('Location: menu.php');
?>