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
    <form action="changeMenu.php" method="get" style="font-size: larger;">
    請選擇操作：
    <input type="radio" name="operate" value="new">新增(Create)
    <input type="radio" name="operate" value="list">列出全部(Read)
    <input type="radio" name="operate" value="update">修改(Update)
    <input type="radio" name="operate" value="delete">刪除(Delete)  
    <input type="submit" value="提交" style="position:relative; left: 20px;">
    </form>

    <hr/>

<?php
   
   $mysqli = new mysqli("mysql","root","1234567890") 
         or die("無法開啟MySQL資料庫連接!<br>");
   $mysqli->select_db("myweb");  // 選擇資料庫
   // 建立新增記錄的SQL指令字串
   $sql ="select name,price,category from menu where ";
   $sql.="id=";
   $id = $_GET["Id"];
   $sql.=$id;
   // 執行SQL查詢
   $result = $mysqli->query($sql);
   $row = $result->fetch_row();
   $name = $row[0];
   $price = $row[1];
   $category = $row[2];
   $mysqli->close();      // 關閉資料庫連接

?>

<form action="updateprocess.php?Id=<?php echo $id ?>" method='post'>

<table border="1">
  <tr><td>菜名：</td>
      <td><input type="text" name="title" size ="25" value="<?php echo $name;?>"/></td>
  </tr>
  <tr><td>價格：</td>
      <td style="text-align: left;"><input style="width: 80px;" type='number' min='0' step='1' name="price" value="<?php echo $price;?>"/></td>
  </tr>
  <tr><td>種類：</td>
      <td style="text-align: left"><select name="category">
        <?php
        require "menuCatogory.php";
        foreach($maplist as $key=>$value){
        echo "<option value='".$key."'"; if ($category==$key) echo 'selected';
        echo ">".$value."</option>";}
        ?>
          </select></td>
  </tr>
</table>
<input type="submit" name="Insert" value="修改" style="position:relative; top: 15px;"/>
</form>

  </body>



</html>