<? include("header.php");
if (isset($_SESSION['MM_Username'])){
?>
<div id="main">
    <center>
        <div class="row">
            <div class="col-md-1">
       		   </div>
            <div class="col-md-2" align="left">
               <div id=search>
<form role="form" action="show_item.php" method="get">
  <div class="form-group">
    <label for="InputKeyword">關鍵字搜尋</label>
   <input type="text" class="form-control" placeholder="關鍵字" size="10" name="keyword">  
  </div>
  <p><button type="submit" class="btn btn-default">Submit</button></p>
</form>
<table class="table table-hover">
<tr><td onClick="location.href='send_message.php'"><center>撰寫新郵件</center></td></tr>
<tr><td onClick="location.href='message_area.php'"><center>收&nbsp;&nbsp;&nbsp;件&nbsp;&nbsp;&nbsp;&nbsp;夾</center></td></tr>
<tr><td onClick="location.href='sent_message_area.php'"><center>寄&nbsp;件&nbsp;備&nbsp;份</center></td></tr>
<tr><td onClick="location.href='garbage_message_area.php.php'"><center>垃&nbsp;&nbsp;&nbsp;圾&nbsp;&nbsp;&nbsp;桶</center></td></tr>
</table>       		   </div>
            </div>
  			<div class="col-md-8">
            <?php 
session_start();
$username=$_SESSION['MM_Username']; 
include_once("function/mysql_info.php");
$id=$_GET["id"];
//0未讀 1 已讀 2 刪除
$sql = "select * from `Message` where `To`='$username' and (sender_status=1 or sender_status=0) order by `id` desc"; //在test資料表中選擇所有欄位
$result = mysqli_query($link,$sql); // 執行SQL查詢引
//$row = mysqli_fetch_array($result);
?>
			<table class="table table-striped table table-hover" style="margin:15px 0px 15px 0px"
            <tr><th width="200px">寄件人</th><th colspan="2">主旨</th></tr>
            <?php
$number_of_row=mysqli_num_rows($result)+1;
for($k = 0; $k < $number_of_row; $k ++) {
	if($row = mysqli_fetch_array($result)){
    echo '<tr onClick="location.href=\'read_message.php?id='.$row[id].'"">><form action="function/delete_message.php"><td>'.$row[From].'</td><td>'.$row[subject].'</td><td width="100" align="right"><input type="submit" value=刪除><input type="hidden" value="$row[id]" name=id></td></form><tr>';
	if($id==$row[id]){
		echo '<tr><td></td><td>'.$row[content].'</td><td></td></tr>';
		
	}};}?>
	
	?></table> <div class="col-md-1">
       		   </div></div>
        </div>
       </center>
	</div><!-- // end #main -->

<?php
}
else{echo '請先登入！';}
?>


<? include("footer.php");?>