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

<table class="table table-hover">
<tr><td onClick="location.href='send_message.php'"><center>撰寫新郵件</center></td></tr>
<tr><td onClick="location.href='message_area.php'"><center>收&nbsp;&nbsp;&nbsp;件&nbsp;&nbsp;&nbsp;&nbsp;夾</center></td></tr>
<tr><td class="active" onClick="location.href='sent_message_area.php'"><center>寄&nbsp;件&nbsp;備&nbsp;份</center></td></tr>
<tr><td onClick="location.href='garbage_message_area.php'"><center>垃&nbsp;&nbsp;&nbsp;圾&nbsp;&nbsp;&nbsp;桶</center></td></tr>
</table>       		   </div>
            </div>
  			<div class="col-md-8">
            <?php 
$username=$_SESSION['MM_Username']; 
include_once("mysql_info.php");
//1 普通 2 刪除
$sql = "select * from `message` where `From`='$username' and `sender_status`=1 order by `id` desc"; //在test資料表中選擇所有欄位
$result = mysqli_query($link,$sql); // 執行SQL查詢引
$id=$_GET["id"];
?>
			<table class="table table-striped table table-hover" style="margin:15px 0px 15px 0px">
            <tr><th width="200px">收件人</th><th colspan="2">主旨</th></tr>
           <?php
$number_of_row=mysqli_num_rows($result);
for($k = 0; $k < $number_of_row; $k ++) {
	if($row = mysqli_fetch_array($result)){
       if($id!=$row[id]){
    if($row[receiver_status]!=0){//已讀
    echo '<tr onClick="location.href=\'sent_message_area.php?id='.$row[id].'\'"><form action="delete_message.php" method="POST"><td>'.$row[To].'</td><td>'.$row[subject].'</td><td width="100" align="right"><input type="submit" value="刪除" class="btn btn-danger"><input type="hidden" value="'.$row[id].'" name=id></td></form><tr>';
    }
    if($row[receiver_status]==0){//未讀
echo '<tr style="font-weight: bold; font-size:16px; text-decoration: underline;" onClick="location.href=\'sent_sent_message_area.php?id='.$row[id].'\'"><form action="delete_message.php" method="POST"><td>'.$row[To].'</td><td>'.$row[subject].'</td><td width="100" align="right"><input type="submit" value="刪除" class="btn btn-danger"><input type="hidden" value="'.$row[id].'" name=id></td></form><tr>';
    }  
  }	if($id==$row[id]){
    echo '<tr class="success" onClick="location.href=\'sent_message_area.php\'"><form action="delete_message.php" method="POST"><td>'.$row[To].'</td><td>'.$row[subject].'</td><td width="100" align="right"><input type="submit" value="刪除" class="btn btn-danger"><input type="hidden" value="'.$row[id].'" name=id></td></form><tr>';

		echo '<tr class="info"><td></td><td>'.nl2br($row[Message]).'</td><td></td></tr>';
		
	}}}?></table> <div class="col-md-1">
       		   </div></div>
        </div>
       </center>
	</div><!-- // end #main -->

<?php
}
else{echo '請先登入！';}
?>


<? include("footer.php");?>
