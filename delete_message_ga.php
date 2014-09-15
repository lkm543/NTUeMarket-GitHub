<?php

session_start();
$username=$_SESSION['MM_Username'];
$currtimestr=date("Y-m-d h:i:s"); 
include_once("mysql_info.php");
$id=$_POST['id'];
$sql="select * from message where id='$id'";
$result = mysqli_query($link,$sql); // 執行SQL查詢引
$row = mysqli_fetch_array($result);
if($username==$row['From']){//update message set sender_status= 2 where id=57
mysqli_query ($link,"update message set sender_status= 3 where id='$id'");
	}
if($username==$row['To']){
mysqli_query ($link,"update message set receiver_status= 3 where id='$id'");
	}
echo '<meta http-equiv=REFRESH CONTENT=2;url=garbage_message_area.php>';
?>