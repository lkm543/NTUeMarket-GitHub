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
$username=$_SESSION['MM_Username']; 
include_once("mysql_info.php");
$sql = "select m.id, m.username, i.* from member m, item_forsell i where m.id = i.owner and m.username = '$username' and status = 3 order by i.id desc"; 
$result = mysqli_query($link,$sql); // 執行SQL查詢
$total_fields=mysqli_num_fields($result); // 取得欄位數
$number_of_row=mysqli_num_rows($result); // 取得記錄數
$totalCount = ceil($number_of_row/3)*3;
if($number_of_row!=0){//有東西
echo "<table><tr><th colspan=\"3\">已下架商品</th></tr>";
for($k = 0; $k < $totalCount; $k ++) {

        if($k%3 == 0) { echo '<tr class="row">'; }

        if($row = mysqli_fetch_array($result)) {
            echo '<td class="col-xs-9 col-md-4 col-md-offset-1">
                  <div class="item_wrapper">
                  <div>'.$row[name].'</div>
                  <div>出價金額: $'.$row[price].'</div>
                  <div>上架日期: '.$row[date].'</div>
                  <a href="show_item_detail.php?id='.$row[id].'"><div class="item_img_wrapper" style="background:url(Picture/'.$row[filename].'_1.jpg) no-repeat center center; background-size:230px"></div></a>
                  <form action="recover_item.php" method="post">
                  <div><center>
                  <input type="hidden" value="item" name="type">
                  <input type="submit" class="btn btn-info" value="恢復上架">
                  <input type="hidden" name="id" value="'.$row[id].'"/>
                  </center></div></form>
                  </div></td>';
        }
                else{
          echo "<td class=\"col-xs-9 col-md-4 col-md-offset-1\"></td>";
        }

        if($k%3 == 2) { echo '</tr>'; }

}
echo "</table>";}

$sql2 = "select m.id, m.username, i.* from member m, item_wanted i where m.id = i.owner and m.username = '$username' and status = 3 order by i.id desc"; 
$result2 = mysqli_query($link,$sql2); // 執行SQL查詢
$total_fields2=mysqli_num_fields($result2); // 取得欄位數
$number_of_row2=mysqli_num_rows($result2); // 取得記錄數
$totalCount2 = ceil($number_of_row2/3)*3;
//echo "number".$number_of_row2;
if($number_of_row2!=0){//有東西
echo "<table><tr><th colspan=\"3\">已停止徵求</th></tr>";
for($k = 0; $k < $totalCount2; $k ++) {

        if($k%3 == 0) { echo '<tr class="row">'; }

        if($row2= mysqli_fetch_array($result2)) {
            echo '<td class="col-xs-9 col-md-4 col-md-offset-1">
                  <div class="item_wrapper">
                  <div>'.$row2[name].'</div>
                  <div>出價金額: $'.$row2[price].'</div>
                  <div>上架日期: '.$row2[date].'</div>
                  <form action="recover_item.php" method="post">
                  <div><center>
                  <input type="hidden" value="want" name="type">
                  <input type="submit" class="btn btn-info" value="恢復上架">
                  <input type="hidden" name="id" value="'.$row2[id].'"/>
                  </center></div></form>
                  </div></td>';
        }
                else{
          echo "<td class=\"col-xs-9 col-md-4 col-md-offset-1\"></td>";
        }

        if($k%3 == 2) { echo '</tr>'; }

}
echo "</table>";}

?>
            </div>
        </div>
       </center>
    </div><!-- // end #main -->
</div>
<? include("footer.php");?>