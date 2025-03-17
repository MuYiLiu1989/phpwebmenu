<?php
// MongoDB 伺服器設定
$dbhost = 'mongodb';
$account = 'root';
$password = 'A123456789';

require "../composer/vendor/autoload.php";

// 連線到 MongoDB 伺服器
$mongoClient = new MongoDB\Client('mongodb://'.$dbhost.':27017');
//if (isset($mongoClient)){echo "success<br>";}else{die(fail);}測試是否可連上

//原本的方式
//$db = $mongoClient->selectDatabase($dbname);
//$collection=$db->selectCollection($collectionName);

//改用這個方式
$collection = $mongoClient->billbase->orderlist;
echo "<h2>目前訂單數：".$collection->count([],[])."</h2><hr>";
$result = $collection->find([],['sort'=>['_id'=>-1]]); //用建_id的時間反向排序
foreach ($result as $item){
	echo "<table>";
	$timestamp = $item->_id->getTimestamp();
	$date = date("Y/m/d H:i:s",$timestamp);
	echo "<caption>".$date."<br>";
	$phone = $item->phone_num;
	echo "手機號碼：".$phone."</caption>";
	
	echo "<tr><th>id</th><th>菜名</th><th>價格</th><th>數量</th><th>小計</th></tr>";
	$total=0;
	foreach ($item->order as $dish) {
		echo "<tr><td>".$dish->dish_id."</td><td>".$dish->dish_name."</td><td>".$dish->price."</td><td>".$dish->order_num."</td><td>".$dish->price*$dish->order_num."</td></tr>";
		$total+=$dish->price*$dish->order_num;
	}
	$manner = ['togo'=>'外帶','forhear'=>'內用'];
	echo "<tr><td colspan='5'>總金額：".$total."元 (".$manner[$item->manner].")</td></tr>";
	echo "</table>";
	echo "<hr>";
}

?>