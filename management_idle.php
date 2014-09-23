<? include("header.php");?>
	<div id="main">
    <center>
        <div class="row">
            <div class="col-md-1">
       		   </div>
            <div class="col-md-2" align="left">
       		      <table class="table table-hover">
<tr><td onClick="location.href='management.php'"><center>&nbsp;我的商品&nbsp;</center></td></tr>
<tr><td onClick="location.href='management_wanted.php'"><center>&nbsp;我的需求&nbsp;</center></td></tr>
<tr><td onClick="location.href='management_removed.php'"><center>已下架商品/需求</center></td></tr>
<tr><td class="success" onClick="location.href='management_idle.php'"><center>&nbsp;閒置商品/需求&nbsp;</center></td></tr>
</table>     
            </div>
  			<div class="col-md-9">
            <?php 
session_start();
$username=$_SESSION['MM_Username']; 
include_once("mysql_info.php");
$sql = "select m.id, m.username, i.* from member m, item_forsell i where m.id = i.owner and m.username = '$username' and status = 3 order by i.id desc"; 
$result = mysqli_query($link,$sql); // 執行SQL查詢
$total_fields=mysqli_num_fields($result); // 取得欄位數
$number_of_row=mysqli_num_rows($result); // 取得記錄數
$totalCount = ceil($number_of_row/3)*3;
echo "<table><tr><th colspan=\"3\"></th></tr>";
for($k = 0; $k < $totalCount; $k ++) {

        if($k%3 == 0) { echo '<tr>'; }

        if($row = mysqli_fetch_array($result)) {
                echo '<td><table><form action="recover_item.php" method="post"><tr><td style="width:230px">'.$row[name].
                     '</td></tr><tr><td>'.$row[price].
                     '</td><tr><td>'.$row["date"].
					 '</td><tr><td><img src="Picture/'.$row[filename].'_1.jpg" width="216" height="162" class="img-rounded"></td><tr><td><center><input type="hidden" value="item" name="type"><input type="submit" class="btn btn-default" value="恢復上架"><input type="hidden" name="id" value="'.$row['id'].'"/></center></td></tr></form></table></td>';
        }
        else {
                echo '<td style="width:230px"></td>';
        }

        if($k%3 == 2) { echo '</tr>'; }

}
echo "</table>";

include_once("mysql_info.php");
$sql = "select m.id, m.username, i.* from member m, item_wanted i where m.id = i.owner and m.username = '$username' and status = 3 order by i.id desc"; 
$result = mysqli_query($link,$sql); // 執行SQL查詢
$total_fields=mysqli_num_fields($result); // 取得欄位數
$number_of_row=mysqli_num_rows($result); // 取得記錄數

echo "<table><tr><th colspan=\"3\"></th></tr>";
for($k = 0; $k < $totalCount; $k ++) {

        if($k%3 == 0) { echo '<tr>'; }

        if($row = mysqli_fetch_array($result)) {
                echo '<td><table><form action="recover_item.php" method="post"><tr><td style="width:230px">'.$row[name].
                     '</td></tr><tr><td>'.$row[detail].'</td></tr><tr><td>'.$row[price].
                     '</td></tr><tr><td>'.$row["date"].
					 '</td></tr><tr><td><center><input type="hidden" value="want" name="type"><input type="submit" class="btn btn-default" value="繼續徵求"><input type="hidden" name="id" value="'.$row['id'].'"/></center></td></tr></form></table></td>';
        }
        else {
                echo '<td style="width:230px"></td>';
        }

        if($k%3 == 2) { echo '</tr>'; }

}
echo "</table>";

?>
            </div>
        </div>
       </center>
	</div><!-- // end #main -->
</div>
<? include("footer.php");?>