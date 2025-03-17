

<form action="addprocess.php" method='post'>

<table border="1">
  <tr><td>菜名：</td>
      <td><input type="text" name="title" size ="25"/></td>
  </tr>
  <tr><td>價格：</td>
      <td style="text-align: left;"><input style="width: 80px;" type='number' min='0' step='1' name="price"/></td>
  </tr>
  <tr><td>種類：</td>
      <td style="text-align: left;"><select name="category">

      <?php
        require "menuCatogory.php";
        foreach($maplist as $key=>$value)
        echo "<option value='".$key."'>".$value."</option>";
      ?>
          </select></td>
  </tr>
</table>
<input type="submit" name="Insert" value="新增" style="position:relative; top: 15px;"/>
</form>