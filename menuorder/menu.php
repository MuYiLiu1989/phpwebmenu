
<html>
	<head>
		<meta charset="utf-8">
		<title>
			menu
		</title>
        <link href="../static/css/tablestyle.css" rel="stylesheet" >
        <link href="../static/css/formstyle.css" rel="stylesheet" >
	</head>


	<body>
		<form method="post" action="../index.php">
			<input type="submit" value="回首頁">
		</form>
		<h2>請選擇好個別餐點的數量後先按訂購加進購物車，之後再一起結帳</h2>
<?php

$mysqli = new mysqli("mysql", "root", "1234567890") 
        or die("無法開啟MySQL資料庫連接!<br/>");
$mysqli->select_db("myweb");  // 選擇myweb資料庫
$sql = "select distinct category from menu";
require "../menuset/menuCatogory.php";
$result = $mysqli->query($sql);
//先取distinct的類別
while ($row = $result->fetch_row()) {
   echo "<div class='oneclass'>";
   
// 設定SQL查詢字串，每個類別的菜單
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

// 取得欄位數
$total_fields = $resultn->field_count;

// 顯示每一筆記錄
while ($rowo = $resultn->fetch_row()) {
   echo "<tr>"; // 顯示每一筆記錄的欄位值
   for ($i=1; $i <= $total_fields-1; $i++){
      echo "<td>" . $rowo[$i] . "</td>";
   }
//菜單表單的method要用post，確保form的action網址的get參數可以成功傳遞，達成get和post參數一起送的效果，這樣會加入購物車，get參數紀錄餐點id，post參數紀錄餐點數量。
    echo <<< EOF
    <form id='id{$rowo[0]}' action='cart.php?Id=id{$rowo[0]}' method='post'>
    <td style='padding:1px;'><input style='width:42px;' type='number' min='0' step='1' name='id{$rowo[0]}'/></td>
    <td><button type='submit'>訂購</button></td>
    </form>
    </tr>
EOF;
//menu輸入商品數量的地方會用事件監聽程式來防止不合預期的操作並用window.alert來提示哪裡出錯。
    echo <<< EOF
    <script>
    var biawdan{$rowo[0]} = document.getElementById('id{$rowo[0]}');
    var biawge{$rowo[0]} = document.getElementsByName('id{$rowo[0]}');
    biawdan{$rowo[0]}.addEventListener('submit',showtype,false);
    function showtype(e){
    if (!biawge{$rowo[0]}[0].value){
    e.preventDefault(); window.alert('請輸入所需數量');}
    else if (Number(biawge{$rowo[0]}[0].value)<=0){
    e.preventDefault(); window.alert('數量不可為零');}
    }
    </script>
EOF;
	/*
    else if (isNaN(Number(biawge{$rowo[0]}[0].value))){
    e.preventDefault(); window.alert('請不要輸入數字以外的資料');
    }else if (!Number.isInteger(Number(biawge{$rowo[0]}[0].value))){
    e.preventDefault(); window.alert('請輸入整數，不要輸入小數');}
    */
}

echo "</table>";
echo "</div>";
}

$result->close();
$resultn->close();    // 釋放佔用的記憶體  
$mysqli->close();

?>
<form method="post" action="cart.php" style="position: relative; left: 30px; top:20px;"><input type='submit' value='查看購物車'></form>
<form action="sessionend.php" style="position: relative; left: 30px; top:20px;"><input type='submit' value='清除購物車'></form>
</body>
</html>

