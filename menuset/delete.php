
<?php
$mysqli = new mysqli("mysql", "root", "1234567890") 
        or die("無法開啟MySQL資料庫連接!<br/>");
$mysqli->select_db("myweb");  // 選擇myweb資料庫
$sql = "select distinct category from menu";
require "menuCatogory.php";
$result = $mysqli->query($sql);
while ($row = $result->fetch_row()) {
   echo "<div class='oneclass'>"; //用float變左右排序
   
// 設定SQL查詢字串
$sqln = "SELECT id,name,price FROM menu where category='$row[0]'";
// 執行SQL查詢
$resultn = $mysqli->query($sqln);
// 一筆一筆的以表格顯示記錄
echo "<table border='1'>";
echo "<caption>".$maplist[$row[0]]."</caption>";

// 顯示欄位名稱
/*
echo "<tr>";
while ( $meta = $resultn->fetch_field() )
   echo "<th>".$meta->name."</th>";
echo "</tr>";
*/

//顯示欄位數
$total_fields = $resultn->field_count;

// 顯示每一筆記錄
while ($row = $resultn->fetch_row()) {
     echo "<tr><td>";
     echo "<a id='_".$row[0]."' href='deleteprocess.php?Id=".$row[0]."'>";
     echo "刪除</a></td>";    
 // 顯示每一筆記錄的欄位值
   for ($i=1; $i <= $total_fields-1; $i++)
      echo "<td>" . $row[$i] . "</td>";
   echo "</tr>";
   echo "<script>".
     "var delette = document.getElementById('_".$row[0]."');".
     "delette.addEventListener('click',function(e){if(!window.confirm('是否要刪除".$row[1]."？'))e.preventDefault();},false);".
     "</script>";
}

echo "</table>";
echo "</div>";
}
$result->close();
$resultn->close();    // 釋放佔用的記憶體  
$mysqli->close();
?>
