<? include("header.php");?>
  <div id="main">
    <center>
        <div class="row">
            <div class="col-md-1">
             </div>
        <div class="col-md-11">
            <?php 
session_start();
$username=$_SESSION['MM_Username']; 
include_once("mysql_info.php");
$result2=mysqli_query($link,"select * from member where username='$username'");
$row2 = mysqli_fetch_array($result2);
$interested_array=array();
$interested_array=unserialize($row2['interested']);
//echo implode(",",$interested_array)."<br>";
if ($interested_array!=NULL){
$sql = "select * from item_forsell where status=1 and `id` in (".implode(",",$interested_array).")"; //在test資料表中選擇所有欄位
//test用
//echo implode(",",$interested_array);
$result = mysqli_query($link,$sql); // 執行SQL查詢
$total_fields=mysqli_num_fields($result); // 取得欄位數
$number_of_row=mysqli_num_rows($result); // 取得記錄數
$totalCount = ceil($number_of_row/4)*4;
if ($number_of_row==0){
	echo "您目前沒有追蹤任何商品<br>";
	}
else{
echo '<table><tr><th colspan=\"4\"><p style="font-size:20px;">追蹤商品一覽</p></th></tr>';

for($k = 0; $k < $totalCount; $k ++) {

        if($k%4 == 0) { echo '<tr>'; }

        if($row = mysqli_fetch_array($result)) {
                echo '<td><table><form action="delete_interested.php" method="post"><tr><td style="width:230px" onClick="location.href="show_item_detail.php?id='.$row[id].'"">'.$row[name].
                     '</td></tr><tr><td>'.$row[price].
                     '</td></tr><tr><td>'.$row["method"].
                     '</td></tr><tr><td>'.$row["phone"].
                     '</td></tr><tr><td>'.$row["contact_email"].
                     '</td></tr><tr><td>'.$row["date"].
           '</td></tr><tr><td><img src="Picture/'.$row[filename].'" width="216" height="162" class="img-rounded"></td></tr><tr><td><center><input type="submit" value="取消追蹤" class="btn btn-default"><input type="hidden" name="id" value="'.$row['id'].'"/></center></td></tr></form></table></td>';
        }
        else {
                echo '<td style="width:230px"></td>';
        }

        if($k%4 == 3) { echo '</tr>'; }

}
echo "</table>";}

include_once("mysql_info.php");
$result2=mysqli_query($link,"select * from member where username='$username'");
$row2 = mysqli_fetch_array($result2);
$interested_array=array();
$interested_array=unserialize($row2['interested']);
$sql = "select * from item_wanted where status=1 and `id` in (".implode(",",$interested_array).")"; //在test資料表中選擇所有欄位
$result = mysqli_query($link,$sql); // 執行SQL查詢
$total_fields=mysqli_num_fields($result); // 取得欄位數
$number_of_row=mysqli_num_rows($result); // 取得記錄數
$totalCount = ceil($number_of_row/4)*4;
if ($number_of_row==0){
	echo "<tr colspan=\"4\">您目前沒有追蹤任何需求</tr></table><br>";
	}
else{
echo '<table><tr><th colspan=\"4\"><p style="font-size:20px;">追蹤需求一覽</p></th></tr>';
for($k = 0; $k < $totalCount; $k ++) {

        if($k%4 == 0) { echo '<tr>'; }

        if($row = mysqli_fetch_array($result)) {
                echo '<td><table><form action="delete_interested.php" method="post"><tr><td style="width:230px" onClick="location.href="show_wanted_detail.php?id='.$row[id].'"">'.$row[name].
                     '</td></tr><tr><td>'.$row[detail].'</td></tr><tr><td>'.$row[price].
                     '</td></tr><tr><td>'.$row["method"].
                     '</td></tr><tr><td>'.$row["phone"].
                     '</td></tr><tr><td>'.$row["contact_email"].
                     '</td></tr><tr><td>'.$row["date"].
           '</td></tr><tr><td><center><input type="submit" value="取消追蹤"><input type="hidden" name="id" value="'.$row['id'].'"/></center></td></tr></form></table></td>';
        }
        else {
                echo '<td style="width:230px"></td>';
        }

        if($k%4 == 3) { echo '</tr>'; }

}
echo "</table>";}}
else{
    echo "<br><br><br><br><br>您目前沒有追蹤任何商品或需求<br><br><br><br><br><br><br><br><br><br><br><br><br><br>";
}
?>
            </div>
        </div>
       </center>
  </div><!-- // end #main -->
<? include("footer.php");?>