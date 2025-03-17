<?php
   //完成刪除動作後再轉址回去
   $mysqli = new mysqli("mysql","root","1234567890") 
         or die("無法開啟MySQL資料庫連接!<br>");
   $mysqli->select_db("myweb");  // 選擇資料庫
   // 建立新增記錄的SQL指令字串
   $sql ="delete from menu where ";
   $sql.="id=";
   $id = $_GET["Id"];
   $sql.=$id;
   
   if($mysqli->query($sql)===True){
   echo "<script>window.alert('資料庫刪除記錄成功！')</script>";
   }else{
      exit("資料庫刪除記錄失敗<br/>");
   }
   $mysqli->close();      // 關閉資料庫連接
   //不能用php的header('Location: changeMenu.php?operate=delete'); 因為用php的header會在html送出前先送出標頭叫他轉址，html的內容就不會呈現了。
   echo "<script type='text/javascript'>".
         "window.location.href = 'changeMenu.php?operate=delete';".
         "</script>";

?>