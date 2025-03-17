<?php
session_start();
?>
<html>

	<head>
		<meta charset="utf-8">
		<title>
			cart
		</title>
        <link href="../static/css/tablestyle.css" rel="stylesheet" >
        <link href="../static/css/formstyle.css" rel="stylesheet" >
	</head>


	<body>

<?php
//按查看購物車按鈕時沒有get Id值
if (isset($_GET["Id"])){
$id=$_GET["Id"];
//防止如果沒有輸入數量就點進去，後來被Javascript event listener擋住
if (!empty($_POST[$id])){
$quantity=$_POST[$id];
//如果購物車無此項，紀錄這項有幾個，如果有，把數字加上原來的數量。
if (isset($_SESSION[$id])){
	$_SESSION[$id]+=$quantity;
}else{
	$_SESSION[$id]=$quantity;
  }
 }
}
?>

<table border="1">
	<caption>購物車的商品</caption>
	<tr><th></th><th>料理名稱</th><th>價格</th><th></th><th>數量</th><th></th><th>小計</th></tr>
<?php
//var_dump($_SESSION); //如果按查看購物車按鈕時購物車沒東西的話是個空array
if (!empty($_SESSION)){
$mysqli = new mysqli("mysql", "root", "1234567890") 
        or die("無法開啟MySQL資料庫連接!<br/>");
$mysqli->select_db("myweb");
$total=0;
$cart=array();
foreach ($_SESSION as $key => $value) {
	$sql = "select name,price from menu where id=".substr($key, 2);
	$result = $mysqli->query($sql);
	$row=$result->fetch_row();
	echo "<tr><td><a href='cartItemDelete.php?Id=".$key."'>刪除</a></td>".
	"<td>".$row[0]."</td><td>".$row[1]."</td>". //名稱、價格
	"<form method='post' action='minusone.php?Id=".$key."'><td>".
	"<button type='submit'>-</button></td></form>". //減1
	"<td>".$value."</td>". //數量
	"<form method='post' action='plusone.php?Id=".$key."'><td>".
	"<button type='submit'>+</button></td></form>".//加1
	"<td>".$row[1]*$value."</td></tr>";//小計
	$cart[]=['dish_id'=>substr($key,2),'dish_name'=>$row[0],'price'=>$row[1],'order_num'=>$value];
	$total+=$row[1]*$value;
	/*
	echo <<< EOF
	<script>
	var minus = document.getElementById('{$key}min');
	var plus = document.getElementById('{$key}plus');
	minus.addEventListener('click',minusone,false);
	plus.addEventListener('click',plusone,false);
	function minusone(){window.location.href='minusone.php?Id={$key}';}
	function plusone(){window.location.href='plusone.php?Id={$key}';}
	</script>
EOF;
*/
}
$result->close();  
$mysqli->close();
echo "<tr><td colspan='7'>總金額：".$total."元</td></tr>";
echo "</table>";
echo <<< EOF
<form method='post' style='display:inline; font-size:x-large;'>
	<input type="radio" name="inout" value="forhear">內用
	<input type="radio" name="inout" value="togo">外帶
	<button type='submit' name='po' value='yes' style="position: relative; left: 20px;">送出訂單</button>
</form>
EOF;
}else{
	echo "<h2>購物車沒有商品</h2>";
}
//echo "<h2>您的sessionID:".session_id()."</h2>";

?>

<form method="post" action="menu.php" style="display:inline; position: relative; left:80px;"><button type='submit'>回菜單</button></form>

<?php
if (isset($_POST['po'])){
//有按送出訂單按紐時，$_POST['po']才會有值。
$dbhost = 'mongodb';

require "../composer/vendor/autoload.php";

if (isset($_POST['inout'])){ //要求選擇內用還是外帶，不然就不能送出。

// 連線到 MongoDB 伺服器
$mongoClient = new MongoDB\Client('mongodb://'.$dbhost.':27017');
//if (isset($mongoClient)){echo "success<br>";}else{die(fail);} 測試用

// 取得 orderlist 這個 collection
$collection = $mongoClient->billbase->orderlist;

$phone='09';
for($i=0;$i<8;$i++){
	$phone.=rand(0,9);
}
$document = ['phone_num'=>$phone,'manner'=>$_POST['inout'],'order'=>$cart];
$result = $collection->insertOne($document);
echo "<script>window.alert('Inserted ID: " . $result->getInsertedId()."\\n".$phone."訂單已送出');</script>";

//session_regenerate_id();
session_destroy(); //刪除session紀錄，不過$_SESSION變數目前還存有內容，離開此PHP腳本後即消失
//session_unset(); //刪除session紀錄，同時$_SESSION變數的內容也會消失

echo "<script type='text/javascript'>".
         "window.location.href = 'menu.php';".
         "</script>";
//不能用php的header('Location: menu.php'); 因為用php的header會在html送出前先送出標頭叫他轉址，html的內容就不會呈現了。
}else{
	echo "<script>window.alert('請選擇內用還是外帶');</script>";
	$_POST['po']=null;
}
}
?>
</body>
</html>