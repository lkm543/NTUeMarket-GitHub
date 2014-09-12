<? include("header.php");?>
	<div id="main">
    <center>
        <div class="row">
            <div class="col-md-1">
       		   </div>
            <div class="col-md-2" align="left">
<table class="table table-hover">
<tr><td onClick="location.href='management_interested.php'"><center>&nbsp;興趣清單&nbsp;</center></td></tr>
<tr><td onClick="location.href='management.php'"><center>&nbsp;我的商品&nbsp;</center></td></tr>
<tr><td class="success" onClick="location.href='management_wanted.php'"><center>&nbsp;我的需求&nbsp;</center></td></tr>
<tr><td onClick="location.href='management_removed.php'"><center>已下架商品/需求</center></td></tr>
<tr><td onClick="location.href='management_idle.php'"><center>&nbsp;閒置商品/需求&nbsp;</center></td></tr>
</table>  
            </div>
  			<div class="col-md-9">
			<?php //MySQL
session_start();
$username=$_SESSION['MM_Username']; 
include_once("function/mysql_info.php");
$sql = "select * from item_wanted where owner='$username' and status=1 order by id desc"; //在test資料表中選擇所有欄位
$result = mysqli_query($link,$sql); // 執行SQL查詢
$total_fields=mysqli_num_fields($result); // 取得欄位數
$total_records=mysqli_num_rows($result);  // 取得記錄數
$totalCount = ceil($total_records/4)*4;
echo '<table align=left>';
for($k = 0; $k < $totalCount; $k ++) {

        if($k%4 == 0) { echo '<tr>'; }

        if($row = mysqli_fetch_array($result)) {
echo '<td><form action="function/management_wanted_database.php" method="post"><table style="margin: 10px 10px 10px 10px">';
echo '<tr><td>&nbsp;&nbsp;名稱&nbsp;&nbsp;&nbsp;</td><td><input type="text" name="name" class="form-control" value="'. $row[name].'"><input type="hidden" name="id" value="'.$row['id'].'"/></td></tr>';
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
echo '<tr><td colspan="2"><center><input type="submit">&nbsp;&nbsp;<input type="submit" value="下架" formaction="function/delete_wanted.php""></center></td></tr></table></form></td>';
        }

        if($k%4 == 3) { echo '</tr>'; }

}
echo '</table>';
   
            
            ?>
            </div>
        </div>
       </center>
	</div><!-- // end #main -->
</div>
<? include("footer.php");?>