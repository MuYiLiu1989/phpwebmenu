<?php
//店家新增菜單的時候，除了要輸入名稱價格以外，還要選擇種類，因為菜單表格的展現是用種類來區分的，用巢狀迴圈即可達成。種類與其代號的對應放在這個php腳本，可以隨時修改新增，需要時再來引用。因為修改這個很簡單，就沒另外再做出網頁操作的模式了。
$maplist = array("C1"=>"義大利麵","C2"=>"燉飯","C3"=>"披薩","C4"=>"早午餐","C5"=>"沙拉","C6"=>"飲料","C7"=>"西式小點","C8"=>"壽司","C9"=>"熱炒","C10"=>"燒烤","C11"=>"小火鍋");
?>