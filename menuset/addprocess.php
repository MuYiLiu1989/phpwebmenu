<?php
// 是否是表單送回
if (isset($_POST["Insert"])) {
   // 建立mysqli物件
   $mysqli = new mysqli("mysql","root","1234567890") 
         or die("無法開啟MySQL資料庫連接!<br>");
   $mysqli->select_db("myweb");  // 選擇資料庫
   // 建立新增記錄的SQL指令字串
   $sql ="INSERT INTO menu (name, price, category) ";
   $sql.="VALUES (?,?,?)";
   if ( $stmt = $mysqli->prepare($sql) ) {
      // 連繫參數的變數
      $stmt->bind_param("sis",$title,$price,$category);
      $title = $_POST["title"];
      $price = $_POST["price"];
      $category = $_POST["category"];
      $stmt->execute();  // 執行SQL指令
      $stmt->close();    // 關閉Prepared Statement
   }
   else{
      exit("資料庫新增記錄失敗<br/>");}
   $mysqli->close();      // 關閉資料庫連接
   echo "<script type='text/javascript'>".
         "window.alert('資料庫新增記錄成功！');".
         "window.location.href = 'changeMenu.php?operate=new';".
         "</script>";
//header('Location: changeMenu.php?operate=new');用Javascript取代php轉址
}
?>