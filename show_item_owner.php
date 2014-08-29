<?php 
session_start();
$username=$_SESSION['MM_Username']; 
//mysqli為主 非mysql
//header('Content-type:text/html; charset=utf-8');
$mysql_host="mysql16.000webhost.com";
$mysql_user="a4904409_public";
$mysql_password="s0894206";
//mysqli_query("SET NAMES 'utf8'"); 
//mysqli_query("set character set utf8",$link);
$link=mysqli_connect ("$mysql_host","$mysql_user","$mysql_password")or die ('Error connecting to mysql');
mysqli_query($link,'SET NAMES utf8');
//mysqli_query("set character set utf8",$link);
//$mysqli->query("SET NAMES 'utf8'");
mysqli_select_db ($link,"a4904409_goods");  
//mysqli_query("set character set utf8",$link);
//mysql_query("SET NAMES 'utf8'");  
//mysqli_query("SET NAMES 'utf8'");  
$sql = "select * from goods_test where owner='$username' and status=1 order by id desc"; //在test資料表中選擇所有欄位
//mysqli_query($link, "SET CHARACTER SET utf8");// 送出Big5編碼的MySQL指令
//mysqli_query($link, "SET collation_connection ='utf8_general_ci'");
$result = mysqli_query($link,$sql); // 執行SQL查詢
//$row = mysqli_fetch_array($result); //將陣列以欄位名索引
//$row = mysqli_fetch_row($result); //將陣列以數字排列索引
$total_fields=mysqli_num_fields($result); // 取得欄位數
$total_records=mysqli_num_rows($result);  // 取得記錄數
?>


<?php

$totalCount = ceil($total_records/4)*4;
echo '<table align=left>';
for($k = 0; $k < $totalCount; $k ++) {

        if($k%4 == 0) { echo '<tr>'; }

        if($row = mysqli_fetch_array($result)) {
echo '<td><form action="management_database.php" method="post"><table style="margin: 10px 10px 10px 10px">';
echo '<tr><td>&nbsp;&nbsp;名稱&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="name" class="form-control" value="'. $row[goods_name].'"><input type="hidden" name="id" value="'.$row['id'].'"/></td></tr>';
echo '<tr><td>&nbsp;&nbsp;描述&nbsp;&nbsp;&nbsp;</td><td><textarea name="detail" id="detail" pattern=".{0,100}" class="form-control" rows="3">'.$row[detail].'</textarea></td></tr>';   
echo '<tr><td>&nbsp;&nbsp;價格&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="price" class="form-control" value="'.$row[price].'"></td></tr>';  
echo '<tr><td>&nbsp;&nbsp;方式&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="method" class="form-control" value="'.$row[method].'"></td></tr>';  
echo '<tr><td>&nbsp;&nbsp;分類&nbsp;&nbsp;&nbsp;</td><td>
		  <select name="sort" id="sort" class="form-control">'; ?>
          <option value="life" <?php if ($row['sort']=="life") echo 'selected="selected"';?>>生活用品</option>
          <option value="stationary" <?php if ($row['sort']=="stationary") echo 'selected="selected"';?>>文具</option>
          <option value="clothes" <?php if ($row['sort']=="clothes") echo 'selected="selected"';?>>衣物</option>
          <option value="3c" <?php if ($row['sort']=="3c") echo 'selected="selected"';?>>3c產品</option>
          <option value="bike" <?php if ($row['sort']=="bike") echo 'selected="selected"';?>>腳踏車</option>
          <option value="book" <?php if ($row['sort']=="book") echo 'selected="selected"';?>>課外讀物</option>
          <option value="textbook" <?php if ($row['sort']=="textbook") echo 'selected="selected"';?>>教科書</option>
          <option value="else" <?php if ($row['sort']=="else") echo 'selected="selected"';?>>其他</option>
<?php 
echo '</select></td></tr>';	
echo '<tr><td colspan="2"><center><img src="Picture/'.$row[filename].'"width="216" height="162" class="img-rounded"></center></td></tr>';
//echo '<tr><td>&nbsp;&nbsp;圖片&nbsp;&nbsp;&nbsp;</td><td><input type="file" name="file" id="file" style="width:180px" class="form-control"></td></tr>';
echo '<tr><td colspan="2"><center><input type="submit" value="修改">&nbsp;&nbsp;<input type="submit" value="下架" formaction="delete_item.php""></center></td></tr></table></form></td>';
        }

        if($k%4 == 3) { echo '</tr>'; }

}
echo '</table>';
?>