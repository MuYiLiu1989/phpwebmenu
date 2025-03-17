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
		<form action="/mywork/menuset/changeMenu.php" method="get" style="font-size: larger;">
		請選擇操作：
		<input type="radio" name="operate" value="new">新增(Create)
		<input type="radio" name="operate" value="menu">列出菜單(Read)
		<input type="radio" name="operate" value="update">修改(Update)
		<input type="radio" name="operate" value="delete">刪除(Delete)
		<input type="radio" name="operate" value="order">列出訂單(ListOrders)	
		<input type="submit" value="提交" style="position:relative; left: 20px;">
		</form>
		<form method="post" action="/mywork">
			<input type="submit" value="回首頁">
		</form>
<?php 

echo "<hr/>";




$operate=$_GET['operate'];
switch ($operate)
{
case "new":
    require "add.php";
    break;
case "update":
	require "updatelist.php";
    break;
case "delete":
    require "delete.php";
    break;
case "menu":
    require "show.php";
	break;
case "order":
	require "mongodbshow.php";
	break;
default:
    echo "";
}

?>
	</body>



</html>