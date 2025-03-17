<html>

	<head>
		<meta charset="utf-8">
		<title>
			顧客或店家
		</title>
        <link href="/mywork/menuset/static/css/tablestyle.css" rel="stylesheet" >
        <link href="/mywork/menuset/static/css/formstyle.css" rel="stylesheet" >
	</head>


	<body>
		<div style="width: 300px; margin: 10px auto;">
		<h1>您是顧客還是店家？</h1>
		<div style="width: 300px;">
			<div class="oneclass" style="margin: 10px;">
				<form method="post" action="/mywork/menuorder/menu.php">
					<label style="font-size: x-large;">我是顧客</label>
					<input style="font-size: x-large;" type="submit" value="開始點餐">
				</form>
			</div>
			<div class="oneclass" style="margin: 10px;">
				<form method="post" action="/mywork/menuset/changeMenu.php?operate=none">
					<label style="font-size: x-large;">店家系統</label>
					<input style="font-size: x-large;" type="submit" value="修改菜單，查看訂單">
				</form>
			</div>
		</div>
		</div>
	</body>
</html>